<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstagramController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Importar el facade Auth

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar rutas web para tu aplicación. Estas
| rutas son cargadas por el RouteServiceProvider y todas estarán
| asignadas al grupo "web" de middleware. ¡Haz algo genial!
|
*/

/*Route::get('/', function () {
    return view('auth.login');
});*/
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    } else {
        return view('auth.login');
    }
});

Route::get('/datatable', function(){
    return view('tabla');
});

// Rutas de autenticación
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Rutas de las páginas
    Route::get('icons', [PageController::class, 'icons'])->name('pages.icons');
    Route::get('maps', [PageController::class, 'maps'])->name('pages.maps');
    Route::get('notifications', [PageController::class, 'notifications'])->name('pages.notifications');
    Route::get('rtl', [PageController::class, 'rtl'])->name('pages.rtl');
    Route::get('tables', [PageController::class, 'tables'])->name('pages.tables');
    Route::get('typography', [PageController::class, 'typography'])->name('pages.typography');
    Route::get('upgrade', [PageController::class, 'upgrade'])->name('pages.upgrade');

    // Rutas relacionadas con el usuario y perfil
    Route::resource('user', UserController::class)->except(['show']);
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'password'])->name('profile.password');

    // Rutas relacionadas con informes y gráficos facebook 
    Route::post('/informe_escucha', [HomeController::class, 'informeescucha'])->name('informe_escucha');
    Route::post('/recuperar_id_grafica', [HomeController::class, 'recuperaridgrafica'])->name('recuperar_id_grafica');
    Route::post('/recuperar_id_informe', [HomeController::class, 'informeescuchaid'])->name('informe_id_escucha');
    Route::post('/informe_facebook', [HomeController::class, 'informefacebook'])->name('informe_actualizado');
    Route::get('/tabla-post', [HomeController::class, 'tablepost'])->name('tablepost');
    Route::get('/reportes-facebook', [HomeController::class, 'cargarfacebookinforme'])->name('reportes_facebook');
    Route::post('/informe_escucha_fechas', [HomeController::class, 'informeescuchafecha'])->name('iforme_escucha_fecha');

    // Rutas de AJAX para gráficos facebook
    Route::get('/get-chart-data', [HomeController::class, 'getChartData']);
    Route::get('/get-chart-follows',[HomeController::class,'getChartFollows']);
    Route::get('/api/facebook-posts', [HomeController::class, 'getTopPosts']);
    Route::get('/api/facebook-likes', [HomeController::class, 'getTopLike']);
    Route::get('/api/facebook-loves', [HomeController::class, 'getTopLove']);
    Route::get('/api/facebook-haha', [HomeController::class, 'getTopHaha']);
    Route::get('/api/facebook-wow', [HomeController::class, 'getTopWow']);
    Route::get('/api/facebook-sad', [HomeController::class, 'getTopSad']);
    Route::get('/api/facebook-angry', [HomeController::class, 'getTopAngry']);
    Route::get('/api/facebook-share', [HomeController::class, 'getTopShare']);
    Route::get('/api/facebook-all', [HomeController::class, 'getAllpostwithImpresions']);
    Route::get('/api/facebook-update',[HomeController::class,'updatereactions']);
    //rutas relacionada con informes y graficos de Instagram
    Route::get('/graficos-instagram',[InstagramController::class,'index'])->name('graficos_instagram');
    Route::get('/tabla-post-instagram', [InstagramController::class, 'tablepost'])->name('tablepostinstagram');

});
