@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Here you go! Have a good day!</div>
                    <div class="panel-body">
                        <img class="img-responsive" alt="{{$item->name}}" src="/{{$item->name}}.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
