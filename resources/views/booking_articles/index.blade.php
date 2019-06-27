@extends('layout')
@section('content')
{{-- SEARCH BAR --}}
<div class="container">

    {{-- END SEARCH BAR --}}
    <div class="row">
    @foreach($users as $user)
    {{-- USER CARD DEFAULT--}}
    <div class="col l4 m6 s12">
        <div class="card hoverable">
            <div class="card-image">
                <img src="{{secure_asset('img/users/'.$user["foto"]) }}" class="materialboxed">
                <span class="card-title" style="padding-top: 30px;font-size: 1em;width: 100%; background-image: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.5), rgba(0,0,0,0.7));">
                    <b>{{ $user["nombres"] }} {{ $user["apellidos"] }}</b><br>
                    <span>{{ ucwords($user["carrera"]) }}<br>{{ ucwords($user["rol"]) }}</span>
                </span>                
            </div>
            <div class="card-content">
                
                <a href="{{ route("booking_articles.edit", $user["id"]) }}" class="btn">DEVOLVER ARTICULOS</a>
            </div>
        </div>
    </div>
    {{-- END USER CARD --}}


    @endforeach
    </div>
  
</div>

@endsection
@section('scripts')
    
@endsection