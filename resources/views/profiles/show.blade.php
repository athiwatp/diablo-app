@extends('layouts.master')

@section('content')
	<div id="app" 
		 menu="profilePage"
		 page="profilePage"
		 data="{{ $profile }}"
	></div>
@stop