@extends('layout')
@section('content')
<div class="container center-align">
    <div class="qr">
        <p>Escanea el <br><br><b>código QR</b></p>
        <img src="{{asset("qr.png")}}" alt="">
        <video class="responsive-video" id="preview"></video>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ secure_asset('/js/instascan.min.js')}}" type="text/javascript"></script>
    <script src="{{ secure_asset('/js/camera.js')}}" type="text/javascript"></script>
@endsection