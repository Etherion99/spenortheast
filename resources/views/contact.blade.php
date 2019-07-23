@extends('layouts.template')

@section('content')
	<div class="row mx-0">
		<section class="my-5 col-9 pr-3">
			<div class="row col-12 mx-0 d-flex justify-content-center">
				<div class="col-10">
					<div class="form col-6 offset-3 p-4">
						<div class="form-group">
							<label for="name">Nombre</label>
							<input type="text" class="form-control" id="name">
							<div class="alert alert-danger" id="alert-name">
								No puedes dejar este campo vacio
							</div>
						</div>
						<div class="form-group">
							<label for="email">Correo electrónico</label>
							<input type="text" class="form-control" id="email">
							<div class="alert alert-danger" id="alert-email">
								Ingresa un correo válido
							</div>
						</div>
						<div class="form-group">
							<label for="subject">Asunto</label>
							<input type="text" class="form-control" id="subject">
							<div class="alert alert-danger" id="alert-subject">
								No puedes dejar este campo vacio
							</div>
						</div>
						<div class="form-group">
							<label for="message">Mensaje</label>
							<textarea class="form-control" id="message_content" rows="5"></textarea>
							<div class="alert alert-danger" id="alert-message_content">
								No puedes dejar este campo vacio
							</div>
						</div>
						<div class="d-flex justify-content-center">
							<button class="btn btn-main" onclick="sendMessage()">Enviar</button>
						</div>
					</div>
				</div>
			</div>
		</section>
		<aside class="my-5 col-3">
			@include('layouts.aside', compact('indicators'))
		</aside>
	</div>	
@endsection
