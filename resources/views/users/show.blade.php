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

                                    <div class="form-group">
                                        <label for="title">Логин:</label>
                                        {{ $user->name }}
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Электронная почта:</label>
                                        {{ $user->email }}
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Имя:</label>
                                        {{ $user->first_name }}
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Отчество:</label>
                                        {{ $user->middle_name }}
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Фамилия:</label>
                                        {{ $user->last_name }}
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Пол:</label>
                                        @if ($user->sex == 1) Муж. @else Жен. @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Дата рождения:</label>
                                        {{ date('Y-m-d H:i:s', $user->birthday) }}
                                    </div>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
