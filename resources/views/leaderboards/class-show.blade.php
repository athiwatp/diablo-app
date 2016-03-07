@extends('layouts.master')

@section('content')
    <div id="app"
         page="leaderboardsClassShowPage"
         menu="leaderboardsPage"
         data="{{ $data }}"
    ></div>
@stop