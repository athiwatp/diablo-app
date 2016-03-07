@extends('layouts.master')

@section('content')
    <div id="app"
         page="leaderboardsTeamIndexPage"
         menu="leaderboardsPage"
         data="{{ $data }}"
    ></div>
@stop