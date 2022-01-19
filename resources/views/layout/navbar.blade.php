
    <nav class="navbar navbar-expand-lg navbar-light pt-3 pb-3">
        <div class="container-fluid px-0">
            <div class="row w-100">
                <div class="col-xl-8 col-lg-8 col-md-7 col-3  pl-md-3 pt-2">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse width_on_md-s" id="navbarTogglerDemo03">
                        <ul class="navbar-nav mt-2 mt-lg-0 w-100 justify-content-around" id="nav_bar-d">
                            <li class="nav-item ml-lg-2">
                                <a class="nav-link nav_link_active-d change_color_of_nav_icon-s active" href="{{ route('home') }}">
                                    <img src="{{ asset('assets/images/home_icon.svg') }}" class="img-fluid" alt="navbar_home" /> Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav_link_active-d" id="get_chats-d" href="{{  route('chat') }}">
                                    <img src="{{ asset('assets/images/chat_icon.svg') }}" class="img-fluid" alt="navbar_chat" /> Chat
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav_link_active-d" href="{{ route('favoriteplayers') }}">
                                    <img src="{{ asset('assets/images/favrticon.svg') }}" class="img-fluid" alt="navbar_fvrt" /> Favorites
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav_link_active-d" href="{{ route('game_invitation') }}">
                                    <img src="{{ asset('assets/images/GameInvitation.svg') }}" class="img-fluid" alt="navbar_home" /> Game Invitations
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav_link_active-d" href="{{ url('/more') }}">
                                    <img src="{{ asset('assets/images/moreoption.svg') }}" class="img-fluid" alt="navbar_home" /> More
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-5 col-9 pr-1 pt-2 text-right">
                    <div class="responsive-flex-div">
                        @if(Auth::User()->profile->address->address != NULL)
                        <img src="{{ asset('assets/images/Location.svg') }}" class="img-fluid nav_location_img" alt="navbar_home" />
                           <span class="text-dark">  <strong> {{Auth::User()->profile->address->city}} </strong> </span>
                        @endif
                        <a class="pl-3 td_none-s" href="{{ route('getUserProfile') }}">
                            <img src="{{ Auth::User()->profile->profile_image != null ? asset(Auth::User()->profile->profile_image) : asset('images/user-no-image.png') }}" class="rounded-circle border_green-s profile_img" width="50" height = "50" alt="Navbar_profile" />
                        </a>

                        <!-- notification drop down -->
                        <a href="" id='noti' role="button" class="noti_btn-s" data-toggle="dropdown" data-route="{{ route('notifications') }}">
                            {{--  <div>  --}}
                                <img  src="{{ asset('assets/images/green_notification.svg') }}" width="15" class="show_notification img-fluid position-absolute d-none show_notification-d" alt="" />

                            {{--  </div>  --}}
                            <img  src="{{ asset('images/noti_bell.png') }}" width="35" class="ml-3 img-fluid " alt="navbar_home" />
                        </a>
                        <div class="col-4 min_w_315px-s  dropdown-menu border-0  shadow br_15px-s ml-xl-5 noti_height">
                            <h4 class="px-4 mt-3 mb-3">
                                <strong class="fg_green-s">Notification</strong>
                            </h4>
                            <h5 class=" text-left p-3 d-none " id='today-d'>
                                <strong class="p-3">Today</strong>
                            </h5>
                            <div class="text-dark" id="today-noti-d">
                            </div>
                            <h5 class=" text-left p-3 d-none " id='yesterday-d'>
                                <strong class="p-3">Yesterday</strong>
                            </h5>
                            <div class="text-dark" id="yesterday-noti-d">
                            </div>
                            <h5 class=" text-left p-3 d-none " id='older-d'>
                                <strong class="p-3">older</strong>
                            </h5>
                            <div class="text-dark" id="older-noti-d">
                            </div>

                            <hr class="goalkeeper_margin_b" />

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
