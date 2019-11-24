@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pairs</div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Person 1</th>
                                <th>Person 2</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pairs as $pair)
                                <tr>
                                    <td>{{ $pair->user->name }}</td>
                                    <td>{{ $pair->pair->name }}</td>
                                    <td>{{ $pair->user->id === $pair->pair->id ? 'Self' : '' }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
