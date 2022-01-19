<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/mina.css') }}">
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
    <!-- <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' /> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/naveed.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ui.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pignose.calendar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />


    <title>football Login</title>
</head>

<body class="background_img-s font_family_poppins-s">
    <div id="loader" class='loader_container-s align-self-center d-none w-100 justify-content-center' style="">
        <img class='align-self-center' width='200' height="200" src="{{ asset('assets/images/logo_gif.gif') }}">
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center mt-3 m-0">
            <div class="col-3 text-center">
                @if(session()->has('message'))

                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>

                @endif
            </div>
        </div>
        <div class="row my-md-5 my-4 mx-xl-5 mx-lg-3 mx-0">

            <!--logo-->
            <div class="col-4 d-xl-block d-none invisible">
                <img src="{{ asset('assets/images/kj_logo.svg') }}" width="70" alt="logo" class="pl-2">
                {{-- <div class="position-absolute logo_text-s text-white">Logo</div> --}}
            </div>
            <!--logo end-->
            <!--nav bar start-->
            <div class="col-xl-5  col-5">
                <nav class="navbar navbar-expand-xl navbar-light px-0">
                    <!--toggler menu button for medium screen-->
                    <button class="navbar-toggler border-0 p-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!--navbar menu-->
                    <div class="collapse navbar-collapse navbar_collapse-s h-100" id="navbarSupportedContent">
                        <ul class="navbar-nav ">
                            <!--home-->
                            <li class="nav-item pr-xl-5 pl-xl-0 px-3">
                                <a class="nav-link text-dark fs_19px-s green_bottom_on_hover-s active pl-0"  href="{{ route('home') }}"><strong>Home</strong></a>
                            </li>
                            <!--about-->
                            <li class="nav-item px-xl-5 px-3">
                                <a class="nav-link text-dark fs_19px-s green_bottom_on_hover-s pl-0" href="{{ route('aboutUs') }}"><strong>About</strong></a>
                            </li>
                            <!--contacts-->
                            <li class="nav-item px-xl-5 px-3">
                                <a class="nav-link text-dark fs_19px-s green_bottom_on_hover-s pl-0" href="{{ route('contact_us') }}"><strong>Contact</strong></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!--nav bar end-->


            <!--gear store button-->
            <div class="col-xl-3 col-7 text-right">
                <button type="button" class="btn text-white bg_green-s fs_small_for_sm-s border-0 br_10px-s py-3 px-md-5 px-4"><strong>Gear Store</strong></button>
            </div>

            <!--gear store button end-->
        </div>

        <div class="row  mt-md-5 mb-2 mt-4 mx-xl-5 mx-lg-3 mx-0">
            <!--for large to medium screen-->
            <div class="col-xl-4 col-lg-5 col-md-4 col-12 text-md-left text-center">
                <!-- <div class="row"> -->
                    <!-- <div class="col-12 mb-3 justify-content-md-start justify-content-center d-flex"> -->
                        <div class="pl-lg-3">
                            <img src="{{ asset('assets/images/KJ_Logo.svg') }}" class=" w_md_100-s w_sm_50-s" width="65%" alt="logo" class="pl-2">
                        </div>
                    <!-- </div> -->
                    <div class=" bottom_35px-s position-absolute ml-5 d-xl-block d-none">
                        <!-- <div class=""> -->
                            <a href="https://www.facebook.com" class="td_none-s">
                                <img src="{{ asset('assets/images/facebook_icon.svg') }}" class=" mr-3" width="50" height="50" alt="facebook icon">
                            </a>
                            <a href="https://www.linkedin.com" class="td_none-s">
                                <img src="{{ asset('assets/images/linked_icon.svg') }}" class="" width="50" height="50" alt="facebook icon">
                            </a>
                            <a href="https://twitter.com" class="td_none-s">
                                <img src="{{ asset('assets/images/tweeter_icon.svg') }}" class=" ml-3" width="50" height="50" alt="facebook icon">
                            </a>
                        <!-- </div> -->
                    </div>
                <!-- </div> -->
            </div>
            <div class="col-xl-5 col-lg-7 col-8  d-none d-md-block">
                <div>
                    <h1>Find the</h1>
                </div>
                <div>
                    <h1 class="fg_green-s fs_90px-s font-weight-bolder "><strong>FOOTBALL PLAYERS</strong></h1>
                </div>
                <div>
                    <h1 class="fs_40px-s">based on position</h1>
                </div>
                <div class="row py-2">
                    <div class="col-6">
                        <hr class="">
                    </div>
                </div>
                <div>
                    <h2 class="opacity_60-s">OR BUY GEAR FOR PLAYERS</h2>
                </div>
                <!--download from apple strore and google store button-->
                <div class="row mt-5 d-xl-block d-none">
                    <div class="col-12 pt-5 pr-0">
                        <h6>Download Our App</h6>
                        <div class="d-flex">
                            <!--apple store button-->
                            <button type="button" class="btn bg-white br_13px-s text-dark border-xl-0 border mr-2 py-3 px-5 d-flex">
                                <img src="{{ asset('assets/images/black_apple_icon.svg') }}" alt="apple logo" />
                                <h6 class="mb-0 mt-1 ml-2 fs_15px-s"><strong>Apple Store</strong></h6>
                            </button>
                            <!--apple store button end-->
                            <!--google play button -->
                            <button type="button" class="btn bg-dark br_13px-s text-white border-0 ml-2 py-3 px-5 d-flex">
                                <img src="{{ asset('assets/images/white_playstore_icon.svg') }}" alt="playstore logo">
                                <h6 class="mb-0 mt-1 ml-2 fs_15px-s"><strong>Google Play</strong></h6>
                            </button>
                            <!--google play button end-->
                        </div>
                    </div>
                </div>
            </div>
            <!--for large to medium screen end-->

            <!--for Samll Screen-->
            <div class="col-12 d-md-none  d-block">
                <div>
                    <h5>Find the</h5>
                </div>
                <div>
                    <h1 class="fg_green-s fs_39px_on_sm-s font-weight-bolder">FOOTBALL PLAYERS</h1>
                </div>
                <div>
                    <h5 class="text-left fs_15px-s">based on position</h5>
                </div>
                <div class="row ">
                    <div class="col-4 ">
                        <hr class="">
                    </div>
                    <div class="col-12 ">
                        <h6 class="opacity_60-s text-left fs_15px-s">OR BUY GEAR FOR PLAYERS</h6>
                    </div>
                </div>
            </div>
            <!--for small screen end-->
            <div class="w-100 d-xl-none d-block"></div>
            <!--for large Screen-->
            <div class="col-lg-5 col-md-4 col-12 order-12 order-md-2 pt-5 pb-5 pl-lg-5 pl-2 align-self-md-end text-lg-left text-center d-xl-none d-lg-block">
                <h5 class=" text-dark ">Download Our App</h5>
                <div class="pt-2 d-md-block d-flex justify-content-center">
                    <button type="button" class="btn bg-white br_13px-s text-dark border-xl-0 border mb-md-2 px-4 py-3 mx-lg-0 mx-md-auto mx-1  d-flex">
                        <img src="{{ asset('assets/images/black_apple_icon.svg') }}" width="20" height="20" alt="apple logo">
                        <h6 class="mb-0  ml-2 mt-1 fs_13px_on_sm-s"><strong>Apple Store</strong></h6>
                    </button>

                    <button type="button" class="btn bg-dark br_13px-s text-white border-0 mt-md-2 mx-lg-0 mx-md-auto mx-1 py-3 px-4 d-flex">
                        <img src="{{ asset('assets/images/white_playstore_icon.svg') }}" width="20" height="20" alt="playstore logo">
                        <h6 class="mb-0  ml-2 mt-1 fs_13px_on_sm-s"><strong>Google Play</strong></h6>
                    </button>
                </div>
                <div class="mt-5 pt-5">
                    <a href="javascript:void(0)" class="td_none-s">
                        <img src="{{ asset('assets/images/facebook_icon.svg') }}" class="border-md-0 border rounded-circle mr-3" width="50" height="50" alt="facebook icon">
                    </a>
                    <a href="javascript:void(0)" class="td_none-s">
                        <img src="{{ asset('assets/images/linked_icon.svg') }}" class="border-md-0 border rounded-circle" width="50" height="50" alt="facebook icon">
                    </a>
                    <a href="javascript:void(0)" class="td_none-s">
                        <img src="{{ asset('assets/images/tweeter_icon.svg') }}" class="border-md-0 border rounded-circle ml-3" width="50" height="50" alt="facebook icon">
                    </a>
                </div>
            </div>
            <!--for lage Screen end-->

            <!--login form-->
            <div class="col-xl-3 col-lg-7 col-md-8 col-12 order-1 order-md-12 pb-5 pt-xl-5 pt-3 align-items-right">
                <form action="{{ route('login') }}" id="frm_login-d" method="post">
                    @csrf
                    <div class="form-group pb-xl-3 pb-1 pt-5">
                        <!--email-->
                        <label for="" class="text-dark font-weight-bolder"><strong>Email</strong></label>
                        <input type="email" name="email" placeholder="Email Address" class="form-control placeholder_color-s h_60px-s br_13px-s border-md-0 border form-control-xl py-4 bg-white">
                    </div>
                    <div class="form-group pt-xl-3 pt-1 password_container-d">
                        <!--pasword-->
                        <label for="" class="text-dark font-weight-bolder"><strong>Password</strong></label>
                        <div class="input-group  br_13px-s h_60px-s border-md-0 border mb-3">
                            <input type="password" name="password" id="password-d" placeholder="Enter password" class="form-control h_58px-s placeholder_color-s br_13px-s border-0 password-d form-control-xl password-s py-4 bg-white">
                            <div class="input-group-prepend mr-0 ">
                                <span class="border-0 input-group-text bg-white br_13px-s" id="inputGroup-sizing-default">
                                    <img src="{{ asset('assets/images/hide_pass_icon.svg') }}" data-view_icon_url="{{ asset('assets/images/view_pass_icon.svg') }}" data-dont_view_icon_url="{{ asset('assets/images/hide_pass_icon.svg') }}"  alt='eye' class=' toggle_eye_icon-d rounded-circle cursor_pointer-s'  aria-describedby="inputGroup-sizing-default" />
                                </span>
                            </div>
                        </div>
                        <span id="wrong_password-d" class="error fs_14px-s text-danger  d-none" ></span>
                        <!-- <input type="password" name="password" placeholder="Enter password" class="form-control placeholder_color-s br_10px-s form-control-xl py-4 bg-white"> -->
                    </div>
                    <!--forgot password-->
                    <div class="float-right">
                        <div  class="text-dark" data-toggle="modal" data-target="#update_forgot_password_modal-d">
                            <h6 class="mb-0"><strong>Forgot Password?</strong></h6>
                        </div>
                    </div>
                    <!--login button-->
                    <button  type="submit" class="btn bg_green-s w-100 br_10px-s text-white py-3 mt-5 mb-5"><strong>LOGIN</strong></button>
                    <!--signup option-->
                </form>
                <div class=" text-center pt-xl-5 pt-2">
                    <span class="text-dark"><strong>Don't have an account? </strong><a href="{{ route('signup') }}" class="text-dark"><strong>Sign up</strong></a>.</span>
                </div>
            </div>
            <!--login form end-->
        </div>

            <!-- Footer section - START -->
    <section>
        <div class="footer-copyright footer opacity_60-s py-3 text-center">
            © Copyright 2021
        </div>
    </section>
    <!-- Footer section - END -->
    </div>


       <!-- Update password Modal -->
    <div class="modal fade" id="update_forgot_password_modal-d" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row pt-4 modal-header border-0">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/update_password.svg') }}" width="160" alt="update password">
                        </div>
                    </div>
                    <!--modal header end-->
                    <div class="row modal-body justify-content-center pt-3 pb-0">
                        <div class="col-12">
                            <div class="col-12 text-center">
                                <h4 class="fg_green-s">FORGOT PASSWORD</h4>
                                <h5>Please enter email address associated with your account to recieve a verification code</h5>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('updateForgotPassword') }}" class="frm_update_forogot_password-d" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 px-4">
                                    <div class="form-group pt-3">
                                        <label for="email-d" class=""><strong>EMAIl</strong></label>
                                        <input type="email" name="email" placeholder="Enter your email" id="email-d" class="form-control rounded form-control-xl py-4 email-t"  value="{{Auth::user()->email ?? ''}}">
                                        {{-- <input type="hidden" name="email"  value="{{Auth::user()->email ?? ''}}"> --}}
                                    </div>
                            </div>
                            <div class="col-12 py-3 text-center">
                                {{-- <a href="javascript:void(0)" class="text-dark"><u><strong>Try another way</strong></u></a> --}}
                            </div>
                        </div>
                        <div class="row pt-3 pb-5 px-2">
                            <!--CANCEL button-->
                            <div class="col-6 pr-2">
                                <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                            </div>
                            <!--CANCEL button end-->

                            <!--SEND button-->
                            <div class="col-6 pl-2">
                                <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white w-100"><strong>SEND</strong></button>
                            </div>
                            <!--SEND button end-->

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Update password Modal end-->


    <!-- enter code Modal -->
    <div class="modal fade" id="forgot_password_verification_modal-d" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row pt-4 modal-header border-0">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/code.svg') }}" width="160" alt="verification code">
                        </div>
                    </div>
                    <!--modal header end-->
                    <div class="row modal-body justify-content-center pt-3 pb-0">
                        <div class="col-12">
                            <div class="col-12 text-center">
                                <h4 class="fg_green-s">VERIFICATION</h4>
                                <h5>Please enter the 4 digit verification code sent to <span>{{ Auth::user()->email ?? '' }}</span></h5>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('validateResetPasswordCode') }}" id="frm_validate_forogot_password_code-d" class="frm_validate_code-d" method="post"  novalidate>
                        @csrf
                        <div class="row px-md-3">
                            <div class="col-12 px-4">
                                @csrf
                                    <div class="d-flex text-center py-4 justify-content-between">
                                        <div class=" p-3 code_border-s code_border-d">
                                            <!-- <span class="fs_30px-s"> -->
                                                <strong>
                                                    <input type="text" class="code_input-s v_code-d fs_30px-s text-center mb-3 v_code-s"  name='number_box_1'  id='number_box_1' min='0' max="9" maxlength="1" placeholder="0"/>
                                                </strong>
                                            <!-- </span> -->
                                        </div>
                                        <div class="  p-3 code_border-s code_border-d">
                                            <!-- <span class="fs_30px-s"> -->
                                                <strong>
                                                    <input  type="text"  class="code_input-s v_code-d fs_30px-s text-center mb-3 v_code-s" name='number_box_2' id='number_box_2' min='0' max="9" maxlength="1"  placeholder="1"/>
                                                </strong>
                                            <!-- </span> -->
                                        </div>
                                        <div class=" p-3 code_border-s code_border-d">
                                            <!-- <span class="fs_30px-s"> -->
                                                <strong>
                                                    <input type="text" class="code_input-s v_code-d fs_30px-s text-center mb-3 v_code-s"   name='number_box_3' id='number_box_3' min='0' max="9" maxlength="1"  placeholder="2"/>
                                                </strong>
                                            <!-- </span> -->
                                        </div>
                                        <div class=" p-3 code_border-s code_border-d">
                                            <!-- <span class="fs_30px-s"> -->
                                                <strong>
                                                    <input type="text" class="code_input-s v_code-d fs_30px-s text-center mb-3 v_code-s last-d" name='number_box_4' id='number_box_4' min='0' max="9" maxlength="1"   placeholder="3"/>
                                                </strong>
                                            <!-- </span> -->
                                        </div>
                                    </div>
                            </div>
                            <div class="col-12 py-3 text-center">
                                {{-- <a href="javascript:void(0)" class="text-dark"><u><strong>Resend Code</strong></u></a> --}}
                            </div>
                        </div>
                        <div class="row pt-3 pb-5 px-2">
                            <!--CANCEL button-->
                            <div class="col-6 pr-2">
                                <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100 cancel_forgot_password-d" data-dismiss="modal"><strong>CANCEL</strong></button>
                            </div>
                            <!--CANCEL button end-->
                            <!--verify button-->
                            <div class="col-6 pl-2">
                                <input type='hidden' name='activation_code' id='hdn_activation_code-d' />
                                <input type="hidden" name="" class="forgot_password-value-d" value="forgot_password">
                                <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white w-100" ><strong>VERIFY</strong></button>
                            </div>
                            <!--verify button end-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- enter code Modal end -->




   <!-- change password Modal-->
    <div class="modal fade" id="new_reset_password_modal-d" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row pt-4 modal-header border-0">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/update_password.svg') }}" width="160" alt="update password">
                        </div>
                    </div>
                    <!--modal header end-->
                    <div class="row modal-body justify-content-center pt-3 pb-0">
                        <div class="col-12">
                            <div class="col-12 text-center">
                                <h4 class="fg_green-s">CREATE NEW PASSWORD</h4>
                                <h5>Please enter email address associated with your account to recieve a verification code</h5>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('updateNewResetPassword') }}" id="frm_update_new_rest_password-d" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 px-4">
                                    {{-- <div class="form-group pt-3">
                                        <label for="new_password-d" class=""><strong>CURRENT PASSWORD</strong></label>
                                        <input type="password" name="current_password" placeholder="Enter your password" id="current_password-d" class="form-control rounded form-control-xl py-4 new_Password-t">
                                    </div> --}}
                                    <div class="form-group pt-3">
                                        <label for="new_password-d" class=""><strong>NEW PASSWORD</strong></label>
                                        <input type="password" name="new_password" placeholder="Enter your password" id="new_password-d" class="form-control rounded form-control-xl py-4 new_password-t">
                                    </div>
                            </div>

                        </div>
                        <div class="row pt-3 pb-5 px-2">
                            <!--CANCEL button-->
                            <div class="col-6 pr-2">
                                <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100 cancel_forgot_password-d" data-dismiss="modal"><strong>CANCEL</strong></button>
                            </div>
                            <!--CANCEL button end-->

                            <!--UPDATE button-->
                            <div class="col-6 pl-2">
                                <input type="hidden" name="code_hdn" id="reset_code_hdn-d" value="">
                                <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white w-100" ><strong>UPDATE</strong></button>
                                <input type="hidden" name="email" id="get_user_email-d" >
                            </div>
                            <!--UPDATE button end-->
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- change password  Modal end -->





    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js "></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js "></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js "></script>

    <!-- ajax -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js "></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js "></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" ></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js "></script> --}}

    {{--  <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js "></script>  --}}

    <script src="{{ asset('assets/js/common.js') }}"></script>
    <script src="{{ asset('assets/js/auth.js') }}"></script>
    <script src="{{ asset('assets/js/profile.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/functional.js') }}"></script> --}}

    <script>
        let HOME = "{{ route('home') }}";
        let admin = "{{ route('getAllUsers')}}";

    </script>

</body>

</html>
