@extends('layouts.master')

@section('content')
    <div id="app"
         page="heroesPage"
         menu="heroesPage"
         data="{{ $hero }}"
    ></div>
@stop

@section('js')
    <script src="/js/libs.js"></script>
@stop