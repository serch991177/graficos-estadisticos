<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Instagram</title>
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
        
        .page-9 {
            background-image: url('{{ $src_gracias }}');
            background-size: cover;
            height: 100vh;
        }

        .page-10 {
            background-image: url('{{ $src_saved }}');
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
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <!-- Logo Facebook -->
    <div class="page-2">
        <!-- Contenido de la segunda página aquí -->
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <!-- Total Publicaciones -->
    <div class="page-3">
        <!-- Contenido de la tercera página aquí -->
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:300px; left:270px; font-size:21px;"> <h1 style="color:white;font-size: 100px;">{{$datos['allPost']}}</h1></div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:300px; left:750px; font-size:21px;"> <h1 style="color:white;font-size:100px">{{$datos['allImage']}}</h1></div> 
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:300px; left:1230px; font-size:21px;"> <h1 style="color:white;font-size:100px">{{$datos['allLife']}}</h1></div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:780px; left:270px; font-size:21px;"> <h1 style="color:white;font-size:100px">{{$datos['allAlbum']}}</h1></div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:780px; left:750px; font-size:21px;"> <h1 style="color:white;font-size:100px">{{$datos['allScope']}}</h1></div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:780px; left:1230px; font-size:21px;"> <h1 style="color:white;font-size:100px">{{$datos['allVideo']}}</h1></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <!-- Interacciones -->
    <div class="page-4">
        <!-- Contenido para las siguientes páginas -->
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:380px; left:200px; font-size:21px;"> <img src="{{$chartUrl}}" width="1050px"></div>
        <div style="color: rgb(0, 0, 0) !important; text-align:center ; position:absolute; top:1100px; left:850px; font-size:21px;"> <h1 style="color:white;font-size: 50px;">{{$totalReactionsSum}}</h1></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <!--Contenido mayor alcance-->
    <div class="page-5">
        <!--primer post-->
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:150px; font-size:21px; width:450px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$imageSrcMayorAlcance1}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
        <div style="position:absolute; top:980px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['TopPost'][0]['media_type']}}</h1></div>
        <div style="position:absolute; top:1120px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['TopPost'][0]['created_time']}}</h1></div>
        <div style="position:absolute; top:900px; left:90px; font-size:21px; width:500px; padding:10px; box-sizing:border-box;"><h1 style="color:black;font-size: 30px;">{{$datos['TopPost'][0]['story']}}</h1></div>
        <div style="position:absolute; top:240px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$sumatotalinteraccionespost1}}</h1></div>
        <div style="position:absolute; top:370px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][0]['total_reacciones']}}</h1></div>
        <div style="position:absolute; top:500px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][0]['comments_count']}}</h1></div>
        <div style="position:absolute; top:630px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][0]['shares_count']}}</h1></div>
        <div style="position:absolute; top:770px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][0]['post_impressions']}}</h1></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
    @if(isset($datos['TopPost'][1]))
        <div class="page-5">
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:150px; font-size:21px; width:450px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$imageSrcMayorAlcance2}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
            <div style="position:absolute; top:980px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['TopPost'][1]['media_type']}}</h1></div>
            <div style="position:absolute; top:1120px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['TopPost'][1]['created_time']}}</h1></div>
            <div style="position:absolute; top:900px; left:90px; font-size:21px; width:500px; padding:10px; box-sizing:border-box;"><h1 style="color:black;font-size: 30px;">{{$datos['TopPost'][1]['story']}}</h1></div>
            <div style="position:absolute; top:240px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$sumatotalinteraccionespost1}}</h1></div>
            <div style="position:absolute; top:370px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][1]['total_reacciones']}}</h1></div>
            <div style="position:absolute; top:500px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][1]['comments_count']}}</h1></div>
            <div style="position:absolute; top:630px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][1]['shares_count']}}</h1></div>
            <div style="position:absolute; top:770px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['TopPost'][1]['post_impressions']}}</h1></div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    @endif


    <!--contenido mas compartido-->
    <div class="page-6">
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:150px; font-size:21px; width:450px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$imageSrcCompartido}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
        <div style="position:absolute; top:980px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostSharedPost'][0]['media_type']}}</h1></div>
        <div style="position:absolute; top:1120px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostSharedPost'][0]['created_time']}}</h1></div>
        <div style="position:absolute; top:900px; left:90px; font-size:21px; width:500px; padding:10px; box-sizing:border-box;"><h1 style="color:black;font-size: 30px;">{{$datos['getMostSharedPost'][0]['story']}}</h1></div>
        <div style="position:absolute; top:240px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$sumatotalinteraccionesCompartido}}</h1></div>
        <div style="position:absolute; top:370px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][0]['total_reacciones']}}</h1></div>
        <div style="position:absolute; top:500px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][0]['comments_count']}}</h1></div>
        <div style="position:absolute; top:630px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][0]['shares_count']}}</h1></div>
        <div style="position:absolute; top:770px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][0]['post_impressions']}}</h1></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
    @if(isset($datos['getMostSharedPost'][1]))
        <div class="page-6">
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:150px; font-size:21px; width:450px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$datos['getMostSharedPost'][1]['media_url']}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
            <div style="position:absolute; top:980px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostSharedPost'][1]['media_type']}}</h1></div>
            <div style="position:absolute; top:1120px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostSharedPost'][1]['created_time']}}</h1></div>
            <div style="position:absolute; top:900px; left:90px; font-size:21px; width:500px; padding:10px; box-sizing:border-box;"><h1 style="color:black;font-size: 30px;">{{$datos['getMostSharedPost'][1]['story']}}</h1></div>
            @php($sumatotalinteraccionesCompartido2 = $datos['getMostSharedPost'][1]['comments_count'] + $datos['getMostSharedPost'][1]['shares_count'] + $datos['getMostSharedPost'][1]['saved_count'] + $datos['getMostSharedPost'][1]['likes_count'])
            <div style="position:absolute; top:240px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$sumatotalinteraccionesCompartido2}}</h1></div>
            <div style="position:absolute; top:370px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][1]['total_reacciones']}}</h1></div>
            <div style="position:absolute; top:500px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][1]['comments_count']}}</h1></div>
            <div style="position:absolute; top:630px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][1]['shares_count']}}</h1></div>
            <div style="position:absolute; top:770px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSharedPost'][1]['post_impressions']}}</h1></div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    @endif



    <!--contenido mas comentado-->
    <div class="page-7">
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:150px; font-size:21px; width:450px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$imageSrcComentario}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
        <div style="position:absolute; top:980px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostCommentsPost'][0]['media_type']}}</h1></div>
        <div style="position:absolute; top:1120px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostCommentsPost'][0]['created_time']}}</h1></div>
        <div style="position:absolute; top:900px; left:90px; font-size:21px; width:500px; padding:10px; box-sizing:border-box;"><h1 style="color:black;font-size: 30px;">{{$datos['getMostCommentsPost'][0]['story']}}</h1></div>
        <div style="position:absolute; top:240px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$sumatotalinteraccionesComentarios}}</h1></div>
        <div style="position:absolute; top:370px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][0]['total_reacciones']}}</h1></div>
        <div style="position:absolute; top:500px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][0]['comments_count']}}</h1></div>
        <div style="position:absolute; top:630px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][0]['shares_count']}}</h1></div>
        <div style="position:absolute; top:770px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][0]['post_impressions']}}</h1></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
    @if(isset($datos['getMostCommentsPost'][1]))
        <div class="page-7">
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:150px; font-size:21px; width:450px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$datos['getMostCommentsPost'][1]['media_url']}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
            <div style="position:absolute; top:980px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostCommentsPost'][1]['media_type']}}</h1></div>
            <div style="position:absolute; top:1120px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostCommentsPost'][1]['created_time']}}</h1></div>
            <div style="position:absolute; top:900px; left:90px; font-size:21px; width:500px; padding:10px; box-sizing:border-box;"><h1 style="color:black;font-size: 30px;">{{$datos['getMostCommentsPost'][1]['story']}}</h1></div>
            @php($sumatotalinteraccionesComentarios2 = $datos['getMostCommentsPost'][1]['comments_count'] + $datos['getMostCommentsPost'][1]['shares_count'] + $datos['getMostCommentsPost'][1]['saved_count'] + $datos['getMostCommentsPost'][1]['likes_count'])
            <div style="position:absolute; top:240px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$sumatotalinteraccionesComentarios2}}</h1></div>
            <div style="position:absolute; top:370px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][1]['total_reacciones']}}</h1></div>
            <div style="position:absolute; top:500px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][1]['comments_count']}}</h1></div>
            <div style="position:absolute; top:630px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][1]['shares_count']}}</h1></div>
            <div style="position:absolute; top:770px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostCommentsPost'][1]['post_impressions']}}</h1></div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    @endif

    <!--contenido mas guardado-->
    <div class="page-10">
        <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:150px; font-size:21px; width:450px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$datos['getMostSavedPost'][0]['media_url']}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
        <div style="position:absolute; top:980px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostSavedPost'][0]['media_type']}}</h1></div>
        <div style="position:absolute; top:1120px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostSavedPost'][0]['created_time']}}</h1></div>
        <div style="position:absolute; top:900px; left:90px; font-size:21px; width:500px; padding:10px; box-sizing:border-box;"><h1 style="color:black;font-size: 30px;">{{$datos['getMostSavedPost'][0]['story']}}</h1></div>
        @php($sumatotalinteraccionesSaved = $datos['getMostSavedPost'][0]['comments_count'] + $datos['getMostSavedPost'][0]['shares_count'] + $datos['getMostSavedPost'][0]['saved_count'] + $datos['getMostSavedPost'][0]['likes_count'])
        <div style="position:absolute; top:240px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$sumatotalinteraccionesSaved}}</h1></div>
        <div style="position:absolute; top:370px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSavedPost'][0]['total_reacciones']}}</h1></div>
        <div style="position:absolute; top:500px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSavedPost'][0]['comments_count']}}</h1></div>
        <div style="position:absolute; top:630px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSavedPost'][0]['shares_count']}}</h1></div>
        <div style="position:absolute; top:770px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSavedPost'][0]['post_impressions']}}</h1></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
    @if(isset($datos['getMostSavedPost'][1]))
        <div class="page-10">
            <div style="color: rgb(0, 0, 0) !important; text-align:center; position:absolute; top:260px; left:150px; font-size:21px; width:450px; height:470px; overflow:hidden; border:1px solid #ccc; padding:10px; box-sizing:border-box;"><img src="{{$datos['getMostSavedPost'][1]['media_url']}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
            <div style="position:absolute; top:980px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostSavedPost'][1]['media_type']}}</h1></div>
            <div style="position:absolute; top:1120px; left:760px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 30px;">{{$datos['getMostSavedPost'][1]['created_time']}}</h1></div>
            <div style="position:absolute; top:900px; left:90px; font-size:21px; width:500px; padding:10px; box-sizing:border-box;"><h1 style="color:black;font-size: 30px;">{{$datos['getMostSavedPost'][1]['story']}}</h1></div>
            @php($sumatotalinteraccionesSaved2 = $datos['getMostSavedPost'][1]['comments_count'] + $datos['getMostSavedPost'][1]['shares_count'] + $datos['getMostSavedPost'][1]['saved_count'] + $datos['getMostSavedPost'][1]['likes_count'])
            <div style="position:absolute; top:240px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$sumatotalinteraccionesSaved2}}</h1></div>
            <div style="position:absolute; top:370px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSavedPost'][1]['total_reacciones']}}</h1></div>
            <div style="position:absolute; top:500px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSavedPost'][1]['comments_count']}}</h1></div>
            <div style="position:absolute; top:630px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSavedPost'][1]['shares_count']}}</h1></div>
            <div style="position:absolute; top:770px; left:750px; font-size:21px; width:300px; padding:10px; box-sizing:border-box;"><h1 style="color:white;font-size: 50px;">{{$datos['getMostSavedPost'][1]['post_impressions']}}</h1></div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    @endif

    <!--Imagen de Gracias-->
    <div class="page-9">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

</body>
</html>
