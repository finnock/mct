@extends('layouts.app', [
    'fullscreen' => true,
    'title' => $set->name
])

@section('nav')
    <card-list-remote></card-list-remote>
@endsection

@section('content')
    @include('sets._setJumbotron')

    <card-list src="{{ route('api.set.show', ['code' => $set->code]) }}"/>
@endsection