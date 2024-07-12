@extends('layouts.principal')
@section('css_principal')
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
	<div class="row">
        <div class="col">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <br>
	<div class="content-fluid">
		<div class="row justify-content-center">
	        <div class="col-md-12">
	            <div class="card">
	                <div class="card-header">
	                    <div class="row">
	                        <div class="col-md-4">
								<h3>{{ __('Usuarios') }}</h3>
							</div>
							<div class="col-md-2 offset-md-4">
	                            <button type="button" class="btn btn-sm btn-block btn-primary" data-toggle="modal" data-target="#usuarioModal" title="Crear nuevo permiso"><i class="fas fa-plus"></i> Agregar</button>
	                        </div>
							<div class="col-md-2">
								<a href="{{ route('home') }}" class="btn btn-sm btn-block rojo"><i class="fas fa-sign-out-alt"></i> Salir</a>
							</div>
	                    </div>
	                </div>
	                <div class="card-body">
	                	<div class="row text-center">
							<div class="col-md-10 offset-md-1">
								<table id="tblUsuarios" class="table table-sm table-striped table-hover" style="width:100%">
				          			<thead>
										<tr>
											<th>Usuario</th>
											<th>Nombre</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
										@foreach($usuarios as $u)
											<tr>
												<td>{{ $u->username }}</td>
												<td>{{ $u->name }}</td>
												@php $Id= Crypt::encrypt($u->id); @endphp
												<td>
													@can('editar-usuario')
													<a href="{{ route('editar_usuario', $Id) }}" class="btn btn-sm btn-warning" title="Editar"><i class="fa fa-edit"></i> Editar</a>
													@endcan
													@can('reiniciar-contrasena')
													<a href="{{ route('actualizar_pass', $Id) }}" class="btn btn-sm btn-primary" title="Re iniciar contraseña"><i class="fa fa-edit"></i> Reiniciar</a>
													@endcan
												</td>
											</tr>
										@endforeach
									</tbody>
				          		</table>
							</div>
						</div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="usuarioModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="usuarioModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<form role="form" method="POST" action="{{ route('grabar_usuario') }}">
	      			@csrf
	        		<div class="card card-navy">
	        			<div class="card-header">
	        				<div class="row">
	        					<div class="col-md-4">
	        						Nuevo Usuario
	        					</div>
	        					<div class="col-md-2 offset-md-4">
	        						<button type="submit" class="btn btn-sm btn-block verde" title="Grabar"><i class="fas fa-save"></i> Guardar</button>
	        					</div>
	        					<div class="col-md-2">
	        						<button type="button" class="btn btn-sm btn-block rojo" title="Regresar a lista de familias" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
	        					</div>
	        				</div>
	        			</div>
	        			<div class="card-body">
	        				<div class="row">
	        					<div class="input-group col-md-10 offset-md-1 mb-1">
							  		<div class="input-group-prepend">
								    	<span class="input-group-text" id="basic-addon1">Usuario</span>
								  	</div>
								  	<input type="text" class="form-control" placeholder="Usuario" aria-label="Username" aria-describedby="addon-wrapping" id="username" name="username" value="{{ old('username')}}" autofocus required>
								</div>
	        				</div>
	        				<div class="row">
	        					<div class="input-group col-md-10 offset-md-1 mb-1">
							  		<div class="input-group-prepend">
								    	<span class="input-group-text" id="sname">Nombre</span>
								  	</div>
								  	<input type="text" class="form-control" placeholder="Nombre de usuario" aria-label="Username" aria-describedby="addon-wrapping" id="name" name="name" value="{{ old('name')}}">
								</div>
	        				</div>
	        				<div class="row">
	        					<div class="input-group col-md-10 offset-md-1 mb-1">
							  		<div class="input-group-prepend">
								    	<span class="input-group-text" id="email">Correo electrónico</span>
								  	</div>
								  	<input type="email" class="form-control" placeholder="" aria-label="email" aria-describedby="addon-wrapping" id="email" name="email" value="{{ old('email')}}">
								</div>
	        				</div>
	        			</div>
	        		</div>
	      		</form>
	    	</div>
	  	</div>
	</div>
@endsection
@section('js_principal')
	<script type="text/javascript">
		//========================================================================
		// inicializar librerias
		//========================================================================
		$(function () {
			$('.select2').select2()
			$('.select2bs4').select2({
		      theme: 'bootstrap4'
		    })
		});

		$('#usuarioModal').on('shown.bs.modal', function() {
		  $('#username').focus();
		});

		$(function () {
	        $('#tblUsuarios').DataTable({
	          "paging": true,
	          "lengthChange": false,
	          "searching": true,
	          "ordering": true,
	          "info": true,
	          "autoWidth": true,
	          language: {
	                "sProcessing":     "Procesando...",
	                "sLengthMenu":     "Mostrar _MENU_ registros",
	                "sZeroRecords":    "No se encontraron resultados",
	                "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
	                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	                "sInfoPostFix":    "",
	                "sSearch":         "Buscar:",
	                "sUrl":            "",
	                "sInfoThousands":  ",",
	                "sLoadingRecords": "Cargando...",
	                "oPaginate": {
	                                "sFirst":    "Primero",
	                                "sLast":     "Último",
	                                "sNext":     "Siguiente",
	                                "sPrevious": "Anterior"
	                            }
	            },
	            dom: 'Bfrtip',
	        });
    	});
	</script>
@endsection