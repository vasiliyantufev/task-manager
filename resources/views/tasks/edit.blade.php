@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Task</div>

                    <div class="card-body">


                        <form method="POST" action="{{ route('tasks.update', $task->id) }}">

                            @method('PATCH')
                            @csrf

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
                                <label for="title">Название</label>
                                <input id="title" type="text" class="form-control" name="title" required value="{{ $task->title }}">
                            </div>

                            <div class="form-group">
                                <label for="title">Статус</label>

                                <select name="status_id" class="form-control material-select" data-live-search="true">
                                    @foreach($status As $key => $value)
                                        <option value="{{ $key }}" @if( $task->status == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Исполнитель</label>

                                <select name="executor_id" class="form-control material-select" data-live-search="true">
                                    @foreach($users As $user)
                                        <option value="{{ $user->id }}" @if( $task->creator_id == $user->id) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="title">Теги</label>

                                <select name="tag_id[]" class="form-control material-select" data-live-search="true" multiple>
                                    @foreach($tags As $tag)
                                        <option value="{{ $tag->id }}" @if( in_array($tag->id, $taskTags) ) selected @endif>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                    <a class="btn btn-primary" href="{{ route('tasks.index') }}">Отмена</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
