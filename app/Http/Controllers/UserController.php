<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        $users = User::orderBy('created_at', 'DESC');

        if(request()->has('search')) {
            $users = $users->where('title', 'like', '%'.request()->get('search', '').'%');
        }

        return view('users', [
            'users' => $users->paginate()
        ]);
    }

    public function show(User $user){
        $works = $user->works();
        $achievements = Achievement::all()->sortByDesc('created_at');
        $unlockedAchieves = [];

        for($i = $achievements->count()-1; $i >= 0; --$i) {
            if($achievements[$i]->hasAchievement($user)) {
                $unlockedAchieves[$i] = $achievements[$i];
            }
            if(count($unlockedAchieves) == 3) {
                break;
            }
        }

        return view('users.show',compact('user','works','achievements','unlockedAchieves'));
    }

    public function update(User $user){
        $validator = Validator::make(request()->all(), [
            'login' => 'required|min:3|max:40'.$user->id,
            'description' => 'nullable|max:130',
            'avatar' => 'image|mimes:jpeg,png,jpg,webp,bmp|max:10240',
            'background_image' => 'image|mimes:jpeg,png,jpg,webp,bmp|max:10240',
            'email' => 'required|min:3|unique:users,email,'.$user->id,
            'new_password' => 'min:8|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $validated = $validator->validated();

        if(request('old_password') != null && request('new_password') != null) {
            if(Hash::check(request('old_password'), $user->password)) {
                $validated['password'] = Hash::make(request('new_password'));
            } else {
                return redirect()->back()->withErrors('Неверный пароль');
            }
        }

        if(request()->has('avatar')) {
            $user->clearMediaCollection('avatar');
            $user->addMedia($validated['avatar'])->usingName('avatar')
            ->usingFileName($user->id.'-'.time().'.'.request('avatar')->getClientOriginalExtension())
            ->toMediaCollection('avatar');
        }

        if(request()->has('background_image')) {
            $user->clearMediaCollection('background_image');
            $user->addMedia($validated['background_image'])->usingName('background_image')
            ->usingFileName($user->id.'-'.time().'_bg.'.request('background_image')->getClientOriginalExtension())
            ->toMediaCollection('background_image');
        }

        $user->update($validated);

        return redirect()->route('users.show',$user);
    }

    public function profile_works(User $user){
        return view('profile_works',compact('user'));
    }

    public function profile_cols(User $user){
        return view('profile_cols',compact('user'));
    }

    public function profile_article(User $user){
        return view('profile_article',compact('user'));
    }

    public function destroy(User $user) {
        if(auth()->id() !== $user->id && !auth()->user()->is_admin){
            abort(404);
        }

        $works = $user->works;
        foreach($works as $work)
        {
            foreach(explode(",", $work->additionalImgs) as $img) {
                if(File::exists($img)){
                    File::delete($img);
                }
            }

            $work->delete();
        }
        $articles = $user->articles;
        foreach($articles as $article)
        {
            $article->delete();
        }
        $collaborations = $user->collaborations;
        foreach($collaborations as $collaboration)
        {
            $collaboration->delete();
        }

        // Reset session
        if(!auth()->user()->is_admin) {
            auth()->logout();

            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }

        $user->delete();

        if(auth()->user()->is_admin ?? false) {
            return redirect()->route('admin.users');
        }
        return redirect()->route('register');
    }
}
