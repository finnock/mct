@extends('layouts.app', ['fullscreen' => true])

@section('nav')
    <card-list-remote></card-list-remote>
@endsection

@section('content')
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