@extends('layout')
@section('content')
<div class="container">
    <h3>Apartar cubículo</h3>
    <div class="row">
        <div class="qr col l6">
            <p class="center-align">Escanea el <br><b>código QR</b></p>
            <video class="responsive-video" id="preview"></video>
        </div>
            <div class="qr col l6">
            <p class="center-align"><b>Foto de usuario</b></p>
            <img id="id-img" class="responsive-img" src="{{  secure_asset("img/users/user-man.png")}}" alt="">
        </div>
    </div>
    <form action="{{ route("booking_cubicules.store") }}" method="POST">
        {!!csrf_field()!!}
        <input type="text" id="id_user" name="id_user" placeholder="id del usuario" hidden>
        <span style="color:red">{{ $errors->first("id_user") }}</span>
        <div class="row">
            <div class="col s12">
                <p>Seleccione cubículo</p>
                @foreach ($horasCubiculos as $cubiculo => $horas)
                    @php
                        $primerCubiculo = $cubiculo;
                        break;
                    @endphp
                @endforeach
                <input type="text" id="numeroCubiculo" name="id_cubicules" value="{{ $primerCubiculo }}" hidden>
                <ul class="tabs" id="listaCubiculos">
                    @foreach ($horasCubiculos as $cubiculo => $horas)
                    <li class="tab col s1"><a href="#Cubiculo{{ $cubiculo }}">{{ $cubiculo }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div id="container-cubiculos">
                @foreach ($horasCubiculos as $cubiculo => $horas)
                <div id="Cubiculo{{ $cubiculo}}" class="col s12">
                    <span style="color:red">{{ $errors->first("id_schedules") }}</span>
                    @foreach ($horas as $hora)
                    <p>
                        <label>
                            <input type="checkbox" name="id_schedules[]" value="{{ $hora["id"] }}" unchecked>
                            <span>{{ $hora["hora_inicio"]." - ".$hora["hora_fin"] }}</span>
                        </label>
                    </p>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
        <input type="submit" class="btn">
    </form>
</div>
@endsection
@section('scripts')
<script>
    let listaCubiculos = document.getElementById("listaCubiculos");
    let numeroCubiculo = document.getElementById("numeroCubiculo");

    console.log(listaCubiculos);
    $(listaCubiculos).click(function(e){
        if(e.target.tagName == "A")
            numeroCubiculo.value = e.target.innerHTML;
    });
</script>
    <script src="{{ secure_asset('/js/instascan.min.js')}}" type="text/javascript"></script>
    <script src="{{ secure_asset('/js/cameraCubicules.js')}}" type="text/javascript"></script>
@endsection