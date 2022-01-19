@extends('layout.app')

@section('content')
 {{--  <div id="loader-notification" class='loader_container-s align-self-center d-none w-100 justify-content-center' style="">
        <img class='align-self-center' width='200' height="200" src="{{ asset('assets/images/logo_gif.gif') }}">
    </div>  --}}

<script>
    // function myMap() {
    //     var mapProp = {
    //       center:new google.maps.LatLng(51.508742,-0.120850),
    //       zoom:5,
    //     };
    //     var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    // }
</script>

    {{--  {{ dd($allUsers) }}  --}}
    @if (isset($notiData))
        {{ dd("ok", $notiData) }}
    @endif

        {{--  {{ dd("ok", $notiData) }}  --}}

    <!-- .................Home Page Start ......................... -->
    <div class="container-fluid px-0 mx-0 ">

        <!-- -------heading container - start -->
        <div class="container-fluid">
            <div class="row py-3 px-xl-5">
                <div class="col-md-5 col-12 pt-4">
                    <h1 class=""><strong>Hello, {{ Auth::user()->profile->first_name }}</strong></h1>
                    <h4 class="">Find a player for your team.</h4>
                    <h5 class="fg_green-s mt-3 text-left">
                        <strong>{{\Carbon\Carbon::now()->format('l')}}, {{\Carbon\Carbon::now()->format('d M Y')}}
                        </strong>
                    </h5>
                </div>
                {{-- {{ dd(Auth::user()) }} --}}
                <div class="col-md-7 col-12 pt-4 d-flex justify-content-end">
                    <div class="w_500px-s">
                        <div class="card card_slider">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block img-fluid mx-auto" src="{{ asset('assets/images/Image 2.png') }}" alt="First slide" />
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block img-fluid mx-auto" src="{{ asset('assets/images/Image 2.png') }}" alt="Second slide" />
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block img-fluid mx-auto" src="{{ asset('assets/images/Image 2.png') }}" alt="Third slide" />
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ------heading container - end -->
        {{-- success message for invitation --}}
            <div class="align-self-center">
                    @if(session()->has('success_invitation'))
                        <div class="alert alert-success">
                            {{ session()->get('success_invitation') }}
                        </div>
                    @endif
            </div>



        <!-- .................Home Page Button Group Section End ......................... -->

       <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row btn_grp pt-5 d-flex d-md-flex justify-content-between fixes_for_positions_button-s pb-0 mr-xl-3 mr-lg-3 mb_25px-s text-center">
                    <div class="col-12 col-md-6 col-lg-2 col-xl-2">
                        <a href="{{ route('home') }}">
                        {{--  {{dd($position)}}  --}}
                        <button class="btn btn-lg mb-0 mt-3 mx-1 player_position_button-s  w_100_on_sm-s {{ $position == '' ? ' active_position-s' : ''  }}">
                            <span class="child">All positions</span>
                        </button>
                    </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-2 col-xl-2">
                        <a href="{{ route('home','goalkeeper') }}">
                        <button class="btn btn-lg mb-0 mt-3 mx-1 player_position_button-s w_100_on_sm-s text-dark {{ $position == 'goalkeeper' ? ' active_position-s ' : ''  }} "><span class="child"> Goalkeeper</span></button>
                    </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-2 col-xl-2">
                        <a href="{{ route('home','defender') }}">
                        <button class="btn btn-lg mb-0 mt-3 mx-1 player_position_button-s w_100_on_sm-s {{ $position == 'defender' ? ' active_position-s' : ''  }} "><span class="child">Defender</span></button>
                    </a>
                    </div>
                   <div class="col-12 col-md-6 col-lg-2 col-xl-2">
                        <a href="{{ route('home','midfielder') }}">
                        <button class="btn btn-lg mb-0 mt-3 mx-1 player_position_button-s w_100_on_sm-s {{ $position == 'midfielder' ? ' active_position-s' : ''  }} "><span class="child">Midfielder</span></button>
                    </a>
                   </div>
                    <div class="col-12 col-md-12 col-lg-2 col-xl-2 text-center">
                        <a href="{{ route('home','forward') }}">
                        <button class="btn btn-lg mb-0 mt-3 mx-1 player_position_button-s w_100_on_sm-s  {{ $position == 'forward' ? ' active_position-s' : ''   }}"><span class="child">Forward</span></button>
                    </a>
                    </div>
                </div>
            </div>
        </div>
       </div>
        <!-- .................Home Page Button Group Section End ......................... -->
        <!-- container for list of players - start -->
        <div class="container-fluid bg-white br_47px-s">
            <div class="row py-5 px-xl-5">
                <div class="col-12 min_h_340px-s py-3">
                    <div class="row">
                        <div class="col-6 text-left py-1">
                            <h5 class="text-left">
                                <strong>Players</strong>
                                    @if (isset($allUsers) && (' ' != $allUsers))
                                        <strong>({{ count($allUsers) > 0 ? count($allUsers) : 0 }})</strong>
                                    @endif

                                    @if (isset($filterRating) && (' ' != $filterRating))
                                        <strong>({{ count($filterRating) > 0 ? count($filterRating) : 0 }})</strong>
                                    @endif
                            </h5>
                        </div>
                        <div class="col-6">
                            <div class="float-right filter_img d-flex flex-wrap">
                                <a href="" data-toggle="modal" data-target="#option_of_filter_modal-d">
                                    <img class="mb-2" src="{{ asset('assets/images/filter.svg') }}" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        @if (isset($allUsers) && (NULL != $allUsers))

                             {{-- {{ dd($allUsers) }} --}}
                            @foreach ($allUsers as $user)
                                @if ((Auth::user()->email == $user->email) || ($user->user_type == 'admin'))
                                    {{--  <h3>same user </h3>  --}}
                                @else
                                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 py-2 px-1">
                                        <div class="card home_card {{ $user->profile->my_request == 1 ? 'card_bg_img-s' : '' }}  br_25px-s">
                                                <div class="heart_icon">
                                                        @if($user->profile->is_my_fav == 1)
                                                    <a href="{{ route('favorite',[$user->profile->uuid,0]) }}">
                                                        <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                        @else
                                                    <a href="{{ route('favorite',[$user->profile->uuid,1]) }}">
                                                        <i class="far fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                        @endif
                                                    </a>
                                                    {{-- {{dd(Auth::User()->profile)}} --}}

                                                </div>
                                            <div class="container mt_30px-s">
                                                <div class="row mx-auto {{$user->profile->is_my_fav == 0 ? '': '' }}">
                                                    <div class="col-lg-3 col-md-3 col-3  justify-center">
                                                        <a href="{{ route('othersProfile', [$user->uuid, $user->profile->uuid, $user->profile->id]) }}">
                                                            <img class="rounded-circle profile_img border_white-s" src="{{ asset($user->profile->profile_image) }}" width="50" height="50"  alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-9 ">
                                                        <div class="text-white">
                                                            <h6 class="mb-0">
                                                                 <a class = "text-white td_none-s" href="{{ route('othersProfile',[$user->uuid, $user->profile->uuid, $user->profile->id]) }}">
                                                                    {{ $user->profile->first_name }} {{ $user->profile->last_name }}
                                                                 </a>
                                                            </h6>

                                                            <span class=" opacity_4-s fs_11px-s">
                                                            <strong>@</strong>{{ $user->profile->username }}
                                                            </span>
                                                            {{-- {{ dd($user->profile) }} --}}
                                                            <p class="fg_yellow-s fs_11px-s mb-1">
                                                                @php
                                                                    $empty_rating = 5 - round($user->profile->rating);
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
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mx-auto pt-3">
                                                    <div class="col-3 text-white  pr-0 fs_12px-s">
                                                        <span class="opacity_4-s">Age</span>
                                                        <br>
                                                        <span class="fs_12px-s">{{  \Carbon\Carbon::parse($user->profile->dob)->age }}</span>
                                                    </div>
                                                    <div class="col-3 text-white  px-0 fs_12px-s">
                                                        <span class="opacity_4-s">Matches</span>
                                                        <br>
                                                        <span class="fs_12px-s">{{ $user->profile->played_matches != null ? $user->profile->played_matches : 0 }}</span>
                                                    </div>
                                                    <div class="col-3 text-white  px-0 fs_12px-s">
                                                        <span class="opacity_4-s">Missed  </span>
                                                        <br>
                                                        <span class="fs_12px-s">{{ $user->profile->missed_matches != null ? $user->profile->missed_matches : 0 }}</span>
                                                    </div>
                                                    <div class="col-3 text-white  pl-0 fs_12px-s">
                                                        <span class="opacity_4-s">Position</span>
                                                        <br>
                                                        <span class="fs_position-s">{{ $user->position }}</span>
                                                    </div>
                                                </div>
                                                <hr class="goalkeeper_margin_b mx-3" />

                                                <div class="row mx-auto aditya_location">
                                                    <div class="col-6">
                                                        <img src="{{ asset('assets/images/location_pin.svg') }}" class="" alt="location">
                                                        <span class="fs_12px-s mb-0 pb-0">
                                                            <!-- <i class='fas fa-map-marker-alt mr-2'></i> -->
                                                            {{-- {{ $user->profile->address->address ?? 'no address' }} --}}
                                                            {{ \Illuminate\Support\Str::limit($user->profile->address->city ?? 'no address', 20, $end='...') }}
                                                            {{-- {{ $user->profile->address->address ?? 'no address' }} --}}
                                                        </span>
                                                    </div>
                                                    <div class="col-6 pl-0  m-0 text-right">
                                                        <a class="td_none-s text-white fs_12px-s pb-0" href="{{ route('getSignleUser', $user->uuid ) }}">
                                                            <span class="">
                                                                send invitation >>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="col-12 justify-content-end d-flex mb-2 pr-0">
                                                        <div>
                                                            @if ($user->profile->is_blocked_user == 0)
                                                                <a href="" data-toggle="modal" data-target="#report_issue_modal-d-{{ $user->profile->id }}">
                                                                    <img src="{{ asset('assets/images/empty_flag.svg') }}" class="img-responsive " width="20" height="20" alt="report flag">
                                                                </a>

                                                            @else
                                                                    <img src="{{ asset('assets/images/filled_flag.svg') }}" class="img-responsive " width="20" height="20" alt="report flag" data-toggle="tooltip" data-placement="top" title="Report">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                       <!-- Modal -->
                                        <div class="modal fade report_player_modal-d" id="report_issue_modal-d-{{ $user->profile->id }}" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered ">
                                                <div class="modal-content br_10px-s border-0">
                                                    <!--header image-->
                                                    <div class="modal-header bg_grey-s border-0 br_up_left_right_10px-s">
                                                        <h4 class="modal-title text-dark" id="view-head"><strong>REPORT ISSUES</strong></h4>
                                                    </div>
                                                    <!--header image end-->
                                                    {{-- <form action="" class="bocke_player-d" method="post">
                                                        @csrf --}}
                                                        <div class="container-fluid">
                                                            <div class="row modal-body">
                                                                <div class="col-12 error_msg-d d-none text-danger">
                                                                    <p class="">Please Select One Option</p>
                                                                </div>
                                                                <!--modal text-->
                                                                <div class="col-12 ">
                                                                    <h6 class="fg_darkgrey_s opacity_4-s">SELECT ISSUE</h6>

                                                                </div>
                                                                <div class="col-12 py-3 mt-2 bb_lightgrey-s bg_grey_on_hover-s report_options-d ">
                                                                    <h6 class="mb-0" >Spam</h6>
                                                                </div>
                                                                <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">Nudity and sexual activity</h6>
                                                                </div>
                                                                <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">Hate speech or symbols</h6>
                                                                </div>
                                                                <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">False Information</h6>
                                                                </div>
                                                                <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">Scam or fraud</h6>
                                                                </div>
                                                                <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">Bullying or harassment</h6>
                                                                </div>
                                                                <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">Violence or dangerous organizations</h6>
                                                                </div>
                                                                <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">Intellectual property violation</h6>
                                                                </div>
                                                                <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">Sale of illegal or regulated goods</h6>
                                                                </div>
                                                                <!-- <div class="col-12 py-3  bg_grey_on_hover-s report_options-d" >
                                                                    <h6 class="mb-0">Something else</h6>
                                                                    {{--  <br/>  --}}
                                                                    <textarea name="your_reason" class="your_reason-d form-control mt-3" id="message" cols="5 " rows="5"></textarea>
                                                                </div> -->

                                                                <!--modal text end-->
                                                            </div>
                                                            <div class="row px-3 pt-3 pb-5">
                                                                <!--cancel button-->
                                                                <div class="col-6 pr-2">
                                                                    <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal" ><strong>CANCEL</strong></button>
                                                                </div>
                                                                <!--cancel button end-->

                                                                <!--report button-->
                                                                <div class="col-6 pl-2">
                                                                    <button type="button" class="btn bg_green-s br_10px-s py-3 text-white w-100 block_player_by_user-d"><strong>REPORT</strong></button>
                                                                </div>
                                                                <input type="hidden" name="" class="blocker_id-d" value="{{ Auth::user()->profile->id }}">
                                                                <input type="hidden" name="" class="player_id-d" value="{{ $user->profile->id }}">
                                                                <!--report button end-->
                                                            </div>
                                                        </div>
                                                    {{-- </form> --}}
                                                </div>
                                            </div>
                                        </div>

                                @endif
                            @endforeach
                            @if(count($allUsers) == 0 )
                                <div class="mx-auto text-muted mt-5 pt-5">No Player </div>
                            @endif
                        @endif

                        @if (isset($filterRating) && (' ' != $filterRating))
                                 {{-- {{ dd($filterRating) }}; --}}

                                    @foreach ($filterRating as $profile_ratings)
                                        @if ((Auth::user()->email == $profile_ratings->user->email) || ($profile_ratings->user->user_type == 'admin'))
                                        {{--  <h3>same user </h3>  --}}
                                        @else

                                            <div class="col-12 col-md-6 col-lg-4 col-xl-3 py-2 px-1">
                                                {{-- card_bg_img-s to if sent invit  --}}
                                                <div class="card home_card {{$profile_ratings->my_request == 1 ? 'card_bg_img-s' : ''}} br_25px-s">
                                                        <div  class="heart_icon">
                                                            @if($profile_ratings->is_my_fav == 1)
                                                                <a href="{{ route('favorite',[$profile_ratings->uuid,0]) }}">
                                                                    <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                                    @else
                                                                <a href="{{ route('favorite',[$profile_ratings->uuid,1]) }}">
                                                                    <i class="far fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                                    @endif
                                                                </a>


                                                            {{-- <a href="{{ route('favorite',[$profile_ratings->uuid,1]) }}">
                                                                <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true">
                                                                </i>
                                                            </a> --}}
                                                        </div>
                                                    <div class="container mt_30px-s">
                                                        <div class="row mx-auto">
                                                            <div class="col-lg-3 col-md-3 col-3 justify-center">
                                                                <a href="{{ route('othersProfile', [$profile_ratings->user->uuid, $profile_ratings->uuid, $profile_ratings->id]) }}">
                                                                    <img class="rounded-circle profile_img border_white-s" src="{{ $profile_ratings->profile_image ?  asset($profile_ratings->profile_image) : asset('images/user-no-image.png') }} " width="50" height="50"  alt="" />
                                                                </a>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-9">
                                                                <div class="text-white">
                                                                    <h6 class="mb-0 ">
                                                                        <a class="text-white td_none-s" href="{{ route('othersProfile', [$profile_ratings->user->uuid, $profile_ratings->uuid, $profile_ratings->id]) }}">
                                                                            {{ $profile_ratings->first_name }} {{ $profile_ratings->last_name }}
                                                                        </a>
                                                                    </h6>
                                                                    <span class=" opacity_4-s fs_11px-s">
                                                                    <strong>@</strong>{{ $profile_ratings->username }}
                                                                    </span>
                                                                    <p class="fg_yellow-s fs_11px-s mb-1">

                                                                            @php
                                                                                $empty_rating = 5 - round($profile_ratings->rating);
                                                                                // var_dump($empty_rating, $profile_ratings->rating);
                                                                            @endphp
                                                                            {{-- @for ($i = 0; $i < $user->profile->rating +1; $i++) --}}
                                                                            @for ($i = 0; $i < round($profile_ratings->rating); $i++)
                                                                                <i class="fas fa-star fs_11px-s" aria-hidden="true">  </i>
                                                                            @endfor
                                                                            @for ($i = 0; $i < $empty_rating; $i++)
                                                                                <i class="far fa-star fs_11px-s" aria-hidden="true">  </i>
                                                                            @endfor
                                                                            {{ number_format($profile_ratings->rating , 1) }}
                                                                            <span class="rating_textt"> ${{ $profile_ratings->price }} </span>



                                                                        {{-- @for ($i = 0; $i < $profile_ratings->rating +1; $i++)
                                                                            <i class="far fa-star fs_11px-s" aria-hidden="true">  </i>
                                                                        @endfor
                                                                        <span class="rating_textt"> ${{ $profile_ratings->price }} </span> --}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mx-auto pt-3">
                                                            <div class="col-3 text-white  pr-0 fs_12px-s">
                                                                <span class="opacity_4-s">Age</span>
                                                                <br>
                                                                <span class="fs_12px-s">{{  \Carbon\Carbon::parse($profile_ratings->dob)->age }}</span>
                                                            </div>
                                                            <div class="col-3 text-white  px-0 fs_12px-s">
                                                                <span class="opacity_4-s">Matches</span>
                                                                <br>
                                                                <span class="fs_12px-s">{{ $profile_ratings->played_matches != null ? $profile_ratings->played_matches : 0 }}</span>
                                                            </div>
                                                            <div class="col-3 text-white  px-0 fs_12px-s">
                                                                <span class="opacity_4-s">Missed  </span>
                                                                <br>
                                                                <span class="fs_12px-s">{{ $profile_ratings->missed_matches != null ? $profile_ratings->missed_matches : 0 }}</span>
                                                            </div>
                                                            <div class="col-3 text-white  pl-0 fs_12px-s">
                                                                <span class="opacity_4-s">Position</span>
                                                                <br>
                                                                <span class="fs_position-s">{{ $profile_ratings->position }}</span>
                                                            </div>
                                                        </div>
                                                        <hr class="goalkeeper_margin_b mx-3" />

                                                        <div class="row mx-auto aditya_location">
                                                            <div class="col-6">
                                                                <img src="{{ asset('assets/images/location_pin.svg') }}" class="" alt="location">
                                                                <span class="fs_12px-s mb-0 pb-0">
                                                                    <!-- <i class=" fa fa-map-marker" aria-hidden="true"></i> -->
                                                                    {{-- {{ $profile_ratings->address->address ?? 'no address' }} --}}
                                                                    {{ \Illuminate\Support\Str::limit($profile_ratings->address->city ?? 'no address', 20, $end='...') }}

                                                                    <!-- {{ $profile_ratings->address->address ?? 'no address' }} -->
                                                                </span>
                                                            </div>
                                                            <div class="col-6 pl-0 m-0 text-right">
                                                                <!-- <span class="fs_12px-s mb-0"> -->
                                                                    <a class="td_none-s text-white fs_12px-s pb-0" href="{{ route('getSignleUser', $profile_ratings->user->uuid ) }}">
                                                                        <span class=""> send invitation >> </span>
                                                                    </a>
                                                                <!-- </span> -->
                                                            </div>
                                                            <div class="col-12 justify-content-end d-flex mb-2 pr-0">
                                                                <div>
                                                                    @if ($profile_ratings->is_blocked_user == 0)
                                                                        <a href="" data-toggle="modal" data-target="#report_issue_modal-d-{{ $profile_ratings->id }}">
                                                                            <img src="{{ asset('assets/images/empty_flag.svg') }}" class="img-responsive " width="20" height="20" alt="report flag">
                                                                        </a>

                                                                    @else
                                                                        <img src="{{ asset('assets/images/filled_flag.svg') }}" class="img-responsive " width="20" height="20" alt="report flag" data-toggle="tooltip" data-placement="top" title="Report">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Modal -->
                                            <div class="modal fade report_player_modal-d" id="report_issue_modal-d-{{ $profile_ratings->id }}" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered ">
                                                    <div class="modal-content br_10px-s border-0">
                                                        <!--header image-->
                                                        <div class="modal-header bg_grey-s border-0 br_up_left_right_10px-s">
                                                            <h4 class="modal-title text-dark" id="view-head"><strong>REPORT ISSUES</strong></h4>

                                                        </div>
                                                        <!--header image end-->

                                                        <div class="container-fluid">
                                                            <div class="row modal-body">
                                                                <!--modal text-->
                                                                <div class="col-12 error_msg-d d-none text-danger">
                                                                <p class="">Please Select One Option</p>
                                                                </div>
                                                                <div class="col-12 ">
                                                                    <h6 class="fg_darkgrey_s opacity_4-s">SELECT ISSUE</h6>

                                                                </div>
                                                                <div class="col-12 py-3 mt-2 bb_lightgrey-s bg_grey_on_hover-s report_options-d active">
                                                                    <h6 class="mb-0" >Spam</h6>
                                                                </div>
                                                                <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">Nudity and sexual activity</h6>
                                                                </div>
                                                                <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">Hate speech or symbols</h6>
                                                                </div>
                                                                <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">False Information</h6>
                                                                </div>
                                                                <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">Scam or fraud</h6>
                                                                </div>
                                                                <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">Bullying or harassment</h6>
                                                                </div>
                                                                <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">Violence or dangerous organizations</h6>
                                                                </div>
                                                                <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">Intellectual property violation</h6>
                                                                </div>
                                                                <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">Sale of illegal or regulated goods</h6>
                                                                </div>
                                                                <!-- <div class="col-12 py-3  bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">Something else</h6>

                                                                    <textarea name="your_reason" class="your_reason-d form-control mt-3" id="message" cols="5 " rows="5"></textarea>
                                                                </div> -->
                                                                <!--modal text end-->
                                                            </div>
                                                            <div class="row px-3 pt-3 pb-5">
                                                                <!--cancel button-->
                                                                <div class="col-6 pr-2">
                                                                    <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                                                                </div>
                                                                <!--cancel button end-->

                                                                <!--report button-->
                                                                <div class="col-6 pl-2">
                                                                    <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white w-100 block_player_by_user-d"><strong>REPORT</strong></button>
                                                                </div>

                                                                <input type="hidden" name="" class="blocker_id-d" value="{{ Auth::user()->profile->id }}">
                                                                <input type="hidden" name="" class="player_id-d" value="{{ $profile_ratings->id }}">

                                                                <!--report button end-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        @endif

                                    @endforeach
                                    @if(count($filterRating) == 0 )
                                    <div class="mx-auto text-muted mt-5 pt-5">No Players </div>
                                    @endif

                        @endif

                    </div>
                </div>
            </div>
        </div>
        <!-- container for list of players - end -->
    </div>
    <!-- .................Home Page End ......................... -->
    <!-- option for filter modal -->

    <div class="modal fade option_of_filter_modal-d" id="option_of_filter_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="modal-header bg_grey-s bg_filter_img-s border-0 br_up_left_right_10px-s">
                    <h5 class="modal-title text-dark" id="view-head"><strong>FILTER</strong></h5>
                </div>
                <div class="modal-body">
                    <div class="row py-3">
                        <div class="col-12">
                            <h6 class="opacity_4-s">SELECT FILTER OPTION</h6>
                        </div>
                    </div>

                    <div class="row py-3">
                        <div class="col-12 d-flex justify-content-between border-bottom trigger_rating-d">
                            <a class="td_none-s text-dark" role="button" href="javascript:void(0)">
                                <h4 class="py-3">Rating </h4>
                            </a>
                            <img class="float-right align-self-center" width="18" height="18" src="{{ asset('assets/images/arrow_black.svg') }}" alt="">
                            <!-- <h6></h6> -->
                        </div>
                    </div>
                    <div class="row py-3">
                        <div class="col-12 d-flex justify-content-between border-bottom trigger_price-d">
                            <a class="td_none-s text-dark" role="button" href="#">
                                <h4 class="py-3">Price </h4>
                            </a>
                            <img class="float-right align-self-center" width="18" height="18" src="{{ asset('assets/images/arrow_black.svg') }}" alt="">

                            <!-- <h6></h6> -->
                        </div>
                    </div>
                    <div class="row py-3">
                        <div class="col-12 d-flex justify-content-between border-bottom trigger_location-d">
                            <a class="td_none-s text-dark" role="button" href="#">
                                <h4 class="py-3">Nearest Location </h4>
                            </a>
                            <img class="float-right align-self-center" width="18" height="18" src="{{ asset('assets/images/arrow_black.svg') }}" alt="">
                            <!-- <h6></h6> -->
                        </div>
                    </div>

                    <div class="row pt-5">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 px-5 mr-md-2 w-100" data-dismiss="modal"><strong>CLOSE</strong></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- rating filter modal  -->
    <div class="modal fade" id="filter_by_rating_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="modal-header bg_grey-s bg_filter_img-s border-0 br_up_left_right_10px-s">
                    <h5 class="modal-title text-dark" id="view-head"><strong>FILTER BY RATING</strong></h5>
                </div>
                @php
                        $url = url()->current();
                        $name = substr($url,34);
                @endphp
                <form action="{{ route('home', $name) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row py-3">
                            <div class="col-12">
                                <h6 class="opacity_4-s">RATING</h6>
                            </div>
                        </div>
                         <div class="row pt-3 pb-5">
                            <div class="col-12">
                                <div class="price-field">
                                    <div class="range-value min_value-d"></div>
                                    <input id="" name="total_min_rating" class="min_input-d" type="range" min="0.0" max="5.0" value="0.0" step="0.1">

                                    <div class="range-value max_value-d"></div>
                                    <input id="" name="total_max_rating" class="max_input-d" type="range" min="0.0" max="5.0" value="5.0" step="0.1">
                                </div>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-12 d-flex justify-content-center">
                                <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 px-5 mr-md-2 w_h_48_x_63px-s" data-dismiss="modal"><strong>CANCEL</strong></button>
                                <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white px-5 ml-2 w_h_48_x_63px-s"><strong>APPLY</strong></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- price filter modal  -->
    <div class="modal fade" id="filter_by_price_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="modal-header bg_grey-s bg_filter_img-s border-0 br_up_left_right_10px-s">
                    <h5 class="modal-title text-dark" id="view-head"><strong>FILTER BY PRICE</strong></h5>
                </div>
                    {{-- {{ dd(url()->current())  }} --}}

                    @php
                        $url = url()->current();
                        $name = substr($url,34);
                    @endphp

                <form action="{{ route('home', $name) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row py-3">
                            <div class="col-12">
                                <h6 class="opacity_4-s">PRICE <span>($)</span></h6>
                            </div>
                        </div>
                        <div class="row pt-3 pb-5">
                            <div class="col-12">
                                <div class="price-field ">
                                    <div class="range-value min_value-d"></div>
                                    <input id="" name="min_price" class="min_input-d" type="range" min="100" max="500" value="100" step="10">
                                    <div class="range-value max_value-d"></div>
                                    <input id="" name="max_price" class="max_input-d" type="range" min="100" max="500" value="500" step="10">
                                </div>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-12 d-flex justify-content-center">
                                <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 px-5 mr-md-2 w_h_48_x_63px-s" data-dismiss="modal"><strong>CANCEL</strong></button>
                                <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white px-5 ml-2 w_h_48_x_63px-s" ><strong>APPLY</strong></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- location filter modal  -->
    <div class="modal fade" id="filter_by_distance_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="modal-header bg_grey-s bg_filter_location_img-s border-0 br_up_left_right_10px-s">
                    <h5 class="modal-title text-dark" id="view-head"><strong>FILTER BY DISTANCE</strong></h5>
                </div>
                {{-- <form action="{{ route('home') }}" method="post" >
                    @csrf --}}
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-12 pr-lg-5">
                            <div class="row py-3">
                                <div class="col-12">
                                    <h6 class="opacity_4-s">DISTANCE(KILOMETERS)</h6>
                                </div>
                            </div>
                            @php
                                $url = url()->current();
                                $name = substr($url,34);
                            @endphp
                            <form action="{{ route('home', $name) }}"  method="post" >
                                @csrf
                                <div class="row pt-3 pb-5">
                                    <div class="col-12">
                                        <div class="price-field ">
                                            <div class="range-value min_value-d"></div>
                                            <input name = "current_lat" id="" class="min_input-d" type="range" min="0" max="90" value="0" step="10">
                                            <div class="range-value max_value-d"></div>
                                            <input name = "current_long" id="" class="max_input-d" type="range" min="0" max="90" value="90" step="10">
                                        </div>
                                    </div>
                                </div>
                                <div class="row w-100 mx-auto pt-lg-0 pt-3 postion_absolute_on_lg-s">
                                    <div class="col-12 d-md-flex pr-lg-5 px-0 w-100">
                                        <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 px-5 mr-md-2 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                                        <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white px-5 ml-md-2 mt-md-0 mt-2  w-100"><strong>APPLY</strong></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-xl-6  col-lg-6 col-12 mt-lg-0 mt-4">
                            <div id="googleMap" style="width:100%;height:95%;"></div>
                            <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

                            <script>



                                    var lat = '';
                                    var long = '';

                                    function getLocation() {
                                        if (navigator.geolocation) {
                                            navigator.geolocation.getCurrentPosition(showPosition);
                                        } else {
                                            // x.innerHTML = "Geolocation is not supported by this browser.";
                                            alert('Geolocation is not supported by this browser');
                                        }
                                    }

                                    function showPosition(position) {

                                        lat = position?.coords?.latitude;
                                        long = position?.coords?.longitude
                                        console.log(position?.coords?.latitude, position?.coords?.longitude );
                                        localStorage.setItem("lat1", lat);
                                        localStorage.setItem("long1", long);
                                        console.log(lat , "lat");
                                        console.log(long , "long");

                                    }


                                    var lat1 =  localStorage.getItem("lat1");
                                    var long1 =  localStorage.getItem("long1");
                                    console.log(lat1 , "lat1");
                                    console.log(long1 , "long1");

                                    window.onload = function() {
                                        getLocation();

                                        console.log("IN load function", lat1 , "lat1", long1, "long1");

                                            $.ajax({
                                            type: "get",
                                            url: playersByLocation,
                                            data: {lat1: lat1, long1: long1},
                                            dataType: "json",
                                            success: function (response) {
                                                console.log('response: ', response);
                                                console.log(response.data , "response data");

                                                let data = response.data;

                                                var location = [];

                                                var location3 = {};

                                                $(data).each(function(i,e){
                                                    var location2 = {
                                                            lat: +e.latitude,
                                                            lng: +e.longitude
                                                    };



                                                    location.push(location2);


                                                });
                                                    // console.log("location", location);
                                                localStorage.setItem("cordinates", JSON.stringify(location));

                                                // var result =  location.getItem(JSON.parse("cordinates"));
                                                // console.log('result: ', result);
                                            }
                                        });

                                    };


                                    // var locations  = JSON.parse(localStorage.getItem("cordinates"));
                                    // console.log('cordinates: ', locations);
                                    // debugger;

                                    function myMap() {

                                        var mapProp= {
                                        //   center:new google.maps.LatLng(34.84555 ,-111.8035),
                                          center:new google.maps.LatLng(lat1,long1),
                                          zoom:12,
                                         backgroundColor: 'green',
                                         mapId: '839cfe9e63bd66c5'

                                        };
                                        var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

                                        // var marker = new google.maps.Marker({
                                        // // position: new google.maps.LatLng(31.4769408 ,74.3931904),
                                        // position: new google.maps.LatLng(lat1,long1),
                                        // title:"Hello World!"

                                        // });

                                    // To add the marker to the map, call setMap();
                                    // marker.setMap(map);
                                    const locations  = JSON.parse(localStorage.getItem("cordinates"));
                                    console.log('locations: ', locations);

                                    //  const tourStops = [
                                    //     { lat: 34.8791806, lng: -111.8265049 },
                                    //     { lat: 34.8559195, lng: -111.7988186 },
                                    //     { lat: 34.832149, lng: -111.7695277 },
                                    //     { lat: 34.823736, lng: -111.8001857 },
                                    //     { lat: 34.800326, lng: -111.7665047 },
                                    // ];

                                        const infoWindow = new google.maps.InfoWindow();
                                            // Create an array of alphabetical characters used to label the markers.
                                            const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                                            // Add some markers to the map.
                                             locations.forEach((position, i) => {
                                                const marker = new google.maps.Marker({
                                                position,
                                                map,
                                                title: `${i + 1}`,
                                                label: `${i + 1}`,
                                                optimized: false,
                                                });

                                            // Add a click listener for each marker, and set up the info window.
                                                marker.addListener("click", () => {
                                                infoWindow.close();
                                                infoWindow.setContent(marker.getTitle());
                                                infoWindow.open(marker.getMap(), marker);
                                                });
                                            });
                                    }





                                    // // seacrh location form
                                    // $(".frm_search_location-d").on('click', function(){
                                    //     alert('ok');
                                    // })


                            </script>

                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9lN0B2EalTvLS_dNDWE1BmCBKLTDZxsI&callback=myMap"></script>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js "></script>
                            {{--  <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>  --}}
                            {{-- <script src="https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyBxVV2ZXbVxw3vH2F9jyB-pIKn7dWrYYyI&center=47.65,-122.35&zoom=12&format=png&maptype=roadmap&style=element:geometry%7Ccolor:0x212121&style=element:labels.icon%7Cvisibility:off&style=element:labels.text.fill%7Ccolor:0x757575&style=element:labels.text.stroke%7Ccolor:0x212121&style=feature:administrative%7Celement:geometry%7Ccolor:0x757575&style=feature:administrative.country%7Celement:labels.text.fill%7Ccolor:0x9e9e9e&style=feature:administrative.land_parcel%7Cvisibility:off&style=feature:administrative.locality%7Celement:labels.text.fill%7Ccolor:0xbdbdbd&style=feature:poi%7Celement:labels.text.fill%7Ccolor:0x757575&style=feature:poi.park%7Celement:geometry%7Ccolor:0x181818&style=feature:poi.park%7Celement:labels.text.fill%7Ccolor:0x616161&style=feature:poi.park%7Celement:labels.text.stroke%7Ccolor:0x1b1b1b&style=feature:road%7Celement:geometry.fill%7Ccolor:0x2c2c2c&style=feature:road%7Celement:labels.text.fill%7Ccolor:0x8a8a8a&style=feature:road.arterial%7Celement:geometry%7Ccolor:0x373737&style=feature:road.highway%7Celement:geometry%7Ccolor:0x3c3c3c&style=feature:road.highway.controlled_access%7Celement:geometry%7Ccolor:0x4e4e4e&style=feature:road.local%7Celement:labels.text.fill%7Ccolor:0x616161&style=feature:transit%7Celement:labels.text.fill%7Ccolor:0x757575&style=feature:water%7Celement:geometry%7Ccolor:0x000000&style=feature:water%7Celement:labels.text.fill%7Ccolor:0x3d3d3d&size=480x360"> --}}
                            {{-- </script> --}}


                            <div class="container filter_location-s d-flex ">
                                <div class=" location_card-s d-flex align-self-end pb-3 w-100">
                                    <div class="card w-100 br_10px-s">
                                        <div class="heart_icon py-2">
                                            <i class="far fa-heart bg_green-s location_heart-s text-center py-2 " aria-hidden="true"></i>
                                        </div>
                                        <div class="container-fluid px-1 ">
                                            <div class="row mx-auto">
                                                <div class="col-lg-2 col-md-3 col-3">
                                                    <img src="assets/images/Group 24.png" width="40" alt="" />
                                                </div>
                                                <div class="col-lg-10 col-md-9 col-9 d-flex pr-4 justify-content-between">
                                                    <div class="text-dark d-inline-block">
                                                        <h6 class="mb-0 pb-0 fs_12px-s "><strong>Thamer <br><span class=" opacity_4-s fs_8px-s">@thamermd</span></strong></h6>

                                                        <p class="fg_yellow-s fs_8px-s">
                                                            <i class="far fa-star" aria-hidden="true"></i>
                                                            <i class="far fa-star" aria-hidden="true"></i>
                                                            <i class="far fa-star" aria-hidden="true"></i>
                                                            <i class="far fa-star" aria-hidden="true"></i>
                                                            <i class="far fa-star" aria-hidden="true"></i> 5.0
                                                        </p>
                                                    </div>
                                                    <div class="align-self-center d-flex">
                                                        <h6 class="fg_green-s"> $10 </h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="goalkeeper_margin_b mx-3 my-2" />

                                            <div class="row mx-auto aditya_location">
                                                <div class="col-6">
                                                    <p class="fs_11px-s mb-0 text-dark">
                                                        <strong><i class=" fa fa-map-marker text-dark fs_11px-s" aria-hidden="true"></i> Aditya</strong>
                                                    </p>
                                                </div>
                                                <div class="col-6">
                                                    <a class="td_none-s fs_11px-s" href="Home/home-sent-invitation.html">
                                                        <span class="pull-right text-dark  fs_11px-s"><strong>send invitation >></strong></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                {{-- </form> --}}

            </div>
        </div>
    </div>






@endsection
