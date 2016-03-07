@extends('layouts.master')

@section('content')
	<div id="app" 
		 menu="profilePage"
		 page="profileIndexPage"
		 data="{{ $data }}"
	></div>
@stop