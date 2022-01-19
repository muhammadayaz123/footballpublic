@include ('layout.header')
@include('layout.navbar')

    <div id="loader-notification" class='loader_container-s align-self-center d-none w-100 justify-content-center' style="">
        <img class='align-self-center' width='200' height="200" src="{{ asset('assets/images/logo_gif.gif') }}">
    </div>
@yield('content')

@include('layout.footer')

