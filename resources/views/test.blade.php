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
        {{-- USER CARD DEFAULT--}}
        <div class="col l4 m6 s12">
            <div class="card hoverable">
                <div class="card-image">
                    <img src="{{ asset('img/users/user-man.png') }}">
                    <span class="card-title" style="padding-top: 30px;font-size: 1em;width: 100%; background-image: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.5), rgba(0,0,0,0.7));">
                        <b>Daniel Alfonso Jiménez Suárez</b><br>
                        <span>Ing.Sistemas Computacionales <br> Residencia</span>
                    </span>
                    <a class="btn-floating halfway-fab waves-effect waves-light amber">
                        <i class="material-icons">edit</i>
                    </a>
                    <a style="right: -15px;" class="btn-floating halfway-fab waves-effect waves-light blue">
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
                            <span style="font-size: 1.4em;">&nbsp;700:50</span>
                        </label>
                        <a class="tooltipped" data-position="top" data-tooltip="kanakemandatos@gmail.com">
                            <i class="material-icons small grey-text text-grey">mail</i>
                        </a>
                        <a class="tooltipped" data-position="top" data-tooltip="9341127035">
                            <i class="material-icons small grey-text text-grey">phone</i>
                        </a>
                    </div>


                    {{-- <p>                         
                        <label style="display: flex; aling-content:center;">
                            <i class="material-icons tinny" style="">phone</i>
                            <span style="font-size: 1.4em;"> &nbsp;9341127035</span>
                        </label>
                        <label style="display: flex; aling-content:center;">
                            <i class="material-icons tinny">mail</i>
                            <span style="font-size: 1.4em;  ">&nbsp;kanakemandatos@gmail.com</span>
                        </label>
                        <label style="display: flex; aling-content:center;">
                            <i class="material-icons tinny">access_time</i>
                            <span style="font-size: 1.4em;">&nbsp;700:50</span>
                        </label>
                    </p><br> --}}
                    <a href="#!" class="btn">ENTRAR</a>
                    <a href="#!" class="btn red">SALIR</a>
                </div>
            </div>
        </div>
        {{-- END USER CARD --}}





        {{-- USER CARD --}}
        <div class="col l4 m6 s12">
            <div class="card hoverable">
                <div class="card-image">
                    <img src="{{ asset('img/users/user-man.png') }}">
                    <span class="card-title" style="padding-top: 30px;font-size: 1em;width: 100%; background-image: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.5), rgba(0,0,0,0.7));">
                        <b>Daniel Alfonso Jiménez Suárez</b><br>
                        <span>Ing.Sistemas Computacionales <br> Residencia</span>
                    </span>
                    <a class="btn-floating halfway-fab waves-effect waves-light amber">
                        <i class="material-icons">edit</i>
                    </a>
                    <a style="right: -15px;top:-15px;" class="btn-floating halfway-fab waves-effect waves-light red">
                        <i class="material-icons">delete</i>
                    </a>
                </div>
                <div class="card-content">
                    <label>
                        <i class="material-icons tinny" style="display: inline;">mail</i><span style="font-size: 1.4em; word-wrap: break-word;display: inline; ">kanakasdfasdfasdemandatos@gmail.com</span>
                    </label>
                    <p>                         
                        <label style="display: flex; aling-content:center;">
                            <i class="material-icons tinny" style="">phone</i><br>
                            <span style="font-size: 1.4em;"> &nbsp;9341127035</span>
                        </label>
                        <label style="display: flex; aling-content:center;">
                            <i class="material-icons tinny">access_time</i>
                            <span style="font-size: 1.4em;">&nbsp;700:50</span>
                        </label>
                    </p><br>
                    <a href="#!" class="btn">ENTRAR</a>
                    <a href="#!" class="btn red">SALIR</a>
                </div>
            </div>
        </div>
        {{-- END USER CARD --}}

        {{-- USER CARD --}}
        <div class="col l4 m6 s12">
            <div class="card hoverable">
                <div class="card-image">
                    <img src="{{ asset('img/users/user-woman.png') }}">
                    <span class="card-title" style="padding-top: 30px;font-size: 1em;width: 100%; background-image: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.5), rgba(0,0,0,0.7));">
                        <b>Daniela Jiménez Suárez</b><br>
                        <span>Ing.Sistemas Computacionales <br> Residencia</span>
                    </span>
                    <a class="btn-floating halfway-fab waves-effect waves-light amber">
                        <i class="material-icons">edit</i>
                    </a>
                    <a style="right: -15px;top:-15px;" class="btn-floating halfway-fab waves-effect waves-light red">
                        <i class="material-icons">delete</i>
                    </a>
                </div>
                <div class="card-content">
                    <p>                         
                        <label style="display: flex; aling-content:center;">
                            <i class="material-icons tinny" style="">phone</i>
                            <span style="font-size: 1.4em;"> &nbsp;9341127035</span>
                        </label>
                        <div>

                            <label style="display: flex; aling-content:center;">
                                <i class="material-icons tinny">mail</i>
                                <span style="font-size: 1.4em;word-wrap: break-word;">&nbsp;kanakemandatos@gmail.com</span>
                            </label>
                        </div>
                        <label style="display: flex; aling-content:center;">
                            <i class="material-icons tinny">access_time</i>
                            <span style="font-size: 1.4em;">&nbsp;700:50</span>
                        </label>
                    </p><br>
                    <a href="#!" class="btn">ENTRAR</a>
                    <a href="#!" class="btn red">SALIR</a>
                </div>
            </div>
        </div>
        {{-- END USER CARD --}}        
    </div>
</div>
@endsection