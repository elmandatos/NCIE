@extends('layout')
@section('content')
<style>
.card {
    min-width: 220px;
}
</style>
<div class="container">
    {{-- SEARCH BAR --}}
    <div class="row center">
        <form action="">
            <div class="input-field col s10 l12">
                <i class="material-icons tinny prefix">search</i>
                <input type="text" id="buscar" class="validate">
                <label for="buscar">Buscar</label>
            </div>
        </form>
    </div>
    {{-- END SEARCH BAR --}}

    <div class="row">
        <form action="{{ route("users.destroy",$user["id"]) }}">
            @csrf
            @method("DELETE")
            {{-- USER CARD DEFAULT--}}
            <div class="col s12 m4 l4 push-m4 push-l4">
                <div class="card hoverable">
                    <div class="card-image">
                        <img src="{{ asset('img/users/'.$user["foto"]) }}" class="materialboxed">
                        <span class="card-title"
                            style="padding-top: 30px;font-size: 1em;width: 100%; background-image: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.5), rgba(0,0,0,0.7));">
                            <b>{{ $user["nombres"] }} {{ $user["apellidos"] }}</b><br>
                            <span>{{ ucwords($user["carrera"]) }}<br>{{ ucwords($user["rol"]) }}</span>
                        </span>
                        <a class="btn-floating halfway-fab waves-effect waves-light amber"
                            href='{{ route("users.edit",$user["id"]) }}'>
                            <i class="tiny material-icons">edit</i>
                        </a>
                        <a style="right: -15px;" class="btn-floating halfway-fab waves-effect waves-light blue">
                            <i class="fas fa-qrcode "></i>
                        </a>

                        <a type="submit" style="right: -15px;top:-15px;"
                            class="btn-floating halfway-fab waves-effect waves-light red">
                            <i class="material-icons">delete</i>
                        </a>
                    </div>
                    <div class="card-content">
                        <div>
                            <label style="display: flex; aling-content:center;">
                                <i class="material-icons small">access_time</i>
                                <span style="font-size: 1.4em;">&nbsp;700:50</span>
                            </label>
                            <a class="tooltipped" data-position="top" data-tooltip="{{ $user["email"] }}">
                                <i class="material-icons small grey-text text-grey">mail</i>
                            </a>
                            <a class="tooltipped" data-position="top" data-tooltip="{{ $user["telefono"] }}">
                                <i class="material-icons small grey-text text-grey">phone</i>
                            </a>
                        </div>
                        <a href="#!" class="btn">ENTRAR</a>
                        <a href="#!" class="btn red">SALIR</a>
                    </div>
                </div>
            </div>
            {{-- END USER CARD --}}
        </form>
    </div>
</div>
@endsection