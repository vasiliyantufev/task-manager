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

                            @foreach($comments as $comment)

                                <tbody>
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ $comment->text }}</td>
                                    <td>@if(isset($comment->creator->name)) {{ $comment->creator->name }} @else User deleted @endif </td>
                                    <td>{{ $status[$comment->status] }}</td>
                                    <td>{{ $comment->created_at }}</td>
                                    <td>
                                        <a href="{{ route('comments.edit', $comment->id) }}">
                                            <input type="button" class="btn btn-info" value="Edit"/>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('comments.destroy', [$comment->id])}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" class="btn btn-danger" value="Delete"/>
                                        </form>
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
