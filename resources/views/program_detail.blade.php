@extends('layouts.template')

@section('content')
	<div class="row mx-0">
		<section class="my-5 col-9 pr-3">
			<div class="row col-12 mx-0 d-flex justify-content-center">
				<div class="col-10 row">
					<div class="mt-5 col-12">
						<h1 class="text-center">
							<strong>{{ $program->name }}</strong>
						</h1>
					</div>
					<div class="my-4 col-12">
						<div class="col-6 offset-3">
							<img src="{{ asset('/images/programs/' . $program->id . '.' . $program->extension )}}" class="img-fluid photo">
						</div>						
					</div>
					<div class="my-4">
						{!! $program->description !!}
					</div>
				</div>
			</div>
		</section>
		<aside class="my-5 col-3">
			@include('layouts.aside', compact('indicators'))
		</aside>
	</div>	
@endsection