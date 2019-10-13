@extends('layouts.template')

@section('content')
	<div class="row mx-0">
		<section class="my-5 col-9 pr-3">
			<div class="row col-12 mx-0 d-flex justify-content-center">
				<div class="col-8">
					<div class="col-12 mb-5">
						<h1 class="text-center font-weight-bold">Contáctanos</h1>
					</div>
					<div class="form col-10 offset-1 p-5">
						<div class="form-group">
							<label for="name">Nombre *</label>
							<input type="text" class="form-control" id="name">
							<div class="alert alert-danger" id="alert-name">
								No puedes dejar este campo vacio
							</div>
						</div>
						<div class="form-group">
							<label for="email">Correo electrónico *</label>
							<input type="text" class="form-control" id="email">
							<div class="alert alert-danger" id="alert-email">
								Ingresa un correo válido
							</div>
						</div>
						<div class="form-group">
							<label for="subject">Asunto *</label>
							<input type="text" class="form-control" id="subject">
							<div class="alert alert-danger" id="alert-subject">
								No puedes dejar este campo vacio
							</div>
						</div>
						<div class="form-group">
							<label for="subject">Correo de destino *</label>
							<select class="form-control" id="d-email">
								<option value="chairperson@spenortheastco.org">chairperson@spenortheastco.org</option>
								<option value="communications@spenortheastco.org">communications@spenortheastco.org</option>
								<option value="events@spenortheastco.org">events@spenortheastco.org</option>
								<option value="womeninenergy@spenortheastco.org">womeninenergy@spenortheastco.org</option>
								<option value="youngprofessionals@spenortheastco.org">youngprofessionals@spenortheastco.org</option>
							</select>
							<div class="alert alert-danger" id="alert-subject">
								No puedes dejar este campo vacio
							</div>
						</div>
						<div class="form-group">
							<label for="message">Mensaje *</label>
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
			<div class="col-12 mt-5">
				<div class="col-12">
					<h1 class="text-center font-weight-bold">Nuestra Redes</h1>
				</div>
				<div class="col-12 row my-5">
					<div class="col-6 row d-flex justify-content-center px-5">
						<div class="social-link d-flex justify-content-center align-items-center p-4 mx-3" id="facebook-link" onclick="window.location = 'https://www.facebook.com/SPENortheastColombia/'">
							<i class="fab fa-facebook"></i>
						</div>
						<div class="social-link-text d-flex justify-content-center align-items-center py-3 px-5 col" id="facebook-link-text" onclick="window.location = 'https://www.facebook.com/SPENortheastColombia/'">
							<span>@SPENortheastColombia</span>
						</div>
					</div>
					<div class="col-6 row d-flex justify-content-center px-5">
						<div class="social-link d-flex justify-content-center align-items-center p-4 mx-3" id="instagram-link" onclick="window.location = 'https://www.instagram.com/spenortheastcolombia'">
							<i class="fab fa-instagram"></i>
						</div>
						<div class="social-link-text d-flex justify-content-center align-items-center py-3 px-5 col" id="instagram-link-text" onclick="window.location = 'https://www.instagram.com/spenortheastcolombia'">
							<span>@spenortheastcolombia</span>
						</div>
					</div>
				</div>
				<div class="col-12 row my-5">
					<div class="col-6 row d-flex justify-content-center px-5">
						<div class="social-link d-flex justify-content-center align-items-center p-4 mx-3" id="twitter-link" onclick="window.location = 'https://twitter.com/spenortheastco1'">
							<i class="fab fa-twitter"></i>
						</div>
						<div class="social-link-text d-flex justify-content-center align-items-center py-3 px-5 col" id="twitter-link-text" onclick="window.location = 'https://twitter.com/spenortheastco1'">
							<span>@spenortheastco1</span>
						</div>
					</div>
					<!--<div class="col-6 row d-flex justify-content-center px-5">
						<div class="social-link d-flex justify-content-center align-items-center p-4 mx-3" id="gmail-link" onclick="window.location = 'https://www.facebook.com/SPENortheastColombia/'">
							<i class="far fa-envelope"></i>
						</div>
						<div class="social-link-text d-flex justify-content-center align-items-center py-3 px-5 col" onclick="window.location = 'https://www.facebook.com/SPENortheastColombia/'" id="gmail-link-text">
							<span></span>
						</div>
					</div>-->
					<div class="col-6 row d-flex justify-content-center px-5">
						<div class="social-link d-flex justify-content-center align-items-center p-4 mx-3" id="linkedin-link" onclick="window.location = 'https://www.linkedin.com/in/spe-northeast-colombia-section-6a6a28187/'">
							<i class="fab fa-linkedin"></i>
						</div>
						<div class="social-link-text d-flex justify-content-center align-items-center py-3 px-5 col" id="linkedin-link-text" onclick="window.location = 'https://www.linkedin.com/in/spe-northeast-colombia-section-6a6a28187/'">
							<span>SPE Northeast Colombia Section</span>
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
