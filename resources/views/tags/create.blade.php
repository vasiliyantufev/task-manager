@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Tags</div>

                    <div class="card-body">


                        <form method="POST" action="{{ route('tags.store') }}">

                            @csrf

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


                            <div class="form-group">
                                <label for="title">Название</label>
                                <input id="title" type="text" class="form-control" name="title" required>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                    <a class="btn btn-primary" href="{{ route('tags.index') }}">Отмена</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
