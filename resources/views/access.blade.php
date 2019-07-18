@extends('layouts.template')

@section('content')
	<div class="row mx-0">
		<section class="my-5 col-9 pr-3">
			<div class="row col-12 mx-0 d-flex justify-content-center">
				<div class="col-10">
					<div class="form col-6 offset-3 p-5">
						<div class="form-group">
							<label for="name">Usuario</label>
							<input type="text" class="form-control" id="username">
							<div class="alert alert-danger" id="alert-username">
								No puedes dejar este campo vacio
							</div>
						</div>
						<div class="form-group">
							<label for="password">Contraseña</label>
							<input type="password" class="form-control" id="password">
							<div class="alert alert-danger" id="alert-password">
								No puedes dejar este campo vacio
							</div>
						</div>
						<div class="d-flex justify-content-center">
							<button class="btn btn-main" id="login">Ingresar</button>
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
