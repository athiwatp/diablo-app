@extends('layouts.master')

@section('content')
    <input type="hidden"
           id="type"
           value="{{ $type }}"
    >
    <div id="app" page="leaderboardsPage"></div>
@stop