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

                        @if(!$comments->isEmpty())
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('messages.text')</th>
                                    <th scope="col">@lang('messages.creator')</th>
                                    <th scope="col">@lang('messages.status')</th>
                                    <th scope="col">@lang('messages.created_at')</th>
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
                                                <input type="button" class="btn btn-info" value="@lang('messages.edit')"/>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route("comments.destroy", $comment->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <input class="btn btn-danger" type="submit" value="@lang('messages.delete')" />
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <label>@lang('messages.no_comments_added')</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
