@extends('layouts.app', [
    'fullscreen' => true,
    'title' => $set->name
])

@section('nav')
    <card-list-remote></card-list-remote>
@endsection

@section('content')
    @include('sets._setJumbotron')

    <card-list />
@endsection

@section('scripts')
    <script>
        window.store.commit({
            type: 'initialize',
            cards: {!! $cards !!}
        })
    </script>
@endsection