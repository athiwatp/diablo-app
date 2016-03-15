@extends('layouts.master')

@section('content')
    <div id="app"
         page="leaderboardsSeasonShowPage"
         menu="leaderboardsPage"
         data="{{ $data }}"
    ></div>
@stop