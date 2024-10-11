<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use League\ISO3166\ISO3166;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Process\Process;

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
        //recuperacion de cuentas
        $url_cuentas = 'https://reportapi.infocenterlatam.com/api/me/getListFacebook';
        $responsecuentas = Http::get($url_cuentas);
        $datacuentas = $responsecuentas['data'];
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
        $totalclicks = $data['data'][0]['post_click'];
        $data = ['labels' => ['Likes', 'Loves', 'Hahas','Wows','Sads','Angrys','Shares','Comments'],'values' => [$totalLikes,$totalLoves,$totalHahas,$totalWows,$totalSads,$totalAngries,$totalShares,$totalComments]];
        //end count reactions
        //dd($data);

        // Servicio de mapas
        $url_mapa_country = 'https://reportapi.infocenterlatam.com/api/userfacebookcountry/getlistcountry';
        $response_mapa_country = Http::get($url_mapa_country);
        $dataMapCountry = $response_mapa_country->json();
        //$ultimafechamaps = $dataMapCountry['end_time_min'];
        $ultimafechamaps = \Carbon\Carbon::parse($dataMapCountry['end_time_min'])->format('Y-m-d');
        $dataCollection = collect($dataMapCountry['data']);
        // Formatea los datos para Highcharts
        $formattedDataMap = $dataCollection->map(function($item) {return [strtolower($item['country_name']), $item['fan_count']];});
        // Convierte a JSON para ser utilizado en JavaScript
        $jsonDataMap = $formattedDataMap->toJson();
        //dd($jsonDataMap);
        //end servicio de mapas

        //servicio top 10 countries
        $url_top_ten = 'https://reportapi.infocenterlatam.com/api/userfacebookcountry/getCitiesGroupedByCountry';
        $response_top_ten = Http::get($url_top_ten);
        $data_top_ten = $response_top_ten->json();
        $top_countries = $data_top_ten['data'];
        $ultimafechatable = \Carbon\Carbon::parse($data_top_ten['end_tiem_min'])->format('Y-m-d');
        $order_countries = collect($top_countries);
        // Ordenar por fan_count en orden descendente
        $sortedCountries = $order_countries->sortByDesc('fan_count');
        // Si quieres que los índices sean secuenciales después de ordenar
        $topcountries = $sortedCountries->values();
        $top5countries = $order_countries->sortByDesc('fan_count')->take(5);
        $totalFans = $top5countries->sum('fan_count');
        $percentageData = $top5countries->map(function ($item) use ($totalFans) {
            $item['percentage'] = round(($item['fan_count'] / $totalFans) * 100, 2);
            return $item;
        });
        //end servcio top 10 contries


        //servicio all countries
        $url_data_cities = 'https://reportapi.infocenterlatam.com/api/userfacebookcountry/getlistcity';
        $response_data_cities = Http::get($url_data_cities);
        $data_cities = $response_data_cities->json();
        $dataCollectionCities = collect($data_cities['data']);
        $sortedDataCollection = $dataCollectionCities->sortByDesc('fan_count');
        $dataCities2=$sortedDataCollection->values()->all();
        $top5cities = $sortedDataCollection->sortByDesc('fan_count')->take(5);
        $totalFansCities = $top5cities->sum('fan_count');
        $percentageDataCities = $top5cities->map(function ($item) use ($totalFans) {
            $item['percentage'] = round(($item['fan_count'] / $totalFans) * 100, 2);
            return $item;
        });
        //end service all contries


        //servicio all citiesmanfred
        $url_data_citiesmanfred = 'https://reportapi.infocenterlatam.com/api/userfacebookcountry/getlistcity?id_page=102674511293040';
        $response_data_citiesmanfred = Http::get($url_data_citiesmanfred);
        $data_citiesmanfred = $response_data_citiesmanfred->json();
        $dataCollectionCitiesmanfred = collect($data_citiesmanfred['data']);
        $sortedDataCollectionmanfred = $dataCollectionCitiesmanfred->sortByDesc('fan_count');
        $dataCities2manfred=$sortedDataCollectionmanfred->values()->all();
        $top5citiesmanfred = $sortedDataCollectionmanfred->sortByDesc('fan_count')->take(5);
        $totalFansCitiesmanfred = $top5citiesmanfred->sum('fan_count');
        $percentageDataCitiesmanfred = $top5citiesmanfred->map(function ($item) use ($totalFansCitiesmanfred) {
            $item['percentage'] = round(($item['fan_count'] / $totalFansCitiesmanfred) * 100, 2);
            return $item;
        });
        //end service all cities

        //servicio countriesmanfred
        $url_top_ten_manfred = 'https://reportapi.infocenterlatam.com/api/userfacebookcountry/getCitiesGroupedByCountry?id_page=102674511293040';
        $response_top_ten_manfred = Http::get($url_top_ten_manfred);
        $data_top_ten_manfred = $response_top_ten_manfred->json();
        $top_countries_manfred = $data_top_ten_manfred['data'];
        $order_countries_manfred = collect($top_countries_manfred);
        // Ordenar por fan_count en orden descendente
        $sortedCountries_manfred = $order_countries_manfred->sortByDesc('fan_count');
        // Si quieres que los índices sean secuenciales después de ordenar
        $topcountries_manfred = $sortedCountries_manfred->values();
        $top5countries_manfred = $order_countries_manfred->sortByDesc('fan_count')->take(5);
        $totalFans_manfred = $top5countries_manfred->sum('fan_count');
        $percentageDataManfred = $top5countries_manfred->map(function ($item) use ($totalFans_manfred) {
            $item['percentage'] = round(($item['fan_count'] / $totalFans_manfred) * 100, 2);
            return $item;
        });
        //end servicio countriesmanfred

        //service age and gender
        $url_impressions = 'https://reportapi.infocenterlatam.com/api/userfacebookcountry/getlistage';
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
        $ultimafechaage = \Carbon\Carbon::parse($data_impressions['end_time_min'])->format('Y-m-d');
        //end service age and gender

        //service most active times
        $url_times = 'https://reportapi.infocenterlatam.com/api/fstadistic/getUsertimeOnline';
        $response_times = Http::get($url_times);
        $data_times = $response_times->json();
        $dataTimes = $data_times['data'];        
        $intervals = [
            '0:00 to 3:00'  => ['0:00', '1:00', '2:00'],
            '3:00 to 6:00'  => ['3:00', '4:00', '5:00'],
            '6:00 to 9:00'  => ['6:00', '7:00', '8:00'],
            '9:00 to 12:00' => ['9:00', '10:00', '11:00'],
            '12:00 to 15:00' => ['12:00', '13:00', '14:00'],
            '15:00 to 18:00' => ['15:00', '16:00', '17:00'],
            '18:00 to 21:00' => ['18:00', '19:00', '20:00'],
            '21:00 to 0:00' => ['21:00', '22:00', '23:00'],
        ];
        $groupedTime = [];
        foreach ($intervals as $interval => $times) {
            $totalFollowers = 0;
        
            foreach ($dataTimes as $entry) {
                if (in_array($entry['time'], $times)) {
                    $totalFollowers += $entry['count_followers'];
                }
            }
        
            $groupedTime[] = [
                'interval' => $interval,
                'total_followers' => $totalFollowers,
            ];
        }
        $ultimafechaTime = \Carbon\Carbon::parse($data_times['end_time_min'])->format('Y-m-d');
        //end service most active times

        //service followers
        $url_followers = 'https://reportapi.infocenterlatam.com/api/fstadistic/getstadisticFollowers';
        $response_followers = Http::get($url_followers);
        $data_followers = $response_followers->json();
        $dataFollowers = $data_followers['data'];
        $totalFollowers = $dataFollowers['total'];
        $totalNewFollowers = str_replace('%', '', $dataFollowers['total_new_followers']);
        $totalLostFollowers = str_replace('%', '', $dataFollowers['total_lost_followers']);
        $newFollowersNumber = round(($totalNewFollowers / 100) * $totalFollowers);
        $lostFollowersNumber = round(($totalLostFollowers / 100) * $totalFollowers);
        //end service followers 

        $heads = [
            '<i class="fas fa-id-badge"></i>',
            '<i class="fas fa-file-alt"></i>',
            '<i class="fas fa-image"></i>',
            '<i class="fas fa-link"></i>',
            '<i class="fas fa-calendar-alt"></i>',
            '<i class="fas fa-comments" style="color: #77DD77;"></i>',
            '<i class="fas fa-thumbs-up" style="color: #2196F3;"></i>',
            '<i class="fas fa-heart" style="color: #E91E63;"></i>',
            '<i class="fas fa-smile" style="color: #FFEB3B;"></i>',
            '<i class="fa-solid fa-face-surprise" style="color: #FF5722;"></i>',
            '<i class="fas fa-sad-tear" style="color: #9C27B0;"></i>',
            '<i class="fas fa-angry" style="color: #F44336;"></i>',
            '<i class="fas fa-share" style="color: #03A9F4;"></i>',
            '<i class="fas fa-bullseye" style="color: #4CAF50;"></i>',
            '<i class="fas fa-handshake" style="color: #FFC107;"></i>',
            '<i class="fas fa-hand-pointer" style="color: #FF5722;"></i>',
            '<i class="fas fa-cog"></i>'
        ];
        //<i class="fas fa-bullseye" style="color: #4CAF50;"></i> <!-- Alcance (Target) -->
        //<i class="fas fa-handshake" style="color: #FFC107;"></i> <!-- Interacción -->
        // Pasa los datos a la vista
        return view('dashboard', compact('totalLikes', 'totalLoves','totalclicks', 'totalHahas', 'totalWows', 'totalSads', 'totalAngries', 'totalShares', 'totalComments','data','jsonDataMap','topcountries','dataCities2','dataImpressions','heads','dataFollowers','newFollowersNumber','lostFollowersNumber'
        ,'groupedData','percentageData','percentageDataCities','groupedTime','ultimafechamaps','ultimafechatable','ultimafechaage','ultimafechaTime','datacuentas','dataCities2manfred','percentageDataCitiesmanfred','percentageDataManfred'));           
    }

    public function filtrarDatosMapa(Request $request) {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        // Llamada al servicio con la fecha como parámetro
        $url_mapa_country = "https://reportapi.infocenterlatam.com/api/userfacebookcountry/getlistcountry?date={$endDate}&id_page={$request->id_page}"; // Usa startDate para filtrar
        $response_mapa_country = Http::get($url_mapa_country);
        $dataMapCountry = $response_mapa_country->json();
        
        $dataCollection = collect($dataMapCountry['data']);
        
        // Formatea los datos para Highcharts
        $formattedDataMap = $dataCollection->map(function($item) {
            return [strtolower($item['country_name']), $item['fan_count']];
        });
        return response()->json($formattedDataMap);
    }
    
    public function filtrarDatosAge(Request $request){
        $endDate = $request->input('endDate');
        $url_impressions = "https://reportapi.infocenterlatam.com/api/userfacebookcountry/getlistage?date={$endDate}";
        $response_impressions = Http::get($url_impressions);
        $data_impressions = $response_impressions->json(); 
        $dataImpressions = $data_impressions['data'];
        // Agrupar por género y rango de edad
        $groupedData = [];
        foreach ($dataImpressions as $entry) {
            $ageGenderGroup = $entry['age_gender_group'];
            $impressionsCount = $entry['impressions_count'];
            if (!isset($groupedData[$ageGenderGroup])) {
                $groupedData[$ageGenderGroup] = 0;
            }
            // Sumar impresiones
            $groupedData[$ageGenderGroup] += $impressionsCount;
        }
        // Formatear para que Highcharts lo entienda como un array de objetos [{age_gender_group: 'M_18-24', impressions_count: 100}, ...]
        $formattedData = [];
        foreach ($groupedData as $ageGenderGroup => $impressionsCount) {
            $formattedData[] = [
                'age_gender_group' => $ageGenderGroup,
                'impressions_count' => $impressionsCount
            ];
        }
        return response()->json($formattedData);
    }
    
    public function filtrarDatosTime(Request $request){
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $url_times = "https://reportapi.infocenterlatam.com/api/fstadistic/getUsertimeOnline?start_date={$startDate}&end_date={$endDate}";
        $response_times = Http::get($url_times);
        $data_times = $response_times->json();
        $dataTimes = $data_times['data'];        
        $intervals = [
            '0:00 to 3:00'  => ['0:00', '1:00', '2:00'],
            '3:00 to 6:00'  => ['3:00', '4:00', '5:00'],
            '6:00 to 9:00'  => ['6:00', '7:00', '8:00'],
            '9:00 to 12:00' => ['9:00', '10:00', '11:00'],
            '12:00 to 15:00' => ['12:00', '13:00', '14:00'],
            '15:00 to 18:00' => ['15:00', '16:00', '17:00'],
            '18:00 to 21:00' => ['18:00', '19:00', '20:00'],
            '21:00 to 0:00' => ['21:00', '22:00', '23:00'],
        ];
        $groupedTime = [];
        foreach ($intervals as $interval => $times) {
            $totalFollowers = 0;
        
            foreach ($dataTimes as $entry) {
                if (in_array($entry['time'], $times)) {
                    $totalFollowers += $entry['count_followers'];
                }
            }
        
            $groupedTime[] = [
                'interval' => $interval,
                'total_followers' => $totalFollowers,
            ];
        }
        return response()->json($groupedTime);
    }

    public function updatereactions(Request $request){
        $fecha_inicio = $request->start_date;
        $fecha_fin = $request->end_date; 
        $url_total = 'https://reportapi.infocenterlatam.com/api/fstadistic/getStadisticCount';
        $headers = ['Content-Type' => 'application/json'];
        $body = '{
            "date_start" : "'.$fecha_inicio.'",
            "date_end" : "'.$fecha_fin.'",
            "id_page" : '.$request->idpage.'
        }';        
        $client = new Client();
        $response = $client->get($url_total, ['headers' => $headers,'body' => $body,]);
        $responseBody = json_decode($response->getBody()->getContents(),true);
        $datos_reactions = $responseBody['data'];
        $data_pie = ['labels' => ['Likes', 'Loves', 'Hahas','Wows','Sads','Angrys','Shares','Comments'],'values' => [$datos_reactions[0]['total_likes'],$datos_reactions[0]['total_loves'],$datos_reactions[0]['haha_count'],$datos_reactions[0]['wow_count'],$datos_reactions[0]['sad_count'],$datos_reactions[0]['angry_count'],$datos_reactions[0]['share_count'],$datos_reactions[0]['comments_count']]];
        

        //service followers
        $url_followers = 'https://reportapi.infocenterlatam.com/api/fstadistic/getstadisticFollowers';
        $headers_follow = ['Content-Type' => 'application/json'];
        $body_followers = '{
            "date_start" : "'.$fecha_inicio.'",
            "date_end" : "'.$fecha_fin.'",
            "id_page" : '.$request->idpage.'
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
        
        return response()->json([
            'datos_reactions' => $datos_reactions,
            'datos_follow' => $datos_follow,
            'newFollowersNumber' => $newFollowersNumber,
            'lostFollowersNumber' => $lostFollowersNumber,
            'data_pie' => $data_pie
        ]);
       
        
    }
    

    public function tablepost(Request $request) {
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
            $url = "https://reportapi.infocenterlatam.com/api/fstadistic/listPost?page=" . $page . "&per_page=" . $request->input('length') . "&sort_by=" . $sortBy . "&sort_direction=" . $sortDirection;
    
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
    

    public function informeescucha(Request $request){
        set_time_limit(300); // Establece el límite a 300 segundos si es necesario
        //dd($request->input('reaction_id'));
        $body = [
            'id_page' => $request->input('reaction_id')
        ];
        $url_informe = 'https://reportapi.infocenterlatam.com/api/fstadistic/topPost';
        $response_informe = Http::get($url_informe,$body);
        $data_informe = $response_informe->json();
        $postData = $data_informe['data'];
        $total_reacciones = $postData['like_count'] + $postData['love_count'] + $postData['haha_count'] + $postData['wow_count'] + $postData['sad_count'] + $postData['angry_count'];
       

        $imageUrl = $postData['full_picture'];
        if (empty($imageUrl)) {
            $imageUrl = 'https://scontent.flpb2-1.fna.fbcdn.net/v/t1.6435-9/121240003_204482091112281_7819078301545357074_n.png?_nc_cat=108&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=CXvrx_Ggy9gQ7kNvgE5UUId&_nc_ht=scontent.flpb2-1.fna&_nc_gid=AjAKxe6nnpw7sTRja1MkIxM&oh=00_AYCYP7KMw3zuz6ZjofUIzsv8GqJ0abHshNLJHxnCG5repg&oe=671BE143';
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
        
        
        $vista = view('informe_escucha',['postData'=>$postData,'imageSrc'=>$imageSrc,'total_reacciones'=>$total_reacciones,'src_inicio'=>$src_inicio,'src_escucha'=>$src_escucha,'src_gracias'=>$src_gracias]);
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

    public function informeescuchafecha(Request $request){
        set_time_limit(300); 
        $request->validate([
            //'start_date' => 'required|date|before:end_date',
            //'end_date' => 'required|date|after:start_date|before_or_equal:today',
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
            $url_total = 'https://reportapi.infocenterlatam.com/api/fstadistic/getReportListen?sort_direction=desc&order_by='.$request->reaccion_reporte;
        }else{
            $url_total = 'https://reportapi.infocenterlatam.com/api/fstadistic/getReportListen';
        }
        $headers = ['Content-Type' => 'application/json'];
        $body = '{
            "date_start" : "'.$fecha_inicio.'",
            "date_end" : "'.$fecha_fin.'",
            "id_page" : '.$request->input('date_listen_id').'
        }';        
        $client = new Client();
        $response = $client->post($url_total, ['headers' => $headers,'body' => $body,]);
        $responseBody = json_decode($response->getBody()->getContents(),true);
        $datos = $responseBody['data'] ?? null;
        //dd($datos);
        if(empty($datos)){
            Alert::error('No se encontraron Publicaciones en la fecha');
            return redirect('/reportes-facebook');
        }else{
            $total_reacciones = $datos['like_count'] + $datos['love_count'] + $datos['haha_count'] + $datos['wow_count'] + $datos['sad_count'] + $datos['angry_count'];
            $imageUrl = $datos['full_picture'];
            if (empty($imageUrl)) {
                $imageUrl = 'https://scontent.flpb2-1.fna.fbcdn.net/v/t1.6435-9/121240003_204482091112281_7819078301545357074_n.png?_nc_cat=108&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=CXvrx_Ggy9gQ7kNvgE5UUId&_nc_ht=scontent.flpb2-1.fna&_nc_gid=AjAKxe6nnpw7sTRja1MkIxM&oh=00_AYCYP7KMw3zuz6ZjofUIzsv8GqJ0abHshNLJHxnCG5repg&oe=671BE143';
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
           

            $vista = view('informe_escucha',['postData'=>$datos,'imageSrc'=>$imageSrc,'total_reacciones'=>$total_reacciones,'imageChartBase64'=>$imageChartBase64,'imageChartBarBase64'=>$imageChartBarBase64,'src_inicio'=>$src_inicio,'src_escucha'=>$src_escucha,'src_gracias'=>$src_gracias,'src_escucha_grafica'=>$src_escucha_grafica]);
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

    public function informefacebook(Request $request){
       
        set_time_limit(300); // Establece el límite a 300 segundos si es necesario
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
            "id_page" : '.$request->input('button_facebook').'
        }';        
        $client = new Client();
        $response = $client->post($url_total, ['headers' => $headers,'body' => $body,]);
        $responseBody = json_decode($response->getBody()->getContents(),true);
        $datos = $responseBody['data'];
        //dd($datos['TopPost'][0]['type_post']);
        if(empty($datos['TopPost'])){
            Alert::error('No se encontraron Publicaciones en la fecha');
            return redirect('/reportes-facebook');
        }else{
            $total_seguidores= $datos['follwers']['total_seguidores_ultimo'];
            $nuevos_seguidores = $datos['follwers']['total_nuevos_seguidores'];
            $unfollows = $datos['follwers']['total_seguidores_perdidos'];
            $sumatotalinteraccionespost1 = $datos['TopPost'][0]['comments_count'] + $datos['TopPost'][0]['share_count'] + $datos['TopPost'][0]['like_count'] + $datos['TopPost'][0]['love_count'] + $datos['TopPost'][0]['haha_count']+ $datos['TopPost'][0]['wow_count']+ $datos['TopPost'][0]['sad_count']+ $datos['TopPost'][0]['angry_count'];
            $sumatotalinteraccionespost2 = $datos['TopPost'][1]['comments_count'] + $datos['TopPost'][1]['share_count'] + $datos['TopPost'][1]['like_count'] + $datos['TopPost'][1]['love_count'] + $datos['TopPost'][1]['haha_count']+ $datos['TopPost'][1]['wow_count']+ $datos['TopPost'][1]['sad_count']+ $datos['TopPost'][1]['angry_count'];      
            $sumatotalinteraccionesCompartido = $datos['getMostSharedPost'][0]['comments_count'] + $datos['getMostSharedPost'][0]['share_count'] + $datos['getMostSharedPost'][0]['like_count'] + $datos['getMostSharedPost'][0]['love_count'] + $datos['getMostSharedPost'][0]['haha_count']+ $datos['getMostSharedPost'][0]['wow_count']+ $datos['getMostSharedPost'][0]['sad_count']+ $datos['getMostSharedPost'][0]['angry_count'];
            $sumatotalinteraccionesComentarios = $datos['getMostCommentsPost'][0]['comments_count'] + $datos['getMostCommentsPost'][0]['share_count'] + $datos['getMostCommentsPost'][0]['like_count'] + $datos['getMostCommentsPost'][0]['love_count'] + $datos['getMostCommentsPost'][0]['haha_count']+ $datos['getMostCommentsPost'][0]['wow_count']+ $datos['getMostCommentsPost'][0]['sad_count']+ $datos['getMostCommentsPost'][0]['angry_count'];
            
            $imageUrlCompartido = $datos['getMostSharedPost'][0]['full_picture'];
            if (empty($imageUrlCompartido)) {
                $imageUrlCompartido = 'https://scontent.flpb2-1.fna.fbcdn.net/v/t1.6435-9/121240003_204482091112281_7819078301545357074_n.png?_nc_cat=108&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=CXvrx_Ggy9gQ7kNvgE5UUId&_nc_ht=scontent.flpb2-1.fna&_nc_gid=AjAKxe6nnpw7sTRja1MkIxM&oh=00_AYCYP7KMw3zuz6ZjofUIzsv8GqJ0abHshNLJHxnCG5repg&oe=671BE143';
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
            
            $imageUrlComentario = $datos['getMostCommentsPost'][0]['full_picture'];
            if (empty($imageUrlComentario)) {
                $imageUrlComentario = 'https://scontent.flpb2-1.fna.fbcdn.net/v/t1.6435-9/121240003_204482091112281_7819078301545357074_n.png?_nc_cat=108&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=CXvrx_Ggy9gQ7kNvgE5UUId&_nc_ht=scontent.flpb2-1.fna&_nc_gid=AjAKxe6nnpw7sTRja1MkIxM&oh=00_AYCYP7KMw3zuz6ZjofUIzsv8GqJ0abHshNLJHxnCG5repg&oe=671BE143';
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


            $imageUrlMayorAlcance1 = $datos['TopPost'][0]['full_picture'];
            if (empty($imageUrlMayorAlcance1)) {
                $imageUrlMayorAlcance1 = 'https://scontent.flpb2-1.fna.fbcdn.net/v/t1.6435-9/121240003_204482091112281_7819078301545357074_n.png?_nc_cat=108&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=CXvrx_Ggy9gQ7kNvgE5UUId&_nc_ht=scontent.flpb2-1.fna&_nc_gid=AjAKxe6nnpw7sTRja1MkIxM&oh=00_AYCYP7KMw3zuz6ZjofUIzsv8GqJ0abHshNLJHxnCG5repg&oe=671BE143';
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
            $imageUrlMayorAlcance2 = $datos['TopPost'][1]['full_picture'];
            if (empty($imageUrlMayorAlcance2)){
                $imageUrlMayorAlcance2 = 'https://scontent.flpb2-1.fna.fbcdn.net/v/t1.6435-9/121240003_204482091112281_7819078301545357074_n.png?_nc_cat=108&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=CXvrx_Ggy9gQ7kNvgE5UUId&_nc_ht=scontent.flpb2-1.fna&_nc_gid=AjAKxe6nnpw7sTRja1MkIxM&oh=00_AYCYP7KMw3zuz6ZjofUIzsv8GqJ0abHshNLJHxnCG5repg&oe=671BE143';
                $responseMayorAlcance2 = Http::get($imageUrlMayorAlcance2);
                $imageContentsMayorAlcance2 = $responseMayorAlcance2->body();
                $imageBase64MayorAlcance2 = base64_encode($imageContentsMayorAlcance2);
                $imageSrcMayorAlcance2 = 'data:' . $responseMayorAlcance2->header('Content-Type') . ';base64,' . $imageBase64MayorAlcance2;
            }else{
                /*$responseMayorAlcance2 = Http::get($imageUrlMayorAlcance2);
                $imageContentsMayorAlcance2 = $responseMayorAlcance2->body();
                $imageBase64MayorAlcance2 = base64_encode($imageContentsMayorAlcance2);*/
                $imageSrcMayorAlcance2 = $imageUrlMayorAlcance2;
            }
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
            $dailyResults = $responseBody['data']['follwers']['daily_results'];
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
            $chartUrlSeguidores = 'https://quickchart.io/chart?c=' . urlencode(json_encode($chartDataSeguidores));
            /**Fin Grafico 2 de tendencia */
            
            //Imagenes de Facebook
            $inicio = public_path() . '/img/facebook_1.jpg';
            $imageInicio = base64_encode(file_get_contents($inicio));
            $src_inicio = 'data:' . mime_content_type($inicio) . ';base64,' . $imageInicio;
            
            $facebook = public_path() . '/img/facebook_2.jpg';
            $imagefacebook = base64_encode(file_get_contents($facebook));
            $src_facebook = 'data:' . mime_content_type($facebook) . ';base64,' . $imagefacebook;
            
            $overview = public_path() . '/img/facebook_3.jpg';
            $imageoverview = base64_encode(file_get_contents($overview));
            $src_overview = 'data:' . mime_content_type($overview) . ';base64,' . $imageoverview;

            
            $interaccion_facebook = public_path() . '/img/facebook_4.jpg';
            $imaginteraccion_facebook = base64_encode(file_get_contents($interaccion_facebook));
            $src_interaccion_facebook = 'data:' . mime_content_type($interaccion_facebook) . ';base64,' . $imaginteraccion_facebook;
            
            $resultado_facebook = public_path() . '/img/facebook_5.jpg';
            $imageresultado_facebook = base64_encode(file_get_contents($resultado_facebook));
            $src_resultado_facebook = 'data:' . mime_content_type($resultado_facebook) . ';base64,' . $imageresultado_facebook;
            
            $mayoralcance_facebook = public_path() . '/img/facebook_7.jpg';
            $imagemayoralcance = base64_encode(file_get_contents($mayoralcance_facebook));
            $src_mayoralcance = 'data:' . mime_content_type($mayoralcance_facebook) . ';base64,' . $imagemayoralcance;
            
            $compartido_facebook = public_path() . '/img/facebook_8.jpg';
            $imagecompartido = base64_encode(file_get_contents($compartido_facebook));
            $src_compartido = 'data:' . mime_content_type($compartido_facebook) . ';base64,' . $imagecompartido;
            
            $comentado_facebook = public_path() . '/img/facebook_9.jpg';
            $imagecomentado_facebook = base64_encode(file_get_contents($comentado_facebook));
            $src_comentado_facebook = 'data:' . mime_content_type($comentado_facebook) . ';base64,' . $imagecomentado_facebook;

            $impressions_facebook = public_path() . '/img/facebook_11.jpg';
            $imageimpressions_facebook = base64_encode(file_get_contents($impressions_facebook));
            $src_impressions = 'data:' . mime_content_type($impressions_facebook) . ';base64,' . $imageimpressions_facebook;

            
            $gracias = public_path() . '/img/facebook_10.jpg';
            $imagegracias = base64_encode(file_get_contents($gracias));
            $src_gracias = 'data:' . mime_content_type($gracias) . ';base64,' . $imagegracias;
            
            //Fin Imagenes de Faceboo
            $vista = view('informe_facebook', [
                'src_inicio' => $src_inicio,
                'src_facebook' => $src_facebook,
                'src_overview' => $src_overview,
                'src_resultado_facebook' => $src_resultado_facebook,
                'src_mayoralcance' => $src_mayoralcance, 
                'src_compartido' => $src_compartido,
                'src_comentado_facebook' => $src_comentado_facebook,
                'src_interaccion_facebook' => $src_interaccion_facebook,
                'src_impressions' => $src_impressions,
                'src_gracias' => $src_gracias,
                'datos'=>$datos,
                'chartUrl'=>$chartUrl,
                'totalReactionsSum'=>$totalReactionsSum,
                'chartUrlSeguidores'=>$chartUrlSeguidores,
                'fecha_inicio' => $fecha_inicio, 
                'fecha_fin' => $fecha_fin,
                'total_seguidores' => $total_seguidores ,
                'nuevos_seguidores' => $nuevos_seguidores,
                'unfollows' => $unfollows,
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
            $dompdf->setPaper(array(0, 0, 980, 1300), 'Landscape'); // 8.5 x 13 pulgadas
            //$dompdf->set_option('isPhpEnabled', true);
            $dompdf->render();
            $dompdf->stream('',array("Attachment" => false));
        }
    }

    public function recuperaridgrafica(Request $request){

        $url_total = 'https://reportapi.infocenterlatam.com/api/fstadistic/showPost';
        $headers = ['Content-Type' => 'application/json'];
        if($request->secondValue == 1){
            $body = '{
                "id": '.$request->id.',
                "id_page": 104864678120869
            }'; 
        }else{
            $body = '{
                "id": '.$request->id.',
                "id_page": 102674511293040
            }'; 
        }
               
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
            if (empty($imageUrl)) {
                $imageUrl = 'https://scontent.flpb2-1.fna.fbcdn.net/v/t1.6435-9/121240003_204482091112281_7819078301545357074_n.png?_nc_cat=108&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=CXvrx_Ggy9gQ7kNvgE5UUId&_nc_ht=scontent.flpb2-1.fna&_nc_gid=AjAKxe6nnpw7sTRja1MkIxM&oh=00_AYCYP7KMw3zuz6ZjofUIzsv8GqJ0abHshNLJHxnCG5repg&oe=671BE143';
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
           


            $vista = view('informe_escucha',['postData'=>$postData,'imageSrc'=>$imageSrc,'total_reacciones'=>$total_reacciones,'src_inicio'=>$src_inicio,'src_escucha'=>$src_escucha,'src_gracias'=>$src_gracias]);
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


    public function getChartData(Request $request){    
        $url_tendecia = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsReactions';
        $headers_total = ['Content-Type' => 'application/json'];
        $body = '{
            "id_page" : '.$request->idpage.'
        }'; 
        $client = new Client();
        $response = $client->get($url_tendecia, ['headers' => $headers_total,'body' => $body,]);
        $responseBody_total = json_decode($response->getBody()->getContents(),true);
        $datostendencia = $responseBody_total['data'];
        //dd($datostendencia);
        $trendData = [
            'dates' => [],
            'likes' => [],
            'loves' => [],
            'hahas' => [],
            'wows' => [],
            'sads' => [],
            'angries' => [],
            'clicks' => [],
            'impressions' => []
        ];
        //dd($trendData);
        foreach ($datostendencia as $datatendencia) {
            $trendData['dates'][] = $datatendencia['date'];
            $trendData['likes'][] = (int)$datatendencia['likes'];
            $trendData['loves'][] = (int)$datatendencia['loves'];
            $trendData['hahas'][] = (int)$datatendencia['hahas'];
            $trendData['wows'][] = (int)$datatendencia['wows'];
            $trendData['sads'][] = (int)$datatendencia['sads'];
            $trendData['angries'][] = (int)$datatendencia['angrys'];
            $trendData['clicks'][] = (int)$datatendencia['clicks'];
            $trendData['impressions'][] = (int)$datatendencia['impressions'];
        }

        $trendDataJson = json_encode($trendData);
        $datosformateadosTrend = json_decode($trendDataJson, true);


        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Filtrar los datos según el rango de fechas
        $filteredData = $this->filterDataByDateRange($datosformateadosTrend, $startDate, $endDate);
        //dd($filteredData);
        return response()->json($filteredData);
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
            "date_end" : "'.$fecha_fin.'"
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
            'angries' => array_values(array_intersect_key($data['angries'], array_flip($filteredIndices))),
            'clicks' => array_values(array_intersect_key($data['clicks'], array_flip($filteredIndices))),
            'impressions' => array_values(array_intersect_key($data['impressions'], array_flip($filteredIndices)))
        ]; 
    }

    public function getTopPosts(Request $request){
        $limit = $request->input('limit', 15);
        $limit = in_array($limit, [15, 20, 30]) ? $limit : 15;

        // Obtener las fechas de inicio y fin, si se proporcionan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $body = [
            'id_page' => $request->idpage
        ];
        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
        $response = Http::get($url_top,$body);
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
                'impressions_count' => $item['impressions']
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
        $body = [
            'id_page' => $request->idpage
        ];
        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
        $response = Http::get($url_top,$body);
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
                'impressions_count' => $item['impressions']
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
        $body = [
            'id_page' => $request->idpage
        ];
        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
        $response = Http::get($url_top,$body);
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
                'impressions_count' => $item['impressions']
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
        $body = [
            'id_page' => $request->idpage
        ];
        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
        $response = Http::get($url_top,$body);
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
                'impressions_count' => $item['impressions']
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
        $body = [
            'id_page' => $request->idpage
        ];
        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
        $response = Http::get($url_top,$body);
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
                'impressions_count' => $item['impressions']
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
        $body = [
            'id_page' => $request->idpage
        ];
        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
        $response = Http::get($url_top,$body);
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
                'impressions_count' => $item['impressions']
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
        $body = [
            'id_page' => $request->idpage
        ];
        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
        $response = Http::get($url_top,$body);
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
                'impressions_count' => $item['impressions']
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
        $body = [
            'id_page' => $request->idpage
        ];
        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
        $response = Http::get($url_top,$body);
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
                'impressions_count' => $item['impressions']
            ];
        })->values();
        return response()->json($posts);
    }

    public function getAllpostwithImpresions(Request $request){
        $limit = $request->input('limit', 15);
        $limit = in_array($limit, [15, 20, 30]) ? $limit : 15;
        // Obtener las fechas de inicio y fin, si se proporcionan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $body = [
            'id_page' => $request->idpage
        ];
        // Construir la consulta
        $url_top = 'https://reportapi.infocenterlatam.com/api/fstadistic/getPostsList';
        $response = Http::get($url_top,$body);
        $data = $response->json();
        if (!isset($data['data'])) {
            return response()->json(['error' => 'No data found'], 404);
        }
        // Convertir los datos en una colección de Laravel
        $query = collect($data['data']);
        //dd($query);
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
        $query = $query->sortByDesc('impressions')->take($limit);
        $posts = $query->map(function ($item) {
            //dd($item);
            return (object)[
                'story' => $item['story'],
                'created_time' => $item['date'],
                'comments_count' => $item['comments'],
                'likes_count'=> $item['likes'],
                'loves_count'=> $item['loves'],
                'hahas_count'=> $item['hahas'],
                'wows_count'=> $item['wows'],
                'sads_count'=> $item['sads'],
                'angries_count'=> $item['angrys'],
                'shares_count'=> $item['shares'],
                'clicks_count'=> $item['clicks'],
                'impressions_count' => $item['impressions']
            ];
        })->values(); 
        return response()->json($posts);
    }
    public function cargarfacebookinforme(Request $request){
        $url_cuentas = 'https://reportapi.infocenterlatam.com/api/me/getListFacebook';
        $responsecuentas = Http::get($url_cuentas);
        $datacuentas = $responsecuentas['data'];
        return view('reportesfacebook', compact('datacuentas'));           
   
    }

    public function runAnalysis(Request $request){
        set_time_limit(300); // Establece el límite a 300 segundos si es necesario

        // Obtener las fechas de inicio y fin desde la solicitud HTTP
        $date_start = $request->input('start_date_python');
        $date_end = $request->input('end_date_python');
        //dd($date_start);
        // Verificar que las fechas no están vacías
        if(empty($date_start) || empty($date_end)) {
            return response()->json([
                'error' => 'Las fechas de inicio y fin son obligatorias.'
            ], 400);
        }
    
        // Ruta completa al script de Python (SIN duplicar rutas)
        $pythonScriptPath = 'C:\\Users\\DADI-\\Downloads\\proyecto_dashboard_completo1.py';
    
        // Construir el comando para ejecutar el script con los parámetros
        $command = escapeshellcmd("python " . escapeshellarg($pythonScriptPath) . " --date_start " . escapeshellarg($date_start) . " --date_end " . escapeshellarg($date_end));
    
        // Ejecutar el comando y capturar la salida
        $output = shell_exec($command . " 2>&1"); // Captura tanto la salida como los errores
    
        // Devuelve la salida en la respuesta JSON
        return response()->json([
            'output' => $output
        ]);

        // Ruta del archivo Python
        /*$pythonScriptPath = "C:\\Users\\DADI-\\Downloads\\hola_mundo.py";
        // Comando para ejecutar el archivo Python
        $command = escapeshellcmd("python " . $pythonScriptPath);
        // Ejecutar el comando
        putenv('PATH=' . getenv('PATH') . ':/path/to/python');
        $command = escapeshellcmd("/path/to/python " . $pythonScriptPath . " 2>&1");
        $output = shell_exec($command);
        dd($output);
        // Mostrar el resultado en la vista o redirigir con un mensaje
        return view('resultado_python', ['output' => $output]);*/
    }
}
