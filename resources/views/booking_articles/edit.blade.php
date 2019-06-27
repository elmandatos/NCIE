@extends('layout')
@section('content')
<div class="container">
  <div class="row">
    <div id="tabla_resultado">
      <table id="tabla">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Estado</th>
            <th>  </th>
        </tr>
        @foreach($booking as $index=>$booking_articles)
        <tr>
            <th>{{$booking_articles->id}}</th>
            <th>{{$articles[$index]->nombre}}</th>
            <th>{{$booking_articles->cantidad}}</th>
            <th>{{$booking_articles->estado}}</th>
            <th>
                <form action="{{ route('booking_articles.update', $booking_articles->id) }}"  method="post">
                    {{method_field("PUT")}}

                    {!!csrf_field()!!}
                    <button type="submit" class="btn">DEVOLVER ARTICULO</button>

                </form>
            </th>
        </tr>
        @endforeach

      </table>
      <br>
      <a href="{{ route("updateAll", $user_id )}}" class="btn">DEVOLVER TODOS LOS ARTICULOS</a>

    </div>

  </div>
</div>
@endsection