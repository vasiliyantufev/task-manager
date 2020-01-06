<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Tag;
use App\TagTask;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        $status = config('status');

        return view('tasks.index', compact('tasks', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();
        $tags = Tag::all();
        $status = config('status');

        return view('tasks.create', compact('users', 'tags', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $task = new Task();
        $task->title = $data['title'];
        $task->status = $data['status_id'];
        $task->creator_id = Auth::id();
        $task->executor_id = $data['executor_id'];
        $task->save();

        if(isset($data['tag_id']))
        {
            foreach ($data['tag_id'] as $tag) {
                TagTask::insert(['task_id' => $task->id, 'tag_id' => $tag]);
            }
        }

        return redirect()
            ->route('tasks.index')
            ->with(['success' => "Запись успешно добавлена"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $task = Task::find($id);

        if(is_null($task)) {
            abort(404);
        }

        $status = config('status');
        $status = $status[$task->status];

        $comments = Comment::where('task_id', $task->id)->active()->get();

        $tagsId = TagTask::where('task_id', $task->id)->get('tag_id')->toArray();
        $tags = Tag::whereIn('id', $tagsId)->get('name');

        $creator  = User::where('id', $task->creator_id)->first();
        $executor = User::where('id', $task->executor_id)->first();
        return view('tasks.show', compact('task', 'status', 'tags', 'creator', 'executor', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $task = Task::find($id);

        if(is_null($task)) {
            abort(404);
        }

        $users = User::all();
        $tags = Tag::all();
        $status = config('status');

        $taskTags = TagTask::where('task_id', $task->id)->get('tag_id')->toArray();
        $taskTags = array_map(function ($taskTag) {
            return $taskTag['tag_id'];
        }, $taskTags);

        return view('tasks.edit', compact('task','users', 'tags', 'status', 'taskTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->all();

        $task = Task::find($id);
        $task->title = $data['title'];
        $task->status = $data['status_id'];
        $task->executor_id = $data['executor_id'];
        $task->save();

        TagTask::where('task_id', '=', $id)->delete();

        if(isset($data['tag_id']))
        {
            foreach ($data['tag_id'] as $tag) {
                TagTask::insert(['task_id' => $id, 'tag_id' => $tag]);
            }
        }

        return redirect()->route('tasks.edit', $id)->with(['success' => "Запись успешно обновлена"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $task = Task::find($id);
        $task->delete();

        return redirect()->route('tasks.index')->with(['success' => "Запись успешно удалена"]);
    }
}
