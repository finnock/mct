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
            type: 'setLoading',
            loading: true
        })
        console.log('starting async call')
        window.axios.get('/api/collection')
            .then(function (response) {
                window.store.commit({
                    type: 'setLoadingSuccess',
                    cards: response.data
                })
            })
            .catch(function (error) {
                window.store.commit({
                    type: 'setLoadingFailed',
                    error: error
                })
                console.log(error);
            });
    </script>
@endsection