@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(isset($pair->id))
                    <div class="alert alert-success" style="margin-bottom:0"><h5 style="margin-bottom:0"><b>The Results Are In</b></h5> You have <b>{{ $pair->pair->name }}</b> for Secret Santa.</div>
                @else
                    <div class="alert alert-success" style="margin-bottom:0"><h5 style="margin-bottom:0"><b>You're Registered</b></h5> Your name has been registered for Secret Santa. Names will be selected on <b>{{ config('santa.dates.pulled')->format('M d, Y h:i a') }}</b>, you will receive the results via email. Your results will also be listed here.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
