@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User</div>

                    <div class="card-body">
                        <table>
                            <thead>

                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->middle_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->sex }}</td>
                                    <td>{{ $user->birthday }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
