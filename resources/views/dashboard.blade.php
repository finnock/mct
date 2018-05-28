@extends('layouts.app')

@section('content')
    <div class="row py-3">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="card">
                <h3 class="card-header">Collection of {{ Auth::user()->name }}</h3>
                <div class="card-body">
                    <div class="card-text">
                        <p>{{ Auth::user()->cards()->count() }} unique cards</p>
                        <p>{{ $cardCount }} cards in total</p>
                        <p>weighing {{ round(($cardCount * 1.8 / 1000), 2) }} kg in total and stack height of {{ round(($cardCount * 0.305 / 10) , 1) }} cm.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection