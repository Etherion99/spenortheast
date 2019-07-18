@extends('layouts.template')

@section('content')
	@if(Auth::user())
	<div class="modal fade" tabindex="-1" role="dialog" id="modal-member">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header row d-flex align-items-center">
					<h3 class="modal-title-main"></h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
					<button class="btn btn-main mx-2" onclick="saveMemberData()">Terminar</button>
				</div>
			</div>
		</div>
	</div>	
	@endif
	<div class="row mx-0">
		<section class="my-5 col-9 pr-3">
			<div class="row col-12 mx-0 d-flex justify-content-center">
				<div class="col-10">
					<div class="d-flex justify-content-center">
						<img src="{{asset('/images/about_group.' . $images['about_group'])}}" alt="Junta Directiva SPE Northeast Colombia Section" class="img-fluid photo">					
					</div>
					@if(Auth::user())
					<div class="row my-2 d-flex justify-content-center">
						<div class="fake-file" id="edit-about_group">
							<button class="btn btn-main"><i class="fas fa-pencil-alt mr-2"></i>Editar</button>
							<input type="file" accept="image/*" onchange="editPhoto('about_group', 'main')">
						</div>
					</div>						
					@endif					
					<div class="mt-4">
						<h2 class="text-center"><strong>Quienes somos</strong></h2>
						<br>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum eveniet voluptatum quas odit expedita saepe, sunt libero quaerat, rem iste perferendis voluptas est corrupti. Animi delectus dolore, dicta tenetur ipsam?</p>
						<br>
						<h2 class="text-center"><strong>Misión</strong></h2>
						<br>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum eveniet voluptatum quas odit expedita saepe, sunt libero quaerat, rem iste perferendis voluptas est corrupti. Animi delectus dolore, dicta tenetur ipsam?</p>
						<br>
						<h2 class="text-center"><strong>Visión</strong></h2>
						<br>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum eveniet voluptatum quas odit expedita saepe, sunt libero quaerat, rem iste perferendis voluptas est corrupti. Animi delectus dolore, dicta tenetur ipsam?</p>
						<br>						
					</div>
					<div class="mt-3">
						<h2 class="text-center"><strong>Nuestra Junta Directiva</strong></h2>
						<br>
						<div class="row d-flex justify-content-center">
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
			</div>
		</section>
		<aside class="my-5 col-3 pl-3">
			aside
		</aside>
	</div>	
@endsection
