@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Auth::user())
                <button class="btn btn-main" onclick="logout()">Salir</button>
            @endif

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form> 
        </div>
    </div>
</div>
@endsection
