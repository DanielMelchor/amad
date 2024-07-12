@extends('layouts.principal')
@section('title')
	__('Forbidden')
@endsection

@section('content')
    <div class="content-fluid">
		<div class="row justify-content-center">
	        <div class="col-md-12">
	            <div class="error-page">
	            	<h2 class="headline text-warning">403</h2>
	            	<div class="error-content">
	            		<h3><i class="fas fa-exclamation-triangle text-warning">&nbsp; Oops! Pagina no encontrada</i></h3>
	            		<p>{{ $exception->getMessage() }}</p>
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection
