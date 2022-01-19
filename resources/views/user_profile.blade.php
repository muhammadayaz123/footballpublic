@extends('layout.app')

@section('content')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> --}}

    <style>
            #social-links ul{
                padding-left: 0;
                /* display: flex !important; */
            }
            #social-links ul li {

                display: block;
            }
            #social-links ul li a {
                padding: 6px;
                margin: 1px;
                font-size: 25px;
            }

            #social-links ul{
                margin-bottom: 0px;
            }
            #social-links .fa-facebook{
                color: #0d6efd;
            }
            #social-links .fa-twitter{
            	color: deepskyblue;
            }
            #social-links .fa-linkedin{
                color: #0e76a8;
            }
            #social-links .fa-whatsapp{
                color:  #25D366
            }
            #social-links .fa-reddit{
                color: #FF4500;;
            }
           	#social-links .fa-telegram{
           		color: #0088cc;
           	}

            .share_btn-s .dropdown-menu {
                min-width:45px !important;
                /* left: -72px !important; */
            }

    </style>

 <!-- .................Home Page Start ......................... -->
    <div class="container-fluid px-0 mx-0 ">
        <!-- -------heading container - start -->
        <div class="container-fluid">
            <div class="row pb-4 pl-xl-5 mb-4">
                <div class="col-12  pt-4">
                    <h1 class=""><strong>My Profile</strong></h1>
                    <h4 class="">See you rating and share photos & videos.</h4>
                </div>
                <!-- <div class="col-md-7 col-12 justify-content-md-end mt-md-0 mt-4 d-flex align-self-center">
                    <a href="" class="btn bg_green-s br_10px-s d-flex justify-content-center w_h_184px_x_63px-s text-white py-3" data-toggle="modal" data-target="#upload_img_modal-d">
                        <img src="{{ asset('assets/images/upload_icon.svg') }}" width="20" class="mr-2" alt="logout icon">
                        <strong class="align-self-center"><h6 class="mb-1">Upload</h6></strong>
                    </a>
                </div> -->
            </div>
        </div>
        <!-- ------heading container - end -->

        <!-- container - start -->
        @if (Auth::user())
            <div class="container-fluid bg-white br_47px-s">
                <div class="row py-3 px-xl-3">
                    <div class="col-12 py-2 px-1">
                        <div class="card home_card br_25px-s">
                            <div class="heart_icon">
                                {{-- <i class="fas fa-heart fs_32px_heart-s" aria-hidden="true"></i> --}}
                            </div>
                            <div class="container mt_30px-s">
                                <div class="row mx-auto mt-5">
                                    <div class="col-2 col-lg-1 col-md-2 pl-0 ">
                                        <a class="td_none-s" href="{{ url('edit_profile') }}">
                                            <img src="{{ asset('assets/images/edit_profile.svg') }}" class="position-absolute edit_user_profile-s" alt="edit profile icon">
                                            <img class="rounded-circle profile_img border_white-s w_h_70px_on_sm-s" src="{{ asset(Auth::user()->profile->profile_image) }}" width="95px"  height="95px" alt="" />
                                        </a>
                                    </div>
                                    <div class="col-10 col-lg-11 col-md-10 pl-xl-3 pl-lg-5 pl-md-3 pl-sm-3 pl-5">
                                        <div class="text-white">
                                            <h6 class="mb-0 fs_20px-s ft_on_sm_screen-s">{{ Auth::user()->profile->first_name }}</h6>
                                            <span class=" opacity_4-s fs_20px-s ft_on_sm_screen-s">@ {{ Auth::user()->profile->first_name }}</span>
                                            <p class="fg_yellow-s fs_20px-s ft_on_sm_screen-s mb-1">


                                                @php
                                                    $empty_rating = 5 - round(Auth::user()->profile->rating);
                                                    //  dd($empty_rating)
                                                @endphp
                                                {{-- @for ($i = 0; $i < Auth::user()->profile->rating +1; $i++) --}}
                                                @for ($i = 0; $i < round(Auth::user()->profile->rating); $i++)
                                                    <i class="fas fa-star" aria-hidden="true">  </i>
                                                @endfor
                                                @for ($i = 0; $i < $empty_rating; $i++)
                                                    <i class="far fa-star" aria-hidden="true">  </i>
                                                @endfor
                                                {{-- <i class="fas fa-star"></i> --}}


                                                {{ number_format(Auth::user()->profile->rating , 1) }}

                                                <span class="fs_20px-s ft_on_sm_screen-s text-white mb-0">
                                                    <span class="opacity_4-s mx-3">|</span>
                                                    <img src="{{ asset('assets/images/location_pin.svg') }}" class="mr-1" alt="location"  width="13" />
                                                </span>
                                                <span class="text-white">
                                                    {{ \Illuminate\Support\Str::limit( Auth::user()->profile->address->city ?? 'no address', 58, $end='...') }}

                                                    {{-- {{  Auth::user()->profile->address->address ?? 'No location'   }}  --}}

                                                </span>
                                                <span class="rating_textt-s ft_on_sm_screen-s "> $ {{ Auth::user()->profile->price ?? 0 }} </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-5 pl-xl-3 ml-xl-5 mx-auto pt-3">
                                    <div class="col-2 text-white text-center px-0 fs_20px-s ft_on_sm_screen-s">
                                        <span class="opacity_4-s">Favorite Club</span>
                                        <br>
                                        <span class="fs_20px-s ft_on_sm_screen-s">{{ Auth::user()->profile->favorite_club ?? 'No favorite club' }}</span>
                                    </div>
                                    <div class="col-2 text-white text-center px-0 fs_20px-s ft_on_sm_screen-s">
                                        <span class="opacity_4-s">Age</span>
                                        <br>
                                        <span class="fs_20px-s ft_on_sm_screen-s">{{  \Carbon\Carbon::parse(Auth::user()->profile->dob)->age }}</span>
                                    </div>
                                    <div class="col-2 text-white text-center px-0 fs_20px-s ft_on_sm_screen-s">
                                        <span class="opacity_4-s">Matches</span>
                                        <br>
                                        <span class="fs_20px-s ft_on_sm_screen-s">{{ Auth::user()->profile->played_matches != null ? Auth::user()->profile->played_matches : 0}}</span>
                                    </div>
                                    <div class="col-2 text-white text-center px-0 fs_20px-s ft_on_sm_screen-s">
                                        <span class="opacity_4-s">Missed</span>
                                        <br>
                                        <span class="fs_20px-s ft_on_sm_screen-s">{{ Auth::user()->profile->missed_matches   != null ? Auth::user()->profile->missed_matches   : 0}}</span>
                                    </div>
                                    <div class="col-2 text-white text-center px-0 fs_20px-s ft_on_sm_screen-s">
                                        <span class="opacity_4-s">Position</span>
                                        <br>
                                        <span class="fs_20px-s ft_on_sm_screen-s">{{ Auth::user()->position }}</span>
                                    </div>
                                    <div class="col-2 text-white text-center px-0 fs_20px-s ft_on_sm_screen-s d-block">
                                        <!-- <div class="d-lg-block d-none">
                                            <br>
                                        </div> -->
                                        <span class="opacity_4-s align-self-center">
                                            <img class=" w_h_12px_on_sm-s mr-2" width="20" height="20" src="{{ asset('assets/images/share_icon.svg') }}" alt="">
                                        </span>
                                        <br>
                                        <div class="dropdown share_btn-s align-self-center">
                                            <button class="btn bg-none p-0 fs_20px-s ft_on_sm_screen-s" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <span class="text-white fs_20px-s ft_on_sm_screen-s"> Share</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                   {{--  {!! $share !!}  --}}
                                                {!! Share::page(url('user-profile'))->facebook()->twitter()->whatsapp()->linkedin() !!}
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="container-fluid">
                    <div class="row bb_grey-s pb-md-0 pb-3 mb-3">
                        <div class="col-md-8 col-12 order-last order-sm-0 align-self-end">
                            <nav>
                                <div class="nav-tabs border-0 d-flex pt-3 pb-2 text-dark">
                                    <span class=" ">
                                        <a class="p_tab performance_text pb-2 td_none-s text-dark px-3" data-toggle="tab" href="#home" role="tab" aria-selected="true">Performance</a>
                                    </span>
                                    <span class=" ">
                                        <a class="p_tab pb-2 td_none-s text-dark px-3" data-toggle="tab" href="#menu2" role="tab" aria-selected="false">Photo</a>
                                    </span>
                                    <span class=" ">
                                        <a class="p_tab pb-2 td_none-s text-dark px-3" data-toggle="tab" href="#menu3" role="tab" aria-selected="false">Videos</a>
                                    </span>
                                </div>
                            </nav>
                        </div>
                        <!-- <div class="row justify-content-end d-flex"> -->
                        <div class="col-md-4 col-12 justify-content-end  mb-1 upload_img_btn-d d-none">
                            <a href="" class="btn bg_green-s br_10px-s d-flex justify-content-center px-5 text-white py-3 w-35 px-4" data-toggle="modal" data-target="#upload_img_modal-d">
                                <img src="{{ asset('assets/images/upload_icon.svg') }}" width="20" class="mr-2" alt="logout icon">
                                <strong class="align-self-center"><h6 class="mb-0">Upload</h6></strong>
                            </a>
                        </div>
                        <!-- </div> -->

                    </div>

                    <div class="tab-content pb-5">
                        <div id="home" class="tab-pane fade active show">
                            <div class="text-center performance_img pb-5">
                                <h6><strong>Rating</strong></h6>
                                <div class="chart-container mx-auto mt-4 chart_w_h-s">
                                    <input type="hidden" name="agility"  min="0.0" max="5.0" step="0.1" value="{{ $rating->agility ?? 0 }}" id="ability" class="form-control-range py-4 ratig_slider-s mx-auto slider-d" data-parent='ability-d'>
                                    <input type="hidden" name="stamina"  min="0.0" max="5.0" value="{{ $rating->stamina ?? 0 }}" step="0.1" id="stamina" class="form-control-range py-4 ratig_slider-s mx-auto slider-d" data-parent='stamina-d'>
                                    <input type="hidden" name="strength" min="0.0" max="5.0" value="{{ $rating->strength ?? 0 }}" step="0.1" class="form-control-range py-4 ratig_slider-s mx-auto slider-d" id="strength" data-parent="strength-d">
                                    <input type="hidden" name="passes" min="0.0" max="5.0" value="{{ $rating->passes ?? 0 }}" step="0.1" class="form-control-range py-4 ratig_slider-s mx-auto slider-d" id="passes" data-parent="passes-d">
                                    <input type="hidden" name="shoots"  min="0.0" max="5.0" value="{{ $rating->shoots ?? 0 }}" step="0.1" class="form-control-range py-4 ratig_slider-s mx-auto slider-d" id="shoots" data-parent="shoots-d">
                                    <input type="hidden" name="pace"  min="0.0" max="5.0" value="{{ $rating->pace ?? 0 }}" step="0.1" class="form-control-range py-4 ratig_slider-s mx-auto slider-d" id="pace" data-parent="pace-d">
                                    <canvas class="" id="myProfileChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <div id="menu2" class="tab-pane fade">
                            <!-- <div class="row justify-content-end d-flex">
                                <div class="col-2  mb-1">
                                    <a href="" class="btn bg_green-s br_10px-s d-flex justify-content-center px-5 text-white py-3" data-toggle="modal" data-target="#upload_img_modal-d">
                                        <img src="{{ asset('assets/images/upload_icon.svg') }}" width="20" class="mr-2" alt="logout icon">
                                        <strong class="align-self-center"><h6 class="mb-0">Upload</h6></strong>
                                    </a>
                                </div>
                            </div> -->
                            @if ($postProfile != [])

                                @foreach ($postProfile as $postMedia)

                                    <div class="row home-img-blocks user_post_image-d">
                                        @foreach ($postMedia as $media)
                                            @if ($media->media->media_type == "photo")

                                            {{--  <div>  --}}
                                                <div class="col-12 col-md-6 col-lg-4 col-xl-3 py-2 home-img-block h_194px-s media_modal-d  post_modal-d{{ $media->uuid }}" data-toggle="modal" data-target="#post_modal-d{{ $media->uuid }}" >
                                                    <input type="hidden" name="" class="post_uuid-d" value="{{ $media->uuid }}">
                                                    <input type="hidden" name="" class="post_like-d" value="{{ $media->is_liked_by_me }}">
                                                    <img src="{{ asset($media->media->path) }}" class="img-fluid obj_fit_contain-s user_post_image_src-d br_12px-s" alt="" />
                                                    <div class="hover">
                                                        <p class="profile_text_on_img_hover-s fs_12px-s text-white">{{ substr($media->caption, 0, 10) }}</p>
                                                        <div class="d-flex w-100 justify-content-between mb-4">
                                                            <div class= "d-flex">
                                                                <span class="text-white fs_12px-s change_color-d change_thumbsup-d mt-1 user_image_thumbsup-d">
                                                                    {{-- <img class="w_20px-s mx-1 bg_transparent-s" src="{{$media->is_liked_by_me == 0 ? asset('assets/images/like.svg') : asset('images/blue_thumbs_up.svg') }}" alt="" class="change_image-d"> --}}
                                                                    <img class="w_20px-s mx-1 bg_transparent-s" src="{{ asset('assets/images/like.svg') }}" alt="" >
                                                                    <span  class="liked_count_show-d-{{ $media->uuid }} text-white">{{ $media->like_count }}</span>
                                                                    {{--  <img class="w_20px-s mx-1 bg_transparent-s" src="{{ asset('assets/images/black_like.svg') }}" alt="" >
                                                                    <span class="liked_count_show-d">{{ $media->like_count }}</span>  --}}
                                                                </span>

                                                                <input type="hidden" name="like" class="like-d"  value="{{ $media->is_liked_by_me }}">
                                                                <input type="hidden" name="post_uuid" class="like_post_uuid-d"  value="{{ $media->uuid }}">

                                                                <span class="text-white fs_12px-s ml-2 mt-1"><img class="w_20px-s mx-1 bg_transparent-s" src="{{ asset('assets/images/comment_icon.svg') }}" alt=""> </span>
                                                            </div>
                                                            <div class="d-flex share_btn-s ">
                                                                {{--  <span class="text-white fs_12px-s"><img class="w_11px-s mx-1 bg_transparent-s" src="{{ asset('assets/images/black_share.svg') }}" alt=""></span>  --}}

                                                                <button class="btn bg-none p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <img class="w_11px-s bg_transparent-s" src="{{ asset('assets/images/share_icon.svg') }}" alt="" />
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    {{--  {!! $share !!}  --}}
                                                                    {!! Share::page('{{ asset($media->media->path) }}')->facebook()->twitter()->whatsapp()->linkedin() !!}
                                                                </div>
                                                                {{--  <span>Share</span>  --}}

                                                                <span class="text-white fs_12px-s ml-1 mt-1 delete_post-d">
                                                                    <img class="w_10px-s mx-1 bg_transparent-s" src="{{ asset('assets/images/delete_white_icon.svg') }}" alt="">
                                                                    <input type="hidden" name="post_uuid" class="delete_post_uuid-d" value="{{ $media->uuid }}">
                                                                </span>

                                                                <span class="text-white fs_12px-s ml-1 mt-1"><img class="w_20px-s mx-1 text-white bg_transparent-s" src="{{ asset('assets/images/view_icon.svg') }}" alt="" ></span>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                                <!-- Post Modal -->
                                                <div class="modal fade" id="post_modal-d{{ $media->uuid }}" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered ">
                                                        <div class="modal-content br_10px-s border-0">
                                                            <div class="container-fluid px-0">
                                                                <div class="modal-body p-0">
                                                                    <div class="row">
                                                                        <div>
                                                                            <img src="{{ asset('assets/images/close-dark.svg') }}" width="15"  class="position-absolute close_modal-s" data-dismiss="modal" alt="">
                                                                        </div>
                                                                        <div class="col-lg-6 col-12 pr-lg-0">
                                                                            <div class="bg-white br_left_10px-s">
                                                                                <div>
                                                                                    <img src="{{ asset($media->media->path) ?? asset('assets/images/picture.jpg') }}" class="object_fit_contain-s picture_border-s w-100" alt="picture">
                                                                                </div>
                                                                                <div class="position-absolute caption-s text-white px-2">
                                                                                    <div class="row ml-2 pt-3">
                                                                                        <div class="col-1 px-0">
                                                                                            <img  src="{{asset(Auth::user()->profile->profile_image) ?? asset('assets/images/user_img.png') }}" width="40" height="40" class="profile_img rounded-circle border_green-s " alt="user profile">
                                                                                        </div>
                                                                                        <div class="col-lg-11 col-11  ">
                                                                                            {{-- <a href="javascript:void(0)" class="td_none-s text-white cursor_pointer-none"> --}}
                                                                                                <h6 class="fg_green-s mb-0"><strong>{{ Auth::user()->profile->first_name }}</strong></h6>
                                                                                                <span class="fs_12px-s text-white">@ {{ Auth::user()->profile->first_name }}</span>
                                                                                                <div class="d-flex justify-content-between">
                                                                                                    <div class="d-flex">
                                                                                                        <span class="fs_12px-s pt-2"> {{ \Carbon\Carbon::parse($media->created_at)->diffForHumans()}}   | {{ Carbon\Carbon::parse($media->created_at)->format('g:i a') }}   </span>
                                                                                                        {{-- <span class="fs_12px-s pt-2"> {{ \Carbon\Carbon::parse($media->comments[0]->created_at)->diffForHumans()}}   | {{ Carbon\Carbon::parse($media->comments[0]->created_at)->format('g:i a') }}   </span> --}}

                                                                                                        <span class="fs_12px-s ml-3 mr-1 cursor_pointer-s share_btn-s ">
                                                                                                            <button class="btn bg-none pr-0 pt-2 text-white fs_12px-s" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                                                <img class="w_11px-s bg_transparent-s" src="{{ asset('images/share_icon.svg') }}" alt=""><span> Share</span>
                                                                                                            </button>
                                                                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                                                                {{--  {!! $share !!}  --}}
                                                                                                                {!! Share::page(url('user-profile'))->facebook()->twitter()->whatsapp()->linkedin() !!}
                                                                                                            </div>
                                                                                                            <!-- <span>Share</span> -->
                                                                                                        </span>
                                                                                                        <span class=" pl-2 pt-2 delete_post_modal-d fs_12px-s ml-1 cursor_pointer-s" data-post>
                                                                                                            <img src="{{ asset('images/delete_white_icon.svg') }}" width="11" alt="delete">
                                                                                                            <span>Delete</span>
                                                                                                            <input type="hidden" name="post_uuid" class="delete_post_uuid-d" value="{{ $media->uuid }}">

                                                                                                        </span>
                                                                                                    </div>
                                                                                                    <!-- <div>
                                                                                                        <span class="">
                                                                                                            <a href="" data-toggle="modal" data-target="#report_issue_modal-d">
                                                                                                                <img src="{{ asset('assets/images/empty_flag.svg') }}" class="img-responsive " width="20" height="20" alt="report flag">
                                                                                                            </a>
                                                                                                        </span>
                                                                                                    </div> -->
                                                                                                </div>

                                                                                                {{-- <span class=" mb-0"> {{ substr($media->caption, 0, 10) }}</span> --}}
                                                                                                <p class=" mb-0 z-modal-user-profile"> {{ $media->caption }}</p>
                                                                                                {{-- <p class=" mb-0"> {{ $media->comments[0]->comment ?? '' }}</p> --}}
                                                                                            {{-- </a> --}}
                                                                                            <p class="fs_12px-s" id="caption_description-d"></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-12 mt-4 modal_container-d">
                                                                            <div class="row mx-xl-2 mx-lg-0 mx-2 mt-2">
                                                                                <div class="col-6 ">
                                                                                    {{-- {{ dd($media   ) }} --}}
                                                                                    <h6 class="mb-0"><strong><span class="liked_count-d">{{ $media->like_count }}</span> people like this.</strong></h6>
                                                                                    {{-- <span class="fs_12px-s"> {{ \Carbon\Carbon::parse($media->created_at)->diffForHumans()}}   | {{ Carbon\Carbon::parse($media->created_at)->format('g:i a') }}   </span> --}}
                                                                                </div>
                                                                                <div class="col-6 d-flex justify-content-end align-self-center post_liked-d">
                                                                                    <span class=" px-4"  class="change_color-d change_thumbsup-d user_image_thumbsup-d">
                                                                                        <img src="{{ $media->is_liked_by_me == 0 ? asset('assets/images/like_black.svg') : asset('images/green_thumbs_up.svg') }}" width="20" alt="like"  class="change_image-d">
                                                                                    </span>

                                                                                    <input type="hidden" name="like" class="like-d"  value="{{ $media->is_liked_by_me }}">
                                                                                    <input type="hidden" name="post_uuid" class="like_post_uuid-d"  value="{{ $media->uuid }}">
                                                                                    <input type="hidden" class="liked_count_show-d-{{ $media->uuid }}"  value="{{ $media->like_count }}">
                                                                                    {{-- <a href="jaavscript:(0)" class=" px-2">
                                                                                        <img src="{{ asset('assets/images/share_black.svg') }}" width="16" alt="share">
                                                                                    </a> --}}
                                                                                    {{-- <span class=" pl-2 delete_post-d" data-post>
                                                                                        <img src="{{ asset('assets/images/delete_icon.svg') }}" width="16" alt="delete">
                                                                                        <input type="hidden" name="post_uuid" class="delete_post_uuid-d" value="{{ $media->uuid }}">

                                                                                    </span> --}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-12 pl-0">
                                                                                    <hr class="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="container-fluid overflow-auto h_452px-s px-0" >
                                                                                <div class="row mx-xl-2 mx-lg-0 mx-3 div_append_data-d append_div-d_{{ $media->id }}">

                                                                                    @foreach ($media->comments as $comment)
                                                                                        <div class="col-1 px-0">
                                                                                            <img src="{{ asset($comment->profile->profile_image) }}" width="37" style="height:38px;"  class="profile_img rounded-circle border_green-s" alt="" id="user_img-d">
                                                                                        </div>
                                                                                        <div class="col-lg-11 col-11" >
                                                                                            <div class="d-flex justify-content-between">
                                                                                                <div>
                                                                                                    <a href="javascript:void(0)" class="td_none-s">
                                                                                                        <h6 class="fg_green-s mb-0"><strong>{{ $comment->profile->first_name }} {{ $comment->profile->last_name }}</strong></h6>
                                                                                                        <span class="fs_12px-s text-dark">@ {{ $comment->profile->username }}</span>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div>
                                                                                                    <span class="fs_12px-s">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans()}} | {{ Carbon\Carbon::parse($comment->created_at)->format('G:ia') }}</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <p class="fs_12px-s">{{ $comment->comment ?? '' }} </p>
                                                                                        </div>
                                                                                    @endforeach

                                                                                </div>

                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-12 pl-0">
                                                                                    <hr class="">
                                                                                </div>
                                                                            </div>

                                                                            <form  method="post" action="{{ route('postComment') }}" class="frm_new_comment-d">
                                                                                @csrf
                                                                                <div class="input-group word-break word-wrap border-0">
                                                                                    <input type="text" name="comment"  placeholder="Add your comment....." class="get_post_comment_length-d  comment-s form-control py-1 textarea_h_w-s ft_size_14px-s border-0 add_comment-d" id="">
                                                                                    <div class="input-group-append">
                                                                                        <button type="submit" class="border-0 bg-white  px-3 post-s td_none-s" ><strong class="fg_green-s">POST</strong></button>
                                                                                        <input type="hidden" name="post_uuid" class="post_comment_post_uuid-d" value="{{ $media->uuid }}">
                                                                                    <input type="hidden" name="" class="post_id-d" value="{{ $media->id }}" />

                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                            </footer>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            {{--  </div>  --}}

                                            {{--  @else
                                                <div class="mx-auto my-5 py-5 text-muted text-center">
                                                    <h4 class="mx-auto my-5 py-5 text-muted text-center">No Media Available</h4>
                                                </div>  --}}
                                            @endif

                                        @endforeach

                                    </div>
                                @endforeach
                            @else
                                {{--  <div class="row justify-content-end d-flex">
                                    <div class="col-2  mb-1">
                                        <a href="" class="btn bg_green-s br_10px-s d-flex justify-content-center px-5 text-white py-3" data-toggle="modal" data-target="#upload_img_modal-d">
                                            <img src="{{ asset('assets/images/upload_icon.svg') }}" width="20" class="mr-2" alt="logout icon">
                                            <strong class="align-self-center"><h6 class="mb-0">Upload</h6></strong>
                                        </a>
                                    </div>
                                </div>  --}}
                                <div class="mx-auto my-5 py-5 text-muted text-center">
                                    <h4 class="mx-auto my-5 py-5 text-muted text-center">No Media Available</h4>
                                </div>
                            @endif
                        </div>

                                    {{--  {{ dd($postProfile) }}  --}}
                        <div id="menu3" class="tab-pane fade">
                            <!-- <div class="row justify-content-end d-flex">
                                <div class="col-2  mb-1">
                                    <a href="" class="btn bg_green-s br_10px-s d-flex justify-content-center px-5 text-white py-3" data-toggle="modal" data-target="#upload_img_modal-d">
                                        <img src="{{ asset('assets/images/upload_icon.svg') }}" width="20" class="mr-2" alt="logout icon">
                                        <strong class="align-self-center"><h6 class="mb-0">Upload</h6></strong>
                                    </a>
                                </div>
                            </div> -->
                            @if ($postProfile != [])
                                @foreach ($postProfile as $postMedia)

                                    {{--  {{ dd($postProfile, $postMedia) }}  --}}
                                    <div class="row home-img-blocks">
                                        @foreach ($postMedia as $media)
                                            @if ($media->media->media_type == "video")
                                                {{--  {{ dd($media, $media->media->media_type) }}  --}}
                                                {{--  {{ dd("ok") }}  --}}
                                                <div class="col-12 col-md-6 col-lg-4 col-xl-3 py-2 home-img-block h_194px-s video_like-d media_modal-d post_modal-d{{ $media->uuid }}" data-toggle="modal" data-target="#post_modal-d{{ $media->uuid }}">
                                                    <input type="hidden" name="" class="post_uuid-d" value="{{ $media->uuid }}">
                                                    <input type="hidden" name="" class="post_like-d" value="{{ $media->is_liked_by_me }}">
                                                        {{-- <img src="{{ asset('assets/images/play-button.svg') }}" width="50" class="position_video_play_icon-s" alt="">  --}}
                                                    {{-- <img src="{{ asset($media->media->media_thumbnail) }}" class="img-fluid" alt="" /> --}}
                                                    <video width="320" height="240" controls class="img-fluid obj_fit_contain-s">
                                                        <source src="{{ asset($media->media->media_thumbnail) }}" type="video/mp4">
                                                        {{-- <source src="movie.ogg" type="video/ogg"> --}}
                                                        {{-- Your browser does not support the video tag. --}}
                                                    </video>
                                                    <div class="hover">
                                                        <p class="profile_text_on_img_hover-s fs_12px-s text-white"></p>
                                                        <div class="d-flex w-100 justify-content-between mb-4">
                                                            <div>
                                                                <span class="text-white fs_12px-s change_color-d change_thumbsup-d mt-1 user_image_thumbsup-d">
                                                                    {{-- <img class="w_20px-s mx-1 bg_transparent-s" src="{{$media->is_liked_by_me == 0 ? asset('assets/images/like.svg') : asset('images/blue_thumbs_up.svg') }}" alt="" class="change_image-d"> --}}
                                                                    <img class="w_20px-s mx-1 bg_transparent-s" src="{{ asset('assets/images/like.svg') }}" alt="" >
                                                                    <span  class="liked_count_show-d-{{ $media->uuid }} text-white">{{ $media->like_count }}</span>
                                                                </span>

                                                                <input type="hidden" name="like" class="like-d"  value="{{ $media->is_liked_by_me }}">
                                                                <input type="hidden" name="post_uuid" class="like_post_uuid-d"  value="{{ $media->uuid }}">

                                                                {{--  <span class="text-white fs_12px-s mt-1"><img class="w_20px-s mx-1 bg_transparent-s" src="{{ asset('assets/images/like.svg') }}" alt=""></span>  --}}
                                                                <span class="text-white fs_12px-s ml-2 mt-1"><img class="w_20px-s mx-1 bg_transparent-s" src="{{ asset('assets/images/comment_icon.svg') }}" alt=""></span>
                                                                {{--  <span class="text-white fs_12px-s mt-1"><img class="w_20px-s mx-1 bg_transparent-s" src="{{ asset('assets/images/black_like.svg') }}" alt=""> 34</span>
                                                                <span class="text-white fs_12px-s ml-2 mt-1"><img class="w_20px-s mx-1 bg_transparent-s" src="{{ asset('assets/images/black_comment.svg') }}" alt=""> 34</span>  --}}
                                                            </div>
                                                            <div class="d-flex share_btn-s ">
                                                                <!-- <span class="text-white fs_12px-s"><img class="w_11px-s mx-1 bg_transparent-s" src="{{ asset('assets/images/share_icon.svg') }}" alt=""></span> -->
                                                                <button class="btn bg-none p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <img class="w_11px-s bg_transparent-s" src="{{ asset('assets/images/share_icon.svg') }}" alt="">
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    {{--  {!! $share !!}  --}}
                                                                    {!! Share::page('{{ asset($media->media->path) }}')->facebook()->twitter()->whatsapp()->linkedin() !!}
                                                                </div>
                                                                <span class="text-white fs_12px-s ml-1 mt-1 delete_post-d">
                                                                    <img class="w_10px-s mx-1 bg_transparent-s" src="{{ asset('assets/images/delete_white_icon.svg') }}" alt="">
                                                                        <input type="hidden" name="post_uuid" class="delete_post_uuid-d" value="{{ $media->uuid }}">
                                                                </span>
                                                                <span class="text-white fs_12px-s ml-1 mt-1"><img class="w_20px-s mx-1 text-white bg_transparent-s" src="{{ asset('assets/images/view_icon.svg') }}" alt=""></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="post_modal-d{{ $media->uuid }}" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered ">
                                                        <div class="modal-content br_10px-s border-0">
                                                            <div class="container-fluid px-0">
                                                                <div class="modal-body p-0">
                                                                    <div class="row">
                                                                        <div>
                                                                            <img src="{{ asset('assets/images/close-dark.svg') }}" width="15" data-dismiss="modal" class="position-absolute close_modal-s" alt="">
                                                                        </div>
                                                                        <div class="col-lg-6 col-12 pr-lg-0">
                                                                            <div>
                                                                                {{-- <img src="{{ asset($media->media->path) ?? asset('assets/images/picture.jpg') }}" class="object_fit_contain-s picture_border-s " alt="picture"> --}}
                                                                                    <video class="picture_border-s w-100"  controls class="img-fluid br_12px-s">
                                                                                    <source src="{{ asset($media->media->media_thumbnail) }}" type="video/mp4">
                                                                                    {{-- <source src="movie.ogg" type="video/ogg"> --}}
                                                                                    {{-- Your browser does not support the video tag. --}}
                                                                                </video>
                                                                            </div>
                                                                            <div class="position-absolute caption_video-s text-white px-2">
                                                                                <div class="row ml-2 pt-3">
                                                                                    <div class="col-1 px-0">
                                                                                        <img  src="{{asset(Auth::user()->profile->profile_image) ?? asset('assets/images/user_img.png') }}" width="40" height="40" class="profile_img rounded-circle border_green-s" alt="user profile">
                                                                                    </div>
                                                                                    <div class="col-lg-11 col-11  ">
                                                                                        {{-- <a href="javascript:void(0)" class="td_none-s"> --}}
                                                                                            <h6 class="fg_green-s mb-0"><strong>{{ Auth::user()->profile->first_name }}</strong></h6>
                                                                                            <span class="fs_12px-s  text-white">@ {{ Auth::user()->profile->first_name }}</span>
                                                                                            <div class="d-flex justify-content-between">
                                                                                                <div class="d-flex">
                                                                                                    <span class="fs_12px-s pt-2"> {{ \Carbon\Carbon::parse($media->created_at)->diffForHumans()}}   | {{ Carbon\Carbon::parse($media->created_at)->format('g:i a') }}   </span>

                                                                                                    <span class="fs_12px-s ml-3 mr-1 cursor_pointer-s share_btn-s ">
                                                                                                        <button class="btn bg-none pr-0 pt-2 text-white fs_12px-s" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                                            <img class="w_11px-s bg_transparent-s mr-1" src="{{ asset('images/share_icon12.svg') }}" alt="">Share
                                                                                                        </button>
                                                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                                                            {{--  {!! $share !!}  --}}
                                                                                                            {!! Share::page('{{ asset($media->media->path) }}')->facebook()->twitter()->whatsapp()->linkedin() !!}
                                                                                                        </div>
                                                                                                        <!-- <span>Share</span> -->
                                                                                                    </span>
                                                                                                    <span class=" pl-2 delete_post_modal-d pt-2 fs_12px-s" data-post>
                                                                                                        <img src="{{ asset('images/delete_icon12.svg') }}" width="11" alt="delete">
                                                                                                        <span>Delete</span>
                                                                                                        <input type="hidden" name="post_uuid" class="delete_post_uuid-d" value="{{ $media->uuid }}">

                                                                                                    </span>
                                                                                                </div>
                                                                                                <!-- <div class="pt-1">
                                                                                                    <span class="">
                                                                                                        <a href="" data-toggle="modal" data-target="#report_issue_modal-d">
                                                                                                            <img src="{{ asset('assets/images/empty_flag.svg') }}" class="img-responsive " width="20" height="20" alt="report flag">
                                                                                                        </a>
                                                                                                    </span>
                                                                                                </div> -->
                                                                                            </div>
                                                                                            <br>
                                                                                            {{-- <span class=" mb-0"> {{ substr($media->caption, 0, 10) }}</span> --}}
                                                                                            <span class=" mb-0 z-modal-user-profile"> {{ $media->caption }}</span>
                                                                                        {{-- </a> --}}
                                                                                        <p class="fs_12px-s" id="caption_description-d"></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-12 mt-4 modal_container-d">
                                                                            <div class="row mx-xl-2 mx-lg-0 mx-2 mt-2">
                                                                                <div class="col-6 ">
                                                                                    {{-- {{ dd($media   ) }} --}}
                                                                                    <h6 class="mb-0"><strong><span class="liked_count-d">{{ $media->like_count }}</span> people like this.</strong></h6>
                                                                                    {{-- <span class="fs_12px-s"> {{ \Carbon\Carbon::parse($media->created_at)->diffForHumans()}}   | {{ Carbon\Carbon::parse($media->created_at)->format('g:i a') }}   </span> --}}
                                                                                </div>
                                                                                <div class="col-6 d-flex justify-content-end align-self-center post_liked-d">
                                                                                    <span class=" px-4"  class="change_color-d change_thumbsup-d">
                                                                                        <img src="{{ $media->is_liked_by_me == 0 ? asset('assets/images/like_black.svg') : asset('images/green_thumbs_up.svg') }}" width="20" alt="like"  class="change_image-d">
                                                                                    </span>

                                                                                    <input type="hidden" name="like" class="like-d"  value="{{ $media->is_liked_by_me }}">
                                                                                    <input type="hidden" name="post_uuid" class="like_post_uuid-d"  value="{{ $media->uuid }}">
                                                                                    <input type="hidden" class="liked_count_show-d-{{ $media->uuid }}"  value="{{ $media->like_count }}">

                                                                                    {{-- <a href="jaavscript:(0)" class=" px-2">
                                                                                        <img src="{{ asset('assets/images/share_black.svg') }}" width="16" alt="share">
                                                                                    </a> --}}
                                                                                    {{-- <span class=" pl-2 delete_post-d" data-post>
                                                                                        <img src="{{ asset('assets/images/delete_icon.svg') }}" width="16" alt="delete">
                                                                                        <input type="hidden" name="post_uuid" class="delete_post_uuid-d" value="{{ $media->uuid }}">

                                                                                    </span> --}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-12 pl-0">
                                                                                    <hr class="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="container-fluid overflow-auto h_452px-s px-0" >
                                                                                <div class="row mx-xl-2 mx-lg-0 mx-3 div_append_data-d append_div-d_{{ $media->id }}">

                                                                                    @foreach ($media->comments as $comment)
                                                                                        <div class="col-1 px-0">
                                                                                            <img src="{{ asset($comment->profile->profile_image) }}" width="37" style="height:38px;"  class="profile_img rounded-circle border_green-s" alt="" id="user_img-d">
                                                                                        </div>
                                                                                        <div class="col-lg-11 col-11" >
                                                                                            <div class="d-flex justify-content-between">
                                                                                                <div>
                                                                                                    <a href="javascript:void(0)" class="td_none-s">
                                                                                                        <h6 class="fg_green-s mb-0"><strong>{{ $comment->profile->first_name }} {{ $comment->profile->last_name }}</strong></h6>
                                                                                                        <span class="fs_12px-s text-dark">@ {{ $comment->profile->username }}</span>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div>
                                                                                                    <span class="fs_12px-s">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans()}} | {{ Carbon\Carbon::parse($comment->created_at)->format('G:ia') }}</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <p class="fs_12px-s">{{ $comment->comment ?? '' }} </p>
                                                                                        </div>
                                                                                    @endforeach

                                                                                </div>

                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-12 pl-0">
                                                                                    <hr class="">
                                                                                </div>
                                                                            </div>

                                                                            <form  method="post" action="{{ route('postComment') }}" class="frm_new_comment-d">
                                                                                @csrf
                                                                                <div class="input-group word-break word-wrap border-0">
                                                                                    <input type="text" name="comment" placeholder="Add your comment....." class="get_post_comment_length-d  comment-s form-control py-1 textarea_h_w-s ft_size_14px-s border-0 add_comment-d"   id="">
                                                                                    <div class="input-group-append">
                                                                                        <button type="submit" class="border-0 bg-white  px-3 post-s td_none-s" ><strong class="fg_green-s">POST</strong></button>
                                                                                        <input type="hidden" name="post_uuid" class="post_comment_post_uuid-d" value="{{ $media->uuid }}">
                                                                                    <input type="hidden" name="" class="post_id-d" value="{{ $media->id }}" />

                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                            </footer>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--  @else
                                                    <div class="mx-auto my-5 py-5 text-muted text-center">
                                                        <h4 class="mx-auto my-5 py-5 text-muted text-center">No Media Available</h4>
                                                    </div>  --}}
                                            @endif
                                        @endforeach

                                    </div>
                                @endforeach
                            @else
                                {{--  <div class="row justify-content-end d-flex">
                                    <div class="col-2  mb-1">
                                        <a href="" class="btn bg_green-s br_10px-s d-flex justify-content-center px-5 text-white py-3" data-toggle="modal" data-target="#upload_img_modal-d">
                                            <img src="{{ asset('assets/images/upload_icon.svg') }}" width="20" class="mr-2" alt="logout icon">
                                            <strong class="align-self-center"><h6 class="mb-0">Upload</h6></strong>
                                        </a>
                                    </div>
                                </div>  --}}
                                <div class="mx-auto my-5 py-5 text-muted text-center">
                                    <h4 class="mx-auto my-5 py-5 text-muted text-center">No Media Available</h4>
                                </div>
                            @endif
                        </div>


                    </div>
                </div>
            </div>
        @else

        @endif
        <!-- container - end -->
    </div>
    <!-- .................Home Page End ......................... -->

    <!-- Modal  -->

    <!-- upload file modal  -->
    <!-- Modal -->
    <div class="modal fade" id="upload_img_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="modal-header bg_grey-s border-0 br_up_left_right_10px-s">
                    <h5 class="modal-title px-3  text-dark" id="view-head"><strong style="font-family: system-ui; color: #212121;"> UPLOAD</strong></h5>
                </div>
                <div class="container-fluid">
                    <div class="modal-body">

                        <form action="{{ route('userMedia') }}"  method="post" enctype="multipart/form-data" id="upload_media-d">
                            @csrf
                            <div class="row pb-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="caption-d"><Strong>CAPTION</Strong></label>
                                        <textarea class="form-control resize_none-s rounded write_post-d" name="caption" id="caption-d" placeholder="write here" rows="1" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <h6><strong>PHOTO/VIDEO</strong></h6>
                                    <div class="w-100 ">
                                        <label for="media12" class="w-100">
                                            <img src="{{ asset('assets/images/img_upload.svg') }}" class="w_inherit-s img-fluid" alt="upload img"/>
                                        </label>
                                         <input id="media12" type="file" name="media"     class="upload_media-d" style="display: none"/>
                                    </div>
                                </div>
                                <div class="col-12 mt-4 media_image-d d-none">
                                    <img src="{{ asset('assets/images/close.svg') }}" class="remove_img-s position-absolute" alt="remove img">
                                    <div class="" >
                                        <img id="previewImg" src="" class="object_fit_cover-s" width="100px" height="100px" />
                                    </div>
                                </div>
                                <div class="col-12 mt-4 media_video-d d-none">
                                    <img src="{{ asset('assets/images/close.svg') }}" class="remove_img-s position-absolute" alt="remove img">
                                    <div class="" >
                                        {{--  <img id="previewImg" src="" class="object_fit_cover-s" width="100px" height="100px" />  --}}
                                    </div>
                                </div>

                            </div>

                            <div class="row py-3">
                                <div class="col-12 d-flex justify-content-center">
                                    <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 px-5 mr-md-2 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                                    <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white px-5 ml-2 w-100" id="upload_pic-d"><strong>UPLOAD</strong></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- {{ dd(Auth::user()->profile->profile_image) }} --}}


@endsection
