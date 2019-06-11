@extends('layout')
@section('content')
{{-- SEARCH BAR --}}
<div class="container">
  <div class="row">
      <a href="{{ route('booking_articles.create') }}" class="waves-effect waves-light btn">Registrar Prestamo</a>
      <a class="waves-effect waves-light btn"><i class="material-icons left">cloud</i>button</a>
  </div>
    {{-- END SEARCH BAR --}}
    @foreach($booking as $articulo)


    @endforeach
  
</div>

@endsection
@section('scripts')
    
@endsection