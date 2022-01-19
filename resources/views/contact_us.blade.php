@include ('layout.header')
 <!-- .................about us Start ......................... -->
    <div class="container-fluid px-0 mx-0 ">
        <!-- .................Home Page NavBar Start ......................... -->


        <div class="container-fluid px-xl-5 px-3">
            <div class="row pt-4 pb-3">
                <div class="col-xl-8 col-lg-8 col-md-8 col-12 d-flex">
                    {{-- <a class="td_none-s" href="{{ url('more') }}">
                        <h4 class="pr-2 text-dark fs_sm_21px-s">More</h4>
                    </a> --}}
                    {{-- <h4 class="px-2 fs_sm_21px-s"><strong>/</strong></h4> --}}
                    <h4 class="fg_green-s fs_sm_21px-s pl-2">Contact Us</h4>
                </div>

            </div>
        </div>
        <!-- .................Home Page NavBar End ......................... -->


        <!-- container for about us - start -->
        <div class="container-fluid bg-white br_47px-s mh_86vh-s">
            <div class="row pt-5 px-xl-4">
                <div class="col-md-6 col-12">
                    <img src="{{ asset('assets/images/black_logo.svg') }}" width="100" class="" alt="Logo">
                    <div class="position-absolute logo_text-s text-white">
                        <h5>
                            LOGO
                        </h5>
                    </div>
                </div>
                <div class="col-md-6 col-12 justify-content-end align-self-center d-flex">
                    <div class="px-2">
                        <a href="javascript:void(0)" class=""><img src="{{ asset('assets/images/tweeter.svg') }}" alt="tweeter logo"></a>
                    </div>
                    <div class="px-2">
                        <a href="javascript:void(0)"><img src="{{ asset('assets/images/insta.svg') }}" alt="insta logo"></a>
                    </div>
                    <div class="px-2">
                        <a href="javascript:void(0)"><img src="{{ asset('assets/images/facebook.svg') }}" alt="facebook logo"></a>
                    </div>
                    <div class="px-2">
                        <a href="javascript:void(0)"><img src="{{ asset('assets/images/linkedin.svg') }}" alt="linkedin logo"></a>
                    </div>
                </div>
            </div>
            <div class="row py-5 px-xl-4">
                <div class="col-12">
                    <p class="text-wrap text-break fs_18px-s">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis
                        unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia
                        voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non
                        numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                </div>
                <div class="col-12">
                    <p class="text-wrap text-break fs_18px-s">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis
                        unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia
                        voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non
                        numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                </div>
            </div>

        </div>
        <!-- container for about us - end -->

{{-- @endsection --}}

{{-- @include('layout.footer') --}}
