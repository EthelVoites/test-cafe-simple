@extends('layouts.app')

@section('content')

    @if($errors)
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger">{{$error}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if(Session::has('message'))
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <p class="alert alert-success">{{ Session::get('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="pull-left">How loyal member are you?</div>
                        <div class="pull-right">
                            @foreach($loyaltyMenu as $item)
                                <a href="{{$item['url']}}" class="btn btn-{{$item['btnClass']}} btn-xs">{{$item['title']}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="panel-body">
                        @yield('subcontent')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop