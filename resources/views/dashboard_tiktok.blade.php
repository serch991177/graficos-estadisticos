@extends('layouts.app', ['pageSlug' => 'dashboard_tiktok'])
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<!--Card de info de ttiktok-->
<div class="container d-flex justify-content-center align-items-center">
    <div class="card">
        <div class="upper text-center" style="width: 100%; height: 300px; overflow: hidden;">            
            <img src="https://scontent-lax3-1.xx.fbcdn.net/v/t39.30808-6/428662091_945796213771623_3322293350598745573_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=4OgroZpJkTMQ7kNvgHWg7vn&_nc_zt=23&_nc_ht=scontent-lax3-1.xx&_nc_gid=AotqeabK3lvNfiQ4Cz-o19c&oh=00_AYC7LlMTZyhmEeg4UdF95s3LSP2ciNtUXFOstfZ7-A46UA&oe=675CD84E" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div class="user text-center">
            <div class="profile">
                <img src="{{$datacuentas[0]['avatar_url']}}" class="rounded-circle" width="80">
            </div>
        </div>
        <div class="mt-5 text-center">
            <h4 class="mb-0">{{$datacuentas[0]['display_name']}}</h4>
            <span class="text-muted d-block mb-2">Cochabamba - Bolivia</span>
            <div class="d-flex justify-content-between align-items-center mt-4 px-4">
                <div class="stats">
                    <h6 class="mb-0">Follower Count</h6>
                    <span>{{$datacuentas[0]['follower_count']}}</span>
                </div>
                <div class="stats">
                    <h6 class="mb-0">Following Count</h6>
                    <span>{{$datacuentas[0]['following_count']}}</span>
                </div>
                <div class="stats">
                    <h6 class="mb-0">Likes Count</h6>
                    <span>{{$datacuentas[0]['likes_count']}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--tabla de tiktok-->
<div class="container" id="div_tabla_manfred">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
            <div class="card-header">
                <h4 class="card-title"> Publicaciones de Tik Tok</h4>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Fecha Inicio</label>
                        <input type="date" class="form-control" name="start_tabla_manfred" id="start_tabla_manfred" >
                    </div>
                    <div class="col-md-4">
                        <label for="">Fecha Fin</label>
                        <input type="date" class="form-control" name="end_tabla_manfred" id="end_tabla_manfred">
                    </div>
                    <div class="col-md-4">
                        <label for=""></label><br> 
                        <button id="filterTablaManfred" class="btn btn-primary">Actualizar Tabla</button>
                        <button id="showAllManfred" class="btn btn-secondary">Mostrar Todas las Publicaciones</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <style>
                        table {width: 100%;border-collapse: collapse;}
                        th, td {border: 1px solid black;padding: 8px;text-align: center;width: 5.5%; /* Ancho fijo para cada columna en un total de 8 columnas */}
                        caption {caption-side: top;font-size: 1.5em;font-weight: bold;margin-bottom: 10px;}
                    </style>
                    <table id="tablamanfred" class="display table tablesorter" style="width:100%">
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
<!--tabla de manfred -->
<script>
    var tablemanfred = $('#tablamanfred').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('tablepostmanfredtiktok') }}",
            "type": "GET",
            "data": function(d) {
                // Agregar las fechas a los parámetros de la solicitud  
                d.start_date = $('#start_tabla_manfred').val();
                d.end_date = $('#end_tabla_manfred').val();
            }
        },
        "order": [[ 4, "desc" ]],
        "columns": [
            { "data": "id" },
            {
                "data": "video_description",
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
            { "data": "create_time" },
            { "data": "comment_count" },
            {"data": "view_count"},
            {"data":"share_count"},
            { "data": "like_count" },
            { 
                "data": null,
                "render": function(data, type, row) {
                    return `
                        <button type="button"  title="Generar Grafica" class="btn btn-primary id_graficar" value="${row.id}" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-chart-bar"></i>
                        </button>
                        <br><br>
                        <button type="button" title="Generar PDF" class="btn btn-warning id_pdf" value="${row.id}" data-toggle="modal" data-target="#PdfModal">
                            <i class="fas fa-file-pdf"></i>
                        </button>`;
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
        "pageLength": 10 
    });
    // Evento para el botón de filtro
    $('#filterTablaManfred').on('click', function() {
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
        tablemanfred.ajax.reload(function() {
            // Cerrar el mensaje de actualización después de que se complete la recarga
            Swal.close();
        });
    });
    $('#showAllManfred').on('click', function() {
        // Limpiar los campos de fecha
        $('#start_tabla_manfred').val('');
        $('#end_tabla_manfred').val('');
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
        tablemanfred.ajax.reload(function() {
            // Cerrar el mensaje de actualización después de que se complete la recarga
            Swal.close();
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

