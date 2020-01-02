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
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></td>
                                    <td>@if ($user->is_admin == 1) admin @else user @endif</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        @if ($user->is_admin != 1)

                                            <form action="{{ route('users.destroy', [$user->id])}}" method="POST">
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
