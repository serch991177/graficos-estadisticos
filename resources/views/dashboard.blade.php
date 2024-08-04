@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
<!--Cards del total de las Reacciones-->
<div class="container">
    <div class="row">
        <!-- Total de me gustas -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
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
            <div class="card text-white bg-danger mb-3">
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
            <div class="card text-white bg-warning mb-3">
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
            <div class="card text-white bg-orange mb-3">
                <div class="card-header">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="15">
                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM176.4 176a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm128 32a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM256 288a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/>
                </svg> Total de me asombras
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalWows }}</h5>
                </div>
            </div>
        </div>
        <!-- Total de me entristece -->
        <div class="col-md-3">
            <div class="card text-white bg-purple mb-3">
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
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" width="15" ><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zM136 240c0-9.3 4.1-17.5 10.5-23.4l-31-9.3c-8.5-2.5-13.3-11.5-10.7-19.9 2.5-8.5 11.4-13.2 19.9-10.7l80 24c8.5 2.5 13.3 11.5 10.7 19.9-2.1 6.9-8.4 11.4-15.3 11.4-.5 0-1.1-.2-1.7-.2 .7 2.7 1.7 5.3 1.7 8.2 0 17.7-14.3 32-32 32S136 257.7 136 240zm168 154.2c-27.8-33.4-84.2-33.4-112.1 0-13.5 16.3-38.2-4.2-24.6-20.5 20-24 49.4-37.8 80.6-37.8s60.6 13.8 80.6 37.8c13.8 16.5-11.1 36.6-24.5 20.5zm76.6-186.9l-31 9.3c6.3 5.8 10.5 14.1 10.5 23.4 0 17.7-14.3 32-32 32s-32-14.3-32-32c0-2.9 .9-5.6 1.7-8.2-.6 .1-1.1 .2-1.7 .2-6.9 0-13.2-4.5-15.3-11.4-2.5-8.5 2.3-17.4 10.7-19.9l80-24c8.4-2.5 17.4 2.3 19.9 10.7 2.5 8.5-2.3 17.4-10.8 19.9z"/></svg>
                    Total de me enojas
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalAngries }}</h5>
                </div>
            </div>
        </div>
        <!-- Total de compartidas -->
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">
                    <i class="fas fa-share" style="color: #ffffff;"></i> Total de compartidas
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalShares }}</h5>
                </div>
            </div>
        </div>
        <!-- Total de Comentarios -->
        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    <i class="fas fa-comments" style="color: #007bff;"></i> Total de Comentarios
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
<!--Tabla de publicaciones de Facebook-->
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
                    <table id="example" class="display  table tablesorter" style="width:100%">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Story</th>
                                <th>Foto</th>
                                <th>Link</th>
                                <th>Fecha de Creacion</th>
                                <th>Recuento de comentarios</th>
                                <th>Recuento de me gustas</th>
                                <th>Recuento me encantas</th>
                                <th>Recuento de me diviertes</th>
                                <th>Recuento de me asombra</th>
                                <th>Recuento de me entristece</th>
                                <th>Recuento de me enojas</th>
                                <th>Recuento de compartidos</th>
                                <th>Opcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $datostabla as $datostablas)
                                <tr>
                                    <td>{{$datostablas->id}}</td>
                                    <td>{{$datostablas->story}}</td>
                                    <td><img src="{{$datostablas->full_picture}}" alt="" ></td>
                                    <td>{{$datostablas->permalink_url}}</td>
                                    <td>{{$datostablas->created_time}}</td>
                                    <td>{{$datostablas->comments_count}}</td>
                                    <td>{{$datostablas->like_count}}</td>
                                    <td>{{$datostablas->love_count}}</td>
                                    <td>{{$datostablas->haha_count}}</td>
                                    <td>{{$datostablas->wow_count}}</td>
                                    <td>{{$datostablas->sad_count}}</td>
                                    <td>{{$datostablas->angry_count}}</td>
                                    <td>{{$datostablas->share_count}}</td>
                                    <td> <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary id_graficar" value="{{$datostablas->id}}" data-toggle="modal" data-target="#exampleModal">
                                            Generar Grafica
                                        </button> <br><br>
                                        <form action="{{route('informe_id_escucha')}}" method="post" target="_blank">
                                            @csrf 
                                            <input type="hidden" name="id" value="{{$datostablas->id}}">
                                            <button class="btn btn-warning">Generar Pdf</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
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
                                        <td>{{$topcountry->country_name}}</td>
                                        <td>{{$topcountry->fan_count}}</td>
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
        <select id="dataCount" class="form-control" onchange="updateChart()">
            <option value="">Seleccione un rango de numero</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
        </select>
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
<div class="container">
    <h1 class="text-center">Grafica de Tendencia</h1>
    <form id="date-form">
        <label for="start-date">Fecha de Inicio:</label>
        <input type="date" id="start-date" name="start-date">
        <label for="end-date">Fecha de Fin:</label>
        <input type="date" id="end-date" name="end-date">
        <button type="button" onclick="updateChartTrend()">Actualizar Gráfica</button>
    </form>
    <div class="row">
        <div id="trendContainer" style="width:100%; height:400px;"></div>   
    </div>
</div>
<!--Grafico de tendencias mas comentarios-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas comentadas</h1>
    <div class="row">
        <!--<select id="limit-selector">
            <option value="15">15 publicaciones</option>
            <option value="20">20 publicaciones</option>
            <option value="30">30 publicaciones</option>
        </select>-->
        <form id="filters-form">
            <label for="limit">Número de posts:</label>
            <select id="limit" name="limit">
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="30">30</option>
            </select>
            <label for="start_date">Fecha de inicio:</label>
            <input type="date" id="start_date" name="start_date">
            
            <label for="end_date">Fecha de fin:</label>
            <input type="date" id="end_date" name="end_date">
            
            <button type="button" onclick="fetchTopPosts()">Filtrar</button>
        </form>
        <div id="charttendenciacomment" style="width: 100%; height: 600px;"></div>
    </div>
</div>
<!--Grafico de tendencias con mas likes-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas Likes</h1>
    <div class="row">
        <select id="limit-selector-likes">
            <option value="15">15 publicaciones</option>
            <option value="20">20 publicaciones</option>
            <option value="30">30 publicaciones</option>
        </select>
        <div id="charttendencialikes" style="width: 100%; height: 600px;"></div>
    </div>
</div> 
<!--Grafico de tendencias con mas loves-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas loves</h1>
    <div class="row">
        <select id="limit-selector-loves">
            <option value="15">15 publicaciones</option>
            <option value="20">20 publicaciones</option>
            <option value="30">30 publicaciones</option>
        </select>
        <div id="charttendencialoves" style="width: 100%; height: 600px;"></div>
    </div>
</div>
<!--Grafico de tendencias con mas hahas-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas hahas</h1>
    <div class="row">
        <select id="limit-selector-hahas">
            <option value="15">15 publicaciones</option>
            <option value="20">20 publicaciones</option>
            <option value="30">30 publicaciones</option>
        </select>
        <div id="charttendenciahahas" style="width: 100%; height: 600px;"></div>
    </div>
</div> 
<!--Grafico de tendencias con mas wows-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas wows</h1>
    <div class="row">
        <select id="limit-selector-wows">
            <option value="15">15 publicaciones</option>
            <option value="20">20 publicaciones</option>
            <option value="30">30 publicaciones</option>
        </select>
        <div id="charttendenciawows" style="width: 100%; height: 600px;"></div>
    </div>
</div>
<!--Grafico de tendencias con mas sads-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas sads</h1>
    <div class="row">
        <select id="limit-selector-sads">
            <option value="15">15 publicaciones</option>
            <option value="20">20 publicaciones</option>
            <option value="30">30 publicaciones</option>
        </select>
        <div id="charttendenciasads" style="width: 100%; height: 600px;"></div>
    </div>
</div> 
<!--Grafico de tendencias con mas angries-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas angries</h1>
    <div class="row">
        <select id="limit-selector-angries">
            <option value="15">15 publicaciones</option>
            <option value="20">20 publicaciones</option>
            <option value="30">30 publicaciones</option>
        </select>
        <div id="charttendenciaangries" style="width: 100%; height: 600px;"></div>
    </div>
</div>
<!--Grafico de tendencias con mas shares-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas shares</h1>
    <div class="row">
        <select id="limit-selector-shares">
            <option value="15">15 publicaciones</option>
            <option value="20">20 publicaciones</option>
            <option value="30">30 publicaciones</option>
        </select>
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
<div class="container">
    <h1 class="text-center">Informe de Escucha Activa</h1>
    <div class="text-center">
        <form action="{{route('informe_escucha')}}" method="post" target="_blank">
            @csrf
            <button class="btn btn-primary" title="Generar Informe">Generar Informe</button>
        </form>
    </div>
</div>
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
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<!--Scripts de ciudades-->
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<!--Scripts de javascript-->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/maps/highmaps.js"></script>
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
    $('#example').DataTable( {
        responsive: true
    } );
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
                    backgroundColor: ['purple','red','yellow','green','purple','orange','pink','grey']
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
                    [0, '#800080'] // Color púrpura en hexadecimal
                ]
            },
            series: [{
                data:dataMap,
                name: 'Numero de Fans',
                color: '#800080',
                states: {
                    hover: {
                        color: '#800080'
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
<!--grafico mapa ciudades -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categories = @json(array_column($citiesData, 'name'));
        const dataSeries = @json($citiesData);

        // Agregar datos ficticios para los años 2024 y 2025
        const futureDataSeries = dataSeries.map(series => {
            return {
                name: series.name + ' 2024',
                data: series.data.map(value => value * 1.2)
            };
        }).concat(dataSeries.map(series => {
            return {
                name: series.name + ' 2025',
                data: series.data.map(value => value * 1.5)
            };
        }));

        let currentIndex = 0;
        const combinedDataSeries = dataSeries.concat(futureDataSeries);

        function updateChart(chart) {
            chart.series.forEach((series, index) => {
                series.setData(combinedDataSeries[currentIndex + index].data);
            });
            chart.setTitle({ text: 'Year ' + (2023 + Math.floor(currentIndex / dataSeries.length)) });
            currentIndex = (currentIndex + 1) % combinedDataSeries.length;
        }

        const chart = Highcharts.chart('BarRace', {
            chart: {
                type: 'bar',
                events: {
                    load: function () {
                        const chart = this;
                        setInterval(function () {
                            updateChart(chart);
                        }, 3000);
                    }
                }
            },
            title: {
                text: 'Bar Race Chart'
            },
            xAxis: {
                categories: categories,
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Fan Count',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            series: dataSeries.map(series => ({
                name: series.name,
                data: series.data
            }))
        });
    });
</script>
<!--Grafico de todo el conteo de fans-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dataCities = @json($dataCities2);

        var cityNames = dataCities.map(function (city) {
            return city.city_name;
        });

        var fanCounts = dataCities.map(function (city) {
            return parseInt(city.fan_count);
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
                color: '#6a0dad' 
            }]
        });
        
        window.updateChart = function() {
            var count = parseInt(document.getElementById('dataCount').value);
            var filteredData = {
                cityNames: cityNames.slice(0, count),
                fanCounts: fanCounts.slice(0, count)
            };

            chartCity.xAxis[0].setCategories(filteredData.cityNames);
            chartCity.series[0].setData(filteredData.fanCounts);
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
                    lineColor: '#666666',
                    lineWidth: 1,
                    marker: {
                        lineWidth: 1,
                        lineColor: '#666666'
                    },
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            series: [{
                name: 'Impresiones',
                data: impressions,
                color: '#6a0dad' // Color púrpura para las áreas
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
                                    backgroundColor: ['purple', 'red', 'yellow', 'green', 'purple', 'orange', 'pink', 'grey']
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
                { name: 'Likes', data: [] },
                { name: 'Loves', data: [] },
                { name: 'Hahas', data: [] },
                { name: 'Wows', data: [] },
                { name: 'Sads', data: [] },
                { name: 'Angries', data: [] }
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
                            { name: 'Likes', data: data.likes },
                            { name: 'Loves', data: data.loves },
                            { name: 'Hahas', data: data.hahas },
                            { name: 'Wows', data: data.wows },
                            { name: 'Sads', data: data.sads },
                            { name: 'Angries', data: data.angries }
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
    /*$(document).ready(function() {
        function loadChart(limit) {
            $.getJSON(`/api/facebook-posts?limit=${limit}`, function(data) {
                Highcharts.chart('charttendenciacomment', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Publicaciones Más Comentadas'
                    },
                    xAxis: {
                        categories: data.map(post => post.story),
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
                        data: data.map(post => parseInt(post.comments_count))
                    }]
                });
            });
        }

        // Cargar el gráfico con el límite por defecto
        loadChart(15);

        // Actualizar el gráfico cuando el usuario cambie el límite
        $('#limit-selector').change(function() {
            var selectedLimit = $(this).val();
            loadChart(selectedLimit);
        });
    });*/

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
                data: data
            }]
        });
    }
</script>
<!--Grafico de tendencias likes-->
<script>
    $(document).ready(function() {
        function loadChart(limit) {
            $.getJSON(`/api/facebook-likes?limit=${limit}`, function(data) {
                Highcharts.chart('charttendencialikes', {
                    chart: {
                        type: 'column'
                    }, 
                    title: {
                        text: 'Publicaciones Más Likes'
                    },
                    xAxis: {
                        categories: data.map(post => post.story),
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
                        data: data.map(post => parseInt(post.like_count))
                    }]
                });
            });
        }

        // Cargar el gráfico con el límite por defecto
        loadChart(15);

        // Actualizar el gráfico cuando el usuario cambie el límite
        $('#limit-selector-likes').change(function() {
            var selectedLimit = $(this).val();
            loadChart(selectedLimit);
        });
    });
</script>
<!--Grafico de tendencias loves-->
<script>
    $(document).ready(function() {
        function loadChart(limit) {
            $.getJSON(`/api/facebook-loves?limit=${limit}`, function(data) {
                Highcharts.chart('charttendencialoves', {
                    chart: {
                        type: 'column'
                    }, 
                    title: {
                        text: 'Publicaciones Más Loves'
                    },
                    xAxis: {
                        categories: data.map(post => post.story),
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
                        data: data.map(post => parseInt(post.love_count))
                    }]
                });
            });
        }

        // Cargar el gráfico con el límite por defecto
        loadChart(15);

        // Actualizar el gráfico cuando el usuario cambie el límite
        $('#limit-selector-loves').change(function() {
            var selectedLimit = $(this).val();
            loadChart(selectedLimit);
        });
    });
</script>
<!--Grafico de tendencias haha-->
<script>
    $(document).ready(function() {
        function loadChart(limit) {
            $.getJSON(`/api/facebook-haha?limit=${limit}`, function(data) {
                Highcharts.chart('charttendenciahahas', {
                    chart: {
                        type: 'column'
                    }, 
                    title: {
                        text: 'Publicaciones Más Hahas'
                    },
                    xAxis: {
                        categories: data.map(post => post.story),
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
                        data: data.map(post => parseInt(post.haha_count))
                    }]
                });
            });
        }

        // Cargar el gráfico con el límite por defecto
        loadChart(15);

        // Actualizar el gráfico cuando el usuario cambie el límite
        $('#limit-selector-hahas').change(function() {
            var selectedLimit = $(this).val();
            loadChart(selectedLimit);
        });
    });
</script>
<!--Grafico de tendencias wow-->
<script>
    $(document).ready(function() {
        function loadChart(limit) {
            $.getJSON(`/api/facebook-wow?limit=${limit}`, function(data) {
                Highcharts.chart('charttendenciawows', {
                    chart: {
                        type: 'column'
                    }, 
                    title: {
                        text: 'Publicaciones Más Wows'
                    },
                    xAxis: {
                        categories: data.map(post => post.story),
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
                        data: data.map(post => parseInt(post.wow_count))
                    }]
                });
            });
        }

        // Cargar el gráfico con el límite por defecto
        loadChart(15);

        // Actualizar el gráfico cuando el usuario cambie el límite
        $('#limit-selector-wows').change(function() {
            var selectedLimit = $(this).val();
            loadChart(selectedLimit);
        });
    });
</script>
<!--Grafico de tendencias sad-->
<script>
    $(document).ready(function() {
        function loadChart(limit) {
            $.getJSON(`/api/facebook-sad?limit=${limit}`, function(data) {
                Highcharts.chart('charttendenciasads', {
                    chart: {
                        type: 'column'
                    }, 
                    title: {
                        text: 'Publicaciones Más Sads'
                    },
                    xAxis: {
                        categories: data.map(post => post.story),
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
                        data: data.map(post => parseInt(post.sad_count))
                    }]
                });
            });
        }

        // Cargar el gráfico con el límite por defecto
        loadChart(15);

        // Actualizar el gráfico cuando el usuario cambie el límite
        $('#limit-selector-sads').change(function() {
            var selectedLimit = $(this).val();
            loadChart(selectedLimit);
        });
    });
</script>
<!--Grafico de tendencias angry-->
<script>
    $(document).ready(function() {
        function loadChart(limit) {
            $.getJSON(`/api/facebook-angry?limit=${limit}`, function(data) {
                Highcharts.chart('charttendenciaangries', {
                    chart: {
                        type: 'column'
                    }, 
                    title: {
                        text: 'Publicaciones Más Angries'
                    },
                    xAxis: {
                        categories: data.map(post => post.story),
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
                        data: data.map(post => parseInt(post.angry_count))
                    }]
                });
            });
        }

        // Cargar el gráfico con el límite por defecto
        loadChart(15);

        // Actualizar el gráfico cuando el usuario cambie el límite
        $('#limit-selector-angries').change(function() {
            var selectedLimit = $(this).val();
            loadChart(selectedLimit);
        });
    });
</script>
<!--Grafico de tendencias share-->
<script>
    $(document).ready(function() {
        function loadChart(limit) {
            $.getJSON(`/api/facebook-share?limit=${limit}`, function(data) {
                Highcharts.chart('charttendenciashares', {
                    chart: {
                        type: 'column'
                    }, 
                    title: {
                        text: 'Publicaciones Más Shares'
                    },
                    xAxis: {
                        categories: data.map(post => post.story),
                        title: {
                            text: 'Publicaciones'
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Número de Shares'
                        }
                    },
                    series: [{
                        name: 'Shares',
                        data: data.map(post => parseInt(post.share_count))
                    }]
                });
            });
        }

        // Cargar el gráfico con el límite por defecto
        loadChart(15);

        // Actualizar el gráfico cuando el usuario cambie el límite
        $('#limit-selector-shares').change(function() {
            var selectedLimit = $(this).val();
            loadChart(selectedLimit);
        });
    });
</script>

<!--Mapa de Bolivia -->
<script>
    $(document).ready(function() {
        // Datos de las ciudades
        var cities = [
            { name: 'La Paz', lat: -16.5000, lon: -68.1500 },
            { name: 'Santa Cruz', lat: -17.7833, lon: -63.1833 },
            { name: 'Cochabamba', lat: -17.3833, lon: -66.1500 },
            { name: 'Sucre', lat: -19.0333, lon: -65.2627 },
            { name: 'Oruro', lat: -17.9667, lon: -67.1167 },
            { name: 'Potosí', lat: -19.5833, lon: -65.7500 },
            { name: 'Tarija', lat: -21.5167, lon: -64.7333 },
            { name: 'Cobija', lat: -11.0333, lon: -68.7333 },
            { name: 'Trinidad', lat: -14.8333, lon: -64.9000 }
        ];

        Highcharts.mapChart('mapaBolivia', {
            chart: {
                map: 'countries/bo/bo-all'
            },
            title: {
                text: 'Mapa de Bolivia con Ciudades'
            },
            subtitle: {
                text: 'Fuente: Highcharts Maps'
            },
            mapNavigation: {
                enabled: true,
                buttonOptions: {
                    verticalAlign: 'bottom'
                }
            },
            series: [{
                name: 'Basemap',
                borderColor: '#A0A0A0',
                nullColor: 'rgba(200, 200, 200, 0.3)',
                showInLegend: false
            }, {
                name: 'Separators',
                type: 'mapline',
                data: Highcharts.geojson(Highcharts.maps['countries/bo/bo-all'], 'mapline'),
                color: '#707070',
                showInLegend: false,
                enableMouseTracking: false
            }, {
                type: 'mappoint',
                name: 'Ciudades',
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                },
                data: cities.map(function(city) {
                    return {
                        name: city.name,
                        lat: city.lat,
                        lon: city.lon
                    };
                }),
                marker: {
                    symbol: 'circle',
                    radius: 7,
                    fillColor: 'red'
                },
                tooltip: {
                    pointFormat: '{point.name}'
                }
            }]
        });
    });
</script>

@endsection    

