
@extends('layout')

<!-- 
	Lo que esta entre Comillas despues de Titile es Codigo de PHP
	 No es Blade por eso usamos comillas simples y no dobles 
	 Tambien hay que utilizar Comillas dobles para convertir las 
	 Variables.
-->

@section('title', "Usuario: {$user->id}")

@section('content')
	<h1> {{ $title }} </h1>
	
	<hr>

	<h2> Mostrando Detalle de Usuario: {{ $user->id }} </h2>
	<p> <strong> Nombre del Usuario: </strong> {{ $user->name }} </p>
	<p> <strong> Correo Electronico: </strong> {{ $user->email }} </p>

	 
	<p> 
		<!-- Diferentes Modos  de Crear Rutas -->
		<!-- <a href="{{ url('usuarios')}}"> Regresar </a> -->
		<!-- <a href="{{ url()->previous() }}"> Regresar al listado de usuarios </a> -->
		<a href="{{ route('users.index') }}"> Regresar al listado de usuarios </a>
	</p>
@endsection

@section('sidebar')
	<h1>Barra Lateral Nueva</h1>
@endsection