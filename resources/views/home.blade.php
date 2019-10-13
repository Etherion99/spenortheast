@extends('layouts.template')

@section('content')
<div class="row mx-0">
    <section class="my-5 col-9">
        <div class="col-8 offset-2">
            <div class="carousel slide" data-ride="carousel" id="main-carousel">
                <ol class="carousel-indicators">
                    @for($i = 0; $i < count($gallery); $i++)
                        <li data-target="#main-carousel" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></li>
                    @endfor
                  </ol>
                <div class="carousel-inner">
                    @foreach($gallery as $img)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ asset($img) }}" class="d-block w-100">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#main-carousel" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#main-carousel" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        @if(count($soonEvents) > 0)
        <div class="col-12 my-5">
            <div class="col-4 offset-4">
                <div class="section-header">
                    <span>Próximos Eventos</span>
                </div>
            </div>
        </div>
        @endif
        <div class="col-12">
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
                </div>
            </div>
            @endforeach
        </div>
        @if(count($recentEvents) > 0)
        <div class="col-12 my-5">
            <div class="col-4 offset-4">
                <div class="section-header">
                    <span>Eventos Recientes</span>
                </div>
            </div>
        </div>
        @endif
        <div class="col-12">
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
                </div>
            </div>
            @endforeach
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </section>
    <aside class="my-5 col-md-3 col-sm-12">
        @include('layouts.aside', compact('indicators', 'pubs'))
    </aside>
</div>



<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="col-12">
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

            <div class="col-12">
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

            <div class="col-12">
                @foreach($pubs as $pub)
                <div class="my-3">
                    <div class="ig-pub">
                        <div class="col-12 px-0 py-4 image d-flex justify-content-center">
                            <img src="{{ $pub->image }}" class="img-fluid">
                        </div>
                        <div class="col-12 px-4 pb-4 caption">
                            <span>{!! $pub->caption !!}</span>
                        </div>
                    </div>                    
                </div>
                @endforeach
            </div>



            @if(Auth::user())
                <button class="btn btn-main" onclick="logout()">Salir</button>
            @endif

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form> 
        </div>
    </div>
</div>-->
@endsection
