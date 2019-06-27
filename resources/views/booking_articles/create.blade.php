@extends('layout')
@section('content')
<div class="container">
{{-- SEARCH BAR --}}
<div class="row">
    <div class="input-field col s8 l8">
        <i class="material-icons tinny prefix">search</i>
        <input type="text" id="search">
        <label for="search">Buscar articulo</label>  
    </div>

    <div class="input-field col s2 l2">
            <input type="text" id="cantidad">
            <label for="cantidad">Cantidad</label>   
    </div>

    <div class="col s2 l2">
        <a id="agregar" class="btn-floating btn-large red">
            <i class="large material-icons">person_add</i>
        </a>
    </div>
</div>
<div class="row">
    <form method="POST" action="{{ route('booking_articles.store') }}">
        {!!csrf_field()!!}

        <div id="tabla_resultado">
            <table id="tabla">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Disponible</th>
                    <th>Cantidad</th>
                    <th>  </th>
                </tr>
            </table>
        </div>

        <input value="{{ $id }}" type="hidden" name="user_id">
        <button type="submit" class="waves-effect waves-light btn">Prestar</button>
        
    </form>
</div>

</div>


@endsection

@section('scripts')
<script type="text/javascript">
    (function ($) {
      'use strict';
      var substringMatcher = function (strs) {
        return function findMatches(q, cb) {
          var matches, substringRegex;
          // an array that will be populated with substring matches
          matches = [];
          // regex used to determine if a string contains the substring `q`
          var substrRegex = new RegExp(q, 'i');
          // iterate through the pool of strings and for any string that
          // contains the substring `q`, add it to the `matches` array
          for (var i = 0; i < strs.length; i++) {
            if (substrRegex.test(strs[i])) {
              matches.push(strs[i]);
            }
          }
          cb(matches);
        };
      };

      $.ajaxSetup({
        async: false
      });
      // Make async false first
      var jsonDataSt = (function () {
        var result;
        $.get('/autocomplete', function (
          data) {
          result = data;
        });
        return result;
      })();

      var jsonDataSt = JSON.parse(JSON.stringify(jsonDataSt));
      console.log(jsonDataSt);
      let newData = {}
      for(let i = 0; i< jsonDataSt.length;i++) {
          let foto ='img/users/'+jsonDataSt[i].foto
          newData[jsonDataSt[i].nombre] = "";
      }

      console.log(newData)

    $('#search').autocomplete({
        data: newData
        ,
    });

    })(jQuery);

</script>

<script>
btnAgregar = document.querySelector("#agregar");

btnAgregar.addEventListener("click", () => {


    let tabla = document.querySelector('#tabla');
    let articulo = document.querySelector('#search');
    let cantidad = document.querySelector('#cantidad').value;

    


    if(articulo.value.trim()==""){
        alert('por favor ingrese articulo');
    }else{
        axios.post('/search', {
            articulo: articulo.value,
        })
        .then(function (response) {
            //Creando elementos
            if(response.data.id === undefined){
                alert("ingrese un articulo valido")
            }else{
                if(cantidad == ""){
                    alert("ingrese una cantidad valida");
                }else {
                    let tr = document.createElement("tr");
                    let td = document.createElement("td");
                    let inputID = document.createElement("input");
                    let image = document.createElement("img");

                    let inputNombre = document.createElement("input");
                    let inputDescripcion = document.createElement("input");
                    let inputDisponible = document.createElement("input");
                    let inputCantidad = document.createElement("input");
                    let buttonCancelar = document.createElement("a");

                    //agregando clases
                    inputID.classList.add("id_article");
                    image.classList.add("imagen");
                    image.classList.add("responsive-img");
                    inputNombre.classList.add("nombre");
                    inputDescripcion.classList.add("descripcion");
                    inputDisponible.classList.add("disponibilidad");
                    inputCantidad.classList.add("cantidad");
                    buttonCancelar.classList.add("btnCancelar");
                    buttonCancelar.classList.add("waves-effect");
                    buttonCancelar.classList.add("waves-light");
                    buttonCancelar.classList.add("btn");


                    //agregando atributos
                    inputID.value = response.data.id;
                    inputID.readOnly = true;
                    inputID.name = "id[]";

                    image.src ="https://ncie.test/img/warehouse/"+response.data.foto;

                    inputNombre.value = response.data.nombre;
                    inputNombre.readOnly = true;
                    inputNombre.name = "nombre[]";

                    inputDescripcion.value = response.data.descripcion;
                    inputDescripcion.readOnly = true;
                    inputDescripcion.name = "descripcion[]";
                    if(response.data.cantidad == 0 || cantidad>response.data.cantidad) {
                        alert("no hay suficientes cantidades del articulo: " + response.data.nombre);
                    }else {
                        inputDisponible.value = response.data.cantidad;
                        inputDisponible.readOnly = true;
                        inputDisponible.name = "disponible[]";

                        inputCantidad.readOnly = true;
                        inputCantidad.name = "cantidad[]";
                        inputCantidad.value = cantidad;

                        buttonCancelar.innerText ="remover";
                        buttonCancelar.setAttribute("onclick","removeParent(this);");

                        //Agregando a tabla
                        td.appendChild(inputID);
                        tr.appendChild(td);

                        td = document.createElement("td");
                        td.appendChild(inputNombre) 
                        tr.appendChild(td);

                        td = document.createElement("td");
                        td.appendChild(inputDescripcion);
                        tr.appendChild(td);

                        td = document.createElement("td");
                        td.appendChild(inputDisponible);
                        tr.appendChild(td);

                        td = document.createElement("td");
                        td.appendChild(inputCantidad);
                        tr.appendChild(td);

                        td = document.createElement("td");
                        td.appendChild(buttonCancelar);
                        tr.appendChild(td);

                        tabla.appendChild(tr);

                    }
                }
            }
            addRemover();
            
        })
        .catch(function (error) {
            console.log(error);
        });
    }
})

</script>

<script>

    

    function addRemover(){
        let size = document.getElementsByClassName("btnCancelar").length;
        let btn = document.getElementsByClassName("btnCancelar"); 
        for(let i=0;i<size;i++) {
            btn[i].addEventListener("click", function(){
                console.log("clicked" + i);
            })
        }
    }

    function removeParent(e) {
        e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode);
    }
</script>
@endsection
