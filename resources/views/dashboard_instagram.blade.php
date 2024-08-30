@extends('layouts.app', ['pageSlug' => 'dashboard_instagram'])

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<!--Cards del total de las Reacciones-->
<div class="container">
    <div class="row">
        <!-- Total de me gustas -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #80D4E5;">
                <div class="card-header">
                <img src="/img/curiosaidades-instagram-unscreen.gif" alt="Total de me gustas" style="max-width: 100%; "> 
                <div class="text-center">Total de me gustas</div>
                <!--<i class="fas fa-thumbs-up"></i> Total de me gustas-->
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{$totalLikes}}</h5>
                </div>
            </div>
        </div>
        <!-- Total de comentarios -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #C080C0;">
                <div class="card-header">
                    <img src="/img/comentarioinstagram-unscreen.gif" alt="Total de comentarios" style="max-width: 100%;"> 
                    <div class="text-center">Total de Comentarios</div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center"> 4000</h5>
                </div>
            </div>
        </div>
        <!-- Total de seguidores -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #F497B7;">
                <div class="card-header">
                    <img src="https://i.pinimg.com/originals/1f/0c/9a/1f0c9a1dfb4fc93e852e559b4c9bd80b.gif" alt="Total de seguidores" style="max-width: 100%;"> 
                    <div class="text-center">Total de Seguiores</div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center"> 3000</h5>
                </div>
            </div>
        </div>
        <!-- Total de me media -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #80C0C0;">
                <div class="card-header">
                    <img src="/img/album.gif" alt="Total de albums" style="max-width: 100%;"> 
                    <div class="text-center">Total de Media</div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center"> 3000</h5>
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
<br>
<!--Tabla de publicaciones de Instagram-->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
            <div class="card-header">
                <h4 class="card-title"> Publicaciones de Instagram</h4>
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

            <!-- Selección del tipo de gráfico -->
            <label for="">Seleccione un tipo de gráfico</label>
            <select id="chartType" class="form-control" onchange="updateChart()">
                <option value="bar">Barra</option>
                <option value="column">Columna</option>
                <option value="line">Línea</option>
            </select>
        </div>
        <div id="BarFans" style="width: 100%; height: 400px;"></div>
    </div>
</div>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<!-- inicializacion de data table-->
<script>
    $('#example123').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('tablepostinstagram') }}",
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
                "data": "media_url" ,
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
            { "data": "likes_count" },
            { 
                "data": null,
                "render": function(data, type, row) {
                    return `
                        <button type="button"  title="Generar Grafica" class="btn btn-primary id_graficar" value="${row.id}" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-chart-bar"></i>
                        </button>
                        <br><br>
                        <form action="{{ route('informe_id_escucha') }}" method="post" target="_blank">
                            @csrf 
                            <input type="hidden" name="id" value="${row.id}">
                            <button class="btn btn-warning" title="Generar PDF"><i class="fas fa-file-pdf"></i></button>
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
        var dataCities = @json($dataCities);

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
                type: 'bar'  // Tipo de gráfico inicial
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
                series: {
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
            var chartType = document.getElementById('chartType').value;

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

            // Actualizar el tipo de gráfico
            chartCity.update({
                chart: {
                    type: chartType
                },
                xAxis: {
                    categories: filteredCityNames
                },
                series: [{
                    data: filteredFanCounts
                }]
            });
        };
    });
</script>
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

@endsection    

