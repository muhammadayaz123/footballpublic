
        <nav class="navbar navbar-expand-lg navbar-light pt-3 pb-3">
            <div class="container-fluid px-0">
                <div class="row w-100 pr-xl-3">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-2 pt-2">
                        <button class="navbar-toggler ml-2" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                            <ul class="navbar-nav mt-2 mt-lg-0 w-100 justify-content-around" id="nav_bar-d">
                                <li class="nav-item ml-2">
                                    <a class="nav-link nav_link_active-d" href="{{ route('getAllUsers') }}">
                                        <img src="{{ asset('images/player_icon.svg') }}" width="30" class="img-fluid" alt="navbar_users" />
                                        <span> All Users</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav_link_active-d" href="{{ route('all_stadium') }}">
                                        <img src="{{ asset('images/stadium_icon.svg') }}" width="30" class="img-fluid" alt="navbar_stadiums" />
                                        <span>All Stadiums</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav_link_active-d" href="javascript:void(0)">
                                        <img src="{{ asset('images/payment_icon.svg') }}" width="30" class="img-fluid pt-2" alt="navbar_payments" />
                                        <span>All Payments</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav_link_active-d" href="{{ route('settings') }}">
                                        <img src="{{ asset('assets/images/moreoption.svg') }}" width="25" class="img-fluid pt-1" alt="navbar_setting" />
                                        <span>Setting</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-10 pt-2 text-right">
                        <div class="">
                            <a class="nav-link dropdown-toggle no_link-s align-self-center text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-3"><strong>{{ Auth::user()->profile->username }}</strong></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown_hover-s" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
