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


    <title>Contact Us</title>
</head>

<body class="bg_contact_image-s font_family_poppins-s">
    <div class="container-fluid p-0 bg_green_img-s">

        <div class="container-fluid">
            <div class="row my-md-5 my-4 mx-xl-5 mx-lg-3 mx-0">

                <!--logo-->
                <div class="col-4 d-xl-block d-none">
                    <img src="{{ asset('assets/images/KJ_Logo.svg') }}" width="70" alt="logo" class="pl-2">
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
                                    <a class="nav-link text-dark fs_19px-s green_bottom_on_hover-s  pl-0"  href="{{ route('home') }}"><strong>Home</strong></a>
                                </li>
                                <!--about-->
                                <li class="nav-item px-xl-5 px-3">
                                    <a class="nav-link text-dark fs_19px-s green_bottom_on_hover-s pl-0" href="{{ route('aboutUs') }}"><strong>About</strong></a>
                                </li>
                                <!--contacts-->
                                <li class="nav-item px-xl-5 px-3">
                                    <a class="nav-link text-dark fs_19px-s green_bottom_on_hover-s active pl-0" href="{{ route('contact_us') }}"><strong>Contact</strong></a>
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
                <div class="col-md-6 col-12 mt-3">
                    <h1 class="fg_green-s fs_contact_90px-s font-weight-bolder"><strong>CONTACT</strong></h1>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut.</p>
                    <div class=" bottom_35px-s position-absolute ml-5 d-md-block d-none">
                        <a href="https://www.facebook.com"" class="td_none-s">
                            <img src="{{ asset('assets/images/facebook_icon.svg') }}" class=" mr-3" width="50" height="50" alt="facebook icon">
                        </a>
                        <a href="https://www.linkedin.com" class="td_none-s">
                            <img src="{{ asset('assets/images/linked_icon.svg') }}" class="" width="50" height="50" alt="facebook icon">
                        </a>
                        <a href="https://twitter.com" class="td_none-s">
                            <img src="{{ asset('assets/images/tweeter_icon.svg') }}" class=" ml-3" width="50" height="50" alt="facebook icon">
                        </a>
                    </div>
                </div>
                <div class="col-md-6 br_10px-s py-4 px-4 bg-white col-12 mt-3">
                    <form action="" id="contact_us_frm-d" method="post">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="first_name-d" class="text-dark font-weight-bolder"><strong>First Name</strong></label>
                                    <input type="text" class="form-control  placeholder_color-s br_7px-s border form-control-xl py-4 bg-white" name="first_name" id="first_name-d" placeholder="Enter First Name" aria-describedby="first_name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="last_name-d" class="text-dark font-weight-bolder"><strong>Last Name</strong></label>
                                    <input type="text" class="form-control  placeholder_color-s br_7px-s border form-control-xl py-4 bg-white" name="last_name" id="last_name-d" placeholder="Enter Last Name" aria-describedby="last_name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email-d" class="text-dark font-weight-bolder"><strong>Email</strong></label>
                                    <input type="email" class="form-control  placeholder_color-s br_7px-s border form-control-xl py-4 bg-white" name="email" id="email-d" placeholder="Enter Email" aria-describedby="email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="subject-d" class="text-dark font-weight-bolder"><strong>Subject</strong></label>
                                    <input type="text" class="form-control  placeholder_color-s br_7px-s border form-control-xl py-4 bg-white" name="subject" id="subject-d" placeholder="Enter Subject" aria-describedby="subject">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="message-d" class="text-dark font-weight-bolder"><strong>Message</strong></label>
                                    <textarea name="message" class="form-control placeholder_color-s resize_none-s br_7px-s border bg-white" id="message-d" placeholder="Write Message" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="w-100 bg_green-s border-0 br_7px-s text-white py-3"><strong>SUBMIT</strong></button>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="col-12 mt-3">
                <div class="text-center d-md-none">
                        <a href="https://www.facebook.com" class="td_none-s">
                            <img src="{{ asset('assets/images/facebook_icon.svg') }}" class=" mr-3" width="50" height="50" alt="facebook icon">
                        </a>
                        <a href="https://www.linkedin.com" class="td_none-s">
                            <img src="{{ asset('assets/images/linked_icon.svg') }}" class="" width="50" height="50" alt="facebook icon">
                        </a>
                        <a href="https://twitter.com" class="td_none-s">
                            <img src="{{ asset('assets/images/tweeter_icon.svg') }}" class=" ml-3" width="50" height="50" alt="facebook icon">
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer section - START -->
            <section>
                <div class="footer-copyright footer text-white py-3 text-center">
                    © Copyright 2021
                </div>
            </section>
            <!-- Footer section - END -->
        </div>
    </div>


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
