@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <p class="center-align"><b>{{ $nombre }}</b></p>
    </div>
    <div class="row">
            <img src="{{ $foto }}" alt="" class="col l4 offset-l4">
    </div>
<table class="striped highlight responsive-table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Hora de entrada</th>
            <th>Hora de salida</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($userHours as $acceso)
            <tr>
                <td>{{ $acceso->fecha }}</td>
                <td>{{ $acceso->hora_entrada }}</td>
                <td>{{ $acceso->hora_salida }}</td>
            </tr>
            @endforeach
    </tbody>
</table>
<p><b>Horas totales: {{ $horasTotales }}</b></p>
</div>
@endsection
@section('scripts')
@endsection