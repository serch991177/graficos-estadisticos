@extends('layouts.app', ['pageSlug' => 'comparativa_instagram'])
@section('content')
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

<div class="container">
    <h1 class="text-center">Analisis de paginas en instagram</h1>
    <div class="row">
        <div class="col-md-4">
            <label>Ingrese el nombre de la primera pagina</label>
            <input type="text" class="form-control" name="first_page" id="first_page">
        </div>
        <div class="col-md-4">
            <label>Ingrese el nombre de la segunda pagina</label>
            <input type="text" class="form-control" name="second_page" id="second_page">
        </div>
        <div class="col-md-4">
            <br>
            <button class="btn btn-success" type="button" onclick="comparar()">Analizar Paginas</button>
        </div>
    </div>
</div>
<br><br>
<div class="container">
    <h1 class="text-center">Analisis de Likes</h1>
    <div class="row">
        <div id="graficacomparativalikes" style="width:100%; height:400px;"></div>
    </div>
</div>
<br><br>
<div class="container">
    <h1 class="text-center">Analisis de Comentarios</h1>
    <div class="row">
        <div id="graficacomparativacomentarios" style="width:100%; height:400px;"></div>
    </div>
</div>
<br><br>
<div class="container">
    <h1 class="text-center">Analisis de Seguidores y Medias</h1>
    <div class="row">
        <div id="graficacomparativafollows" style="width:100%; height:400px;"></div>
    </div>
</div>

<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function comparar(){
        var firstPage = document.getElementById('first_page').value.trim();
        var secondPage = document.getElementById('second_page').value.trim();

        if (firstPage === "" || secondPage === "") {
            Swal.fire("error","Por favor, ingrese los nombres de ambas páginas.","error");
        } else {
            let timerInterval;
            Swal.fire({
                title: "Analizando...",
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
                url: "{{ route('services_instagram') }}",
                method: 'GET',
                data: {
                    firstPage: firstPage,
                    secondPage: secondPage
                },
                success: function (data) {
                    if(data.error){
                        Swal.fire('error','Por favor verifique que los nombres de las paginas sean validas','error')
                    }else{
                        Highcharts.chart('graficacomparativalikes', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Analisis de Likes'
                            },
                            xAxis: {
                                categories: ['P1','P2','P3','P4','P5','P6','P7','P8','P9','P10','P11','P12','P13','P14','P15','P16','P17','P18','P19','P20','P21','P22','P23','P24','P25']
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Cantidad'
                                }
                            },
                            series: [{
                                name: 'Likes '+data.nombrepagina1,
                                data: data.arraylikesfirstpage
                            }, {
                                name: 'Likes '+data.nombrepagina2,
                                data: data.arraylikessecondpage
                            }]
                        });
                        Highcharts.chart('graficacomparativacomentarios', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Analisis de Comentarios'
                            },
                            xAxis: {
                                categories: ['P1','P2','P3','P4','P5','P6','P7','P8','P9','P10','P11','P12','P13','P14','P15','P16','P17','P18','P19','P20','P21','P22','P23','P24','P25']
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Cantidad'
                                }
                            },
                            series: [{
                                name: 'Comentarios '+data.nombrepagina1,
                                data: data.arraycommentsfirstpage 
                            }, {
                                name: 'Comentarios '+data.nombrepagina2,
                                data: data.arraycommentssecondpage
                            }]
                        });
                        Highcharts.chart('graficacomparativafollows', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Analisis de seguidores y medias'
                            },
                            xAxis: {
                                categories: ['Seguidores','Medias']
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Cantidad'
                                }
                            },
                            series: [{
                                name: 'Seguidores '+data.nombrepagina1,
                                data: [data.array_follows[0],null] 
                            },{
                                name: 'Seguidores '+data.nombrepagina2,
                                data: [data.array_follows[1],null]
                            },{
                                name: 'Media '+data.nombrepagina1,
                                data: [null,data.array_medias[0]]
                            },{
                                name: 'Media '+data.nombrepagina2,
                                data: [null,data.array_medias[1]]
                            }]
                        });
                        Swal.close();
                    }
                },
                error: function(data) {
                    // Manejo del error
                    Swal.fire('Error', 'Hubo un problema al analizar los datos.', 'error');
                }
            });

        }
    }
</script>

<script>
    

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

