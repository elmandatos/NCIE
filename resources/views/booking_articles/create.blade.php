@extends('layout')
@section('content')
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
<div class="container">

    <div class="row">
        
        
        <form action="{{ route('warehouse.store') }}"  method="post">
            {!!csrf_field()!!}            
            <div class="col s12 m12 l12">
                {{-- NOMBRE --}}
                <div class="input-field col s12 l6">
                    <input type="text" id="txtNombre" name="nombre" class="validate" ">
                    <label for="txtNombre">Nombre*</label><br>
                    <span style="color:red">{{ $errors->first("nombre") }}</span>
                </div>
                {{-- MODELO --}}
                <div class="input-field col s12 l6">
                    <input type="text" id="txtModelo" name="modelo" class="validate">
                    <label for="txtModelo">Modelo*</label><br>
                    <span style="color:red">{{ $errors->first("modelo") }}</span>
                </div>
            </div>

            <div class="col s12 m12 l12">
                {{-- DESCRIPCION --}}
                <div class="input-field col s12 l6">   
                        <input type="text" id="txtDescripcion" name="descripcion" class="validate" >
                        <label for="txtDescripcion">Descripción*</label>
                        <span style="color:red">{{ $errors->first("descripcion") }}</span>
                </div>
                {{-- CANTIDAD --}}
                <div class="input-field col s12 l6">
                    <input type="number" min="0" id="txtCantidad" name="cantidad" >
                    <label for="txtCantidad">Cantidad:</label>
                    <span style="color:red">{{ $errors->first("cantidad") }}</span>
                </div>
            </div>

            <div class="col s12 m12 l12">        
                {{-- ANAQUEL --}}
                <div class="input-field col s12 l6">
                    <input type="number" min="1" max="5" id="txtAnaquel" name="anaquel" >

                    <label for="txtAnaquel" data-error="wrong" data-success="right">Anaquel*</label><br>
                    <span style="color:red">{{ $errors->first("anaquel") }}</span>
                </div>

						</div>
						{{-- ENVIAR FORMULARIO --}}
						<div class="input-field col s12 l6 ">
								<input type="submit" class="btn">
						</div>
            {{-- INPUT OCULTO PARA GENERAR FOTO DE USUARIO --}}
            <input hidden   id="foto" name="foto" type="text">
        </form>
    </div>
</div>
@endsection
