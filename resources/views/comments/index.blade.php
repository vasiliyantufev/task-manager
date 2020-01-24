@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Comments</div>

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

                        @if(!$comments->isEmpty())
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Text</th>
                                <th scope="col">Creator</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created_at</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($comments as $comment)
                                <tr id="rowTbl{{ $comment->id }}">
                                    <td>{{ $comment->id }}</td>
                                    <td id="tblBreakTd">{{ $comment->text }}</td>

                                    <td>@if(isset($comment->creator->name)) {{ $comment->creator->name }} @else User deleted @endif </td>
                                    <td>{{ $status[$comment->status_id] }}</td>
                                    <td>{{ $comment->created_at }}</td>
                                    <td>
                                        <a href="{{ route('comments.edit', $comment->id) }}">
                                            <input type="button" class="btn btn-info" value="Edit"/>
                                        </a>
                                    </td>
                                    <td>
                                        <input type="button" class="btn btn-danger" value="Delete" onclick="setId({{ $comment->id }})" data-toggle="modal" data-target="#exampleModal">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                            @else
                                <label>Комментарии не добавлены</label>
                            @endif

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
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="deleteComment()">Удалить</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var idComment;

        function setId(id) {
            idComment=id;
        }

        function deleteComment(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type:'POST',
                url:'/delete_comment',
                data: {_token: CSRF_TOKEN, id: idComment},
                success:function(data){
                    $("#rowTbl" + idComment).remove();
                    //alert(data.success);
                }
            });
        }
    </script>
@endsection
