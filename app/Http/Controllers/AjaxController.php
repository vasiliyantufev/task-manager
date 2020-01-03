<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Tag;
use App\Task;
use App\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function deleteUser(Request $request)
    {
        $input = $request->all();
        $user = User::find($input["id"]);
        $user->delete();
    }

    public function deleteTask(Request $request)
    {
        $input = $request->all();
        $task = Task::find($input["id"]);
        $task->delete();
    }

    public function deleteTag(Request $request)
    {
        $input = $request->all();
        $tag = Tag::find($input["id"]);
        $tag->delete();
    }

    public function deleteComment(Request $request)
    {
        $input = $request->all();
        $comment = Comment::find($input["id"]);
        $comment->delete();
    }
}
