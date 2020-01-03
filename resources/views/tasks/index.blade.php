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
                                <tr id="rowTbl{{ $task->id }}">
                                    <td>{{ $task->id }}</td>
                                    <td><a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a></td>
                                    <td>{{ $task->created_at }}</td>
                                    <td>{{ $status[$task->status] }}</td>
                                    <td>
                                        @if ( Auth::id() == $task->creator_id || Auth::user()->isAdmin())
                                            <a href="{{ route('tasks.edit', $task->id) }}">
                                                <input type="button" class="btn btn-info" value="Edit"/>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ( Auth::id() == $task->creator_id || Auth::user()->isAdmin())
                                            <input type="button" class="btn btn-danger" value="Delete" onclick="setId({{ $task->id }})" data-toggle="modal" data-target="#exampleModal">
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


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Внимание!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Вы действительно хотите удалить запись?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="deleteTask()">Удалить</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var idTask;

        function setId(id) {
            idTask=id;
        }

        function deleteTask(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type:'POST',
                url:'/delete_task',
                data: {_token: CSRF_TOKEN, id: idTask},
                success:function(data){
                    $("#rowTbl" + idTask).remove();
                    //alert(data.success);
                }
            });
        }
    </script>
@endsection
