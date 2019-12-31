@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tasks</div>

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
                            <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                                <a class="btn btn-primary" href="{{ route('tasks.create') }}">Добавить task</a>
                            </nav>
                        </div>


                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Status</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td><a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a></td>
                                    <td>{{ $task->created_at }}</td>
                                    <td>{{ $status[$task->status] }}</td>
                                    <td>
                                        @if ( \Illuminate\Support\Facades\Auth::id() == $task->creator_id)
                                            <a href="{{ route('tasks.edit', $task->id) }}">
                                                <input type="button" class="btn btn-info" value="Edit"/>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ( \Illuminate\Support\Facades\Auth::id() == $task->creator_id)
                                            <form action="{{ route('tasks.destroy', [$task->id])}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <input type="submit" class="btn btn-danger" value="Delete"/>
                                            </form>
                                        @endif
                                    </td>
                                </tr>

                                @endforeach
                                </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
