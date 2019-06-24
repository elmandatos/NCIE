@extends('layout')
@section('content')
   <div class="container">

    {{-- ACTION BUTTON --}}
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red" href="{{ route("booking_cubicules.create") }}">
            <i class="large material-icons">playlist_add</i>
        </a>
    </div>
    {{-- END ACTION BUTTON --}}
       <table>
        <thead>
            <tr>
                <th>Cubiculo</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th></th>
            </tr>
        </thead>
    
        <tbody>
            @foreach ($reservaciones as $reservacion)
            <tr>
                <td>{{ $reservacion["numero"] }}</td>
                <td>{{ $reservacion["hora_inicio"] }}</td>
                <td>{{ $reservacion["hora_fin"] }}</td>
                <td>{{ $reservacion["nombres"] }}</td>
                <td>{{ $reservacion["apellidos"] }}</td>
                <td>{{ $reservacion["email"] }}</td>
                <td>
                    {{ Form::open(['route' => ['booking_cubicules.destroy', $reservacion["id"]], 'method' => 'delete']) }}
                    <button class="btn halfway-fab waves-effect waves-light red">
                        <i class="material-icons">delete</i>
                    </button>
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
   </div>
@endsection
@section('scripts')
<script>
</script>
@endsection