@extends('layout')
@section('content')
<style>
  .card {
      min-width: 220px;
  }
</style>
<div class="container">
  {{-- SEARCH BAR --}}
  <div class="row">
      <form action="">
          <div class="input-field col s10 l12">
              <i class="material-icons tinny prefix">search</i>
              <input type="text" id="first_name" class="validate">
              <label for="first_name">Buscar</label>
          </div>
      </form>
  </div>
  {{-- END SEARCH BAR --}}
  
  <div class="row">
      {{-- PIECE OF WAREHOUSE CARD DEFAULT--}}
      @foreach($articulos as $articulo)
      <div class="col l4 m6 s12">
        <div class="card hoverable">
            <div class="card-image">
                <img src="{{asset('img/warehouse/'.$articulo->foto)}}">
                <span class="card-title" style="padding-top: 30px;font-size: 1em;width: 100%; background-image: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.5), rgba(0,0,0,0.7));">
                <b>{{$articulo->nombre}}</b><br>
                <span>{{$articulo->modelo}}<br> {{$articulo->descripcion}}</span>
                </span>
                <a href="/warehouse/{{$articulo->id}}/edit" class="btn-floating halfway-fab waves-effect waves-light amber">
                    <i class="material-icons">edit</i>
                </a>
                <a href="{{ route('warehouse.create') }}"style="right: -15px;" class="btn-floating halfway-fab waves-effect waves-light blue">
                    <i class="fas fa-qrcode"></i>
                </a>
                <a style="right: -15px;top:-15px;" class="btn-floating halfway-fab waves-effect waves-light red">
                    <i class="material-icons">delete</i>
                </a>
            </div>
            <div class="card-content">
                <div>
                    <label style="display: flex; aling-content:center;">
                        <i class="material-icons small">access_time</i>
                    <span style="font-size: 1.4em;">&nbsp;cantidad: {{$articulo->cantidad}}</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
        
      @endforeach
      {{-- END PIECE WAREHOUSE CARD --}}  
  </div>
</div>

@endsection