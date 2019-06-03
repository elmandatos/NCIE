@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        {{-- FOTO Y CÁMARA --}}
        <div class="row center-align">
            <div class="col s12 m6 l6 center-align">
                <label>Camara</label><br>
                <video id="videoElement" class="col s12 m12 l12" autoplay="true"  width="550" height="550" style="display:none"></video>
                <canvas id="canvas" class="col s12 m12 l12" width="550" height="550">
                </canvas>
                <button class="btn" id="capturar" style="margin-top:10px;">Capturar<i class="material-icons right">photo_camera</i></button>
            </div>

            <div class="col s12 m6 l6">
                <label>Foto actual</label><br>
                <img class="col s12 m12 l12" id="img-default" src="{{asset('img/warehouse/'.$articulo->foto)}}">
            </div>
        </div>
        
        <form action="{{ route('warehouse.update', $articulo->id) }}"  method="post">
            {!! method_field('PUT')!!}
            {!!csrf_field()!!}            
            <div class="col s12 m12 l12">
                {{-- NOMBRE --}}
                <div class="input-field col s12 l6">
                    <input type="text" id="txtNombre" name="nombre" class="validate" value = "{{ $articulo->nombre }}">
                    <label for="txtNombre">Nombre*</label>
                    <span style="color:red">{{ $errors->first("nombre") }}</span>
                </div>
                {{-- MODELO --}}
                <div class="input-field col s12 l6">
                    <input type="text" id="txtModelo" name="modelo" class="validate"  value = "{{ $articulo->modelo }}">
                    <label for="txtModelo">Modelo*</label><br>
                    <span style="color:red">{{ $errors->first("modelo") }}</span>
                </div>
            </div>

            <div class="col s12 m12 l12">
                {{-- DESCRIPCION --}}
                <div class="input-field col s12 l6">   
                    <input type="text" id="txtDescripcion" name="descripcion" class="validate"  value = "{{ $articulo->descripcion }}">
                    <label for="txtDescripcion">Descripción*</label><br>
                    <span style="color:red">{{ $errors->first("descripcion") }}</span>
                </div>
                {{-- CANTIDAD --}}
                <div class="input-field col s12 l6">
                    <input type="number" min="0" id="txtCantidad" name="cantidad" value="{{$articulo->cantidad}}">
                    <label for="txtCantidad">Cantidad:</label>
                    <span style="color:red">{{ $errors->first("cantidad") }}</span>
                </div>
            </div>

            <div class="col s12 m12 l12">        
                {{-- ANAQUEL --}}
                <div class="input-field col s12 l6">
                    <input type="number" min="1" max="5" id="txtAnaquel" name="anaquel" value="{{$articulo->anaquel}}">
                    <label for="txtAnaquel" data-error="wrong" data-success="right">Anaquel*</label><br>
                    <span style="color:red">{{ $errors->first("anaquel") }}</span>
                </div>

            </div>
            {{-- ENVIAR FORMULARIO --}}
            <div class="input-field col s12 l6 ">
                <input type="submit" class="btn">
            </div>
            {{-- INPUT OCULTO PARA GENERAR FOTO DE USUARIO --}}
            <input hidden   id="foto" name="foto" type="text" value="{{$articulo->foto}}">
        </form>
    </div>
</div>
@endsection
@section("scripts")
  @extends('scripts/p5')
  <script src="{{asset('/js/webcam.js')}}" type="text/javascript"></script>
@endsection