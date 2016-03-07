@extends('layouts.master')

@section('content')
    <div id="app"
         page="leaderboardsTeamShowPage"
         menu="leaderboardsPage"
         data="{{ $data }}"
    ></div>
@stop