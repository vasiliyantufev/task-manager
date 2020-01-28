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
                                            <form action="{{ route("users.destroy", $user->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <input class="btn btn-danger" type="submit" value="@lang('messages.delete')" />
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
