<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Tag;
use App\TagTask;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Input::all();

        $tags = Tag::all();
        $users = User::all();
        $status = config('status');

        if (empty($query)) {
            $tasks = Task::all();
        } elseif (empty($query['tag_id'])) {
            $tasks = Task::whereCreator($query['creator_id'])
                ->whereExecutor($query['executor_id'])
                ->whereStatus($query['status_id'])
                ->get();
        } elseif (!empty($query)) {
            $tasks = Task::whereCreator($query['creator_id'])
                ->whereExecutor($query['executor_id'])
                ->whereStatus($query['status_id'])
                ->join('tag_task', 'tag_task.task_id', '=', 'tasks.id')
                ->whereTag($query['tag_id'])
                ->select('tasks.*')
                ->groupBy('tasks.id')
                ->get();
        }

        return view('tasks.index', compact('tasks', 'status', 'users', 'tags', 'query'));
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
        $task->status_id = $data['status_id'];
        $task->creator_id = Auth::id();
        $task->executor_id = $data['executor_id'];
        $task->save();

        if (isset($data['tag_id'])) {
            foreach ($data['tag_id'] as $tag) {
                TagTask::insert(['task_id' => $task->id, 'tag_id' => $tag]);
            }
        }

        return redirect()
            ->route('tasks.index')
            ->with(['success' => trans('flash.task_added')]);
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
        $task = Task::findOrFail($id);

        $status = config('status');
        $status = $status[$task->status_id];

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
        $task = Task::findOrFail($id);

        $users = User::all();
        $tags = Tag::all();
        $status = config('status');

        $taskTags = TagTask::where('task_id', $task->id)->get('tag_id')->toArray();
        $taskTags = array_map(function ($taskTag) {
            return $taskTag['tag_id'];
        }, $taskTags);

        return view('tasks.edit', compact('task', 'users', 'tags', 'status', 'taskTags'));
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
        $task->status_id = $data['status_id'];
        $task->executor_id = $data['executor_id'];
        $task->save();

        TagTask::where('task_id', '=', $id)->delete();

        if (isset($data['tag_id'])) {
            foreach ($data['tag_id'] as $tag) {
                TagTask::insert(['task_id' => $id, 'tag_id' => $tag]);
            }
        }

        return redirect()->route('tasks.edit', $id)->with(['success' => trans('flash.task_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with(['success' =>  trans('flash.task_deleted')]);
    }
}
