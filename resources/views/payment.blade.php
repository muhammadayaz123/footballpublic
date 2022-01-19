@extends('layout.app')

@section('content')
        {{-- success message for invitation --}}
            <div class="align-self-center">
                    @if(session()->has('success_bank_details'))
                        <div class="alert alert-success">
                            {{ session()->get('success_bank_details') }}
                        </div>
                    @endif

                    @if(session()->has('status'))
                        <div class="alert alert-error">
                            {{ session()->get('status') }}
                        </div>
                    @endif

                    @if(!empty($status))
                        @if ($status == 'failure')
                            <div class="alert alert-danger"> Payment did not done successfully</div>
                        @else
                            <div class="alert alert-success"> Payment done successfully</div>
                        @endif
                    @endif


            </div>
        <!-- container for payment - start -->
        <div class="container-fluid bg-white br_47px-s mh_86vh-s">
            <div class="row pl-xl-2 pt-5">
                <!-- <div class="col-12 col-xl-1 col-lg-2 col-md-2">
                    <img src="{{ asset('images/payment_ratio_circle.svg')}}" width="100" class="" alt="Logo">
                </div> -->
                <div class="col-12 col-xl-1 col-lg-2 col-md-2">
                    <div class="text-center performance_img">
                        <div class="chart-container mx-auto">
                            <canvas id="donut_chart-d"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-11 col-lg-10 col-md-10 mt-2 pl-5 pr-4">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="float-left"><strong>Payment Overview</strong></h5>
                        </div>
                    </div>
                    <div class="row d-flex pt-2">
                        <div class="col-12 col-xl-3 col-lg-4 col-md-6 mt-md-0 mt-3">
                            <div class="row">
                                <div class="col-3">
                                    <hr class="mt-2 bc_green-s">
                                </div>
                                <div class="col-9 px-md-0">
                                    <h6 class="">Total Amount Received</h6>
                                    <strong><span>$</span><span class="total_amount_recieved-d">300.40</span></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-3 col-lg-4 col-md-6 mt-md-0 mt-3">
                            <div class="row">
                                <div class=" col-3">
                                    <hr class="mt-2 bc_red-s">
                                </div>
                                <div class="col-9 px-md-0">
                                    <h6>Total Amount Sent</h6>
                                    <strong><span>$</span><span class="total_amount_sent-d">30.40</span></strong>
                                </div>
                                <!-- <div class="col-xl-3 col-lg-3 col-md-3 col-3 px-xl-0">
                                    <strong><span>$</span><span>30.40</span></strong>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-12 col-xl-3 col-lg-4 col-md-6 mt-lg-0 mt-3">
                            <div class="row">
                                <div class="col-3">
                                    <hr class="mt-2 bc_lightgrey-s">
                                </div>
                                <div class="col-9 px-md-0">
                                    <h6>Total Amount Pending</h6>
                                    <strong><span>$</span><span class="total_amount_pending-d">250.40</span></strong>
                                </div>
                                <!-- <div class="col-xl-3 col-lg-3 col-md-3 col-3 px-xl-0">
                                    <strong><span>$</span><span>250.40</span></strong>
                                </div> -->
                            </div>
                        </div>
                        {{--  {{ dd($card) }}  --}}

                        <div class="col-12 col-xl-3 col-lg-4 col-md-6 mt-xl-0 mt-3 d-flex justify-content-xl-end">
                            @if (null == $card)
                                <button class="btn bg_green-s text-white py-2 px-3 rounded" data-toggle="modal" data-target="#merchant_account-d"><strong>Set Up Merchant Account</strong></button>
                            @else
                                <button class="btn bg_green-s text-white py-2 px-3 rounded" ><strong>Already have an account</strong></button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>




            <div class="container-fluid">
                <nav>
                    <div class="nav-tabs d-flex pt-5 mb-5 text-dark">
                        <span class="mr-4 mb-2">
                            <a class="p_tab performance_text pb-2 td_none-s text-dark" data-toggle="tab" href="#transactions_tab" role="tab" aria-selected="true">Transactions</a>
                        </span>
                        <span class="mx-4 mb-2">
                            <a class="p_tab pb-2 td_none-s text-dark" data-toggle="tab" href="#pending_tab" role="tab" aria-selected="false">Pending</a>
                        </span>

                    </div>
                </nav>

                <div class="tab-content">
                    <div id="transactions_tab" class="tab-pane fade active show">
                        @if (isset($is_payed))
                             {{-- {{ dd($is_payed, $playerRecivingPayment) }} --}}
                            <div class="row">
                                @foreach ($is_payed as $items)
                                    @foreach ($items as $item)
                                        {{--  @if ($item->is_payed == 1)  --}}
                                                <div class="col-xl-4 col-lg-4 col-md-12 col-12">
                                                    <div class="card br_15px-s shadow border-0 my-2">
                                                        <div class="card-body px-1 px-lg-1 px-xl-3 px-md-4">
                                                            <div class="row d-flex justify-content-around">
                                                                <div class="col-2 align-self-center">
                                                                    <div class="profile_img-s">
                                                                        <img class="img_set_to_div-s" src="{{asset('assets/images/Group 24.png')}}" alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="row">
                                                                        <div class="col-12 px-0">
                                                                            <strong class="ft_17px-s fg_green-s">{{ $item->player->first_name }} {{ $item->player->last_name }}</strong>
                                                                        </div>
                                                                        <div class="col-12 px-0">
                                                                            <strong class="">@ {{ $item->player->username }}</strong>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12 fg_darkgrey_s ft_size_12px-s px-0 mt-2">
                                                                            <span> {{\Carbon\Carbon::parse($item->created_at)->format('d M Y')}}</span> <span> | </span> <span>{{ Carbon\Carbon::parse($item->created_at)->format('G:ia') }}</span> <span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3 align-self-center">
                                                                    <span>
                                                                        @if ($item->is_payed == 0)
                                                                            <img src="{{asset('images/transaction_send_icon.svg')}}" alt="">
                                                                        @else
                                                                            <img src="{{asset('images/transaction_received_icon2.svg')}}" alt="">
                                                                        @endif
                                                                        {{--  <a href="javascript:void(0)"><img src="{{asset('assets/images/transaction_send_icon.svg')}}" alt=""></a>  --}}
                                                                    </span>
                                                                    <strong>${{ $item->price }}</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        {{--  @endif  --}}
                                    @endforeach
                                @endforeach
                            </div>

                        @endif


                          @if (isset($playerRecivingPayment))
                             {{-- {{ dd($playerRecivingPayment, $playerRecivingPayment) }} --}}
                            <div class="row">
                                @foreach ($playerRecivingPayment as $items)
                                    @foreach ($items as $item1)
                                            {{-- {{ dd($item) }} --}}
                                        {{--  @if ($item->is_payed == 1)  --}}
                                        @foreach ($item1 as $item)
                                                <div class="col-xl-4 col-lg-4 col-md-12 col-12">
                                                    <div class="card br_15px-s shadow border-0 my-2">
                                                        <div class="card-body px-1 px-lg-1 px-xl-3 px-md-4">
                                                            <div class="row d-flex justify-content-around">
                                                                <div class="col-2 align-self-center">
                                                                    <div class="profile_img-s">
                                                                        <img class="img_set_to_div-s" src="{{asset('assets/images/Group 24.png')}}" alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="row">
                                                                        <div class="col-12 px-0">
                                                                            <strong class="ft_17px-s fg_green-s">{{ $item->player->first_name }} {{ $item->player->last_name }}</strong>
                                                                        </div>
                                                                        <div class="col-12 px-0">
                                                                            <strong class="">@ {{ $item->player->username }}</strong>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12 fg_darkgrey_s ft_size_12px-s px-0 mt-2">
                                                                            <span> {{\Carbon\Carbon::parse($item->created_at)->format('d M Y')}}</span> <span> | </span> <span>{{ Carbon\Carbon::parse($item->created_at)->format('G:ia') }}</span> <span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3 align-self-center">
                                                                    <span>
                                                                        @if ($item->is_payed == 0)
                                                                            <span><img src="{{asset('images/transaction_send_icon2.svg')}}" alt=""></span>
                                                                        @else
                                                                            <span><img src="{{asset('images/transaction_received_icon.svg')}}" alt=""></span>
                                                                        @endif
                                                                    </span>
                                                                    <strong>${{ $item->price }}</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        {{--  @endif  --}}

                                        @endforeach
                                    @endforeach

                                @endforeach
                            </div>

                        @endif
                    </div>

                    <div id="pending_tab" class="tab-pane fade">

                        {{--  <div class="row px-xl-5">
                            <div class="col-12 d-flex fg_green-s">
                                <h6 class="mb-0 fs_18px-s"><strong>Today,</strong></h6>&nbsp;
                                <h6 class="mb-0 fs_18px-s"><strong>26 December 2020</strong></h6>
                                <a href="javascript:void(0)" class="td_none-s d-flex align-self-center mx-2"><img src="{{ asset('assets/images/arrow_down_green.svg') }}" class="img-fluid change_img-d" width="17" alt="arrow button"></a>
                            </div>
                            <div class="col-12 d-none mb-4 mt-3" id="toggle_calendar-d">
                                <div>
                                    <div class="calendar"></div>
                                </div>

                            </div>
                        </div>
                        <div class="row pt-4 pb-3 pr-xl-5 pr-3">
                            <div class="col-12 pr-0 pl-0 d-flex">
                                <div class="">
                                    <div class="bg_green-s py-2 mt-1 w_54px-s br_right_top_bottom_10px-s"></div>

                                </div>
                                <div class="pl-2">
                                    <h6 class="fs_18px-s"> <span>03:00 pm</span> | <span>26 December 2020</span> </h6>
                                </div>
                            </div>

                        </div>  --}}
                        <div class="row px-xl-4 pt-2 pb-3 px-xl-5 px-2">
                            @if (isset($is_payed))
                            @foreach ($is_payed as $items)
                                @foreach ($items as $item)
                                    @if ($item->is_payed == 0)
                                        {{-- {{ dd($item) }} --}}
                                        <div class="col-12 col-md-6 col-lg-4 py-2">
                                            <div class="card home_card br_1_5rem-s">
                                                <!-- <div class="heart_icon fs_32px-s">
                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                </div> -->
                                                <div class="card-body py-4 px-1">
                                                    <div class="container-fluid px-xl-0">
                                                        <div class="row px-xl-4">
                                                            <div class="col-xl-2 col-3">
                                                                <a href="{{ route('othersProfile', [$item->player->user->uuid, $item->player->uuid, $item->player->id]) }}">
                                                                    <img src="{{ $item->player->profile_image != null ? asset($item->player->profile_image) : asset('assets/images/Group 24.png')}}" alt="" width="50" height="50" class="rounded-circle">
                                                                </a>
                                                            </div>
                                                            <div class="col-xl-10 col-9 ">
                                                                <div class="row ">
                                                                    <div class="col-xl-5 col-12 ">
                                                                        <div class="text-white">
                                                                            <a href="{{ route('othersProfile', [$item->player->user->uuid, $item->player->uuid, $item->player->id]) }}" class="td_none-s text-white">
                                                                                <h6 class="mb-0">{{ $item->player->first_name }} {{ $item->player->last_name }}</h6>
                                                                            </a>
                                                                            <span class=" opacity_4-s fs_11px-s">@ {{ $item->player->username }}</span>
                                                                            <p class="fg_yellow-s mb-2 fs_11px-s">
                                                                                @php
                                                                                $empty_rating = 5 - round($item->player->rating);
                                                                                @endphp
                                                                                {{-- @for ($i = 0; $i < $item->player->rating +1; $i++) --}}
                                                                                @for ($i = 0; $i < round($item->player->rating); $i++)
                                                                                    <i class="fa fa-star fs_11px-s" aria-hidden="true">  </i>
                                                                                @endfor
                                                                                @for ($i = 0; $i < $empty_rating; $i++)
                                                                                    <i class="fa fa-star-o fs_11px-s" aria-hidden="true">  </i>
                                                                                @endfor
                                                                                {{ round($item->player->rating) }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-7 col-12 pb-xl-0 pb-2 d-flex justify-content-between">
                                                                        <div class="">
                                                                            <h6 class="text-white mb-0"> ${{ $item->player->price }} </h6>
                                                                            <span class="opacity_4-s text-white fs_11px-s">Match Amount</span>
                                                                        </div>
                                                                        <div class="text-right">
                                                                            <span class="text-white fs_12px-s">{{ $item->player->position }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="goalkeeper_margin_b mt-0 mb-2 mx-xl-4 mx-3">

                                                    <div class="aditya_location mx-xl-4 mx-3">
                                                        <h6 class="mb-0 pb-0">
                                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                            <span class="fs_12px-s">Jaber Al-Ahmad International Stadium</span>
                                                        </h6>
                                                        <span class="opacity_4-s fs_11px-s ml-3">
                                                            {{--  {{ $item->player->address->address }}  --}}
                                                            {{ \Illuminate\Support\Str::limit($item->player->address->address ?? 'no address', 15, $end='...') }}
                                                        </span>
                                                    </div>

                                                    <div class="row pt-3 px-4 ">
                                                        <div class="col-12 ">
                                                            <a href="" type="submit" role="button" class="btn fs_12px-s bg-white br_10px-s fg_green-s py-3 w-100" data-toggle="modal" data-target="#payment_modal-d-{{ $item->id }}"><strong>Pay Now</strong></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade payment_modal-d" id="payment_modal-d-{{ $item->id }}" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered ">
                                                <div class="modal-content br_10px-s border-0">
                                                    <div class="container-fluid">
                                                        <!--header image-->
                                                        <div class="row modal-header border-0 mt-3">
                                                            <div class="col-12 text-center">
                                                                {{-- <a href="{{ route('othersProfile', [$user->uuid, $user->profile->uuid, $user->profile->id]) }}"> --}}
                                                                    <img src="{{ $item->player->profile_image != null ? asset($item->player->profile_image) : asset('assets/images/Group 24.png')}}" class="rounded-circle b_green_5px-s shadow" width="150" height= "150" alt="player img">
                                                                {{-- </a> --}}
                                                            </div>
                                                        </div>
                                                        <!--header image end-->

                                                        <div class="row modal-body text-center">
                                                            <!--modal text-->
                                                            <div class="col-12 ">
                                                                <h4 class="fg_green-s">{{ $item->player->first_name }} {{ $item->player->last_name }}</h4>
                                                                <a href="javascript:void(0)">
                                                                    <h5 class="opacity_4-s text-dark"><strong>@ {{ $item->player->username }}</strong></h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-12 mt-3">
                                                                <h6><strong>Did {{$item->player->first_name}} played this match?</strong></h6>
                                                            </div>
                                                            <div class="col-12 mt-3">
                                                                <p class="opacity_4-s">Payment will be sent only if he played this match? After confirming this, you can pay him.</p>
                                                            </div>
                                                            <!--modal text end-->
                                                        </div>
                                                        <div class="row px-3 pt-3 pb-5">
                                                            <!--NO button-->
                                                            <form action="{{ route('is_played', $item->uuid) }}" method="post" class="w-100 d-flex">
                                                                @csrf
                                                            <div class="col-6">
                                                                <a role="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>No</strong></a>
                                                            </div>
                                                            <!--NO button end-->


                                                                <!--YES button-->
                                                                <div class="col-6">
                                                                    {{--  <button href="{{route('pay_now', $item->player->uuid)}}" type="submit"  class="btn bg_green-s br_10px-s py-3 text-white w-100"><strong>Yes</strong></button>  --}}
                                                                    <button  type="submit"  class="btn bg_green-s br_10px-s py-3 text-white w-100"><strong>Yes</strong></button>
                                                                </div>
                                                                <!--YES button end-->
                                                                {{--  <input type="hidden" class="get_invitation_uuid-d" name="invitation_uuid" value="{{ $item->uuid }}">  --}}
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- @else --}}
                                        {{-- <h3>No Pending Payments</h3> --}}
                                    @endif
                                @endforeach

                                @endforeach

                                @else
                                    <h3>No Pending Payments</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container for payment - end -->
    </div>
    <!-- .................payment End ......................... -->

    {{--  <div class="modal fade payment_modal-d" id="payment_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--header image-->
                    <div class="row modal-header border-0 mt-3">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/user_img.png') }}" class="rounded-circle b_5px-s shadow" width="150" alt="player img">
                        </div>
                    </div>
                    <!--header image end-->

                    <div class="row modal-body text-center">
                        <!--modal text-->
                        <div class="col-12 ">
                            <h4 class="fg_green-s">Jamele</h4>
                            <a href="javascript:void(0)">
                                <h5 class="opacity_4-s text-dark"><strong>@jamelemd</strong></h5>
                            </a>
                        </div>
                        <div class="col-12 mt-3">
                            <h6><strong>Did jamele played this match?</strong></h6>
                        </div>
                        <div class="col-12 mt-3">
                            <p class="opacity_4-s">Payment will be sent only if he played this match? After confirming this, you can pay him.</p>
                        </div>
                        <!--modal text end-->
                    </div>
                    <div class="row px-3 pt-3 pb-5">
                        <!--NO button-->
                        <div class="col-6 pr-2">
                            <a role="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>No</strong></a>
                        </div>
                        <!--NO button end-->

                        <!--YES button-->
                        <div class="col-6 pl-2">
                            <a href="{{route('pay_now')}}" type="submit" role="button" class="btn bg_green-s br_10px-s py-3 text-white w-100"><strong>Yes</strong></a>
                        </div>
                        <!--YES button end-->
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}

    <!-- Merchant Account Modal -->
    <div class="modal fade" id="merchant_account-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        {{-- @if (null != $card) --}}
        {{-- <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content br_15px-s py-4">
                    <div class="modal-header text-center mx-auto d-block border-0 br_top_15px-s py-4 px-4">
                        <div class="mb-3">
                            <img src="{{ asset('assets/images/account.png') }}" width="80" height="80" alt="">
                        </div>
                        <h5 class="modal-title mb-0"><strong>Already Have an Account</strong></h5>
                    </div>
                    <div class="modal-footer border-0  px-2 pt-2 pb-4">
                        <div class="row w-100 justify-content-center">
                            <div class="col-6">
                                <button type="button" class="btn bg_grey-s fg_green-s w-100 py-3 br_8px-s" data-dismiss="modal"><strong>CANCEL</strong></button>
                            </div> --}}
                            {{--  <div class="col-6">
                                <button type="submit" class="btn bg_green-s text-white w-100 py-3 br_8px-s"><strong>SAVE</strong></button>
                            </div>  --}}
                        {{-- </div>
                    </div>
                </div> --}}
            {{-- @else --}}
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content br_15px-s">
                    <div class="modal-header bg_grey-s br_top_15px-s py-4 px-4">
                        <h5 class="modal-title mb-0"><strong>SET UP MERCHANT ACCOUNT</strong></h5>
                    </div>
                    <form action="{{ route('bank_details') }}" id="frm_merchant_account-d" method="post">
                        @csrf
                            <div class="modal-body px-4 pt-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="merchant_name-d"><h6><strong>NAME</strong></h6></label>
                                            <input type="text" name="merchant_name" class="form-control fs_14px-s form-control-lg py-4 merchant_name-t rounded" id="merchant_name-d" value="{{ Auth::user()->profile->username }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email-d"><h6><strong>EMAIL ADDRESS</strong></h6></label>
                                            <input type="email" name="email" class="form-control fs_14px-s form-control-lg py-4 email-t rounded" id="email-d" value="{{ Auth::user()->email}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone_no-d"><h6><strong>PHONE NUMBER</strong></h6></label>
                                            <input type="text" name="phone_no" class="form-control  fs_14px-s form-control-lg py-4 phone_no-t rounded" id="phone_no-d" value="{{ Auth::user()->phone_number}}" readonly aria-invalid="false">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="isdn_code-d"><h6><strong>ISDN CODE</strong></h6></label>
                                            <input type="text" name="isdn_code" class="form-control spinner_remove-s fs_14px-s form-control-lg py-4 isdn_code-t rounded" maxlength="15" value="" id="isdn_code-d" placeholder="Please enter ISDN code" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="iban_no-d"><h6><strong>MERCHANT IBAN NO</strong></h6></label>
                                            <input type="text" name="iban_no" class="form-control fs_14px-s form-control-lg py-4 iban_no-t rounded" maxlength="34" value="" id="iban_no-d" placeholder="Please enter merchant IBan no" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="swift_code-d"><h6><strong>SWIFT CODE</strong></h6></label>
                                            <input type="text" name="swift_code" class="form-control fs_14px-s form-control-lg py-4 swift_code-t rounded" maxlength="11" value="" id="swift_code-d" placeholder="Please enter swift code" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="account_name-d"><h6><strong>ACCOUNT TITLE NAME</strong></h6></label>
                                            <input type="text" name="account_name" class="form-control fs_14px-s form-control-lg py-4 account_name-t rounded" value="" id="account_name-d" placeholder="Please enter account title name" required>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 pt-4">
                                        <h6><strong>SELECT PAYMENT TYPEs</strong></h6>
                                        <div class="form-check ">
                                            <label class="form-check-label d-md-inline-block d-block fs_18px-s">
                                                <input class="form-check-input br_green-s radio-inline mt-2 mr-3" type="radio" name="payment_type" id="kent-d" value="kent" >
                                                <span class="pl-md-3 pl-1  fs_14px-s">Knet</span>
                                            </label>
                                            <label class="form-check-label d-md-inline-block d-block fs_18px-s ml-md-5 ">
                                                <input class="form-check-input radio-inline mt-2 mr-3" type="radio" name="payment_type" id="credit-d" value="credit">
                                                <span class="pl-md-3 pl-1 fs_14px-s">Credit</span>
                                            </label>
                                            <label class="form-check-label d-md-inline-block d-block fs_18px-s ml-md-5 ">
                                                <input class="form-check-input  radio-inline mt-2 mr-3" type="radio" name="bpayment_type" id="bookey-d" value="bookey" >
                                                <span class="pl-md-3 pl-1 fs_14px-s">Bookeey</span>
                                            </label>
                                            <label class="form-check-label d-md-inline-block d-block fs_18px-s ml-md-5 ">
                                                <input class="form-check-input radio-inline mt-2 mr-3" type="radio" name="payment_type" id="amex-d" value="amex">
                                                <span class="pl-md-3 pl-1 fs_14px-s">Amex</span>
                                            </label>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="col-12 pt-4">
                                    <h6><strong>SELECT PAYMENT TYPEs</strong></h6>
                                    <div class="form-check pl-0">
                                        <label class="form-check-label d-lg-inline-block d-block container-s pl-4 mb-lg-0 mb-3  fs_18px-s">Knet
                                            <input class="form-check-input mt-0" type="checkbox" name="kent" id="kent-d" value="kent"  checked>
                                            <span class="pl-md-3 pl-1 custom_checkbox-s mt-1 fs_14px-s"></span>
                                        </label>
                                        <label class="form-check-label d-lg-inline-block d-block container-s pl-4 mb-lg-0 mb-3 fs_18px-s ml-lg-5 ">Credit
                                            <input class="form-check-input mt-0" type="checkbox" name="credit" id="credit-d" value="credit">
                                            <span class="pl-md-3 pl-1 custom_checkbox-s mt-1 fs_14px-s"></span>
                                        </label>
                                        <label class="form-check-label d-lg-inline-block d-block container-s pl-4 mb-lg-0 mb-3 fs_18px-s ml-lg-5 ">Bookeey
                                            <input class="form-check-input  mt-0" type="checkbox" name="bookey" id="bookey-d" value="bookey" >
                                            <span class="pl-md-3 pl-1 custom_checkbox-s mt-1 fs_14px-s"></span>
                                        </label>
                                        <label class="form-check-label d-lg-inline-block d-block container-s pl-4 mb-lg-0 mb-3 fs_18px-s ml-lg-5 ">Amex
                                            <input class="form-check-input mt-0" type="checkbox" name="amex" id="amex-d" value="amex">
                                            <span class="pl-md-3 pl-1 custom_checkbox-s mt-1 fs_14px-s"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer border-0 justify-content-center px-2 py-4">
                            <div class="row w-100">
                                <div class="col-6">
                                    <button type="button" class="btn bg_grey-s fg_green-s w-100 py-3 br_8px-s" data-dismiss="modal"><strong>CANCEL</strong></button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn bg_green-s text-white w-100 py-3 br_8px-s"><strong>SAVE</strong></button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            {{-- @endif --}}
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <script src="assets/js/pignose.calendar.full.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

@endsection
