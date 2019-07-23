@extends('layouts.template')

@section('styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css">
@endsection

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js" defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js" defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js" defer></script>
	<script src="{{ asset('js/events.js') }}" defer></script>
	<!--<script>
		var map;
		function initMap() {
	        map = new google.maps.Map(document.getElementById('event-map'), {
	            center: {lat: -34.397, lng: 150.644},
	            zoom: 8
	        });
	    }
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTnNpAIJTWpe_UqZbyA5z0OiXHy250zts&callback=initMap" defer></script>-->
@endsection

@section('content')
	@if(Auth::user())
	<div class="modal fade" tabindex="-1" role="dialog" id="modal-event">
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
						<label for="title">Título</label>
						<input type="text" class="form-control title" name="title" id="edit-event-title">
					</div>
					<div class="alert alert-danger" id="alert-edit-event-title">
						No puedes dejar este campo vacio
					</div>
					<div class="form-group">
						<label for="description">Descripción</label>
						<textarea name="description" class="form-control description" id="edit-event-description"></textarea>    
					</div>
					<div class="alert alert-danger" id="alert-edit-event-description">
						No puedes dejar este campo vacio
					</div>
					<div class="form-group">
						<label for="start_date">Fecha de inicio</label>
						<input type="text" class="form-control datetimepicker-input start_date" name="start_date" id="edit-event-start_date" data-toggle="datetimepicker" data-target="#edit-event-start_date">
					</div>
					<div class="alert alert-danger" id="alert-edit-event-start_date">
						No puedes dejar este campo vacio
					</div>
					<div class="form-group">
						<label for="end_date">Fecha de fin</label>
						<input type="text" class="form-control datetimepicker-input end_date" name="end_date" id="edit-event-end_date" data-toggle="datetimepicker" data-target="#edit-event-end_date">
					</div>
					<div class="alert alert-danger" id="alert-edit-event-end_date">
						No puedes dejar este campo vacio
					</div>
					<div class="form-group">
						<label for="place">Lugar</label>
						<input type="text" class="form-control place" name="place" id="edit-event-place">
					</div>
					<div class="alert alert-danger" id="alert-edit-event-place">
						No puedes dejar este campo vacio
					</div>
					<!--<div class="map my-5" id="event-map"></div>-->
					<div class="row mt-4 d-flex justify-content-center">
						<div class="fake-file">
							<button class="btn btn-main"><i class="fas fa-camera mr-2"></i>Subir Imagen</button>
							<input type="file" accept="image/*" onchange="loadPhoto('modal-event')">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-main mx-2" data-dismiss="modal">Cancelar</button>
					<button class="btn btn-main mx-2" onclick="saveEventData()">Terminar</button>
				</div>
			</div>
		</div>
	</div>	
	@endif
	<div class="row mx-0">
		<section class="my-5 col-9 pr-3">
			<div class="row col-12 mx-0">
				<div class="col-12 d-flex justify-content-center">
					<div class="nav nav-tabs col-10 justify-content-center" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active mx-5" id="recent-tab" data-toggle="tab" href="#recent" role="tab">Eventos Próximos</a>
						<a class="nav-item nav-link mx-5" id="soon-tab" data-toggle="tab" href="#soon" role="tab">Eventos Recientes</a>
					</div>
				</div>
				<div class="col-12 d-flex justify-content-center">
					<div class="tab-content col-10" id="nav-tabContent">
						<div class="tab-pane fade show active col-12" id="recent" role="tabpanel" aria-labelledby="recent-tab">
							@foreach ($soonEvents as $event)
							<div class="event row col-10 offset-1 mt-5 p-3" id="event-{{ $event->id }}">
								<div class="col-4 pr-4">
									<a href="/eventos/{{ $event->id }}">
										<img src="{{ asset('/images/events/' . $event->id . '.' . $event->extension )}}" class="img-fluid photo">		
									</a>
								</div>
								<div class="col-8 pl-4 h-25">
									<div class="row">
										<div class="col-8 pl-0 d-flex align-items-center">
											<a href="/eventos/{{ $event->id }}">
												<strong class="title">{{ $event->title }}</strong>
											</a>								
										</div>
										<div class="col-4 d-flex justify-content-center align-items-center">
											@if ($event->end_date != null)
											<div class="col-12 px-0">
												<div class="row col-12 d-flex justify-content-center px-0">
													<i class="fas fa-calendar-alt"></i>
													<strong class="ml-3 start_date">{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}</strong>
												</div>
												<div class="row col-12 d-flex justify-content-center px-0 mt-3">
													<i class="fas fa-calendar-alt"></i>
													<strong class="ml-3 end_date">{{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y H:i') }}</strong>
												</div>
											</div>									
											@else
											<i class="fas fa-calendar-alt"></i>
											<strong class="ml-3 start_date">{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}</strong>
											@endif							
										</div>
									</div>
									<div class="row mt-3 d-flex align-items-start">
										<p>
											<span class="description_preview">{!! $event->description_preview !!}...</span>
											<button class="more">
												<a href="/eventos/{{ $event->id }}">
													<span>Ver más</span>
												</a>
											</button>
										</p>
									</div>
									@if(Auth::user())
									<div class="row d-flex justify-content-center my-2">
										<button class="btn btn-main mx-3" data-toggle="modal" data-target="#modal-event" data-id="{{ $event->id }}" data-operation="edit"><i class="fas fa-pencil-alt mr-2"></i>Editar</button>
										<button class="btn btn-main mx-3" onclick="removeEvent({{ $event->id }})"><i class="fas fa-times mr-2"></i>Eliminar</button>
									</div>
									@endif
								</div>
							</div>
							@endforeach
						</div>
						<div class="tab-pane fade col-12" id="soon" role="tabpanel" aria-labelledby="soon-tab">
							@foreach ($recentEvents as $event)
							<div class="event row col-10 offset-1 mt-5 p-3" id="event-{{ $event->id }}">
								<div class="col-4 pr-4">
									<a href="/eventos/{{ $event->id }}">
										<img src="{{ asset('/images/events/' . $event->id . '.' . $event->extension )}}" class="img-fluid photo">		
									</a>
								</div>
								<div class="col-8 pl-4 h-25">
									<div class="row">
										<div class="col-8 pl-0 d-flex align-items-center">
											<a href="/eventos/{{ $event->id }}">
												<strong class="title">{{ $event->title }}</strong>
											</a>								
										</div>
										<div class="col-4 d-flex justify-content-center align-items-center">
											@if ($event->end_date != null)
											<div class="col-12 px-0">
												<div class="row col-12 d-flex justify-content-center px-0">
													<i class="fas fa-calendar-alt"></i>
													<strong class="ml-3 start_date">{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}</strong>
												</div>
												<div class="row col-12 d-flex justify-content-center px-0 mt-3">
													<i class="fas fa-calendar-alt"></i>
													<strong class="ml-3 end_date">{{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y H:i') }}</strong>
												</div>
											</div>									
											@else
											<i class="fas fa-calendar-alt"></i>
											<strong class="ml-3 start_date">{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}</strong>
											@endif							
										</div>
									</div>
									<div class="row mt-3 d-flex align-items-start">
										<p>
											<span class="description_preview">{!! $event->description_preview !!}...</span>
											<button class="more">
												<a href="/eventos/{{ $event->id }}">
													<span>Ver más</span>
												</a>
											</button>
										</p>
									</div>
									@if(Auth::user())
									<div class="row d-flex justify-content-center my-2">
										<button class="btn btn-main mx-3" data-toggle="modal" data-target="#modal-event" data-id="{{ $event->id }}" data-operation="edit"><i class="fas fa-pencil-alt mr-2"></i>Editar</button>
										<button class="btn btn-main mx-3" onclick="removeEvent({{ $event->id }})"><i class="fas fa-times mr-2"></i>Eliminar</button>
									</div>
									@endif
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>		
			</div>
			<div class="row col-12 mx-0 d-flex justify-content-center">
				@if(Auth::user())
				<div class="col-12">
					
				</div>
				<div class="col-12 d-flex justify-content-center mt-5">
					<button class="btn btn-main" data-toggle="modal" data-target="#modal-event" data-operation="add"><i class="fas fa-plus mr-2"></i>Añadir</button>
				</div>
				@endif
			</div>
		</section>
		<aside class="my-5 col-3">
			@include('layouts.aside', compact('indicators'))
		</aside>
	</div>
@endsection
