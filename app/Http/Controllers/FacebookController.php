<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class FacebookController extends Controller
{
    

    public function index(Request $request) {
        set_time_limit(1000); // Establece el límite a 300 segundos si es necesario
        // Obtener el ID de la página
        $id_page = $request->input('id_page');
        /**reactions and pie */
        $url_total = 'https://reportapi.infocenterlatam.com/api/fstadistic/getStadisticCount';
        $headers_total = ['Content-Type' => 'application/json'];
        $body_total = '{
            "id_page" : "'.$id_page.'"
        }'; 
        $client = new Client();
        $response_total = $client->get($url_total, ['headers' => $headers_total,'body' => $body_total,]);
        $responseBody_total = json_decode($response_total->getBody()->getContents(),true);
        $datos_reactions = $responseBody_total['data'];
        $data_pie = ['labels' => ['Likes', 'Loves', 'Hahas','Wows','Sads','Angrys','Shares','Comments'],'values' => [$datos_reactions[0]['total_likes'],$datos_reactions[0]['total_loves'],$datos_reactions[0]['haha_count'],$datos_reactions[0]['wow_count'],$datos_reactions[0]['sad_count'],$datos_reactions[0]['angry_count'],$datos_reactions[0]['share_count'],$datos_reactions[0]['comments_count']]];
        /**end reactions and pie */
        /**services followers */
        //service followers
        $url_followers = 'https://reportapi.infocenterlatam.com/api/fstadistic/getstadisticFollowers';
        $headers_follow = ['Content-Type' => 'application/json'];
        $body_followers = '{
            "id_page" : "'.$id_page.'"
        }'; 
        $client_follow = new Client();
        $response_follow = $client_follow->get($url_followers, ['headers' => $headers_follow,'body' => $body_followers,]);
        $responseBody_follow = json_decode($response_follow->getBody()->getContents(),true);
        $datos_follow = $responseBody_follow['data'];
        $totalFollowers = $datos_follow['total'];
        $totalNewFollowers = str_replace('%', '', $datos_follow['total_new_followers']);
        $totalLostFollowers = str_replace('%', '', $datos_follow['total_lost_followers']);
        $newFollowersNumber = round(($totalNewFollowers / 100) * $totalFollowers);
        $lostFollowersNumber = round(($totalLostFollowers / 100) * $totalFollowers);
        /**mapa */
        // Llamada al servicio con la fecha como parámetro
        $url_mapa_country = "https://reportapi.infocenterlatam.com/api/userfacebookcountry/getlistcountry?id_page=$id_page"; // Usa startDate para filtrar
        $response_mapa_country = Http::get($url_mapa_country);
        $dataMapCountry = $response_mapa_country->json();
        $dataCollection = collect($dataMapCountry['data']);
        // Formatea los datos para Highcharts
        $formattedDataMap = $dataCollection->map(function($item) {
            return [strtolower($item['country_name']), $item['fan_count']];
        });
        /**fin mapas */

        // Retornar los datos en JSON
        return response()->json([
            'datos_reactions' => $datos_reactions,
            'data_pie' => $data_pie,
            'formattedDataMap' => $formattedDataMap,
            'datos_follow' => $datos_follow,
            'newFollowersNumber' => $newFollowersNumber,
            'lostFollowersNumber' => $lostFollowersNumber
        ]);
        
                
                
    }
    
    public function tablepostmanfred(Request $request){
        if ($request->ajax()) {
            //dd($request);
            $page = $request->input('start') / $request->input('length') + 1;
            // Obtener las fechas del request
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            // Definir parámetros de ordenamiento por defecto
            $sortBy = $request->input('columns')[$request->input('order')[0]['column']]['data'] ?? 'created_time';
            $sortDirection = $request->input('order')[0]['dir'] ?? 'desc';
    
            // Construir la URL con los parámetros de ordenamiento
            $url = "https://reportapi.infocenterlatam.com/api/fstadistic/listPost?page=" . $page . "&per_page=" . $request->input('length') . "&sort_by=" . $sortBy . "&sort_direction=" . $sortDirection."&id_page=102674511293040";
    
            // Agregar las fechas si están presentes
            if ($startDate && $endDate) {
                $url .= "&start_date=" . $startDate . "&end_date=" . $endDate;
            }

            $response = Http::get($url);
            $datas = $response->json();
            $items = $datas['data'];
            $total = $datas['total'];
            //dd($items);
            return response()->json([
                'draw' => $request->input('draw'),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $items,
            ]);
        }
    }

    public function getChartFollows(Request $request){
        $request->validate([
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date|before_or_equal:today',
        ]);
        $fecha_inicio = $request->start_date;
        $fecha_fin = $request->end_date; 
        $url_total = 'https://reportapi.infocenterlatam.com/api/fstadistic/reportfordate';
        $headers = ['Content-Type' => 'application/json'];
        $body = '{
            "date_start" : "'.$fecha_inicio.'",
            "date_end" : "'.$fecha_fin.'",
            "id_page" : 102674511293040
        }';        
        $client = new Client();
        $response = $client->post($url_total, ['headers' => $headers,'body' => $body,]);
        $responseBody = json_decode($response->getBody()->getContents(),true);
        $datos = $responseBody['data'];
        $nuevos_seguidores = $datos['follwers']['total_nuevos_seguidores'];
        $unfollows = $datos['follwers']['total_seguidores_perdidos'];
        $total_seguidores= $datos['follwers']['total_seguidores_ultimo'];

        $dailyResults = $responseBody['data']['follwers']['daily_results'];
        //datos para el grafico
        $trendData = [
            'dates' => [],
            'Follows' => [],
            'Unfollows' => []
        ];

        foreach ($dailyResults as $date => $result) {
            $trendData['dates'][] = $date;
            $trendData['Follows'][] = $result['nuevos_seguidores'];
            $trendData['Unfollows'][] = $result['seguidores_perdidos'];
        }
        $trendDataJson = json_encode($trendData);

        $datosformateadosTrend = json_decode($trendDataJson, true);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Filtrar los datos según el rango de fechas
        $filteredData = $this->filterDataByDateRangeFollow($datosformateadosTrend, $startDate, $endDate);
        return response()->json([
            'filteredData' => $filteredData,
            'startDate'=> $startDate,
            'endDate'=> $endDate,
            'nuevos_seguidores'=>$nuevos_seguidores,
            'unfollows'=>$unfollows,
            'total_seguidores'=>$total_seguidores
        ]);

    }
    private function filterDataByDateRangeFollow($data, $startDate, $endDate)
    {
        $filteredIndices = array_keys(array_filter($data['dates'], function($date) use ($startDate, $endDate) {
            return $date >= $startDate && $date <= $endDate;
        }));
        return [
            'dates' => array_values(array_intersect_key($data['dates'], array_flip($filteredIndices))),
            'Follows' => array_values(array_intersect_key($data['Follows'], array_flip($filteredIndices))),
            'Unfollows' => array_values(array_intersect_key($data['Unfollows'], array_flip($filteredIndices)))
        ];
    }

    public function privacypolicy(){
        return view('privacypolicy');
    }
    public function termsandcondition(){
        return view('termsandcondition');
    }
}
