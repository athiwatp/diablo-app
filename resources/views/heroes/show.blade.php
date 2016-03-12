@extends('layouts.master')

@section('content')
    <div id="app"
         page="heroesShowPage"
         menu="heroesPage"
         data="{{ $hero }}"
    ></div>
@stop

@section('js')
    <script src="/js/libs.js"></script>
@stop