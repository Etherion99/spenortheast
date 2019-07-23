@extends('layouts.template')

@section('content')
	@if(Auth::user())
	<div class="modal fade" tabindex="-1" role="dialog" id="modal-member">
		<div class="modal-dialog modal-dialog-centered" role="document">
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
						<input type="text" class="form-control name" name="name" id="edit-member-name">
					</div>
					<div class="alert alert-danger" id="alert-edit-member-name">
						No puedes dejar este campo vacio
					</div>
					<div class="form-group">
						<label for="position">Cargo</label>
						<input type="text" class="form-control position" name="position" id="edit-member-position">
					</div>
					<div class="alert alert-danger" id="alert-edit-member-position">
						No puedes dejar este campo vacio
					</div>
					<div class="row mt-4 d-flex justify-content-center">
						<div class="fake-file">
							<button class="btn btn-main"><i class="fas fa-camera mr-2"></i>Subir Imagen</button>
							<input type="file" accept="image/*" onchange="loadPhoto('modal-member')">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-main mx-2" data-dismiss="modal">Cancelar</button>
					<button class="btn btn-main mx-2" onclick="saveMemberData({{$chapter->id}})">Terminar</button>
				</div>
			</div>
		</div>
	</div>	
	@endif
	<div class="row mx-0">
		<section class="my-5 col-9 pr-3">
			<div class="row col-12 mx-0 d-flex justify-content-center">
				<div class="col-10 row">
					<div class="mt-5 col-12">
						<h1 class="text-center">
							<strong>{{ $chapter->name }}</strong>
						</h1>
					</div>
					<div class="my-4 col-12">
						<div class="col-6 offset-3">
							<img src="{{ asset('/images/chapters/' . $chapter->id . '.' . $chapter->extension )}}" class="img-fluid photo">
						</div>						
					</div>
					<div class="my-4">
						{!! $chapter->description !!}
					</div>
					<div class="col-12 my-3 px-0">
						<h3 class="text-center">
							<strong>Junta Directiva</strong>
						</h3>
					</div>
					<div class="col-12 row my-5">
						@foreach ($members as $member)
							<div class="col-4 p-3 member" id="member-{{ $member->id }}">
								<img src="{{asset('/images/members/' . $member->id . '.' . $member->extension)}}" class="img-fluid photo">
								<div class="row d-flex justify-content-center my-2">
									<strong class="name text-center">{{ $member->name }}</strong>
								</div>
								<div class="row d-flex justify-content-center my-2">
									<span class="position text-center">{{ $member->position }}</span>
								</div>
								@if(Auth::user())
								<div class="row d-flex justify-content-center my-2">
									<button class="btn btn-main" data-toggle="modal" data-target="#modal-member" data-id="{{ $member->id }}" data-operation="edit"><i class="fas fa-pencil-alt mr-2"></i>Editar</button>
									<button class="btn btn-main" onclick="removeMember({{ $member->id }})"><i class="fas fa-times mr-2"></i>Eliminar</button>
								</div>
								@endif
							</div>
						@endforeach
						@if(Auth::user())
							<div class="col-12 d-flex justify-content-center mt-5">
								<button class="btn btn-main" data-toggle="modal" data-target="#modal-member" data-operation="add"><i class="fas fa-plus mr-2"></i>Añadir</button>
							</div>
						@endif
					</div>	
				</div>
			</div>
		</section>
		<aside class="my-5 col-3">
			@include('layouts.aside', compact('indicators'))
		</aside>
	</div>	
@endsection