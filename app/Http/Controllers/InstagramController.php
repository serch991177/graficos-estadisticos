<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use RealRashid\SweetAlert\Facades\Alert;

class InstagramController extends Controller
{
    public function cargarinstagraminforme(Request $request){
        return view('reportesinstagram');
    }
    public function index(){
        //counts reactions
        $url_total = 'https://reportapi.infocenterlatam.com/api/istadistic/getReactionsall';
        $response = Http::get($url_total);
        $data = $response->json();
        $totalLikes = $data['data'][0]['total_likes'];
        $totalSaved = $data['data'][0]['total_saved'];
        $totalScope = $data['data'][0]['total_scope'];
        $totalShares = $data['data'][0]['total_shares'];
        $data = ['labels' => ['Likes','Guardados','Alcance','Compartidas'],'values' => [$totalLikes,$totalSaved,$totalScope,$totalShares]];
        //end count reactions
        $heads = [
            '<i class="fas fa-id-badge"></i>',
            '<i class="fas fa-file-alt"></i>',
            '<i class="fas fa-image"></i>',
            '<i class="fas fa-link"></i>',
            '<i class="fas fa-calendar-alt"></i>',
            '<i class="fas fa-comments" style="color: #77DD77;"></i>',
            '<i class="fas fa-eye" style="color: #E91E63;"></i>',
            '<i class="fas fa-bookmark" style="color: #E91E63;"></i>',
            '<i class="fas fa-share" style="color: #03A9F4;"></i>',
            '<i class="fas fa-heart" style="color: #E91E63;"></i>',
            '<i class="fas fa-cog"></i>'
        ];
        
        // Servicio de mapas
        $url_mapa_country = 'https://reportapi.infocenterlatam.com/api/istadistic/listfrom';
        $response_mapa_country = Http::get($url_mapa_country);
        $dataMapCountry = $response_mapa_country->json();
        $ultimafechamaps = \Carbon\Carbon::parse($dataMapCountry['end_time_min'])->format('Y-m-d');
        $dataCollection = collect($dataMapCountry['data']);
        // Formatea los datos para Highcharts
        $formattedDataMap = $dataCollection->map(function($item) {return [strtolower($item['country_name']), $item['fan_count']];});
        // Convierte a JSON para ser utilizado en JavaScript
        $jsonDataMap = $formattedDataMap->toJson();
        //end servicio de mapas

        //servicio top 10 contries
        $url_top_ten = 'https://reportapi.infocenterlatam.com/api/istadistic/getCitiesGroupedByCountry';
        $response_top_ten = Http::get($url_top_ten);
        $data_top_ten = $response_top_ten->json();
        $top_countries = $data_top_ten['data'];
        $order_countries = collect($top_countries);
        // Ordenar por fan_count en orden descendente
        $sortedCountries = $order_countries->sortByDesc('fan_count');
        // Si quieres que los índices sean secuenciales después de ordenar
        $topcountries = $sortedCountries->take(10)->values();
        $top5countries = $order_countries->sortByDesc('fan_count')->take(5);
        $totalFans = $top5countries->sum('fan_count');
        $percentageData = $top5countries->map(function ($item) use ($totalFans) {
            $item['percentage'] = round(($item['fan_count'] / $totalFans) * 100, 2);
            return $item;
        });
        //end servcio top 10 contries

        //servicio all countries
        $url_data_cities = 'https://reportapi.infocenterlatam.com/api/istadistic/listcity';
        $response_data_cities = Http::get($url_data_cities);
        $data_cities = $response_data_cities->json();
        $dataCollectionCities = collect($data_cities['data']);
        $sortedDataCollection = $dataCollectionCities->sortByDesc('fan_count');
        $dataCities=$sortedDataCollection->values()->all();
        $top5cities = $sortedDataCollection->sortByDesc('fan_count')->take(5);
        $totalFansCities = $top5cities->sum('fan_count');
        $percentageDataCities = $top5cities->map(function ($item) use ($totalFansCities) {
            $item['percentage'] = round(($item['fan_count'] / $totalFansCities) * 100, 2);
            return $item;
        });        
        
        //end service all countries

        //service age and gender
        $url_impressions = 'https://reportapi.infocenterlatam.com/api/istadistic/listage';
        $response_impressions = Http::get($url_impressions);
        $data_impressions = $response_impressions->json();
        $dataImpressions = $data_impressions['data'];
        $groupedData = ['Male' => [],'Female' => []];
        foreach ($dataImpressions as $entry) {
            $gender = $entry['age_gender_group'][0] === 'M' ? 'Male' : 'Female';
            $ageRange = substr($entry['age_gender_group'], 2);
        
            if (!isset($groupedData[$gender][$ageRange])) {
                $groupedData[$gender][$ageRange] = 0;
            }
        
            $groupedData[$gender][$ageRange] += $entry['impressions_count'];
        }
        //end service age and gender
        return view("dashboard_instagram",compact('totalLikes','totalSaved','totalScope','totalShares','data','heads','jsonDataMap','topcountries','dataCities',
        'groupedData','dataImpressions','percentageDataCities','percentageData','ultimafechamaps'));
    }

    public function updatereactions(Request $request){
        $fecha_inicio = $request->start_date;
        $fecha_fin = $request->end_date; 
        $url_total = 'https://reportapi.infocenterlatam.com/api/istadistic/getReactionsall';
        $headers = ['Content-Type' => 'application/json'];
        $body = '{
            "date_start" : "'.$fecha_inicio.'",
            "date_end" : "'.$fecha_fin.'"
        }';        
        $client = new Client();
        $response = $client->get($url_total, ['headers' => $headers,'body' => $body,]);
        $responseBody = json_decode($response->getBody()->getContents(),true);
        $datos_reactions = $responseBody['data'];
        $data_pie = ['labels' => ['Likes', 'Guardados', 'Alcance','Compartidas'],'values' => [$datos_reactions[0]['total_likes'],$datos_reactions[0]['total_saved'],$datos_reactions[0]['total_scope'],$datos_reactions[0]['total_shares']]];
        
        return response()->json([
            'datos_reactions' => $datos_reactions,
            'data_pie' => $data_pie
        ]);
       
        
    }

    public function tablepost(Request $request){
        if($request->ajax()){
            $page = $request->input('start') / $request->input('length') + 1;
            // Obtener las fechas del request
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            // Definir parámetros de ordenamiento por defecto
            $sortBy = $request->input('columns')[$request->input('order')[0]['column']]['data'] ?? 'created_time';
            $sortDirection = $request->input('order')[0]['dir'] ?? 'desc';
            $url = "https://reportapi.infocenterlatam.com/api/istadistic/listPost?page=" . $page . "&per_page=" . $request->input('length') . "&sort_by=" . $sortBy . "&sort_direction=" . $sortDirection;
            // Agregar las fechas si están presentes
            if ($startDate && $endDate) {
                $url .= "&start_date=" . $startDate . "&end_date=" . $endDate;
            }
            $response = Http::get($url);
            $datas = $response->json();
            $items = $datas['data'];
            $total = $datas['total'];
            
            
            return response()->json([
                'draw' => $request->input('draw'),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $items,
            ]);
        }
    }

    public function recuperaridgrafica(Request $request){
        $url_total = 'https://reportapi.infocenterlatam.com/api/istadistic/showPost';
        $headers = ['Content-Type' => 'application/json'];
        $body = '{
            "id": '.$request->id.'
        }';        
        $client = new Client();
        $response = $client->get($url_total, ['headers' => $headers,'body' => $body,]);
        $responseBody = json_decode($response->getBody()->getContents(),true);
        $totalLikes = $responseBody['data']['likes_count'];
        $totalcomments = $responseBody['data']['comments_count'];
        $totalimpressions = $responseBody['data']['post_impressions'];
        $totalsaved = $responseBody['data']['saved_count'];
        $totalshares= $responseBody['data']['shares_count'];
        $dibujar_torta = ['labels' => ['Likes', 'Comments', 'Impressions','Saved','Shares'],'values' => [$totalLikes,$totalcomments,$totalimpressions,$totalsaved,$totalshares]];
        return response()->json(['dibujar_torta'=>$dibujar_torta]);  
    }

    public function getChartData(Request $request){    
        $url_tendecia = 'https://reportapi.infocenterlatam.com/api/istadistic/getPostsReactions';
        $response = Http::get($url_tendecia);
        $data = $response->json();
        $datostendencia = $data['data'];
        //dd($datostendencia);
        $trendData = [
            'dates' => [],
            'likes' => [],
            'comments' => [],
            'saved'=>[],
            'scopes'=>[],
            'shares'=>[]
        ];
        //dd($trendData);
        foreach ($datostendencia as $datatendencia) {
            $trendData['dates'][] = $datatendencia['date'];
            $trendData['likes'][] = (int)$datatendencia['likes'];
            $trendData['comments'][] = (int)$datatendencia['comments'];
            $trendData['saved'][] = (int)$datatendencia['saved'];
            $trendData['scopes'][] = (int)$datatendencia['scopes'];
            $trendData['shares'][] = (int)$datatendencia['shares'];

        }
        $trendDataJson = json_encode($trendData);
        $datosformateadosTrend = json_decode($trendDataJson, true);
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        // Filtrar los datos según el rango de fechas
        $filteredData = $this->filterDataByDateRange($datosformateadosTrend, $startDate, $endDate);
        return response()->json($filteredData);
    }

    public function getTopPosts(Request $request){
        $limit = $request->input('limit', 15);
        $limit = in_array($limit, [15, 20, 30]) ? $limit : 15;

        // Obtener las fechas de inicio y fin, si se proporcionan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/istadistic/getPostsList';
        $response = Http::get($url_top);
        $data = $response->json();
        if (!isset($data['data'])) {
            return response()->json(['error' => 'No data found'], 404);
        }
        // Convertir los datos en una colección de Laravel
        $query = collect($data['data']);
        // Filtrar por fechas si están presentes
        if ($startDate) {
            $query = $query->filter(function ($item) use ($startDate) {
                return $item['date'] >= $startDate;
            });
        }
        if ($endDate) {
            $query = $query->filter(function ($item) use ($endDate) {
                return $item['date'] <= $endDate;
            });
        }
        // Ordenar por comments_count en orden descendente y limitar los resultados
        $query = $query->sortByDesc('comments')->take($limit);

        $posts = $query->map(function ($item) {
            
            return (object)[
                'story' => $item['story'],
                'date' => $item['date'],
                'comments' => $item['comments'],
                'impressions_count' => $item['scopes']
            ];
        })->values();
        
        return response()->json($posts);
    }

    public function getTopLike(Request $request){
        $limit = $request->input('limit', 15);
        $limit = in_array($limit, [15, 20, 30]) ? $limit : 15;

        // Obtener las fechas de inicio y fin, si se proporcionan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/istadistic/getPostsList';
        $response = Http::get($url_top);
        $data = $response->json();
    
        if (!isset($data['data'])) {
            return response()->json(['error' => 'No data found'], 404);
        }
        // Convertir los datos en una colección de Laravel
        $query = collect($data['data']);
        // Filtrar por fechas si están presentes
        if ($startDate) {
            $query = $query->filter(function ($item) use ($startDate) {
                return $item['date'] >= $startDate;
            });
        }
        if ($endDate) {
            $query = $query->filter(function ($item) use ($endDate) {
                return $item['date'] <= $endDate;
            });
        }
        // Ordenar por comments_count en orden descendente y limitar los resultados
        $query = $query->sortByDesc('likes')->take($limit);
        
        $posts = $query->map(function ($item) {
            return (object)[
                'story' => $item['story'],
                'date' => $item['date'],
                'likes' => $item['likes'],
                'impressions_count' => $item['scopes']
            ];
        })->values();
        
        return response()->json($posts);
    }
    private function filterDataByDateRange($data, $startDate, $endDate){
        $filteredIndices = array_keys(array_filter($data['dates'], function($date) use ($startDate, $endDate) {
            return $date >= $startDate && $date <= $endDate;
        }));

        return [
            'dates' => array_values(array_intersect_key($data['dates'], array_flip($filteredIndices))),
            'likes' => array_values(array_intersect_key($data['likes'], array_flip($filteredIndices))),
            'comments' => array_values(array_intersect_key($data['comments'], array_flip($filteredIndices))),
            'saved' => array_values(array_intersect_key($data['saved'], array_flip($filteredIndices))),
            'scopes' => array_values(array_intersect_key($data['scopes'], array_flip($filteredIndices))),
            'shares' => array_values(array_intersect_key($data['scopes'], array_flip($filteredIndices)))
        ]; 
    }

    //publicacion que sirve ahora se comentara y cambiara por otros datos
    public function informeinstagram(Request $request){
        set_time_limit(300); // Establece el límite a 300 segundos si es necesario
        $request->validate([
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date|before_or_equal:today',
        ]);
        $fecha_inicio = $request->start_date;
        $fecha_fin = $request->end_date; 
        $url_total = 'https://reportapi.infocenterlatam.com/api/istadistic/reportfordate';
        $headers = ['Content-Type' => 'application/json'];
        $body = '{
            "date_start" : "'.$fecha_inicio.'",
            "date_end" : "'.$fecha_fin.'"
        }';        
        $client = new Client();
        $response = $client->post($url_total, ['headers' => $headers,'body' => $body,]);
        $responseBody = json_decode($response->getBody()->getContents(),true);
        $datos = $responseBody['data'];
        //dd($datos['TopPost'][0]['type_post']);
        if(empty($datos['TopPost'])){
            Alert::error('No se encontraron Publicaciones en la fecha');
            return redirect('/reportes-instagram');
        }else{
            //$total_seguidores= $datos['follwers']['total_seguidores_ultimo'];
            //$nuevos_seguidores = $datos['follwers']['total_nuevos_seguidores'];
            //$unfollows = $datos['follwers']['total_seguidores_perdidos'];
            $sumatotalinteraccionespost1 = $datos['TopPost'][0]['comments_count'] + $datos['TopPost'][0]['shares_count'] + $datos['TopPost'][0]['saved_count'] + $datos['TopPost'][0]['likes_count'];
            if(isset($datos['TopPost'][1])) {
                $sumatotalinteraccionespost2 = $datos['TopPost'][1]['comments_count'] + $datos['TopPost'][1]['shares_count'] + $datos['TopPost'][1]['saved_count'] + $datos['TopPost'][1]['likes_count'];      
            }else {$sumatotalinteraccionespost2 = 0; }
            $sumatotalinteraccionesCompartido = $datos['getMostSharedPost'][0]['comments_count'] + $datos['getMostSharedPost'][0]['shares_count'] + $datos['getMostSharedPost'][0]['saved_count'] + $datos['getMostSharedPost'][0]['likes_count'];
            $sumatotalinteraccionesComentarios = $datos['getMostCommentsPost'][0]['comments_count'] + $datos['getMostCommentsPost'][0]['shares_count'] + $datos['getMostCommentsPost'][0]['saved_count'] + $datos['getMostCommentsPost'][0]['likes_count'];
            
            $imageUrlCompartido = $datos['getMostSharedPost'][0]['media_url'];
            if (empty($imageUrlCompartido)) {
                $imageUrlCompartido = 'https://scontent.fcbb3-1.fna.fbcdn.net/v/t1.6435-9/121240003_204482091112281_7819078301545357074_n.png?_nc_cat=108&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=9opBn_jPZxkQ7kNvgEqLLRo&_nc_ht=scontent.fcbb3-1.fna&oh=00_AYAwE3tarz9rwsjLCPBRhehKMUJTXvHGNSmps0J68_BdeQ&oe=66E01D43';
                $responseCompartido = Http::get($imageUrlCompartido);
                $imageContentsCompartido = $responseCompartido->body();
                $imageBase64Compartidos = base64_encode($imageContentsCompartido);
                $imageSrcCompartido = 'data:' . $responseCompartido->header('Content-Type') . ';base64,' . $imageBase64Compartidos;
            }else{    
                /*$responseCompartido = Http::get($imageUrlCompartido);
                $imageContentsCompartido = $responseCompartido->body();
                $imageBase64Compartidos = base64_encode($imageContentsCompartido);*/
                $imageSrcCompartido = $imageUrlCompartido;
            }
            
            $imageUrlComentario = $datos['getMostCommentsPost'][0]['media_url'];
            if (empty($imageUrlComentario)) {
                $imageUrlComentario = 'https://scontent.fcbb3-1.fna.fbcdn.net/v/t1.6435-9/121240003_204482091112281_7819078301545357074_n.png?_nc_cat=108&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=9opBn_jPZxkQ7kNvgEqLLRo&_nc_ht=scontent.fcbb3-1.fna&oh=00_AYAwE3tarz9rwsjLCPBRhehKMUJTXvHGNSmps0J68_BdeQ&oe=66E01D43';
                $responseComentario = Http::get($imageUrlComentario);
                $imageContentsComentario = $responseComentario->body();
                $imageBase64Comentario = base64_encode($imageContentsComentario);
                $imageSrcComentario = 'data:' . $responseComentario->header('Content-Type') . ';base64,' . $imageBase64Comentario;
            }else{    
                /*$responseComentario = Http::get($imageUrlComentario);
                $imageContentsComentario = $responseComentario->body();
                $imageBase64Comentario = base64_encode($imageContentsComentario);*/
                $imageSrcComentario = $imageUrlComentario;
            }


            $imageUrlMayorAlcance1 = $datos['TopPost'][0]['media_url'];
            if (empty($imageUrlMayorAlcance1)) {
                $imageUrlMayorAlcance1 = 'https://scontent.fcbb3-1.fna.fbcdn.net/v/t1.6435-9/121240003_204482091112281_7819078301545357074_n.png?_nc_cat=108&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=9opBn_jPZxkQ7kNvgEqLLRo&_nc_ht=scontent.fcbb3-1.fna&oh=00_AYAwE3tarz9rwsjLCPBRhehKMUJTXvHGNSmps0J68_BdeQ&oe=66E01D43';
                $responseMayorAlcance1 = Http::get($imageUrlMayorAlcance1);
                $imageContentsMayorAlcance1 = $responseMayorAlcance1->body();
                $imageBase64MayorAlcance1 = base64_encode($imageContentsMayorAlcance1);
                $imageSrcMayorAlcance1 = 'data:' . $responseMayorAlcance1->header('Content-Type') . ';base64,' . $imageBase64MayorAlcance1;
            }else{
                /*$responseMayorAlcance1 = Http::get($imageUrlMayorAlcance1);
                $imageContentsMayorAlcance1 = $responseMayorAlcance1->body();
                $imageBase64MayorAlcance1 = base64_encode($imageContentsMayorAlcance1);*/
                $imageSrcMayorAlcance1 = $imageUrlMayorAlcance1;
            }

            /*$imageUrlMayorAlcance2 = $datos['TopPost'][1]['media_url'];
            if (empty($imageUrlMayorAlcance2)){
                $imageUrlMayorAlcance2 = 'https://scontent.fcbb3-1.fna.fbcdn.net/v/t1.6435-9/121240003_204482091112281_7819078301545357074_n.png?_nc_cat=108&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=9opBn_jPZxkQ7kNvgEqLLRo&_nc_ht=scontent.fcbb3-1.fna&oh=00_AYAwE3tarz9rwsjLCPBRhehKMUJTXvHGNSmps0J68_BdeQ&oe=66E01D43';
                $responseMayorAlcance2 = Http::get($imageUrlMayorAlcance2);
                $imageContentsMayorAlcance2 = $responseMayorAlcance2->body();
                $imageBase64MayorAlcance2 = base64_encode($imageContentsMayorAlcance2);
                $imageSrcMayorAlcance2 = 'data:' . $responseMayorAlcance2->header('Content-Type') . ';base64,' . $imageBase64MayorAlcance2;
            }else{
                $responseMayorAlcance2 = Http::get($imageUrlMayorAlcance2);
                $imageContentsMayorAlcance2 = $responseMayorAlcance2->body();
                $imageBase64MayorAlcance2 = base64_encode($imageContentsMayorAlcance2);
                $imageSrcMayorAlcance2 = 'data:' . $responseMayorAlcance2->header('Content-Type') . ';base64,' . $imageBase64MayorAlcance2;
            }*/

            $imageUrlMayorAlcance2 = 'https://scontent.fcbb3-1.fna.fbcdn.net/v/t1.6435-9/121240003_204482091112281_7819078301545357074_n.png?_nc_cat=108&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=9opBn_jPZxkQ7kNvgEqLLRo&_nc_ht=scontent.fcbb3-1.fna&oh=00_AYAwE3tarz9rwsjLCPBRhehKMUJTXvHGNSmps0J68_BdeQ&oe=66E01D43';
            // Verificar si el índice 1 existe en $datos['TopPost'] y si el campo 'media_url' no está vacío
            if (isset($datos['TopPost'][1]) && !empty($datos['TopPost'][1]['media_url'])) {
                $imageUrlMayorAlcance2 = $datos['TopPost'][1]['media_url'];
            }
            // Obtener la imagen desde la URL
            /*$responseMayorAlcance2 = Http::get($imageUrlMayorAlcance2);
            $imageContentsMayorAlcance2 = $responseMayorAlcance2->body();
            $imageBase64MayorAlcance2 = base64_encode($imageContentsMayorAlcance2);*/
            $imageSrcMayorAlcance2 = $imageUrlMayorAlcance2;



            /**grafico 1 de tendencia */  
            $allReactions = $responseBody['data']['allReactions'];
            $totalReactionsSum = 0;
            foreach ($allReactions as $reactions) {
                $totalReactionsSum += (int) $reactions['total_reactions'];
            }
            $dates = [];
            $postCounts = [];
            $totalReactions = [];
            foreach ($allReactions as $reaction) {
                $dates[] = $reaction['date'];
                $postCounts[] = $reaction['post_count'];
                $totalReactions[] = $reaction['total_reactions'];
            }
            $chartData = [
                'type' => 'line',
                'data' => [
                    'labels' => $dates,
                    'datasets' => [
                        [
                            'label' => 'Conteo de Publicaciones',
                            'data' => $postCounts,
                            'borderColor' => 'rgba(75, 192, 192, 1)',
                            'fill' => false,
                        ],
                        [
                            'label' => 'Total de Reacciones',
                            'data' => $totalReactions,
                            'borderColor' => 'rgba(255, 99, 132, 1)',
                            'fill' => false,
                        ],
                    ],
                ],
            ];
            $chartUrl = 'https://quickchart.io/chart?c=' . urlencode(json_encode($chartData));
            /**Fin grafico 11 de tendencia */

            /**Grafico 2 de tendencia */
            /*$dailyResults = $responseBody['data']['follwers']['daily_results'];
            $datesSeguidores = [];
            $totalSeguidores = [];
            $nuevosSeguidores = [];
            $seguidoresPerdidos = [];
            foreach ($dailyResults as $date => $result) {
                $datesSeguidores[] = $date;
                $totalSeguidores[] = $result['total_seguidores'];
                $nuevosSeguidores[] = $result['nuevos_seguidores'];
                $seguidoresPerdidos[] = $result['seguidores_perdidos'];
            }
            $chartDataSeguidores = [
                'type' => 'line',
                'data' => [
                    'labels' => $datesSeguidores,
                    'datasets' => [
                        [
                            'label' => 'Nuevos Seguidores',
                            'data' => $nuevosSeguidores,
                            'borderColor' => 'rgba(75, 192, 192, 1)',
                            'fill' => false,
                        ],
                        [
                            'label' => 'Seguidores Perdidos',
                            'data' => $seguidoresPerdidos,
                            'borderColor' => 'rgba(255, 99, 132, 1)',
                            'fill' => false,
                        ],
                    ],
                ],
            ];
            $chartUrlSeguidores = 'https://quickchart.io/chart?c=' . urlencode(json_encode($chartDataSeguidores));*/
            /**Fin Grafico 2 de tendencia */
            
            //Imagenes de Facebook
            $inicio = public_path() . '/img/1.jpg';
            $imageInicio = base64_encode(file_get_contents($inicio));
            $src_inicio = 'data:' . mime_content_type($inicio) . ';base64,' . $imageInicio;

            $facebook = public_path() . '/img/2.jpg';
            $imagefacebook = base64_encode(file_get_contents($facebook));
            $src_facebook = 'data:' . mime_content_type($facebook) . ';base64,' . $imagefacebook;
            
            $overview = public_path() . '/img/3.jpg';
            $imageoverview = base64_encode(file_get_contents($overview));
            $src_overview = 'data:' . mime_content_type($overview) . ';base64,' . $imageoverview;
            
            $resultado_facebook = public_path() . '/img/4.jpg';
            $imageresultado_facebook = base64_encode(file_get_contents($resultado_facebook));
            $src_resultado_facebook = 'data:' . mime_content_type($resultado_facebook) . ';base64,' . $imageresultado_facebook;
            
            $mayoralcance_facebook = public_path() . '/img/5.jpg';
            $imagemayoralcance = base64_encode(file_get_contents($mayoralcance_facebook));
            $src_mayoralcance = 'data:' . mime_content_type($mayoralcance_facebook) . ';base64,' . $imagemayoralcance;
            
            $compartido_facebook = public_path() . '/img/6.jpg';
            $imagecompartido = base64_encode(file_get_contents($compartido_facebook));
            $src_compartido = 'data:' . mime_content_type($compartido_facebook) . ';base64,' . $imagecompartido;
            
            $comentado_facebook = public_path() . '/img/7.jpg';
            $imagecomentado_facebook = base64_encode(file_get_contents($comentado_facebook));
            $src_comentado_facebook = 'data:' . mime_content_type($comentado_facebook) . ';base64,' . $imagecomentado_facebook;
            
            //$reacciones_facebook = public_path() . '/img/8.jpg';
            //$imagereacciones_facebook = base64_encode(file_get_contents($reacciones_facebook));
            //$src_reacciones_facebook = 'data:' . mime_content_type($reacciones_facebook) . ';base64,' . $imagereacciones_facebook;
            
            $gracias = public_path() . '/img/8.jpg';
            $imagegracias = base64_encode(file_get_contents($gracias));
            $src_gracias = 'data:' . mime_content_type($gracias) . ';base64,' . $imagegracias;
            //Fin Imagenes de Faceboo
            $vista = view('informe_instagram', [
                'src_inicio' => $src_inicio,
                'src_facebook' => $src_facebook,
                'src_overview' => $src_overview,
                'src_resultado_facebook' => $src_resultado_facebook,
                'src_mayoralcance' => $src_mayoralcance, 
                'src_compartido' => $src_compartido,
                'src_comentado_facebook' => $src_comentado_facebook,
                //'src_reacciones_facebook' => $src_reacciones_facebook,
                'src_gracias' => $src_gracias,
                'datos'=>$datos,
                'chartUrl'=>$chartUrl,
                'totalReactionsSum'=>$totalReactionsSum,
                //'chartUrlSeguidores'=>$chartUrlSeguidores,
                'fecha_inicio' => $fecha_inicio, 
                'fecha_fin' => $fecha_fin,
                //'total_seguidores' => $total_seguidores ,
                //'nuevos_seguidores' => $nuevos_seguidores,
                //'unfollows' => $unfollows,
                'imageSrcMayorAlcance1'=>$imageSrcMayorAlcance1, 
                'imageSrcMayorAlcance2'=>$imageSrcMayorAlcance2,
                'sumatotalinteraccionespost1' =>$sumatotalinteraccionespost1,
                'sumatotalinteraccionespost2'=>$sumatotalinteraccionespost2,
                'imageSrcCompartido'=>$imageSrcCompartido,
                'imageSrcComentario'=>$imageSrcComentario,
                'sumatotalinteraccionesCompartido' => $sumatotalinteraccionesCompartido,
                'sumatotalinteraccionesComentarios' => $sumatotalinteraccionesComentarios
            ]);
            //file_put_contents(public_path('output.html'), $vista);
            //$options = new Options();
            $options = new Options();
            $options->set('isRemoteEnabled',TRUE);
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $dompdf = new Dompdf($options);
            //$dompdf = new Dompdf($options);
            $dompdf->loadHtml($vista);
            //$dompdf->setPaper('letter','Landscape');
            //$dompdf->setPaper(array(0, 0, 630, 1300), 'Landscape'); // 8.5 x 13 pulgadas
            $dompdf->setPaper(array(0, 0, 980, 1300), 'Landscape'); // 8.5 x 13 pulgadas
            //$dompdf->set_option('isPhpEnabled', true);
            $dompdf->render();
            $dompdf->stream('',array("Attachment" => false));
        }
    }
    

    public function informeescucha(){
        set_time_limit(300); // Establece el límite a 300 segundos si es necesario
        
        $url_informe = 'https://reportapi.infocenterlatam.com/api/istadistic/topPost';
        $response_informe = retry(3, function () {
            return Http::timeout(30)->get('https://reportapi.infocenterlatam.com/api/istadistic/topPost');
        }, 100);        
        $data_informe = $response_informe->json();
        $postData = $data_informe['data'];
        $total_reacciones = $postData['comments_count'] + $postData['likes_count'] + $postData['shares_count'] + $postData['saved_count'] ;
       

        $imageUrl = $postData['media_url'];
        if (empty($imageUrl)) {
            $imageUrl = 'https://scontent.fcbb3-1.fna.fbcdn.net/v/t1.6435-9/121240003_204482091112281_7819078301545357074_n.png?_nc_cat=108&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=9opBn_jPZxkQ7kNvgEqLLRo&_nc_ht=scontent.fcbb3-1.fna&oh=00_AYAwE3tarz9rwsjLCPBRhehKMUJTXvHGNSmps0J68_BdeQ&oe=66E01D43';
            $response = Http::get($imageUrl);
            $imageContents = $response->body();
            $imageBase64 = base64_encode($imageContents);
            $imageSrc = 'data:' . $response->header('Content-Type') . ';base64,' . $imageBase64;
        }else{    
            /*$response = Http::get($imageUrl);
            $imageContents = $response->body();
            $imageBase64 = base64_encode($imageContents);*/
            $imageSrc = $imageUrl;
        }

        $inicio = public_path() . '/img/escucha_1.jpg';
        $imageInicio = base64_encode(file_get_contents($inicio));
        $src_inicio = 'data:' . mime_content_type($inicio) . ';base64,' . $imageInicio;

        $facebook = public_path() . '/img/escucha_2.jpg';
        $imagefacebook = base64_encode(file_get_contents($facebook));
        $src_escucha = 'data:' . mime_content_type($facebook) . ';base64,' . $imagefacebook;
        
        $overview = public_path() . '/img/escucha_3.jpg';
        $imageoverview = base64_encode(file_get_contents($overview));
        $src_gracias = 'data:' . mime_content_type($overview) . ';base64,' . $imageoverview;
        
        $vista = view('informe_escucha_instagram',['postData'=>$postData,'imageSrc'=>$imageSrc,'total_reacciones'=>$total_reacciones,'src_inicio'=>$src_inicio,'src_escucha'=>$src_escucha,'src_gracias'=>$src_gracias]);
        $options = new Options(); 
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($vista);
        //$dompdf->setPaper('letter', 'portrait');
        $dompdf->setPaper(array(0, 0, 980, 1300), 'Landscape'); // 8.5 x 13 pulgadas
        $dompdf->set_option('isPhpEnabled', true);
        //$dompdf->page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
        // page_text($w - 120, $h - 40, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
        $dompdf->render();
        // $dompdf->stream('autorizaciones.pdf');
        $dompdf->stream ('',array("Attachment" => false));
    }

    public function informeescuchafecha(Request $request){
        set_time_limit(300); 
        $request->validate([
            //'start_date_listen' => 'required|date|before:end_date',
            //'end_date_listen' => 'required|date|after:start_date|before_or_equal:today',
            //'grafico_tortas' => 'image' ,
            //'grafico_bar'=> 'image'
        ]);
        if(!empty($request->file('grafico_tortas'))){
            $file_cake = $request->file('grafico_tortas');
            $imageChartBase64 = base64_encode(file_get_contents($file_cake));   
        }else {
            $imageChartBase64 = null; 
        }
        if(!empty($request->file('grafico_bar'))){
            $file_bar = $request->file('grafico_bar');
            $imageChartBarBase64 = base64_encode(file_get_contents($file_bar));
        }else{
            $imageChartBarBase64 = null;
        }
        $fecha_inicio = $request->start_date_listen;
        $fecha_fin = $request->end_date_listen; 
        if($request->reaccion_reporte){
            $url_total = 'https://reportapi.infocenterlatam.com/api/istadistic/getReportListen?sort_direction=desc&order_by='.$request->reaccion_reporte;
        }else{
            $url_total = 'https://reportapi.infocenterlatam.com/api/istadistic/getReportListen';
        }
        $headers = ['Content-Type' => 'application/json'];
        $body = '{
            "date_start" : "'.$fecha_inicio.'",
            "date_end" : "'.$fecha_fin.'"
        }';        
        $client = new Client();
        $response = $client->post($url_total, ['headers' => $headers,'body' => $body,]);
        $responseBody = json_decode($response->getBody()->getContents(),true);
        $datos = $responseBody['data'] ?? null;

        if(empty($datos)){
            Alert::error('No se encontraron Publicaciones en la fecha');
            return redirect('/reportes-instagram');
        }else{
            $total_reacciones = $datos['comments_count'] + $datos['shares_count'] + $datos['likes_count'] + $datos['saved_count'] ;
            $imageUrl = $datos['media_url'];
            if (empty($imageUrl)) {
                $imageUrl = 'https://scontent.fcbb3-1.fna.fbcdn.net/v/t1.6435-9/121240003_204482091112281_7819078301545357074_n.png?_nc_cat=108&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=9opBn_jPZxkQ7kNvgEqLLRo&_nc_ht=scontent.fcbb3-1.fna&oh=00_AYAwE3tarz9rwsjLCPBRhehKMUJTXvHGNSmps0J68_BdeQ&oe=66E01D43';
                $response = Http::get($imageUrl);
                $imageContents = $response->body();
                $imageBase64 = base64_encode($imageContents);
                $imageSrc = 'data:' . $response->header('Content-Type') . ';base64,' . $imageBase64;
            }else{    
                /*$response = Http::get($imageUrl);
                $imageContents = $response->body();
                $imageBase64 = base64_encode($imageContents);*/
                $imageSrc = $imageUrl;
            }

            $inicio = public_path() . '/img/escucha_1.jpg';
            $imageInicio = base64_encode(file_get_contents($inicio));
            $src_inicio = 'data:' . mime_content_type($inicio) . ';base64,' . $imageInicio;

            $facebook = public_path() . '/img/escucha_2.jpg';
            $imagefacebook = base64_encode(file_get_contents($facebook));
            $src_escucha = 'data:' . mime_content_type($facebook) . ';base64,' . $imagefacebook;
            
            $overview = public_path() . '/img/escucha_3.jpg';
            $imageoverview = base64_encode(file_get_contents($overview));
            $src_gracias = 'data:' . mime_content_type($overview) . ';base64,' . $imageoverview;
            
            $grafico_escucha = public_path() . '/img/escucha_4.jpg';
            $imagegraficoescucha = base64_encode(file_get_contents($grafico_escucha));
            $src_escucha_grafica = 'data:' . mime_content_type($grafico_escucha) . ';base64,' . $imagegraficoescucha;
           

            $vista = view('informe_escucha_instagram',['postData'=>$datos,'imageSrc'=>$imageSrc,'total_reacciones'=>$total_reacciones,'imageChartBase64'=>$imageChartBase64,'imageChartBarBase64'=>$imageChartBarBase64,'src_inicio'=>$src_inicio,'src_escucha'=>$src_escucha,'src_gracias'=>$src_gracias,'src_escucha_grafica'=>$src_escucha_grafica]);
            $options = new Options(); 
            $options->set('isRemoteEnabled', TRUE);
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($vista);
            $dompdf->setPaper(array(0, 0, 980, 1300), 'Landscape'); // 8.5 x 13 pulgadas
            $dompdf->set_option('isPhpEnabled', true);
            $dompdf->render();
            $dompdf->stream ('',array("Attachment" => false));
        }
    }

    public function informeescuchaid(Request $request){
        $url_informe = 'https://reportapi.infocenterlatam.com/api/istadistic/topPostforId/'.$request->id;
        $response_informe = Http::get($url_informe);
        $data_informe = $response_informe->json();
        $postData = $data_informe['data'];
        $total_reacciones = $postData['comments_count'] + $postData['likes_count'] + $postData['shares_count'] + $postData['saved_count'] ;
        
        
        if(empty($postData)){
            echo "No hay comentarios disponibles."; 
        }else{
            // dd($postData[0]->full_picture);
            $imageUrl = $postData['media_url'];
            if (empty($imageUrl)) {
                $imageUrl = 'https://scontent.fcbb3-1.fna.fbcdn.net/v/t1.6435-9/121240003_204482091112281_7819078301545357074_n.png?_nc_cat=108&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=9opBn_jPZxkQ7kNvgEqLLRo&_nc_ht=scontent.fcbb3-1.fna&oh=00_AYAwE3tarz9rwsjLCPBRhehKMUJTXvHGNSmps0J68_BdeQ&oe=66E01D43';
                $response = Http::get($imageUrl);
                $imageContents = $response->body();
                $imageBase64 = base64_encode($imageContents);
                $imageSrc = 'data:' . $response->header('Content-Type') . ';base64,' . $imageBase64;
            }else{    
                /*$response = Http::get($imageUrl);
                $imageContents = $response->body();
                $imageBase64 = base64_encode($imageContents);*/
                $imageSrc = $imageUrl;
            }

            $inicio = public_path() . '/img/escucha_1.jpg';
            $imageInicio = base64_encode(file_get_contents($inicio));
            $src_inicio = 'data:' . mime_content_type($inicio) . ';base64,' . $imageInicio;

            $facebook = public_path() . '/img/escucha_2.jpg';
            $imagefacebook = base64_encode(file_get_contents($facebook));
            $src_escucha = 'data:' . mime_content_type($facebook) . ';base64,' . $imagefacebook;
            
            $overview = public_path() . '/img/escucha_3.jpg';
            $imageoverview = base64_encode(file_get_contents($overview));
            $src_gracias = 'data:' . mime_content_type($overview) . ';base64,' . $imageoverview;
            
            $vista = view('informe_escucha_instagram',['postData'=>$postData,'imageSrc'=>$imageSrc,'total_reacciones'=>$total_reacciones,'src_inicio'=>$src_inicio,'src_escucha'=>$src_escucha,'src_gracias'=>$src_gracias]);
            $options = new Options(); 
            $options->set('isRemoteEnabled', TRUE);
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($vista);
            $dompdf->setPaper(array(0, 0, 980, 1300), 'Landscape'); // 8.5 x 13 pulgadas
            $dompdf->set_option('isPhpEnabled', true);
            //$dompdf->page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
            // page_text($w - 120, $h - 40, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
            $dompdf->render();
            // $dompdf->stream('autorizaciones.pdf');
            $dompdf->stream ('',array("Attachment" => false));
        }   
    }

    public function getTopSaved(Request $request){
        $limit = $request->input('limit', 15);
        $limit = in_array($limit, [15, 20, 30]) ? $limit : 15;

        // Obtener las fechas de inicio y fin, si se proporcionan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/istadistic/getPostsList';
        $response = Http::get($url_top);
        $data = $response->json();
    
        if (!isset($data['data'])) {
            return response()->json(['error' => 'No data found'], 404);
        }
        // Convertir los datos en una colección de Laravel
        $query = collect($data['data']);
        // Filtrar por fechas si están presentes
        if ($startDate) {
            $query = $query->filter(function ($item) use ($startDate) {
                return $item['date'] >= $startDate;
            });
        }
        if ($endDate) {
            $query = $query->filter(function ($item) use ($endDate) {
                return $item['date'] <= $endDate;
            });
        }
        // Ordenar por comments_count en orden descendente y limitar los resultados
        $query = $query->sortByDesc('saved')->take($limit);
        
        $posts = $query->map(function ($item) {
            return (object)[
                'story' => $item['story'],
                'date' => $item['date'],
                'saved' => $item['saved'],
                'impressions_count' => $item['scopes']
            ];
        })->values();
        
        return response()->json($posts);
    }

    public function getTopShare(Request $request){
        $limit = $request->input('limit', 15);
        $limit = in_array($limit, [15, 20, 30]) ? $limit : 15;

        // Obtener las fechas de inicio y fin, si se proporcionan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/istadistic/getPostsList';
        $response = Http::get($url_top);
        $data = $response->json();
    
        if (!isset($data['data'])) {
            return response()->json(['error' => 'No data found'], 404);
        }
        // Convertir los datos en una colección de Laravel
        $query = collect($data['data']);
        // Filtrar por fechas si están presentes
        if ($startDate) {
            $query = $query->filter(function ($item) use ($startDate) {
                return $item['date'] >= $startDate;
            });
        }
        if ($endDate) {
            $query = $query->filter(function ($item) use ($endDate) {
                return $item['date'] <= $endDate;
            });
        }
        // Ordenar por comments_count en orden descendente y limitar los resultados
        $query = $query->sortByDesc('shares')->take($limit);
        
        $posts = $query->map(function ($item) {
            return (object)[
                'story' => $item['story'],
                'date' => $item['date'],
                'shares' => $item['shares'],
                'impressions_count' => $item['scopes']
            ];
        })->values();
        
        return response()->json($posts);
    }

    public function comparativainstagram(){
        return view('comparativainstagram');
    }

    public function servicesinstagram(Request $request){      
        $FirstPage = 'https://graph.facebook.com/v20.0/17841444478446953?fields=business_discovery.username('.$request->firstPage.')%7Bfollowers_count%2Cmedia_count%2Cmedia%7Bcomments_count%2Ccreated_time%2Clike_count%2Cmedia_url%7D%7D&access_token=EAAObpSBCZBMwBOzKJQiKstgerFvrSaLe1y684ETkZAsMkC4IfZC76sR2hgrcafAfFUBC5Hai5uYlu3aNPtN8I8pGvXZBZBscZCmra9PKAMpCnFR7qE4SNUazGNL8H4EZBeVuIZAcXVkVMmEFd0fo9OI1vZC0Ymo1zKZAAz2uK6df1tJ9SgZAk3nPX59IZCJsyW6emdA8ZAQOhUR03';
        $responsefirstpage = Http::get($FirstPage);
        $datafirstpage = $responsefirstpage->json();
        $statuscodefirstpage = $responsefirstpage->getStatusCode();

        $SecondPage = 'https://graph.facebook.com/v20.0/17841444478446953?fields=business_discovery.username('.$request->secondPage.')%7Bfollowers_count%2Cmedia_count%2Cmedia%7Bcomments_count%2Ccreated_time%2Clike_count%2Cmedia_url%7D%7D&access_token=EAAObpSBCZBMwBOzKJQiKstgerFvrSaLe1y684ETkZAsMkC4IfZC76sR2hgrcafAfFUBC5Hai5uYlu3aNPtN8I8pGvXZBZBscZCmra9PKAMpCnFR7qE4SNUazGNL8H4EZBeVuIZAcXVkVMmEFd0fo9OI1vZC0Ymo1zKZAAz2uK6df1tJ9SgZAk3nPX59IZCJsyW6emdA8ZAQOhUR03';
        $responsesecondpage = Http::get($SecondPage);
        $datasecondpage = $responsesecondpage->json();
        $statuscodesecondpage = $responsesecondpage->getStatusCode();
        
        if ($statuscodefirstpage == 200 && $statuscodesecondpage == 200) {
            //datos de la primera pagina
            $countfirstpage = $datafirstpage['business_discovery']['media']['data'];
            $arraylikesfirstpage = array();
            $arraycommentsfirstpage = array();
            for($i=0;$i<count($countfirstpage); $i++){
                array_push($arraylikesfirstpage,$countfirstpage[$i]['like_count']);
                array_push($arraycommentsfirstpage,$countfirstpage[$i]['comments_count']);
            }
            $countfollowsfirstpage = array();
            array_push($countfollowsfirstpage,$datafirstpage['business_discovery']['followers_count']);
            $countmediasfirstpage = array();
            array_push($countmediasfirstpage,$datafirstpage['business_discovery']['media_count']);
            //datos de la segunda pagina
            $countsecondpage = $datasecondpage['business_discovery']['media']['data'];
            $arraylikessecondpage = array();
            $arraycommentssecondpage= array();
            for($i=0;$i<count($countsecondpage);$i++){
                array_push($arraylikessecondpage,$countsecondpage[$i]['like_count']);
                array_push($arraycommentssecondpage,$countsecondpage[$i]['comments_count']);
            }
            $countfollowssecondpage = array();
            array_push($countfollowssecondpage,$datasecondpage['business_discovery']['followers_count']);
            $countmediassecondpage = array();
            array_push($countmediassecondpage,$datasecondpage['business_discovery']['media_count']);
            
            $array_follows = array();
            array_push($array_follows,$countfollowsfirstpage,$countfollowssecondpage);
            
            $array_medias = array();
            array_push($array_medias,$countmediasfirstpage,$countmediassecondpage);


            return response()->json(['success' => true,'array_follows'=>$array_follows ,'array_medias'=>$array_medias,'nombrepagina1'=>$request->firstPage,'nombrepagina2'=>$request->secondPage,'countfollowsfirstpage'=>$countfollowsfirstpage,'countfollowssecondpage'=>$countfollowssecondpage,'countmediasfirstpage'=>$countmediasfirstpage,'countmediassecondpage'=>$countmediassecondpage,'arraylikesfirstpage'=>$arraylikesfirstpage,'arraylikessecondpage'=>$arraylikessecondpage,'arraycommentsfirstpage'=>$arraycommentsfirstpage,'arraycommentssecondpage'=>$arraycommentssecondpage]);
        } else {
            return response()->json(['error' => true]); 
        }
        
    }

    public function tablamanfred(){
        return view('tablamanfred');
    }
    
    public function filtrarDatosMapa(Request $request){
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
    
        // Llamada al servicio con la fecha como parámetro
        $url_mapa_country = "https://reportapi.infocenterlatam.com/api/istadistic/listfrom?date={$endDate}"; // Usa startDate para filtrar
        $response_mapa_country = Http::get($url_mapa_country);
        $dataMapCountry = $response_mapa_country->json();
        dd($dataMapCountry);
        $dataCollection = collect($dataMapCountry['data']);
        
        // Formatea los datos para Highcharts
        $formattedDataMap = $dataCollection->map(function($item) {
            return [strtolower($item['country_name']), $item['fan_count']];
        });
        dd($formattedDataMap);
        return response()->json($formattedDataMap);
    }
    
}
