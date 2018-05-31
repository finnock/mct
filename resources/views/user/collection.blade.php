@extends('layouts.app', ['fullscreen' => true])

@section('nav')
    <card-list-remote></card-list-remote>
@endsection

@section('content')
    <card-list src="{{ $apiSrc }}"/>
@endsection