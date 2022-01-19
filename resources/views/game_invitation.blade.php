@extends('layout.app')



@section('content')

<style>
    .pignose-calendar {
    -webkit-box-shadow: none !important;
}
</style>

 <!-- .................Game invitation Page Start ......................... -->
    <div class="container-fluid px-0 mx-0 ">

        <!-- -------heading container - start -->
        <div class="container-fluid">
            <div class="row py-5 px-xl-5 justify-content-between">
                <div class="col-md-5 col-12 align-self-center">
                    <h1>
                        <Strong>Game Invitations</Strong>
                    </h1>
                    <h4>Send or accept game <invitations class=""></invitations></h4>
                </div>
                <div class="col-md-7 col-12 justify-content-md-end mt-md-0 mt-4 d-flex align-self-center">
                    <a href="javascript:void(0)" role="button" class="btn bg-white br_10px-s mr-2 br_green_on_hover_active-s fs_18px-s active fg_light_grey-s py-3 outline_none-s w_h_216px_x_63px-s"><strong>Invitations</strong></a>
                    <a href="{{ route('hirePlayer') }}" class="btn bg-white br_10px-s ml-2 br_green_on_hover-s fg_light_grey-s py-3 fs_18px-s outline_none-s w_h_216px_x_63px-s"><strong>Hire Players</strong></a>
                </div>
            </div>
        </div>
        <!-- ------heading container - end -->

        <!-- container for invited players - start -->
        <div class="container-fluid bg-white br_47px-s">
                <div class="row pt-5 px-xl-5">
                    <div class="col-12 d-flex fg_green-s">
                        <h6 class="mb-0 fs_18px-s"><strong>{{ $date ? " " : 'Today,' }}</strong></h6>&nbsp;
                        <h6 class="mb-0 fs_18px-s"><strong>{{ \Carbon\Carbon::parse($date)->format('l') ?? \Carbon\Carbon::now()->format('l')}}, {{ \Carbon\Carbon::parse($date)->format('d M Y') ??  \Carbon\Carbon::parse($date)->format('d M Y')}}</strong></h6>
                        <a href="javascript:void(0)" class="td_none-s d-flex align-self-center mx-2" data-toggle="modal" data-target="#slected_date_calander_modal-d">
                            <img src="{{ asset('assets/images/arrow_down_green.svg') }}" class="change_img-d fg_green-s" width="17" alt="arrow button">
                        </a>
                    </div>
                    {{-- <div class="col-12 d-none mb-4 mt-3" id="toggle_calendar-d">

                        <div>
                            <div class="calendar_2"></div>
                        </div>

                        <main>
                            <div class="calendar-wrapper" id="calendar-wrapper"></div>
                        </main>
                    </div> --}}
                </div>



                {{--  {{ dd($invitations) }}  --}}
            @forelse($invitations as  $invite1)

                @if ((\Carbon\Carbon::parse($invite1[0]->date_time)->format('H:i:m') >= \Carbon\Carbon::now()->format('H:i:m')) && ($date >= \Carbon\Carbon::now()->format('Y-m-d')))
                    <div class="row pt-4 pb-3 pr-xl-5 pr-3">
                        <div class="col-md-6 pr-0 col-5 pl-0 d-flex">
                            <div class="">
                                <div class="bg_green-s py-2 mt-1 w_54px-s br_right_top_bottom_10px-s"></div>

                            </div>
                            <div class="pl-2">
                                <h6 class="fs_18px-s"><strong>{{  \Carbon\Carbon::parse($invite1[0]->date_time)->format('g:i a') }}</strong></h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-7 pr-md-3 pr-0  text-right">
                            <h6 class="fg_light_grey-s fs_18px-s">Upcoming Matches</h6>
                        </div>
                    </div>

                    <div class="row px-xl-4 pt-2 pb-3 px-xl-5 px-2">
                        @foreach ($invite1 as $invite)

                                {{--  {{ dd($invitations, $invite) }}  --}}
                            @if (($invite->status == 'pending') && (Auth::user()->profile->id == $invite->player->id))
                            {{-- card --}}
                                <div class="col-12 col-md-6 col-lg-4 py-2">

                                    <div class="card home_card br_1_5rem-s">
                                        <div class="br_15px-s position-absolute bg-white fg_green-s px-4 py-1 shadow card_ticker-s">
                                            <span class="fs_12px-s d-flex align-self-center "><strong> {{$invite->status}}  </strong></span>
                                        </div>

                                        <div class="heart_icon fs_32px-s">
                                            @if($invite->player->is_my_fav == 1)
                                            <a href="{{ route('favorite',[$invite->player->uuid,0]) }}">
                                                <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                            @else
                                            <a href="{{ route('favorite',[$invite->player->uuid,1]) }}">
                                                <i class="far fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                            @endif
                                            </a>
                                            {{-- <i class="fa fa-heart" aria-hidden="true" style="font-size: 23px;"></i> --}}
                                        </div>
                                        <div class="card-body pt-2 pb-3 px-1">
                                            <div class="container-fluid px-xl-0">
                                                <div class="row px-xl-4">
                                                    <div class="col-xl-2 col-3">
                                                        <a href="{{ route('othersProfile', [$invite->host->user->uuid, $invite->host->uuid, $invite->host->id]) }}">
                                                            <img class="rounded-circle profile_img border_white-s" src="{{ asset($invite->host->profile_image) ??  asset('assets/images/Group 24.png') }}" alt="" width="50" height="50" >
                                                        </a>
                                                    </div>
                                                    <div class="col-xl-10 col-9 ">
                                                        <div class="row ">
                                                            <div class="col-xl-5 col-12 ">
                                                                <div class="text-white">
                                                                    <a class = "text-white td_none-s" href="{{ route('othersProfile', [$invite->host->user->uuid, $invite->host->uuid, $invite->host->id]) }}">
                                                                        <h6 class="mb-0 player_name-d">{{$invite->host->first_name}} {{$invite->host->last_name}}</h6>
                                                                    </a>
                                                                    <span class=" opacity_4-s fs_11px-s"><b>@</b class="username-d">{{$invite->host->username}}</span>
                                                                    <p class="fg_yellow-s mb-2 fs_11px-s">
                                                                        @php
                                                                            $empty_rating = 5 - round($invite->host->rating);
                                                                            //  dd($empty_rating)
                                                                        @endphp
                                                                        {{-- @for ($i = 0; $i < $invite->host->rating +1; $i++) --}}
                                                                        @for ($i = 0; $i < round($invite->host->rating); $i++)
                                                                            <i class="fas fa-star" aria-hidden="true">  </i>
                                                                        @endfor
                                                                        @for ($i = 0; $i < $empty_rating; $i++)
                                                                            <i class="far fa-star" aria-hidden="true">  </i>
                                                                        @endfor

                                                                        {{-- @for ($i = 0; $i < $invite->host->rating; $i++)
                                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                                        @endfor --}}
                                                                        {{number_format($invite->host->rating, 1, '.', ',');}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-7 col-12 pb-xl-0 pb-2 d-flex justify-content-between">
                                                                <div class="">
                                                                    <h6 class="text-white mb-0 player_amount-d"> ${{$invite->host->price}}</h6>
                                                                    <span class="opacity_4-s text-white fs_11px-s">Match Amount</span>
                                                                </div>
                                                                <div class="text-right">
                                                                    <span class="text-white fs_12px-s player_position-d"> {{$invite->host->position}} </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="goalkeeper_margin_b mt-1 mb-2 mx-xl-4 mx-3">

                                            <div class="aditya_location mx-xl-4 mx-3">
                                                <h6 class="mb-0 pb-0">
                                                <img src="{{ asset('assets/images/location_pin.svg') }}" class="" alt="location">
                                                    <!-- <i class="fa fa-map-marker" aria-hidden="true"></i> -->
                                                    <span class="fs_12px-s">{{$invite->stadium->name}}</span>
                                                </h6>
                                                <span class="opacity_4-s fs_11px-s">{{$invite->stadium->address}},{{$invite->stadium->city ?? ''}},{{$invite->stadium->country ?? ''}}</span>
                                            </div>

                                            <div class="row pt-3 pb-2 px-xl-4 px-3">
                                                <div class="col-6 pr-2">
                                                    <a href="{{ route('change_status',[$invite->uuid,'rejected']) }}">
                                                    </a>
                                                        <button type="button" class="btn fs_11px-s bg_grey-s br_10px-s fg_green-s py-3 w-100 cancel_invitation " data-toggle="modal" data-target="#cancel_invitation_modal-d"><strong>Decline</strong></button>

                                                </div>

                                                <!--SUBMIT button-->
                                                <div class="col-6 pl-2">
                                                    <a href="{{ route('change_status',[$invite->uuid,'accepted']) }}">
                                                    </a>
                                                    <input class="invitation_uuid-d"  type="hidden" value="{{ $invite->uuid}}">
                                                    <input class="player_id-d"  type="hidden" value="{{ $invite->player->id}}">
                                                    <input class="host_id-d"  type="hidden" value="{{ $invite->host->id}}">
                                                    <input class="host_user_uuid-d"  type="hidden" value="{{ $invite->host->user->uuid}}">

                                                    <button type="submit"  class="btn fs_11px-s bg-white br_10px-s py-3 fg_green-s w-100 submit_accept" data-toggle="modal" data-target="#accept_invitation_modal-d">
                                                            <strong>Accept</strong>
                                                        </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{--end card --}}
                            @elseif (($invite->status == 'accepted') && (Auth::user()->profile->id == $invite->player->id))
                                {{-- card --}}
                                    <div class="col-12 col-md-6 col-lg-4 py-2">

                                        <div class="card home_card br_1_5rem-s">
                                            <div class="br_15px-s position-absolute bg-white fg_green-s px-4 py-1 shadow card_ticker-s">
                                                <span class="fs_12px-s d-flex align-self-center "><strong> {{$invite->status}}  </strong></span>
                                            </div>

                                            <div class="heart_icon fs_32px-s">
                                                @if($invite->player->is_my_fav == 1)
                                                <a href="{{ route('favorite',[$invite->player->uuid,0]) }}">
                                                    <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                @else
                                                <a href="{{ route('favorite',[$invite->player->uuid,1]) }}">
                                                    <i class="far fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                @endif
                                                </a>
                                                {{-- <i class="fa fa-heart" aria-hidden="true" style="font-size: 23px;"></i> --}}
                                            </div>
                                            <div class="card-body pt-2 pb-3 px-1">
                                                <div class="container-fluid px-xl-0">
                                                    <div class="row px-xl-4">
                                                        <div class="col-xl-2 col-3">
                                                            <a  href="{{ route('othersProfile', [$invite->host->user->uuid, $invite->host->uuid, $invite->host->id]) }}">
                                                                <img class="rounded-circle profile_img border_white-s" src="{{ asset($invite->host->profile_image) ??  asset('assets/images/Group 24.png') }}" alt="" width="50" height="50" >
                                                            </a>
                                                        </div>
                                                        <div class="col-xl-10 col-9 ">
                                                            <div class="row ">
                                                                <div class="col-xl-5 col-12 ">
                                                                    <div class="text-white">
                                                                        <a  class = "text-white td_none-s" href="{{ route('othersProfile', [$invite->host->user->uuid, $invite->host->uuid, $invite->host->id]) }}">
                                                                            <h6 class="mb-0 player_name-d">{{$invite->host->first_name}} {{$invite->host->last_name}}</h6>
                                                                        </a>
                                                                        <span class=" opacity_4-s fs_11px-s"><b>@</b class="username-d">{{$invite->host->username}}</span>
                                                                        <p class="fg_yellow-s mb-2 fs_11px-s">
                                                                            @php
                                                                                $empty_rating = 5 - round($invite->host->rating);
                                                                                //  dd($empty_rating)
                                                                            @endphp
                                                                            {{-- @for ($i = 0; $i < $invite->host->rating +1; $i++) --}}
                                                                            @for ($i = 0; $i < round($invite->host->rating); $i++)
                                                                                <i class="fas fa-star" aria-hidden="true">  </i>
                                                                            @endfor
                                                                            @for ($i = 0; $i < $empty_rating; $i++)
                                                                                <i class="far fa-star" aria-hidden="true">  </i>
                                                                            @endfor

                                                                            {{-- @for ($i = 0; $i < $invite->host->rating; $i++)
                                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                                            @endfor --}}
                                                                            {{number_format($invite->host->rating, 1, '.', ',');}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-7 col-12 pb-xl-0 pb-2 d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="text-white mb-0 player_amount-d"> ${{$invite->host->price}}</h6>
                                                                        <span class="opacity_4-s text-white fs_11px-s">Match Amount</span>
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <span class="text-white fs_12px-s player_position-d"> {{$invite->host->position}} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="goalkeeper_margin_b mt-1 mb-2 mx-xl-4 mx-3">

                                                <div class="aditya_location mx-xl-4 mx-3">
                                                    <h6 class="mb-0 pb-0">
                                                        <img src="{{ asset('assets/images/location_pin.svg') }}" class="" alt="location">
                                                        <!-- <i class="fa fa-map-marker" aria-hidden="true"></i> -->
                                                        <span class="fs_12px-s">{{$invite->stadium->name}}</span>
                                                    </h6>
                                                    <span class="opacity_4-s fs_11px-s">{{$invite->stadium->address}},{{$invite->stadium->city ?? ''}},{{$invite->stadium->country ?? ''}}</span>
                                                </div>

                                                <div class="row pt-3 pb-2 px-xl-4 px-3">
                                                    {{-- <div class="col-6 pr-2">
                                                        <a href="{{ route('change_status',[$invite->uuid,'rejected']) }}">
                                                        </a>
                                                            <button type="button" class="btn fs_11px-s bg_grey-s br_10px-s fg_green-s py-3 w-100 cancel_invitation " data-toggle="modal" data-target="#cancel_invitation_modal-d"><strong>Decline</strong></button>

                                                    </div> --}}

                                                    <!--SUBMIT button-->
                                                    <div class="col-12 pl-2 {{$invite->status != 'accepted' ? 'invisible' : '' }}">
                                                        <form action="{{ route('chat', $invite->host->uuid) }}" method="get">
                                                            @csrf
                                                            <button type="submit" class="btn fs_11px-s bg-white br_10px-s py-3 fg_green-s w-100">
                                                                <strong>Message</strong>
                                                            </button>
                                                            <input type="hidden" name="profile_uuid" value="{{ $invite->player->uuid}}" />
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{--end card --}}
                            @elseif (($invite->status == 'rejected') && (Auth::user()->profile->id == $invite->player->id))
                                {{-- card --}}
                                    <div class="col-12 col-md-6 col-lg-4 py-2">

                                        <div class="card home_card br_1_5rem-s">
                                            <div class="br_15px-s position-absolute bg-white fg_green-s px-4 py-1 shadow card_ticker-s">
                                                <span class="fs_12px-s d-flex align-self-center "><strong> {{$invite->status}}  </strong></span>
                                            </div>

                                            <div class="heart_icon fs_32px-s">
                                                @if($invite->player->is_my_fav == 1)
                                                <a href="{{ route('favorite',[$invite->player->uuid,0]) }}">
                                                    <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                @else
                                                <a href="{{ route('favorite',[$invite->player->uuid,1]) }}">
                                                    <i class="far fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                @endif
                                                </a>
                                                {{-- <i class="fa fa-heart" aria-hidden="true" style="font-size: 23px;"></i> --}}
                                            </div>
                                            <div class="card-body pt-2 pb-3 px-1">
                                                <div class="container-fluid px-xl-0">
                                                    <div class="row px-xl-4">
                                                        <div class="col-xl-2 col-3">
                                                            <a  href="{{ route('othersProfile', [$invite->host->user->uuid, $invite->host->uuid, $invite->host->id]) }}">
                                                                <img class="rounded-circle profile_img" src="{{ asset($invite->host->profile_image) ??  asset('assets/images/Group 24.png') }}" alt="" width="50" height="50" >
                                                            </a>
                                                        </div>
                                                        <div class="col-xl-10 col-9 ">
                                                            <div class="row ">
                                                                <div class="col-xl-5 col-12 ">
                                                                    <div class="text-white">
                                                                        <a  class = "text-white td_none-s"  href="{{ route('othersProfile', [$invite->host->user->uuid, $invite->host->uuid, $invite->host->id]) }}">
                                                                            <h6 class="mb-0 player_name-d">{{$invite->host->first_name}} {{$invite->host->last_name}}</h6>
                                                                        </a>
                                                                                    <span class=" opacity_4-s fs_11px-s"><b>@</b class="username-d">{{$invite->host->username}}</span>
                                                                        <p class="fg_yellow-s mb-2 fs_11px-s">
                                                                            @php
                                                                                $empty_rating = 5 - round($invite->host->rating);
                                                                                //  dd($empty_rating)
                                                                            @endphp
                                                                            {{-- @for ($i = 0; $i < $invite->host->rating +1; $i++) --}}
                                                                            @for ($i = 0; $i < round($invite->host->rating); $i++)
                                                                                <i class="fas fa-star" aria-hidden="true">  </i>
                                                                            @endfor
                                                                            @for ($i = 0; $i < $empty_rating; $i++)
                                                                                <i class="far fa-star" aria-hidden="true">  </i>
                                                                            @endfor

                                                                            {{-- @for ($i = 0; $i < $invite->host->rating; $i++)
                                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                                            @endfor --}}
                                                                            {{number_format($invite->host->rating, 1, '.', ',');}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-7 col-12 pb-xl-0 pb-2 d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="text-white mb-0 player_amount-d"> ${{$invite->host->price}}</h6>
                                                                        <span class="opacity_4-s text-white fs_11px-s">Match Amount</span>
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <span class="text-white fs_12px-s player_position-d"> {{$invite->host->position}} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="goalkeeper_margin_b mt-1 mb-2 mx-xl-4 mx-3">

                                                <div class="aditya_location mx-xl-4 mx-3">
                                                    <h6 class="mb-0 pb-0">
                                                        <img src="{{ asset('assets/images/location_pin.svg') }}" class="" alt="location">
                                                        <!-- <i class="fa fa-map-marker" aria-hidden="true"></i> -->
                                                        <span class="fs_12px-s">{{$invite->stadium->name}}</span>
                                                    </h6>
                                                    <span class="opacity_4-s fs_11px-s">{{$invite->stadium->address}},{{$invite->stadium->city ?? ''}},{{$invite->stadium->country ?? ''}}</span>
                                                </div>

                                                <div class="row pt-3 pb-2 px-xl-4 px-3">
                                                    {{--  <div class="col-6 pr-2">
                                                        <a href="{{ route('change_status',[$invite->uuid,'rejected']) }}">
                                                        </a>
                                                            <button type="button" class="btn fs_11px-s bg_grey-s br_10px-s fg_green-s py-3 w-100 cancel_invitation " data-toggle="modal" data-target="#cancel_invitation_modal-d"><strong>Decline</strong></button>

                                                    </div>

                                                    <!--SUBMIT button-->
                                                    <div class="col-6 pl-2">
                                                        <a href="{{ route('change_status',[$invite->uuid,'accepted']) }}">
                                                        </a>
                                                        <input class="invitation_uuid-d"  type="hidden" value="{{ $invite->uuid}}">
                                                        <button type="submit"  class="btn fs_11px-s bg-white br_10px-s py-3 fg_green-s w-100 submit_accept" data-toggle="modal" data-target="#accept_invitation_modal-d">
                                                                <strong>Accept</strong>
                                                            </button>
                                                    </div>  --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{--end card --}}

                            @endif

                        @endforeach

                    </div>
                @else
                <div class="row pt-4 pb-3 pr-xl-5 pr-3">
                        <div class="col-md-6 pr-0 col-5 pl-0 d-flex">
                            <div class="">
                                <div class="bg_green-s py-2 mt-1 w_54px-s br_right_top_bottom_10px-s"></div>

                            </div>
                            <div class="pl-2">
                                <h6 class="fs_18px-s"><strong>{{  \Carbon\Carbon::parse($invite1[0]->date_time)->format('g:i a') }}</strong></h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-7 pr-md-3 pr-0  text-right">
                            <h6 class="fg_light_grey-s fs_18px-s"> Match Finished</h6>
                        </div>
                    </div>

                    <div class="row px-xl-4 pt-2 pb-3 px-xl-5 px-2">
                        @foreach ($invite1 as $invite)
                            {{-- {{ dd($invitations, $invite) }} --}}
                            @if (($invite->status == 'pending') && (Auth::user()->profile->id == $invite->player->id))
                            {{-- card --}}
                                <div class="col-12 col-md-6 col-lg-4 py-2">

                                    <div class="card home_card br_1_5rem-s">
                                        <div class="br_15px-s position-absolute bg-white fg_green-s px-4 py-1 shadow card_ticker-s">
                                            <span class="fs_12px-s d-flex align-self-center "><strong> {{$invite->status}}  </strong></span>
                                        </div>

                                        <div class="heart_icon fs_32px-s">
                                            @if($invite->player->is_my_fav == 1)
                                            <a href="{{ route('favorite',[$invite->player->uuid,0]) }}">
                                                <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                            @else
                                            <a href="{{ route('favorite',[$invite->player->uuid,1]) }}">
                                                <i class="far fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                            @endif
                                            </a>
                                            {{-- <i class="fa fa-heart" aria-hidden="true" style="font-size: 23px;"></i> --}}
                                        </div>
                                        <div class="card-body pt-2 pb-3 px-1">
                                            <div class="container-fluid px-xl-0">
                                                <div class="row px-xl-4">
                                                    <div class="col-xl-2 col-3">
                                                        <img class="rounded-circle profile_img border_white-s" src="{{ asset($invite->host->profile_image) ??  asset('assets/images/Group 24.png') }}" alt="" width="50" height="50" >
                                                    </div>
                                                    <div class="col-xl-10 col-9 ">
                                                        <div class="row ">
                                                            <div class="col-xl-5 col-12 ">
                                                                <div class="text-white">
                                                                    <h6 class="mb-0 player_name-d">{{$invite->host->first_name}} {{$invite->host->last_name}}</h6>
                                                                    <span class=" opacity_4-s fs_11px-s"><b>@</b class="username-d">{{$invite->host->username}}</span>
                                                                    <p class="fg_yellow-s mb-2 fs_11px-s">
                                                                        @php
                                                                            $empty_rating = 5 - round($invite->host->rating);
                                                                            //  dd($empty_rating)
                                                                        @endphp
                                                                        {{-- @for ($i = 0; $i < $invite->host->rating +1; $i++) --}}
                                                                        @for ($i = 0; $i < round($invite->host->rating); $i++)
                                                                            <i class="fas fa-star " aria-hidden="true">  </i>
                                                                        @endfor
                                                                        @for ($i = 0; $i < $empty_rating; $i++)
                                                                            <i class="far fa-star " aria-hidden="true">  </i>
                                                                        @endfor

                                                                        {{-- @for ($i = 0; $i < $invite->host->rating; $i++)
                                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                                        @endfor --}}
                                                                        {{number_format($invite->host->rating, 1, '.', ',');}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-7 col-12 pb-xl-0 pb-2 d-flex justify-content-between">
                                                                <div class="">
                                                                    <h6 class="text-white mb-0 player_amount-d"> ${{$invite->host->price}}</h6>
                                                                    <span class="opacity_4-s text-white fs_11px-s">Match Amount</span>
                                                                </div>
                                                                <div class="text-right">
                                                                    <span class="text-white fs_12px-s player_position-d"> {{$invite->host->position}} </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="goalkeeper_margin_b mt-1 mb-2 mx-xl-4 mx-3">

                                            <div class="aditya_location mx-xl-4 mx-3">
                                                <h6 class="mb-0 pb-0">
                                                    <img src="{{ asset('assets/images/location_pin.svg') }}" class="" alt="location">
                                                    <!-- <i class="fa fa-map-marker" aria-hidden="true"></i> -->
                                                    <span class="fs_12px-s">{{$invite->stadium->name}}</span>
                                                </h6>
                                                <span class="opacity_4-s fs_11px-s">{{$invite->stadium->address}},{{$invite->stadium->city ?? ''}},{{$invite->stadium->country ?? ''}}</span>
                                            </div>

                                            <div class="row pt-3 pb-2 px-xl-4 px-3">
                                                <div class="col-6 pr-2">
                                                    <a href="{{ route('change_status',[$invite->uuid,'rejected']) }}">
                                                    </a>
                                                        <button type="button" class="btn fs_11px-s bg_grey-s br_10px-s fg_green-s py-3 w-100 cancel_invitation " data-toggle="modal" data-target="#cancel_invitation_modal-d"><strong>Decline</strong></button>

                                                </div>

                                                <!--SUBMIT button-->
                                                <div class="col-6 pl-2">
                                                    <a href="{{ route('change_status',[$invite->uuid,'accepted']) }}">
                                                    </a>
                                                    <input class="invitation_uuid-d"  type="hidden" value="{{ $invite->uuid}}">
                                                    <input class="player_id-d"  type="hidden" value="{{ $invite->player->id}}">
                                                    <input class="host_id-d"  type="hidden" value="{{ $invite->host->id}}">
                                                    <input class="host_user_uuid-d"  type="hidden" value="{{ $invite->host->user->uuid}}">


                                                    <button type="submit"  class="btn fs_11px-s bg-white br_10px-s py-3 fg_green-s w-100 submit_accept" data-toggle="modal" data-target="#accept_invitation_modal-d">
                                                            <strong>Accept</strong>
                                                        </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{--end card --}}
                            @elseif (($invite->status == 'accepted') && (Auth::user()->profile->id == $invite->player->id))
                                {{-- card --}}
                                    <div class="col-12 col-md-6 col-lg-4 py-2">

                                        <div class="card home_card br_1_5rem-s">
                                            <div class="br_15px-s position-absolute bg-white fg_green-s px-4 py-1 shadow card_ticker-s">
                                                <span class="fs_12px-s d-flex align-self-center "><strong> {{$invite->status}}  </strong></span>
                                            </div>

                                            <div class="heart_icon fs_32px-s">
                                                @if($invite->player->is_my_fav == 1)
                                                <a href="{{ route('favorite',[$invite->player->uuid,0]) }}">
                                                    <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                @else
                                                <a href="{{ route('favorite',[$invite->player->uuid,1]) }}">
                                                    <i class="far fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                @endif
                                                </a>
                                                {{-- <i class="fa fa-heart" aria-hidden="true" style="font-size: 23px;"></i> --}}
                                            </div>
                                            <div class="card-body pt-2 pb-3 px-1">
                                                <div class="container-fluid px-xl-0">
                                                    <div class="row px-xl-4">
                                                        <div class="col-xl-2 col-3">
                                                            <img class="rounded-circle profile_img border_white-s" src="{{ asset($invite->host->profile_image) ??  asset('assets/images/Group 24.png') }}" alt="" width="50" height="50" >
                                                        </div>
                                                        <div class="col-xl-10 col-9 ">
                                                            <div class="row ">
                                                                <div class="col-xl-5 col-12 ">
                                                                    <div class="text-white">
                                                                        <h6 class="mb-0 player_name-d">{{$invite->host->first_name}} {{$invite->host->last_name}}</h6>
                                                                        <span class=" opacity_4-s fs_11px-s"><b>@</b class="username-d">{{$invite->host->username}}</span>
                                                                        <p class="fg_yellow-s mb-2 fs_11px-s">
                                                                            @php
                                                                                $empty_rating = 5 - round($invite->host->rating);
                                                                                //  dd($empty_rating)
                                                                            @endphp
                                                                            {{-- @for ($i = 0; $i < $invite->host->rating +1; $i++) --}}
                                                                            @for ($i = 0; $i < round($invite->host->rating); $i++)
                                                                                <i class="fas fa-star" aria-hidden="true">  </i>
                                                                            @endfor
                                                                            @for ($i = 0; $i < $empty_rating; $i++)
                                                                                <i class="far fa-star" aria-hidden="true">  </i>
                                                                            @endfor

                                                                            {{-- @for ($i = 0; $i < $invite->host->rating; $i++)
                                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                                            @endfor --}}
                                                                            {{number_format($invite->host->rating, 1, '.', ',');}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-7 col-12 pb-xl-0 pb-2 d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="text-white mb-0 player_amount-d"> ${{$invite->host->price}}</h6>
                                                                        <span class="opacity_4-s text-white fs_11px-s">Match Amount</span>
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <span class="text-white fs_12px-s player_position-d"> {{$invite->host->position}} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="goalkeeper_margin_b mt-1 mb-2 mx-xl-4 mx-3">

                                                <div class="aditya_location mx-xl-4 mx-3">
                                                    <h6 class="mb-0 pb-0">
                                                        <img src="{{ asset('assets/images/location_pin.svg') }}" class="" alt="location">
                                                        <!-- <i class="fa fa-map-marker" aria-hidden="true"></i> -->
                                                        <span class="fs_12px-s">{{$invite->stadium->name}}</span>
                                                    </h6>
                                                    <span class="opacity_4-s fs_11px-s">{{$invite->stadium->address}},{{$invite->stadium->city ?? ''}},{{$invite->stadium->country ?? ''}}</span>
                                                </div>

                                                <div class="row pt-3 pb-2 px-xl-4 px-3">
                                                    {{-- <div class="col-6 pr-2">
                                                        <a href="{{ route('change_status',[$invite->uuid,'rejected']) }}">
                                                        </a>
                                                            <button type="button" class="btn fs_11px-s bg_grey-s br_10px-s fg_green-s py-3 w-100 cancel_invitation " data-toggle="modal" data-target="#cancel_invitation_modal-d"><strong>Decline</strong></button>

                                                    </div> --}}

                                                    <!--SUBMIT button-->
                                                    <div class="col-12 pl-2 {{$invite->status != 'accepted' ? 'invisible' : '' }}">
                                                        <form action="{{ route('chat', $invite->host->uuid) }}" method="get">
                                                            @csrf
                                                            <button type="submit" class="btn fs_11px-s bg-white br_10px-s py-3 fg_green-s w-100">
                                                                <strong>Message</strong>
                                                            </button>
                                                            <input type="hidden" name="profile_uuid" value="{{ $invite->player->uuid}}" />
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{--end card --}}
                            @elseif (($invite->status == 'rejected') && (Auth::user()->profile->id == $invite->player->id))
                                {{-- card --}}
                                    <div class="col-12 col-md-6 col-lg-4 py-2">

                                        <div class="card home_card br_1_5rem-s">
                                            <div class="br_15px-s position-absolute bg-white fg_green-s px-4 py-1 shadow card_ticker-s">
                                                <span class="fs_12px-s d-flex align-self-center "><strong> {{$invite->status}}  </strong></span>
                                            </div>

                                            <div class="heart_icon fs_32px-s">
                                                @if($invite->player->is_my_fav == 1)
                                                <a href="{{ route('favorite',[$invite->player->uuid,0]) }}">
                                                    <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                @else
                                                <a href="{{ route('favorite',[$invite->player->uuid,1]) }}">
                                                    <i class="far fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                @endif
                                                </a>
                                                {{-- <i class="fa fa-heart" aria-hidden="true" style="font-size: 23px;"></i> --}}
                                            </div>
                                            <div class="card-body pt-2 pb-3 px-1">
                                                <div class="container-fluid px-xl-0">
                                                    <div class="row px-xl-4">
                                                        <div class="col-xl-2 col-3">
                                                            <img class="rounded-circle profile_img border_white-s" src="{{ asset($invite->host->profile_image) ??  asset('assets/images/Group 24.png') }}" alt="" width="50" height="50" >
                                                        </div>
                                                        <div class="col-xl-10 col-9 ">
                                                            <div class="row ">
                                                                <div class="col-xl-5 col-12 ">
                                                                    <div class="text-white">
                                                                        <h6 class="mb-0 player_name-d">{{$invite->host->first_name}} {{$invite->host->last_name}}</h6>
                                                                        <span class=" opacity_4-s fs_11px-s"><b>@</b class="username-d">{{$invite->host->username}}</span>
                                                                        <p class="fg_yellow-s mb-2 fs_11px-s">
                                                                            @php
                                                                                $empty_rating = 5 - round($invite->host->rating);
                                                                                //  dd($empty_rating)
                                                                            @endphp
                                                                            {{-- @for ($i = 0; $i < $invite->host->rating +1; $i++) --}}
                                                                            @for ($i = 0; $i < round($invite->host->rating); $i++)
                                                                                <i class="fas fa-star" aria-hidden="true">  </i>
                                                                            @endfor
                                                                            @for ($i = 0; $i < $empty_rating; $i++)
                                                                                <i class="far fa-star" aria-hidden="true">  </i>
                                                                            @endfor

                                                                            {{-- @for ($i = 0; $i < $invite->host->rating; $i++)
                                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                                            @endfor --}}
                                                                            {{number_format($invite->host->rating, 1, '.', ',');}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-7 col-12 pb-xl-0 pb-2 d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="text-white mb-0 player_amount-d"> ${{$invite->host->price}}</h6>
                                                                        <span class="opacity_4-s text-white fs_11px-s">Match Amount</span>
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <span class="text-white fs_12px-s player_position-d"> {{$invite->host->position}} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="goalkeeper_margin_b mt-1 mb-2 mx-xl-4 mx-3">

                                                <div class="aditya_location mx-xl-4 mx-3">
                                                    <h6 class="mb-0 pb-0">
                                                        <img src="{{ asset('assets/images/location_pin.svg') }}" class="" alt="location">
                                                        <!-- <i class="fa fa-map-marker" aria-hidden="true"></i> -->
                                                        <span class="fs_12px-s">{{$invite->stadium->name}}</span>
                                                    </h6>
                                                    <span class="opacity_4-s fs_11px-s">{{$invite->stadium->address}},{{$invite->stadium->city ?? ''}},{{$invite->stadium->country ?? ''}}</span>
                                                </div>

                                                <div class="row pt-3 pb-2 px-xl-4 px-3">
                                                    {{--  <div class="col-6 pr-2">
                                                        <a href="{{ route('change_status',[$invite->uuid,'rejected']) }}">
                                                        </a>
                                                            <button type="button" class="btn fs_11px-s bg_grey-s br_10px-s fg_green-s py-3 w-100 cancel_invitation " data-toggle="modal" data-target="#cancel_invitation_modal-d"><strong>Decline</strong></button>

                                                    </div>

                                                    <!--SUBMIT button-->
                                                    <div class="col-6 pl-2">
                                                        <a href="{{ route('change_status',[$invite->uuid,'accepted']) }}">
                                                        </a>
                                                        <input class="invitation_uuid-d"  type="hidden" value="{{ $invite->uuid}}">
                                                        <button type="submit"  class="btn fs_11px-s bg-white br_10px-s py-3 fg_green-s w-100 submit_accept" data-toggle="modal" data-target="#accept_invitation_modal-d">
                                                                <strong>Accept</strong>
                                                            </button>
                                                    </div>  --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{--end card --}}

                            @endif
                        @endforeach


                    </div>

                @endif

            @empty
                <div class="mx-auto my-5 py-5 text-muted text-center">
                    <h6 class="mx-auto my-5 py-5 text-muted">No invitations are available at the moment. Please check back later.</h6>
                </div>
            @endforelse
        </div>
        <!-- container for invited players - end -->
    </div>

    <!-- Invitation Modal -->
    <div class="modal fade" id="accept_invitation_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--header image-->
                    <div class="row modal-header border-0 mt-4">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/accept_invitation.svg') }}" width="130" height="130" alt="send invitation">
                        </div>
                    </div>
                    <!--header image end-->

                        <div class="row modal-body ">
                            <!--modal text-->
                            <div class="col-12 text-center">
                                <h4 class="fg_green-s"><strong>ACCEPT INVITATION</strong></h4>
                                <h6 class="mb-3"><strong>Are you sure you want to accept invitation?</strong></h6>
                                <span class="opacity_4-s pt-2">Once you accept this invitation, all invitations will be declined during this time limit.</span>
                            </div>
                            <!--modal text end-->

                            <!--player info-->
                               {{--  <div class="mt-3 col-12">
                                    <span class="opacity_4-s"><strong>Inviter</strong></span>
                                    <div class="d-flex justify-content-between border px-2 py-3 br_10px-s">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/close-up-of-tulips-blooming-in-field-royalty-free-image-1584131603.jpg" class="rounded-circle" width="60" height="60" alt="player img">
                                            </div>
                                            <div class="ml-2 text-left">
                                                <h6 class="fg_green-s mb-0 player_name-d">Thamer</h6>
                                                <a href="javascript:void(0)" class="opacity_4-s fs_12px-s text-dark username-d">@thamedmd</a>
                                                <div class="">
                                                    <img class="star_img-s" src="{{ asset('assets/images/yellow_star.svg') }}" width="18" alt="star img">
                                                    <img class="star_img-s" src="{{ asset('assets/images/yellow_star.svg') }}" width="18" alt="star img">
                                                    <img class="star_img-s" src="{{ asset('assets/images/yellow_star.svg') }}" width="18" alt="star img">
                                                    <img class="star_img-s" src="{{ asset('assets/images/half_star.svg') }}" width="18" alt="star img">
                                                    <img class="star_img-s" src="{{ asset('assets/images/grey_star.svg') }}" width="18" alt="star img">
                                                    <span class="rating_star-d fs_10px-s fg_yellow-s">3.5</span>
                                                </div>
                                            </div>
                                        </div>
                                        {<div class="text-right align-self-center">
                                            <h6 class=""><strong class="player_position-d">Goalkeeper</strong></h6>
                                            <span class="opacity_4-s"><strong>Position</strong></span>
                                        </div>
                                    </div>
                                </div> --}}
                            <!--player info-->

                            <!--amount pay-->
                                <div class="col-12 mt-4">
                                    <div class="d-flex justify-content-between">
                                        <div class="opacity_4-s"><strong >Amount to pay</strong></div>
                                        <div>
                                            <img src="" alt="">
                                            <span><strong class="player_amount-d" >$12.5</strong></span>
                                        </div>
                                    </div>
                                </div>
                            <!--amount pay end-->
                        </div>
                        <div class="row px-3 pt-3 pb-5">
                                <!--NO button-->
                                <div class="col-6 pr-2">
                                    <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>NO</strong></button>
                                </div>
                                <!--NO button end-->

                                <!--YES button-->
                                <div class="col-6 pl-2">
                                    <a class='player_uuid-d' >
                                        <button type="button" class="btn bg_green-s br_10px-s py-3 text-white w-100 yes_submit-d accept_invitation-d" >
                                            <strong>YES</strong>
                                        </button>
                                    </a>
                                </div>
                                <!--YES button end-->
                            </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- after invitation accepted modal -->
    <div class="modal fade" id="select_date_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row modal-header br_up_left_right_10px-s border-0 bg_grey-s">
                        <div class="col-12 mt-2">
                            <h4><strong>DATE</strong></h4>
                        </div>
                    </div>
                    <!--modal header end-->
                    <div class="row modal-body pt-5 pb-0">
                        <div class="col-12 mb-4">
                            <div>
                                <div class="calendar"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row px-3  pb-5">
                        <!--CANCEL button-->
                        <div class="col-6 pr-2">
                            <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                        </div>
                        <!--CANCEL button end-->

                        <!--SUBMIT button-->
                        <div class="col-6 pl-2">
                            <a role="button" type="submit" id="cal" class="btn bg_green-s br_10px-s py-3 text-white w-100" data-dismiss="modal"><strong>SUBMIT</strong></a>
                        </div>
                        <!--SUBMIT button end-->
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- cancel invitation modal -->
    <div class="modal fade" id="cancel_invitation_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--header image-->
                    <div class="row modal-header border-0 mt-4">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/cancel_invitation.svg') }}" width="130" height="130" alt="send invitation">
                        </div>
                    </div>
                    <!--header image end-->

                    <div class="row modal-body ">
                        <!--modal text-->
                        <div class="col-12 text-center">
                            <h4 class="fg_green-s"><strong>CANCEL INVITATION</strong></h4>
                            <h6 class="mb-3"><strong>Are you sure you want to cancel invitation?</strong></h6>
                            <p class="opacity_4-s">Once you cancel this invitation, you can not revert this action.</p>
                        </div>
                        <!--modal text end-->

                        <!--player info-->
                        {{-- <div class="mt-3 col-12">
                            <span class="opacity_4-s"><strong>Player</strong></span>
                            <div class="d-flex justify-content-between border px-2 py-3 br_10px-s">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <img src="{{ asset('assets/images/user_img.png') }}" class="rounded-circle" width="60" height="60" alt="player img">
                                    </div>
                                    <div class="ml-2 text-left">
                                        <h6 class="fg_green-s mb-0 player_name-d">Thamer</h6>
                                        <span class="opacity_4-s fs_12px-s">@thamedmd</span>
                                        <div class="">
                                            <img class="star_img-s" src="{{ asset('assets/images/yellow_star.svg') }}" width="18" alt="star img">
                                            <img class="star_img-s" src="{{ asset('assets/images/yellow_star.svg') }}" width="18" alt="star img">
                                            <img class="star_img-s" src="{{ asset('assets/images/yellow_star.svg') }}" width="18" alt="star img">
                                            <img class="star_img-s" src="{{ asset('assets/images/half_star.svg') }}" width="18" alt="star img">
                                            <img class="star_img-s" src="{{ asset('assets/images/grey_star.svg') }}" width="18" alt="star img">
                                            <span class="rating_star-d fs_10px-s fg_yellow-s">3.5</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right align-self-center">
                                    <h6 class=""><strong class="player_position-d">Goalkeeper</strong></h6>
                                    <span class="opacity_4-s"><strong>Position</strong></span>
                                </div>
                            </div>
                        </div> --}}
                        <!--player info-->

                        <!--amount pay-->
                        {{--                         <div class="col-12 mt-4">
                            <div class="d-flex justify-content-between">
                                <div class="opacity_4-s"><strong class="player_amount-d">Amount to pay</strong></div>
                                <div>
                                    <img src="" alt="">
                                    <span><strong>$12.5</strong></span>
                                </div>
                            </div>
                        </div> --}}
                        <!--amount pay end-->
                    </div>
                    <div class="row px-3 pt-3 pb-5">
                        <!--NO button-->
                        <div class="col-6 pr-2">
                            <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100 " data-dismiss="modal" data-button="rejected">
                                <strong>NO</strong>
                            </button>
                        </div>
                        <!--NO button end-->

                        <!--YES button-->
                        <div class="col-6 pl-2">
                            <button type="button" class="btn bg_green-s br_10px-s py-3 text-white w-100 cancel_button-d"  data-button="accepted">
                                <strong>YES</strong>
                            </button>
                        </div>
                        <!--YES button end-->
                    </div>
                </div>
            </div>
        </div>
    </div>

 {{--  <form action="{{ route('game_invitation') }}" method="get" class="d-none pignose-calendar-unit-d">
                    @csrf
                    <input type="hidden" name="date" class="filter_by_date-d" value>

                </form>  --}}

        <!-- calander modal -->
    <div class="modal fade" id="slected_date_calander_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row modal-header br_up_left_right_10px-s border-0 bg_grey-s">
                        <div class="col-12 mt-2">
                            <h4><strong>DATE</strong></h4>
                        </div>
                    </div>
                    <!--modal header end-->
                    <div class="row modal-body pt-3 pb-0 px-0">
                        <div class="col-12 mb-3 px-0">
                            {{-- <div>
                                <div class="calendar wrapper"></div>
                            </div> --}}
                            <div>
                                <div class="calendar_2"></div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('game_invitation') }}" method="get" class=" pignose-calendar-unit-d">
                        @csrf
                        <div class="row px-3  pb-5">
                            <!--CANCEL button-->
                            <div class="col-6 pr-2">
                                <button  type="button" id="cancel_modal-d" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                            </div>
                            <!--CANCEL button end-->

                            <!--SUBMIT button-->
                            <div class="col-6 pl-2">
                                <button type="submit" id="cal" class="btn bg_green-s br_10px-s py-3 text-white w-100 apply_date-d"><strong>APPLY</strong></button>
                            </div>
                            <!--SUBMIT button end-->
                        </div>

                          <input type="hidden" name="date" class="filter_by_date-d" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>






@endsection
