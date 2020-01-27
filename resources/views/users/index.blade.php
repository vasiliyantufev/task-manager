@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('messages.title')</th>
                                <th scope="col">@lang('messages.role')</th>
                                <th scope="col">@lang('messages.created_at')</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($users as $user)
                                <tr id="rowTbl{{ $user->id }}">
                                    <td>{{ $user->id }}</td>
                                    <td id="tblBreakTd"><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></td>
                                    <td>@if ($user->is_admin) admin @else user @endif</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        @if (Auth::user()->isAdmin() && !$user->is_admin)
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

@endsection
