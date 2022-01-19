@extends('layout.app')

@section('content')

<div class="container-fluid px-0 mx-0 ">

        <!-- -------heading container - start -->
        <div class="container-fluid">
            <div class="row py-3 px-xl-5">
                <div class="col-12 pt-4">
                    <h1 class=""><strong>Favorites</strong></h1>
                    <h4 class="">All your favorite players.</h4>
                </div>
            </div>
        </div>
        <!-- ------heading container - end -->

        <!-- container for favorite players - start -->
        <div class="container-fluid bg-white mt-5 br_47px-s">
            <div class="row py-5 px-xl-5">
                <div class="col-12 min_h_340px-s py-3">
                    <div class="row">
                        <div class="col-12 text-left py-2">
                            <h5 class = 'text-left'>
                                @if(count($allUsers) > 0)
                                <strong>Players</strong><strong>({{count($allUsers)}})</strong>
                                @endif
                            </h5>
                        </div>
                        @forelse ($allUsers as $user)
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3 py-2 px-1">
                                <div class="card home_card {{$user->profile->my_request == 1 ? 'card_bg_img-s' : ''}}  br_25px-s">
                                        <div  class="heart_icon">
                                            <a href="{{ route('favorite',[$user->profile->uuid,0]) }}">
                                                <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true">
                                                </i>
                                            </a>
                                        </div>
                                    <div class="container mt_30px-s">
                                        <div class="row mx-auto">
                                            <div class="col-lg-3 col-md-3 col-3">
                                                <a href="{{ route('othersProfile', [$user->uuid, $user->profile->uuid, $user->profile->id]) }}">
                                                    <img class="rounded-circle profile_img border_white-s" src="{{ asset($user->profile->profile_image) }}" width="50" height="50"  alt="" />
                                                </a>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-9">
                                                <div class="text-white">
                                                    <a class = "text-white td_none-s" href="{{ route('othersProfile',[$user->uuid, $user->profile->uuid, $user->profile->id]) }}">
                                                        <h6 class="mb-0">
                                                            {{ $user->profile->first_name }} {{ $user->profile->last_name }}
                                                        </h6>
                                                    </a>
                                                    <span class=" opacity_4-s fs_11px-s">
                                                       <strong>@</strong>{{ $user->profile->username }}
                                                    </span>
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
                                            <div class="col-3 text-white pr-0 fs_12px-s">
                                                <span class="opacity_4-s">Age</span>
                                                <br>
                                                <span class="fs_12px-s">{{  \Carbon\Carbon::parse($user->profile->dob)->age }}</span>
                                            </div>
                                            <div class="col-3 text-white px-0 fs_12px-s">
                                                <span class="opacity_4-s">Matches</span>
                                                <br>
                                                <span class="fs_12px-s">{{ $user->profile->played_matches != null ? $user->profile->played_matches : 0 }}</span>
                                            </div>
                                            <div class="col-3 text-white px-0 fs_12px-s">
                                                <span class="opacity_4-s">Missed  </span>
                                                <br>
                                                <span class="fs_12px-s">{{ $user->profile->missed_matches != null ? $user->profile->missed_matches : 0 }}</span>
                                            </div>
                                            <div class="col-3 text-white pl-0 fs_12px-s">
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
                                                    <!-- <i class=" fa fa-map-marker mr-0" aria-hidden="true"></i> -->
                                                    {{ \Illuminate\Support\Str::limit($user->profile->address->city ?? 'no address', 10, $end='...') }}
                                                </span>
                                            </div>
                                            <div class="col-6 pl-0 text-right">
                                                <a class="td_none-s text-white fs_12px-s pb-0" href="{{ route('getSignleUser', $user->uuid ) }}">
                                                    <span class="pull-right text-white"> send invitation >> </span>
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
                                                            {{--  <img src="{{ asset('assets/images/filled_flag.svg') }}" class="img-responsive " width="20" height="20" alt="report flag">  --}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                                <div class="modal fade report_player_modal-d" id="report_issue_modal-d-{{ $user->profile->id  }}" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered ">
                                        <div class="modal-content br_10px-s border-0">
                                            <!--header image-->
                                            <div class="modal-header bg_grey-s border-0 br_up_left_right_10px-s">
                                                <h4 class="modal-title text-dark" id="view-head"><strong>REPORT ISSUES</strong></h4>
                                            </div>
                                            <!--header image end-->

                                            <div class="container-fluid">
                                                <div class="row modal-body">
                                                    <div class="col-12 error_msg-d d-none text-danger">
                                                        <p class="">Please Select One Option</p>
                                                    </div>
                                                    <!--modal text-->
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
                                                        <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100"  data-dismiss="modal"><strong>CANCEL</strong></button>
                                                    </div>
                                                    <!--cancel button end-->

                                                    <!--report button-->
                                                    <div class="col-6 pl-2">
                                                        <button type="button" class="btn bg_green-s br_10px-s py-3 text-white w-100 block_player_by_user-d"><strong>REPORT</strong></button>
                                                    </div>
                                                    <!--report button end-->
                                                    <input type="hidden" name="" class="blocker_id-d" value="{{ Auth::user()->profile->id }}">
                                                    <input type="hidden" name="" class="player_id-d" value="{{$user->profile->id }}">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @empty
                        <div class="mx-auto text-muted font-weight-bold mt-5 pt-5">
                            You have not added any player in your favorite list yet
                        </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
        <!-- container for favorite players - end -->
</div>

@endsection
