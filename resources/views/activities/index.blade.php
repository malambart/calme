@extends('layouts.row')
@section('panel-heading')
    <h1>Journal de log</h1>
@endsection
@section('body')
        <table class="table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Model</th>
                <th>Model id</th>
                <th>Action</th>
                <th>User</th>
            </tr>
            </thead>
            <tbody>
            @foreach($activities as $activity)
                <tr>
                    <td>{{$activity->created_at}}</td>
                    <td>{{$activity->model}}</td>
                    <td>{{$activity->model_id}}</td>
                    <td>{{$activity->name}}</td>
                    <td>{{$activity->user->name}} ({{$activity->user_id}})</td>
                </tr>
            @endforeach
            </tbody>

        </table>


    {{ $activities->links() }}
@endsection    