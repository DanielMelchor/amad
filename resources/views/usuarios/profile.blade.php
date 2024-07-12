@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
    <style type="text/css">
        .nav-pills .nav-link.active,
        .show>.nav-pills .nav-link{
            background: #99CA3C !important;
            color: #000000 !important;
        }
        .numero{
            text-align: right;
        }
        .enlace_desactivado {
            pointer-events: none;
            cursor: default;
        }
    </style>
@endsection
@section('content')
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<h1>Perfil</h1>
<br>
<div class="row">
	<div class="col-md-10 offset-md-1">
		<form method="post" role="form" action="{{ route('perfil_actualizar') }}" enctype="multipart/form-data">
			@csrf
			<div class="row">
				<div class="col-md-2 offset-md-8">
	            	<button type="submit" class="btn btn-sm btn-block btn-success" title="Guardar"><i class="fas fa-save"></i> Guardar</button>
	            </div>
	            <div class="col-md-2">
	            	<a href="{{ route('home') }}" class="btn btn-sm btn-block btn-danger" title="Rregresar a lista unidad de medida"><i class="fas fa-sign-out-alt"></i> Salir</a>
	            </div>
			</div>
			<hr>
			<div class="card">
				<div class="card-header bg-light">
					<ul class="nav nav-pills nav-fill">
			            <li class="nav-item">
			                <a class="nav-link active" href="#generales" data-toggle="tab">Datos Generales</a>
			            </li>
			        </ul>
				</div>
				<div class="card-body">
					<div class="tab-content">
			            <div class="tab-pane active" id="generales">
			            	<br>
			            	<div class="row">
			            		<div class="col-md-2 offset-md-10">
			            			<a href="{{ route('contrasena') }}" class="btn btn-sm btn-block" style="background-color: #99CA3C;"><i class="fas fa-user-lock"> Cambiar Contraseña</i></a>
			            		</div>
			            	</div>
			            	@if( $registro->imagen == '')
			            	<div class="text-center">
								<img class="user-image elevation-2" src="{{ asset('assets/img/escudo.jpg')}}" alt="user profile">
							</div>
							@else
							<div class="text-center">
								<img class="user-image rounded-circle elevation-2" src="{{ asset('storage/') }}/{{ $registro->imagen }}" style="max-height: 200px;" alt="user profile">
							</div>
							@endif
							<br>
							<div class="row">
			                    <div class="col-md-10 offset-md-1">
			                    	<div class="custom-file">
	                                    <input type="file" class="custom-file-input form-control" id="imagen" name="imagen" aria-describedby="file" accept="image/*">
	                                    <label class="custom-file-label" for="archivoPdf">Seleccionar Archivo</label>
	                                </div>
			                    </div>
							</div>
							<hr>
			            	<div class="row">
								<div class="input-group col-md-10 offset-md-1 mb-1">
							  		<div class="input-group-prepend">
								    	<label class="input-group-text" for="dependencia">Dependencia&nbsp;&nbsp;</label>
								  	</div>
								  	<input type="text" class="form-control text-center" placeholder="Usuario" aria-label="dependencia" aria-describedby="addon-wrapping" id="dependencia" name="dependencia" value="{{ $dependencia->dependencia_nombre }} / {{ $dependencia->dependencia_nombre }}" disabled>
								</div>
							</div>
							<div class="row">
								<div class="input-group col-md-10 offset-md-1 mb-1">
							  		<div class="input-group-prepend">
								    	<label class="input-group-text" for="puesto">Puesto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
								  	</div>
								  	<input type="text" class="form-control text-center" placeholder="nombre del puesto" aria-label="puesto" aria-describedby="addon-wrapping" id="puesto" name="puesto" value="{{ $registro->puesto }}" autofocus required>
								</div>
							</div>
							<div class="row">
								<div class="input-group col-md-10 offset-md-1 mb-1">
							  		<div class="input-group-prepend">
								    	<label class="input-group-text" for="email">Correo electrónico</label>
								  	</div>
								  	<input type="mail" class="form-control text-center" placeholder="nombre del email" aria-label="email" aria-describedby="addon-wrapping" id="email" name="email" value="{{ $registro->email }}" required>
								</div>
							</div>
							<div class="row">
								<div class="input-group col-md-10 offset-md-1 mb-1">
							  		<div class="input-group-prepend">
								    	<label class="input-group-text" for="name">Nombre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
								  	</div>
								  	<input type="text" class="form-control text-center" placeholder="nombre del name" aria-label="name" aria-describedby="addon-wrapping" id="name" name="name" value="{{ $registro->name }}" required>
								</div>
							</div>
			            </div>
			        </div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection