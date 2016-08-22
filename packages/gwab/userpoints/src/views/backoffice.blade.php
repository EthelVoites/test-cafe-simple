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
                                <li>{{$user->name}} &nbsp; | Tase:{{$user->point->level}} Punktid:<span class="userpoints-points">{{$user->point->points}}</span> &nbsp; <input type="number" style="width:60px" class="userpoints-input" min="0" /> <input type="hidden" class="userpoints-user-id" value="{{$user->id}}" />  <button class="userpoints-add-button">Lisa punkte</button></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
