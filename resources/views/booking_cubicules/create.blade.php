@extends('layout')
@section('content')
<div class="container">
    <h3>Apartar cubículo</h3>
    <form action="{{ route("booking_cubicules.store") }}" method="POST">
        {!!csrf_field()!!}
        <input type="text" name="id_user" placeholder="id del usuario">
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
@endsection