<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="img/favicon.ico">
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap-4.6.2-dist/css/bootstrap.css') }}">

        <title>Unidad de Infrmación</title>

        <!-- Styles -->
        <style>

            .background {
              /*background-image: url(https://source.unsplash.com/Q7PclNhVRI0);*/
              background-position: bottom;
              background-repeat: no-repeat;
              background-size: cover;
              height: 100vh;
              width: 100%;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            /*#carousel .overlay .row
            {
                height: 50%;
            }*/

            .carousel-inner img{
                max-height: 100vh ;
                object-fit: cover;
                filter: grayscale(70%);
            }

            /*html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', Montserrat;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }*/

            .highcharts-figure .chart-container {
                width: 300px;
                height: 200px;
                float: left;
            }

            .highcharts-figure,
                .highcharts-data-table table {
                    width: 700px;
                    margin: 0 auto;
            }

            .highcharts-data-table table {
                font-family: Verdana, sans-serif;
                border-collapse: collapse;
                border: 1px solid #ebebeb;
                margin: 10px auto;
                text-align: center;
                width: 100%;
                max-width: 500px;
            }

            .highcharts-data-table caption {
                padding: 1em 0;
                font-size: 1.2em;
                color: #555;
            }

            .highcharts-data-table th {
                font-weight: 600;
                padding: 0.5em;
            }

            .highcharts-data-table td,
            .highcharts-data-table th,
            .highcharts-data-table caption {
                padding: 0.5em;
            }

            .highcharts-data-table thead tr,
            .highcharts-data-table tr:nth-child(even) {
                background: #f8f8f8;
            }

            .highcharts-data-table tr:hover {
                background: #f1f7ff;
            }

            @media (max-width: 600px) {
                .highcharts-figure,
                .highcharts-data-table table {
                    width: 100%;
                }

                .highcharts-figure .chart-container {
                    width: 300px;
                    float: none;
                    margin: 0 auto;
                }
            }


            img {
                display: block;
                width: 100%;
                max-width: 100px;
                margin-right: auto;
            }

        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="clearfix">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/home') }}">Inicio</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-sm azul">Iniciar Sesión</a>
                        @endauth
                    </div>
                @endif
            </div>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <img alt="logo udi" src="{{ asset('img/Lateral_sistema_UDI_01.png') }}" style="max-width: 200%;">
                </div>
                <div class="col-md-10 col-sm">
                    <br>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <!-- <div class="carousel-item active" data-interval="10000">
                                <figure class="highcharts-figure" style="width: 1000px; height: 125%;">
                                    <div id="container0">
                                        <p class="highcharts-description"></p>
                                    </div>
                                </figure>
                            </div> -->
                            <div id="carousel"></div>
                        </div>
                    </div>
                </div>
        </div>
        </div>
    </body>
    
    <script src="{{ asset('plugins/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-4.6.2-dist/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript">
    </script>
</html>