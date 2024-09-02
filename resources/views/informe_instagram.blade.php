<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Facebook</title>
    <style>
        @page {
            margin: 0in;
        }

        /* Estilo para la primera página */
        .page-1 {
            background-image: url('{{ $src_inicio }}');
            background-size: cover;
            height: 100vh;
        }

        /* Estilo para la segunda página */
        .page-2 {
            background-image: url('{{ $src_facebook }}');
            background-size: cover;
            height: 100vh;
        }

        /* Estilo para la tercera página */
        .page-3 {
            background-image: url('{{ $src_overview }}');
            background-size: cover;
            height: 100vh;
        }

        /* Estilo para las páginas restantes */
        .page-4 {
            background-image: url('{{ $src_resultado_facebook }}');
            background-size: cover;
            height: 100vh;
        }

        .page-5 {
            background-image: url('{{ $src_mayoralcance }}');
            background-size: cover;
            height: 100vh;
        }
        .page-6 {
            background-image: url('{{ $src_compartido }}');
            background-size: cover;
            height: 100vh;
        }
        .page-7 {
            background-image: url('{{ $src_comentado_facebook }}');
            background-size: cover;
            height: 100vh;
        }
        .page-8 {
            background-image: url('{{ $src_reacciones_facebook }}');
            background-size: cover;
            height: 100vh;
        }
        .page-9 {
            background-image: url('{{ $src_gracias }}');
            background-size: cover;
            height: 100vh;
        }
            
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <!-- Caratula -->
    <div class="page-1" >
        <!-- Contenido de la primera página aquí -->
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
    <div class="page-break"></div>

    <!-- Logo Facebook -->
    <div class="page-2">
        <!-- Contenido de la segunda página aquí -->
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>        
    </div>
    <div class="page-break"></div>

    <!-- Total Publicaciones -->
    <div class="page-3">
        <!-- Contenido de la tercera página aquí -->
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:100px; left:500px; font-size:21px;"> <h1 style="color:white;font-size: 100px;">{{$datos['allPost']}} PUBLICACIONES</h1></div>
        {{--<div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:300px; left:800px; font-size:21px;"> <h1 style="color:white;font-size:50px">{{$datos['']}} Artes graficas</h1></div>--}}
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:380px; left:800px; font-size:21px;"> <h1 style="color:white;font-size:50px">{{$datos['allLife']}}  Transmisiones en vivo</h1></div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:460px; left:800px; font-size:21px;"> <h1 style="color:white;font-size:50px">{{$datos['allAlbum']}} Albumes de fotos</h1></div>
        {{--<div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:540px; left:800px; font-size:21px;"> <h1 style="color:white;font-size:50px">{{$datos['allShare']}} Contenido compartido</h1></div>--}}
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:620px; left:800px; font-size:21px;"> <h1 style="color:white;font-size:50px">{{$datos['allVideo']}} Videos</h1></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>        
    </div>
    <div class="page-break"></div>

    <!-- Interacciones -->
    <div class="page-4">
        <!-- Contenido para las siguientes páginas -->
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:180px; left:350px; font-size:21px;"> <img src="{{$chartUrl}}"></div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:140px; left:1400px; font-size:21px;"> <h1 style="color:blue;font-size: 50px;">{{$totalReactionsSum}}</h1></div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:180px; left:1400px; font-size:21px;"> <h1 style="color:red;font-size: 50px;">Interaccciones</h1></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>        
    </div>

    <!-- Seguidores -->
    <div class="page-4">
        <!-- Contenido para las siguientes páginas -->
        {{--<div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:120px; left:180px; font-size:21px;"> <p>{{$fecha_inicio}} - {{$fecha_fin}}</p></div>--}}
        {{--<div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:220px; left:180px; font-size:21px;"> <img src="{{$chartUrlSeguidores}}"></div>--}}
        {{--<div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:200px; left:1400px; font-size:21px;"> <h1 style="color:blue;font-size: 50px;">{{$total_seguidores}}</h1></div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:240px; left:1250px; font-size:21px;"> <h1 style="color:pink;font-size: 50px;">Total de Seguidores</h1></div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:300px; left:1400px; font-size:21px;"> <h1 style="color:blue;font-size: 50px;">{{$nuevos_seguidores}}</h1></div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:340px; left:1250px; font-size:21px;"> <h1 style="color:pink;font-size: 50px;">Nuevos Seguidores</h1></div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:400px; left:1380px; font-size:21px;"> <h1 style="color:red;font-size: 50px;">{{$unfollows}}</h1></div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:440px; left:1250px; font-size:21px;"> <h1 style="color:pink;font-size: 50px;">Seguidores Perdidos</h1></div>--}}
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>        
    </div>

    <!--Contenido mayor alcance-->
    <div class="page-5">
        <!--primer post-->
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:140px; left:150px; font-size:21px; width:450px; height:270px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$imageSrcMayorAlcance1}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:430px; left:10px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Tipo de Post : {{$datos['TopPost'][0]['media_type']}}</div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:460px; left:10px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Fecha del Post : {{$datos['TopPost'][0]['created_time']}}</div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:520px; left:10px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Tipo de publicación : {{$datos['TopPost'][0]['story']}}</div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:430px; left:197px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">{{$sumatotalinteraccionespost1}}</div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:450px; left:310px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Interacciones de la publicacion</div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:490px; left:197px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">{{$datos['TopPost'][0]['total_reacciones']}}</div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:510px; left:227px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Reacciones</div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:550px; left:189px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">{{$datos['TopPost'][0]['comments_count']}}</div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:570px; left:233px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Comentarios</div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:610px; left:195px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">{{$datos['TopPost'][0]['shares_count']}}</div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:630px; left:260px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Veces Compartidas</div>
        <!--segundo post-->
        @if(isset($datos['TopPost'][1]))
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:140px; left:900px; font-size:21px; width:450px; height:270px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$imageSrcMayorAlcance2}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:430px; left:800px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Tipo de Post : {{$datos['TopPost'][1]['media_type']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:460px; left:800px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Fecha del Post : {{$datos['TopPost'][1]['created_time']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:520px; left:800px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Tipo de publicación : {{$datos['TopPost'][1]['story']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:430px; left:1180px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">{{$sumatotalinteraccionespost2}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:450px; left:1300px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Interacciones de la publicacion</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:490px; left:1180px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">{{$datos['TopPost'][1]['total_reacciones']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:510px; left:1220px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Reacciones</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:550px; left:1180px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">{{$datos['TopPost'][1]['comments_count']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:570px; left:1220px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Comentarios</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:610px; left:1180px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">{{$datos['TopPost'][1]['share_count']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:630px; left:1250px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Veces Compartidas</div>
        @endif
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>        
    </div>

    <!--contenido mas compartido-->
    <div class="page-6">
        <div style="position:relative; left:600px;border:1px solid #ccc;">
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:140px; left:-600px; font-size:21px; width:630px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$imageSrcCompartido}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:180px; left:50px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Tipo de Post : {{$datos['getMostSharedPost']['media_type']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:240px; left:50px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Fecha del Post : {{$datos['getMostSharedPost']['created_time']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:300px; left:50px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Tipo de publicación : {{$datos['getMostSharedPost']['story']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:180px; left:280px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">{{$sumatotalinteraccionesCompartido}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:200px; left:400px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Interacciones de la publicacion</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:240px; left:280px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">{{$datos['getMostSharedPost']['total_reacciones']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:320px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Reacciones</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:300px; left:280px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">{{$datos['getMostSharedPost']['comments_count']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:320px; left:328px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Comentarios</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:360px; left:280px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">{{$datos['getMostSharedPost']['shares_count']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:380px; left:358px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Veces Compartidas</div>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>        
    </div>

    <!--contenido mas comentado-->
    <div class="page-7">
        <div style="position:relative; left:600px;">
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:140px; left:-600px; font-size:21px; width:630px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$imageSrcComentario}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:180px; left:50px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Tipo de Post : {{$datos['getMostCommentsPost']['media_type']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:240px; left:50px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Fecha del Post : {{$datos['getMostCommentsPost']['created_time']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:300px; left:50px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Tipo de publicación : {{$datos['getMostCommentsPost']['story']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:180px; left:280px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">{{$sumatotalinteraccionesComentarios}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:200px; left:400px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Interacciones de la publicacion</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:240px; left:280px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">{{$datos['getMostCommentsPost']['total_reacciones']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:320px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Reacciones</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:300px; left:280px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">{{$datos['getMostCommentsPost']['comments_count']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:320px; left:328px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Comentarios</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:360px; left:280px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">{{$datos['getMostCommentsPost']['shares_count']}}</div>
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:380px; left:358px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;">Veces Compartidas</div>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>        
    </div>

    <!--Imagen de Gracias-->
    <div class="page-9">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>        
    </div>

</body>
</html>
