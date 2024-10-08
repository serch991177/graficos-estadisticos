@extends('layouts.app', ['pageSlug' => 'reportes_facebook'])
@section('content')
<!--Grafico de Tendencias-->
<style>
    .form-inline {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .form-inline label {
        margin: 0 10px;
    }
    .form-inline .form-control {
        width: auto;
    }
    .form-inline .btn {
        margin-left: 10px;
    }
</style>
<div class="container">
    <h1 class="text-center">Generacion de informe de facebook</h1>
    <form id="date-form" action="{{route('informe_actualizado')}}" method="post" target="_blank">
        @csrf
        <div class="form-inline">
            <label for="start_date">Fecha de Inicio:</label>
            <input type="date" id="start_date" name="start_date" class="form-control">
            @error('start_date')
                <p class='text-danger inputerror'>{{ $message }} </p>
            @enderror 
            <label for="end_date">Fecha de Fin:</label>
            <input type="date" id="end_date" name="end_date" class="form-control">
            @error('end_date')
                <p class='text-danger inputerror'>{{ $message }} </p>
            @enderror  
            <button class="btn btn-success" >Generar Informe</button>
        </div>
    </form>
</div>



<!--Reporte PDF del post con mas interaccion-->
<div class="container">
    <h1 class="text-center">Generacion de Informe de Escucha Activa</h1>
    <div class="text-center">
        <form action="{{route('informe_escucha')}}" method="post" target="_blank">
            @csrf
            <button class="btn btn-primary" title="Generar Informe">Generar Informe</button>
        </form>
    </div>
</div>
@endsection    

