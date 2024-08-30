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
        //end servcio top 10 contries

        //servicio all countries
        $url_data_cities = 'https://reportapi.infocenterlatam.com/api/istadistic/listcity';
        $response_data_cities = Http::get($url_data_cities);
        $data_cities = $response_data_cities->json();
        $dataCollectionCities = collect($data_cities['data']);
        $sortedDataCollection = $dataCollectionCities->sortByDesc('fan_count');
        $dataCities=$sortedDataCollection->values()->all();
        //end service all contries

        return view("dashboard_instagram",compact('totalLikes','totalSaved','totalScope','totalShares','data','heads','jsonDataMap','topcountries','dataCities'));
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
            $url = "https://reportapi.infocenterlatam.com/api/istadistic/listPost?page=" . $page;
            $response = Http::get($url);
            $datas = $response->json();
            $items = $datas['data'];
            $total = $datas['total'];
            
            // Ordenar los datos por created_time de manera descendente
            usort($items, function($a, $b) {
                return strtotime($b['created_time']) - strtotime($a['created_time']);
            });

            //dd($total);
            return response()->json([
                'draw' => $request->input('draw'),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $items,
            ]);
        }
    }
}
