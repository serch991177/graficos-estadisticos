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
        'groupedData','dataImpressions','percentageDataCities','percentageData'));
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
            // Definir parámetros de ordenamiento por defecto
            $sortBy = $request->input('columns')[$request->input('order')[0]['column']]['data'] ?? 'created_time';
            $sortDirection = $request->input('order')[0]['dir'] ?? 'desc';
            $url = "https://reportapi.infocenterlatam.com/api/istadistic/listPost?page=" . $page . "&per_page=" . $request->input('length') . "&sort_by=" . $sortBy . "&sort_direction=" . $sortDirection;
             
            $response = Http::get($url);
            $datas = $response->json();
            $items = $datas['data'];
            $total = $datas['total'];
            
            
            //dd($total);
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
            'comments' => []
        ];
        //dd($trendData);
        foreach ($datostendencia as $datatendencia) {
            $trendData['dates'][] = $datatendencia['date'];
            $trendData['likes'][] = (int)$datatendencia['likes'];
            $trendData['comments'][] = (int)$datatendencia['comments'];
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
                'comments' => $item['comments']
                //'impressions_count' => $item['impressions']
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
                //'impressions_count' => $item['impressions']
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
            'comments' => array_values(array_intersect_key($data['comments'], array_flip($filteredIndices)))
        ]; 
    }
}
