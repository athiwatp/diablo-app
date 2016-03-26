@extends('layouts.master')

@section('content')
    <div id="app"
         page="leaderboardsFilterPage"
         menu="leaderboardsPage"
         data="{{ $data }}"
    ></div>
@stop