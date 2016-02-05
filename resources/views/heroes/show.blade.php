@extends('master')

@section('content')
    <input type="hidden" id="hero_id" value="{{ $id }}">
    <div id="app" page="heroesPage"></div>
@stop

@section('js')
    <script src="/js/libs.js"></script>
@stop