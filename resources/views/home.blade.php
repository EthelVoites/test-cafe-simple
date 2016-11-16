@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Hello {{\Auth::user()->name}}, what would you like to drink?</div>

                    <div class="panel-body">
                            @foreach($items as $item)
                                    <a class="btn btn-default" href="/buy/{{$item->id}}">One {{$item->name}}, please</a>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
