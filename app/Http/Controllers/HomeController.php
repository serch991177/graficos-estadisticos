<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use League\ISO3166\ISO3166;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
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
        // Ejecuta las consultas SQL
        $totalLikes = DB::table('facebook_posts')->sum('like_count');
        $totalLoves = DB::table('facebook_posts')->sum('love_count');
        $totalHahas = DB::table('facebook_posts')->sum('haha_count');
        $totalWows = DB::table('facebook_posts')->sum('wow_count');
        $totalSads = DB::table('facebook_posts')->sum('sad_count');
        $totalAngries = DB::table('facebook_posts')->sum('angry_count');
        $totalShares = DB::table('facebook_posts')->sum('share_count');
        $totalComments = DB::table('facebook_posts')->sum('comments_count');        
        $data = ['labels' => ['Likes', 'Loves', 'Hahas','Wows','Sads','Angrys','Shares','Comments'],'values' => [$totalLikes,$totalLoves,$totalHahas,$totalWows,$totalSads,$totalAngries,$totalShares,$totalComments]];
        $datostabla = DB::select('SELECT id, story, full_picture, permalink_url, created_time, comments_count, like_count, love_count, haha_count, wow_count, sad_count, angry_count, share_count FROM facebook_posts'); 
        // Realiza la consulta a la base de datos
        $dataMap = DB::table('facebook_page_fans_country')->select('country_name', 'fan_count')->get();
        // Formatea los datos para Highcharts
        $formattedDataMap = $dataMap->map(function($item) {return [strtolower($item->country_name), $item->fan_count];});
        // Convierte a JSON para ser utilizado en JavaScript
        $jsonDataMap = json_encode($formattedDataMap);
        //consulta para sacar el top 10
        $iso3166 = new ISO3166();
        $topcountries = DB::select('SELECT country_name, fan_count, lat, lng FROM facebook_page_fans_country ORDER BY fan_count DESC LIMIT 10');
        // Map country codes to names
        foreach ($topcountries as $topcountry) {
            $countryCode = strtoupper($topcountry->country_name);
            try {
                $countryData = $iso3166->alpha2($countryCode);
                $topcountry->country_name = $countryData['name'];
            } catch (\Exception $e) {
                // In case of an invalid country code, keep the original code
                $topcountry->country_name = $topcountry->country_name;
            }
        }
        //Datos de la ciudades
        $dataCities= DB::select('SELECT city_name,fan_count  FROM facebook_page_fans_city ORDER BY fan_count DESC LIMIT 5');
        // Estructurar los datos según el formato proporcionado
        $citiesData = [];
        foreach ($dataCities as $city) {
            $citiesData[] = [
                'name' => $city->city_name,
                'data' => [(int)$city->fan_count] // Convertir a entero para asegurarse de que Highcharts maneje los datos correctamente
            ];
        }
        $dataCities2= DB::select('SELECT city_name,fan_count  FROM facebook_page_fans_city ORDER BY fan_count DESC');

        $dataImpressions = DB::select('SELECT fpiagu.age_gender_group, SUM(fpiagu.impressions_count) AS impressions_count FROM facebook_page_impressions_age_gender_unique fpiagu GROUP BY fpiagu.age_gender_group');
        
        // Pasa los datos a la vista
        return view('dashboard', compact('totalLikes', 'totalLoves', 'totalHahas', 'totalWows', 'totalSads', 'totalAngries', 'totalShares', 'totalComments',
        'data','datostabla','dataMap','jsonDataMap','topcountries','citiesData','dataCities2','dataImpressions'));           
    }

    public function informeescucha(){
        $informe_escucha = 'SELECT fp.created_time, fp.story, fp.full_picture,fp.comments_count, fp.share_count,fpc.message, fpc.permalink_url ,fpc.comment_count,(fp.like_count + fp.love_count + fp.haha_count + fp.wow_count + fp.sad_count + fp.angry_count + fp.share_count) AS total_reacciones,ARRAY(SELECT CONCAT(reaction, \' \', count)FROM (VALUES (\'Likes\', fp.like_count), (\'Loves\', fp.love_count), (\'Hahas\', fp.haha_count), (\'Wows\', fp.wow_count), (\'Sads\', fp.sad_count), (\'Angries\', fp.angry_count) ) AS r(reaction, count)ORDER BY count DESC LIMIT 4) AS top_reactions FROM  facebook_posts fp INNER JOIN facebook_post_comments fpc ON fpc.post_id = fp.id WHERE fpc.comment_count = (SELECT MAX(comment_count) FROM facebook_post_comments WHERE post_id = fp.id) ORDER BY  fp.comments_count DESC LIMIT 1;';
        $postData = DB::select($informe_escucha);
        $url = 'https://scontent.flpb3-2.fna.fbcdn.net/v/t1.6435-9/154496389_158241429449860_9063786801458211452_n.jpg?stp=dst-jpg_p720x720&_nc_cat=100&ccb=1-7&_nc_sid=833d8c&_nc_ohc=jzmwYFCVAeMQ7kNvgGAHS-w&_nc_ht=scontent.flpb3-2.fna&edm=AKIiGfEEAAAA&oh=00_AYAbDjsl5hyObR_z0nYGVxIOObFIwEdRkn168rYT9GTgqA&oe=66B93B18';
        //$postData[0]->full_picture
        $imageUrl = $postData[0]->full_picture;
        $response = Http::get($imageUrl);
        $imageContents = $response->body();
        $imageBase64 = base64_encode($imageContents);
        $imageSrc = 'data:' . $response->header('Content-Type') . ';base64,' . $imageBase64;
        
        
        $vista = view('informe_escucha',['postData'=>$postData,'imageSrc'=>$imageSrc]);
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
    public function recuperaridgrafica(Request $request){
        $totalLikes = DB::table('facebook_posts')->where('id', $request->id)->sum('like_count');
        $totalLoves = DB::table('facebook_posts')->where('id', $request->id)->sum('love_count');
        $totalHahas = DB::table('facebook_posts')->where('id', $request->id)->sum('haha_count');
        $totalWows = DB::table('facebook_posts')->where('id', $request->id)->sum('wow_count');
        $totalSads = DB::table('facebook_posts')->where('id', $request->id)->sum('sad_count');
        $totalAngries = DB::table('facebook_posts')->where('id', $request->id)->sum('angry_count');
        $totalShares = DB::table('facebook_posts')->where('id', $request->id)->sum('share_count');
        $totalComments = DB::table('facebook_posts')->where('id', $request->id)->sum('comments_count');
        $dibujar_torta = ['labels' => ['Likes', 'Loves', 'Hahas','Wows','Sads','Angrys','Shares','Comments'],'values' => [$totalLikes,$totalLoves,$totalHahas,$totalWows,$totalSads,$totalAngries,$totalShares,$totalComments]];
        return response()->json(['dibujar_torta'=>$dibujar_torta]);    
    }
    public function informeescuchaid(Request $request){
        $informe_escucha = 'SELECT fp.created_time, fp.story, fp.full_picture, fp.comments_count, fp.share_count, fpc.message, fpc.permalink_url, fpc.comment_count,(fp.like_count + fp.love_count + fp.haha_count + fp.wow_count + fp.sad_count + fp.angry_count + fp.share_count) AS total_reacciones,ARRAY( SELECT CONCAT(reaction, \' \', count)FROM (VALUES (\'Likes\', fp.like_count),(\'Loves\', fp.love_count),(\'Hahas\', fp.haha_count),(\'Wows\', fp.wow_count),(\'Sads\', fp.sad_count),(\'Angries\', fp.angry_count)) AS r(reaction, count) ORDER BY count DESC LIMIT 4) AS top_reactions FROM facebook_posts fp INNER JOIN facebook_post_comments fpc ON fpc.post_id = fp.id WHERE fpc.comment_count = (SELECT MAX(comment_count) FROM facebook_post_comments WHERE post_id = fp.id) AND fp.id = ' . intval($request->id) . ' ORDER BY fp.comments_count DESC LIMIT 1;';
        $postData = DB::select($informe_escucha);
        if(empty($postData)){
            echo "No hay comentarios disponibles."; 
        }else{
            // dd($postData[0]->full_picture);
            $imageUrl = $postData[0]->full_picture;
            $response = Http::get($imageUrl);
            $imageContents = $response->body();
            $imageBase64 = base64_encode($imageContents);
            $imageSrc = 'data:' . $response->header('Content-Type') . ';base64,' . $imageBase64;
            
            $vista = view('informe_escucha',['postData'=>$postData,'imageSrc'=>$imageSrc]);
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
}
