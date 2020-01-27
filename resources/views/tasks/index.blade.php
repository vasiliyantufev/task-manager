@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">

                        @if($errors->any())
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                        {{ $errors->first() }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                        {{ session()->get('success') }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                                <a class="btn btn-primary" href="{{ route('tasks.create') }}">@lang('messages.add_task')</a>
                        </div>

                            <form>
                                <div class="form-row">

                                    <div class="col-md-4 mb-4">
                                        <label>@lang('messages.creator')</label>
                                        <select name="creator_id" class="form-control material-select" data-live-search="true">
                                            <option value=""></option>
                                            @foreach($users As $user)
                                                @if (isset($query['creator_id']) && $query['creator_id'] == $user->id)
                                                    <option selected value="{{ $user->id }} ">{{ $user->name }}</option>
                                                @else
                                                    <option value="{{ $user->id }} ">{{ $user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label>@lang('messages.executor')</label>
                                        <select name="executor_id" class="form-control material-select" data-live-search="true">
                                            <option value=""></option>
                                            @foreach($users As $user)
                                                @if (isset($query['executor_id']) && $query['executor_id'] == $user->id)
                                                    <option selected value="{{ $user->id }} ">{{ $user->name }}</option>
                                                @else
                                                    <option value="{{ $user->id }} ">{{ $user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label>@lang('messages.status')</label>
                                        <select name="status_id" class="form-control material-select" data-live-search="true">
                                            <option value=""></option>
                                            @foreach($status As $key => $value)
                                                @if (isset($query['status_id']) && $query['status_id'] == $key)
                                                    <option selected value="{{ $key }} ">{{ $value }}</option>
                                                @else
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-12">
                                        <label>@lang('messages.tags')</label>
                                        <select  name="tag_id[]" class="form-control material-select" data-live-search="true" multiple>
                                            <option value=""></option>
                                            @foreach($tags As $tag)
                                                @if (isset($query['tag_id']) && in_array($tag->id, $query['tag_id']))
                                                    <option selected value="{{ $tag->id }} ">{{ $tag->name }}</option>
                                                @else
                                                    <option value="{{ $tag->id }} ">{{ $tag->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">@lang('messages.apply_filter')</button>
                                    <button class="btn btn-primary" type="reset">@lang('messages.reset_filter')</button>
                                </div>
                            </form>

                        @if(!$tasks->isEmpty())
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('messages.title')</th>
                                <th scope="col">@lang('messages.created_at')</th>
                                <th scope="col">@lang('messages.status')</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($tasks as $task)
                                <tr id="rowTbl{{ $task->id }}">
                                    <td>{{ $task->id }}</td>
                                    <td id="tblBreakTd"><a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a></td>
                                    <td>{{ $task->created_at }}</td>
                                    <td>{{ $status[$task->status_id] }}</td>
                                    <td>
                                        @if ( Auth::id() == $task->creator_id || Auth::user()->isAdmin())
                                            <a href="{{ route('tasks.edit', $task->id) }}">
                                                <input type="button" class="btn btn-info" value="@lang('messages.edit')"/>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ( Auth::id() == $task->creator_id || Auth::user()->isAdmin())

                                            <form action="{{ route("tasks.destroy", $task->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <input class="btn btn-danger" type="submit" value="@lang('messages.delete')" />
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @else
                            <label>@lang('messages.no_tasks_added')</label>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
