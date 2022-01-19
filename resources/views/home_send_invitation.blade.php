@extends('layout.app')

@section('content')

<style>
    .pignose-calendar{
        -webkit-box-shadow: none  !important;
    }
</style>

      <!-- .................Home Page Sent Invitation  Start ......................... -->

        <div class="container-fluid px-0 mx-0 ">
        <div id="loader" class='loader_container-s align-self-center d-none w-100 justify-content-center' style="">
            <img class='align-self-center' width='200' height="200" src="{{ asset('assets/images/logo_gif.gif') }}">
        </div>
            <div class="container-fluid px-xl-5 px-3">
                <div class="row pt-4 pb-3">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-12 d-flex order-md-1 order-2">
                        {{--  <a class="td_none-s" href="{{ url('home') }}">
                            <h4 class="pr-2 text-dark">Home</h4>
                        </a>
                        <h4 class="px-2 mt-0"><strong>/</strong></h4>  --}}
                        <h4 class="fg_green-s fs_sm_21px-s pl-2 mt-0">Sent Invitations</h4>
                    </div>
                </div>
            </div>
            </nav>
            <!-- .................Home Page Sent Invitation Page NavBar End ......................... -->
               <div class="align-self-center">
                    @if(session()->has('invitation_error'))
                        <div class="alert alert-danger">
                            {{ session()->get('invitation_error') }}
                        </div>
                    @endif
            </div>
            <!-- .................Home Page Sent Invitation Section One Start ......................... -->
            <form action="{{ route('getSignleUser', $user->uuid) }}" id="frm_send_invitaion-d" method="post">
                @csrf
                <div class="container-fluid bg-white br_47px-s mh_86vh-s">
                    <div class="row pt-3 px-xl-5 px-3 ">
                        <div class="col-xl-4 col-lg-6 col-md-12 col-12 h_710px-s border br_15px-s border_grey-s mt-3">
                            <div class="container">
                                <div class="row pt-4">
                                    <div class="col-12">
                                        <div class="card home_card card_bg_img-s br_25px-s">
                                            <div class="heart_icon">
                                            @if($user->profile->is_my_fav == 1)
                                            <a href="{{ route('favorite',[$user->profile->uuid,0]) }}">
                                                <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                            @else
                                            <a href="{{ route('favorite',[$user->profile->uuid,1]) }}">
                                                <i class="far fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                            @endif
                                            </a>
                                            </div>
                                            <div class="container mt_30px-s">
                                                <div class="row mx-auto">
                                                    <div class="col-lg-3 col-md-3 col-3">
                                                        <a href="{{ route('othersProfile', [$user->uuid, $user->profile->uuid, $user->profile->id]) }}">
                                                            <img class="rounded-circle profile_img border_white-s" src="{{ asset($user->profile->profile_image) }}" width="50" height="50"  alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-9 pl-md-0">
                                                        <div class="text-white">
                                                            <a class = "text-white td_none-s" href="{{ route('othersProfile',[$user->uuid, $user->profile->uuid, $user->profile->id]) }}">
                                                                <h6 class="mb-0">{{ $user->profile->first_name }}</h6>
                                                            </a>
                                                            <span class=" opacity_4-s fs_12px-s">@ {{ $user->profile->username }}</span>
                                                            <p class="fg_yellow-s mb-1">

                                                                @php
                                                                    $empty_rating = 5 - round($user->profile->rating);
                                                                    // var_dump($empty_rating, $user->profile->rating);
                                                                @endphp
                                                                {{-- @for ($i = 0; $i < $user->profile->rating +1; $i++) --}}
                                                                @for ($i = 0; $i < round($user->profile->rating); $i++)
                                                                    <i class="fas fa-star fs_11px-s" aria-hidden="true">  </i>
                                                                @endfor
                                                                @for ($i = 0; $i < $empty_rating; $i++)
                                                                    <i class="far fa-star fs_11px-s" aria-hidden="true">  </i>
                                                                @endfor
                                                                {{ number_format($user->profile->rating , 1) }}
                                                                <span class="rating_textt"> ${{ $user->profile->price }} </span>



                                                                {{--  @for ($i = 0; $i < $user->profile->rating +1; $i++)
                                                                    <i class="far fa-star fs_11px-s" aria-hidden="true">  </i>
                                                                @endfor  --}}
                                                                {{-- <i class="fa fa-star-o fs_11px-s" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o fs_11px-s" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o fs_11px-s" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o fs_11px-s" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o fs_11px-s" aria-hidden="true"></i> 5.0 --}}
                                                                {{--  <span class="rating_textt"> ${{ $user->profile->price ?? 0 }} </span>  --}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pt-3 mx-auto">
                                                    <div class="col-3 text-white  pr-0 fs_10px-s">
                                                        <span class="opacity_4-s">Age</span>
                                                        <br>
                                                        <span class="fs_10px-s">{{  \Carbon\Carbon::parse($user->profile->dob)->age }}</span>
                                                    </div>
                                                    <div class="col-3 text-white  px-0 fs_10px-s">
                                                        <span class="opacity_4-s">Matches</span>
                                                        <br>
                                                        <span class="fs_10px-s">{{ $user->profile->played_matches != null ? $user->profile->played_matches : 0}}</span>
                                                    </div>
                                                    <div class="col-3 text-white  px-0 fs_10px-s">
                                                        <span class="opacity_4-s">Missed</span>
                                                        <br>
                                                        <span class="fs_10px-s">{{ $user->profile->missed_matches   != null ? $user->profile->missed_matches   : 0}}</span>
                                                    </div>
                                                    <div class="col-3 text-white  pl-0 fs_10px-s">
                                                        <span class="opacity_4-s">Postition</span>
                                                        <br>
                                                        <span class="fs_10px-s">{{ $user->position }}</span>
                                                    </div>
                                                </div>
                                                <hr class="goalkeeper_margin_b mx-3 mb-1" />

                                                <div class="row mx-auto aditya_location">
                                                    <div class="col-12 mb-3">
                                                    <img src="{{ asset('assets/images/location_pin.svg') }}" class="" alt="location">
                                                        <span class="fs_11px-s ">
                                                            <!-- <i class=" fa fa-map-marker" aria-hidden="true"></i> -->
                                                            {{ \Illuminate\Support\Str::limit($user->profile->address->address ?? 'no address', 15, $end='...') }}

                                                             {{-- {{ $user->profile->address->address ?? 'No address available' }} --}}
                                                        </span>
                                                    </div>
                                                    <div class="col-6 px-0">
                                                        {{-- <a class="td_none-s text-white fs_11px-s" href="{{ url('home_send_invitation') }}">
                                                            <span class="pull-right text-white"> send invitation >> </span>
                                                        </a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-5">
                                    <div class="col-12 d-flex justify-content-between responsive-class">
                                        <div >
                                            <h5 class="text-left opacity_4-s fs_18px-s">Date</h5>
                                                <div class="fs_18px-s py-2 pl-2 pr-4 border rounded"  ><strong class="select_invitation_date-d " data-toggle="modal" data-target="#exampleModal" >
                                                    {{-- {{ \Carbon\Carbon::now()->format('d/m/Y')}} --}}
                                                    dd/mm/yyyy
                                                </strong>
                                            </div>
                                            <span class="d-none select_date-d text-danger fs_14px-s mt-2">Select date from calender</span>
                                            <input type="hidden" name="date" class="input_select_invitation_date-d" value="" >
                                        </div>
                                        <div class="input_top_space">
                                            <h5 class="text-left opacity_4-s fs_18px-s">Time</h5>
                                            <div class="fs_18px-s py-2 pl-2 pr-4 border rounded jpg_back" id="onclicks">
                                                <strong>
                                                    <input type="time" name="invitation_time" id="top-space" class="invitation_time-d font-weight-bold border-0 custom-div" placeholder="000:AM">
                                                </strong>
                                            </div>
                                            <span class="d-none select_invitation_time-d text-danger fs_14px-s mt-2">Select time </span>
                                            {{-- <div class="fs_18px-s py-2 pl-2 pr-5 border rounded" >
                                                <strong class="invitation_time-d">00</strong>:<strong class="mints_time-d"> 00</strong><strong class="AM_PM_time-d"></strong>
                                            </div>

                                            <span class="d-none select_time-d text-danger fs_14px-s mt-2">Select time </span>
                                            <span class="d-none select_hours-d text-danger fs_14px-s mt-2">Hours Required</span>
                                            <span class="d-none select_mins-d text-danger fs_14px-s mt-2">Time Required</span>

                                            <input type="hidden" name="select_hours" class="input_invitation_time-d" value="">
                                            <input type="hidden" name="select_mins" class="input_mints_time-d" value = "">
                                            <input type="hidden" name="select_am_pm" class="input_AM_PM_time-d" value=""> --}}
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="text-left opacity_4-s fs_18px-s">Stadium</h5>
                                            <a href="#" data-toggle="modal" data-target="#add_stadium_modal-d">
                                                <span class="fg_green-s fs_11px-s">+ Add New Stadium</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2 backround-img">
                                        @if (isset($userStadiums) && ([] != $userStadiums))
                                        {{-- {{ dd($userStadiums) }} --}}
                                        <label for="">Choose a stadium:</label>

                                            <select  name="stadium_uuid" class="form-control pl-0">
                                                @foreach ($userStadiums as $stadium)
                                                    <option class="select_stadium-d " value="{{ $stadium->uuid }}">{{ $stadium->name }}</option>
                                                @endforeach
                                            </select>

                                        @else

                                        <p class="fs_!8px-s"><strong>No Stadium Available</strong></p>
                                        @endif
                                        <span class="stadium_error-d text-danger fs_14px-s d-none mt-2">Add Stadium</span>
                                    </div>
                                    <div class="col-12 mt-4 ">
                                        <div class="d-flex justify-content-between  bg_grey-s br_10px-s p-3">
                                            <div class="text-center">
                                                <span class="opacity_4-s fs_14px-s fs_sm_10px_invitation-s">Subtotal</span>
                                                <h5><strong><span>$</span>{{ $user->profile->price }}</strong></h5>
                                            </div>
                                            <div class="text-center">
                                                <span class="opacity_4-s fs_14px-s fs_sm_10px_invitation-s">Invitation Fees</span>
                                                <h5><strong>25%</strong></h5>
                                            </div>
                                            @php
                                                $total =  $user->profile->price;
                                                $discount = 25;
                                                $subtotal = round((($discount * $total)/100 + $total), 2);
                                            @endphp
                                            <div class="text-center">
                                                <span class="opacity_4-s fs_14px-s fs_sm_10px_invitation-s">Total Amount</span>
                                                <h5><strong><span>$</span>{{ $subtotal }}</strong></h5>
                                                <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        {{--  <button type="submit" class="btn btn-lg my-0 btn_send w-100"  ><h5 class="mt-2">SEND</h5></button>  --}}
                                        {{-- <button type="button" class="btn btn-lg my-0 btn_send w-100" data-toggle="modal" data-target="#send_invitation_modal-d" ><h5 class="mt-2">SEND</h5></button> --}}
                                        <button type="button" class="btn btn-lg my-0 btn_send w-100 open_send_invitation_modal-d" ><h5 class="mt-2">SEND</h5></button>
                                        <input type="hidden" name="player_uuid" value="{{ $user->profile->uuid }}">
                                        <input type="hidden" name="price" value="{{ $user->profile->price ?? 0 }}">
                                        <input type="hidden" name="discount" value=25>
                                    </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="send_invitation_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered ">
                                                <div class="modal-content br_10px-s border-0">
                                                    <div class="container-fluid">
                                                        <!--header image-->
                                                        <div class="row modal-header border-0 mt-5">
                                                            <div class="col-12 text-center">
                                                                <img src="{{ asset('assets/images/invitation.svg') }}" width="130" alt="send invitation">
                                                            </div>
                                                        </div>
                                                        <!--header image end-->

                                                        <div class="row modal-body ">
                                                            <!--modal text-->
                                                            <div class="col-12 text-center">
                                                                <h4 class="fg_green-s">SEND INVITATION</h4>
                                                                <h6><strong>Are you sure you want to send this invitation?</strong></h6>
                                                            </div>
                                                            <!--modal text end-->

                                                            <!--player info-->
                                                            <div class="mt-3 col-12">
                                                                <span class="opacity_4-s"><strong>Player</strong></span>
                                                                <div class="d-flex justify-content-between border px-2 py-3 br_10px-s">
                                                                    <div class="d-flex justify-content-between">
                                                                        <div>
                                                                            <img src="{{ asset($user->profile->profile_image) }}" class="rounded-circle border_white-s shadow profile_img" width="70" height="70" alt="player img">
                                                                        </div>
                                                                        <div class="ml-2 text-left">
                                                                            <h6 class="fg_green-s mb-0">{{ $user->profile->first_name }} {{ $user->profile->last_name }}</h6>
                                                                            <a href="javascript:void(0)" class="opacity_4-s text-dark">@ {{ $user->profile->username }}</a>
                                                                            <div class="fg_yellow-s">
                                                                                @php
                                                                                    $empty_rating = 5 - round($user->profile->rating);
                                                                                    // var_dump($empty_rating, $user->profile->rating);
                                                                                @endphp
                                                                                {{-- @for ($i = 0; $i < $user->profile->rating +1; $i++) --}}
                                                                                @for ($i = 0; $i < round($user->profile->rating); $i++)
                                                                                    <i class="fas fa-star fs_11px-s" aria-hidden="true">  </i>
                                                                                @endfor
                                                                                @for ($i = 0; $i < $empty_rating; $i++)
                                                                                    <i class="far fa-star fs_11px-s" aria-hidden="true">  </i>
                                                                                @endfor
                                                                                {{ number_format($user->profile->rating, 1) }}
                                                                                <span class="rating_textt"> ${{ $user->profile->price }} </span>

                                                                                {{--  <img class="star_img-s" src="assets/images/yellow_star.svg" alt="star img">
                                                                                <img class="star_img-s" src="assets/images/yellow_star.svg" alt="star img">
                                                                                <img class="star_img-s" src="assets/images/yellow_star.svg" alt="star img">
                                                                                <img class="star_img-s" src="assets/images/half_star.svg" alt="star img">
                                                                                <img class="star_img-s" src="assets/images/grey_star.svg" alt="star img">
                                                                                <span class="rating_star-d fs_10px-s fg_yellow-s">3.5</span>  --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-right align-self-center">
                                                                        <h6 class=""><strong>{{ $user->position }}</strong></h6>
                                                                        <span class="opacity_4-s">Position</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--player info-->

                                                            <!--amount pay-->
                                                            <div class="col-12 mt-4">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="opacity_4-s">Amount to pay</div>
                                                                    <div>
                                                                        <img src="" alt="">
                                                                        <span><strong>${{ $subtotal }}</strong></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--amount pay end-->
                                                        </div>
                                                        <div class="row px-3 pt-3 pb-5">
                                                            <!--NO button-->
                                                            <div class="col-6 pr-2">
                                                                <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>No</strong></button>
                                                            </div>
                                                            <!--NO button end-->

                                                            <!--YES button-->
                                                            <div class="col-6 pl-2">
                                                                <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white w-100" id="send_invition-d"><strong>Yes</strong></button>
                                                            </div>

                                                            <input type="hidden" name="player_uuid" value="{{ $user->profile->uuid }}">
                                                            <input type="hidden" name="price" value="{{ $user->profile->price ?? 0 }}">
                                                            <input type="hidden" name="discount" value=25>
                                                            <!--YES button end-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-xl-4 col-lg-6 col-md-6 col-12 mt-3">
                            <div class="container">
                                <div class="row">
                                    <div class=" col-12 px-0 celender_bg">

                                        <div id="" class="">
                                            <div class="calendar"></div>
                                        </div>


                                        <!-- <main class="h_444px-s">
                                            <div class="calendar-wrapper" id="calendar-wrapper"></div>
                                        </main> -->


                                    </div>


                                    <div class="col-12 px-4 bg_lightgrey-s br_15px-s mt-4 ">
                                        <div class="d-flex justify-content-between pt-4">
                                            <span class="fs_14px-s fs_sm_10px_invitation-s"><strong>Select Time</strong></span>
                                            <div>
                                                <span class="text-white bg_green-s fs_12px-s py-2 rounded-pill px-4" id="pm-d">PM</span>
                                                <span class=" fg_green-s bg_grey-s fs_12px-s py-2 rounded-pill px-4" id="am-d">AM</span>
                                            </div>
                                        </div>
                                        <div class="row pt-5 pb-3 ">
                                            <div class="col-lg-6 col-md-6">

                                                    <div class="form-group ">
                                                        <label for="hours" class="fs_12px-s">Hours</label>
                                                        <input type="number" class="form-control br_5px-s invitation_hours-d spinner_remove-s" min="0" max="12"  name="hours" placeholder="" required>
                                                    </div>

                                            </div>

                                            <div class="col-lg-6 col-md-6">

                                                    <div class="form-group">
                                                        <label for="minutes" class="fs_12px-s">Minutes</label>
                                                        <input type="number" class="form-control br_5px-s invitation_minutes-d spinner_remove-s" min="0" max="60" name="minutes" placeholder="" required>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-8 mt-3">
                            <div id="googleMap" style="width:100%;height:95%;">

                            </div>

                            <script>
                            function myMap() {
                                var mapProp= {
                                    center:new google.maps.LatLng(51.508742,-0.120850),
                                    zoom:5,
                                    mapId: '839cfe9e63bd66c5'

                                };
                                var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

                                //  for (const elm of document.getElementsByClassName("auto_address-d")) {

                                //     // Array.prototype.forEach.call(auto_complete_addresses, function(index, elm){
                                //     // const input = document.getElementById("address");
                                //     const input = document.getElementById(elm.id);

                                //     const searchBox = new google.maps.places.SearchBox(input);
                                //     // Listen for the event fired when the user selects a prediction and retrieve
                                //     // more details for that place.

                                //     searchBox.addListener("places_changed", () => {
                                //         const places = searchBox.getPlaces();
                                //         // console.log(places);

                                //         if (places.length == 0) {
                                //             return;
                                //         }

                                //         const formElm = input.closest('form');

                                //         let latElm = '#' + formElm.id + ' #lat';
                                //         let latElms = document.querySelectorAll(latElm);

                                //         let longElm = '#' + formElm.id + ' #lng';
                                //         let longElms = document.querySelectorAll(longElm);

                                //         latElms[0].value = places[0].geometry.location.lat();
                                //         longElms[0].value = places[0].geometry.location.lng();

                                //     });
                                // }

                            }



                            </script>

                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9lN0B2EalTvLS_dNDWE1BmCBKLTDZxsI&callback=myMap&libraries=places&v=weekly"></script>
                            {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9lN0B2EalTvLS_dNDWE1BmCBKLTDZxsI&callback=myMap&libraries=places&v=weekly"></script> --}}
{{--
                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAA30PBYsbK3JmoF-Gd2vjPcNDNGyNM8TU&callback=myMap">

                            </script> --}}
                            {{-- <script>
                                function initAutocomplete() {
                                // Create the search box and link it to the UI element.
                                // let auto_complete_addresses = document.getElementsByClassName('auto_address-d');
                                for (const elm of document.getElementsByClassName("auto_address-d")) {

                                    // Array.prototype.forEach.call(auto_complete_addresses, function(index, elm){
                                    // const input = document.getElementById("address");
                                    const input = document.getElementById(elm.id);

                                    const searchBox = new google.maps.places.SearchBox(input);
                                    // Listen for the event fired when the user selects a prediction and retrieve
                                    // more details for that place.

                                    searchBox.addListener("places_changed", () => {
                                        const places = searchBox.getPlaces();
                                        // console.log(places);

                                        if (places.length == 0) {
                                            return;
                                        }

                                        const formElm = input.closest('form');

                                        let latElm = '#' + formElm.id + ' #lat';
                                        let latElms = document.querySelectorAll(latElm);

                                        let longElm = '#' + formElm.id + ' #lng';
                                        let longElms = document.querySelectorAll(longElm);

                                        latElms[0].value = places[0].geometry.location.lat();
                                        longElms[0].value = places[0].geometry.location.lng();

                                    });
                                }
                            }
                            </script> --}}

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- .................Home Page Sent Invitation  NavBar Start ......................... -->


        <!-- .................Home Page Sent Invitation Section One End ......................... -->


    <!-- Modal -->
    <div class="modal fade" id="add_stadium_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row modal-header br_up_left_right_10px-s border-0 bg_grey-s">
                        <div class="col-12 mt-2">
                            <h4><strong>ADD STADIUM</strong></h4>
                        </div>
                    </div>
                    <!--modal header end-->
                    <form action="{{ route('addNewStadium') }}" id="frm_new_stadium-d" method="post" >
                        @csrf
                        <div class="row modal-body justify-content-center pt-5 pb-0">
                            <div class="col-12">
                                    <!--add stadium-->
                                    <div class="form-group">
                                        <!--ADD STADIUM-->
                                        <label for="" class=""><strong>STADIUM NAME</strong></label>
                                        <input type="text" name="name" placeholder="Write Stadium Name" class="form-control rounded form-control-xl py-4 ">
                                    </div>
                                    <!--add stadium end-->

                                    <!--Add LOCATION-->
                                    <div class="form-group pt-3">
                                        <label for="p-address1" class=""><strong>LOCATION</strong></label>
                                        <input type="text" name="address" id="p-address1" placeholder="Write Address of Stadium" class="form-control rounded form-control-xl py-4 auto_address-d ">
                                        {{-- <input name="lat" type="hidden" id="lat" value="">
                                        <input name="lng" type="hidden" id="lng" value=""> --}}
                                    </div>
                                    <!--Add LOCATION end-->
                            </div>

                            <!--suggested stadium text-->
                            <div class="col-9 mt-5 text-center">
                                <p class="opacity_4-s"><strong>Your suggested stadium will be listed once it is approved.</strong></p>
                            </div>
                            <!--suggested stadium text end-->
                        </div>

                        <div class="row px-3  pb-5">
                            <!--CANCEL button-->
                            <div class="col-6 pr-2">
                                <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                            </div>
                            <!--CANCEL button end-->

                            <!--SUBMIT button-->
                            <div class="col-6 pl-2">
                                <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white w-100"><strong>SUBMIT</strong></button>
                            </div>
                            <input type="hidden" name="profile_uuid" value="{{ Auth::user()->profile->uuid }}">
                            <!--SUBMIT button end-->
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



      <!-- Button trigger modal -->
            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Launch demo modal
            </button> --}}

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="col-12 mt-3">
                            <div class="container">
                                <div class="row">
                                    <div class=" col-12 px-0 celender_bg">

                                        <div id="" class="">
                                            <div class="calendar"></div>
                                        </div>


                                        <!-- <main class="h_444px-s">
                                            <div class="calendar-wrapper" id="calendar-wrapper"></div>
                                        </main> -->


                                    </div>



                                </div>
                            </div>
                        </div>
                </div>
            </div>
            </div>

@endsection
