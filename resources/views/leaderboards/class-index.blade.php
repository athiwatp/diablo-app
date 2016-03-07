@extends('layouts.master')

@section('content')
    <div id="app"
         page="leaderboardsClassIndexPage"
         menu="leaderboardsPage"
         data="{{ $data }}"
    ></div>
@stop