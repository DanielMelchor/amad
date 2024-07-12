@extends('layouts.principal')
@section('css_principal')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/multi-select/css/multi-select.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/select2/css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('title')
	Listado de Usuarios
@endsection
@section('content')
	@if (session('success'))
	    <div class="col-sm-12">
	        <div class="alert alert-success alert-dismissible fade show" role="alert">
	            {{ session('success') }}
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	            	<span aria-hidden="true">&times;</span>
                </button>
	        </div>
	    </div>
	@endif
	<br>
	<div class="content-fluid">
		<br>
		<div class="row justify-content-center">
			<div class="col-md-10 offset-md-1">
				@php $Id= Crypt::encrypt($usuario->id); @endphp
				<form role="form" method="POST" action="{{ route('actualizar_usuario', $Id) }}">
					@csrf
					<div class="card card-navy">
						<div class="card-header">
	        				<div class="row">
		                        <div class="col-md-4">Edición de Usuario</div>
	        					<div class="col-md-2 offset-md-4">
	        						<button type="submit" class="btn btn-sm btn-block verde" title="Guardar"><i class="fas fa-save"></i> Guardar</button>
	        					</div>
	        					<div class="col-md-2">
	        						<a href="{{ route('usuarios') }}" class="btn btn-sm btn-block rojo" title="Rregresar a lista de familias"><i class="fas fa-sign-out-alt"></i> Cerrar</a>
	        					</div>
		                    </div>
	        			</div>
						<div class="card-body">
							<div class="row">
								<div class="input-group col-md-4 offset-md-1 mb-1">
							  		<div class="input-group-prepend">
								    	<span class="input-group-text" id="basic-addon1">Usuario</span>
								  	</div>
								  	<input type="text" class="form-control" placeholder="Usuario" aria-label="Username" aria-describedby="addon-wrapping" id="username" name="username" value="{{ $usuario->username }}" autofocus required>
								</div>
								<div class="input-group col-md-6 mb-1">
							  		<div class="input-group-prepend">
								    	<span class="input-group-text" id="basic-addon1">Nombre</span>
								  	</div>
								  	<input type="text" class="form-control" placeholder="Nombre de usuario" aria-label="name" aria-describedby="addon-wrapping" id="name" name="name" value="{{ $usuario->name }}" required>
								</div>
							</div>
							<div class="row">
	        					<div class="input-group col-md-10 offset-md-1 mb-1">
							  		<div class="input-group-prepend">
								    	<span class="input-group-text" id="email">Correo electrónico</span>
								  	</div>
								  	<input type="email" class="form-control" placeholder="" aria-label="email" aria-describedby="addon-wrapping" id="email" name="email" value="{{ $usuario->email }}">
								</div>
	        				</div>
			        		<hr>
			        		<div class="row">
			        			<div class="col-md-5 offset-md-3">
		        					<select id='callbacks' name="callbacks[]" multiple='multiple'>
										@foreach($roles as $r)
											<option value='{{ $r->id}}'>{{ $r->name }}</option>
										@endforeach
									</select>	
			        			</div>
			        		</div>
	        			</div>
	        			<div class="card-footer">
	        			</div>
        			</div>
				</form>
			</div>
		</div>
	</div>
@endsection
@section('js_principal')
	<script src="{{ asset('assets/multi-select/js/jquery.multi-select.js') }}"></script>
	<script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
	<script type="text/javascript">
		$('#callbacks').multiSelect({
			selectableHeader: "<div class='custom-header text-center'>Roles</div>",
			selectionHeader: "<div class='custom-header text-center'>Otorgados</div>",
	      afterSelect: function(values){
	        //alert("Select value: "+values);
	      },
	      afterDeselect: function(values){
	        //alert("Deselect value: "+values);
	      }
	    });
	    var x = [];
	    @foreach ($roles_asignados as $ra)
	    	x.push("{{ $ra['role_id'] }}");
	    @endforeach
	    $('#callbacks').multiSelect('select', x);
	</script>
@endsection