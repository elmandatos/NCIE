@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <p class="center-align"><b>{{ $nombre }}</b></p>
    </div>
    <div class="row">
            <img src="{{ $foto }}" alt="" class="col l4 offset-l4">
    </div>
<table class="striped highlight responsive-table" id="reporte">

    <thead>
        <tr>
            <th colspan="4" style="text-align:center">{{ $nombre }} reporte de horas del {{ $fechaInicio }} al {{ $fechaFinal }}</th>
        </tr>
        <tr>
            <th>Fecha</th>
            <th>Hora de entrada</th>
            <th>Hora de salida</th>
            <th>Horas totales</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($userHours as $acceso)
            <tr>
                <td>{{ $acceso->fecha }}</td>
                <td>{{ $acceso->hora_entrada }}</td>
                <td>{{ $acceso->hora_salida }}</td>
                <td>{{ $acceso->horas_al_dia }}</td>
            </tr>
            @endforeach
            <tr>
                <td><b>Horas totales: {{ $horasTotales }}</b><td>
                <td><td>
                <td><td>
            </tr>
    </tbody>
</table>
<input type="su" class="btn" value="Generar Excel" onclick="tableToExcel('reporte','Reporte {{ $nombre }} periodo {{ $fechaInicio }} a {{ $fechaInicio }}')"></input>
{{-- <p><b>Horas totales: {{ $horasTotales }}</b></p> --}}
</div>
@endsection
@section('scripts')
 <script>
    var tableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><meta charset="UTF-8"><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
        , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
            window.location.href = uri + base64(format(template, ctx))
        }
    })()
 </script>
@endsection