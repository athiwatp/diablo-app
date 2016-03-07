@extends('layouts.master')

@section('content')
	<div id="app" 
		 menu="profilePage"
		 page="profileSearchPage"
		 data="{{ $profile }}"
	></div>
@stop