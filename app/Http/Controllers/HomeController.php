<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use League\ISO3166\ISO3166;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        //counts reactions
        $url_total = 'https://reportapi.infocenterlatam.com/api/fstadistic/getStadisticCount';
        $response = Http::get($url_total);
        $data = $response->json();
        $totalLikes = $data['data'][0]['total_likes'];
        $totalLoves = $data['data'][0]['total_loves'];
        $totalHahas = $data['data'][0]['haha_count'];
        $totalWows = $data['data'][0]['wow_count'];
        $totalSads = $data['data'][0]['sad_count'];
        $totalAngries = $data['data'][0]['angry_count'];
        $totalShares = $data['data'][0]['share_count'];
        $totalComments = $data['data'][0]['comments_count'];
        $data = ['labels' => ['Likes', 'Loves', 'Hahas','Wows','Sads','Angrys','Shares','Comments'],'values' => [$totalLikes,$totalLoves,$totalHahas,$totalWows,$totalSads,$totalAngries,$totalShares,$totalComments]];
        //end count reactions


        // Servicio de mapas
        $url_mapa_country = 'https://reportapi.infocenterlatam.com/api/userfacebookcountry/getlistcountry';
        $response_mapa_country = Http::get($url_mapa_country);
        $dataMapCountry = $response_mapa_country->json();
        $dataCollection = collect($dataMapCountry['data']);
        // Formatea los datos para Highcharts
        $formattedDataMap = $dataCollection->map(function($item) {return [strtolower($item['country_name']), $item['fan_count']];});
        // Convierte a JSON para ser utilizado en JavaScript
        $jsonDataMap = $formattedDataMap->toJson();
        //end servicio de mapas

        //servicio top 10 contries
        $url_top_ten = 'https://reportapi.infocenterlatam.com/api/userfacebookcountry/getCitiesGroupedByCountry';
        $response_top_ten = Http::get($url_top_ten);
        $data_top_ten = $response_top_ten->json();
        $top_countries = $data_top_ten['data'];
        $order_countries = collect($top_countries);
        // Ordenar por fan_count en orden descendente
        $sortedCountries = $order_countries->sortByDesc('fan_count');
        // Si quieres que los índices sean secuenciales después de ordenar
        $topcountries = $sortedCountries->values();
        //end servcio top 10 contries

        //Datos de la ciudades
        //$dataCities= DB::select('SELECT city_name,fan_count  FROM facebook_page_fans_city ORDER BY fan_count DESC LIMIT 5');
        // Estructurar los datos según el formato proporcionado
        /*$citiesData = [];
        foreach ($dataCities as $city) {
            $citiesData[] = [
                'name' => $city->city_name,
                'data' => [(int)$city->fan_count] // Convertir a entero para asegurarse de que Highcharts maneje los datos correctamente
            ];
        }*/

        //servicio all countries
        $url_data_cities = 'https://reportapi.infocenterlatam.com/api/userfacebookcountry/getlistcity';
        $response_data_cities = Http::get($url_data_cities);
        $data_cities = $response_data_cities->json();
        $dataCollectionCities = collect($data_cities['data']);
        $sortedDataCollection = $dataCollectionCities->sortByDesc('fan_count');
        $dataCities2=$sortedDataCollection->values()->all();
        //end service all contries

        //service age and gender
        $url_impressions = 'https://reportapi.infocenterlatam.com/api/userfacebookcountry/getlistage';
        $response_impressions = Http::get($url_impressions);
        $data_impressions = $response_impressions->json();
        $dataImpressions = $data_impressions['data'];
        //end service age and gender

        $heads = [
            'id',
            'story',
            'foto',
            'link',
            'fecha de creacion',
            'recuento de comentarios',
            'recuento de me gustas',
            'recuento de me ecantas',
            'recuento de me diviertes',
            'recuento de me asombra',
            'recuento de me entristece',
            'recuento de me enojas',
            'recuento de compartidos',
            'opciones'
        ];
        
        // Pasa los datos a la vista
        return view('dashboard', compact('totalLikes', 'totalLoves', 'totalHahas', 'totalWows', 'totalSads', 'totalAngries', 'totalShares', 'totalComments',
        'data','jsonDataMap','topcountries','citiesData','dataCities2','dataImpressions','heads'));           
    }

    public function tablepost(Request $request){
        if($request->ajax()){
            $page = $request->input('start') / $request->input('length') + 1;
            $url = "https://reportapi.infocenterlatam.com/api/fstadistic/listPost?page=" . $page;
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
        $heads = [
            'id',
            'story',
            'foto',
            'link',
            'fecha de creacion',
            'recuento de comentarios',
            'recuento de me gustas',
            'recuento de me ecantas',
            'recuento de me diviertes',
            'recuento de me asombra',
            'recuento de me entristece',
            'recuento de me enojas',
            'recuento de compartidos',
            'opciones'
        ];
        return view('dashboard',['heads'=>$heads]);
    }

    public function informeescucha(){
        set_time_limit(300); // Establece el límite a 300 segundos si es necesario
        
        $url_informe = 'https://reportapi.infocenterlatam.com/api/fstadistic/topPost';
        $response_informe = Http::get($url_informe);
        $data_informe = $response_informe->json();
        $postData = $data_informe['data'];
        $total_reacciones = $postData['like_count'] + $postData['love_count'] + $postData['haha_count'] + $postData['wow_count'] + $postData['sad_count'] + $postData['angry_count'];
       
        $imageUrl = $postData['full_picture'];
        $response = Http::get($imageUrl);
        $imageContents = $response->body();
        $imageBase64 = base64_encode($imageContents);
        $imageSrc = 'data:' . $response->header('Content-Type') . ';base64,' . $imageBase64;
        
        
        $vista = view('informe_escucha',['postData'=>$postData,'imageSrc'=>$imageSrc,'total_reacciones'=>$total_reacciones]);
        $options = new Options(); 
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($vista);
        $dompdf->setPaper('letter', 'portrait');
        $dompdf->set_option('isPhpEnabled', true);
        //$dompdf->page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
        // page_text($w - 120, $h - 40, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
        $dompdf->render();
        // $dompdf->stream('autorizaciones.pdf');
        $dompdf->stream ('',array("Attachment" => false));
    }

    public function informefacebook(){
        set_time_limit(300); // Establece el límite a 300 segundos si es necesario
        
        $inicio = public_path() . '/img/inicio.png';
        $imageInicio = base64_encode(file_get_contents($inicio));
        $src_inicio = 'data:' . mime_content_type($inicio) . ';base64,' . $imageInicio;
    
        $facebook = public_path() . '/img/facebook.png';
        $imagefacebook = base64_encode(file_get_contents($facebook));
        $src_facebook = 'data:' . mime_content_type($facebook) . ';base64,' . $imagefacebook;
    
        $overview = public_path() . '/img/overview.png';
        $imageoverview = base64_encode(file_get_contents($overview));
        $src_overview = 'data:' . mime_content_type($overview) . ';base64,' . $imageoverview;
    
        $resultado_facebook = public_path() . '/img/resultado_facebook.png';
        $imageresultado_facebook = base64_encode(file_get_contents($resultado_facebook));
        $src_resultado_facebook = 'data:' . mime_content_type($resultado_facebook) . ';base64,' . $imageresultado_facebook;
    
        $vista = view('informe_facebook', [
            'src_inicio' => $src_inicio,
            'src_facebook' => $src_facebook,
            'src_overview' => $src_overview,
            'src_resultado_facebook' => $src_resultado_facebook
        ]);
    
        file_put_contents(public_path('output.html'), $vista);


        //$options = new Options();
        $options = new Options();
        $options->set('isRemoteEnabled',TRUE);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);
        //$dompdf = new Dompdf($options);
        $dompdf->loadHtml($vista);
        //$dompdf->setPaper('letter','Landscape');
        $dompdf->setPaper(array(0, 0, 630, 1300), 'Landscape'); // 8.5 x 13 pulgadas
        //$dompdf->set_option('isPhpEnabled', true);
        $dompdf->render();
        $dompdf->stream('',array("Attachment" => false));
    }

    public function recuperaridgrafica(Request $request){

        $url_total = 'https://reportapi.infocenterlatam.com/api/fstadistic/showPost';
        $headers = ['Content-Type' => 'application/json'];
        $body = '{
            "id": '.$request->id.'
        }';        
        $client = new Client();
        $response = $client->get($url_total, ['headers' => $headers,'body' => $body,]);
        $responseBody = json_decode($response->getBody()->getContents(),true);
        $totalLikes = $responseBody['data']['like_count'];
        $totalLoves = $responseBody['data']['love_count'];
        $totalHahas = $responseBody['data']['haha_count'];
        $totalWows = $responseBody['data']['wow_count'];
        $totalSads = $responseBody['data']['sad_count'];
        $totalAngries = $responseBody['data']['angry_count'];
        $totalShares = $responseBody['data']['share_count'];
        $totalComments =$responseBody['data']['comments_count'];
        $dibujar_torta = ['labels' => ['Likes', 'Loves', 'Hahas','Wows','Sads','Angrys','Shares','Comments'],'values' => [$totalLikes,$totalLoves,$totalHahas,$totalWows,$totalSads,$totalAngries,$totalShares,$totalComments]];
        return response()->json(['dibujar_torta'=>$dibujar_torta]);    
    }
    public function informeescuchaid(Request $request){
        $url_informe = 'https://reportapi.infocenterlatam.com/api/fstadistic/topPostforId/'.$request->id;
        $response_informe = Http::get($url_informe);
        $data_informe = $response_informe->json();
        $postData = $data_informe['data'];
        $total_reacciones = $postData['like_count'] + $postData['love_count'] + $postData['haha_count'] + $postData['wow_count'] + $postData['sad_count'] + $postData['angry_count'];
        if(empty($postData)){
            echo "No hay comentarios disponibles."; 
        }else{
            // dd($postData[0]->full_picture);
            $imageUrl = $postData['full_picture'];
            $response = Http::get($imageUrl);
            $imageContents = $response->body();
            $imageBase64 = base64_encode($imageContents);
            $imageSrc = 'data:' . $response->header('Content-Type') . ';base64,' . $imageBase64;
            
            $vista = view('informe_escucha',['postData'=>$postData,'imageSrc'=>$imageSrc,'total_reacciones'=>$total_reacciones]);
            $options = new Options(); 
            $options->set('isRemoteEnabled', TRUE);
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($vista);
            $dompdf->setPaper('letter', 'portrait');
            $dompdf->set_option('isPhpEnabled', true);
            //$dompdf->page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
            // page_text($w - 120, $h - 40, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
            $dompdf->render();
            // $dompdf->stream('autorizaciones.pdf');
            $dompdf->stream ('',array("Attachment" => false));
        }   
    }


    public function getChartData(Request $request){    
        $url_tendecia = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsReactions';
        $response = Http::get($url_tendecia);
        $data = $response->json();
        $datostendencia = $data['data'];
    
        $trendData = [
            'dates' => [],
            'likes' => [],
            'loves' => [],
            'hahas' => [],
            'wows' => [],
            'sads' => [],
            'angries' => []
        ];

        foreach ($datostendencia as $datatendencia) {
            $trendData['dates'][] = $datatendencia['date'];
            $trendData['likes'][] = (int)$datatendencia['likes'];
            $trendData['loves'][] = (int)$datatendencia['loves'];
            $trendData['hahas'][] = (int)$datatendencia['hahas'];
            $trendData['wows'][] = (int)$datatendencia['wows'];
            $trendData['sads'][] = (int)$datatendencia['sads'];
            $trendData['angries'][] = (int)$datatendencia['angrys'];
        }

        $trendDataJson = json_encode($trendData);

        $datosformateadosTrend = json_decode($trendDataJson, true);


        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Filtrar los datos según el rango de fechas
        $filteredData = $this->filterDataByDateRange($datosformateadosTrend, $startDate, $endDate);

        return response()->json($filteredData);
    }

    private function filterDataByDateRange($data, $startDate, $endDate)
    {
        $filteredIndices = array_keys(array_filter($data['dates'], function($date) use ($startDate, $endDate) {
            return $date >= $startDate && $date <= $endDate;
        }));

        return [
            'dates' => array_values(array_intersect_key($data['dates'], array_flip($filteredIndices))),
            'likes' => array_values(array_intersect_key($data['likes'], array_flip($filteredIndices))),
            'loves' => array_values(array_intersect_key($data['loves'], array_flip($filteredIndices))),
            'hahas' => array_values(array_intersect_key($data['hahas'], array_flip($filteredIndices))),
            'wows' => array_values(array_intersect_key($data['wows'], array_flip($filteredIndices))),
            'sads' => array_values(array_intersect_key($data['sads'], array_flip($filteredIndices))),
            'angries' => array_values(array_intersect_key($data['angries'], array_flip($filteredIndices)))
        ];
    }

    public function getTopPosts(Request $request){
        $limit = $request->input('limit', 15);
        $limit = in_array($limit, [15, 20, 30]) ? $limit : 15;

        // Obtener las fechas de inicio y fin, si se proporcionan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
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
                'created_time' => $item['date'],
                'comments_count' => $item['comments'],
            ];
        })->values();
        
        return response()->json($posts);
    }
    
    public function getTopLike(Request $request)
    {
        $limit = $request->input('limit', 15);
        $limit = in_array($limit, [15, 20, 30]) ? $limit : 15;

        // Obtener las fechas de inicio y fin, si se proporcionan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
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
                'created_time' => $item['date'],
                'likes_count' => $item['likes'],
            ];
        })->values();
        
        return response()->json($posts);
    }
    public function getTopLove(Request $request){
        $limit = $request->input('limit', 15);
        $limit = in_array($limit, [15, 20, 30]) ? $limit : 15;

        // Obtener las fechas de inicio y fin, si se proporcionan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
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
        $query = $query->sortByDesc('loves')->take($limit);
        
        $posts = $query->map(function ($item) {
            return (object)[
                'story' => $item['story'],
                'created_time' => $item['date'],
                'loves_count' => $item['loves'],
            ];
        })->values();
        
        return response()->json($posts);
    }
    public function getTopHaha(Request $request){
        $limit = $request->input('limit', 15);
        $limit = in_array($limit, [15, 20, 30]) ? $limit : 15;
        // Obtener las fechas de inicio y fin, si se proporcionan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
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
        $query = $query->sortByDesc('hahas')->take($limit);
        $posts = $query->map(function ($item) {
            return (object)[
                'story' => $item['story'],
                'created_time' => $item['date'],
                'hahas_count' => $item['hahas'],
            ];
        })->values();
        return response()->json($posts);
    }
    public function getTopWow(Request $request){
        $limit = $request->input('limit', 15);
        $limit = in_array($limit, [15, 20, 30]) ? $limit : 15;
        // Obtener las fechas de inicio y fin, si se proporcionan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
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
        $query = $query->sortByDesc('wows')->take($limit);
        $posts = $query->map(function ($item) {
            return (object)[
                'story' => $item['story'],
                'created_time' => $item['date'],
                'wows_count' => $item['wows'],
            ];
        })->values();
        return response()->json($posts);
    }
    public function getTopSad(Request $request){
        $limit = $request->input('limit', 15);
        $limit = in_array($limit, [15, 20, 30]) ? $limit : 15;
        // Obtener las fechas de inicio y fin, si se proporcionan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
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
        $query = $query->sortByDesc('sads')->take($limit);
        $posts = $query->map(function ($item) {
            return (object)[
                'story' => $item['story'],
                'created_time' => $item['date'],
                'sads_count' => $item['sads'],
            ];
        })->values();
        return response()->json($posts);
    }
    public function getTopAngry(Request $request){
        $limit = $request->input('limit', 15);
        $limit = in_array($limit, [15, 20, 30]) ? $limit : 15;
        // Obtener las fechas de inicio y fin, si se proporcionan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
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
        $query = $query->sortByDesc('angrys')->take($limit);
        $posts = $query->map(function ($item) {
            return (object)[
                'story' => $item['story'],
                'created_time' => $item['date'],
                'angries_count' => $item['angrys'],
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
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
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
                'created_time' => $item['date'],
                'shares_count' => $item['shares'],
            ];
        })->values();
        return response()->json($posts);
    }


}
