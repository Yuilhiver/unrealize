<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Work;

class CommentController extends Controller
{
    public function store(Work $work) {

        $validated = request()->validate( [
            'content' => 'required|min:2|max:550',
            'rating' => 'required|min:1|max:5',
        ]);

        $validated['work_id'] = $work->id;
        $validated['user_id'] = auth()->id();

        Comment::create($validated);

        $work->rating = $work->comments()->avg('rating');
        $work->save();

        return redirect()->back();
    }

    public function destroy($comment, $work) {

        $comment = Comment::findOrFail($comment);
        $work = Work::findOrFail($work);

        if(auth()->id() !== $comment->user->id && !auth()->user()->is_admin){
            abort(404);
        }

        $comment->delete();

        $work->rating = $work->comments()->avg('rating') ?? 0;
        $work->save();

        return redirect()->route('works.show',$work->id);
    }
}
