@extends('layouts.template')

@section('styles')
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endsection

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js" defer></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js" defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js" defer></script>
	<script src="{{ asset('js/events.js') }}" defer></script>
@endsection

@section('content')
	<div class="row mx-0">
		<section class="my-5 col-9 pr-3">
			<div class="col-12 mx-0">
				<div class="col-12 row d-flex justify-content-center my-4">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae amet reiciendis minima enim maiores, aliquid itaque optio pariatur harum, qui, veritatis ullam eligendi est similique molestiae facere architecto! Delectus, optio.
					<div class="membership-btn d-flex justify-content-center align-items-center p-4 mx-3" onclick="window.location = 'https://www.spe.org/join/'">
						Hazte miembro <i class="fas fa-user-plus ml-4"></i>
					</div>
				</div>
				<div class="col-12 row d-flex justify-content-center my-4">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias repellat nihil incidunt corporis accusamus, aliquam nam debitis, iusto natus totam obcaecati ratione magni fugit veritatis autem hic explicabo ducimus vitae.
					<div class="membership-btn d-flex justify-content-center align-items-center p-4 mx-3" onclick="window.location = 'https://www.spe.org/join/renew.php'">
						Renueva tu membersía <i class="fas fa-redo-alt ml-4"></i>
					</div>
				</div>
				<div class="col-12 row d-flex justify-content-center my-4">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates, est, ducimus. At est rerum consequatur ea, ullam nesciunt omnis ratione a possimus dolore animi, maxime nihil eveniet non, illo neque?
					<div class="membership-btn d-flex justify-content-center align-items-center p-4 mx-3" onclick="window.location = 'https://www.spe.org/join/reinstate.php'">
						Restituye tu membresía <i class="fas fa-user-check ml-4"></i>
					</div>
				</div>			
			</div>
		</section>
		<aside class="my-5 col-3 pl-3">
			aside
		</aside>
	</div>
@endsection
