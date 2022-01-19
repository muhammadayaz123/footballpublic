@extends('layout.app')

@section('content')
    {{-- {{ dd($userRate) }} --}}
    <div id="loader" class='loader_container-s align-self-center d-none w-100 justify-content-center' style="">
        <img class='align-self-center' width='200' height="200" src="{{ asset('assets/images/logo_gif.gif') }}">
    </div>
 <div class="container-fluid px-0 mx-0 ">
        <div class="container-fluid px-xl-5 px-3">
            <div class="row pt-4 pb-3">
                <div class=" col-xl-8 col-lg-8 col-md-8 col-12 d-flex order-md-1 order-2 ">
                    <a class="td_none-s" href="{{ url('game_invitation') }}">
                        <h4 class="pr-2 text-dark">Game Invitations</h4>
                    </a>
                    <h4 class="px-2"><strong>/</strong></h4>
                    <h4 class="fg_green-s pl-2">Rate Player</h4>
                </div>
            </div>
        </div>

        <div class="container-fluid bg-white br_47px-s mh_86vh-s">
            <div class="row py-4 px-xl-4 px-3">
                <!--palyer information-->
                <div class="col-lg-8 col-12 d-flex">
                    <div class="align-self-md-center">
                        {{-- {{dd($userRate->user_ratings[0])}} --}}
                        <img src="{{ $userRate->profile_image  }}"  width="80" class="rounded-circle border_green-s" alt="">
                    </div>
                    <div class="ml-3">
                        <h4 class="fg_green-s">{{ $userRate->first_name }}{{ $userRate->first_name }}</h4>
                        <div class="d-flex mb-2">
                            <div>
                                <a href="javascript:void(0)" class="text-dark td_none-s"><strong>@ {{ $userRate->username }}</strong></a>
                            </div>
                            <div class="pl-3">
                                <a href="javascript:void(0)" class="pr-2 td_none-s">
                                    <img src="{{ asset('assets/images/Location.svg') }}" width="10" class="img-fluid mb-1" alt="Location" />
                                    <span class="text-dark"> <strong>{{ $userRate->address->address != null ? $userRate->address->address : "No Address Available" }} </strong></span>
                                </a>
                            </div>
                        </div>
                        <div class="d-md-flex opacity_4-s">
                            {{-- {{ dd(\Carbon\Carbon::parse($userRate->dob) ,$userRate ) }} --}}
                            <h6>Age:<span class="pl-1">{{  \Carbon\Carbon::parse($userRate->dob)->age }}</span></h6>

                            <span class="px-2 d-md-block d-none">|</span>
                            <h6>Match:<span class="pl-1">{{ $userRate->played_matches != null ? $userRate->played_matches : 0 }}</span></h6>

                            <span class="px-2 d-md-block d-none">|</span>
                            <h6>Missed:<span class="pl-1">{{ $userRate->missed_matches != null ? $userRate->missed_matches : 0 }}</span></h6>

                            <span class="px-2 d-md-block d-none">|</span>
                            <h6>Position:<span class="pl-1">{{ $userRate->position }}</span></h6>

                        </div>
                    </div>
                </div>
                <!--palyer information end-->

                <!--palyer rating-->
                <div class="col-lg-4 col-12 text-right">
                    <p class="fg_yellow-s fs_27px-s mb-0">
                         @for ($i = 0; $i < (int)$userRate->rating; $i++)
                            <i class="fa fa-star" aria-hidden="true">  </i>
                        @endfor
                        {{-- <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="far fa-star" aria-hidden="true"></i> --}}
                    </p>
                    <div>
                        <h4 class="fg_green-s"><strong>{{ round($userRate->rating, 1) ?? '0' }} out of 5.0</strong></h4>
                    </div>
                    <div class="opacity_4-s">
                        <h6>Based on {{ $userRate->ratings_count ?? 0 }} players rating</h6>
                    </div>
                </div>
                <!--palyer rating end-->
                {{-- {{ dd($uuid, $invitation_id) }} --}}
            </div>
            <div class="row rating_bg-s br_20px-s mx-xl-4 mx-3">
                <div class="col-xl-8 col-lg-7 col-12">
                    <div class="row px-3 py-4">
                        <div class=" col-12 d-flex justify-content-between">
                            <h5 class="fg_green-s">GIVE YOUR RATING</h5>
                            <h6 class="text-right opacity_4-s">YOUR RATING IS <span>{{ $userRate->ratings_count ?? 0 }}</span></h6>
                        </div>
                        <div class="col-12">
                            <form action="{{ route('ratePlayer', [$uuid, $invitation_id]) }}" id="frm_rate_player-d" method="post">
                                @csrf
                                <div class="row">
                                    @if(isset($userRate->user_ratings[0]->uuid))
                                    <input type="hidden" value="{{ $userRate->user_ratings[0]->uuid}}" name="rating_uuid">
                                    @endif
                                    <!--ability rating-->
                                    <div class="col-md-6 col-12 mt-2">
                                        <div class="d-flex justify-content-between">
                                            <h6><strong>AGILITY</strong></h6>
                                            <h6 class="ability-d">0</h6>
                                        </div>
                                        <div class="form-group rating_filed-s br_8px-s bg-white border">
                                            <input type="range" name="agility"  min="0.0" max="5.0" step="0.1" value="{{ $userRate->user_ratings[0]->agility ?? 0 }}" id="ability" class="form-control-range py-4 ratig_slider-s mx-auto slider-d" data-parent='ability-d'>
                                        </div>
                                    </div>
                                    <!--ability rating end-->

                                    <!--stamina rating-->
                                    <div class="col-md-6 col-12 mt-2">
                                        <div class="d-flex justify-content-between">
                                            <h6><strong>STAMINA</strong></h6>
                                            <h6  class="stamina-d">0</h6>
                                        </div>
                                        <div class="form-group rating_filed-s br_8px-s bg-white border">
                                            <input type="range" name="stamina"  min="0.0" max="5.0" value="{{ $userRate->user_ratings[0]->stamina ?? 0 }}" step="0.1" id="stamina" class="form-control-range py-4 ratig_slider-s mx-auto slider-d" data-parent='stamina-d'>
                                        </div>
                                    </div>
                                    <!--stamina rating end-->

                                    <!--strength rating-->
                                    <div class="col-md-6 col-12 mt-2">
                                        <div class="d-flex justify-content-between">
                                            <h6><strong>STRENGTH</strong></h6>
                                            <h6 class="strength-d">0</h6>
                                        </div>
                                        <div class="form-group rating_filed-s br_8px-s bg-white border">
                                            <input type="range" name="strength" min="0.0" max="5.0" value="{{ $userRate->user_ratings[0]->strength ?? 0 }}" step="0.1" class="form-control-range py-4 ratig_slider-s mx-auto slider-d" id="strength" data-parent="strength-d">
                                        </div>
                                    </div>
                                    <!--strength rating end-->

                                    <!--passes rating-->
                                    <div class="col-md-6 col-12 mt-2">
                                        <div class="d-flex justify-content-between">
                                            <h6><strong>PASSES</strong></h6>
                                            <h6 class="passes-d">0</h6>
                                        </div>
                                        <div class="form-group rating_filed-s br_8px-s bg-white border">
                                            <input type="range" name="passes" min="0.0" max="5.0" value="{{ $userRate->user_ratings[0]->passes ?? 0 }}" step="0.1" class="form-control-range py-4 ratig_slider-s mx-auto slider-d" id="passes" data-parent="passes-d">
                                        </div>
                                    </div>
                                    <!--passes rating end-->

                                    <!--shoots rating-->
                                    <div class="col-md-6 col-12 mt-2">
                                        <div class="d-flex justify-content-between">
                                            <h6><strong>SHOOTS</strong></h6>
                                            <h6 class="shoots-d">0</h6>
                                        </div>
                                        <div class="form-group rating_filed-s br_8px-s bg-white border">
                                            <input type="range" name="shoots"  min="0.0" max="5.0" value="{{ $userRate->user_ratings[0]->shoots ?? 0 }}" step="0.1" class="form-control-range py-4 ratig_slider-s mx-auto slider-d" id="shoots" data-parent="shoots-d">
                                        </div>
                                    </div>
                                    <!--shoots rating end-->

                                    <!--pace rating-->
                                    <div class="col-md-6 col-12 mt-2">
                                        <div class="d-flex justify-content-between">
                                            <h6><strong>PACE</strong></h6>
                                            <h6 class="pace-d">0</h6>
                                        </div>
                                        <div class="form-group rating_filed-s br_8px-s bg-white border">
                                            <input type="range" name="pace"  min="0.0" max="5.0" value="{{ $userRate->user_ratings[0]->pace ?? 0 }}" step="0.1" class="form-control-range py-4 ratig_slider-s mx-auto slider-d" id="pace" data-parent="pace-d">
                                        </div>
                                    </div>
                                    <!--pace rating end-->

                                    <!--extra coloumn to set submit button-->
                                    <div class="col-md-6 col-12 mt-2">
                                        <!-- coloumn for space  -->
                                    </div>
                                    <div class="col-md-6 col-12 mt-2 align-self-center">
                                        {{-- <input type="hidden" name="invitation_id"> --}}
                                        <button type="submit" class="br_10px-s bg_green-s text-white w-100 h_58px-s fs_20px-s border-0" data-toggle="modal" data-target="#player_played_modal-d"><strong>SUBMIT</strong></button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-12">
                    <div class="text-center performance_img py-4">
                        <div class="chart-container mx-auto">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
