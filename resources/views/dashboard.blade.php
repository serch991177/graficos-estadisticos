@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<!--Cards del total de las Reacciones-->
<div class="container">
    <div class="row">
        <style>
            .bg-lightblue {
                background-color: #AEC6CF !important;
            }

            .bg-lightpink {
                background-color: #FFB6C1 !important;
            }

            .bg-lightyellow {
                background-color: #FDFD96 !important;
            }

            .bg-lightorange {
                background-color: #FFDAB9 !important;
            }

            .bg-lightpurple {
                background-color: #D1CFE2 !important;
            }

            .bg-lightcoral {
                background-color: #F08080 !important;
            }

            .bg-lightteal {
                background-color: #B2DFDB !important;
            }

            .bg-lightgrey {
                background-color: #D3D3D3 !important;
            }

        </style>
        <!-- Total de me gustas -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #80D4E5;">
                <div class="card-header">
                    <i class="fas fa-thumbs-up"></i> Total de me gustas
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalLikes }}</h5>
                </div>
            </div>
        </div>
        <!-- Total de me enamoras -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #C080C0;">
                <div class="card-header">
                    <i class="fas fa-heart"></i> Total de me enamoras
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalLoves }}</h5>
                </div>
            </div>
        </div>
        <!-- Total de me diviertes -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #F497B7;">
                <div class="card-header">
                    <i class="fas fa-smile"></i> Total de me diviertes
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalHahas }}</h5>
                </div>
            </div>
        </div>
        <!-- Total de me asombras -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #E89A9A;">
                <div class="card-header">
                    <i class="fas fa-surprise"></i> Total de me asombras
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalWows }}</h5>
                </div>
            </div>
        </div>
        <!-- Total de me entristece -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #D080D0;">
                <div class="card-header">
                    <i class="fas fa-frown"></i> Total de me entristece
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalSads }}</h5>
                </div>
            </div>
        </div>
        <!-- Total de me enojas -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #F4A4A4;">
                <div class="card-header">
                    <i class="fas fa-angry"></i> Total de me enojas
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalAngries }}</h5>
                </div>
            </div>
        </div>
        <!-- Total de compartidas -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #80C0C0;">
                <div class="card-header">
                    <i class="fas fa-share"></i> Total de compartidas
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalShares }}</h5>
                </div>
            </div>
        </div>
        <!-- Total de Comentarios -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #C0C0C0;">
                <div class="card-header">
                    <i class="fas fa-comments"></i> Total de Comentarios
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalComments }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #myPieChart {width: 450px !important;height: 450px !important;}
</style>
<!--Fin Cards del total de las Reacciones-->
<br><br>
<!--Pie de los totales de las reacciones-->
<div class="container">
    <h1 class="text-center">Reacciones de Publicaciones de Facebook</h1>
    <div class="row">
        <div class="col-md-12 canvas-container" style="display:flex;justify-content:center;">
            <canvas id="myPieChart"></canvas>
        </div>
    </div>
</div>
<!--Fin Pie de los totales de las reacciones-->
<br>
<!--CAMBIOS -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
            <div class="card-header">
                <h4 class="card-title"> Publicaciones de Facebook</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <style>
                        table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        th, td {
                            border: 1px solid black;
                            padding: 8px;
                            text-align: center;
                            width: 5.5%; /* Ancho fijo para cada columna en un total de 8 columnas */
                        }
                        caption {
                            caption-side: top;
                            font-size: 1.5em;
                            font-weight: bold;
                            margin-bottom: 10px;
                        }
                    </style>
                    <table id="example123" class="display  table tablesorter" style="width:100%">
                        <thead>
                            <tr>
                                @foreach ( $heads as $head)
                                    <th>{!! $head !!}</th>
                                @endforeach
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!--fin cambios-->

<!--Tabla de publicaciones de Facebook-->

<br>
<style>
    #myPieModal {
        width: 400px;
        height: 400px;
    }
</style>

<!--Mapa con paises-->
<div class="container">
    <h1 class="text-center">Mapa Estadistico</h1>
    <div class="row">
        <div class="col-md-12 canvas-container" style="display:flex;justify-content:center;">
            <div id="myMap" style="height: 500px; min-width: 810px"></div>
        </div>
    </div>
</div>
<br>
<!--Tabla de paises con mas fans-->
<div class="container"> 
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center"> Top 10 Paises con mas fans</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display  table tablesorter" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Numero</th>
                                    <th>Nombre del Pais</th>
                                    <th>Numero de Fans</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php($contadorcountry = 1)
                                @foreach ( $topcountries as $topcountry)
                                    <tr>
                                        <td>{{$contadorcountry}}</td>
                                        <td>{{$topcountry['pais']}}</td>
                                        <td>{{$topcountry['fan_count']}}</td>
                                    </tr>
                                    @php($contadorcountry++)
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Mapa con todas las ciudades-->
<div class="container" style="display:none">
    <h1 class="text-center">Numero de fans de por Ciudad</h1>
    <div class="row">
        <div id="BarRace" style="height: 500px; width: 100%;"   ></div>
    </div>
</div>
<!--grafico de todas las ciudades-->
<br>
<div class="container">
    <h1 class="text-center">Numero de fans en todas las ciudades</h1>
    <div class="row">
        <div class="form-inline">
            <!-- Filtro por país -->
            <label >Seleccione un país :</label>
            <select id="countryFilter" class="form-control" onchange="updateChart()">
                <option value="">Seleccione un país</option>
                <!-- Las opciones de países se llenarán dinámicamente en el script -->
            </select>
            <label >Seleccione un rango</label>
            <select id="dataCount" class="form-control" onchange="updateChart()">
                <option value="">Seleccione un rango </option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
            </select>
        </div>
        <div id="BarFans" style="width: 100%; height: 400px;"></div>
    </div>
</div>
<!--Grafico de Impresiones-->
<br>
<div class="container">
    <h1 class="text-center">Impresiones de Pagina por Grupo de Edad y Sexo</h1>
    <div class="row">
        <div id="chartImpressions" style="width: 100%; height: 400px;"></div>
    </div>
</div>
<br>
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
    <h1 class="text-center">Grafica de Tendencia</h1>
    <form id="date-form">
        <div class="form-inline">
            <label for="start-date">Fecha de Inicio:</label>
            <input type="date" id="start-date" name="start-date" class="form-control">
            <label for="end-date">Fecha de Fin:</label>
            <input type="date" id="end-date" name="end-date" class="form-control">
            <button class="btn btn-success" type="button" onclick="updateChartTrend()" >Actualizar Gráfica</button>
        </div>
    </form>
    <div class="row">
        <div id="trendContainer" style="width:100%; height:400px;"></div>   
    </div>
</div>
<!--Grafico de tendencias mas comentarios-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas comentadas</h1>
    <div class="row">
        <form id="filters-form">
            <div class="form-inline">
                <label for="limit">Número de posts:</label>
                <select id="limit" name="limit" class="form-control">
                    <option value="15">15 publicaciones</option>
                    <option value="20">20 publicaciones</option>
                    <option value="30">30 publicaciones</option>
                </select>
                <label for="start_date">Fecha de inicio:</label>
                <input type="date" id="start_date" name="start_date" class="form-control">
                
                <label for="end_date">Fecha de fin:</label>
                <input type="date" id="end_date" name="end_date" class="form-control">
                
                <button type="button" class="btn btn-success" onclick="fetchTopPosts()">Filtrar</button>
            </div>
        </form>
        <div id="charttendenciacomment" style="width: 100%; height: 600px;"></div>
    </div>
</div>
<!--Grafico de tendencias con mas likes-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas Likes</h1>
    <div class="row">
        <form>
            <div class="form-inline">
                <label for="limit">Número de posts:</label>
                <select id="limit-selector-likes" name="limit-selector-likes" class="form-control">
                    <option value="15">15 publicaciones</option>
                    <option value="20">20 publicaciones</option>
                    <option value="30">30 publicaciones</option>
                </select>
                <label for="start_date">Fecha de inicio:</label>
                <input type="date" id="start_date_likes" name="start_date_likes" class="form-control">
                
                <label for="end_date">Fecha de fin:</label>
                <input type="date" id="end_date_likes" name="end_date_likes" class="form-control">
                
                <button type="button" class="btn btn-success" onclick="fetchTopLikes()">Filtrar</button>
            </div>
        </form>
        <div id="charttendencialikes" style="width: 100%; height: 600px;"></div>
    </div>
</div> 
<!--Grafico de tendencias con mas loves-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas loves</h1>
    <div class="row">
        <form >
            <div class="form-inline">
            <label for="limit">Número de posts:</label>
                <select id="limit-selector-loves" name="limit-selector-loves" class="form-control">
                    <option value="15">15 publicaciones</option>
                    <option value="20">20 publicaciones</option>
                    <option value="30">30 publicaciones</option>
                </select>
                <label for="start_date">Fecha de inicio:</label>
                <input type="date" id="start_date_loves" name="start_date_loves" class="form-control">
                
                <label for="end_date">Fecha de fin:</label>
                <input type="date" id="end_date_loves" name="end_date_loves" class="form-control">

                <button type="button" class="btn btn-success" onclick="fetchTopLoves()">Filtrar</button>
            </div>    
        </form>
        <div id="charttendencialoves" style="width: 100%; height: 600px;"></div>
    </div>
</div>
<!--Grafico de tendencias con mas hahas-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas hahas</h1>
    <div class="row">
        <form>
            <div class="form-inline">
                <label for="limit">Número de posts:</label>
                <select id="limit-selector-hahas" name="limit-selector-hahas" class="form-control">
                    <option value="15">15 publicaciones</option>
                    <option value="20">20 publicaciones</option>
                    <option value="30">30 publicaciones</option>
                </select>
                
                <label for="start_date">Fecha de inicio:</label>
                <input type="date" id="start_date_hahas" name="start_date_hahas" class="form-control">
                
                <label for="end_date">Fecha de fin:</label>
                <input type="date" id="end_date_hahas" name="end_date_hahas" class="form-control">

                <button type="button" class="btn btn-success" onclick="fetchTopHahas()">Filtrar</button>
            </div>
        </form>
        <div id="charttendenciahahas" style="width: 100%; height: 600px;"></div>
    </div>
</div> 
<!--Grafico de tendencias con mas wows-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas wows</h1>
    <div class="row">
        <form>
            <div class="form-inline">
                <label for="limit">Número de posts:</label>
                <select id="limit-selector-wows" name="limit-selector-wows" class="form-control">
                    <option value="15">15 publicaciones</option>
                    <option value="20">20 publicaciones</option>
                    <option value="30">30 publicaciones</option>
                </select>
                <label for="start_date">Fecha de inicio:</label>
                <input type="date" id="start_date_wows" name="start_date_wows" class="form-control">
                <label for="end_date">Fecha de fin:</label>
                <input type="date" id="end_date_wows" name="end_date_wows" class="form-control">
                <button type="button" class="btn btn-success" onclick="fetchTopWows()">Filtrar</button>
            </div>
        </form>
        <div id="charttendenciawows" style="width: 100%; height: 600px;"></div>
    </div>
</div> 
<!--Grafico de tendencias con mas sads-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas sads</h1>
    <div class="row">
        <form>
            <div class="form-inline">    
                <label for="limit">Número de posts:</label>
                <select id="limit-selector-sads" name="limit-selector-sads" class="form-control">
                    <option value="15">15 publicaciones</option>
                    <option value="20">20 publicaciones</option>
                    <option value="30">30 publicaciones</option>
                </select>
                <label for="start_date">Fecha de inicio:</label>
                <input type="date" id="start_date_sads" name="start_date_sads" class="form-control">
                <label for="end_date">Fecha de fin:</label>
                <input type="date" id="end_date_sads" name="end_date_sads" class="form-control">
                <button type="button" class="btn btn-success" onclick="fetchTopSads()">Filtrar</button>
            </div>
        </form>
        <div id="charttendenciasads" style="width: 100%; height: 600px;"></div>
    </div>
</div> 
<!--Grafico de tendencias con mas angries-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas angries</h1>
    <div class="row">
        <form>
            <div class="form-inline">
                <label for="limit">Número de posts:</label>
                <select id="limit-selector-angries" name="limit-selector-angries" class="form-control">
                    <option value="15">15 publicaciones</option>
                    <option value="20">20 publicaciones</option>
                    <option value="30">30 publicaciones</option>
                </select>
                <label for="start_date">Fecha de inicio:</label>
                <input type="date" id="start_date_angries" name="start_date_angries" class="form-control">
                <label for="end_date">Fecha de fin:</label>
                <input type="date" id="end_date_angries" name="end_date_angries" class="form-control">
                <button type="button" class="btn btn-success" onclick="fetchTopAngries()">Filtrar</button>
            </div>
        </form>
        <div id="charttendenciaangries" style="width: 100%; height: 600px;"></div>
    </div>
</div>
<!--Grafico de tendencias con mas shares-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas shares</h1>
    <div class="row">
        <form>
            <div class="form-inline">
                <label for="limit">Número de posts:</label>
                <select id="limit-selector-shares" name="limit-selector-shares" class="form-control">
                    <option value="15">15 publicaciones</option>
                    <option value="20">20 publicaciones</option>
                    <option value="30">30 publicaciones</option>
                </select>
                <label for="start_date">Fecha de inicio:</label>
                <input type="date" id="start_date_shares" name="start_date_shares" class="form-control">
                <label for="end_date">Fecha de fin:</label>
                <input type="date" id="end_date_shares" name="end_date_shares" class="form-control">
                <button type="button" class="btn btn-success" onclick="fetchTopShares()">Filtrar</button>
            </div>
        </form>
        <div id="charttendenciashares" style="width: 100%; height: 600px;"></div>
    </div>
</div>
<!--Grafico Mapa de Bolivia-->
<!--<div class="container">
    <h1 class="text-center">Mapa de Bolivia</h1>
    <div class="row">
        <div id="mapaBolivia" style="width: 100%; height: 600px;"></div>
    </div>
</div>-->
<!--Reporte PDF del post con mas interaccion-->
{{--<div class="container">
    <h1 class="text-center">Informe de Escucha Activa</h1>
    <div class="text-center">
        <form action="{{route('informe_escucha')}}" method="post" target="_blank">
            @csrf
            <button class="btn btn-primary" title="Generar Informe">Generar Informe</button>
        </form>
    </div>
</div>--}}
<!--Nuevo Reporte-->
{{--<div class="container">
    <h1 class="text-center">Informe Actualizado</h1>
    <div class="text-center">
        <form action="{{route('informe_actualizado')}}" method="post" target="_blank">
            @csrf
            <button class="btn btn-primary" title="Generar Informe">Generar Informe</button>
        </form>
    </div>
</div>--}}
<!-- Modal Graficas-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title col-11 text-center" id="exampleModalLabel">Grafico de Tortas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <h1 class="text-center">Reacciones de Publicaciones de Facebook</h1>
            <canvas id="myPieModal" width="400" height="400"></canvas>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
<!--Fin Modal Graficas-->
<!--Bar Race-->
<!--Scripts de ciudades-->
<!--Scripts de javascript-->
<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/mapdata/custom/world.js"></script>
<script src="https://code.highcharts.com/maps/modules/map.js"></script>

<script src="https://code.highcharts.com/mapdata/countries/bo/bo-all.js"></script>
<script src="https://code.highcharts.com/mapdata/custom/world.js"></script>
<!--cdn javascript datatable-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<!--fin cdn javascript datatable-->
<!--Scripts Google Chart-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- inicializacion de data table-->
<script>
    $('#example123').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('tablepost') }}",
            "type": "GET"
        },
        "columns": [
            { "data": "id" },
            {
                "data": "story",
                "render": function(data, type, row) {
                    if (data.length > 100) {
                        var truncated = data.substring(0, 100) + '...';
                        return '<span title="' + data.replace(/"/g, '&quot;') + '">' + truncated + '</span>';
                    } else {
                        return data;
                    }
                }
            },
            { 
                "data": "full_picture" ,
                "render": function(data, type, row) {
                    if (!data) {
                        data = "https://scontent.fcbb3-1.fna.fbcdn.net/v/t1.6435-9/121240003_204482091112281_7819078301545357074_n.png?_nc_cat=108&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=9opBn_jPZxkQ7kNvgEqLLRo&_nc_ht=scontent.fcbb3-1.fna&oh=00_AYAwE3tarz9rwsjLCPBRhehKMUJTXvHGNSmps0J68_BdeQ&oe=66E01D43";
                    }
                    return '<img src="' + data + '" style="width: 150px !important; height: 150px; object-fit: cover;">';
                }   
            },
            { 
                "data": "permalink_url",
                "render":function(data,type,row){
                    return '<a href="' + data + '" target="_blank">Link Publicacion</a>'
                } 
            },
            { "data": "created_time" },
            { "data": "comments_count" },
            { "data": "like_count" },
            { "data": "love_count" },
            { "data": "haha_count" },
            { "data": "wow_count" },
            { "data": "sad_count" },
            { "data": "angry_count" },
            { "data": "share_count" },
            { 
                "data": null,
                "render": function(data, type, row) {
                    return `
                        <button type="button" class="btn btn-primary id_graficar" value="${row.id}" data-toggle="modal" data-target="#exampleModal">
                            Generar Grafica
                        </button>
                        <br><br>
                        <form action="{{ route('informe_id_escucha') }}" method="post" target="_blank">
                            @csrf 
                            <input type="hidden" name="id" value="${row.id}">
                            <button class="btn btn-warning">Generar Pdf</button>
                        </form>
                    `;
                }
            }
        ],
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "pageLength": 15 // Asegúrate de que esté configurado según tus necesidades
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- fin inicializacion de data table-->
<!---grafico torta-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('myPieChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json($data['labels']),
                datasets: [{
                    data: @json($data['values']),
                    backgroundColor: ['#A8DDEB', '#C0E1F7', '#CFEFF4', '#A1D7D9', '#D4B3E6', '#F7C8D9', '#E8A4B8', '#D9D9D9']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
<!--grafico mapa -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        //obtener los datos 
        // obtener los datos del backend
        const dataMap = {!! $jsonDataMap !!};
        //console.log(dataMap);

        Highcharts.mapChart('myMap', {
            chart: {
                map: 'custom/world'
            },
            title: {
                text: 'Mapa Mundial'
            },
            subtitle: {
                text: 'Numero de fans en el mundo'
            },
            mapNavigation: {
                enabled: true,
                buttonOptions: {
                    verticalAlign: 'bottom'
                }
            },
            colorAxis: {
                min:0,
                stops: [
                    [0, '#D4B3E6'], // Color púrpura pastel en hexadecimal
                    [0.5, '#A8DDEB'], // Color azul pastel en hexadecimal
                    [1, '#F7C8D9'] // Color rosa pastel en hexadecimal
                ]
            },
            series: [{
                data:dataMap,
                name: 'Numero de Fans',
                color: '#D4B3E6',
                states: {
                    hover: {
                        color: '#A8DDEB'
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }]
        });
    });
</script>
<!--Grafico de todo el conteo de fans-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dataCities = @json($dataCities2);

        // Extraer los nombres de las ciudades, países y conteo de fans
        var cityNames = dataCities.map(function (city) {
            return city.city_name;
        });

        var fanCounts = dataCities.map(function (city) {
            return parseInt(city.fan_count);
        });

        var countries = dataCities.map(function (city) {
            return city.city_name.split(', ').pop(); // Extraer el país del nombre de la ciudad
        });

        // Obtener países únicos
        var uniqueCountries = [...new Set(countries)];

        // Llenar el select de países
        var countrySelect = document.getElementById('countryFilter');
        uniqueCountries.forEach(function (country) {
            var option = document.createElement('option');
            option.value = country;
            option.text = country;
            countrySelect.appendChild(option);
        });

        var chartCity = Highcharts.chart('BarFans', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Conteo de fanes por Ciudad'
            },
            xAxis: {
                categories: cityNames,
                title: {
                    text: 'City'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Fan Count',
                    align: 'high'
                }
            },
            tooltip: {
                valueSuffix: ' fans'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            series: [{
                name: 'Fans',
                data: fanCounts,
                color: '#D4B3E6'
            }]
        });

        window.updateChart = function() {
            var selectedCountry = document.getElementById('countryFilter').value;
            var count = parseInt(document.getElementById('dataCount').value);

            var filteredData = dataCities.filter(function(city) {
                return selectedCountry === '' || city.city_name.includes(selectedCountry);
            });

            if (count > 0) {
                filteredData = filteredData.slice(0, count);
            }

            var filteredCityNames = filteredData.map(function (city) {
                return city.city_name;
            });

            var filteredFanCounts = filteredData.map(function (city) {
                return parseInt(city.fan_count);
            });

            chartCity.xAxis[0].setCategories(filteredCityNames);
            chartCity.series[0].setData(filteredFanCounts);
        };
    });
</script>

<!--Grafico de impresiones de edad-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dataImpressions = @json($dataImpressions);
        var categories = dataImpressions.map(function (item) {
            return item.age_gender_group;
        });
        var impressions = dataImpressions.map(function (item) {
            return parseInt(item.impressions_count);
        });
        Highcharts.chart('chartImpressions', {
            chart: {
                type: 'area',
                options3d: {
                    enabled: true
                }
            },
            title: {
                text: 'Impresiones de Página por Grupo de Edad y Sexo'
            },
            xAxis: {
                categories: categories,
                title: {
                    text: 'Grupo de Edad y Sexo'
                }
            },
            yAxis: {
                title: {
                    text: 'Cantidad de Impresiones'
                }
            },
            tooltip: {
                pointFormat: 'Impresiones: <b>{point.y}</b>'
            },
            plotOptions: {
                area: {
                    stacking: 'normal',
                    lineColor: '#B4AEE8',
                    lineWidth: 1,
                    marker: {
                        lineWidth: 1,
                        lineColor: '#B4AEE8'
                    },
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            series: [{
                name: 'Impresiones',
                data: impressions,
                color: '#D4B3E6' // Color púrpura para las áreas
            }]
        });
    });
</script>
<!--Funcion para recupera id de las graficas-->
<script>
    $(document).ready(function(){
        var myPieChart;
        $(document).on('click', '.id_graficar', function(){
            var id = $(this).val();
            // Mostrar el spinner y ocultar el canvas al hacer clic en el botón
            $('#spinner').show();
            $('#myPieModal').hide();
            $.ajax({
                type: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                url: "{{ route('recuperar_id_grafica') }}",
                async: false,
                data: JSON.stringify({'id': id}),
                success: function(data) {
                    // Destruir el gráfico existente si existe
                    if (myPieChart) {
                        myPieChart.destroy();
                    }
                    // Asegúrate de que el modal esté visible
                    $('#exampleModal').modal('show');
                    // Retraso para asegurar que el modal está completamente visible
                    setTimeout(function() {
                        var ctx = document.getElementById('myPieModal').getContext('2d');
                        myPieChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: data.dibujar_torta.labels,
                                datasets: [{
                                    data: data.dibujar_torta.values,
                                    backgroundColor: ['#A8DDEB', '#C0E1F7', '#CFEFF4', '#A1D7D9', '#D4B3E6', '#F7C8D9', '#E8A4B8', '#D9D9D9']
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function (tooltipItem) {
                                                return tooltipItem.label + ': ' + tooltipItem.raw;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                        // Ocultar el spinner y mostrar el canvas después de que se haya cargado el gráfico
                        $('#spinner').hide();
                        $('#myPieModal').show();
                    }, 500); // Ajusta el tiempo según sea necesario
                },
                error: function() {
                    // En caso de error, ocultar el spinner
                    $('#spinner').hide();
                }
            });
        });
    });
</script>
<!--Grafico de Tendencias-->
<script>
    let chartTrend;
    // Inicializar la gráfica con datos vacíos
    function initChart() {
        chartTrend = Highcharts.chart('trendContainer', {
            chart: { type: 'line' },
            title: { text: 'Gráfica por Rango de Fechas' },
            xAxis: { categories: [], title: { text: 'Fecha' } },
            yAxis: { title: { text: 'Cantidad' } },
            series: [
            { name: 'Likes', data: [], color: '#FFB3BA' },    // Rosa pastel
            { name: 'Loves', data: [], color: '#FFDFBA' },    // Naranja pastel
            { name: 'Hahas', data: [], color: '#FFFFBA' },    // Amarillo pastel
            { name: 'Wows', data: [], color: '#B3E5FC' },     // Azul pastel
            { name: 'Sads', data: [], color: '#B4AEE8' },     // Púrpura pastel
            { name: 'Angries', data: [], color: '#FFDAC1' }   // Melocotón pastel
        ]
        });
    }

    // Actualizar la gráfica con datos del servidor
    function updateChartTrend() {
        const startDate = document.getElementById('start-date').value;
        const endDate = document.getElementById('end-date').value;
        $.ajax({
            url: '/get-chart-data', // Ruta a la acción que devolverá los datos
            method: 'GET',
            data: {
                start_date: startDate,
                end_date: endDate
            },
            success: function (data) {
                chartTrend.update({
                    xAxis: { categories: data.dates },
                    series: [
                    { name: 'Likes', data: data.likes, color: '#FFB3BA' },    // Rosa pastel
                    { name: 'Loves', data: data.loves, color: '#FFDFBA' },    // Naranja pastel
                    { name: 'Hahas', data: data.hahas, color: '#FFFFBA' },    // Amarillo pastel
                    { name: 'Wows', data: data.wows, color: '#B3E5FC' },      // Azul pastel
                    { name: 'Sads', data: data.sads, color: '#B4AEE8' },      // Púrpura pastel
                    { name: 'Angries', data: data.angries, color: '#FFDAC1' } // Melocotón pastel
                ]
                });
            }
        });
    }

    // Inicializar la gráfica al cargar la página
    document.addEventListener('DOMContentLoaded', initChart);
</script>
<!--Grafico de tendencias comentario -->
<script>
    function fetchTopPosts() {
        const limit = document.getElementById('limit').value;
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;

        $.ajax({
            url: `/api/facebook-posts`,
            method: 'GET',
            data: {
                limit: limit,
                start_date: startDate,
                end_date: endDate
            },
            success: function(data) {
                renderChart(data);
            }
        });
    }

    function renderChart(posts) {
        const categories = posts.map(post => post.story);
        const data = posts.map(post => parseInt(post.comments_count));

        Highcharts.chart('charttendenciacomment', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Publicaciones Más Comentadas'
            },
            xAxis: {
                categories: categories,
                title: {
                    text: 'Publicaciones'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de Comentarios'
                }
            },
            series: [{
                name: 'Comentarios',
                data: data,
                color: '#B3E5FC'  // Azul pastel
            }]
        });
    }
</script>
<!--Grafico de tendencias likes-->
<script>
    function fetchTopLikes() {
        const limit = document.getElementById('limit-selector-likes').value;
        const startDate = document.getElementById('start_date_likes').value;
        const endDate = document.getElementById('end_date_likes').value;

        $.ajax({
            url: `/api/facebook-likes`,
            method: 'GET',
            data: {
                limit: limit,
                start_date: startDate,
                end_date: endDate
            },
            success: function(data) {
                renderChartLikes(data);
            }
        });
    }
    function renderChartLikes(posts) {
        const categories = posts.map(post => post.story);
        const data = posts.map(post => parseInt(post.likes_count));

        Highcharts.chart('charttendencialikes', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Publicaciones Con mas Likes'
            },
            xAxis: {
                categories: categories,
                title: {
                    text: 'Publicaciones'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de Likes'
                }
            },
            series: [{
                name: 'Likes',
                data: data,
                color: '#B3E5FC'  // Azul pastel
            }]
        });
    }
</script>
<!--Grafico de tendencias loves-->
<script>
        
   function fetchTopLoves() {
        const limit = document.getElementById('limit-selector-loves').value;
        const startDate = document.getElementById('start_date_loves').value;
        const endDate = document.getElementById('end_date_loves').value;

        $.ajax({
            url: `/api/facebook-loves`,
            method: 'GET',
            data: {
                limit: limit,
                start_date: startDate,
                end_date: endDate
            },
            success: function(data) {
                renderChartLoves(data);
            }
        });
    }
    function renderChartLoves(posts) {
        const categories = posts.map(post => post.story);
        const data = posts.map(post => parseInt(post.loves_count));

        Highcharts.chart('charttendencialoves', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Publicaciones Con Mas Loves'
            },
            xAxis: {
                categories: categories,
                title: {
                    text: 'Publicaciones'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de Loves'
                }
            },
            series: [{
                name: 'Loves',
                data: data,
                color: '#B3E5FC'  // Azul pastel

            }]
        });
    }
</script>
<!--Grafico de tendencias haha-->
<script> 
    function fetchTopHahas() {
        const limit = document.getElementById('limit-selector-hahas').value;
        const startDate = document.getElementById('start_date_hahas').value;
        const endDate = document.getElementById('end_date_hahas').value;

        $.ajax({
            url: `/api/facebook-haha`,
            method: 'GET',
            data: {
                limit: limit,
                start_date: startDate,
                end_date: endDate
            },
            success: function(data) {
                renderChartHahas(data);
            }
        });
    }
    function renderChartHahas(posts) {
        const categories = posts.map(post => post.story);
        const data = posts.map(post => parseInt(post.hahas_count));

        Highcharts.chart('charttendenciahahas', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Publicaciones con mas Hahas'
            },
            xAxis: {
                categories: categories,
                title: {
                    text: 'Publicaciones'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de Hahas'
                }
            },
            series: [{
                name: 'Hahas',
                data: data,
                color: '#B3E5FC'  // Azul pastel

            }]
        });
    }
</script>
<!--Grafico de tendencias wow-->
<script>
    function fetchTopWows() {
        const limit = document.getElementById('limit-selector-wows').value;
        const startDate = document.getElementById('start_date_wows').value;
        const endDate = document.getElementById('end_date_wows').value;

        $.ajax({
            url: `/api/facebook-wow`,
            method: 'GET',
            data: {
                limit: limit,
                start_date: startDate,
                end_date: endDate
            },
            success: function(data) {
                renderChartWows(data);
            }
        });
    }
    function renderChartWows(posts) {
        const categories = posts.map(post => post.story);
        const data = posts.map(post => parseInt(post.wows_count));

        Highcharts.chart('charttendenciawows', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Publicaciones con mas Wows'
            },
            xAxis: {
                categories: categories,
                title: {
                    text: 'Publicaciones'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de Wows'
                }
            },
            series: [{
                name: 'Wows',
                data: data,
                color: '#B3E5FC'  // Azul pastel

            }]
        });
    }
</script>
<!--Grafico de tendencias sad-->
<script>
    function fetchTopSads() {
        const limit = document.getElementById('limit-selector-sads').value;
        const startDate = document.getElementById('start_date_sads').value;
        const endDate = document.getElementById('end_date_sads').value;

        $.ajax({
            url: `/api/facebook-sad`,
            method: 'GET',
            data: {
                limit: limit,
                start_date: startDate,
                end_date: endDate
            },
            success: function(data) {
                renderChartSads(data);
            }
        });
    }
    function renderChartSads(posts) {
        const categories = posts.map(post => post.story);
        const data = posts.map(post => parseInt(post.sads_count));

        Highcharts.chart('charttendenciasads', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Publicaciones con mas Sads'
            },
            xAxis: {
                categories: categories,
                title: {
                    text: 'Publicaciones'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de Sads'
                }
            },
            series: [{
                name: 'Sads',
                data: data,
                color: '#B3E5FC'  // Azul pastel

            }]
        });
    }
</script>
<!--Grafico de tendencias angry-->
<script>     
    function fetchTopAngries() {
        const limit = document.getElementById('limit-selector-angries').value;
        const startDate = document.getElementById('start_date_angries').value;
        const endDate = document.getElementById('end_date_angries').value;

        $.ajax({
            url: `/api/facebook-angry`,
            method: 'GET',
            data: {
                limit: limit,
                start_date: startDate,
                end_date: endDate
            },
            success: function(data) {
                renderChartAngries(data);
            }
        });
    }
    function renderChartAngries(posts) {
        const categories = posts.map(post => post.story);
        const data = posts.map(post => parseInt(post.angries_count));

        Highcharts.chart('charttendenciaangries', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Publicaciones con mas Angries'
            },
            xAxis: {
                categories: categories,
                title: {
                    text: 'Publicaciones'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de Angries'
                }
            },
            series: [{
                name: 'Angries',
                data: data,
                color: '#B3E5FC'  // Azul pastel

            }]
        });
    }
</script>
<!--Grafico de tendencias share-->
<script>
    function fetchTopShares() {
        const limit = document.getElementById('limit-selector-shares').value;
        const startDate = document.getElementById('start_date_shares').value;
        const endDate = document.getElementById('end_date_shares').value;

        $.ajax({
            url: `/api/facebook-share`,
            method: 'GET',
            data: {
                limit: limit,
                start_date: startDate,
                end_date: endDate
            },
            success: function(data) {
                renderChartShares(data);
            }
        });
    }
    function renderChartShares(posts) {
        const categories = posts.map(post => post.story);
        const data = posts.map(post => parseInt(post.shares_count));

        Highcharts.chart('charttendenciashares', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Publicaciones con mas Compartidas'
            },
            xAxis: {
                categories: categories,
                title: {
                    text: 'Publicaciones'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Número de Compartidas'
                }
            },
            series: [{
                name: 'Compartidas',
                data: data,
                color: '#B3E5FC'  // Azul pastel

            }]
        });
    }
</script>
<!--Mapa de Bolivia -->
<script>
    //mapaBolivia
    document.addEventListener('DOMContentLoaded', function () {
        const data = [
            { "name": "La Paz", "y": 12345 },
            { "name": "El Alto", "y": 11000 },
            { "name": "Santa Cruz", "y": 23456 },
            { "name": "Montero", "y": 15000 },
            { "name": "Cochabamba", "y": 34567 },
            { "name": "Sacaba", "y": 12000 },
            { "name": "Sucre", "y": 4567 },
            { "name": "Potosí", "y": 5678 },
            { "name": "Oruro", "y": 6789 },
            { "name": "Tarija", "y": 7890 },
            { "name": "Cobija", "y": 890 },
            { "name": "Trinidad", "y": 901 }
        ];

        Highcharts.mapChart('mapaBolivia', {
            chart: {
                map: 'countries/bo/bo-all'
            },

            title: {
                text: 'Ciudades de Bolivia con datos de fans'
            },

            subtitle: {
                text: 'Datos estáticos'
            },

            mapNavigation: {
                enabled: true,
                buttonOptions: {
                    verticalAlign: 'bottom'
                }
            },

            colorAxis: {
                min: 0
            },

            series: [{
                data: data,
                name: 'Fans count',
                states: {
                    hover: {
                        color: '#BADA55'
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }]
        });
    });
</script>

@endsection    

