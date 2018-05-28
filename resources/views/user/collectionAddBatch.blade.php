@extends('layouts.app')

@section('content')
    <div class="row mt-2">
        <div class="col-lg-12">
            <h3>Add Cardbatch</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <form action="{{ url('/collection') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="cardBatch">Paste export from MTGArena</label>
                    <textarea class="form-control" id="cardBatch" name="cardBatch" placeholder="1 Plains (XLN) 150" rows="20"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-success" style="margin: 5px 16px;"><i class="fa fa-plus"></i>&nbsp;Add Cards</button>
                </div>
            </form>
        </div>
        <div class="col-sm-3">
            <img style="width: 95%; margin: 10px;" src="{{ \App\Card::backImagePath() }}">
        </div>
    </div>
@endsection