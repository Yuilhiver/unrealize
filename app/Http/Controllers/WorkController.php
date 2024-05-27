<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\User;
use App\Models\Version;
use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Workgenre;
use App\Models\Worktype;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class WorkController extends Controller
{

    public function index(){
        $followers_count = User::has('followers')->count();
        $works_count = User::has('works')->count();

        return view('works', [
            'versions' => Version::with('works')->withCount('works')->get()->sortByDesc('works'),
            'worktypes' => Worktype::with('works')->withCount('works')->get()->sortByDesc('works'),
            'genres' => Workgenre::with('works')->withCount('works')->get()->sortByDesc('works'),
            'followers_count' =>  $followers_count,
            'works_count' =>  $works_count,
        ]);
    }

    public function show(Work $work){
        return view('works.show',compact('work'));
    }

    public function store(Request $request) {
        $validated = request()->validate([
            'title' => 'required|min:2|max:150',
            'shortDescription' => 'required|min:2|max:1125',
            'description' => 'required|min:2|max:15500',
            'worktype_id' => 'required',
            'workgenre_id' => 'required',
            'version_id' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,webp,bmp|max:10240',
            'additionalImgs' => 'required',
            'additionalImgs.*' => 'image|mimes:jpeg,png,jpg,webp,bmp|max:100240',
        ]);

        $path = "storage/works";

        $imageArray = collect();
        if($addFiles = $request->file('additionalImgs')) {
            foreach($addFiles as $key => $addFile) {
                $addExtension = $addFile->getClientOriginalExtension();
                $addFilename = $key.'-'.time().'.'.$addExtension;

                $addFile->move($path, $addFilename);

                $imageArray->push($path.'/'.$addFilename);
            }
        }

        $validated['user_id'] = auth()->id();
        $validated['additionalImgs'] =  $imageArray->implode(',');

        $work = Work::create($validated);

        $work->addMediaFromRequest('image')->usingName('main')
        ->usingFileName(time().'.'.$request['image']->getClientOriginalExtension())
        ->toMediaCollection('works');

        // START OF Achievement check
        $user = User::findOrFail(auth()->id());
        $work_amount = $user->works()->count();
        $achievements = Achievement::all();
        foreach ($achievements as $achievement) {
            if($achievement->amount == $work_amount) {
                $user->achievements()->attach($achievement);
            }
        }
        // END OF Achievement check

        return redirect()->route('works.show',$work->id);
    }

    public function destroy(Work $work) {
        Gate::authorize('delete',$work);

        foreach(explode(",", $work->additionalImgs) as $img) {
            if(File::exists($img)){
                File::delete($img);
            }
        }

        $work->delete();

        return redirect()->route('works.index');
    }

    public function edit(Work $work){
        Gate::authorize('update',$work);

        $editing = true;

        return view('works.show',[
            'versions' => Version::all()->sortByDesc('works'),
            'worktypes' => Worktype::all()->sortByDesc('works'),
            'genres' => Workgenre::all()->sortByDesc('works'),
            'work' => $work,
            'editing' => $editing,
        ]);
    }

    public function update(Work $work){
        Gate::authorize('update',$work);

        $validator = Validator::make(request()->all(), [
            'title' => 'required|min:2|max:150',
            'shortDescription' => 'required|min:2|max:1125',
            'description' => 'required|min:2|max:15500',
            'worktype_id' => 'required|integer',
            'workgenre_id' => 'required|integer',
            'version_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $validated = $validator->validated();

        $work->update($validated);

        return view('works.show',compact('work'));
    }
}
