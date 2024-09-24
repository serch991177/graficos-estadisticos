<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Escucha</title>
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
            background-image: url('{{ $src_escucha }}');
            background-size: cover;
            height: 100vh;
        }

        /* Estilo para la tercera página */
        .page-3 {
            background-image: url('{{ $src_gracias }}');
            background-size: cover;
            height: 100vh;
        }

        @if(isset($src_escucha_grafica))
            .page-4 {
                background-image: url('{{ $src_escucha_grafica }}');
                background-size: cover;
                height: 100vh;
            }
        @endif
        
    </style>
</head>
<body>
    
    {{-- Process top reactions --}}
    @php
        $topReactionsArray = $postData['top_reactions'];
        
        $icons = [
            'Likes' => 'https://img.freepik.com/vector-gratis/facebook-icono-me-gusta_1017-8081.jpg',
            'Loves' => 'https://w7.pngwing.com/pngs/153/642/png-transparent-emoji-heart-love-facebook-ui-colored-icon-thumbnail.png',
            'Hahas' => 'https://as1.ftcdn.net/v2/jpg/03/15/44/94/1000_F_315449403_Z63oCibjsP1oicsKxHXRMjCBUJZmdLE2.jpg',
            'Wows' => 'https://e7.pngegg.com/pngimages/605/472/png-clipart-wow-emoji-world-of-warcraft-facebook-emoticon-like-button-computer-icons-shock-smiley-snout.png',
            'Sads' => 'https://png.pngtree.com/png-clipart/20190516/original/pngtree-facebook-sad-icon-png-image_3584870.jpg',
            'Angries' => 'https://w7.pngwing.com/pngs/862/291/png-transparent-angry-emoji-emoji-angry-facebook-ui-colored-icon.png'
        ];

        $reactionTexts = [];
        if (is_array($topReactionsArray)) {
            foreach ($topReactionsArray as $reaction) {
                list($type, $count) = explode(' ', $reaction);
                $iconPath = isset($icons[$type]) ? $icons[$type] : '';
                $reactionTexts[] = "<img src='{$iconPath}' class='reaction-icon' alt='{$type}' width='20px'> {$type} {$count}";
            }
        }

        $reactionstop = implode(' ', $reactionTexts);

        
    @endphp
    <div class="page-1" >
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
    
    <!-- Contenido de informe escucha -->
    <div class="page-2">
        <div style="position:absolute; top:200px; left:270px;"> <h1 style="color:black;font-size: 35px;">{{$postData['created_time']}}</h1></div>
        <div style="position:absolute; top:300px; left:270px; width:1300px;"><h1 style="color:black;font-size: 30px;">{{$postData['story']}}</h1></div>
        <div style="position:absolute; top:490px; left:290px;"><h1 style="color:black;font-size: 30px;">Facebook</h1></div>
        <div style="position:absolute; top:610px; left:420px;"><h1 style="color:black;font-size: 30px;">{{\Carbon\Carbon::parse($postData['created_time'])->diffForHumans()}}</h1></div>
        <div style="position:absolute; top:750px; left:420px;"><h1 style="color:black;font-size: 30px;">{{$total_reacciones}}</h1></div>
        <div style="position:absolute; top:890px; left:420px;"><h1 style="color:black;font-size: 12px;">{!! $reactionstop !!}</h1></div>
        <div style="position:absolute; top:1000px; left:420px;"><h1 style="color:black;font-size: 30px;">{{$postData['share_count']}}</h1></div>
        <div style="position:absolute; top:1100px; left:420px;"><h1 style="color:black;font-size: 30px;">{{$postData['comments_count']}}</h1></div>
        <div style="position:absolute; top:660px; left:950px;width:450px; height:470px; overflow:hidden;"><img src="{{$imageSrc}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
        @if(isset($postData['comment_pop']['message']))
            <div style="position:absolute; top:200px; left:870px;width:790px;"><h1 style="color:black;font-size: 15px;">{{$postData['comment_pop']['message']}}</h1></div>
        @else
            <div style="position:absolute; top:200px; left:870px;width:790px;"><h1 style="color:black;font-size: 20px;">No hay comentarios.</h1></div>
        @endif
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>




    <!--graficas-->    
    @if(isset($imageChartBase64) || isset($imageChartBarBase64))
        @if(isset($imageChartBase64))
            <div class="page-4">
                <div style="position:absolute; top:400px; left:480px;"> <img src="data:image/jpeg;base64,{{ $imageChartBase64 }}" alt="Gráfico de Tortas" width="700px"></div>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
        @endif
        @if(isset($imageChartBarBase64))
            <div class="page-4">
                <div style="position:absolute; top:400px; left:480px;"><img src="data:image/jpeg;base64,{{ $imageChartBarBase64 }}" alt="Gráfico de Barras" width="700px"></div>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
        @endif
    @else
    
    @endif
    

    <!--Gracias -->
    <div class="page-3">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
    
    
    {{--<table>
        <caption>DATOS DE LA PUBLICACION</caption>
        <tr>
            <td>FECHA</td>
            <td>{{$postData['created_time']}}</td>
        </tr>
        <tr>
            <td>TEMA</td>
            <td>{{$postData['story']}}</td>
        </tr>
        <tr>
            <td>PAGINA</td>
            <td>Facebook</td>
        </tr>
        <tr>
            <td>TIEMPO DE LA MUESTRA</td>
            <td>{{\Carbon\Carbon::parse($postData['created_time'])->diffForHumans()}}</td>
        </tr>
        <tr>
            <td>TOTAL REACCIONES</td>
            <td>{{$total_reacciones}}</td>
        </tr>
        <tr>
            <td>TENDENCIA DE REACCIONES</td>
            <td>{!! $reactionstop !!}</td>
        </tr>
        <tr>
            <td>COMPARTIDOS</td>
            <td>{{$postData['share_count']}}</td>
        </tr>
        <tr>
            <td>COMENTARIOS</td>
            <td>{{$postData['comments_count']}}</td>
        </tr>
    </table>

    <h1 class="text-center">Imagen de la Publicacion</h1>
    <table class="image-center">
        <tr>
            <td>
                <img src="{{$imageSrc}}" alt="" width="200px">
            </td>
        </tr>
    </table>
    <h1 class="text-center">Comentario mas relevante</h1>
    @if(isset($postData['comment_pop']['message']))
        <p class="text-center">{{$postData['comment_pop']['message']}}</p>
    @else
        <p>No hay comentarios.</p>
    @endif
    
    
    --}}
</body>
</html>