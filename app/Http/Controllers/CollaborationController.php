<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collaboration;
use App\Models\User;
use App\Models\Version;
use App\Models\Workgenre;
use App\Models\Worktype;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CollaborationController extends Controller
{

    public function index(){
        $followers_count = User::has('followers')->count();
        $works_count = User::has('works')->count();

        return view('collaborations', [
            'versions' => Version::with('collaborations')->withCount('collaborations')->get()->sortByDesc('collaborations'),
            'worktypes' => Worktype::with('collaborations')->withCount('collaborations')->get()->sortByDesc('collaborations'),
            'genres' => Workgenre::with('collaborations')->withCount('collaborations')->get()->sortByDesc('collaborations'),
            'followers_count' =>  $followers_count,
            'works_count' =>  $works_count,
        ]);
    }

    public function show(Collaboration $collaboration){
        return view('collaborations.show',compact('collaboration'));
    }

    public function store(Request $request) {
        $validated = request()->validate( [
            'title' => 'required|min:2|max:150',
            'shortDescription' => 'required|min:2|max:1125',
            'worktype_id' => 'required',
            'workgenre_id' => 'required',
            'version_id' => 'required',
            'roles' => 'required|min:2|max:150',
            'contacts' => 'required|min:2|max:150',
            'image' => 'required|mimes:jpeg,png,jpg,webp,bmp|max:10240',
        ]);

        $validated['user_id'] = auth()->id();

        $collaboration = Collaboration::create($validated);

        $collaboration->addMediaFromRequest('image')->usingName('main')
        ->usingFileName(time().'.'.$request['image']->getClientOriginalExtension())
        ->toMediaCollection('collaborations');

        return redirect()->route('collaborations.show', $collaboration->id);
    }

    public function destroy(Collaboration $collaboration) {
        Gate::authorize('delete',$collaboration);

        $collaboration->delete();

        return redirect()->route('collaborations.index');
    }

    public function edit(Collaboration $collaboration){
        Gate::authorize('update',$collaboration);

        $editing = true;

        return view('collaborations.show',[
            'versions' => Version::all(),
            'types' => Worktype::all(),
            'genres' => Workgenre::all(),
            'collaboration' => $collaboration,
            'editing' => $editing,
        ]);
    }

    public function update(Collaboration $collaboration){
        Gate::authorize('update',$collaboration);

        $validator = Validator::make(request()->all(), [
            'title' => 'required|min:2|max:150',
            'shortDescription' => 'required|min:2|max:1125',
            'worktype_id' => 'required',
            'workgenre_id' => 'required',
            'version_id' => 'required',
            'roles' => 'required|min:2|max:150',
            'contacts' => 'required|min:2|max:150',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $validated = $validator->validated();

        $collaboration->update($validated);

        return view('collaborations.show',compact('collaboration'));
    }
}
