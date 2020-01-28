@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Show Task</div>

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
                            <label for="title">@lang('messages.title'):</label>
                            {{ $task->title }}
                        </div>

                        <div class="form-group">
                            <label for="title">@lang('messages.creator'):</label>
                            @if(isset($comment->creator->name)) {{ $comment->creator->name }} @else @lang('messages.user_deleted') @endif
                        </div>

                        <div class="form-group">
                            <label for="title">@lang('messages.executor'):</label>
                            @if(isset($executor->name)) {{ $executor->name }} @else User deleted @endif
                        </div>

                        <div class="form-group">
                            <label for="title">@lang('messages.status'):</label>
                            {{ $status }}
                        </div>

                        <div class="form-group">
                            <label for="title">@lang('messages.tags'):</label>

                            @foreach($tags As $tag)
                                {{ $tag->name }}
                            @endforeach
                        </div>

                        <hr>

                        <div class="form-group">
                        <form method="POST" action="{{ route('comments.store') }}">

                            @csrf

                            <div class="form-group">
                                <label>@lang('messages.addComment'):</label>
                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                <textarea class="form-control" rows="3" name="text"></textarea>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
                                </div>
                            </div>
                        </form>
                        </div>

                        @if ( !$comments->isEmpty() )
                            <div class="form-group">
                                <label for="title">Комментарии:</label>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Text</th>
                                        <th scope="col">Creator</th>
                                        <th scope="col">Created_at</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($comments As $comment)
                                        <tr>
                                            <td>{{ $comment->text }}</td>
                                            <td>@if(isset($comment->creator->name)) {{ $comment->creator->name }} @else User deleted @endif</td>
                                            <td>{{ $comment->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
