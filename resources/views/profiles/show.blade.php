@extends('layouts.master')

@section('content')
	<div id="app" 
		 menu="profilePage"
		 page="profileShowPage"
		 data="{{ $profile }}"
	></div>
@stop