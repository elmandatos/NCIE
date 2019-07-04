@extends('layout')
@section('content')
<div class="container">
    <h3 class="center-align">{{ $user["nombres"]." ".$user["apellidos"]  }}</h3>
    <div class="row">
        <img src="{{ secure_asset('img/users/'.$user["foto"]) }}" alt="" class="col l4 offset-l4">
    </div>
    <div class="row">
        <form action="{{ route("mostrarHoras",$id) }}" method="post">
            {!!csrf_field()!!}
<input type="text" hidden value="{{ secure_asset('img/users/'.$user["foto"]) }}" name="foto">
            <input type="text" hidden value="{{ $user["nombres"]." ".$user["apellidos"] }}" name="nombre">
            <input type="text" name="id" class="validate" value="{{ $id }}" hidden>
            <input type="text" name="id" class="validate" value="{{ $id }}" hidden>

                <div class="input-field col s12 l6">
                    <input type="text" class="datepicker col l12 validate " name="fecha_inicio" placeholder="Fecha inicio" required>
                    <span style="color:red">{{ $errors->first("fecha_inicio") }}</span>
                </div>
                <div class="input-field col s12 l6">
                    <input type="text" class="datepicker col l12 validate " name="fecha_fin" placeholder="Fecha fin" required>
                    <span style="color:red">{{ $errors->first("fecha_fin") }}</span>
                </div>
                <input type="submit" class="btn" value="Consultar Horas">

        </form>
    </div>
</div>
@endsection
@section('scripts')
@endsection