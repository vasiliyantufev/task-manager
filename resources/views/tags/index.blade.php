@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tags</div>

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

                        <div class="form-group">
                            <a class="btn btn-primary" href="{{ route('tags.create') }}">Добавить tag</a>
                        </div>

                        @if(!$tags->isEmpty())
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Created_at</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($tags as $tag)
                                    <tr id="rowTbl{{ $tag->id }}">
                                        <td>{{ $tag->id }}</td>
                                        <td id="tblBreakTd">{{ $tag->name }}</td>
                                        <td>{{ $tag->created_at }}</td>
                                        <td>
                                            <a href="{{ route('tags.edit', $tag->id) }}">
                                                <input type="button" class="btn btn-info" value="Edit"/>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route("tags.destroy", $tag->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <input class="btn btn-danger" type="submit" value="Delete" />
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <label>Теги не добавлены</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
