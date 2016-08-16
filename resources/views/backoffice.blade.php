@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Tere kohvikuomanik! Siin on meie kliendid:</div>

                    <div class="panel-body">
                        <ul>
                            @foreach($users as $user)
                                <li>{{$user->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
