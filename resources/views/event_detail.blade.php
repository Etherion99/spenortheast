@extends('layouts.template')

@section('content')
	<div class="row mx-0">
		<section class="my-5 col-9 pr-3">
			<div class="row col-12 mx-0 d-flex justify-content-center">
				<div class="col-10 row">
					<div class="mt-5 col-12">
						<h1 class="text-center">
							<strong>{{ $title }}</strong>
						</h1>
					</div>
					<div class="my-4 col-12">
						<div class="col-6 offset-3">
							<img src="{{ asset('/images/events/' . $id . '.' . $extension )}}" class="img-fluid">
						</div>						
					</div>
					<div class="my-4">
						{!! $description !!}
					</div>
					<div class="col-12 px-0">
						<div class="row col-12 d-flex justify-content-center px-0">
							<i class="fas fa-calendar-alt"></i>
							<strong class="ml-3 start_date">{{ \Carbon\Carbon::parse($start_date)->format('d/m/Y H:i') }}</strong>
						</div>
						<div class="row col-12 d-flex justify-content-center px-0 mt-3">
							<i class="fas fa-calendar-alt"></i>
							<strong class="ml-3 end_date">{{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</strong>
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