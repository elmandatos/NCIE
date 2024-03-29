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
  {{-- ACTION BUTTON --}}
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red" href="{{ route("warehouse.create") }}">
            <i class="large material-icons">add</i>
        </a>
    </div>
    {{-- END ACTION BUTTON --}}
  <div class="row">
      {{-- PIECE OF WAREHOUSE CARD DEFAULT--}}
      @foreach($articulos as $articulo)
      <div class="col l4 m6 s12">
        <div class="card hoverable">
            <div class="card-image">
                <img src="{{secure_asset('img/warehouse/'.$articulo->foto)}}" style="background-color:#fff;">
                <span class="card-title" style="padding-top: 30px;font-size: 1em;width: 100%; background-image: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.5), rgba(0,0,0,0.7));">
                <b>{{$articulo->nombre}}</b><br>
                <span>{{$articulo->modelo}}<br> {{$articulo->descripcion}}</span>
                </span>
                {{-- EDIT BUTTON --}}
                <a href="/warehouse/{{$articulo->id}}/edit" class="btn-floating halfway-fab waves-effect waves-light amber">
                    <i class="material-icons">edit</i>
                </a>
                {{-- DELETE BUTTON --}}
                <div>     
                    {{ Form::open(['route' => ['warehouse.destroy', $articulo->id], 'method' => 'delete']) }}
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