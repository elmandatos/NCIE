@extends('layout')
@section("title") Login @endsection
@section('content')
<div class="row">
    <form class="col s12" method="POST" action="{{ route("login") }}">
        {!! csrf_field() !!}
        <div class="row card" style="max-width: 500px; margin:auto; text-align:center">
            <div class="input-field col s12 m12 l12">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_prefix" type="text" class="validate" name="email">
                <label for="icon_prefix">Email</label>
            </div>
            <div class="input-field col s12 m12 l12">
                <i class="material-icons prefix">lock</i>
                <input id="icon_telephone" type="password" class="validate" name="password">
                <label for="icon_telephone">Contraseña</label>
            </div>
            <input type="submit" class="btn"><br><br>
        </div>
    </form>
</div>
@endsection
@section('scripts')
@endsection