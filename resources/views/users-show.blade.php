
@extends('layout')

<!-- 
	Lo que esta entre Comillas despues de Titile es Codigo de PHP
	 No es Blade por eso usamos comillas simples y no dobles 
	 Tambien hay que utilizar Comillas dobles para convertir las 
	 Variables.
-->

@section('title', "Usuario: {$id}")

@section('content')
	<h1> {{ $title }} </h1>
	
	<hr>

	<h2> Mostrando Detalle de Usuario: {{ $id }} </h2>
@endsection

@section('sidebar')
	<h1>Barra Lateral Nueva</h1>
@endsection