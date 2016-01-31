@extends('master')

@section('content')
    <input type="hidden" id="hero_id" value="{{ $id }}">
@stop

@section('js')
    <script src="/js/pages/heroes/index.js" type="text/javascript"></script>
    <script src="http://www.diabloprogress.com/js1/d3-tooltips.js"></script>
@stop