<!DOCTYPE html>
<!-- Signup -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@700&display=swap" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/countrySelect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ui.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pignose.calendar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/naveed.css') }}">

</head>
<body class="font_family_roboto-s">
    <div id="loader" class='loader_container-s align-self-center d-none w-100 justify-content-center' style="">
        <img class='align-self-center' width='200' height="200" src="{{ asset('assets/images/logo_gif.gif') }}">
    </div>
      <div class="container-fluid">
          <div class="row bg_blue_gray-s set_height-d ">
                <div class=" col-xl-3 col-lg-3 col-md-4 col-12 align-self-center ">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center align-items-center my-5  ">
                            <img src="{{ asset('assets/images/KJ_Logo.svg') }}" width="150" height="150" alt="logo" class="pl-2">

                            {{-- <div class="one_s d-flex justify-content-center align-items-center">Logo</div> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center my-sm-5">
                        <h4 class="sign_welcome-s mb-4">
                            <strong> Welcome To
                                <span class="">
                                    <br> Kjora
                                </span>
                            </strong>
                        </h4>
                        <h6 class="text-center d-none d-md-none d-lg-block">
                            <strong> You Can Find Players for your
                            <br>
                            game and also get game
                            <br>
                            invitations.
                            </strong>
                        </h6>
                    </div>
                </div>
                <div class="row d-none d-md-block d-xl-block d-lg-block ">
                    <div class="col-12 d-flex justify-content-center align-items-center my-5">
                        <button type="button" class="btn sign_in-s py-3 text-white"><strong>SIGN IN</strong></button>
                    </div>
                </div>
            </div>


               <div class="col-lg-9 col-md-8 col-12 bg_img-s main_div-s bg-white">
                     <div class="align-self-center mt-2">
                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                    </div>


                    <form action="{{ route('signup') }}" id="frm_signup-d" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12 mt-md-5 mt-3 text-md-left text-center">
                                <h4 class="account_tag-s "> <strong><b>Create an account</b></strong> </h4>
                                <p class=""> <strong>Join us to start Searching</strong> </p>
                                </div>

                            <div class="col-md-6 col-12 mt-md-4 d-flex justify-content-md-end justify-content-center ">
                                        {{--  <img class="d-none px-3"  id="previewProfileImg" src="" width="auto" height="100px" type="hidden"/>  --}}
                                <div  class="text-center">
                                    <div class="img_div-s d-flex justify-content-center align-items-center  mx-auto">
                                        <label for="profile_image-d">
                                            <img src="{{  asset('images/camera_icon.svg') }}" alt="Image Upload"  class="image_uploader-s " id="previewProfileImg" value="{{ old('media') }}" >
                                        </label>
                                        <input value="{{ old('media') }}"  type="file" name="media" id="profile_image-d"  class="d-none"/>
                                    </div>

                                    <div>
                                        <h6 class="upload-s mt-2">Upload picture</h6>
                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="row d-flex justify-content-around mt-2">
                            <div class="col-md-6 col-12 my-2">
                                <div class="field">
                                    <label class="label-s ml-2 px-1" for="First name">
                                        <strong class="fm_roboto-s ">FIRST NAME</strong>
                                    </label>
                                    <input type="text" name="first_name" class="form-control form-control-lg fs_13px-s py-4 w-100" id="first_name-d" placeholder="Please enter your first name" value = "{{ old('first_name') ?? '' }}"  />
                                </div>

                                </div>
                            <div class="col-md-6 col-12 my-2">
                                <div class="field">
                                    <label class="label-s ml-2 px-1" for="Last name"> <strong class="fm_roboto-s ">LAST NAME</strong></label>
                                    <input type="text" name="last_name" class=" form-control form-control-lg fs_13px-s py-4 w-100 " id="last_name-d" placeholder="Please enter your Last name" value = {{ old('last_name') ?? ''  }}>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-around">
                            <div class="col-md-6 col-12 my-3">
                            <div class="field">
                                <label class="label-s ml-2 px-1" for="email"> <strong class="fm_roboto-s ">EMAIL ADDRESS</strong></label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg fs_13px-s py-4 w-100" id="email-d" placeholder="Please enter your email" >
                            </div>

                            </div>
                            <div class="col-md-6 col-12 my-3">
                            <div class="field password_container-d">
                                <label  class="label-s ml-2 px-1 z_index_1-s" for="password"> <strong class="fm_roboto-s ">PASSWORD</strong> </label>
                                <div class="input-group border border_on_focus-s">
                                    <input type="password" name="password" class=" form-control form-control-lg fs_13px-s br_5px-s password-s py-4 password-d border-0" id="password-d" placeholder="Please enter your password">
                                    <div class="input-group-prepend mr-0 br_5px-s">
                                        <div class="input-group-text border-0 br_right_5px-s bg-white" id="inputGroup-sizing-default">
                                            <img src="{{ asset('assets/images/hide_pass_icon.svg') }}" data-view_icon_url="{{ asset('assets/images/view_pass_icon.svg') }}" data-dont_view_icon_url="{{ asset('assets/images/hide_pass_icon.svg') }}"  alt='eye' class=' toggle_eye_icon-d rounded-circle cursor_pointer-s'  aria-describedby="inputGroup-sizing-default" />
                                        </div>
                                    </div>
                                </div>
                                <!-- <input type="password" name="password" class=" form-control form-control-lg fs_13px-s py-4 w-100 " id="password-d" placeholder="Please enter your password"> -->
                            </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12 my-3">
                            <div class="field">
                                <label class="label-s ml-2 px-1"  for="user name"> <strong class="fm_roboto-s ">USER NAME</strong></label>
                                <input type="text" name="username"  value="{{ old('username') }}" class=" form-control form-control-lg fs_13px-s py-4 w-100 " id="user_name-d" placeholder="Please enter your user name">
                            </div>

                            </div>
                            <div class="col-md-6 col-12 my-3">
                            <div class="field">
                                <label class="label-s ml-2 px-1"  for="club"> <strong class="fm_roboto-s ">FAVOURITE CLUB</strong></label>
                                <input type="text" name="favouriteclub" class=" form-control form-control-lg fs_13px-s py-4 w-100 " id="favourite_club-d" placeholder="Please enter your favourite club" value = {{ old('favouriteclub') ?? ''}}>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12 my-3">
                                <div class="field">
                                    <label class="label-s ml-2 px-1 z_index_1-s"  for="country"> <strong class="fm_roboto-s ">COUNTRY</strong></label>
                                    <input type="text" name="country" class=" form-control form-control-lg fs_13px-s py-4 w-100 " id="country-d" placeholder="Please enter your user country" value = {{ old('country') ?? ''}} >
                                </div>

                            </div>
                             <div class="col-md-6 col-12 my-3">
                                <div class="field">
                                    <label class="label-s ml-2 px-1"  for="city"> <strong class="fm_roboto-s ">CITY</strong></label>
                                    <input type="text" name="city" class=" form-control form-control-lg fs_13px-s py-4 w-100 " id="city-d" placeholder="Please enter your user city" value = {{ old('city') ?? ''}}>
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12 my-3">
                                <div class="field">
                                    <label class="label-s ml-2 px-1"  for="address"> <strong class="fm_roboto-s ">ADDRESS</strong></label>
                                    <input type="text" name="address" class=" form-control form-control-lg fs_13px-s py-4 w-100 " id="address-d" placeholder="Please enter your user address" value = {{ old('address') ?? '' }}>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-4 col-12 pt-4">
                                <h6 class="h6_tag-s">GENDER</h6>
                                <div class="form-check d-flex pl-0">
                                    <input class="form-check-inpu radio-inline mb-5 mr-1" type="radio" name="gender" id="male-d" value="male" checked>
                                    <label for="male-d" class="form-check-label radio_label-s d-flex fs_18px-s mr-5">
                                        <span class="pl-1 fs_14px-s"> <strong>Male</strong> </span>
                                    </label>
                                    <input class="form-check-input radio-inline mb-5 mr-3" type="radio" name="gender" id="female-d" value="female">
                                    <label for="female-d" class="form-check-label d-flex radio_label-s fs_18px-s ml-5 ">
                                        <span class="pl-1 fs_14px-s"> <strong>Female</strong> </span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-xl-7 offset-xl-1 col-12 pt-4 ">
                                <h6 class="h6_tag-s">POSITION</h6>
                                <div class="form-check justify-content-lg-between d-lg-flex pl-0">
                                    <input class="form-check-input radio-inline mb-5 mr-3 " type="radio" name="position" id="goalkeeper-d" value="goalkeeper" checked>
                                    <label for="goalkeeper-d" class="form-check-label radio_label-s d-flex  mt-lg-0 mt-2 ">
                                        <span class=" pl-1 fs_14px-s"> <strong>Goalkeeper</strong> </span>
                                    </label>
                                    <input class="form-check-input radio-inline mb-5 mr-3 " type="radio" name="position" id="defender-d" value="defender">
                                    <label  for="defender-d" class="form-check-label radio_label-s d-flex   mt-lg-0 mt-2  ">
                                        <span class=" pl-1 fs_14px-s"> <strong>Defender</strong> </span>
                                    </label>
                                    <input class="form-check-input radio-inline mb-5 mr-3 " type="radio" name="position" id="midfielder-d" value="midfielder" >
                                    <label  for="midfielder-d" class="form-check-label radio_label-s d-flex  mt-lg-0 mt-2 ">
                                        <span class=" pl-1 fs_14px-s"> <strong>Midfielder</strong> </span>
                                    </label>
                                    <input for="forward-d" class="form-check-input radio-inline mb-5 mr-3 " type="radio" name="position" id="forward-d" value="forward">
                                    <label for="forward-d" class="form-check-label radio_label-s d-flex  mt-lg-0 mt-2">
                                        <span class=" pl-1 fs_14px-s"> <strong>Forward</strong> </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12 col-lg-4  col-12 my-3">
                                <div class="field">
                                    <label  for="date_of_birth" class="color-s ml-2 px-1 z_index_1-s"> <strong class="fm_roboto-s ">DATE OF BIRTH</strong></label>
                                    <input type="Date" name="date_of_birth" class=" form-control form-control-lg fs_13px-s py-3 date_calander-s h_51px-s w-100" id="date_of_birth-d" max="2021-12-31" value = {{ old('date_of_birth') ?? '' }} >
                                    <!-- <span class="open_button-s top_10px-s">
                                        <div class="dropdown">
                                            <button type="button"  id="dropdownMenuButton" data-toggle="dropdown" >
                                                <img src="{{ asset('assets/images/calendar.png') }}" class="img-fluid" width="20" height="20" alt="Calendar">
                                            </button>
                                            <div class="dropdown-menu w_max_content-s calendar_responsive-s py-0 my-0 border-0 br_8px-s">
                                                <a href="javascript:void(0)" class="dropdown-item px-0 py-0">
                                                    <div class="calendar"></div>
                                                </a>
                                            </div>
                                        </div>
                                    </span> -->
                                </div>

                            </div>
                            <div class="col-md-12 col-lg-4  col-12 my-3">
                                <div class="field">
                                    <label  for="club" class="color-s ml-2 px-1 z_index_1-s"> <strong class="fm_roboto-s ">PHONE #</strong></label>
                                    <!-- <input type="text" name="phone_no" class=" form-control form-control-lg  fs_13px-s py-4  w-100"  maxlength="12" id="phone_no-d" placeholder="83XXXXXXXXXX" value="{{ old('phone_no') }}"> -->
                                    <!-- <input id="country_code_2-d" type="hidden" name="phone_code_2"/>
                                    <input id="phone_number_2-d" type="tel" class="form-control rounded_border-s intl_tel_input-s py-4 rounded mt-2 phone_no_2-t" maxlength="12" name="phone_no" placeholder="83XXXXXXXXXX" value="{{ old('phone_no') }}" /> -->
                                    <input class="country_code-d" type="hidden" name="phone_code" value="{{ old('phone_code') }}"/>
                                    <input type="tel" name="phone_no" class="form-control form-control-lg append_phone_code-d  fs_13px-s py-4 intl_tel_input-s  w-100" placeholder="83XXXXXXXXXX" id="phone_number-d" maxlength="14" aria-describedby="phone_no" value="{{ old('phone_no') ?  old('phone_no') : '+1' }}" />
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-12 my-3">
                                <div class="field">
                                    <label  for="club" class="color-s ml-2 px-1"> <strong class="fm_roboto-s ">PRICE</strong></label>
                                    <input type="number" name="price" class=" form-control form-control-lg spinner_remove-s fs_13px-s py-4  w-100" id="price-d" placeholder="$ Please enter your match price" value = {{ old('price') ?? '' }} >
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-check pl-0">
                                    <input class="form-check-input" type="radio" name="check" id="radio-d" value="option1" >
                                    <label for="radio-d" class="form-check-label  align-self-center d-flex  mt-lg-0 mt-2 " for="radio-d">
                                    <span class="pl-2"> I agree with the  <span><a href="{{ route('termsAndConditions') }}" target="_blank">Terms of Services</a></span> </span>
                                    </label>
                                    {{-- <input type="hidden" name="termsandconditions" class="termsandconditions-d" value="" > --}}
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2 mb-5">
                            <div class="col-12 bnt d-md-block d-flex">
                                <button type="submit" class="btn btn-sign-in float-right text-white py-3 br_10px-s" > <strong>SIGN UP</strong> </button>
                                <!-- <button type="button" class="btn btn-sign-in float-left d-sm-block d-md-none d-xl-none d-lg-none ml-3 br_10px-s text-white py-3"> <strong>SIGN IN</strong> </button> -->
                                <a href="{{ route('login') }}" type="button" class="btn btn-sign-in float-left d-sm-block d-md-none d-xl-none d-lg-none ml-3 br_10px-s text-white py-3"><strong>SIGN IN</strong></a>
                            </div>
                        </div>
                    </form>



              </div>
          </div>
      </div>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" ></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js "></script> --}} -->

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js "></script>
     <!-- Latest compiled JavaScript -->
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('assets/js/observe_dom_change.js') }}"></script>
    <script src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="{{ asset('assets/js/countrySelect.js') }}"></script>
    <script src="{{ asset('assets/js/common.js') }}"></script>
    <script src="{{ asset('assets/js/auth.js') }}"></script>
    <script src="{{ asset('assets/js/media.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pignose.calendar.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/phone_input_custom.js') }}"></script>

    <script>
        $("#country-d").countrySelect({
            defaultCountry: "",
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // responsiveDropdown: true,
            preferredCountries: ['ca', 'gb', 'us']
        });
	</script>

    <script type="text/javascript">
        //<![CDATA[
        // $(function() {
        //     $('#wrapper .version strong').text('v' + $.fn.pignoseCalendar.version);

        //     function onSelectHandler(date, context) {
        //         /**
        //          * @date is an array which be included dates(clicked date at first index)
        //          * @context is an object which stored calendar interal data.
        //          * @context.calendar is a root element reference.
        //          * @context.calendar is a calendar element reference.
        //          * @context.storage.activeDates is all toggled data, If you use toggle type calendar.
        //          * @context.storage.events is all events associated to this date
        //          */

        //         var $element = context.element;
        //         var $calendar = context.calendar;
        //         var $box = $element.siblings('.box').show();
        //         var text = '';

        //         if (date[0] !== null) {
        //             text += date[0].format('YYYY-MM-DD');
        //         }

        //         if (date[0] !== null && date[1] !== null) {
        //             text += ' ~ ';
        //         } else if (date[0] === null && date[1] == null) {
        //             text += 'nothing';
        //         }

        //         if (date[1] !== null) {
        //             text += date[1].format('YYYY-MM-DD');
        //         }

        //         let change = moment(text).format('DD/MM/YYYY')
        //         $(".select_invitation_date-d").text(change);
        //         $(".input_select_invitation_date-d").val(text);
        //         $box.text(text);

        //         $(".filter_by_date-d").val(text);
        //         // $(`#date_of_birth-d`).val(text);
        //         $(`#date_of_birth-d-error`).remove();
        //         $('.dropdown-menu').removeClass('show');
        //         // console.log(change);
        //         // console.log(text);

        //     }

        //     function onApplyHandler(date, context) {
        //         /**
        //          * @date is an array which be included dates(clicked date at first index)
        //          * @context is an object which stored calendar interal data.
        //          * @context.calendar is a root element reference.
        //          * @context.calendar is a calendar element reference.
        //          * @context.storage.activeDates is all toggled data, If you use toggle type calendar.
        //          * @context.storage.events is all events associated to this date
        //          */

        //         var $element = context.element;
        //         var $calendar = context.calendar;
        //         var $box = $element.siblings('.box').show();
        //         var text = 'You applied date ';

        //         if (date[0] !== null) {
        //             text += date[0].format('YYYY-MM-DD');
        //         }

        //         if (date[0] !== null && date[1] !== null) {
        //             text += ' ~ ';
        //         } else if (date[0] === null && date[1] == null) {
        //             text += 'nothing';
        //         }

        //         if (date[1] !== null) {
        //             text += date[1].format('YYYY-MM-DD');
        //         }

        //         $box.text(text);

        //     }

        //     // Default Calendar
        //     $('.calendar').pignoseCalendar({
        //         dateFormat: 'dd / mm / yy',
        //         select: onSelectHandler
        //     });

        //     // Input Calendar
        //     $('.input-calendar').pignoseCalendar({
        //         apply: onApplyHandler,
        //         buttons: true, // It means you can give bottom button controller to the modal which be opened when you click.
        //     });

        //     // Calendar modal
        //     var $btn = $('.btn-calendar').pignoseCalendar({
        //         apply: onApplyHandler,
        //         modal: true, // It means modal will be showed when you click the target button.
        //         buttons: true
        //     });

        //     // Color theme type Calendar
        //     $('.calendar-dark').pignoseCalendar({
        //         theme: 'dark', // light, dark, blue
        //         select: onSelectHandler
        //     });

        //     // Blue theme type Calendar
        //     $('.calendar-blue').pignoseCalendar({
        //         theme: 'blue', // light, dark, blue
        //         select: onSelectHandler
        //     });

        //     // Schedule Calendar
        //     $('.calendar-schedules').pignoseCalendar({
        //         scheduleOptions: {
        //             colors: {
        //                 holiday: '#2fabb7',
        //                 seminar: '#5c6270',
        //                 meetup: '#ef8080'
        //             }
        //         },
        //         schedules: [{
        //             name: 'holiday',
        //             date: '2017-08-08'
        //         }, {
        //             name: 'holiday',
        //             date: '2017-09-16'
        //         }, {
        //             name: 'holiday',
        //             date: '2017-10-01',
        //         }, {
        //             name: 'holiday',
        //             date: '2017-10-05'
        //         }, {
        //             name: 'holiday',
        //             date: '2017-10-18',
        //         }, {
        //             name: 'seminar',
        //             date: '2017-11-14'
        //         }, {
        //             name: 'seminar',
        //             date: '2017-12-01',
        //         }, {
        //             name: 'meetup',
        //             date: '2018-01-16'
        //         }, {
        //             name: 'meetup',
        //             date: '2018-02-01',
        //         }, {
        //             name: 'meetup',
        //             date: '2018-02-18'
        //         }, {
        //             name: 'meetup',
        //             date: '2018-03-04',
        //         }, {
        //             name: 'meetup',
        //             date: '2018-04-01'
        //         }, {
        //             name: 'meetup',
        //             date: '2018-04-19',
        //         }],
        //         select: function(date, context) {
        //             var message = `You selected ${(date[0] === null ? 'null' : date[0].format('YYYY-MM-DD'))}.
		// 					   <br />
		// 					   <br />
		// 					   <strong>Events for this date</strong>
		// 					   <br />
		// 					   <br />
		// 					   <div class="schedules-date"></div>`;
        //             var $target = context.calendar.parent().next().show().html(message);

        //             for (var idx in context.storage.schedules) {
        //                 var schedule = context.storage.schedules[idx];
        //                 if (typeof schedule !== 'object') {
        //                     continue;
        //                 }
        //                 $target.find('.schedules-date').append('<span class="ui label default">' + schedule.name + '</span>');
        //             }
        //         }
        //     });

        //     // Multiple picker type Calendar
        //     $('.multi-select-calendar').pignoseCalendar({
        //         multiple: true,
        //         select: onSelectHandler
        //     });

        //     // Toggle type Calendar
        //     $('.toggle-calendar').pignoseCalendar({
        //         toggle: true,
        //         select: function(date, context) {
        //             var message = `You selected ${(date[0] === null ? 'null' : date[0].format('YYYY-MM-DD'))}.
        //                         <br />
        //                         <br />
        //                         <strong>Events for this date</strong>
        //                         <br />
        //                         <br />
        //                         <div class="active-dates"></div>`;
        //             var $target = context.calendar.parent().next().show().html(message);

        //             for (var idx in context.storage.activeDates) {
        //                 var date = context.storage.activeDates[idx];
        //                 if (typeof date !== '<span class="ui label"><i class="fas fa-code"></i>string</span>') {
        //                     continue;
        //                 }
        //                 $target.find('.active-dates').append('<span class="ui label default">' + date + '</span>');
        //             }
        //         }
        //     });

        //     // Disabled date settings.
        //     (function() {
        //         // IIFE Closure
        //         var times = 30;
        //         var disabledDates = [];
        //         for (var i = 0; i < times; /* Do not increase index */ ) {
        //             var year = moment().year();
        //             var month = 0;
        //             var day = parseInt(Math.random() * 364 + 1);
        //             var date = moment().year(year).month(month).date(day).format('YYYY-MM-DD');
        //             if ($.inArray(date, disabledDates) === -1) {
        //                 disabledDates.push(date);
        //                 i++;
        //             }
        //         }

        //         disabledDates.sort();

        //         var $dates = $('.disabled-dates-calendar').siblings('.guide').find('.guide-dates');
        //         for (var idx in disabledDates) {
        //             $dates.append('<span>' + disabledDates[idx] + '</span>');
        //         }

        //         $('.disabled-dates-calendar').pignoseCalendar({
        //             select: onSelectHandler,
        //             disabledDates: disabledDates
        //         });
        //     }());

        //     // Disabled Weekdays Calendar.
        //     $('.disabled-weekdays-calendar').pignoseCalendar({
        //         select: onSelectHandler,
        //         disabledWeekdays: [0, 6]
        //     });

        //     // Disabled Range Calendar.
        //     var minDate = moment().set('dates', Math.min(moment().day(), 2 + 1)).format('YYYY-MM-DD');
        //     var maxDate = moment().set('dates', Math.max(moment().day(), 24 + 1)).format('YYYY-MM-DD');
        //     $('.disabled-range-calendar').pignoseCalendar({
        //         select: onSelectHandler,
        //         minDate: minDate,
        //         maxDate: maxDate
        //     });

        //     // Multiple Week Select
        //     $('.pick-weeks-calendar').pignoseCalendar({
        //         pickWeeks: true,
        //         multiple: true,
        //         select: onSelectHandler
        //     });

        //     // Disabled Ranges Calendar.
        //     $('.disabled-ranges-calendar').pignoseCalendar({
        //         select: onSelectHandler,
        //         disabledRanges: [
        //             ['2016-10-05', '2016-10-21'],
        //             ['2016-11-01', '2016-11-07'],
        //             ['2016-11-19', '2016-11-21'],
        //             ['2016-12-05', '2016-12-08'],
        //             ['2016-12-17', '2016-12-18'],
        //             ['2016-12-29', '2016-12-30'],
        //             ['2017-01-10', '2017-01-20'],
        //             ['2017-02-10', '2017-04-11'],
        //             ['2017-07-04', '2017-07-09'],
        //             ['2017-12-01', '2017-12-25'],
        //             ['2018-02-10', '2018-02-26'],
        //             ['2018-05-10', '2018-09-17'],
        //         ]
        //     });

        //     // I18N Calendar
        //     $('.language-calendar').each(function() {
        //         var $this = $(this);
        //         var lang = $this.data('lang');
        //         $this.pignoseCalendar({
        //             lang: lang
        //         });
        //     });

        //     // This use for DEMO page tab component.
        //     // $('.menu .item').tab();


        // });
        //]]>

    /**------------ Set current date eighteenYearsAgo ----------- */

    window.onload = function() {
        // eighteenYearsAgo = new Date();
        // eighteenYearsAgo = eighteenYearsAgo.setFullYear(eighteenYearsAgo.getFullYear()-18);
        // console.log(eighteenYearsAgo);
        // console.log("sf");

        var today = moment();
        var eighteenYearsAgo = today.subtract('year', 18).format('YYYY-MM-DD');
        $(`#date_of_birth-d`).val(eighteenYearsAgo);

        // $(`#date_of_birth-d`).val();
    };
    </script>




    <script type="text/javascript">

        $( document ).ready(function() {

            $(`.pignose-calendar-unit-date`).on('click',function () {
               $(`#date_of_birth-d`).val($(this).attr('data-date'));
            });


                if('localStorage' in window) {
                    let val =localStorage.getItem('setValue');
                    $(".termsandconditions-d").val(val)
                // localStorage can be used
                } else {
                    console.log('ok, not ok');
                // can't be used
                }
        });
    </script>

    <script>
        let LOGIN = "{{ route('login') }}";
        // let signUp = "{{ route('signup') }}";
    </script>


</body>

</html>
