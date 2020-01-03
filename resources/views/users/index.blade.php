@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Users</div>

                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Role</th>
                                <th scope="col">Created_at</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($users as $user)
                                <tr id="rowTbl{{ $user->id }}">
                                    <td>{{ $user->id }}</td>
                                    <td><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></td>
                                    <td>@if (Auth::user()->isAdmin()) admin @else user @endif</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        @if (Auth::user()->isAdmin())
                                            <input type="button" class="btn btn-danger" value="Delete" onclick="setId({{ $user->id }})" data-toggle="modal" data-target="#exampleModal">
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="deleteUser()">Удалить</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var idUser;

        function setId(id) {
            idUser=id;
        }

        function deleteUser(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type:'POST',
                url:'/delete_user',
                data: {_token: CSRF_TOKEN, id: idUser},
                success:function(data){
                    $("#rowTbl" + idUser).remove();
                    //alert(data.success);
                }
            });
        }
    </script>

@endsection
