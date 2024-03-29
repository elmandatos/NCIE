@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        {{-- FOTO Y CÁMARA --}}
        <div class="row center-align">
            <div class="col s12 m6 l6 center-align">
                <label>Camara</label><br>
                <video id="videoElement" class="col s12 m12 l12" autoplay="true" width="550" height="550"
                    style="display:none"></video>
                <canvas id="canvas" class="col s12 m12 l12" width="550" height="550">
                </canvas>
                <button class="btn" id="capturar" style="margin-top:10px;">Capturar<i
                        class="material-icons right">photo_camera</i></button>
            </div>
        
            <div class="col s12 m6 l6">
                <label>Foto actual</label><br>
                <img class="col s12 m12 l12" id="img-default" src="{{secure_asset("img/users/".$user["foto"])}}">
            </div>
        </div>
        <form action="{{ route('users.update',$user["id"]) }}"  method="post">
            {{method_field("PUT")}}
            {!!csrf_field()!!}
            {{-- INPUT OCULTO PARA GENERAR FOTO DE USUARIO --}}
            <input type="text" id="foto" name="foto" value="" style="display: none;">
            
            <div class="col s12 m12 l12">
                {{-- NOMBRES --}}
                <div class="input-field col s12 l6">
                    <input type="text" id="nombres" name="nombres" class="validate" value = "{{ $user["nombres"] }}">
                    <label for="nombres">Nombres*</label><br>
                    <span style="color:red">{{ $errors->first("nombres") }}</span>
                </div>
                {{-- APELLIDOS --}}
                <div class="input-field col s12 l6">
                    <input type="text" id="apellidos" name="apellidos" class="validate"  value = "{{ $user["apellidos"] }}">
                    <label for="apellidos">Apellidos*</label><br>
                    <span style="color:red">{{ $errors->first("apellidos") }}</span>
                </div>
            </div>

            <div class="col s12 m12 l12">
                {{-- SEXO --}}
                <div class="input-field col s12 l6" id="sexo">   
                    <div><label>Sexo*</label></div>
                    <div class="center-align">

                        <label><input name="sexo" type="radio" value="mujer" {{ $user["sexo"] == "mujer" ? "checked ='true'" : ""}}><span>Mujer</span></label>&nbsp;&nbsp;&nbsp;
                        <label><input name="sexo" type="radio" value="hombre" {{ $user["sexo"] == "hombre" ? "checked ='true'" : ""}}><span>Hombre</span></label>
                    </div><br>
                    <span style="color:red">{{ $errors->first("sexo") }}</span>
                </div>
                {{-- TELEFONO --}}
                <div class="input-field col s12 l6">
                    <input type="tel" id="telefono" name="telefono" pattern="[0-9]{10}" class="validate" value = "{{ $user["telefono"] }}" maxlength="10" minlength="10">
                    <label for="telefono">Teléfono*</label><br>
                    <span style="color:red">{{ $errors->first("telefono") }}</span>
                </div>
            </div>
            <div class="col s12 m12 l12">        
                {{-- EMAIL --}}
                <div class="input-field col s12 l6">
                    <input type="email" id="email" name="email" class="validate" value = {{ $user["email"] }}>
                    <label for="email" data-error="wrong" data-success="right">Email*</label><br>
                    <span style="color:red">{{ $errors->first("email") }}</span>
                </div>
    
                {{-- MATRICULA --}}
                <div class="input-field col s12 l6">
                    <input type="text" id="matricula" name="matricula" class="validate" value ="{{ $user["matricula"] }}" placeholder="SOLO PARA ALUMNOS DEL TEC">
                    <label for="matricula" data-error="wrong" data-success="right">Matrícula</label><br>
                    <span style="color:red">{{ $errors->first("matricula") }}</span>
                </div>
            </div>

           <div class="col s12 m12 l12">
               {{-- CARRERA --}}
               <div class="input-field col s12 l6">
                   <select class="" id="carrera" name="carrera">
                       <option value="" disabled selected>Selecciona carrera</option>
                       <option value="Ing. en Gestión Empresarial"
                           {{ ucwords($user["carrera"]) == "Ing. en Gestión Empresarial" ? "selected" : "" }}>Ing. en Gestión Empresarial</option>
                       <option value="Ing. Ambiental" {{ ucwords($user["carrera"]) == "Ing. Ambiental" ? "selected" : "" }}>Ing. Ambiental</option>
                       <option value="Ing. Bioquímica" {{ ucwords($user["carrera"]) == "Ing. Bioquímica" ? "selected" : "" }}>Ing. Bioquímica</option>
                       <option value="Ing. Biomédica" {{ ucwords($user["carrera"]) == "Ing. Biomédica" ? "selected" : "" }}>Ing. Biomédica</option>
                       <option value="Ing. Química" {{ ucwords($user["carrera"]) == "Ing. Química" ? "selected" : "" }}>Ing. Química</option>
                       <option value="Ing. Eléctrica" {{ ucwords($user["carrera"]) == "Ing. Eléctrica" ? "selected" : "" }}>Ing. Eléctrica</option>
                       <option value="Ing. Electrónica" {{ ucwords($user["carrera"]) == "Ing. Electrónica" ? "selected" : "" }}>Ing. Electrónica</option>
                       <option value="Ing. Mecánica" {{ ucwords($user["carrera"]) == "Ing. Mecánica" ? "selected" : "" }}>Ing. Mecánica</option>
                       <option value="Ing. Civil" {{ ucwords($user["carrera"]) == "Ing. Civil" ? "selected" : "" }}>Ing. Civil</option>
                       <option value="Ing. Industrial" {{ ucwords($user["carrera"]) == "Ing. Industrial" ? "selected" : "" }}>Ing. Industrial</option>
                       <option value="Ing. en Sistemas Computacionales"
                           {{ ucwords($user["carrera"])  == "Ing. En Sistemas Computacionales" ? "selected" : "" }}>Ing. en Sistemas Computacionales</option>
                       <option value="Lic. en Administración"
                           {{  ucwords($user["carrera"]) == "Lic. En Administración" ? "selected" : "" }}>Lic. en Administracion</option>
                       <option value="Otra" {{ ucwords($user["carrera"])  == "Otra" ? "selected" : "" }}>Otra</option>
                   </select>
                    <label>Carrera*</label><br>
                    <span style="color:red">{{ $errors->first("carrera") }}</span>
               </div>
   
               {{-- ROL --}}
   
               <div class="input-field col s12 l6">
                   <select class="" id="rol" name="rol">
                       <option value="" disabled selected>Selecciona Rol</option>
                       <option value="servicio social" {{ ($user["rol"]) == "servicio social" ? "selected" : "" }}>Servicio Social</option>
                       <option value="residencia" {{ ($user["rol"]) == "residencia" ? "selected" : "" }}>Residencia</option>
                       <option value="maestro" {{ ($user["rol"]) == "maestro" ? "selected" : "" }}>Maestro</option>
                       <option value="células de innovación" {{ ($user["rol"]) == "células de innovación" ? "selected" : "" }}>
                           Células de Innovación</option>
                       <option value="células de innovación"
                           {{ ($user["rol"]) == "células de innovación" ? "selected" : "" }}>Células de Innovación - Coach</option>
                       <option value="incubadora de innovación"
                           {{ ($user["rol"]) == "incubadora de innovación" ? "selected" : "" }}>Incubadora de innovación</option>
                       <option value="alumnos" {{ ($user["rol"]) == "alumnos" ? "selected" : "" }}>Alumnos</option>
                       <option value="club de robótica" {{ ($user["rol"]) == "club de eobótica" ? "selected" : "" }}>Club de Robótica</option>
                       <option value="proyecto externo" {{ ($user["rol"]) == "proyecto externo" ? "selected" : "" }}>Proyecto Externo</option>
                   </select>
                    <label>Rol*</label><br>
                   <span style="color:red">{{ $errors->first("rol") }}</span>   
               </div>
           </div>                                                                               
            {{-- TIPO DE USUARIO --}}
            <div class="input-field col s12 m12 l6">
                <div><label>Tipo de usuario:</label></div>
                <div class="center-align">
                    <label><input name="tipo_de_usuario" type="radio" value="administrador" {{ $user["tipo_de_usuario"] == "administrador" ? "checked ='true '":""}}><span>Administrador</span></label>&nbsp;&nbsp;&nbsp;
                    <label><input name="tipo_de_usuario" type="radio" value="asistente" {{ $user["tipo_de_usuario"] == "asistente" ? "checked ='true'":""}}><span>Asistente</span></label>&nbsp;&nbsp;&nbsp;
                    <label><input name="tipo_de_usuario" type="radio" value="usuario" {{ $user["tipo_de_usuario"] == "usuario" ? "checked ='true'":""}}><span>Usuario</span></label><br>
                    <span style="color:red">{{ $errors->first("tipo_de_usuario") }}</span>   
                </div><br>

            </div>
            <div class="col s12 m12 l6">
                <div id="password-section" style = "display: none">
                    <div class="input-field col s12 l6 ">
                        <input type="password" id="password" name="password" class="validate">
                        <label for="password">Contraseña</label><br>
                    </div>
                    <div class="input-field col s12 l6 ">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="validate">
                        <label for="password_confirmation">Confirmar contraseña</label><br>
                    </div><br><br>
                </div>
                <div class="input-field col s12 l6 ">
                    <input type="submit" class="btn">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="/js/p5.min.js"></script>
<script>
    
    //ESCOGER IMAGEN POR DEFECTO DEPENDIENDO DEL SEXO SELECCIONADO
    let imgDefault = document.querySelector("#img-default");
    let sexo = document.getElementById("sexo");
    let valorSexo;
    
    $("#sexo").click(function(e) {
        if(e.target.tagName == "INPUT"){

            if( imgDefault.src == "{{secure_asset('img/users/user-woman.png') }}" ||
                imgDefault.src == "{{secure_asset('img/users/user-man.png') }}" ){
                    valorSexo = e.target.value;
                    if(valorSexo == "mujer")
                        imgDefault.src = "{{secure_asset('img/users/user-woman.png') }}"
                    else
                        imgDefault.src = "{{secure_asset('img/users/user-man.png')}}"
                }
        }
    });

    //MOSTRAR LOS INPUTS DE PASSWORDS DEPÉNDIENDO DEL TIPO DE USUARIO
    let passwordSection = document.querySelector("#password-section");
    let radioBtnUserType = document.querySelectorAll("input[name='tipo_de_usuario']");
    let inputsPasswordSection = document.querySelectorAll("#password-section input[type='password']");
    radioBtnUserType.forEach(element => {
        element.addEventListener("click", e => {
            if(e.target.value == "usuario" || e.target.value == null){
                inputsPasswordSection.forEach(input => {
                    input.required = false;
                });
                passwordSection.style.display = "none";
            }
            else{
                inputsPasswordSection.forEach(input => {
                    input.required = true;
                });
                passwordSection.style.display = "block";
            }
        });
    });

</script>
<script src="{{secure_asset('js/capturePicture.js') }}"></script>
@endsection