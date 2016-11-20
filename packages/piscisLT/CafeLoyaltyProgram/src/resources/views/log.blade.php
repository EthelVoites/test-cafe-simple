@extends('loyalty_program::layout')

@section('subcontent')
    <div class="table-responsive">
        <table class="table  table-striped table-hover">
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Action</th>
                <th>Points</th>
            </tr>
            @if($user->loyaltyLog->isEmpty())
                <tr>
                    <td colspan="4">Log is empty</td>
                </tr>
            @else
                @foreach($user->loyaltyLog as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->created_at->format('Y-m-d H:i:s')}}</td>
                        <td>{{$item->action}}</td>
                        <td>{{$item->points}}</td>
                    </tr>
                @endforeach
            @endif
            <tr>
                <td colspan="3" class="text-right"><strong>This month points:</strong></td>
                <td>{{$user->loyaltyOrNew()->points}}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"><strong>All time points:</strong></td>
                <td>{{$user->loyaltyOrNew()->countAllPoints()}}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"><strong>Current level:</strong></td>
                <td>{{$user->loyaltyOrNew()->level}}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"><strong>Next level:</strong></td>
                <td>{{$user->loyaltyOrNew()->countLevel()}}</td>
            </tr>
        </table>
    </div>
@stop
