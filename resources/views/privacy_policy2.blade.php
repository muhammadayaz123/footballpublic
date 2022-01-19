<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' />


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
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    {{--  <link rel="stylesheet" href="{{ asset('assets/css/theme.css')}}" />  --}}


    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.5.1/socket.io.min.js"></script>
    <script>
        var socket = io('{{ config('app.socket') }}', {secure: true});
    </script>



    <title>FootBall</title>


</head>

<body class="bg_img-s font_family_roboto-s">




    {{-- <div class="container-fluid px-xl-5 px-3">
        <div class="row pt-4 pb-3">
            <div class="col-xl-8 col-lg-8 col-md-8 col-12 d-flex order-md-1 order-2">
                <a class="td_none-s" href="{{ url('more') }}">
                    <h4 class="pr-2 fs_sm_21px-sfs_sm_21px-s text-dark">More</h4>
                </a>
                <h4 class="px-2 fs_sm_21px-s"><strong>/</strong></h4>
                <h4 class="fg_green-s fs_sm_21px-s pl-2">Terms & Conditions</h4>
            </div>
        </div>
    </div> --}}
    <!-- .................Home Page NavBar End ......................... -->


    <!-- container for terms and condition - start -->
    <div class="container-fluid bg-white br_47px-s mh_86vh-s">
        <div class="row pt-5 px-xl-4">
            <div class="col-12 mt-3 d-flex fg_green-s">
                <h5 class="mr-2">Last Updated:</h5>
                <h5 class="mx-2">2 January 2021</h5>
            </div>
        </div>
        <div class="row py-5 px-xl-4">
            <div class="col-12">
                <p class="text-wrap text-break fs_18px-s">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                    aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde
                    omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                    sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius
                    modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                <p class="text-wrap text-break fs_18px-s">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                    aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde
                    omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                    sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius
                    modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                <p class="text-wrap text-break fs_18px-s">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                    aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde
                    omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                    sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius
                    modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
            </div>
        </div>
    </div>

    <!-- container for terms and condition - end -->



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>





    <script type="text/javascript">

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" ></script>

    <script type="text/javascript" src="{{ asset('assets/js/pignose.calendar.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/functional.js') }}"></script>
    <script src="{{ asset('assets/js/common.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/profile.js') }}"></script>
    <script src="{{ asset('assets/js/media.js') }}"></script>
    <script src="{{ asset('assets/js/invitation.js') }}"></script>
    <script src="{{ asset('assets/js/chat.js') }}"></script>

    <script>

    </script>
</body>

</html>
