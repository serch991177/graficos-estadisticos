<html lang="en">
<head>
    <link href="{{ base_path('vendor/iamcal/php-emoji/lib/emoji.css') }}" rel="stylesheet" type="text/css">
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
        @if(isset($src_escucha_grafica)|| (isset($data_python) && $data_python['status'] == "success"))
            .page-4 {
                background-image: url('{{ $src_escucha_grafica }}');
                background-size: cover;
                height: 100vh;
            }
        @endif
        
        .page-5{
            background-image: url('{{ $src_popcomment }}');
            background-size: cover;
            height: 100vh;
        }

        .page-6{
            background-image: url('{{$src_commentreaction}}');
            background-size: cover;
            height: 100vh;
        }
        @if(isset($src_escucha_palabras))
            .page-7{
                background-image: url('{{$src_escucha_palabras}}');
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
        <div style="position:absolute; top:200px; left:270px;"> <h1 style="color:black;font-size: 35px;">{{ \Carbon\Carbon::parse($postData['created_time'])->format('d/m/Y') }}</h1></div>
        <div style="position:absolute; top:300px; left:270px; width:1300px;"><h1 style="color:black;font-size: 15px;">{!! $contenidoConImagenesToppost0 !!}</h1></div>
        <!--<div style="position:absolute; top:480px; left:290px;"><h1 style="color:black;font-size: 30px;">Instagram</h1></div>-->
        <div style="position:absolute; top:480px; left:450px;"><h1 style="color:black;font-size: 30px;">{{\Carbon\Carbon::parse($postData['created_time'])->diffForHumans()}}</h1></div>
        <div style="position:absolute; top:600px; left:400px;"><h1 style="color:black;font-size: 30px;">{{$total_reacciones}}</h1></div>
        <div style="position:absolute; top:740px; left:400px;"><h1 style="color:black;font-size: 30px;">{!! $reactionstop !!}</h1></div>
        <div style="position:absolute; top:850px; left:400px;"><h1 style="color:black;font-size: 30px;">{{$postData['shares_count']}}</h1></div>
        <div style="position:absolute; top:950px; left:400px;"><h1 style="color:black;font-size: 30px;">{{$postData['comments_count']}}</h1></div>
        <div style="position:absolute; top:1050px; left:400px;"><h1 style="color:black;font-size: 30px;">{{$postData['comments_count'] + $postData['likes_count'] + $postData['saved_count']  + $postData['shares_count']}}</h1></div>
        <div style="position:absolute; top:1150px; left:400px;"><h1 style="color:black;font-size: 30px;">{{$postData['post_impressions']}}</h1></div>
        <div style="position:absolute; top:660px; left:950px;width:450px; height:470px; overflow:hidden;"><img src="{{$imageSrc}}" style="max-width:100%; max-height:100%;" alt="Image"></div>
        @if(isset($postData['comment_pop']['message']))
            <div style="position:absolute; top:200px; left:870px;width:790px;"><h1 style="color:black;font-size: 15px;">{{$postData['comment_pop']['message']}}</h1></div>
        @else
            <div style="position:absolute; top:200px; left:870px;width:790px;"><h1 style="color:black;font-size: 20px;"></h1></div>
        @endif
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <!--comentarios -->
    <div class="page-5" >
        <div style="position:absolute; top:300px; left:100px;width:1580px;">
            @php
                // Verificamos si 'message' está definido y no está vacío
                $message = $contenidoconEmojisreacciones0 ?? '';
            @endphp

            @if (!empty($message))
                @if (strpos($message, 'data:image/') === 0)
                    {{-- Si es una imagen en base64 --}}
                    <img src="{{ $message }}" alt="Imagen base64" style="max-width:20%; max-height:20%;" />
                @else
                    {{-- Si es texto --}}
                    <h1 style="color:black;font-size: 15px;">{!! $message !!}</h1>
                @endif
            @else
                {{-- Si no hay contenido en message --}}
                <h1 style="color:black;font-size: 30px;">No hay contenido disponible</h1>
            @endif
        </div>
        <div style="position:absolute; top:650px; left:100px;width:1400px;">
            @php
                // Verificamos si 'message' está definido y no está vacío
                $message = $contenidoconEmojisreacciones1 ?? '';
            @endphp

            @if (!empty($message))
                @if (strpos($message, 'data:image/') === 0)
                    {{-- Si es una imagen en base64 --}}
                    <img src="{{ $message }}" alt="Imagen base64" style="max-width:20%; max-height:20%;" />
                @else
                    {{-- Si es texto --}}
                    <h1 style="color:black;font-size: 15px;">{!! $message !!}</h1>
                @endif
            @else
                {{-- Si no hay contenido en message --}}
                <h1 style="color:black;font-size: 30px;">No hay contenido disponible</h1>
            @endif
        </div>
        <div style="position:absolute; top:980px; left:100px;width:1250px;">
            @php
                // Verificamos si 'message' está definido y no está vacío
                $message = $contenidoconEmojisreacciones2 ?? '';
            @endphp

            @if (!empty($message))
                @if (strpos($message, 'data:image/') === 0)
                    {{-- Si es una imagen en base64 --}}
                    <img src="{{ $message }}" alt="Imagen base64" style="max-width:20%; max-height:20%;" />
                @else
                    {{-- Si es texto --}}
                    <h1 style="color:black;font-size: 15px;">{!! $message !!}</h1>
                @endif
            @else
                {{-- Si no hay contenido en message --}}
                <h1 style="color:black;font-size: 30px;">No hay contenido disponible</h1>
            @endif
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <div class="page-6" >
        <div style="position:absolute; top:300px; left:100px;width:1580px;">
            @php
                // Verificamos si 'message' está definido y no está vacío
                $message = $contenidoconEmojiscomentarios0 ?? '';
            @endphp

            @if (!empty($message))
                @if (strpos($message, 'data:image/') === 0)
                    {{-- Si es una imagen en base64 --}}
                    <img src="{{ $message }}" alt="Imagen base64" style="max-width:20%; max-height:20%;" />
                @else
                    {{-- Si es texto --}}
                    <h1 style="color:black;font-size: 15px;">{!! $message !!}</h1>
                @endif
            @else
                {{-- Si no hay contenido en message --}}
                <h1 style="color:black;font-size: 30px;">No hay contenido disponible</h1>
            @endif
        </div>
        <div style="position:absolute; top:650px; left:100px;width:1400px;">
            @php
                // Verificamos si 'message' está definido y no está vacío
                $message = $contenidoconEmojiscomentarios1 ?? '';
            @endphp

            @if (!empty($message))
                @if (strpos($message, 'data:image/') === 0)
                    {{-- Si es una imagen en base64 --}}
                    <img src="{{ $message }}" alt="Imagen base64" style="max-width:20%; max-height:20%;" />
                @else
                    {{-- Si es texto --}}
                    <h1 style="color:black;font-size: 15px;">{!! $message !!}</h1>
                @endif
            @else
                {{-- Si no hay contenido en message --}}
                <h1 style="color:black;font-size: 30px;">No hay contenido disponible</h1>
            @endif
        </div>
        <div style="position:absolute; top:980px; left:100px;width:1250px;">
            @php
                // Verificamos si 'message' está definido y no está vacío
                $message = $contenidoconEmojiscomentarios2 ?? '';
            @endphp

            @if (!empty($message))
                @if (strpos($message, 'data:image/') === 0)
                    {{-- Si es una imagen en base64 --}}
                    <img src="{{ $message }}" alt="Imagen base64" style="max-width:20%; max-height:20%;" />
                @else
                    {{-- Si es texto --}}
                    <h1 style="color:black;font-size: 15px;">{!! $message !!}</h1>
                @endif
            @else
                {{-- Si no hay contenido en message --}}
                <h1 style="color:black;font-size: 30px;">No hay contenido disponible</h1>
            @endif
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
    
    @if($is_chart == 1)
        @if($postData['ia_positive'] > 0 || $postData['ia_negative'] > 0 || $postData['ia_neutro'] > 0)
            <div class="page-4">
                <div style="position:absolute; top:400px; left: 400px;">
                    <p>Positivo: {{$postData['ia_positive']}}</p>
                    <p>Negativo: {{$postData['ia_negative']}}</p>
                    <p>Neutro: {{$postData['ia_neutro']}}</p>
                </div>
                <div style="position:absolute; top:400px; left:480px;"> 
                    <img src="{{$chart_url}}" width="1000px">
                </div>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
            {{--<div class="page-4">
                <div style="position:absolute; top:400px; left: 400px;">
                    <p>Positivo: {{$postData['ia_positive']}}</p>
                    <p>Negativo: {{$postData['ia_negative']}}</p>
                    <p>Neutro: {{$postData['ia_neutro']}}</p>
                </div>
                <div style="position:absolute; top:400px; left:480px;"> 
                    <img src="{{$chart_bar}}" width="1000px">
                </div>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>--}}
            <div class="page-7">
                <div style="position:absolute; top:400px; left:480px;"> 
                    <img src="{{$postData['clouds_words']}}" width="1000px">
                </div>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
        @endif
    @endif
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






    {{--

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
    
    @endif--}}
</body>
</html>