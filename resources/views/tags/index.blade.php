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

                        <div class="form-group">
                            <a class="btn btn-primary" href="{{ route('tags.create') }}">@lang('messages.add_tag')</a>
                        </div>

                        @if(!$tags->isEmpty())
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('messages.title')</th>
                                    <th scope="col">@lang('messages.created_at')</th>
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
                                                <input type="button" class="btn btn-info" value="@lang('messages.edit')"/>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route("tags.destroy", $tag->id) }}" method="post">
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
                            <label>@lang('messages.no_tags_added')</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
