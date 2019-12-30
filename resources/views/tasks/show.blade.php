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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
