@extends('layout')

@section('content')
	<h1> {{ $title }} </h1>
	
	<hr>
			
	<ul>
		@forelse ($users as $user)
			<li> 
				{{ $user->name }}, ({{ $user->email }}) 
				<!-- <a href="{{ url('usuarios/' . $user->id )}}"> Ver Detalles </a> -->
				<a href="{{ route('users.show',['id' => $user->id]) }}"> Ver Detalles </a> 
			</li>
		@empty
			<p>No hay usuarios Registrados</p>
		@endforelse 
	</ul>
@endsection