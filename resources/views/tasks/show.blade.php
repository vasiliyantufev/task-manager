@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Show Task</div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="title">Название:</label>
                            {{ $task->title }}
                        </div>

                        <div class="form-group">
                            <label for="title">Создатель:</label>
                            {{ $creator->name }}
                        </div>

                        <div class="form-group">
                            <label for="title">Исполнитель:</label>
                            {{ $executor->name }}
                        </div>

                        <div class="form-group">
                            <label for="title">Статус:</label>
                            {{ $status }}
                        </div>

                        <div class="form-group">
                            <label for="title">Теги:</label>

                            @foreach($tags As $tag)
                                {{ $tag->name }}
                            @endforeach
                        </div>

                        <hr>

                        <div class="form-group">
                        <form method="POST" action="{{ route('comments.store') }}">

                            @csrf

                            <div class="form-group">
                                <label>Добавить комментарий:</label>
                                <input type="hidden" name="task_id" value="{{ $task->creator_id }}">
                                <textarea class="form-control" rows="3" name="text"></textarea>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </div>
                        </form>
                        </div>


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
                                        <td>{{ $comment->creator->name }}</td>
                                        <td>{{ $comment->created_at }}</td>
                                    </tr>
                            @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
