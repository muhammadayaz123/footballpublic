<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 , user-scalable=no"  />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"  />
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' />
    {{--  <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css" />  --}}

    <meta property="og:url" content="http://www.pigno.se/barn/PIGNOSE-Calendar">
    <meta property="og:type" content="product" />
    <meta property="og:title" content="PIGNOSE Calendar" />
    <meta property="og:description" content="PIGNOSE Calendar is beautiful and eidetic jQuery date picker plugin" />
    <meta property="og:image" content="http://www.pigno.se/barn/PIGNOSE-Calendar/demo/img/cover@250.png" />
    <meta property="og:site_name" content="PIGNOSE" />
    <meta name="description" content="PIGNOSE Calendar is beautiful and eidetic jQuery date picker plugin" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mina.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/naveed.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ui.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pignose.calendar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/emoji.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    {{--  <link rel="stylesheet" href="{{ asset('assets/css/theme.css')}}" />  --}}


    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.5.1/socket.io.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
    <script>
        var socket = io('{{ config('app.socket') }}', {secure: true});


        // window.onload = function() {
        //     getLocation();
        // };

        // var lat = '';
        // var long = '';

        // function getLocation() {
        //     if (navigator.geolocation) {
        //         navigator.geolocation.getCurrentPosition(showPosition);
        //     } else {
        //         // x.innerHTML = "Geolocation is not supported by this browser.";
        //         alert('Geolocation is not supported by this browser');
        //     }
        // }

        // function showPosition(position) {

        //     lat = position?.coords?.latitude;
        //     long = position?.coords?.longitude
        //     console.log(position?.coords?.latitude, position?.coords?.longitude );
        //     localStorage.setItem("lat1", lat);
        //     localStorage.setItem("long1", long);
        //     console.log(lat , "lat");
        //     console.log(long , "long");
        // }

    </script>



    <title>FootBall</title>


</head>

<body class="bg_img-s font_family_roboto-s">
    {{--  <div id="loader-notification" class='loader_container-s align-self-center d-none w-100 justify-content-center' style="">
        <img class='align-self-center' width='200' height="200" src="{{ asset('assets/images/logo_gif.gif') }}">
    </div>  --}}
    @yield('admin_content')
