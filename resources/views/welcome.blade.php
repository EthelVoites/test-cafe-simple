@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Hello!</div>

                    <div class="panel-body">
                        <p>
                            Please log in to order
                        </p>
                        <div class="btn-group">
                            <a class="btn btn-default" href="{{ url('/login') }}">Login</a>
                            <a class="btn btn-default" href="{{ url('/register') }}">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
