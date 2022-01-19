@extends('layout.app')

@section('content')

<style>
    .pignose-calendar {
    -webkit-box-shadow: none !important;
}
</style>
 <div class="container-fluid px-0 mx-0 ">

        <!-- -------heading container - start -->
        <div class="container-fluid">
            <div class="row py-5 px-xl-5 justify-content-between">
                <div class="col-md-5 col-12 align-self-center">
                    <h1>
                        <Strong>Game Invitations</Strong>
                    </h1>
                    <h4>Send or accept game invitations.</h4>
                </div>
                <div class="col-md-7 col-12 justify-content-md-end mt-md-0 mt-4 d-flex align-self-center">
                    <a href="{{ url('game_invitation') }}" role="button" class="btn bg-white br_10px-s mr-2 br_green_on_hover-s fs_18px-s fg_light_grey-s py-3 w_h_216px_x_63px-s"><strong>Invitations</strong></a>
                    <a href="javascript:void(0)" class="btn bg-white br_10px-s ml-2 br_green_on_hover_active-s fg_light_grey-s fs_18px-s py-3 w_h_216px_x_63px-s"><strong>Hire Players</strong></a>
                </div>
            </div>
        </div>
        <!-- ------heading container - end -->

        {{--  {{ dd(\Carbon\Carbon::now()->format('Y-m-d')) }}  --}}

        <!-- container for hired players - start -->
        <div class="container-fluid bg-white br_47px-s">
           <div class="row pt-5 px-xl-5">
                <div class="col-12 d-flex fg_green-s">
                    <h6 class="mb-0 fs_18px-s"><strong> {{ $date ? " " : 'Today,' }}</strong></h6>&nbsp;
                    <h6 class="mb-0 fs_18px-s"><strong>{{ \Carbon\Carbon::parse($date)->format('l') ?? \Carbon\Carbon::now()->format('l')}}, {{ \Carbon\Carbon::parse($date)->format('d M Y') ??  \Carbon\Carbon::parse($date)->format('d M Y')}}</strong></h6>
                    <a href="javascript:void(0)" class="td_none-s d-flex align-self-center mx-2" data-toggle="modal" data-target="#slected_date_calander_modal-d">
                        <img src="{{ asset('assets/images/arrow_down_green.svg') }}" class="img-fluid change_img-d" width="17" alt="arrow button">
                    </a>
                </div>
                {{-- <div class="col-12 d-none mb-4 mt-3" id="toggle_calendar-d">
                    <div>
                        <div class="calendar_2"></div>
                    </div>

                </div> --}}

            </div>
            {{-- {{ dd(\Carbon\Carbon::now()->format('Y-m-d')) }} --}}
            {{-- {{  dd($date >= \Carbon\Carbon::now()->format('Y-m-d')  )   }} --}}


            @forelse ($invitations->invitations as $invitation1)
            {{--  {{ dd($invitations->invitations , $invitation1[0]) }}  --}}
             {{-- {{ dd(  \Carbon\Carbon::parse($invitation1[0]->date_time)->format('H:i:m') >= \Carbon\Carbon::now()->format('H:i:m') , $invitations) }} --}}

                @if ((\Carbon\Carbon::parse($invitation1[0]->date_time)->format('H:i:m') <= \Carbon\Carbon::now()->format('H:i:m')) && ($date >= \Carbon\Carbon::now()->format('Y-m-d')))
                    <div class="row pt-4 pb-3 pr-xl-5 pr-3">
                        <div class="col-md-6 pr-0 col-5 pl-0 d-flex">
                            <div class="">
                                <div class="bg_green-s py-2 mt-1 w_54px-s br_right_top_bottom_10px-s"></div>

                            </div>
                            <div class="pl-2">
                                <h6 class="fs_18px-s"> <strong>{{  \Carbon\Carbon::parse($invitation1[0]->date_time)->format('g:i a') }}</strong> </h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-7 pr-md-3 pr-0  text-right">
                            <h6 class="fg_light_grey-s fs_18px-s">Upcoming Matches</h6>
                        </div>
                    </div>

                    <div class="row px-xl-4 pt-2 pb-3 px-xl-5 px-2">
                        @foreach ($invitation1 as $invitation)

                            {{--  @foreach ($invitations as $invitation)  --}}
                                    {{--  {{ dd($invitations, $invitation) }}  --}}


                            {{-- {{ var_dump($invitation) }} --}}
                            @if (($invitation->status == 'accepted'))
                                {{-- {{ dd(Auth::user()->profile->id == $invitation->host_id) }} --}}
                                <div class="col-12 col-md-6 col-lg-4 py-2">

                                    <div class="card home_card br_1_5rem-s">
                                        <div class="br_15px-s position-absolute bg-white fg_green-s px-4 py-1 shadow card_ticker-s">
                                            <span class="d-flex align-self-center fs_12px-s"><strong>{{ $invitation->status }}</strong></span>
                                        </div>

                                        <div class="heart_icon fs_32px-s">
                                            @if($invitation->player->is_my_fav == 1)
                                                <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                @else
                                                <i class="far fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                            @endif
                                            {{--  <i class="fa fa-heart" style="font-size: 23px;" aria-hidden="true"></i>  --}}
                                        </div>
                                        <div class="card-body pt-2 pb-3 px-1">
                                            <div class="container-fluid px-xl-0">
                                                <div class="row px-xl-4">
                                                    <div class="col-xl-2 col-3">
                                                        <a href="{{ route('othersProfile', [$invitation->player->user->uuid, $invitation->player->uuid, $invitation->player->id]) }}">
                                                            <img class="rounded-circle profile_img border_white-s" src="{{asset($invitation->player->profile_image) ?? asset('assets/images/Group 24.png') }}" width="50" height="50"alt="">
                                                        </a>
                                                    </div>
                                                    <div class="col-xl-10 col-9 ">
                                                        <div class="row ">
                                                            <div class="col-xl-5 col-12 ">
                                                                <div class="text-white">
                                                                    <a class = "text-white td_none-s"  href="{{ route('othersProfile', [$invitation->player->user->uuid, $invitation->player->uuid, $invitation->player->id]) }}">
                                                                        <h6 class="mb-0">{{$invitation->player->first_name}} {{$invitation->player->last_name}}</h6>
                                                                    </a>
                                                                    <span class=" opacity_4-s fs_11px-s"><b>@</b class="username-d">{{$invitation->player->username}}</span>
                                                                    <p class="fg_yellow-s mb-2 fs_11px-s">
                                                                        @php
                                                                            $empty_rating = 5 - round($invitation->player->rating);
                                                                            //  dd($empty_rating)
                                                                        @endphp
                                                                        {{-- @for ($i = 0; $i < $invitation->player->rating +1; $i++) --}}
                                                                        @for ($i = 0; $i < round($invitation->player->rating); $i++)
                                                                            <i class="fas fa-star " aria-hidden="true">  </i>
                                                                        @endfor
                                                                        @for ($i = 0; $i < $empty_rating; $i++)
                                                                            <i class="far fa-star " aria-hidden="true">  </i>
                                                                        @endfor
                                                                        {{-- @for ($i = 0; $i < $invitation->player->rating; $i++)
                                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                                        @endfor --}}
                                                                        {{number_format($invitation->player->rating, 1, '.', ',');}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-7 col-12 pb-xl-0 pb-2 d-flex justify-content-between">
                                                                <div class="">
                                                                    <h6 class="text-white mb-0"> ${{$invitation->player->price}} </h6>
                                                                    <span class="opacity_4-s text-white fs_11px-s">Match Amount</span>
                                                                </div>
                                                                <div class="text-right">
                                                                    <span class="text-white fs_12px-s">{{$invitation->player->position}}</span>
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
                                                    <span class="fs_12px-s">{{$invitation->stadium->name}}</span>
                                                </h6>
                                                <span class="opacity_4-s fs_11px-s">{{$invitation->stadium->address}},{{$invitation->stadium->city ?? ''}},{{$invitation->stadium->country ?? ''}}</span>
                                            </div>

                                                <div class="row pt-3 pb-2 px-4">
                                                    {{--  <div class="col-6 pr-2 {{$invitation->status != 'accepted' ? 'invisible' : ''}} " >
                                                        <a href="{{ route('ratePlayer', $invitation->player->uuid) }}">
                                                            <button type="button" class="btn fs_11px-s bg_grey-s br_10px-s fg_green-s py-3 w-100"><strong>Rate</strong></button>
                                                        </a>
                                                    </div>  --}}

                                                    {{--  {{ dd($invitation) }}  --}}
                                                    <!--SUBMIT button-->
                                                    <div class="col-12 pl-2 {{$invitation->status != 'accepted' ? 'invisible' : '' }}">
                                                            <form action="{{ route('chat', $invitation->player->uuid) }}" method="get">
                                                                @csrf
                                                            <button type="submit" class="btn fs_11px-s bg-white br_10px-s py-3 fg_green-s w-100">
                                                                <strong>Message</strong>
                                                            </button>
                                                            <input type="hidden" name="profile_uuid" value="{{ $invitation->host->uuid}}" />
                                                        </form>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>


                            @elseif($invitation->status == 'pending')
                                    {{--  <h2>hello host</h2>  --}}
                                <div class="col-12 col-md-6 col-lg-4 py-2">

                                    <div class="card home_card br_1_5rem-s">
                                        <div class="br_15px-s position-absolute bg-white fg_green-s px-4 py-1 shadow card_ticker-s">
                                            <span class="fs_12px-s d-flex align-self-center "><strong> {{$invitation->status}}  </strong></span>
                                        </div>
                                        <div class="heart_icon fs_32px-s">
                                            @if($invitation->player->is_my_fav == 1)
                                            <a href="{{ route('favorite',[$invitation->player->uuid,0]) }}">
                                                <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                            @else
                                            <a href="{{ route('favorite',[$invitation->player->uuid,1]) }}">
                                                <i class="far fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                            @endif
                                            </a>
                                            {{--  <i class="fa fa-heart" aria-hidden="true" style="font-size: 23px;"></i>  --}}
                                        </div>
                                        <div class="card-body pt-2 pb-3 px-1">
                                            <div class="container-fluid px-xl-0">
                                                <div class="row px-xl-4">
                                                    <div class="col-xl-2 col-3">
                                                        <a href="{{ route('othersProfile', [$invitation->player->user->uuid, $invitation->player->uuid, $invitation->player->id]) }}">
                                                            <img class="rounded-circle profile_img border_white-s" src="{{asset($invitation->player->profile_image) ?? asset('assets/images/Group 24.png') }}" width="50" height="50"alt="">
                                                        </a>
                                                    </div>
                                                    <div class="col-xl-10 col-9 ">
                                                        <div class="row ">
                                                            <div class="col-xl-5 col-12 ">
                                                                <div class="text-white">
                                                                    <a class = "text-white td_none-s"  href="{{ route('othersProfile', [$invitation->player->user->uuid, $invitation->player->uuid, $invitation->player->id]) }}">
                                                                        <h6 class="mb-0">{{$invitation->player->first_name}} {{$invitation->player->last_name}}</h6>
                                                                    </a>
                                                                    <span class=" opacity_4-s fs_11px-s"><b>@</b class="username-d">{{$invitation->player->username}}</span>
                                                                    <p class="fg_yellow-s mb-2 fs_11px-s">
                                                                        @php
                                                                            $empty_rating = 5 - round($invitation->player->rating);
                                                                            //  dd($empty_rating)
                                                                        @endphp
                                                                        {{-- @for ($i = 0; $i < $invitation->player->rating +1; $i++) --}}
                                                                        @for ($i = 0; $i < round($invitation->player->rating); $i++)
                                                                            <i class="fas fa-star" aria-hidden="true">  </i>
                                                                        @endfor
                                                                        @for ($i = 0; $i < $empty_rating; $i++)
                                                                            <i class="far fa-star" aria-hidden="true">  </i>
                                                                        @endfor

                                                                        {{-- @for ($i = 0; $i < $invitation->player->rating; $i++)
                                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                                        @endfor --}}
                                                                        {{number_format($invitation->player->rating, 1, '.', ',');}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-7 col-12 pb-xl-0 pb-2 d-flex justify-content-between">
                                                                <div class="">
                                                                    <h6 class="text-white mb-0 player_amount-d"> ${{$invitation->player->price}}</h6>
                                                                    <span class="opacity_4-s text-white fs_11px-s">Match Amount</span>
                                                                </div>
                                                                <div class="text-right">
                                                                    <span class="text-white fs_12px-s player_position-d"> {{$invitation->player->position}} </span>
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
                                                    <span class="fs_12px-s">{{$invitation->stadium->name}}</span>
                                                </h6>
                                                <span class="opacity_4-s fs_11px-s">{{$invitation->stadium->address}},{{$invitation->stadium->city ?? ''}},{{$invitation->stadium->country ?? ''}}</span>
                                            </div>

                                            <div class="row pt-3 pb-2 px-xl-4 px-3">
                                                {{--  <div class="col-6 pr-2">
                                                    <a href="{{ route('change_status',[$invitation->uuid,'rejected']) }}">
                                                    </a>
                                                        <button type="button" class="btn fs_11px-s bg_grey-s br_10px-s fg_green-s py-3 w-100 cancel_invitation " data-toggle="modal" data-target="#cancel_invitation_modal-d"><strong>Decline</strong></button>

                                                </div>  --}}

                                                <!--SUBMIT button-->
                                                <div class="col-12 pl-2">
                                                    <a href="{{ route('cancelInvitation',[$invitation->uuid]) }}">
                                                    </a>
                                                    <input class="invitation_uuid-d"  type="hidden" value="{{ $invitation->uuid}}">
                                                    <button type="submit"  class="btn fs_11px-s bg-white br_10px-s py-3 fg_green-s py-3 w-100 cancel_invitation_by_host" data-toggle="modal" data-target="#cancel_invitation_by_host_modal-d">
                                                        <strong>Cancel</strong>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @elseif (($invitation->status == 'rejected'))
                                {{-- card --}}
                                <div class="col-12 col-md-6 col-lg-4 py-2">

                                    <div class="card home_card br_1_5rem-s">
                                        <div class="br_15px-s position-absolute bg-white fg_green-s px-4 py-1 shadow card_ticker-s">
                                            <span class="fs_12px-s d-flex align-self-center "><strong> {{$invitation->status}}  </strong></span>
                                        </div>

                                        <div class="heart_icon fs_32px-s">
                                                @if($invitation->player->is_my_fav == 1)
                                                <a href="{{ route('favorite',[$invitation->player->uuid,0]) }}">
                                                    <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                @else
                                                <a href="{{ route('favorite',[$invitation->player->uuid,1]) }}">
                                                    <i class="far fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                @endif
                                                </a>
                                            {{--  <i class="fa fa-heart" aria-hidden="true" style="font-size: 23px;"></i>  --}}
                                        </div>
                                        <div class="card-body pt-2 pb-3 px-1">
                                            <div class="container-fluid px-xl-0">
                                                <div class="row px-xl-4">
                                                    <div class="col-xl-2 col-3">
                                                        <a href="{{ route('othersProfile', [$invitation->player->user->uuid, $invitation->player->uuid, $invitation->player->id]) }}">
                                                            <img class="rounded-circle profile_img border_white-s" src="{{asset($invitation->player->profile_image) ?? asset('assets/images/Group 24.png') }}" width="50" height="50"alt="">
                                                        </a>
                                                    </div>
                                                    <div class="col-xl-10 col-9 ">
                                                        <div class="row ">
                                                            <div class="col-xl-5 col-12 ">
                                                                <div class="text-white">
                                                                    <a class = "text-white td_none-s"  href="{{ route('othersProfile', [$invitation->player->user->uuid, $invitation->player->uuid, $invitation->player->id]) }}">
                                                                        <h6 class="mb-0">{{$invitation->player->first_name}} {{$invitation->player->last_name}}</h6>
                                                                    </a>
                                                                    <span class=" opacity_4-s fs_11px-s"><b>@</b class="username-d">{{$invitation->host->username}}</span>
                                                                    <p class="fg_yellow-s mb-2 fs_11px-s">
                                                                        @php
                                                                            $empty_rating = 5 - round($invitation->player->rating);
                                                                            //  dd($empty_rating)
                                                                        @endphp
                                                                        {{-- @for ($i = 0; $i < $invitation->player->rating +1; $i++) --}}
                                                                        @for ($i = 0; $i < round($invitation->player->rating); $i++)
                                                                            <i class="fas fa-star" aria-hidden="true">  </i>
                                                                        @endfor
                                                                        @for ($i = 0; $i < $empty_rating; $i++)
                                                                            <i class="far fa-star" aria-hidden="true">  </i>
                                                                        @endfor

                                                                        {{-- @for ($i = 0; $i < $invitation->host->rating; $i++)
                                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                                        @endfor --}}
                                                                        {{number_format($invitation->host->rating, 1, '.', ',');}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-7 col-12 pb-xl-0 pb-2 d-flex justify-content-between">
                                                                <div class="">
                                                                    <h6 class="text-white mb-0 player_amount-d"> ${{$invitation->host->price}}</h6>
                                                                    <span class="opacity_4-s text-white fs_11px-s">Match Amount</span>
                                                                </div>
                                                                <div class="text-right">
                                                                    <span class="text-white fs_12px-s player_position-d"> {{$invitation->host->position}} </span>
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
                                                    <span class="fs_12px-s">{{$invitation->stadium->name}}</span>
                                                </h6>
                                                <span class="opacity_4-s fs_11px-s">{{$invitation->stadium->address}},{{$invitation->stadium->city ?? ''}},{{$invitation->stadium->country ?? ''}}</span>
                                            </div>

                                            <div class="row pt-3 pb-2 px-xl-4 px-3">
                                                {{-- <div class="col-6 pr-2">
                                                    <a href="{{ route('change_status',[$invitation->uuid,'rejected']) }}">
                                                    </a>
                                                        <button type="button" class="btn fs_11px-s bg_grey-s br_10px-s fg_green-s py-3 w-100 cancel_invitation " data-toggle="modal" data-target="#cancel_invitation_modal-d"><strong>Decline</strong></button>

                                                </div> --}}

                                                <!--SUBMIT button-->
                                                <div class="col-6 pl-2 invisible">
                                                    <a href="{{ route('change_status',[$invitation->uuid,'accepted']) }}">
                                                    </a>
                                                    <input class="invitation_uuid-d"  type="hidden" value="{{ $invitation->uuid}}">
                                                    <button type="submit"  class="btn fs_11px-s bg-white br_10px-s py-3 fg_green-s w-100 submit_accept " data-toggle="modal" data-target="#accept_invitation_modal-d" >
                                                            <strong >Accept</strong>
                                                        </button>
                                                </div>
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
                                    <h6 class="fs_18px-s"> <strong>{{  \Carbon\Carbon::parse($invitation1[0]->date_time)->format('g:i a') }}</strong> </h6>
                                </div>
                            </div>
                            <div class="col-md-6 col-7 pr-md-3 pr-0  text-right">
                                <h6 class="fg_light_grey-s fs_18px-s"> Match Finished</h6>
                            </div>
                        </div>
                        <div class="row px-xl-4 pt-2 pb-3 px-xl-5 px-2">
                            @foreach ($invitation1 as $invitation)

                                {{--  @forelse ($invitations as $invitation)  --}}
                                        {{--  {{ dd($invitations, $invitation) }}  --}}


                                {{-- {{ var_dump($invitation) }} --}}
                                @if (($invitation->status == 'accepted'))
                                    {{-- {{ dd(Auth::user()->profile->id == $invitation->host_id) }} --}}
                                    <div class="col-12 col-md-6 col-lg-4 py-2">

                                        <div class="card home_card br_1_5rem-s">
                                            <div class="br_15px-s position-absolute bg-white fg_green-s px-4 py-1 shadow card_ticker-s">
                                                <span class="d-flex align-self-center fs_12px-s"><strong>{{ $invitation->status }}</strong></span>
                                            </div>

                                            <div class="heart_icon fs_32px-s">
                                                @if($invitation->player->is_my_fav == 1)
                                                    <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                    @else
                                                    <i class="far fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                @endif
                                                {{--  <i class="fa fa-heart" style="font-size: 23px;" aria-hidden="true"></i>  --}}
                                            </div>
                                            <div class="card-body pt-2 pb-3 px-1">
                                                <div class="container-fluid px-xl-0">
                                                    <div class="row px-xl-4">
                                                        <div class="col-xl-2 col-3">
                                                            <a href="{{ route('othersProfile', [$invitation->player->user->uuid, $invitation->player->uuid, $invitation->player->id]) }}">
                                                                <img class="rounded-circle profile_img border_white-s" src="{{asset($invitation->player->profile_image) ?? asset('assets/images/Group 24.png') }}" width="50" height="50"alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-xl-10 col-9 ">
                                                            <div class="row ">
                                                                <div class="col-xl-5 col-12 ">
                                                                    <div class="text-white">
                                                                         <a class = "text-white td_none-s"  href="{{ route('othersProfile', [$invitation->player->user->uuid, $invitation->player->uuid, $invitation->player->id]) }}">
                                                                            <h6 class="mb-0">{{$invitation->player->first_name}} {{$invitation->player->last_name}}</h6>
                                                                        </a>

                                                                        <span class=" opacity_4-s fs_11px-s"><b>@</b class="username-d">{{$invitation->player->username}}</span>
                                                                        <p class="fg_yellow-s mb-2 fs_11px-s">
                                                                            @php
                                                                                $empty_rating = 5 - round($invitation->player->rating);
                                                                                //  dd($empty_rating)
                                                                            @endphp
                                                                            {{-- @for ($i = 0; $i < $invitation->player->rating +1; $i++) --}}
                                                                            @for ($i = 0; $i < round($invitation->player->rating); $i++)
                                                                                <i class="fas fa-star " aria-hidden="true">  </i>
                                                                            @endfor
                                                                            @for ($i = 0; $i < $empty_rating; $i++)
                                                                                <i class="far fa-star " aria-hidden="true">  </i>
                                                                            @endfor
                                                                            {{-- @for ($i = 0; $i < $invitation->player->rating; $i++)
                                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                                            @endfor --}}
                                                                            {{number_format($invitation->player->rating, 1, '.', ',');}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-7 col-12 pb-xl-0 pb-2 d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="text-white mb-0"> ${{$invitation->player->price}} </h6>
                                                                        <span class="opacity_4-s text-white fs_11px-s">Match Amount</span>
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <span class="text-white fs_12px-s">{{$invitation->player->position}}</span>
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
                                                        <span class="fs_12px-s">{{$invitation->stadium->name}}</span>
                                                    </h6>
                                                    <span class="opacity_4-s fs_11px-s">{{$invitation->stadium->address}},{{$invitation->stadium->city ?? ''}},{{$invitation->stadium->country ?? ''}}</span>
                                                </div>

                                                    <div class="row pt-3 pb-2 px-4">
                                                        <div class="col-6 pr-2 {{$invitation->status != 'accepted' ? 'invisible' : ''}} " >
                                                            {{-- <a href="{{ route('ratePlayer', $invitation->player->uuid) }}" > --}}
                                                                {{-- <button type="button" class="btn fs_11px-s bg_grey-s br_10px-s fg_green-s py-3 w-100" data-toggle="modal" data-target="#player_played_modal-d"> --}}
                                                                <button type="button" class="btn fs_11px-s bg_grey-s br_10px-s fg_green-s py-3 w-100 rate_played_user_player-d">
                                                                    <strong>Rate</strong>
                                                                    <input type="hidden" name="" class="rated_player_uuid" value="{{$invitation->player->uuid  }}">
                                                                    <input type="hidden" name="" class="rated_player_invitation_uuid" value="{{ $invitation->uuid  }}">
                                                                </button>
                                                            {{-- </a> --}}
                                                        </div>

                                                           <!-- Modal -->
                                                            <div class="modal fade" id="player_played_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered ">
                                                                    <div class="modal-content br_10px-s border-0">
                                                                        <div class="container-fluid">
                                                                            <!--header image-->
                                                                            <div class="row modal-header border-0 mt-3">
                                                                                <div class="col-12 text-center">
                                                                                    <img src="{{asset($invitation->player->profile_image) ?? asset('assets/images/Group 24.png') }}" class="rounded-circle b_5px-s shadow" width="150" alt="player img">
                                                                                </div>
                                                                            </div>
                                                                            <!--header image end-->

                                                                            <div class="row modal-body text-center">
                                                                                <!--modal text-->
                                                                                <div class="col-12 ">
                                                                                    <h4 class="fg_green-s">{{$invitation->player->first_name}} {{$invitation->player->last_name}}</h4>
                                                                                    <a href="javascript:void(0)">
                                                                                        <h5 class="opacity_4-s text-dark"><strong>@ {{$invitation->player->username}}</strong></h5>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="col-12 mt-3">
                                                                                    <h6><strong>Did {{$invitation->player->first_name}} {{$invitation->player->last_name}} played this match?</strong></h6>
                                                                                </div>
                                                                                <div class="col-12 mt-3">
                                                                                    <p class="opacity_4-s">You can rate this only if he played this match? After confirming this, you can not revert it.</p>
                                                                                </div>
                                                                                <!--modal text end-->
                                                                            </div>
                                                                            <div class="row px-3 pt-3 pb-5">
                                                                                <!--NO button-->
                                                                                <div class="col-6 pr-2">
                                                                                    <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100 show_no_modal-d" ><strong>No</strong></button>
                                                                                </div>
                                                                                <!--NO button end-->

                                                                                <!--YES button-->
                                                                                <div class="col-6 pl-2">
                                                                                    <a href="{{ route('ratePlayer', [$invitation->player->uuid, $invitation->id]) }}" >
                                                                                        <button type="button" class="btn bg_green-s br_10px-s py-3 text-white w-100"><strong>Yes</strong></button>
                                                                                    </a>
                                                                                </div>
                                                                                <!--YES button end-->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                               <!--player not played Modal -->
                                                                <div class="modal fade" id="player_not_played_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered ">
                                                                        <div class="modal-content br_10px-s border-0">
                                                                            <div class="container-fluid">
                                                                                <!--header image-->
                                                                                <div class="row modal-header border-0 mt-3">
                                                                                    <div class="col-12 text-center">
                                                                                        <img src="{{asset($invitation->player->profile_image) ?? asset('assets/images/Group 24.png') }}" class="rounded-circle b_5px-s shadow" width="150" alt="player img">
                                                                                    </div>
                                                                                </div>
                                                                                <!--header image end-->

                                                                                <div class="row modal-body text-center">
                                                                                    <!--modal text-->
                                                                                    <div class="col-12 ">
                                                                                        <h4 class="fg_green-s">{{$invitation->player->first_name}} {{$invitation->player->last_name}}</h4>
                                                                                        <a href="javascript:void(0)">
                                                                                            <h5 class="opacity_4-s text-dark"><strong>@ {{$invitation->player->username}}</strong></h5>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="col-12 mt-3">
                                                                                        <h5><strong>Sorry</strong></h5>
                                                                                        <h5><strong>You can not rate him!!</strong></h5>
                                                                                    </div>
                                                                                    <div class="col-12 mt-3">
                                                                                        <p class="opacity_4-s">You confirm that {{$invitation->player->first_name}} {{$invitation->player->last_name}} did not played this match.</p>
                                                                                    </div>
                                                                                    <!--modal text end-->
                                                                                </div>
                                                                                <div class="row px-3 pt-2 pb-5">
                                                                                    <!--close button-->
                                                                                    <div class="col-12">
                                                                                        <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>Close</strong></button>
                                                                                    </div>
                                                                                    <!--close button end-->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                        {{--  {{ dd($invitation) }}  --}}
                                                        <!--SUBMIT button-->
                                                        <div class="col-6 pl-2 {{$invitation->status != 'accepted' ? 'invisible' : '' }}">
                                                                <form action="{{ route('chat', $invitation->player->uuid) }}" method="get">
                                                                    @csrf
                                                                <button type="submit" class="btn fs_11px-s bg-white br_10px-s py-3 fg_green-s w-100">
                                                                    <strong>Message</strong>
                                                                </button>
                                                                <input type="hidden" name="profile_uuid" value="{{ $invitation->host->uuid}}" />
                                                            </form>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>


                                @elseif($invitation->status == 'pending')
                                        {{--  <h2>hello host</h2>  --}}
                                    <div class="col-12 col-md-6 col-lg-4 py-2">

                                        <div class="card home_card br_1_5rem-s">
                                            <div class="br_15px-s position-absolute bg-white fg_green-s px-4 py-1 shadow card_ticker-s">
                                                <span class="fs_12px-s d-flex align-self-center "><strong> {{$invitation->status}}  </strong></span>
                                            </div>
                                            <div class="heart_icon fs_32px-s">
                                                @if($invitation->player->is_my_fav == 1)
                                                <a href="{{ route('favorite',[$invitation->player->uuid,0]) }}">
                                                    <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                @else
                                                <a href="{{ route('favorite',[$invitation->player->uuid,1]) }}">
                                                    <i class="far fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                @endif
                                                </a>
                                                {{--  <i class="fa fa-heart" aria-hidden="true" style="font-size: 23px;"></i>  --}}
                                            </div>
                                            <div class="card-body pt-2 pb-3 px-1">
                                                <div class="container-fluid px-xl-0">
                                                    <div class="row px-xl-4">
                                                        <div class="col-xl-2 col-3">
                                                            <a href="{{ route('othersProfile', [$invitation->player->user->uuid, $invitation->player->uuid, $invitation->player->id]) }}">
                                                                <img class="rounded-circle profile_img border_white-s" src="{{asset($invitation->player->profile_image) ?? asset('assets/images/Group 24.png') }}" width="50" height="50"alt="">
                                                            </a>

                                                        </div>
                                                        <div class="col-xl-10 col-9 ">
                                                            <div class="row ">
                                                                <div class="col-xl-5 col-12 ">
                                                                    <div class="text-white">
                                                                        <a class = "text-white td_none-s"  href="{{ route('othersProfile', [$invitation->player->user->uuid, $invitation->player->uuid, $invitation->player->id]) }}">
                                                                            <h6 class="mb-0">{{$invitation->player->first_name}} {{$invitation->player->last_name}}</h6>
                                                                        </a>

                                                                        <span class=" opacity_4-s fs_11px-s"><b>@</b class="username-d">{{$invitation->player->username}}</span>
                                                                        <p class="fg_yellow-s mb-2 fs_11px-s">
                                                                            @php
                                                                                $empty_rating = 5 - round($invitation->player->rating);
                                                                                //  dd($empty_rating)
                                                                            @endphp
                                                                            {{-- @for ($i = 0; $i < $invitation->player->rating +1; $i++) --}}
                                                                            @for ($i = 0; $i < round($invitation->player->rating); $i++)
                                                                                <i class="fas fa-star " aria-hidden="true">  </i>
                                                                            @endfor
                                                                            @for ($i = 0; $i < $empty_rating; $i++)
                                                                                <i class="far fa-star " aria-hidden="true">  </i>
                                                                            @endfor

                                                                            {{-- @for ($i = 0; $i < $invitation->player->rating; $i++)
                                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                                            @endfor --}}
                                                                            {{number_format($invitation->player->rating, 1, '.', ',');}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-7 col-12 pb-xl-0 pb-2 d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="text-white mb-0 player_amount-d"> ${{$invitation->player->price}}</h6>
                                                                        <span class="opacity_4-s text-white fs_11px-s">Match Amount</span>
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <span class="text-white fs_12px-s player_position-d"> {{$invitation->player->position}} </span>
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
                                                        <span class="fs_12px-s">{{$invitation->stadium->name}}</span>
                                                    </h6>
                                                    <span class="opacity_4-s fs_11px-s">{{$invitation->stadium->address}},{{$invitation->stadium->city ?? ''}},{{$invitation->stadium->country ?? ''}}</span>
                                                </div>

                                                <div class="row pt-3 pb-2 px-xl-4 px-3">
                                                    {{--  <div class="col-6 pr-2">
                                                        <a href="{{ route('change_status',[$invitation->uuid,'rejected']) }}">
                                                        </a>
                                                            <button type="button" class="btn fs_11px-s bg_grey-s br_10px-s fg_green-s py-3 w-100 cancel_invitation " data-toggle="modal" data-target="#cancel_invitation_modal-d"><strong>Decline</strong></button>

                                                    </div>  --}}

                                                    <!--SUBMIT button-->
                                                    <div class="col-12 pl-2">
                                                        <a href="{{ route('cancelInvitation',[$invitation->uuid]) }}">
                                                        </a>
                                                        <input class="invitation_uuid-d"  type="hidden" value="{{ $invitation->uuid}}">
                                                        <button type="submit"  class="btn fs_11px-s bg-white br_10px-s py-3 fg_green-s py-3 w-100 cancel_invitation_by_host" data-toggle="modal" data-target="#cancel_invitation_by_host_modal-d">
                                                            <strong>Cancel</strong>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                @elseif (($invitation->status == 'rejected'))
                                    {{-- card --}}
                                    <div class="col-12 col-md-6 col-lg-4 py-2">

                                        <div class="card home_card br_1_5rem-s">
                                            <div class="br_15px-s position-absolute bg-white fg_green-s px-4 py-1 shadow card_ticker-s">
                                                <span class="fs_12px-s d-flex align-self-center "><strong> {{$invitation->status}}  </strong></span>
                                            </div>

                                            <div class="heart_icon fs_32px-s">
                                                    @if($invitation->player->is_my_fav == 1)
                                                    <a href="{{ route('favorite',[$invitation->player->uuid,0]) }}">
                                                        <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                    @else
                                                    <a href="{{ route('favorite',[$invitation->player->uuid,1]) }}">
                                                        <i class="far fa-heart fs_32px_heart-s" aria-hidden="true"></i>
                                                    @endif
                                                    </a>
                                                {{--  <i class="fa fa-heart" aria-hidden="true" style="font-size: 23px;"></i>  --}}
                                            </div>
                                            <div class="card-body pt-2 pb-3 px-1">
                                                <div class="container-fluid px-xl-0">
                                                    <div class="row px-xl-4">
                                                        <div class="col-xl-2 col-3">
                                                            <a href="{{ route('othersProfile', [$invitation->player->user->uuid, $invitation->player->uuid, $invitation->player->id]) }}">
                                                                <img class="rounded-circle profile_img border_white-s" src="{{asset($invitation->player->profile_image) ?? asset('assets/images/Group 24.png') }}" width="50" height="50"alt="">
                                                            </a>

                                                        </div>
                                                        <div class="col-xl-10 col-9 ">
                                                            <div class="row ">
                                                                <div class="col-xl-5 col-12 ">
                                                                    <div class="text-white">
                                                                        <a class = "text-white td_none-s"  href="{{ route('othersProfile', [$invitation->player->user->uuid, $invitation->player->uuid, $invitation->player->id]) }}">
                                                                            <h6 class="mb-0">{{$invitation->player->first_name}} {{$invitation->player->last_name}}</h6>
                                                                        </a>

                                                                        {{--  <h6 class="mb-0 player_name-d">{{$invitation->host->first_name}} {{$invitation->host->last_name}}</h6>  --}}
                                                                        <span class=" opacity_4-s fs_11px-s"><b>@</b class="username-d">{{$invitation->host->username}}</span>
                                                                        <p class="fg_yellow-s mb-2 fs_11px-s">
                                                                            @php
                                                                                $empty_rating = 5 - round($invitation->player->rating);
                                                                                //  dd($empty_rating)
                                                                            @endphp
                                                                            {{-- @for ($i = 0; $i < $invitation->player->rating +1; $i++) --}}
                                                                            @for ($i = 0; $i < round($invitation->player->rating); $i++)
                                                                                <i class="fas fa-star" aria-hidden="true">  </i>
                                                                            @endfor
                                                                            @for ($i = 0; $i < $empty_rating; $i++)
                                                                                <i class="far fa-star" aria-hidden="true">  </i>
                                                                            @endfor

                                                                            {{-- @for ($i = 0; $i < $invitation->host->rating; $i++)
                                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                                            @endfor --}}
                                                                            {{number_format($invitation->host->rating, 1, '.', ',');}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-7 col-12 pb-xl-0 pb-2 d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="text-white mb-0 player_amount-d"> ${{$invitation->host->price}}</h6>
                                                                        <span class="opacity_4-s text-white fs_11px-s">Match Amount</span>
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <span class="text-white fs_12px-s player_position-d"> {{$invitation->host->position}} </span>
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
                                                        <span class="fs_12px-s">{{$invitation->stadium->name}}</span>
                                                    </h6>
                                                    <span class="opacity_4-s fs_11px-s">{{$invitation->stadium->address}},{{$invitation->stadium->city ?? ''}},{{$invitation->stadium->country ?? ''}}</span>
                                                </div>

                                                <div class="row pt-3 pb-2 px-xl-4 px-3">
                                                    {{-- <div class="col-6 pr-2">
                                                        <a href="{{ route('change_status',[$invitation->uuid,'rejected']) }}">
                                                        </a>
                                                            <button type="button" class="btn fs_11px-s bg_grey-s br_10px-s fg_green-s py-3 w-100 cancel_invitation " data-toggle="modal" data-target="#cancel_invitation_modal-d"><strong>Decline</strong></button>

                                                    </div> --}}

                                                    <!--SUBMIT button-->
                                                    <div class="col-12 pl-2 invisible">
                                                        <a href="{{ route('change_status',[$invitation->uuid,'accepted']) }}">
                                                        </a>
                                                        <input class="invitation_uuid-d"  type="hidden" value="{{ $invitation->uuid}}">
                                                        <button type="submit"  class="btn fs_11px-s bg-white br_10px-s py-3 fg_green-s w-100 submit_accept " data-toggle="modal" data-target="#accept_invitation_modal-d" >
                                                                <strong >Accept</strong>
                                                            </button>
                                                    </div>
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
                        <h6 class="mx-auto my-5 py-5 text-muted">No invitations for hiring</h6>
                    </div>
            @endforelse



            {{--  <div class="row pt-4 pb-3 pr-xl-5 pr-3">
                <div class="col-md-6 pr-0 col-5 pl-0 d-flex">
                    <div class="">
                        <div class="bg_green-s py-2 mt-1 w_54px-s br_right_top_bottom_10px-s"></div>

                    </div>
                    <div class="pl-2">
                        <h6 class="fs_18px-s"> <strong>09:15 am</strong> </h6>
                    </div>
                </div>
                <div class="col-md-6 col-7 pr-md-3 pr-0  text-right">
                    <h6 class="fg_light_grey-s fs_18px-s">Match Finished</h6>
                </div>
            </div>


            <div class="row px-xl-4 pt-2 pb-3 px-xl-5 px-2">

                <div class="col-12 col-md-6 col-lg-4 py-2">

                    <div class="card home_card br_1_5rem-s">
                        <div class="br_15px-s position-absolute bg-white fg_green-s px-4 py-1 shadow card_ticker-s">
                            <span class="d-flex align-self-center fs_12px-s"><strong>Accepted</strong></span>
                        </div>

                        <div class="heart_icon fs_32px-s">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </div>
                        <div class="card-body pt-2 pb-3 px-1">
                            <div class="container-fluid px-xl-0">
                                <div class="row px-xl-4">
                                    <div class="col-xl-2 col-3">
                                        <img src="{{ asset('assets/images/Group 24.png') }}" alt="">
                                    </div>
                                    <div class="col-xl-10 col-9 ">
                                        <div class="row ">
                                            <div class="col-xl-5 col-12 ">
                                                <div class="text-white">
                                                    <h6 class="mb-0">Thamer</h6>
                                                    <span class=" opacity_4-s fs_11px-s">@thamermd</span>
                                                    <p class="fg_yellow-s mb-2 fs_11px-s">
                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                        <i class="fas fa-star" aria-hidden="true"></i> 5.0
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-xl-7 col-12 pb-xl-0 pb-2 d-flex justify-content-between">
                                                <div class="">
                                                    <h6 class="text-white mb-0"> $10 </h6>
                                                    <span class="opacity_4-s text-white fs_11px-s">Match Amount</span>
                                                </div>
                                                <div class="text-right">
                                                    <span class="text-white fs_12px-s">Defender</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="goalkeeper_margin_b mt-1 mb-2 mx-xl-4 mx-3">

                            <div class="aditya_location mx-xl-4 mx-3">
                                <h6 class="mb-0 pb-0">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span class="fs_12px-s">Jaber Al-Ahmad International Stadium</span>
                                </h6>
                                <span class="opacity_4-s fs_11px-s">Sami Al-Ahmad Al Munayes St, Al Kuwayt, Kuwait</span>
                            </div>

                            <div class="row pt-3 pb-2 px-4">
                                <div class="col-6 pr-2">
                                    <a href="{{ url('rate_player') }}">
                                        <button type="button" class="btn fs_11px-s bg_grey-s br_10px-s fg_green-s py-3 w-100"><strong>Rate</strong></button>
                                    </a>
                                </div>

                                <!--SUBMIT button-->
                                <div class="col-6 pl-2">
                                    <a href="{{ url('chat') }}" role="button" type="submit" class="btn fs_11px-s bg-white br_10px-s py-3 fg_green-s w-100"><strong>Message</strong></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  --}}
        </div>
        <!-- container for hired players - end -->
    </div>


     <!-- cancel invitation by host modal -->
    <div class="modal fade" id="cancel_invitation_by_host_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--header image-->
                    <div class="row modal-header border-0 mt-4">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/cancel_invitation.svg') }}" width="130" alt="send invitation">
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
                            <button type="button" class="btn bg_green-s br_10px-s py-3 text-white w-100 cancel_by_host_button-d"  data-button="accepted">
                                <strong>YES</strong>
                            </button>
                        </div>
                        <!--YES button end-->
                    </div>
                </div>
            </div>
        </div>
    </div>


  <form action="{{ route('hirePlayer') }}" method="get" class="d-none pignose-calendar-unit-date-d">
                @csrf
                <input type="hidden" name="date" class="filter_by_date-d" value>
            </form>
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

                    <form action="{{ route('hirePlayer') }}" method="get" class="pignose-calendar-unit-date-d">
                        @csrf
                        <div class="row px-3  pb-5">
                            <!--CANCEL button-->
                            <div class="col-6 pr-2">
                                <button type="button" id="cancel_modal-d" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                            </div>
                            <!--CANCEL button end-->

                            <!--SUBMIT button-->
                            <div class="col-6 pl-2">
                                <button type="submit" id="cal" class="btn bg_green-s br_10px-s py-3 text-white w-100 hire_apply_date-d"><strong>APPLY</strong></button>
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
