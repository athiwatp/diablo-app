@extends('structure::master')

@section('content-header')
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">List</h3>
                    <div class="box-tools pull-right">

                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                    	<thead>
                    		<tr>
                                <th>ID</th>
                    			<th>Name</th>
                                <th>Email</th>
                                <th>Edit</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		@foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><a href="{{ route('users.edit', $user->id) }}">Edit</a></td>
                                </tr>
                            @endforeach
                    	</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop