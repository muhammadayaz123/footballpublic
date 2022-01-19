@extends('layout.app')

@section('content')
    <div class="container-fluid px-0 mx-0 ">

        <div class="container-fluid px-xl-5 px-3">
            <div class="row pt-4 pb-3">
                <div class="col-xl-8 col-lg-8 col-md-8 col-12 d-flex order-md-2 order-2">
                    {{-- <a class="td_none-s" href="{{ route('more') }}">
                        <h4 class="pr-2 text-dark fs_sm_21px-s">More</h4>
                    </a>
                    <h4 class="px-2 fs_sm_21px-s"><strong>/</strong></h4>
                    <a class="td_none-s" href="{{ route('payment') }}">
                        <h4 class="pr-2 text-dark fs_sm_21px-s">Payment</h4>
                    </a>
                    <h4 class="px-2 fs_sm_21px-s"><strong>/</strong></h4>
                    <h4 class="fg_green-s fs_sm_21px-s pl-2">Pay Now</h4> --}}
                </div>
                {{--  <div class="col-xl-4 col-lg-4 col-md-4 col-12 pt-2 text-right order-md-2 order-1">
                    <div class="">
                        <img src="assets/images/Location.svg" class="img-fluid nav_location_img" alt="navbar_home" />
                        <span class="text-dark"> <strong>Adailiya </strong> </span>
                        <a class="pl-3 td_none-s" href="user_profile.html">
                            <img src="assets/images/user_img.png" class="img-fluid rounded-circle border_green-s" width="37" alt="Navbar_profile" />
                        </a>

                        <!-- notification drop down -->
                        <a href="javasccript:void(0)" role="button" class="" data-toggle="dropdown">
                            <img src="assets/images/notification.svg" class="ml-3 img-fluid nav_notification_img" alt="navbar_home" />
                        </a>
                        <div class="col-4 dropdown-menu mt_68px-s border-0 shadow br_15px-s min_w_315px-s ml-xl-5">
                            <h4 class="ml-5 mt-3 mb-5">
                                <strong class="fg_green-s">Notification</strong>
                            </h4>

                            <h5 class="ml-5">
                                <strong>Today</strong>
                            </h5>
                            <a class="dropdown-item bg_lightgrey-s py-4" href="#">
                                <div class="profile_img_in_chat-s ml-xl-4 ml-lg-3 ml-md-2 ml-2">
                                    <img class="img_set_to_div-s" src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/close-up-of-tulips-blooming-in-field-royalty-free-image-1584131603.jpg" alt="">
                                    <strong class="fg_green-s ml-2">Themer</strong> <span> invite you to join the game.</span>
                                    </br><span class="ml-5">1m ago</span>
                                </div>
                            </a>

                            <hr class="goalkeeper_margin_b mx-1 mt-0 mb-0" />

                            <a class="dropdown-item bg_lightgrey-s py-4" href="#">
                                <div class="profile_img_in_chat-s ml-xl-4 ml-lg-3 ml-md-2 ml-2">
                                    <img class="img_set_to_div-s" src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/close-up-of-tulips-blooming-in-field-royalty-free-image-1584131603.jpg" alt="">
                                    <strong class="fg_green-s ml-2">Themer</strong> <span> accepted your invitation.</span>
                                    </br><span class="ml-5">1m ago</span>
                                </div>
                            </a>
                            <a class="dropdown-item py-4" href="#">
                                <div class="profile_img_in_chat-s ml-xl-4 ml-lg-3 ml-md-2 ml-2">
                                    <img class="img_set_to_div-s" src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/close-up-of-tulips-blooming-in-field-royalty-free-image-1584131603.jpg" alt="">
                                    <strong class="fg_green-s ml-2">Themer</strong> <span> sent you a message.</span>
                                    </br><span class="ml-5">2m ago</span>
                                </div>
                            </a>
                            <h5 class="ml-5">
                                <strong>Yesterday</strong>
                            </h5>
                            <a class="dropdown-item py-4" href="#">
                                <div class="profile_img_in_chat-s ml-xl-4 ml-lg-3 ml-md-2 ml-2">
                                    <img class="img_set_to_div-s" src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/close-up-of-tulips-blooming-in-field-royalty-free-image-1584131603.jpg" alt="">
                                    <strong class="fg_green-s ml-2">Themer</strong> <span> sent you a message.</span>
                                    </br><span class="ml-5">6:00 pm</span>
                                </div>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item py-4" href="#">
                                <div class="profile_img_in_chat-s ml-xl-4 ml-lg-3 ml-md-2 ml-2">
                                    <img class="img_set_to_div-s" src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/close-up-of-tulips-blooming-in-field-royalty-free-image-1584131603.jpg" alt="">
                                    <strong class="fg_green-s ml-2">Themer</strong> <span> invite you to join the game.</span>
                                    </br><span class="ml-5">2:00 pm</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>  --}}
            </div>
        </div>

        <!-- container - start -->

        <div class="container-fluid bg-white br_47px-s mh_86vh-s">
            <div class="row py-3 px-xl-3">
                <div class="col-12 py-2">

                    <div class="card home_card br_1_5rem-s">
                        {{--  <div class="heart_icon fs_32px-s">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </div>  --}}
                        {{--  {{ dd($singleProfile) }}  --}}
                        <div class="card-body pt-4 pb-3 px-1">
                            <div class="container-fluid px-xl-0">
                                <div class="row px-xl-4">
                                    <div class="col-xl-1 col-md-2 col-3">
                                        {{--  <img src="assets/images/Group 24.png" alt="">  --}}
                                        <img src="{{ $singleProfile->profile_image != null ? asset($singleProfile->profile_image) : asset('assets/images/Group 24.png')}}" class="rounded-circle b_5px-s shadow" width="75" height="75" alt="player img">

                                    </div>
                                    <div class="col-xl-10 col-9 ">
                                        <div class="row ">
                                            <div class="col-xl-3 col-md-6 col-6 ">
                                                <div class="text-white">
                                                    <h4 class="mb-0">{{ $singleProfile->first_name }} {{ $singleProfile->last_name }}</h4>
                                                    <span class=" opacity_4-s fs_14px-s">@ {{ $singleProfile->username }}</span>
                                                    <p class="fg_yellow-s mb-2 fs_11px-s">
                                                        @php
                                                        $empty_rating = 5 - round($singleProfile->rating);
                                                        @endphp
                                                        @for ($i = 0; $i < round($singleProfile->rating); $i++)
                                                            <i class="fas fa-star fs_11px-s" aria-hidden="true">  </i>
                                                        @endfor
                                                        @for ($i = 0; $i < $empty_rating; $i++)
                                                            <i class="far fa-star fs_11px-s" aria-hidden="true">  </i>
                                                        @endfor
                                                        {{ round($singleProfile->rating) }}
                                                        {{-- <span class="rating_textt"> {{ $singleProfile->rating }} </span> --}}
                                                    </p>

                                                </div>

                                            </div>





                                           <div class="col-xl-3 col-md-6 col-6 aditya_location">
                                                <h6 class="mb-0 pb-0 may-now-update-text">
                                                    {{-- <i class="fa fa-map-marker" aria-hidden="true"></i> --}}
                                                    <img src="{{ asset('assets/images/location_pin.svg') }}" class="" alt="location">
                                                    {{-- <span class="fs_12px-s">Jaber Al-Ahmad International Stadium</span> --}}
                                                <span class="fs_12px-s">  {{ \Illuminate\Support\Str::limit($singleProfile->address->address ?? 'no address', 50, $end='...') }}, </span>

                                                <span class="opacity_4-s fs_11px-s">
                                                    <span class="fs_12px-s">  {{ $singleProfile->address->city }} </span>
                                                    </span>

                                                </h6>

                                            </div>




                                            <div class="col-xl-6 col-12 pb-xl-0 pb-2 d-flex justify-content-between">
                                                <div class="">
                                                    <h4 class="text-white mb-0"> $ {{ $singleProfile->price }}</h3>
                                                        <span class="opacity_4-s text-white fs_11px-s">Match Amount</span>
                                                </div>
                                                <div class="text-right">
                                                    <strong class="text-white fs_18px-s">{{ $singleProfile->position }}</strong>
                                                </div>
                                            </div>



                                        </div>
                                    </div>



                                </div>
                            </div>
                            <hr class="goalkeeper_margin_b mt-0 mb-2 mx-xl-4 mx-3">


                         <!--
                            <div class="aditya_location mx-xl-4 mx-3">
                                <h6 class="mb-0 pb-0">
                                    {{-- <i class="fa fa-map-marker" aria-hidden="true"></i> --}}
                                    <img src="{{ asset('assets/images/location_pin.svg') }}" class="" alt="location">
                                    {{-- <span class="fs_12px-s">Jaber Al-Ahmad International Stadium</span> --}}
                                <span class="fs_12px-s">  {{ \Illuminate\Support\Str::limit($singleProfile->address->address ?? 'no address', 50, $end='...') }} </span>

                                </h6>
                                <span class="opacity_4-s fs_11px-s">
                                <span class="fs_12px-s">  {{ $singleProfile->address->city }} </span>
                                </span>
                            </div>-->



                        </div>
                    </div>
                </div>

            </div>
                @if ($singleProfile->card == null)
                    <h3 class="text-center">No Merchant Account Added</h3>
                @else
                    <div class="row py-3 px-xl-3 text-center">

                            <div class="col-12 payment_method_box">
                                <h3><strong>Payment Method</strong></h3>
                                <form action="{{ route('send_payment', [$invitation_uuid, $singleProfile->price]) }}" method="post"class="w-100">
                                    @csrf
                                    <div class="col-12 mt-3 px-3 px-md-5">
                                        {{--  <div class="dropdown">
                                            <button class="btn bg-white br_10px-s border br_green_on_hover-s fg_light_grey-s py-3 fs_18px-s dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Dropdown button
                                            </button>
                                            <div class="dropdown-menu dropdown_items_hover-s " aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="javascript:void(0)">Action</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                                            </div>
                                        </div>  --}}
                                        <!-- <div class="form-group">
                                            <select class="form-control" name="payment_method" id="select_payment_mothod-d">
                                            <option value="Bookeey">Bookeey</option>
                                            <option value="knet">knet</option>
                                            <option value="credit">credit</option>
                                            <option value="amex">amex</option>
                                            </select>
                                        </div> -->
                                        <div class="form-check justify-content-between d-flex pl-0">
                                            <input class="form-check-input radio-inline mb-5 mr-3 " type="radio" name="payment_method" id="bookeey-d" value="Bookeey">
                                            <label for="bookeey-d" class="form-check-label radio_label-s d-flex  mt-lg-0 mt-2 ">
                                                <span class=" pl-1 fs_14px-s"> <strong>Bookeey</strong> </span>
                                            </label>
                                            <input class="form-check-input radio-inline mb-5 mr-3 " type="radio" name="payment_method" id="knet-d" value="knet">
                                            <label  for="knet-d" class="form-check-label radio_label-s d-flex   mt-lg-0 mt-2  ">
                                                <span class=" pl-1 fs_14px-s"> <strong>Knet</strong> </span>
                                            </label>
                                            <input class="form-check-input radio-inline mb-5 mr-3 " type="radio" name="payment_method" id="credit-d" value="credit" >
                                            <label  for="credit-d" class="form-check-label radio_label-s d-flex  mt-lg-0 mt-2 ">
                                                <span class=" pl-1 fs_14px-s"> <strong>Credit</strong> </span>
                                            </label>
                                            <input class="form-check-input radio-inline mb-5 mr-3 " type="radio" name="payment_method" id="amex-d" value="amex">
                                            <label for="amex-d" class="form-check-label radio_label-s d-flex  mt-lg-0 mt-2">
                                                <span class=" pl-1 fs_14px-s"> <strong>Amex</strong> </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12  mt-4">
                                        <input type="hidden" name="price">
                                        <button type="submit" class="btn bg_green-s text-white px-5 py-2">SEND</button>
                                    </div>
                                </form>
                            </div>
                            {{--  {{ dd(Auth::user()->profile->card->Ibn_no) }}  --}}


                    </div>
                @endif
        </div>

        <!-- container - end -->

    </div>
@endsection
