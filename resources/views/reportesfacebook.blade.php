@extends('layouts.app', ['pageSlug' => 'reportes_facebook'])
@section('content')
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

    <link href="https://unpkg.com/ionicons@2.0.1/css/ionicons.min.css" rel="stylesheet">
    <style>
        .mobile-wrap {
            margin: auto;
            width: auto;
            height: 534px;
            overflow: hidden;
            position: relative;
            background: url(https://raw.githubusercontent.com/khadkamhn/secret-project/master/img/background.jpg) center no-repeat;
            box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19)
        }
        .mobile-wrap:before {
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            content: '';
            position: absolute;
            background: rgba(90, 93, 165, .8);
            background: linear-gradient(to bottom, rgba(90, 93, 165, 1), rgba(0, 0, 0, .7))
        }
        .mobile {
            z-index: 99;
            color: #fff;
            height: 100%;
            padding: 15px;
            position: relative
        }
        .mobile .header {
            clear: both;
            overflow: hidden;
            padding-top: 15px;
            position:relative
        }
        .mobile .header>span {
            font-size: 24px;
            min-width: 24px
        }
        .mobile .header>.title {
            font-size: 16px;
            line-height: 24px;
            margin-left: 15px
        }
        .mobile .header .pull-left {
            float: left
        }
        .mobile .header .pull-right {
            float: right
        }
        .mobile .header .ion-ios-search{
            z-index:999;
            position:relative;
        }
        .mobile .header .ion-ios-arrow-back {
            min-width: 25px
        }
        .mobile .header .ion-ios-navicon>i {
            height: 1px;
            width: 20px;
            margin-top: 5px;
            background: #fff;
            position: relative;
            display: inline-block
        }
        .mobile .header .ion-ios-navicon>i:after,
        .mobile .header .ion-ios-navicon>i:before {
            content: '';
            width: inherit;
            height: inherit;
            position: absolute;
            background: inherit
        }
        .mobile .header .ion-ios-navicon>i:before {
            bottom: 12px
        }
        .mobile .header .ion-ios-navicon>i:after {
            bottom: 6px
        }
        .mobile .header .search{
            right:0;
            bottom:0;
            position:absolute;
        }
        .mobile .header .search input{
            width:0;
            color:#fff;
            height:24px;
            border:none;
            font-size:16px;
            max-width:150px;
            font-weight:300;
            padding-right:30px;
            font-family:inherit;
            background:transparent;
            transition:all .3s ease-in-out 0s;
            border-bottom:1px solid transparent;
            -webkit-appearance:textfield;
        }
        .mobile .header .search input:focus{
            outline:none;
        }
        .mobile .header .search input::-webkit-search-decoration,
        .mobile .header .search input::-webkit-search-cancel-button {
            -webkit-appearance:none;
        }
        .mobile .header .search .search-visible{
            width:100%;
            border-bottom-color:#aaa;
        }
        .nav_form {
            right: 15px;
            z-index: 20;
            width: 45px;
            bottom: 15px;
            height: 45px;
            display: block;
            position: absolute;
            line-height: 45px;
            border-radius: 50%;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, .75)
        }
        .mask {
            z-index: 21;
            color: #fff;
            width: inherit;
            height: inherit;
            cursor: pointer;
            font-size: 28px;
            text-align: center;
            border-radius: 50%;
            position: absolute;
            background: #f23363;
            transition: all .1s ease-in-out 0s
        }
        .nav_form.active .mask {
            background: #cf0e3f;
            transform: rotate(-135deg)
        }
        .nav_form:after {
            top: 0;
            left: 0;
            content: '';
            width: inherit;
            height: inherit;
            border-radius: 50%;
            position: absolute;
            background: #f23363;
            transition: all .1s ease-in-out 0s
        }
        .nav_form.active:after {
            top: -125px;
            left: -125px;
            width: 350px;
            height: 350px
        }
        .nav-item-form {
            top: 0;
            left: 0;
            z-index: 19;
            width: 45px;
            height: 45px;
            color: #fff;
            font-size: 24px;
            transform: none;
            line-height: 45px;
            border-radius: 50%;
            position: absolute;
            text-align: center;
            transition: all .3s cubic-bezier(.68, 1.55, .265, 1)
        }
        .nav_form.active .nav-count-1 {
            transform: translate(10px, -100px)
        }
        .nav_form.active .nav-count-2 {
            transform: translate(-35px, -80px)
        }
        .nav_form.active .nav-count-3 {
            transform: translate(-80px, -45px)
        }
        .nav_form.active .nav-count-4 {
            transform: translate(-100px, 0)
        }
        .pull-left {
            float: left
        }
        .pull-right {
            float: right
        }
        .html,
        .invisible {
            display: none
        }
        .html.visible,
        .visible {
            display: block
        }
        .btn {
            color: #eee;
            width: 100%;
            border: none;
            font-size: 16px;
            padding: 12px 24px;
            background: #cf0e3f;
            border-radius: 30px
        }
        .welcome .datetime .date,
        .welcome .datetime .day {
            margin-bottom: 15px
        }
        .welcome .datetime .day {
            font-size: 28px;
            -webkit-animation-duration: .2s;
            animation-duration: .2s
        }
        .welcome .datetime .date {
            -webkit-animation-duration: .35s;
            animation-duration: .35s
        }
        .forecast {
            margin-top: 30px
        }
        .forecast .temperature {
            text-align: right
        }
        .forecast .datetime .day,
        .forecast .temperature .unit {
            font-size: 28px;
            min-height: 33px
        }
        .forecast .datetime .date,
        .forecast .temperature .location {
            color: #ccc;
            font-size: 12px
        }
        .forecast .temperature .unit>i {
            top: -2px;
            font-style: normal;
            position: relative
        }
        .forecast .animated {
            -webkit-animation-duration: .2s;
            animation-duration: .2s
        }
        .instagram .forms .group {
            margin-bottom: 15px
        }
        .instagram .forms .group>label {
            padding: 6px 0;
            min-width: 40px;
            display: inline-block
        }
        .instagram .forms .group>label>span {
            min-width: 20px;
            display: inline-block
        }
        .instagram .forms .group input,
        .instagram .forms .group textarea {
            color: #fff;
            border: none;
            resize: none;
            min-width: 185px;
            background: 0 0;
            padding: 5px 10px 1px;
            border-bottom: 1px solid rgba(170, 170, 170, .6)
        }
        .instagram .forms .visible {
            width: 100%;
            display: block!important
        }
        .instagram .forms .action {
            margin-top: 50px
        }
        .instagram .forms .group:nth-child(1) {
            -webkit-animation-duration: .1s;
            animation-duration: .1s
        }
        .instagram .forms .group:nth-child(2) {
            -webkit-animation-duration: .2s;
            animation-duration: .2s
        }
        .instagram .forms .group:nth-child(3) {
            -webkit-animation-duration: .3s;
            animation-duration: .3s
        }
        .instagram .forms .group:nth-child(4) {
            -webkit-animation-duration: .4s;
            animation-duration: .4s
        }
        /**escucha fechas */
        .info_escucha_fechas .forms .group {
            margin-bottom: 15px
        }
        .info_escucha_fechas .forms .group>label {
            padding: 6px 0;
            min-width: 40px;
            display: inline-block
        }
        .info_escucha_fechas .forms .group>label>span {
            min-width: 20px;
            display: inline-block
        }
        .info_escucha_fechas .forms .group input,
        .info_escucha_fechas .forms .group textarea {
            color: #fff;
            border: none;
            resize: none;
            min-width: 185px;
            background: 0 0;
            padding: 5px 10px 1px;
            border-bottom: 1px solid rgba(170, 170, 170, .6)
        }
        .info_escucha_fechas .forms .visible {
            width: 100%;
            display: block!important
        }
        .info_escucha_fechas .forms .action {
            margin-top: 50px
        }
        .info_escucha_fechas .forms .group:nth-child(1) {
            -webkit-animation-duration: .1s;
            animation-duration: .1s
        }
        .info_escucha_fechas .forms .group:nth-child(2) {
            -webkit-animation-duration: .2s;
            animation-duration: .2s
        }
        .info_escucha_fechas .forms .group:nth-child(3) {
            -webkit-animation-duration: .3s;
            animation-duration: .3s
        }
        .info_escucha_fechas .forms .group:nth-child(4) {
            -webkit-animation-duration: .4s;
            animation-duration: .4s
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <select name="cuentaSelect" id="cuentaSelect" class="form-control">
                    <option value="">Elija Una Cuenta</option>
                    @foreach ( $datacuentas as $datacuenta)
                        <option value="{{$datacuenta['account_id'] }}">{{$datacuenta['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <br>
    <div class="mobile-wrap">
        <div class="mobile clearfix">
            <div class="content">
                <div class="html welcome visible">
                    <div class="datetime">
                        <div class="day lightSpeedIn animated">Thursday</div>
                        <div class="date lightSpeedIn animated">June 18, 2015</div>
                        <div class="time lightSpeedIn animated">08:00 AM</div>
                    </div>
                </div>
                <div class="html instagram">
                    <div class="forms">
                        <form id="form_instagram" action="{{route('informe_actualizado')}}" method="post" target="_blank">
                            @csrf
                            <h1 class="text-center" style="color:#fff;">Generacion de informe de facebook</h1>
                            <div class="group clearfix slideInRight animated">
                                <label class="pull-left" ><span class="ion-ios-time-outline"></span> Fecha de Inicio:</label>
                                <input class="pull-right" id="start_date" name="start_date" type="date" >
                                @error('start_date')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="group clearfix slideInLeft animated">
                                <label class="pull-left" ><span class="ion-ios-calendar-outline"></span> Fecha de Fin:</label>
                                <input class="pull-right" id="end_date" name="end_date" type="date" >
                                @error('end_date')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="action flipInY animated">
                                <button class="btn" title="Generar Informe" value="104864678120869" name="button_facebook" id="facebook_sumate">Generar Informe</button>
                                <button class="btn" title="Generar Informe" value="102674511293040" name="button_facebook" id="facebook_manfred" style="display:none">Generar Informe</button>
                            </div>
                        </form>   
                    </div>
                </div>

                <div class="html info_escucha">
                    <div class="forms">
                        <h1 class="text-center" style="color:#fff;">Generacion de Informe de Escucha Activa Con mas reacciones</h1>
                        <div class="action flipInY animated">
                            <form action="{{route('informe_escucha')}}" method="post" target="_blank">
                                @csrf
                                <button class="btn" title="Generar Informe" value="104864678120869" name="reaction_id" id="escucha_reaction_sumate">Generar Informe</button>
                                <button class="btn" title="Generar Informe" value="102674511293040" name="reaction_id" id="escucha_reaction_manfred" style="display:none">Generar Informe</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="html info_escucha_fechas">
                    <div class="forms">
                        <form id="form_escucha_dates" action="{{route('iforme_escucha_fecha')}}" method="post" target="_blank" enctype="multipart/form-data">
                            @csrf
                            <h1 class="text-center" style="color:#fff;">Generacion de informe de Escucha por rango de fechas</h1>
                            <div class="group clearfix slideInRight animated">
                                <label class="pull-left" for="instagram-time"><span class="ion-ios-time-outline"></span> Fecha de Inicio:</label>
                                <input class="pull-right" id="start_date_listen" name="start_date_listen" type="date">
                            </div>
                            <div class="group clearfix slideInLeft animated">
                                <label class="pull-left" for="instagram-date"><span class="ion-ios-calendar-outline"></span> Fecha de Fin:</label>
                                <input class="pull-right" id="end_date_listen" name="end_date_listen" type="date">
                            </div>
                            <div class="group clearfix slideInRight animated">
                                <label class="pull-left"><span class="ion-ios-time-outline"></span>Seleccione una reaccion:</label>
                                <select name="reaccion_reporte" id="reaccion_reporte" class="pull-right">
                                    <option value="">Seleccione una reaccion</option>
                                    <option value="like_count">Likes</option>
                                    <option value="love_count">Loves</option>
                                    <option value="haha_count">Hahas</option>
                                    <option value="wow_count">Wows</option>
                                    <option value="sad_count">Sads</option>
                                    <option value="angry_count">Angries</option>
                                    <option value="share_count">Shares</option>
                                    <option value="comments_count">Comentarios</option>
                                    <option value="post_click">Clicks</option>
                                    <option value="post_impressions">Impresiones</option>
                                </select>
                            </div>
                            <div class="group clearfix slideInLeft animated">
                                <label class="pull-left" ><span class="ion-ios-calendar-outline"></span> Grafico de Tortas:</label>
                                <input class="pull-right" id="grafico_tortas" name="grafico_tortas" type="file" accept="image/*">
                            </div>
                            <div class="group clearfix slideInRight animated">
                                <label class="pull-left"><span class="ion-ios-time-outline"></span> Grafico de Barras:</label>
                                <input class="pull-right" id="grafico_bar" name="grafico_bar" type="file" accept="image/*">
                            </div>
                            <div class="action flipInY animated">
                                <button class="btn" title="Generar Informe" value="104864678120869" name="date_listen_id" id="escucha_date_sumate">Generar Informe</button>
                                <button class="btn" title="Generar Informe" value="102674511293040" name="date_listen_id" id="escucha_date_manfred" style="display:none">Generar Informe</button>
                            </div> 
                        </form>    
                    </div>
                </div>

            </div>
            <div class="nav_form">
                <a href="#instagram" class="nav-item-form nav-count-2"><i class="ion-ios-compose-outline"></i><span class="invisible">instagram</span></a>
                <a href="#info_escucha_fechas" class="nav-item-form nav-count-3"><i class="ion-ios-chatboxes-outline"></i><span class="invisible">Chats</span></a>
                <a href="#info_escucha" class="nav-item-form nav-count-4"><i class="ion-ios-alarm-outline"></i><span class="invisible">Alarm</span></a>
                <a href="#toggle" class="mask"><i class="ion-ios-plus-empty"></i></a>
            </div>
        </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
			App.init();
        });
        var App = {
            init: function() {
                this.datetime(), this.side.nav_form(), this.search.bar(), this.navigation(), this.hyperlinks(), setInterval("App.datetime();", 1e3)
            },
            datetime: function() {
                var e = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"),
                    t = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"),
                    a = new Date,
                    i = a.getYear();
                1e3 > i && (i += 1900);
                var s = a.getDay(),
                    n = a.getMonth(),
                    r = a.getDate();
                10 > r && (r = "0" + r);
                var l = a.getHours(),
                    c = a.getMinutes(),
                    h = a.getSeconds(),
                    o = "AM";
                l >= 12 && (o = "PM"), l > 12 && (l -= 12), 0 == l && (l = 12), 9 >= c && (c = "0" + c), 9 >= h && (h = "0" + h), $(".welcome .datetime .day").text(e[s]), $(".welcome .datetime .date").text(t[n] + " " + r + ", " + i), $(".welcome .datetime .time").text(l + ":" + c + ":" + h + " " + o)
            },
            title: function(e) {
                return $(".header>.title").text(e)
            },
            side: {
                nav_form: function() {
                    this.toggle(), this.navigation()
                },
                toggle: function() {
                    $(".ion-ios-navicon").on("touchstart click", function(e) {
                        e.preventDefault(), $(".sidebar").toggleClass("active"), $(".nav_form").removeClass("active"), $(".sidebar .sidebar-overlay").removeClass("fadeOut animated").addClass("fadeIn animated")
                    }), $(".sidebar .sidebar-overlay").on("touchstart click", function(e) {
                        e.preventDefault(), $(".ion-ios-navicon").click(), $(this).removeClass("fadeIn").addClass("fadeOut")
                    })
                },
                navigation: function() {
                    $(".nav-left a").on("touchstart click", function(e) {
                        e.preventDefault();
                        var t = $(this).attr("href").replace("#", "");
                        $(".sidebar").toggleClass("active"), $(".html").removeClass("visible"), "home" == t || "" == t || null == t ? $(".html.welcome").addClass("visible") : $(".html." + t).addClass("visible"), App.title($(this).text())
                    })
                }
            },
            search: {
                bar: function() {
                    $(".header .ion-ios-search").on("touchstart click", function() {
                        var e = ($(".header .search input").hasClass("search-visible"), $(".header .search input").val());
                        return "" != e && null != e ? (App.search.html($(".header .search input").val()), !1) : ($(".nav_form").removeClass("active"), $(".header .search input").focus(), void $(".header .search input").toggleClass("search-visible"))
                    }), $(".search form").on("submit", function(e) {
                        e.preventDefault(), App.search.html($(".header .search input").val())
                    })
                },
                html: function(e) {
                    $(".search input").removeClass("search-visible"), $(".html").removeClass("visible"), $(".html.search").addClass("visible"), App.title("Result"), $(".html.search").html($(".html.search").html()), $(".html.search .key").html(e), $(".header .search input").val("")
                }
            },
            navigation: function() {
                $(".nav_form .mask").on("touchstart click", function(e) {
                    e.preventDefault(), $(this).parent().toggleClass("active")
                })
            },
            hyperlinks: function() {
                $(".nav_form .nav-item-form").on("click", function(e) {
                    e.preventDefault();
                    var t = $(this).attr("href").replace("#", "");
                    $(".html").removeClass("visible"), $(".html." + t).addClass("visible"), $(".nav_form").toggleClass("active"), App.title($(this).text())
                })
            }
        };
    </script>

    <script>
        document.getElementById('form_instagram').addEventListener('submit', function (event) {
            // Obtener los valores de las fechas
            let startDateInput = document.getElementById('start_date');
            let endDateInput = document.getElementById('end_date');
            let startDate = new Date(startDateInput.value);
            let endDate = new Date(endDateInput.value);
            let today = new Date();
            // Validar que los campos no estén vacíos
            if (!startDateInput.value) {
                Swal.fire('error','La fecha de inicio es obligatoria.','error');
                event.preventDefault(); // Prevenir el envío del formulario
                return;
            }
            if (!endDateInput.value) {
                Swal.fire('error','La fecha de fin es obligatoria.','error');
                event.preventDefault(); // Prevenir el envío del formulario
                return;
            }
            // Validar que la fecha de inicio es anterior a la fecha de fin
            if (startDate > endDate) {
                Swal.fire('error','La fecha de inicio debe ser anterior a la fecha de fin.','error');
                event.preventDefault();
                return;
            }
            // Validar que la fecha de fin no es posterior a hoy
            if (endDate > today) {
                Swal.fire('error','La fecha de fin no puede ser posterior a hoy.','error')
                event.preventDefault();
                return;
            }
        });
    </script>

    <script>
        document.getElementById('form_escucha_dates').addEventListener('submit', function (event) {
            // Obtener los valores de las fechas  
            let startDateInput = document.getElementById('start_date_listen');
            let endDateInput = document.getElementById('end_date_listen');
            let startDate = new Date(startDateInput.value);
            let endDate = new Date(endDateInput.value);
            let today = new Date();
            // Validar que los campos no estén vacíos
            if (!startDateInput.value) {
                Swal.fire('error','La fecha de inicio es obligatoria.','error');
                event.preventDefault(); // Prevenir el envío del formulario
                return;
            }
            if (!endDateInput.value) {
                Swal.fire('error','La fecha de fin es obligatoria.','error');
                event.preventDefault(); // Prevenir el envío del formulario
                return;
            }
            // Validar que la fecha de inicio es anterior a la fecha de fin
            if (startDate > endDate) {
                Swal.fire('error','La fecha de inicio debe ser anterior a la fecha de fin.','error');
                event.preventDefault();
                return;
            }
            // Validar que la fecha de fin no es posterior a hoy
            if (endDate > today) {
                Swal.fire('error','La fecha de fin no puede ser posterior a hoy.','error')
                event.preventDefault();
                return;
            }
        });
    </script>

<script>
    document.getElementById('cuentaSelect').addEventListener('change', function () {
        // Obtener el valor seleccionado
        const selectedAccountId = this.value;        
        // Verificar cuál es el account_id seleccionado no sea vacio
        if(selectedAccountId === ''){
            console.log("vacio")
        }else{
            if (selectedAccountId === "104864678120869"){
                document.getElementById("escucha_reaction_sumate").style.display='';
                document.getElementById("escucha_reaction_manfred").style.display='none';   
                document.getElementById("facebook_sumate").style.display='';
                document.getElementById("facebook_manfred").style.display='none';   
                document.getElementById("escucha_date_sumate").style.display='';
                document.getElementById("escucha_date_manfred").style.display='none';   
            }
            if(selectedAccountId === "102674511293040"){
                document.getElementById("escucha_reaction_sumate").style.display='none';
                document.getElementById("escucha_reaction_manfred").style.display='';
                document.getElementById("facebook_sumate").style.display='none';
                document.getElementById("facebook_manfred").style.display='';   
                document.getElementById("escucha_date_sumate").style.display='none';
                document.getElementById("escucha_date_manfred").style.display='';   
            }   
            
        }
    });
</script>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <script>
        if(document.querySelector('.alert-danger')) {
            setTimeout(function(){
                window.location.reload();
            }, 3000); // Redirige después de 3 segundos
        }
    </script>

{{--<div class="container">
    <h1 class="text-center">Generación de informe de Escucha por rango de fechas PYTHON</h1>
    <form id="date-form" action="{{ route('informe_python') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <label for="start_date_python">Fecha de Inicio:</label>
                <input type="date" id="start_date_python" name="start_date_python" class="form-control">
                @error('start_date_python')
                    <p class='text-danger inputerror'>{{ $message }}</p>
                @enderror
            </div> 
            <div class="col-md-3">
                <label for="end_date_python">Fecha de Fin:</label>
                <input type="date" id="end_date_python" name="end_date_python" class="form-control">
                @error('end_date_python')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                @enderror
            </div>  
            <div class="col-md-3">
                <label for="archivo_python">Subir Archivo Python</label>
                <input type="file" name="archivo_python" id="archivo_python" class="form-control">
                @error('archivo_python')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                @enderror
            </div> 
        </div>
        <div class="text-center mt-3">
            <button class="btn btn-success">Generar Informe</button>
        </div>    
    </form>
</div>--}}
@endsection    

