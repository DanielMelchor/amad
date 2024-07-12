@extends('adminlte::page')
@section('css')
	<link rel="stylesheet" href="{{ asset('assets/bootstrap-sweetalert-master/dist/sweetalert.css') }}">
	<style type="text/css">
		.verde {
			background-color: #97D700 !important;
		}
		.rojo {
			background-color: #EF3340 !important;
			color: white;
		}
		.azul {
			background-color: #10069F !important;
			color: white;
		}
	</style>
@stop

@section('js')
	<script src="{{ asset('assets/bootstrap-sweetalert-master/dist/sweetalert.min.js') }}"></script>
@endsection