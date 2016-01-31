@extends('structure::master')

@section('content-header')
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Create</h3>
                    <div class="box-tools pull-right">

                    </div>
                </div>
                <form action="{{ route('users.create') }}">
                    <div class="box-body">
                        @include('users.partials.form')
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
                        <input type="submit" class="btn btn-primary pull-right" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop