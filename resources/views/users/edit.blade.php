@extends('structure::master')

@section('content-header')
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit</h3>
                    <div class="box-tools pull-right">

                    </div>
                </div>
                <form method="POST" action="{{ route('users.update', $users->id) }}">
                    {{ csrf_field() }}
                    <input type="hidden" value="PATCH" name="_method">
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