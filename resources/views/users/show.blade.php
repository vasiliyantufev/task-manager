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
                                        <label for="title">@lang('messages.nick_name'):</label>
                                        {{ $user->name }}
                                    </div>

                                    <div class="form-group">
                                        <label for="title">@lang('messages.e-mail'):</label>
                                        {{ $user->email }}
                                    </div>

                                    <div class="form-group">
                                        <label for="title">@lang('messages.first_name'):</label>
                                        {{ $user->first_name }}
                                    </div>

                                    <div class="form-group">
                                        <label for="title">@lang('messages.middle_name'):</label>
                                        {{ $user->middle_name }}
                                    </div>

                                    <div class="form-group">
                                        <label for="title">@lang('messages.last_name'):</label>
                                        {{ $user->last_name }}
                                    </div>

                                    <div class="form-group">
                                        <label for="title">@lang('messages.sex'):</label>
                                        @if ($user->sex == 1) @lang('messages.man') @else @lang('messages.woman') @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="title">@lang('messages.birthday'):</label>
                                        {{ $user->birthday }}
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
