@extends('layout.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />


 <div class="container-fluid px-0 mx-0 ">

    <div id="loader" class='loader_container-s align-self-center d-none w-100 justify-content-center' style="">
        <img class='align-self-center' width='200' height="200" src="{{ asset('assets/images/logo_gif.gif') }}">
    </div>


        <div class="container-fluid px-xl-5 px-3">
            <div class="row pt-4 pb-3">
                <div class="col-xl-8 col-lg-8 col-md-8 col-12 d-flex order-md-1 order-2">
                    {{--  <a class="td_none-s" href="{{ url('more') }}">
                        <h4 class="pr-2 fs_sm_21px-s text-dark">More</h4>
                    </a>  --}}
                    {{--  <h4 class="px-2 fs_sm_21px-s"><strong>/</strong></h4>  --}}
                    <h4 class="fg_green-s fs_sm_21px-s pl-2">Edit Personal Profile</h4>
                </div>
            </div>
        </div>

        {{-- update profile succes message --}}
         {{--  <div class="align-self-center">
                    @if(session()->has('update_Profile'))
                        <div class="alert alert-success">
                            {{ session()->get('update_Profile') }}
                        </div>
                    @endif
            </div>  --}}

        {{-- update profile succes message --}}
                {{--  <div class="align-self-center">
                    @if(session()->has('error_update_Profile'))
                        <div class="alert alert-danger">
                            {{ session()->get('error_update_Profile') }}
                        </div>
                    @endif
                </div>  --}}

                {{-- {{ dd(Auth::user()->profile->profile_image) }} --}}
        <!-- container for edit profile - start -->
        <form action="{{ route('updateProfile') }}"  id="frm_edit_profile-d" method="post" enctype="multipart/form-data">
            <div class="container-fluid bg-white br_47px-s mh_86vh-s">
                <div class="row pt-5 px-xl-4 justify-content-center">
                    <div class="col-12 text-center">
                        <label for="update_profile_image-d">
                            <img src="{{ asset('assets/images/edit_profile.svg') }}" class="position-absolute edit_profile-s" alt="edit profile icon">
                        </label>
                        <input type="file" name="media" id="update_profile_image-d" class="d-none">
                        <div>
                            <img src="{{ Auth::user()->profile->profile_image != null ? asset(Auth::user()->profile->profile_image) : asset('images/user-no-image.png') }}" id="updatePreview" width="128" height="128" class="border_green-s rounded-circle profile_img" alt="player img">
                        </div>
                        {{-- <img id="updatePreview" src="" width="100px" height="100px"/> --}}

                    </div>
                </div>
                @csrf
                <div class="row pt-2 pb-5 px-xl-4 px-3">
                    <div class="col-lg-4 col-md-6 col-12 pt-3">
                        <div class="form-group">
                            <label for="first_name-d"><h6><strong>FIRST NAME</strong></h6></label>
                            <input type="text" name="first_name" class="form-control fs_14px-s form-control-lg first_name-t rounded" value="{{ Auth::user()->profile->first_name }}" id="first_name-d" placeholder="First Name">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 pt-3">
                        <div class="form-group">
                            <label for="last_name-d"><h6><strong>SURNAME</h6></strong></h6></label>
                            <input type="text" name="last_name" class="form-control fs_14px-s form-control-lg last_name-t rounded" value="{{ Auth::user()->profile->last_name }}" id="last_name-d" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 pt-3">
                        <div class="form-group">
                            <label for="User_name-d"><h6><strong>USERNAME</strong></h6></label>
                            <input type="text" name="username" class="form-control fs_14px-s form-control-lg User_name-t rounded" value="{{ Auth::user()->email}}" id="first_name-d" placeholder="User Name">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 pt-3">
                        <div class="form-group">
                            <label for="date_of_birth-d"><h6><strong>DATE OF BIRTH</strong></h6></label>
                            <input type="date" name="dob" class="form-control fs_14px-s form-control-lg date_of_birth_calander-s date_of_birth-t rounded" value="{{ Auth::user()->profile->dob }}" id="date_of_birth-d" placeholder="Date of Birth">
                            <!-- <span class="open_button-s">
                                <div class="dropdown">
                                    <button type="button"  id="dropdownMenuButton" data-toggle="dropdown" >
                                        <img src="{{ asset('assets/images/calendar.png') }}" class="img-fluid" width="15" height="15" alt="Calendar">
                                    </button>
                                    <div class="dropdown-menu w_max_content-s calendar_responsive-s py-0 my-0 border-0 br_8px-s">
                                        <a href="javascript:void(0)" class="dropdown-item px-0 py-0">
                                            <div class="calendar date_pickup-d"></div>
                                        </a>
                                    </div>
                                </div>
                            </span> -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 pt-3">
                        <div class="form-group">
                            <label for="favorite_club-d"><h6><strong>FAVORITE CLUB</strong></h6></label>
                            <input type="text" name="favorite_club" class="form-control fs_14px-s form-control-lg favorite_club-t rounded" value="{{ Auth::user()->profile->favorite_club }}" id="favorite_club-d" placeholder="Favorite Club">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 pt-3">
                        <div class="form-group">
                            <label for="price-d"><h6><strong>PRICE</strong></h6></label>
                            <input type="number" name="price" class="form-control fs_14px-s form-control-lg price-t rounded spinner_remove-s" value="{{ Auth::user()->profile->price }}" id="price-d" >
                        </div>
                    </div>
                </div>


                <div class="row px-xl-5 px-3">
                    <div class="col-lg-4 col-12 pt-4">
                        <h6><strong>GENDER</strong></h6>
                        <div class="form-check  d-flex pl-0">
                            <input class="form-check-input radio-inline " type="radio" name="gender" id="male-d" value="male"  {{ Auth::user()->profile->gender == 'male' ? 'checked' : ''}} >
                            <label for="male-d" class="form-check-label radio_label-s d-flex fs_18px-s">
                                <span class="pl-3 fs_14px-s"><strong>Male</strong></span>
                            </label>
                            <input class="form-check-input radio-inline  mt-2 mr-3" type="radio" name="gender" id="female-d" value="female" {{ Auth::user()->profile->gender == 'female' ? 'checked' : ''}}>
                            <label for="female-d" class="form-check-label radio_label-s d-flex fs_18px-s ml-5">
                                <span class="pl-3 fs_14px-s"><strong>Female</strong></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-8 col-12 pt-4">
                        <h6><strong>POSITION</strong></h6>
                        <div class="form-check d-md-flex pl-0">
                            <input class="form-check-input radio-inline mt-2 mr-3" type="radio" name="position" id="goalkeeper-d" value="goalkeeper" {{ Auth::user()->profile->position == 'goalkeeper' ? 'checked': ''}} >
                            <label for="goalkeeper-d" class="form-check-label radio_label-s d-flex  fs_18px-s mt-lg-0 mt-2 ">
                                <span class="pl-md-3 pl-1 fs_14px-s"><strong>Goalkeeper</strong></span>
                            </label>
                            <input class="form-check-input radio-inline mt-2 mr-3" type="radio" name="position" id="defender-d" value="defender" {{ Auth::user()->profile->position == 'defender' ? 'checked' : ''}}>
                            <label for="defender-d" class="form-check-label radio_label-s d-flex  fs_18px-s ml-md-5 mt-lg-0 mt-2  ">
                                <span class="pl-md-3 pl-1 fs_14px-s"><strong>Defender</strong></span>
                            </label>
                            <input class="form-check-input radio-inline mt-2 mr-3" type="radio" name="position" id="midfielder-d" value="midfielder" {{ Auth::user()->profile->position == 'midfielder' ? 'checked' : ''}}>
                            <label for="midfielder-d" class="form-check-label radio_label-s d-flex  fs_18px-s ml-md-5 mt-lg-0 mt-2 ">
                                <span class="pl-md-3 pl-1 fs_14px-s"><strong>Midfielder</strong></span>
                            </label>
                            <input class="form-check-input radio-inline mt-2 mr-3" type="radio" name="position" id="forward-d" value="forward" {{ Auth::user()->profile->position == 'forward' ? 'checked' : ''}}>
                            <label for="forward-d" class="form-check-label radio_label-s d-flex  fs_18px-s ml-md-5 mt-lg-0 mt-2 ">
                                <span class="pl-md-3 pl-1 fs_14px-s"><strong>Forward</strong></span>
                            </label>
                        </div>
                    </div>
                </div>

                    <div class="row px-xl-5 px-3 py-5">
                        <div class="col-12 text-right">
                            {{-- <input type="hidden" name="profile_uuid" value="{{ Auth::user()->profile->uuid}}" /> --}}
                            <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white w_h_184px_x_63px-s"><strong>SAVE</strong></button>
                        </div>
                    </div>
            </div>
        </form>
        <!-- container for edit profile - end -->
    </div>

@endsection
