@extends('layout')
@section('content')
{{-- SEARCH BAR --}}
<div class="container">
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
  
</div>

@endsection
@section('scripts')
    
@endsection