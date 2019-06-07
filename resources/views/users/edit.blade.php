
@extends('layout')

<!-- 
	Lo que esta entre Comillas despues de Titile es Codigo de PHP
	 No es Blade por eso usamos comillas simples y no dobles 
	 Tambien hay que utilizar Comillas dobles para convertir las 
	 Variables.
-->

@section('title', "Editar Usuario")

@section('content')
	<h1> {{ $title }} </h1>
	
	<hr>

	@if ($errors->any())
		<div class="alert alert-danger">
		<p><strong> Por Favor Corrija los siguientes Errores </strong></p>
	- 	<ul>
			@foreach ($errors->all() as $error)
				<li> {{ $error }} </li>
			@endforeach
		</ul> 
		</div>
	@endif
	<form method="POST" action="{{ route('users.update',['id' => $user->id ]) }}">
		{{ method_field('PUT') }}
		{{ csrf_field() }}
		
		<div class="form-group row">
			<label for="name" class="col-sm-2 form-control-label">Nombre : </label>
			<div class="col-sm-6">
				<input type="text" class="form-control form-control-sm" name="name" id="name" placeholder="Pedro Perez" value="{{ old('name', $user->name) }}">
				@error('name')
					<p class= "text-danger"> <small>{{ $message }}</small></p>
					<!-- <p class= "text-danger"> <small>{{ $errors->first('name')}}</small></p> -->
				@enderror
			</div>
		</div>
		<div class="form-group row">
			<label for="email" class="col-sm-2 form-control-label">Correo : </label>
			<div class="col-sm-6">
				<input type="text" class="form-control form-control-sm" name="email" id="name" placeholder="newmail@styde.net" value="{{ old('email',$user->email) }}">
				@error('email')
					<p class= "text-danger"> <small>{{ $message }}</small></p>
					<!-- <p class= "text-danger"> <small>{{ $errors->first('email')}}</small></p> -->
				@enderror
			</div>
		</div>
		<div class="form-group row">
			<label for="password" class="col-sm-2 form-control-label">Password : </label>
			<div class="col-sm-6">
				<input type="password" class="form-control form-control-sm" name="password" id="password" placeholder="Mayor a 6 caracteres">
				@error('password')
					<p class= "text-danger"> <small>{{ $message }}</small></p>
					<!-- <p class= "text-danger"> <small>{{ $errors->first('password')}} --></small></p>
				@enderror
			</div>
		</div>

		<button type="Submit" class="btn btn-primary"> Actualizar Usuario </button>
		<p>
			<a href="{{ route('users.index') }}"> Regresar al listado de usuarios </a>
		</p>
	</form>

 
@endsection

@section('sidebar')
	<h1>Barra Lateral Nueva</h1>
@endsection