@extends('layouts.app', ['pageSlug' => 'dashboard_instagram'])

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<!--Cards del total de las Reacciones-->
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <label for="">Fecha Inicio</label>
            <input type="date" class="form-control" name="start_reaction" id="start_reaction">
        </div>
        <div class="col-md-4">
            <label for="">Fecha Fin</label>
            <input type="date" class="form-control" name="end_reaction" id="end_reaction">
        </div>
        <div class="col-md-4">
            <label for=""></label><br>
            <button class="btn btn-success" type="button" onclick="updateReactions()">Actualizar Reacciones</button>
        </div>
    </div>
</div>
<br>
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
                    <h5 class="card-title text-center" id="totallikes">{{$totalLikes}}</h5>
                </div>
            </div>
        </div>
        <!-- Total de guardados -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #C080C0;">
                <div class="card-header">
                    <img src="https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExam9wM3o2c3dzN3I4dGRwdTNhd2plOHZhM3Bubmp3eG14MzRoejc1ZSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/s4iLpJFlclDfdstxvX/giphy.webp" alt="Total de comentarios" style="max-width: 100%;"> 
                    <div class="text-center">Total Guardados</div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center" id="totalsaved">{{$totalSaved}}</h5>
                </div>
            </div>
        </div>
        <!-- Total de alcance -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #F497B7;">
                <div class="card-header">
                    <img src="https://i.pinimg.com/originals/1f/0c/9a/1f0c9a1dfb4fc93e852e559b4c9bd80b.gif" alt="Total de seguidores" style="max-width: 100%;"> 
                    <div class="text-center">Total de Alcance</div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center" id="totalscope">{{$totalScope}}</h5>
                </div>
            </div>
        </div>
        <!-- Total de compartidos -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #80C0C0;">
                <div class="card-header">
                    <img src="https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExejFxeWdmam9ta3BoZnQycmJkaDBxc2pkeGRqZG1waWlxN2tzZnBxayZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/yKZWmtqV5ZBHy4aKhd/giphy.webp" alt="Total de albums" style="max-width: 100%;"> 
                    <div class="text-center">Total de Compartidas</div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center" id="totalshares">{{$totalShares}}</h5>
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
    <h1 class="text-center">Reacciones de Publicaciones de Instagram</h1>
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

            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Fecha Inicio</label>
                        <input type="date" class="form-control" name="start_tabla" id="start_tabla" >
                    </div>
                    <div class="col-md-4">
                        <label for="">Fecha Fin</label>
                        <input type="date" class="form-control" name="end_tabla" id="end_tabla">
                    </div>
                    <div class="col-md-4">
                        <label for=""></label><br> 
                        <button id="filterTabla" class="btn btn-primary">Actualizar Tabla</button>
                        <button id="showAll" class="btn btn-secondary">Mostrar Todas las Publicaciones</button>
                    </div>
                </div>
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
    <div class="row">
        <div class="col-md-4">
            <label for="">Fecha Inicio</label>
            <input type="date" class="form-control" name="start_maps" id="start_maps" value="{{$ultimafechamaps}}" readonly>
        </div>
        <div class="col-md-4">
            <label for="">Fecha Fin</label>
            <input type="date" class="form-control" name="end_maps" id="end_maps">
        </div>
        <div class="col-md-4">
            <label for=""></label><br> 
            <button id="filterButton" class="btn btn-primary">Actualizar Mapa</button>
            <!--<button class="btn btn-success" type="button" onclick="updatemaps()" >Actualizar Mapa</button>-->
        </div>
    </div>
</div>
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
<!--grafico de todas las ciudades-->
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
<br>
<!--Grafico de Impresiones-->
<div class="container">
    <h1 class="text-center">Impresiones de Pagina por Grupo de Edad y Sexo</h1>
    <div class="row">
        <div id="chartImpressions" style="width: 100%; height: 400px;"></div>
    </div>
</div>
<br>
<!--Audiencia-->
<div class="container">
    <h1 class="text-center">Audiencia</h1>
    <div class="row">
        <div id="ageandgender" style="width: 100%; height: 400px;"></div>
    </div>
</div>
<!--Porcentajes de las ciudades y paises-->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div id="porcentajecities"></div>
        </div>
        <div class="col-md-6">
            <div id="porcentajecountry"></div>
        </div>
    </div>
</div>
<!--Grafico de Tendencias-->
<div class="container">
    <h1 class="text-center">Grafica de Tendencia</h1>
    <div class="row"> 
        <div class="col-md-4">
            <label for="start-date">Fecha de Inicio:</label>
            <input type="date" id="start-date" name="start-date" class="form-control">
        </div>
        <div class="col-md-4">
            <label for="end-date">Fecha de Fin:</label>
            <input type="date" id="end-date" name="end-date" class="form-control">
        </div>
        <div class="col-md-4">
            <br>
            <button class="btn btn-success" type="button" onclick="updateChartTrend()" >Actualizar Gráfica</button>
        </div>
    </div>

    <div class="row">
        <div id="trendContainer" style="width:100%; height:400px;"></div>   
    </div>
</div>
<!--Grafico de tendencias mas comentarios-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas comentadas</h1>
    <div class="row">
        <div class="col-md-3">
            <label for="limit">Número de posts:</label>
            <select id="limit" name="limit" class="form-control">
                <option value="15">15 publicaciones</option>
                <option value="20">20 publicaciones</option>
                <option value="30">30 publicaciones</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="start_date">Fecha de inicio:</label>
            <input type="date" id="start_date" name="start_date" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="end_date">Fecha de fin:</label>
            <input type="date" id="end_date" name="end_date" class="form-control">
        </div>
        <div class="col-md-3">
            <br>
            <button type="button" class="btn btn-success" onclick="fetchTopPosts()">Filtrar</button>
        </div>
    </div>
    <div class="row">
        <br>
        <div id="charttendenciacomment" style="width: 100%; height: 600px;"></div>
    </div>
</div>
<!--Grafico de tendencias con mas likes-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas Likes</h1>
    <div class="row">
        <div class="col-md-3">
            <label for="limit">Número de posts:</label>
            <select id="limit-selector-likes" name="limit-selector-likes" class="form-control">
                <option value="15">15 publicaciones</option>
                <option value="20">20 publicaciones</option>
                <option value="30">30 publicaciones</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="start_date">Fecha de inicio:</label>
            <input type="date" id="start_date_likes" name="start_date_likes" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="end_date">Fecha de fin:</label>
            <input type="date" id="end_date_likes" name="end_date_likes" class="form-control">
        </div>
        <div class="col-md-3">
            <br>
            <button type="button" class="btn btn-success" onclick="fetchTopLikes()">Filtrar</button>
        </div>
    </div>
    <div class="row">
        <div id="charttendencialikes" style="width: 100%; height: 600px;"></div>
    </div>
</div> 
<!--Grafico de tendencias con saved-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas Saved</h1>
    <div class="row">
        <div class="col-md-3">
            <label for="limit">Número de posts:</label>
            <select id="limit-selector-saved" name="limit-selector-saved" class="form-control">
                <option value="15">15 publicaciones</option>
                <option value="20">20 publicaciones</option>
                <option value="30">30 publicaciones</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="start_date">Fecha de inicio:</label>
            <input type="date" id="start_date_saved" name="start_date_saved" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="end_date">Fecha de fin:</label>
            <input type="date" id="end_date_saved" name="end_date_saved" class="form-control">
        </div>
        <div class="col-md-3">
            <br>
            <button type="button" class="btn btn-success" onclick="fetchTopSaved()">Filtrar</button>
        </div>
    </div>
    <div class="row">
        <div id="charttendenciasaved" style="width: 100%; height: 600px;"></div>
    </div>
</div> 
<!--Grafico de tendencias con shares-->
<div class="container">
    <h1 class="text-center">Grafica de tendencia de publicaciones mas Shares</h1>
    <div class="row">
        <div class="col-md-3">
            <label for="limit">Número de posts:</label>
            <select id="limit-selector-share" name="limit-selector-share" class="form-control">
                <option value="15">15 publicaciones</option>
                <option value="20">20 publicaciones</option>
                <option value="30">30 publicaciones</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="start_date">Fecha de inicio:</label>
            <input type="date" id="start_date_share" name="start_date_share" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="end_date">Fecha de fin:</label>
            <input type="date" id="end_date_share" name="end_date_share" class="form-control">
        </div>
        <div class="col-md-3">
            <br>
            <button type="button" class="btn btn-success" onclick="fetchTopShare()">Filtrar</button>
        </div>
    </div>
    <div class="row">
        <div id="charttendenciasshare" style="width: 100%; height: 600px;"></div>
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
            <h1 class="text-center">Reacciones de Publicaciones de Instagram</h1>
            <canvas id="myPieModal" width="400" height="400"></canvas>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
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
    let myPieChartUpdate;
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('myPieChart').getContext('2d');
        myPieChartUpdate = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json($data['labels']),
                datasets: [{
                    data: @json($data['values']),
                    backgroundColor: ['#A8DDEB', '#C0E1F7', '#CFEFF4', '#A1D7D9']
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

    function updateReactions(){
        const startDate = document.getElementById('start_reaction').value;
        const endDate = document.getElementById('end_reaction').value;
        let timerInterval;
        Swal.fire({
            title: "Actualizando...",
            html: "Esto tomará unos segundos.",
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                timerInterval = setInterval(() => {
                    if (timer) {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        });
        $.ajax({
            url: '/api/instagram-update', // Ruta a la acción que devolverá los datos
            method: 'GET',
            data: {
                start_date: startDate,
                end_date: endDate
            },
            success: function (data) {
                //llenado de datos        
                document.getElementById("totallikes").innerText = data.datos_reactions[0]['total_likes'];
                document.getElementById("totalsaved").innerText = data.datos_reactions[0]['total_saved'];
                document.getElementById("totalscope").innerText = data.datos_reactions[0]['total_scope'];
                document.getElementById("totalshares").innerText = data.datos_reactions[0]['total_shares'];
                // Actualización de la gráfica de torta con los nuevos datos
                myPieChartUpdate.data.labels = data.data_pie.labels;
                myPieChartUpdate.data.datasets[0].data = data.data_pie.values;
                myPieChartUpdate.update();
                // Cerrar el SweetAlert cuando se complete la actualización
                Swal.close();
            },
            error: function() {
                // Manejo del error
                Swal.fire('Error', 'Hubo un problema al actualizar los datos.', 'error');
            }
        });
    }
</script>
<!-- inicializacion de data table-->
<script>
    var table = $('#example123').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('tablepostinstagram') }}",
            "type": "GET",
            "data": function(d) {
                // Agregar las fechas a los parámetros de la solicitud
                d.start_date = $('#start_tabla').val();
                d.end_date = $('#end_tabla').val();
            }
        },
        "order": [[ 4, "desc" ]],
        "columns": [
            { "data": "id" },
            {
                "data": "story",
                "render": function(data, type, row) {
                    if (!data || data.trim() === "") {
                        return "";  // Devuelve un string vacío si es null o vacío
                    }
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
            {"data": "post_impressions"},
            {"data":"saved_count"},
            {"data":"shares_count"},
            { "data": "likes_count" },
            { 
                "data": null,
                "render": function(data, type, row) {
                    return `
                        <button type="button"  title="Generar Grafica" class="btn btn-primary id_graficar" value="${row.id}" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-chart-bar"></i>
                        </button>
                        <br><br>
                        <form action="{{ route('informe_id_escucha_instagram') }}" method="post" target="_blank">
                            @csrf 
                            <input type="hidden" name="id" value="${row.id}">
                            <button class="btn btn-warning" title="Generar PDF"><i class="fas fa-file-pdf"></i></button>
                        </form>
                    `;
                }
            }
        ],
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "pageLength": 10 // Asegúrate de que esté configurado según tus necesidades
    });
    // Evento para el botón de filtro
    $('#filterTabla').on('click', function() {
        // Mostrar el mensaje de actualización
        let timerInterval;
        Swal.fire({
            title: "Actualizando...",
            html: "Esto tomará unos segundos.",
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                timerInterval = setInterval(() => {
                    if (timer) {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        });

        // Recargar la tabla
        table.ajax.reload(function() {
            // Cerrar el mensaje de actualización después de que se complete la recarga
            Swal.close();
        });
    });
    $('#showAll').on('click', function() {
        // Limpiar los campos de fecha
        $('#start_tabla').val('');
        $('#end_tabla').val('');
        // Mostrar el mensaje de actualización
        let timerInterval;
        Swal.fire({
            title: "Actualizando...",
            html: "Esto tomará unos segundos.",
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                timerInterval = setInterval(() => {
                    if (timer) {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        });

        // Recargar la tabla
        table.ajax.reload(function() {
            // Cerrar el mensaje de actualización después de que se complete la recarga
            Swal.close();
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
                url: "{{ route('recuperar_id_grafica_instagram') }}",
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
                                    backgroundColor: ['#A8DDEB', '#C0E1F7', '#CFEFF4', '#A1D7D9', '#D4B3E6']
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
<!--grafico mapa -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        //obtener los datos 
        // obtener los datos del backend
        const dataMap = {!! $jsonDataMap !!};
        //console.log(dataMap);
        const chart = Highcharts.mapChart('myMap', {
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
        // Filtro de fecha
        document.getElementById('filterButton').addEventListener('click', function () {
            const startDate = document.getElementById('start_maps').value;
            const endDate = document.getElementById('end_maps').value;
            let timerInterval;
            Swal.fire({
                title: "Actualizando...",
                html: "Esto tomará unos segundos.",
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        if (timer) {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                        }
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            });
            if (startDate && endDate) {
                // Hacer la llamada AJAX
                fetch(`/api/filtrar-datos-mapa-instagram?startDate=${startDate}&endDate=${endDate}`)
                    .then(response => response.json())
                    .then(newData => {
                        // Actualizar el mapa con los nuevos datos
                        Swal.close();
                        chart.series[0].setData(newData);
                    })
                    .catch(error => {Swal.fire({icon: 'error',title: 'Error',text:  'No se encontraron datos para la fecha especificada.'});
                });        } else {
                Swal.fire('error','Por favor selecciona un rango de fechas.','error');
            }
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
            { name: 'likes', data: [] },    
            { name: 'comments', data: []},
            { name: 'saved', data: []},
            { name: 'shares', data: []},
            { name: 'alcance', data: []}
        ]
        });
    }
    // Actualizar la gráfica con datos del servidor
    function updateChartTrend() {
        const startDate = document.getElementById('start-date').value;
        const endDate = document.getElementById('end-date').value;
        let timerInterval;
        Swal.fire({
            title: "Actualizando...",
            html: "Esto tomará unos segundos.",
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                timerInterval = setInterval(() => {
                    if (timer) {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        });
        $.ajax({
            url: '/get-chart-data-instagram', // Ruta a la acción que devolverá los datos
            method: 'GET',
            data: {
                start_date: startDate,
                end_date: endDate
            },
            success: function (data) {
                chartTrend.update({
                    xAxis: { categories: data.dates },
                    series: [
                    { name: 'likes', data: data.likes },
                    { name: 'comments', data: data.comments },
                    { name: 'saved', data: data.saved},
                    { name: 'shares', data: data.shares},
                    { name: 'alcances', data: data.scopes}
                ]
                });
                Swal.close();
            },
            error: function() {
                // Manejo del error
                Swal.fire('Error', 'Hubo un problema al actualizar los datos.', 'error');
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
        let timerInterval;
        Swal.fire({
            title: "Actualizando...",
            html: "Esto tomará unos segundos.",
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                timerInterval = setInterval(() => {
                    if (timer) {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        });
        $.ajax({
            url: `/api/instagram-posts`,
            method: 'GET',
            data: {
                limit: limit,
                start_date: startDate,
                end_date: endDate
            },
            success: function(data) {
                renderChart(data);
                Swal.close();
            },
            error: function() {
                // Manejo del error
                Swal.fire('Error', 'Hubo un problema al actualizar los datos.', 'error');
            }
        });
    }

    function renderChart(posts) {
        const categories = posts.map(post => post.story);
        const data = posts.map(post => parseInt(post.comments));
        const impressionsData = posts.map(post => parseInt(post.impressions_count));
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
            }, {
                name: 'Alcance',
                data: impressionsData,
                color: '#FFCC80'  // Naranja pastel
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
        let timerInterval;
        Swal.fire({
            title: "Actualizando...",
            html: "Esto tomará unos segundos.",
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                timerInterval = setInterval(() => {
                    if (timer) {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        });
        $.ajax({
            url: `/api/instagram-likes`,
            method: 'GET',
            data: {
                limit: limit,
                start_date: startDate,
                end_date: endDate
            },
            success: function(data) {
                renderChartLikes(data);
                Swal.close();
            },
            error: function() {
                // Manejo del error
                Swal.fire('Error', 'Hubo un problema al actualizar los datos.', 'error');
            }
        });
    }
    function renderChartLikes(posts) {
        const categories = posts.map(post => post.story);
        const data = posts.map(post => parseInt(post.likes));
        const impressionsData = posts.map(post => parseInt(post.impressions_count));

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
            }, {
                name: 'Alcance',
                data: impressionsData,
                color: '#FFCC80'  // Naranja pastel
            }
            ]
        });
    }
</script>
<!--grafico de tendencia saved-->
<script>
    function fetchTopSaved() {
        const limit = document.getElementById('limit-selector-saved').value;
        const startDate = document.getElementById('start_date_saved').value;
        const endDate = document.getElementById('end_date_saved').value;
        let timerInterval;
        Swal.fire({
            title: "Actualizando...",
            html: "Esto tomará unos segundos.",
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                timerInterval = setInterval(() => {
                    if (timer) {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        });
        $.ajax({
            url: `/api/instagram-saved`,
            method: 'GET',
            data: {
                limit: limit,
                start_date: startDate,
                end_date: endDate
            },
            success: function(data) {
                renderChartSaved(data);
                Swal.close();
            },
            error: function() {
                // Manejo del error
                Swal.fire('Error', 'Hubo un problema al actualizar los datos.', 'error');
            }
        });
    }
    function renderChartSaved(posts) {
        const categories = posts.map(post => post.story);
        const data = posts.map(post => parseInt(post.saved));
        const impressionsData = posts.map(post => parseInt(post.impressions_count));

        Highcharts.chart('charttendenciasaved', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Publicaciones Con mas Saved'
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
                    text: 'Número de Saved'
                }
            },
            series: [{
                name: 'Saved',
                data: data,
                color: '#B3E5FC'  // Azul pastel
            }, {
                name: 'Alcance',
                data: impressionsData,
                color: '#FFCC80'  // Naranja pastel
            }
            ]
        });
    }
</script>
<!--grafico de tendencia share-->
<script>
    function fetchTopShare() {
        const limit = document.getElementById('limit-selector-share').value;
        const startDate = document.getElementById('start_date_share').value;
        const endDate = document.getElementById('end_date_share').value;
        let timerInterval;
        Swal.fire({
            title: "Actualizando...",
            html: "Esto tomará unos segundos.",
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                timerInterval = setInterval(() => {
                    if (timer) {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        });
        $.ajax({
            url: `/api/instagram-share`,
            method: 'GET',
            data: {
                limit: limit,
                start_date: startDate,
                end_date: endDate
            },
            success: function(data) {
                renderChartShare(data);
                Swal.close();
            },
            error: function() {
                // Manejo del error
                Swal.fire('Error', 'Hubo un problema al actualizar los datos.', 'error');
            }
        });
    }
    function renderChartShare(posts) {
        const categories = posts.map(post => post.story);
        const data = posts.map(post => parseInt(post.shares));
        const impressionsData = posts.map(post => parseInt(post.impressions_count));

        Highcharts.chart('charttendenciasshare', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Publicaciones Con mas Shares'
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
                    text: 'Número de Shares'
                }
            },
            series: [{
                name: 'Shared',
                data: data,
                color: '#B3E5FC'  // Azul pastel
            }, {
                name: 'Alcance',
                data: impressionsData,
                color: '#FFCC80'  // Naranja pastel
            }
            ]
        });
    }
</script>
<!--Datos Demograficos-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chart = Highcharts.chart('ageandgender', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Desglose por género según rango de edad'
            },
            xAxis: {
                categories: ['13-17', '18-24', '25-34', '35-44', '45-54', '55-64', '65+'],
                title: {
                    text: 'Rango de edad'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Conteo de Impresiones',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            series: [{
                name: 'Female',
                data: [
                    {{ $groupedData['Female']['13-17'] ?? 0 }},
                    {{ $groupedData['Female']['18-24'] ?? 0 }},
                    {{ $groupedData['Female']['25-34'] ?? 0 }},
                    {{ $groupedData['Female']['35-44'] ?? 0 }},
                    {{ $groupedData['Female']['45-54'] ?? 0 }},
                    {{ $groupedData['Female']['55-64'] ?? 0 }},
                    {{ $groupedData['Female']['65+'] ?? 0 }},
                ]
            }, {
                name: 'Male',
                data: [
                    {{ $groupedData['Male']['13-17'] ?? 0 }},
                    {{ $groupedData['Male']['18-24'] ?? 0 }},
                    {{ $groupedData['Male']['25-34'] ?? 0 }},
                    {{ $groupedData['Male']['35-44'] ?? 0 }},
                    {{ $groupedData['Male']['45-54'] ?? 0 }},
                    {{ $groupedData['Male']['55-64'] ?? 0 }},
                    {{ $groupedData['Male']['65+'] ?? 0 }},
                ]
            }]
        });
    });
</script>
<!--Porcentaje top cities-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chart = Highcharts.chart('porcentajecities', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Conteo de fan por Ciudad (porcentajes)'
            },
            xAxis: {
                categories: @json($percentageDataCities->pluck('city_name')),
                title: {
                    text: 'Pais'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Porcentaje (%)',
                    align: 'high'
                },
                labels: {
                    formatter: function () {
                        return this.value + '%'; 
                    }
                }
            },
            series: [{
                name: 'Porcentaje',
                data: @json($percentageDataCities->pluck('percentage'))
            }]
        });
    });
</script>
<!--Porcentaje top Countries-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chart = Highcharts.chart('porcentajecountry', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Conteo de fan por pais (porcentajes)'
            },
            xAxis: {
                categories: @json($percentageData->pluck('pais')),
                title: {
                    text: 'Pais'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Porcentaje (%)',
                    align: 'high'
                },
                labels: {
                    formatter: function () {
                        return this.value + '%'; 
                    }
                }
            },
            series: [{
                name: 'Porcentaje',
                data: @json($percentageData->pluck('percentage'))
            }]
        });
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

