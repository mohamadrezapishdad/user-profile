@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Users List</h2>
  <p>All of the users are listed here:</p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Username</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
    	@foreach ($users as $user)
			<tr>
				<td>{{$user->name}}</td>
				<td>{{$user->username}}</td>
				<td>{{$user->email}}</td>
		    </tr>
		@endforeach
    </tbody>
  </table>
</div>

	
@endsection