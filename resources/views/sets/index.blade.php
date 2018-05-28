@extends('layouts.app')

@section('content')
    <h2>Core Sets</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th></th>
            <th>Code</th>
            <th>Name</th>
            <th>Cards</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($cores as $set)
            <tr>
                <td><i class="img-rounded ss-pill ss ss-2x ss-fw ss-common ss-{{ strtolower($set->code) }}"></i></td>
                <td>{{ $set->code }}</td>
                <td>{{ $set->name }}</td>
                <td>{{ $set->cardCount }}</td>

                <td>
                    <a class="btn btn-sm btn-primary" href="/sets/{{ $set->code }}">
                        <span class="glyphicon glyphicon-folder-open "></span>
                        &nbsp;Show Set
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2>Expansion Sets</h2>

    <table class="table table-striped">
        <thead>
        <tr>
            <th></th>
            <th>Code</th>
            <th>Name</th>
            <th>Block</th>
            <th>Cards</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($expansions as $set)
            <tr>
                <td><i class="img-rounded ss-pill ss ss-2x ss-fw ss-common ss-{{ strtolower($set->code) }}"></i></td>
                <td>{{ $set->code }}</td>
                <td>{{ $set->name }}</td>
                <td>{{ $set->block }}</td>
                <td>{{ $set->cardCount }}</td>

                <td>
                    <a class="btn btn-sm btn-primary" href="/sets/{{ $set->code }}">
                        <span class="glyphicon glyphicon-folder-open "></span>
                        &nbsp;Show Set
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection