<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Escucha</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        caption {
            caption-side: top;
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 10px;
        }
        h1, h4,p,a,img {
            text-align: center;
        }
        .image-center {
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Departamento de Redes Sociales</h1>
    <h4 class="text-center">Informe de Escucha Activa</h4>    
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

        // Debugging output
        //echo '<pre>';
        //echo 'Processed reaction texts: ';
        //var_dump($reactionTexts);
        //echo '</pre>';
    @endphp

    <table>
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
    
    {{--<h1>Link Del Comentario</h1>
    <a href="{{$postData[0]->permalink_url}}" target="_blank" >Ver Comentario</a>
    <h1>Numero de Sub Comentarios</h1>
    <p>{{$postData[0]->comment_count}}</p>--}}
    @if(isset($imageChartBase64) || isset($imageChartBarBase64))
        <h1 class="text-center">Resultado de La Escucha Activa</h1><br>
        @if(isset($imageChartBase64))
            <table class="image-center">
                <tr>
                    <td>
                        <img src="data:image/jpeg;base64,{{ $imageChartBase64 }}" alt="Gráfico de Tortas" width="300" height="300">
                    </td>
                </tr>
            </table><br><br>
        @endif
        @if(isset($imageChartBarBase64))
            <table class="image-center">
                <tr>
                    <td>
                        <img src="data:image/jpeg;base64,{{ $imageChartBarBase64 }}" alt="Gráfico de Barras" width="300" height="300">
                    </td>
                </tr>
            </table>
        @endif
    @else
    
    @endif
</body>
</html>