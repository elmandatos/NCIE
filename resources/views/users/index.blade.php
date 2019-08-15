@extends('layout')
@section('content')
<style>
    .card{
        min-width: 220px;
    }
</style>
<div class="container">
    {{-- SEARCH BAR --}}
    <div class="row center">
        <form action="{{route("searchUser")}}" method="get"">
            {!!csrf_field()!!}
            <div class="input-field col s10 l12">
                <i class="material-icons tinny prefix">search</i>
                <input type="text" id="buscar" class="validate" name="search">
                <label for="buscar">Buscar</label>
            </div>
        </form>
        <a href="{{ route("sendAllQR") }}" class="btn">Enviar QR a todos</a>
    </div>
    {{-- END SEARCH BAR --}}

    {{-- ACTION BUTTON --}}
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red" href="{{ route("users.create") }}">
            <i class="large material-icons">person_add</i>
        </a>
    </div>
    {{-- END ACTION BUTTON --}}

    <div class="row">
        @foreach ($users as $user )
            {{-- EVITA DESPLEGAR USER ADMIN --}}
            @if ($user["nombres"] == "ADMIN")
                @continue
            @endif
            {{-- USER CARD DEFAULT--}}
            <div class="col l4 m6 s12">
                <div class="card hoverable">
                    <div class="card-image">
                        <img src="{{secure_asset('img/users/'.$user["foto"]) }}" class="materialboxed">
                        <span class="card-title" style="padding-top: 30px;font-size: 1em;width: 100%; background-image: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.5), rgba(0,0,0,0.7));">
                            <b>{{ $user["nombres"] }} {{ $user["apellidos"] }}</b><br>
                            <span>{{ ucwords($user["carrera"]) }}<br>{{ ucwords($user["rol"]) }}</span>
                        </span>
                        <a class="btn-floating halfway-fab waves-effect waves-light amber" href="{{ route("users.edit",$user["id"]) }}">
                            <i class="tiny material-icons">edit</i>
                        </a>
                        <a style="right: 110px;" class="btn-floating halfway-fab waves-effect waves-light orange darken-2" href="{{ route("horasEntreFechas",$user["id"]) }}">
                            <i class="tiny material-icons">insert_chart</i>
                        </a>
                        
                        <a style="right: -15px;" class="btn-floating halfway-fab waves-effect waves-light blue" href="{{ route("createAndSendQR",$user["id"]) }}">
                        <i class="fas fa-qrcode "></i>
                        </a>
                        <a style="right: +68px;" class="btn-floating halfway-fab waves-effect waves-light red" href="{{ route("createByUser",$user["id"]) }}">
                            <i class="fas fa-cart-plus "></i>
                        </a>
                        

                                                {{-- DELETE BUTTON --}}
                        <div>
                            {{ Form::open(['route' => ['users.destroy', $user["id"]], 'method' => 'delete']) }}
                            <button style="right: -15px;top:-15px;" class="btn-floating halfway-fab waves-effect waves-light red">
                                <i class="material-icons">delete</i>
                            </button>
                            {{ Form::close() }}
                        </div>
                        {{-- END DELETE BUTTON --}} 
                    </div>
                    <div class="card-content">
                        <div>
                            <label style="display: flex; aling-content:center;">
                                <i class="material-icons small">access_time</i>
                                <span style="font-size: 1.4em;">&nbsp;{{ $hoursController->get_total_hours($user["id"]) }}</span>
                            </label>
                            <a class="tooltipped" data-position="top" data-tooltip="{{ $user["email"] }}">
                                <i class="material-icons small grey-text text-grey">mail</i>
                            </a>
                            <a class="tooltipped" data-position="top" data-tooltip="{{ $user["telefono"] }}">
                                <i class="material-icons small grey-text text-grey">phone</i>
                            </a>
                        </div>
                       @if($hoursController->show_get_in_btn($user["id"]))
                        <a href="{{ route("entrada", $user["id"]) }}" class="btn">ENTRAR</a>
                       @else
                        <a href="{{ route("salida", $user["id"]) }}" class="btn red">SALIR</a>
                       @endif 
                    </div>
                </div>
            </div>
            {{-- END USER CARD --}}
        @endforeach
    </div>
</div>
@endsection