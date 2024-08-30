@extends('layouts.app', ['pageSlug' => 'reportes_facebook'])
@section('content')
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

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
    <h1 class="text-center">Generacion de Informe de Escucha Activa Con mas reacciones</h1>
    <div class="text-center">
        <form action="{{route('informe_escucha')}}" method="post" target="_blank">
            @csrf
            <button class="btn btn-success" title="Generar Informe">Generar Informe</button>
        </form>
    </div>
</div>

<!--Reporte de informe escucha por fecha-->
<div class="container">
    <h1 class="text-center">Generacion de informe de Escucha por rango de fechas</h1>
    <form id="date-form" action="{{route('iforme_escucha_fecha')}}" method="post" target="_blank" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <label for="start_date">Fecha de Inicio:</label>
                <input type="date" id="start_date" name="start_date" class="form-control">
                @error('start_date')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                @enderror
            </div> 
            <div class="col-md-3">
                <label for="end_date">Fecha de Fin:</label>
                <input type="date" id="end_date" name="end_date" class="form-control">
                @error('end_date')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                @enderror
            </div>  
            <div class="col-md-3">
                <label for="">Grafico de Tortas</label>
                <input type="file" name="grafico_tortas" id="grafico_tortas" accept="image/*" class="form-control">
                @error('grafico_tortas')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                @enderror
            </div>  
            <div class="col-md-3">
                <label for="">Grafico de Barras</label>
                <input type="file" name="grafico_bar" id="grafico_bar" accept="image/*" class="form-control">
                @error('grafico_bar')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                @enderror  
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label>Seleccione un filtro </label>
                <select name="reaccion_reporte" id="reaccion_reporte" class="form-control">
                    <option value="">Seleccione una reaccion</option>
                    <option value="like_count">Likes</option>
                    <option value="love_count">Loves</option>
                    <option value="haha_count">Hahas</option>
                    <option value="wow_count">Wows</option>
                    <option value="sad_count">Sads</option>
                    <option value="angry_count">Angries</option>
                    <option value="share_count">Shares</option>
                    <option value="comments_count">Comentarios</option>
                    <option value="post_click">Clicks</option>
                    <option value="post_impressions">Impresiones</option>
                </select>
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-success" >Generar Informe</button>
        </div>    
    </form>
</div>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<script>
    if(document.querySelector('.alert-danger')) {
        setTimeout(function(){
            window.location.reload();
        }, 3000); // Redirige después de 3 segundos
    }
</script>

{{--<div class="container">
    <h1 class="text-center">Generación de informe de Escucha por rango de fechas PYTHON</h1>
    <form id="date-form" action="{{ route('informe_python') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <label for="start_date_python">Fecha de Inicio:</label>
                <input type="date" id="start_date_python" name="start_date_python" class="form-control">
                @error('start_date_python')
                    <p class='text-danger inputerror'>{{ $message }}</p>
                @enderror
            </div> 
            <div class="col-md-3">
                <label for="end_date_python">Fecha de Fin:</label>
                <input type="date" id="end_date_python" name="end_date_python" class="form-control">
                @error('end_date_python')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                @enderror
            </div>  
            <div class="col-md-3">
                <label for="archivo_python">Subir Archivo Python</label>
                <input type="file" name="archivo_python" id="archivo_python" class="form-control">
                @error('archivo_python')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                @enderror
            </div> 
        </div>
        <div class="text-center mt-3">
            <button class="btn btn-success">Generar Informe</button>
        </div>    
    </form>
</div>--}}


@endsection    

