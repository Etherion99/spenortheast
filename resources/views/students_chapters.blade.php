@extends('layouts.template')

@section('content')
	<div class="row mx-0">
		<section class="my-5 col-9 pr-3">
			<div class="row col-12 mx-0 d-flex justify-content-center">
				<div class="col-10">
					@foreach ($chapters as $chapter)
					<div class="col-4 p-3 chapter" id="chapter-{{ $chapter->id }}">
						<a href="/capitulos_estudiantiles/{{ $chapter->id }}">
							<img src="{{asset('/images/chapters/' . $chapter->id . '.' . $chapter->extension)}}" class="img-fluid photo">
						</a>
						<div class="row d-flex justify-content-center my-2">
							<strong class="name text-center">{{ $chapter->name }}</strong>
						</div>
						@if(Auth::user())
						<div class="row d-flex justify-content-center my-2">
							<button class="btn btn-main" data-toggle="modal" data-target="#modal-chapter" data-id="{{ $chapter->id }}" data-operation="edit"><i class="fas fa-pencil-alt mr-2"></i>Editar</button>
							<button class="btn btn-main" onclick="removechapter({{ $chapter->id }})"><i class="fas fa-times mr-2"></i>Eliminar</button>
						</div>
						@endif
					</div>
					@endforeach
				</div>
			</div>
		</section>
		<aside class="my-5 col-3 pl-3">
			aside
		</aside>
	</div>	
@endsection
