<div class="col-10 offset-1">
	<div class="col-12">
		<h1 class="text-center">
			<b>Indicadores</b>
		</h1>
	</div>
	@foreach ($indicators as $indicator)
		<div class="indicator my-4 p-2">
			<div class="col-12 text-center">
				<h2>
					<b>{{$indicator->name}}</b>
				</h2>
			</div>
			<div class="col-12 text-center">
				<h3>{{$indicator->value}}</h3>
			</div>
		</div>
	@endforeach
	<div class="col-8 offset-2 my-5">
		<div class="col-12 d-flex justify-content-center">
			<a href="https://www.spe.org/events/calendar/">
				<img src="{{asset('/images/global_events.png')}}" class="img-fluid photo">	
			</a>		
		</div>
		<div class="col-12 mt-3 mb-4 text-center">
			<a href="https://www.spe.org/events/calendar/">Buscador de eventos SPE a nivel global.</a>		
		</div>
	</div>
	<div class="col-8 offset-2 my-5">
		<div class="col-12 d-flex justify-content-center">
			<a href="https://www.spe.org/events/calendar/">
				<img src="{{asset('/images/onepetro.png')}}" class="img-fluid photo">	
			</a>		
		</div>
		<div class="col-12 mt-3 mb-4 text-center">
			<a href="https://www.spe.org/events/calendar/">Biblioteca de papers técnicos.</a>		
		</div>
	</div>
	<div class="col-8 offset-2 my-5">
		<div class="col-12 d-flex justify-content-center">
			<a href="https://www.spe.org/events/calendar/">
				<img src="{{asset('/images/petrowiki.png')}}" class="img-fluid photo">	
			</a>		
		</div>
		<div class="col-12 mt-3 mb-4 text-center">
			<a href="https://www.spe.org/events/calendar/">Wiki de conceptos petroleros.</a>		
		</div>
	</div>
	<div class="col-8 offset-2 my-5">
		<div class="col-12 d-flex justify-content-center">
			<a href="https://www.spe.org/events/calendar/">
				<img src="{{asset('/images/cmt.png')}}" class="img-fluid photo">	
			</a>		
		</div>
		<div class="col-12 mt-3 mb-4 text-center">
			<a href="https://www.spe.org/events/calendar/">Herramienta para gestionar su desarrollo profesional y técnico.</a>		
		</div>
	</div>
	<div class="col-8 offset-2 my-5">
		<div class="col-12 d-flex justify-content-center">
			<a href="https://www.spe.org/events/calendar/">
				<img src="{{asset('/images/ementoring.png')}}" class="img-fluid photo">	
			</a>		
		</div>
		<div class="col-12 mt-3 mb-4 text-center">
			<a href="https://www.spe.org/events/calendar/">Plataforma para conectar aprendices con mentores.</a>		
		</div>
	</div>
</div>
