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

        .page-4 {
            background-image: url('{{ $src_interaccion_facebook }}');
            background-size: cover;
            height: 100vh;
        }
        
        /* Estilo para las páginas restantes */
        .page-5 {
            background-image: url('{{ $src_resultado_facebook }}');
            background-size: cover;
            height: 100vh;
        }

        .page-6 {
            background-image: url('{{ $src_mayoralcance }}');
            background-size: cover;
            height: 100vh;
        }
        .page-7 {
            background-image: url('{{ $src_compartido }}');
            background-size: cover;
            height: 100vh;
        }
        .page-8 {
            background-image: url('{{ $src_comentado_facebook }}');
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
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <!-- Logo Facebook -->
    <div class="page-2">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <!-- Total Publicaciones -->
    <div class="page-3">
        <div style="position:absolute; top:300px; left:220px;"> <h1 style="color:white;font-size: 100px;">{{$datos['allPost']}}</h1></div>
        <div style="position:absolute; top:300px; left:680px;"> <h1 style="color:white;font-size:100px">{{$datos['allScope']}}</h1></div>
        <div style="position:absolute; top:300px; left:1150px;"> <h1 style="color:white;font-size:100px">{{$datos['allLife']}}</h1></div>
        <div style="position:absolute; top:700px; left:100px;"> <h1 style="color:white;font-size:100px">{{$datos['allAlbum']}}</h1></div>
        <div style="position:absolute; top:840px; left:500px;"> <h1 style="color:white;font-size:100px">{{$datos['allShare']}}</h1></div>
        <div style="position:absolute; top:700px; left:900px;"> <h1 style="color:white;font-size:100px">{{$datos['allVideo']}}</h1></div>
        <div style="position:absolute; top:840px; left:1290px;"> <h1 style="color:white;font-size:100px">{{$datos['allClicks']}}</h1></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <!-- Interacciones -->
    <div class="page-4">
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:380px; left:200px; font-size:21px;"> <img src="{{$chartUrl}}" width="1050px"></div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:1100px; left:850px; font-size:21px;"> <h1 style="color:white;font-size: 50px;">{{$totalReactionsSum}}</h1></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <!-- Seguidores -->
    <div class="page-5">
        <div style="position:absolute; top:420px; left:180px;"> <img src="{{$chartUrlSeguidores}}" width="900px"></div>
        <div style="position:absolute; top:685px; left:1100px;"> <h1 style="color:white;font-size: 30px;">{{$total_seguidores}}</h1></div>
        <div style="position:absolute; top:820px; left:1140px;"> <h1 style="color:white;font-size: 30px;">{{$nuevos_seguidores}}</h1></div>
        <div style="position:absolute; top:950px; left:1100px;"> <h1 style="color:white;font-size: 30px;">{{$unfollows}}</h1></div>
        <div style="position:absolute; top:1100px; left:850px;"> <h1 style="color:white;font-size: 50px;">{{$totalReactionsSum}}</h1></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
        
    <!--Contenido mayor alcance-->
    <div class="page-6">
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:150px; font-size:21px; width:450px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$imageSrcMayorAlcance1}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
        <div style="position:absolute; top:1020px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['TopPost'][0]['type_post']}}</h1></div>
        <div style="position:absolute; top:1150px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['TopPost'][0]['created_time']}}</h1></div>
        <div style="position:absolute; top:900px; left:90px; font-size:21px; width:500px; padding:10px; box-sizing:border-box;"><h1 style="color:black;font-size: 30px;">{{$datos['TopPost'][0]['story']}}</h1></div>
        <div style="position:absolute; top:200px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$sumatotalinteraccionespost1}}</h1></div>
        <div style="position:absolute; top:330px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][0]['total_reactions']}}</h1></div>
        <div style="position:absolute; top:460px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][0]['comments_count']}}</h1></div>
        <div style="position:absolute; top:600px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][0]['share_count']}}</h1></div>
        <div style="position:absolute; top:730px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][0]['post_impressions']}}</h1></div>
        <div style="position:absolute; top:860px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][0]['post_click']}}</h1></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
    @if(isset($datos['TopPost'][1]))
        <div class="page-6">
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:150px; font-size:21px; width:450px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$imageSrcMayorAlcance2}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
            <div style="position:absolute; top:1020px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['TopPost'][1]['type_post']}}</h1></div>
            <div style="position:absolute; top:1150px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['TopPost'][1]['created_time']}}</h1></div>
            <div style="position:absolute; top:900px; left:90px; font-size:21px; width:500px; padding:10px; box-sizing:border-box;"><h1 style="color:black;font-size: 30px;">{{$datos['TopPost'][1]['story']}}</h1></div>
            <div style="position:absolute; top:200px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$sumatotalinteraccionespost2}}</h1></div>
            <div style="position:absolute; top:330px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][1]['total_reactions']}}</h1></div>
            <div style="position:absolute; top:460px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][1]['comments_count']}}</h1></div>
            <div style="position:absolute; top:600px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][1]['share_count']}}</h1></div>
            <div style="position:absolute; top:730px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][1]['post_impressions']}}</h1></div>
            <div style="position:absolute; top:860px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][1]['post_click']}}</h1></div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    @endif

    <!--contenido mas compartido-->
    <div class="page-7">
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:150px; font-size:21px; width:450px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$imageSrcCompartido}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
        <div style="position:absolute; top:1020px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostSharedPost'][0]['type_post']}}</h1></div>
        <div style="position:absolute; top:1150px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostSharedPost'][0]['created_time']}}</h1></div>
        <div style="position:absolute; top:900px; left:90px; font-size:21px; width:500px; padding:10px; box-sizing:border-box;"><h1 style="color:black;font-size: 30px;">{{$datos['getMostSharedPost'][0]['story']}}</h1></div>
        <div style="position:absolute; top:200px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$sumatotalinteraccionesCompartido}}</h1></div>
        <div style="position:absolute; top:330px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][0]['total_reactions']}}</h1></div>
        <div style="position:absolute; top:460px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][0]['comments_count']}}</h1></div>
        <div style="position:absolute; top:600px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][0]['share_count']}}</h1></div>
        <div style="position:absolute; top:730px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][0]['post_impressions']}}</h1></div>
        <div style="position:absolute; top:860px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][0]['post_click']}}</h1></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
    @if(isset($datos['getMostSharedPost'][1]))
        <div class="page-7">
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:150px; font-size:21px; width:450px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$datos['getMostSharedPost'][1]['full_picture']}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
            <div style="position:absolute; top:1020px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostSharedPost'][1]['type_post']}}</h1></div>
            <div style="position:absolute; top:1150px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostSharedPost'][1]['created_time']}}</h1></div>
            <div style="position:absolute; top:900px; left:90px; font-size:21px; width:500px; padding:10px; box-sizing:border-box;"><h1 style="color:black;font-size: 30px;">{{$datos['getMostSharedPost'][1]['story']}}</h1></div>
            @php($sumatotalinteraccionesCompartido2 = $datos['getMostSharedPost'][1]['comments_count'] + $datos['getMostSharedPost'][1]['share_count'] + $datos['getMostSharedPost'][1]['like_count'] + $datos['getMostSharedPost'][1]['love_count'] + $datos['getMostSharedPost'][1]['haha_count']+ $datos['getMostSharedPost'][1]['wow_count']+ $datos['getMostSharedPost'][1]['sad_count']+ $datos['getMostSharedPost'][1]['angry_count'] )
            <div style="position:absolute; top:200px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$sumatotalinteraccionesCompartido2}}</h1></div>
            <div style="position:absolute; top:330px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][1]['total_reactions']}}</h1></div>
            <div style="position:absolute; top:460px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][1]['comments_count']}}</h1></div>
            <div style="position:absolute; top:600px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][1]['share_count']}}</h1></div>
            <div style="position:absolute; top:730px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][1]['post_impressions']}}</h1></div>
            <div style="position:absolute; top:860px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][1]['post_click']}}</h1></div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    @endif

    <!--contenido mas comentado-->
    <div class="page-8">
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:150px; font-size:21px; width:450px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$imageSrcComentario}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
        <div style="position:absolute; top:1020px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostCommentsPost'][0]['type_post']}}</h1></div>
        <div style="position:absolute; top:1150px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostCommentsPost'][0]['created_time']}}</h1></div>
        <div style="position:absolute; top:900px; left:90px; font-size:21px; width:500px; padding:10px; box-sizing:border-box;"><h1 style="color:black;font-size: 30px;">{{$datos['getMostCommentsPost'][0]['story']}}</h1></div>
        <div style="position:absolute; top:200px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$sumatotalinteraccionesComentarios}}</h1></div>
        <div style="position:absolute; top:330px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][0]['total_reactions']}}</h1></div>
        <div style="position:absolute; top:460px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][0]['comments_count']}}</h1></div>
        <div style="position:absolute; top:600px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][0]['share_count']}}</h1></div>
        <div style="position:absolute; top:730px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][0]['post_impressions']}}</h1></div>
        <div style="position:absolute; top:860px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][0]['post_click']}}</h1></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
    @if(isset($datos['getMostCommentsPost'][1]))
        <div class="page-8">
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:150px; font-size:21px; width:450px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$datos['getMostCommentsPost'][1]['full_picture']}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
            <div style="position:absolute; top:1020px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostCommentsPost'][1]['type_post']}}</h1></div>
            <div style="position:absolute; top:1150px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostCommentsPost'][1]['created_time']}}</h1></div>
            <div style="position:absolute; top:900px; left:90px; font-size:21px; width:500px; padding:10px; box-sizing:border-box;"><h1 style="color:black;font-size: 30px;">{{$datos['getMostCommentsPost'][1]['story']}}</h1></div>
            @php($sumatotalinteraccionesComentarios2 = $datos['getMostCommentsPost'][1]['comments_count'] + $datos['getMostCommentsPost'][1]['share_count'] + $datos['getMostCommentsPost'][1]['like_count'] + $datos['getMostCommentsPost'][1]['love_count'] + $datos['getMostCommentsPost'][1]['haha_count']+ $datos['getMostCommentsPost'][1]['wow_count']+ $datos['getMostCommentsPost'][1]['sad_count']+ $datos['getMostCommentsPost'][1]['angry_count'] )
            <div style="position:absolute; top:200px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$sumatotalinteraccionesComentarios2}}</h1></div>
            <div style="position:absolute; top:330px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][1]['total_reactions']}}</h1></div>
            <div style="position:absolute; top:460px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][1]['comments_count']}}</h1></div>
            <div style="position:absolute; top:600px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][1]['share_count']}}</h1></div>
            <div style="position:absolute; top:730px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][1]['post_impressions']}}</h1></div>
            <div style="position:absolute; top:860px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][1]['post_click']}}</h1></div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    @endif


    <!--impresions-->
    <div class="page-8">
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:150px; font-size:21px; width:450px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$datos['topImpressionsPosts'][0]['full_picture']}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
        <div style="position:absolute; top:1020px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['topImpressionsPosts'][0]['type_post']}}</h1></div>
        <div style="position:absolute; top:1150px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['topImpressionsPosts'][0]['created_time']}}</h1></div>
        <div style="position:absolute; top:900px; left:90px; font-size:21px; width:500px; padding:10px; box-sizing:border-box;"><h1 style="color:black;font-size: 30px;">{{$datos['topImpressionsPosts'][0]['story']}}</h1></div>
        @php($sumatotalinteraccionesImpresiones = $datos['topImpressionsPosts'][0]['comments_count'] + $datos['topImpressionsPosts'][0]['share_count'] + $datos['topImpressionsPosts'][0]['like_count'] + $datos['topImpressionsPosts'][0]['love_count'] + $datos['topImpressionsPosts'][0]['haha_count']+ $datos['topImpressionsPosts'][0]['wow_count']+ $datos['topImpressionsPosts'][0]['sad_count']+ $datos['topImpressionsPosts'][0]['angry_count'] )
        <div style="position:absolute; top:200px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$sumatotalinteraccionesImpresiones}}</h1></div>
        <div style="position:absolute; top:330px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['topImpressionsPosts'][0]['total_reactions']}}</h1></div>
        <div style="position:absolute; top:460px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['topImpressionsPosts'][0]['comments_count']}}</h1></div>
        <div style="position:absolute; top:600px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['topImpressionsPosts'][0]['share_count']}}</h1></div>
        <div style="position:absolute; top:730px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['topImpressionsPosts'][0]['post_impressions']}}</h1></div>
        <div style="position:absolute; top:860px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['topImpressionsPosts'][0]['post_click']}}</h1></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
    @if(isset($datos['topImpressionsPosts'][1]))
        <div class="page-8">
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:150px; font-size:21px; width:450px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$datos['topImpressionsPosts'][1]['full_picture']}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
            <div style="position:absolute; top:1020px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['topImpressionsPosts'][1]['type_post']}}</h1></div>
            <div style="position:absolute; top:1150px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['topImpressionsPosts'][1]['created_time']}}</h1></div>
            <div style="position:absolute; top:900px; left:90px; font-size:21px; width:500px; padding:10px; box-sizing:border-box;"><h1 style="color:black;font-size: 30px;">{{$datos['topImpressionsPosts'][1]['story']}}</h1></div>
            @php($sumatotalinteraccionesImpresiones2 = $datos['topImpressionsPosts'][1]['comments_count'] + $datos['topImpressionsPosts'][1]['share_count'] + $datos['topImpressionsPosts'][1]['like_count'] + $datos['topImpressionsPosts'][1]['love_count'] + $datos['topImpressionsPosts'][1]['haha_count']+ $datos['topImpressionsPosts'][1]['wow_count']+ $datos['topImpressionsPosts'][1]['sad_count']+ $datos['topImpressionsPosts'][1]['angry_count'] )
            <div style="position:absolute; top:200px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$sumatotalinteraccionesImpresiones2}}</h1></div>
            <div style="position:absolute; top:330px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['topImpressionsPosts'][1]['total_reactions']}}</h1></div>
            <div style="position:absolute; top:460px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['topImpressionsPosts'][1]['comments_count']}}</h1></div>
            <div style="position:absolute; top:600px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['topImpressionsPosts'][1]['share_count']}}</h1></div>
            <div style="position:absolute; top:730px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['topImpressionsPosts'][1]['post_impressions']}}</h1></div>
            <div style="position:absolute; top:860px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['topImpressionsPosts'][1]['post_click']}}</h1></div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    @endif


    <!--Imagen de Gracias-->
    <div class="page-9">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

</body>
</html>
