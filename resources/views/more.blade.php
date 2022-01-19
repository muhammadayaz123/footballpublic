@extends('layout.app')

@section('content')
       <!-- .................More Page Start ......................... -->
    <div class="container-fluid px-0 mx-0 ">



        <!-- -------heading container - start -->
        <div class="container-fluid">
            <div class="row py-5 px-xl-5 justify-content-between">
                <div class="col-md-5 col-12 align-self-center">
                    <h1 class="">
                        <Strong>More</Strong>
                    </h1>
                    <h4>Change your account settings</h4>
                </div>
                <div class="col-md-7 col-12 justify-content-md-end mt-md-0 mt-4 d-flex align-self-center">
                    <a href="{{ route('logout') }}" class="btn bg_green-s br_10px-s d-flex justify-content-center w_h_184px_x_63px-s text-white py-3">
                        <img src="{{ asset('assets/images/logout_icon.svg') }}" width="20" class="mr-2" alt="logout icon">
                        <strong class="align-self-center"><h6 class="mb-1">Logout</h6></strong>
                    </a>
                </div>
            </div>
        </div>
        <!-- ------heading container - end -->

        <!-- container for favorite players - start -->
        <div class="container-fluid bg-white br_47px-s">
            <div class="row pt-5 px-xl-5">
                <div class="col-12 fg_green-s">
                    <h4 class=""><strong>Account</strong></h4>
                </div>
            </div>
            <div class="row pt-2 pb-5 px-xl-5">
                <div class="col-12 my-3">
                    <a class="td_none-s" href="{{ url('edit_profile') }}">
                        <div class="d-flex bg_grey-s py-4 px-3 br_10px-s text-dark justify-content-between">
                            <div class="align-self-center">
                                <h6 class="mb-0"><strong>Edit Personal Profile</strong></h6>
                            </div>
                            <div class="align-self-center">
                                <img src="{{ asset('assets/images/arrow_black.svg') }}" alt="">
                            </div>
                        </div>
                    </a>
                </div>
                <div class=" col-12 my-3">
                    <div class="d-flex bg_grey-s py-4 px-3 br_10px-s text-dark justify-content-between" data-toggle="modal" data-target="#update_phone_num_modal-d">
                        <div class="align-self-center">
                            <h6 class="mb-0"><strong>Update Phone Number</strong></h6>
                        </div>
                        <div class="align-self-center">
                            <img src="{{ asset('assets/images/arrow_black.svg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-12 my-3">
                    <div class="d-flex bg_grey-s py-4 px-3 br_10px-s text-dark justify-content-between" data-toggle="modal" data-target="#update_password_modal-d">
                        <div class="align-self-center">
                            <h6 class="mb-0"><strong>Update Password</strong></h6>
                        </div>
                        <div class="align-self-center">
                            <img src="{{ asset('assets/images/arrow_black.svg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-12 my-3" data-toggle="modal" data-target="#update_email_modal-d">
                    <div class="d-flex bg_grey-s py-4 px-3 br_10px-s text-dark justify-content-between">
                        <div class="align-self-center">
                            <h6 class="mb-0"><strong>Update Email</strong></h6>
                        </div>
                        <div class="align-self-center">
                            <img src="{{ asset('assets/images/arrow_black.svg') }}" alt="">
                        </div>
                    </div>
                </div>
                {{-- <div class="col-12 my-3" data-toggle="modal" data-target="#update_bank_details_modal-d">
                    <div class="d-flex bg_grey-s py-4 px-3 br_10px-s text-dark justify-content-between">
                        <div class="align-self-center">
                            <h6 class="mb-0"><strong>Update Bank Details</strong></h6>
                        </div>
                        <div class="align-self-center">
                            <img src="{{ asset('assets/images/arrow_black.svg') }}" alt="">
                        </div>
                    </div>
                </div> --}}

            </div>

            <div class="row  px-xl-5">
                <div class="col-12 fg_green-s">
                    <h4 class=""><strong>Notifications</strong></h4>
                </div>
            </div>

            <div class="row pt-3 pb-5 px-xl-5">
                <div class="col-12 pt-3">
                    <div class="d-flex bg_grey-s py-4 px-3 br_10px-s text-dark justify-content-between">
                        <div class="align-self-center">
                            <h6 class="mb-0"><strong>App Notifications</strong></h6>
                        </div>
                        <div class="align-self-center">
                            <label class="switch mb-0">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row pt-2  px-xl-5">
                <div class="col-12 fg_green-s">
                    <h4 class=""><strong>Other</strong></h4>
                </div>
            </div>
            <div class="row pt-2 pb-5 px-xl-5">
                <div class="col-12 my-3">
                    <a class="td_none-s" href="{{ route('termsAndConditions') }}">
                        <div class="d-flex bg_grey-s py-4 px-3 br_10px-s text-dark justify-content-between">
                            <div class="align-self-center">
                                <h6 class="mb-0"><strong>Terms & Conditions</strong></h6>
                            </div>
                            <div class="align-self-center">
                                <img src="{{ asset('assets/images/arrow_black.svg') }}" alt="">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 my-3">
                    <a class="td_none-s" href="{{ route('privacyPolicy') }}">
                        <div class="d-flex bg_grey-s py-4 px-3 br_10px-s text-dark justify-content-between">
                            <div class="align-self-center">
                                <h6 class="mb-0"><strong>Privacy Policy</strong></h6>
                            </div>
                            <div class="align-self-center">
                                <img src="{{ asset('assets/images/arrow_black.svg') }}" alt="">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 my-3">
                    <a class="td_none-s" href="{{ url('help') }}">
                        <div class="d-flex bg_grey-s py-4 px-3 br_10px-s text-dark justify-content-between">
                            <div class="align-self-center">
                                <h6 class="mb-0"><strong>Help</strong></h6>
                            </div>
                            <div class="align-self-center">
                                <img src="{{ asset('assets/images/arrow_black.svg') }}" alt="">
                            </div>
                        </div>
                    </a>
                </div>
                <div class=" col-12 my-3">
                    <a class="td_none-s" href="{{ route('aboutUs') }}">
                        <div class="d-flex bg_grey-s py-4 px-3 br_10px-s text-dark justify-content-between">
                            <div class="align-self-center">
                                <h6 class="mb-0"><strong>About Us</strong></h6>
                            </div>
                            <div class="align-self-center">
                                <img src="{{ asset('assets/images/arrow_black.svg') }}" alt="">
                            </div>
                        </div>
                    </a>
                </div>
                <div class=" col-12 my-3">
                    <a class="td_none-s" href="{{ route('payment') }}">
                        <div class="d-flex bg_grey-s py-4 px-3 br_10px-s text-dark justify-content-between">
                            <div class="align-self-center">
                                <h6 class="mb-0"><strong>Payment</strong></h6>
                            </div>
                            <div class="align-self-center">
                                <img src="{{ asset('assets/images/arrow_black.svg') }}" alt="">
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- container for favorite players - end -->
    </div>

    <!-- ---------------Modals for update phone number - start----------- -->


    <!-- Update Number Modal -->
    <div class="modal fade" id="update_phone_num_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row pt-4 modal-header border-0">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/phone_no..svg') }}" width="160" alt="update password">
                        </div>
                    </div>
                    <!--modal header end-->
                    <div class="row modal-body justify-content-center pt-3 pb-0">
                        <div class="col-12">
                            <div class="col-12 text-center">
                                <h4 class="fg_green-s">UPDATE PHONE NUMBER</h4>
                                <h6>Please enter phone number and password associated with your account and we’ll send a verification code to update your phone number</h6>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('updatePhoneNo') }}" method="post" id="frm_update_phone_number-d">
                        @csrf
                        <div class="row">
                            <div class="col-12 px-4">
                                    @csrf
                                    <div class="form-group pt-3">
                                        <label for="number-d" class=""><strong>PHONE NUMBER</strong></label>
                                        <input type="text" name="old_phone_number" placeholder="Enter your phone number" id="number-d" class="spinner_remove-s form-control rounded form-control-xl py-4 number-t" value="{{Auth::user()->phone_number ?? ''  }}" disabled>
                                        <input type="hidden" name="phone_number" value="{{Auth::user()->phone_number ?? ''  }}" >
                                    </div>
                                    <div class="form-group pt-3">
                                        <label for="current_password-d" class=""><strong>PASSWORD</strong></label>
                                        <input type="password" name="password" placeholder="Enter your password" id="current_password-d" class="form-control rounded form-control-xl py-4 current_Password-t">
                                    </div>
                            </div>
                        </div>
                        <div class="row pt-3 pb-5 px-2">
                            <!--CANCEL button-->
                            <div class="col-6 pr-2">
                                <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                            </div>
                            <!--CANCEL button end-->

                            <!--PROCEED button-->
                            <div class="col-6 pl-2">
                                <input type="hidden" name="" class="update_phone-d" value="">
                                <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white w-100"><strong>PROCEED</strong></button>
                            </div>

                            <!--PROCEED button end-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Update Number Modal end-->


    <!-- enter code Modal -->
    <div class="modal fade" id="num_verification_modal-d" >
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row pt-4 modal-header border-0">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/code.svg') }}" width="160" alt="verification code">
                        </div>
                    </div>
                    <!--modal header end-->
                    <div class="row modal-body justify-content-center pt-3 pb-0">
                        <div class="col-12">
                            <div class="col-12 text-center">
                                <h4 class="fg_green-s">VERIFICATION</h4>
                                <h6>Please enter the 4 digit verification code sent to <span>93********94</span></h6>
                            </div>
                        </div>
                    </div>

                    <div class="row px-md-3">
                        <div class="col-12 px-4">
                            <form action="">
                                <div class="d-flex text-center py-4 justify-content-between">
                                    <div class="p-3 code_border-s">
                                        <span class=""><strong><input type="number" class="code_input-s spinner_remove-s" id="code" name="code"></strong></span>
                                    </div>
                                    <div class="p-3 code_border-s">
                                        <span class="fs_30px-s"><strong><input type="number" class="code_input-s spinner_remove-s" id="code" name="code"></strong></span>
                                    </div>
                                    <div class="p-3 code_border-s">
                                        <span class="fs_30px-s"><strong><input type="number" class="code_input-s spinner_remove-s" id="code" name="code"></strong></span>
                                    </div>
                                    <div class="p-3 code_border-s">
                                        <span class="fs_30px-s"><strong><input type="number" class="code_input-s spinner_remove-s" id="code" name="code"></strong></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 py-3 text-center">
                            <a href="javascript:void(0)" class="text-dark"><u><strong>Resend Code</strong></u></a>
                        </div>
                    </div>
                    <div class="row pt-3  pb-5 px-2">
                        <!--CANCEL button-->
                        <div class="col-6 pr-2">
                            <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                        </div>
                        <!--CANCEL button end-->

                        <!--verify button-->
                        <div class="col-6 pl-2">
                            <input type="hidden" name="" id="update_password-d">
                            <input type="hidden" name="" id="update_email-d">
                            <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white w-100" id="switch_to_new_phone_modal-d"><strong>VERIFY</strong></button>
                        </div>
                        <!--verify button end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- enter code Modal end -->

    <!-- change Number Modal-->
    <div class="modal fade" id="new_num_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row pt-4 modal-header border-0">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/email.svg') }}" width="160" alt="update password">
                        </div>
                    </div>
                    <!--modal header end-->

                    <div class="row modal-body justify-content-center pt-3 pb-0">
                        <div class="col-12">
                            <div class="col-12 text-center">
                                <h4 class="fg_green-s">NEW PHONE NUMBER</h4>
                                <h6>Please enter phone number which you want to associate with your account</h6>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('updatePhoneNo') }}" method="post" id="update_new_phone_no-d">
                        @csrf
                        <div class="row">
                            <div class="col-12 px-4">
                                    <div class="form-group pt-3">
                                        <label for="new_number-d" class=""><strong>NEW PHONE NUMBER</strong></label>
                                        <input type="number" name="new_phone_number" placeholder="Enter your phone number" id="new_number-d" class="spinner_remove-s form-control rounded form-control-xl py-4 new_number-t">
                                    </div>
                                    <div class="form-group pt-3">
                                        <label for="password-d" class=""><strong>PASSWORD</strong></label>
                                        <input type="password" name="password" placeholder="Enter your password" id="password-d" class="form-control rounded form-control-xl py-4 password-t">
                                    </div>
                            </div>

                        </div>
                        <div class="row pt-3 pb-5 px-2">
                            <!--CANCEL button-->
                            <div class="col-6 pr-2">
                                <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                            </div>
                            <!--CANCEL button end-->

                            <!--UPDATE button-->
                            <div class="col-6 pl-2">
                                <input type="hidden" name="code_phone_no" id="code_phone_no-d" value="">
                                <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white w-100" id="phone_success_modal-d"><strong>UPDATE</strong></button>
                            </div>
                        <!--UPDATE button end-->
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- change Number  Modal end -->

    <!-- Success phone no. Modal -->
    <div class="modal fade" id="success_phone_num_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row pt-5 mt-3 modal-header border-0">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/success.svg') }}" width="160" alt="success">
                        </div>
                    </div>
                    <!--modal header end-->
                    <div class="row modal-body justify-content-center pt-4 pb-0">
                        <div class="col-12 mt-4">
                            <div class="col-12 text-center">
                                <h4 class="fg_green-s">VERIFIED!</h4>
                                <h5>Your phone number has been updated successfully</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-5 my-4 pb-4 px-2">
                        <!--OK button-->
                        <div class="col-12 ">
                            <a href="more.html">
                                <button type="button" class="btn bg_green-s br_10px-s py-3 text-white w-100"><strong>OK</strong></button>
                            </a>
                        </div>
                        <!--OK button end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Success phone no. Modal end-->


    <!-- -------------Modals for update phone number - end----------- -->

    <!-- --------------Modals for update email - start------------ -->

    <!-- Update email Modal -->
    <div class="modal fade" id="update_email_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row pt-4 modal-header border-0">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/email.svg') }}" width="160" alt="update password">
                        </div>
                    </div>
                    <!--modal header end-->
                    <div class="row modal-body justify-content-center pt-3 pb-0">
                        <div class="col-12">
                            <div class="col-12 text-center">
                                <h4 class="fg_green-s">UPDATE EMAIL ADDRESS</h4>
                                <h6>Please enter email and password associated with your account and we’ll send a verification code to update your email address</h6>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('updateEmail') }}" id="frm_update_email-d" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 px-4">
                                    <div class="form-group pt-3">
                                        <label for="email-d" class=""><strong>EMAIL</strong></label>
                                        <input type="email" name="update_email" placeholder="Enter your email" id="email-d" class="form-control rounded form-control-xl py-4 email-t" value="{{Auth::user()->email ?? ''}}" disabled>
                                        <input type="hidden" name="email"  value="{{Auth::user()->email ?? ''}}" >
                                    </div>
                                    <div class="form-group pt-3">
                                        <label for="current_password-d" class=""><strong>PASSWORD</strong></label>
                                        <input type="password" name="password" placeholder="Enter your password" id="current_password-d" class="form-control rounded form-control-xl py-4 current_Password-t">
                                    </div>
                            </div>
                        </div>
                        <div class="row pt-3 pb-5 px-2">
                            <!--CANCEL button-->
                            <div class="col-6 pr-2">
                                <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                            </div>
                            <!--CANCEL button end-->

                            <!--PROCEED button-->
                            <div class="col-6 pl-2">
                                <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white w-100" ><strong>PROCEED</strong></button>
                            </div>
                            <!--PROCEED button end-->
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Update email Modal end-->

    {{-- <!-- enter code Modal -->
    <div class="modal fade" id="email_verification_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row pt-4 modal-header border-0">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/code.svg') }}" width="160" alt="verification code">
                        </div>
                    </div>
                    <!--modal header end-->
                    <div class="row modal-body justify-content-center pt-3 pb-0">
                        <div class="col-12">
                            <div class="col-12 text-center">
                                <h4 class="fg_green-s">EMAIL VERIFICATION</h4>
                                <h6>Please enter the 4 digit code sent to <span>ahmadmd.23@gmail.com</span></h6>
                            </div>
                        </div>
                    </div>

                    <div class="row px-md-3">
                        <div class="col-12 px-4">
                            <form action="">
                                <div class="d-flex text-center py-4 justify-content-between">
                                    <div class=" p-3 code_border-s">
                                        <span class="fs_30px-s"><strong><input type="number" class="code_input-s spinner_remove-s" id="code" name="code"></strong></span>
                                    </div>
                                    <div class="  p-3 code_border-s">
                                        <span class="fs_30px-s"><strong><input type="number" class="code_input-s spinner_remove-s" id="code" name="code"></strong></span>
                                    </div>
                                    <div class=" p-3 code_border-s">
                                        <span class="fs_30px-s"><strong><input type="number" class="code_input-s spinner_remove-s" id="code" name="code"></strong></span>
                                    </div>
                                    <div class=" p-3 code_border-s">
                                        <span class="fs_30px-s"><strong><input type="number" class="code_input-s spinner_remove-s" id="code" name="code"></strong></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 py-3 text-center">
                            <a href="javascript:void(0)" class="text-dark"><u><strong>Resend Code</strong></u></a>
                        </div>
                    </div>
                    <div class="row pt-3 pb-5 px-2">
                        <!--CANCEL button-->
                        <div class="col-6 pr-2">
                            <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                        </div>
                        <!--CANCEL button end-->

                        <!--verify button-->
                        <div class="col-6 pl-2">
                            <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white w-100" id="switch_to_new_email_modal-d"><strong>VERIFY</strong></button>
                        </div>
                        <!--verify button end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- enter code Modal end --> --}}

    <!-- change email Modal-->
    <div class="modal fade" id="new_email_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row pt-4 modal-header border-0">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/email.svg') }}" width="160" alt="update password">
                        </div>
                    </div>
                    <!--modal header end-->
                    <div class="row modal-body justify-content-center pt-3 pb-0">
                        <div class="col-12">
                            <div class="col-12 text-center">
                                <h4 class="fg_green-s">NEW EMAIL ADDRESS</h4>
                                <h6>Please enter email address which you want to associate with your account</h6>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('createNewEmail') }}" id="frm_create_email-d" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 px-4">
                                    <div class="form-group pt-3">
                                        <label for="new_email-d" class=""><strong>NEW EMAIL ADDRESS</strong></label>
                                        <input type="email" name="email" placeholder="Enter your email" id="new_email-d" class="form-control rounded form-control-xl py-4 new_email-t">
                                    </div>
                                    <div class="form-group pt-3">
                                        <label for="password-d" class=""><strong>PASSWORD</strong></label>
                                        <input type="password" name="password" placeholder="Enter your password" id="password-d" class="form-control rounded form-control-xl py-4 password-t">
                                    </div>
                            </div>

                        </div>
                        <div class="row pt-3 pb-5 px-2">
                            <!--CANCEL button-->
                            <div class="col-6 pr-2">
                                <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                            </div>
                            <!--CANCEL button end-->

                            <!--UPDATE button-->
                            <div class="col-6 pl-2">
                                <input type="hidden" name="code_hdn_email" id="code_hdn_email-d" value="">

                                <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white w-100"><strong>UPDATE</strong></button>
                            </div>
                            <!--UPDATE button end-->
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- change email  Modal end -->

    <!-- Success email Modal -->
    <div class="modal fade" id="success_email_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row pt-5 mt-3 modal-header border-0">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/success.svg') }}" width="160" alt="success">
                        </div>
                    </div>
                    <!--modal header end-->
                    <div class="row modal-body justify-content-center pt-4 pb-0">
                        <div class="col-12 mt-4">
                            <div class="col-12 text-center">
                                <h4 class="fg_green-s">VERIFIED!</h4>
                                <h5>Your email has been updated successfully</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-5 my-4 pb-4 px-2">
                        <!--OK button-->
                        <div class="col-12 ">
                            <a href="more.html">
                                <button type="button" class="btn bg_green-s br_10px-s py-3 text-white w-100"><strong>OK</strong></button>
                            </a>
                        </div>
                        <!--OK button end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Success email Modal end-->

    <!-- --------------Modals for update email - end------------ -->

    <!-- --------------Modals for update password - start------------ -->

    <!-- Update password Modal -->
    <div class="modal fade" id="update_password_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row pt-4 modal-header border-0">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/update_password.svg') }}" width="160" alt="update password">
                        </div>
                    </div>
                    <!--modal header end-->
                    <div class="row modal-body justify-content-center pt-3 pb-0">
                        <div class="col-12">
                            <div class="col-12 text-center">
                                <h4 class="fg_green-s">UPDATE PASSWORD</h4>
                                <h5>Please enter email address associated with your account to recieve a verification code</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 px-4">
                            <form action="{{ route('updatePassword') }}" class="frm_update_password-d" method="post">
                                @csrf
                                <div class="form-group pt-3">
                                    <label for="email-d" class=""><strong>EMAIl</strong></label>
                                    <input type="email" name="email_d" placeholder="Enter your email" id="email-d" class="form-control rounded form-control-xl py-4 email-t" value="{{Auth::user()->email ?? ''}}" disabled>
                                    <input type="hidden" name="email"  value="{{Auth::user()->email ?? ''}}">
                                </div>
                        </div>
                        <div class="col-12 py-3 text-center">
                            {{-- <a href="javascript:void(0)" class="text-dark"><u><strong>Try another way</strong></u></a> --}}
                        </div>
                    </div>
                    <div class="row pt-3 pb-5 px-2">
                        <!--CANCEL button-->
                        <div class="col-6 pr-2">
                            <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                        </div>
                        <!--CANCEL button end-->

                        <!--SEND button-->
                        <div class="col-6 pl-2">
                            <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white w-100"><strong>SEND</strong></button>
                        </div>
                        <!--SEND button end-->
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Update password Modal end-->

    <!-- enter code Modal -->
    <div class="modal fade" id="password_verification_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row pt-4 modal-header border-0">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/code.svg') }}" width="160" alt="verification code">
                        </div>
                    </div>
                    <!--modal header end-->
                    <div class="row modal-body justify-content-center pt-3 pb-0">
                        <div class="col-12">
                            <div class="col-12 text-center">
                                <h4 class="fg_green-s">VERIFICATION</h4>
                                <h5>Please enter the 4 digit verification code sent to <span>{{ Auth::user()->email ?? '' }}</span></h5>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('validateCode') }}" id="frm_validate_password_code-d" class="frm_validate_code-d" method="post">
                        @csrf
                        <div class="row px-md-3">
                            <div class="col-12 px-4">
                                @csrf
                                    <div class="d-flex text-center py-4 justify-content-between">
                                        <div class="form-group p-3 code_border-s code_border-d">
                                            <!-- <span class="> -->
                                                <strong>
                                                    <input type="text" class="code_input-s fs_30px-s v_code-d v_code-s text-center mb-3"  name='number_box_1'  id='number_box_1' min='0' max="9" maxlength="1" placeholder="0"/>
                                                </strong>
                                            <!-- </span> -->
                                        </div>
                                        <div class="form-group  p-3 code_border-s code_border-d">
                                            <!-- <span class="fs_30px-s"> -->
                                                <strong>
                                                    <input  type="text"  class="code_input-s v_code-d v_code-s fs_30px-s text-center mb-3" name='number_box_2' id='number_box_2' min='0' max="9" maxlength="1"  placeholder="1"/>
                                                </strong>
                                            <!-- </span> -->
                                        </div>
                                        <div class="form-group p-3 code_border-s code_border-d">
                                            <!-- <span class="fs_30px-s"> -->
                                                <strong>
                                                    <input type="text" class="code_input-s v_code-d v_code-s fs_30px-s text-center mb-3"   name='number_box_3' id='number_box_3' min='0' max="9" maxlength="1"  placeholder="2"/>
                                                </strong>
                                            <!-- </span> -->
                                        </div>
                                        <div class="form-group p-3 code_border-s code_border-d">
                                            <!-- <span class="fs_30px-s"> -->
                                                <strong>
                                                    <input type="text" class="code_input-s v_code-d v_code-s fs_30px-s text-center mb-3 last-d" name='number_box_4' id='number_box_4' min='0' max="9" maxlength="1"   placeholder="3"/>
                                                </strong>
                                            <!-- </span> -->
                                        </div>
                                    </div>
                            </div>
                            <div class="col-12 py-3 text-center">
                                {{-- <a href="javascript:void(0)" class="text-dark"><u><strong>Resend Code</strong></u></a> --}}
                            </div>
                        </div>
                        <div class="row pt-3 pb-5 px-2">
                            <!--CANCEL button-->
                            <div class="col-6 pr-2">
                                <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                            </div>
                            <!--CANCEL button end-->
                            <!--verify button-->
                            <div class="col-6 pl-2">
                                <input type='hidden' name='activation_code' id='hdn_activation_code-d' />

                                <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white w-100" ><strong>VERIFY</strong></button>
                            </div>
                            <!--verify button end-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- enter code Modal end -->

    <!-- change password Modal-->
    <div class="modal fade" id="new_password_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row pt-4 modal-header border-0">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/update_password.svg') }}" width="160" alt="update password">
                        </div>
                    </div>
                    <!--modal header end-->
                    <div class="row modal-body justify-content-center pt-3 pb-0">
                        <div class="col-12">
                            <div class="col-12 text-center">
                                <h4 class="fg_green-s">CREATE NEW PASSWORD</h4>
                                <h5>Please enter email address associated with your account to recieve a verification code</h5>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('updateNewPassword') }}" id="frm_update_new_password-d" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 px-4">
                                    <div class="form-group pt-3">
                                        <label for="new_password-d" class=""><strong>CURRENT PASSWORD</strong></label>
                                        <input type="password" name="current_password" placeholder="Enter your password" id="current_password-d" class="form-control rounded form-control-xl py-4 new_Password-t">
                                    </div>
                                    <div class="form-group pt-3">
                                        <label for="new_password-d" class=""><strong>NEW PASSWORD</strong></label>
                                        <input type="password" name="new_password" placeholder="Enter your password" id="new_password-d" class="form-control rounded form-control-xl py-4 new_password-t">
                                    </div>
                            </div>

                        </div>
                        <div class="row pt-3 pb-5 px-2">
                            <!--CANCEL button-->
                            <div class="col-6 pr-2">
                                <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                            </div>
                            <!--CANCEL button end-->

                            <!--UPDATE button-->
                            <div class="col-6 pl-2">
                                <input type="hidden" name="code_hdn" id="code_hdn-d" value="">
                                <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white w-100" ><strong>UPDATE</strong></button>
                            </div>
                            <!--UPDATE button end-->
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- change password  Modal end -->

    <!-- Success password Modal -->
    <div class="modal fade" id="success_password_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="container-fluid">
                    <!--modal header-->
                    <div class="row pt-5 mt-3 modal-header border-0">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/images/success.svg') }}" width="160" alt="success">
                        </div>
                    </div>
                    <!--modal header end-->
                    <div class="row modal-body justify-content-center pt-4 pb-0">
                        <div class="col-12 mt-4">
                            <div class="col-12 text-center">
                                <h4 class="fg_green-s">VERIFIED!</h4>
                                <h5>Your password has been updated successfully</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-5 my-4 pb-4 px-2">
                        <!--OK button-->
                        <div class="col-12 ">
                            <a href="more.html">
                                <button type="button" class="btn bg_green-s br_10px-s py-3 text-white w-100"><strong>OK</strong></button>
                            </a>
                        </div>
                        <!--OK button end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Success password Modal end-->
    <!-- --------------Modals for update password - end------------ -->

    <!-- Update  bank detail  Modal -->

    <!-- Update bank detail Modal end-->

    <!-- .................More Page End ......................... -->
@endsection
