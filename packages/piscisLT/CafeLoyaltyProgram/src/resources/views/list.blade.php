@extends('loyalty_program::layout')

@section('subcontent')

    <div class="table-responsive">
        <table class="table  table-striped table-hover">
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Points</th>
                <th>Level</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->loyaltyOrNew()->points}}</td>
                    <td>{{$user->loyaltyOrNew()->level}}</td>
                    <td class="text-right">
                        <form action="{{route('loyalty.add_points', ['user_id' => $user->id])}}" method="post" class="form-inline">
                            <fieldset>
                                {{csrf_field()}}
                                <input name="points" type="number" class="form-control" placeholder="Points"/>
                                <button type="submit" class="btn btn-success">Add</button>
                            </fieldset>
                        </form>
                    </td>
                    <td>
                        <a href="{{route('loyalty.user_log', $user->id)}}" class="btn btn-default">Log</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@stop
