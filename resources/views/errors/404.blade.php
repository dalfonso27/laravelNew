
@extends('layout')

@section('title', "Error")

@section('content')
	<h1> Pagina no encontrada </h1>
	
	<p> 
		<!-- Diferentes Modos  de Crear Rutas -->
		<!-- <a href="{{ url('usuarios')}}"> Regresar </a> -->
		<!-- <a href="{{ url()->previous() }}"> Regresar al listado de usuarios </a> -->
		<a href="{{ route('users.index') }}"> Regresar al listado de usuarios </a>
	</p>
@endsection