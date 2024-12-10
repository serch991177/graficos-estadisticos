<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use RealRashid\SweetAlert\Facades\Alert;
use phpseclib3\Net\SSH2;
use Emojione\Emojione;

class TiktokController extends Controller
{
    public function index(){
        set_time_limit(300); 
        //consumo de servicio para recuperar datos de cuenta
        $urltiktokaccount= "https://reportapi.infocenterlatam.com/api/tiktok/listAccounts";
        $responsecuentas = Http::get($urltiktokaccount);
        $datacuentas = $responsecuentas['data'];
        //fin consumo de servicio para recuperar datos de cuenta
        $heads = [
            '<i class="fas fa-id-badge"></i>',
            '<i class="fas fa-file-alt"></i>',
            '<i class="fas fa-image"></i>',
            '<i class="fas fa-link"></i>',
            '<i class="fas fa-calendar-alt"></i>',
            '<i class="fas fa-comments" style="color: #77DD77;"></i>',
            '<i class="fas fa-eye" style="color: #E91E63;"></i>',
            '<i class="fas fa-share" style="color: #03A9F4;"></i>',
            '<i class="fas fa-heart" style="color: #E91E63;"></i>',
            '<i class="fas fa-cog"></i>'
        ];
        return view("dashboard_tiktok",compact('datacuentas','heads'));
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
            $url = "https://reportapi.infocenterlatam.com/api/tiktok/listPost?page=" . $page . "&per_page=" . $request->input('length') . "&sort_by=" . $sortBy . "&sort_direction=" . $sortDirection;
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


}
