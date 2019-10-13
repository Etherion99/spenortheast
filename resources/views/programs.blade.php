@extends('layouts.template')

@section('styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css">
@endsection

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js" defer></script>
	<script src="{{ asset('js/programs.js') }}" defer></script>
@endsection

@section('content')
	@if(Auth::user())
	<div class="modal fade" tabindex="-1" role="dialog" id="modal-program">
		<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header row d-flex align-items-center">
					<h3 class="modal-title-main mx-auto"></h3>
					<button type="button" class="close m-0" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>			
				</div>
				<div class="modal-body p-5">
					<div class="form-group">
						<label for="name">Nombre</label>
						<input type="text" class="form-control name" name="name" id="edit-program-name">
					</div>
					<div class="alert alert-danger" id="alert-edit-program-name">
						No puedes dejar este campo vacio
					</div>
					<div class="form-group">
						<label for="description">Descripción</label>
						<textarea name="description" class="form-control description" id="edit-program-description"></textarea>    
					</div>
					<div class="alert alert-danger" id="alert-edit-program-description">
						No puedes dejar este campo vacio
					</div>
					<div class="row mt-4 d-flex justify-content-center">
						<div class="fake-file">
							<button class="btn btn-main"><i class="fas fa-camera mr-2"></i>Subir Imagen</button>
							<input type="file" accept="image/*" onchange="loadPhoto('modal-program')">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-main mx-2" data-dismiss="modal">Cancelar</button>
					<button class="btn btn-main mx-2" onclick="saveProgramData()">Terminar</button>
				</div>
			</div>
		</div>
	</div>	
	@endif
	<div class="row mx-0">
		<section class="my-5 col-9 pr-3">
			<div class="row col-12 mx-0 d-flex justify-content-center">
				<div class="col-10 row">
					@foreach ($programs as $program)
					<div class="col-4 p-3 program" id="program-{{ $program->id }}">
						<a href="/programas/{{ $program->id }}">
							<img src="{{asset('/images/programs/' . $program->id . '.' . $program->extension)}}" class="img-fluid photo">
						</a>
						<div class="row d-flex justify-content-center my-2">
							<strong class="name text-center">{{ $program->name }}</strong>
						</div>
						@if(Auth::user())
						<div class="row d-flex justify-content-center my-2">
							<button class="btn btn-main" data-toggle="modal" data-target="#modal-program" data-id="{{ $program->id }}" data-operation="edit"><i class="fas fa-pencil-alt mr-2"></i>Editar</button>
							<button class="btn btn-main" onclick="removeProgram({{ $program->id }})"><i class="fas fa-times mr-2"></i>Eliminar</button>
						</div>
						@endif
					</div>
					@endforeach
				</div>
			</div>
			<div class="row col-12 mx-0 d-flex justify-content-center">
				@if(Auth::user())
				<div class="col-12 d-flex justify-content-center mt-5">
					<button class="btn btn-main" data-toggle="modal" data-target="#modal-program" data-operation="add"><i class="fas fa-plus mr-2"></i>Añadir</button>
				</div>
				@endif
			</div>
		</section>
		<aside class="my-5 col-3">
			@include('layouts.aside', compact('indicators'))
		</aside>
	</div>	
@endsection
