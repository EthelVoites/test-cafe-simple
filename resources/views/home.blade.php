@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Tere, {{\Auth::user()->name}}, mida Sulle?</div>

                    <div class="panel-body">
                            @foreach($items as $item)
                                    <a class="btn btn-default" href="/buy/{{$item->id}}">Üks {{$item->name}}, palun</a>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
