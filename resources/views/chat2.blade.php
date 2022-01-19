  @extends('layout.app')

    @section('content')

      <style>
        .opacity_23_per-s{
            opacity: 23%;
        }

        .close_upload_img-s{
            right: 17%;
        }

        .video_play_btn-s{
            top: 36%;
            cursor: pointer;
            width: 50px;
            right: 43%;
        }

        @media screen and (max-width:1440px) {
            .close_upload_img-s{
                right: 9%;
            }
            .video_play_btn-s{
                top: 36%;
                cursor: pointer;
                width: 50px;
                right: 39%;
            }
        }

        @media screen and (max-width:768px) {
            .close_upload_img-s{
                right: 19%;
            }
            .video_play_btn-s{
                top: 36%;
                cursor: pointer;
                width: 50px;
                right: 45%;
            }
        }
        @media screen and (max-width:425px) {
            .close_upload_img-s{
                right: 51%;
            }
            .video_play_btn-s{
                top: 36%;
                cursor: pointer;
                width: 50px;
                right: 67%;
            }
        }
        @media screen and (max-width:375px) {
            .close_upload_img-s{
                right: 45%;
            }
            .video_play_btn-s{
                top: 36%;
                cursor: pointer;
                width: 50px;
                right: 62%;
            }
        }
        @media screen and (max-width:320px) {
            .close_upload_img-s{
                right: 35%;
            }
            .video_play_btn-s{
                top: 36%;
                cursor: pointer;
                width: 50px;
                right: 56%;
            }
        }
    </style>


<body class="bg_img-s font_family_roboto-s">
    <!-- .................Home Page Start ......................... -->
    <div class="container-fluid px-0 mx-0 ">

        <!-- -------heading container - start -->
        <div class="container-fluid">
            <div class="row pb-4 pl-xl-5 mb-4">
                <div class="col-12 col-md-5 pt-4">
                    <h1 class=""><strong>Chat</strong></h1>
                    <h4 class="">Send messages to other players.</h4>
                </div>
                <div class="col-12 col-md-7 align-self-end pr-5">
                    <div class="row d-flex justify-content-center justify-content-md-end">

                        <div class="profile_img-s mx-3">
                            <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                        </div>

{{--
                        <div class="profile_img-s mx-3">
                            <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                        </div>


                        <div class="profile_img-s mx-3">
                            <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                        </div>


                        <div class="profile_img-s mx-3">
                            <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                        </div>  --}}

                    </div>
                </div>
            </div>
        </div>
        <!-- ------heading container - end -->

        <!-- container for chat - start -->
        <div class="container-fluid bg-white br_47px-s">
            <div class="row py-3 px-xl-5">
                <div class="col-12 min_h_340px-s">
                    <div class="row chat_module_parent">

                        <!-- ----- chat member list - start ----- -->
                        <div class=" col-xl-4 col-lg-4 col-md-12 col-12 chat_member_list_container-d d-lg-block border-0 h_580px-s">

                            <div class="row">
                                <div class="col-12 ml-xl-2 mt-xl-2 mb-xl-2">
                                    <h6 class="">Chats</h6>
                                </div>
                            </div>

                            <div class="row d-flex list_member_parent-d justify-content-center">
                                <div class="col-10 col-lg-11 br_10px-s my-2 br_on_active-s br_on_hover-s chat_parent" data-parent-chat='chat_1'>
                                    <div class="row border br_10px-s py-1 bg-greenish_grey-s">
                                        <div class="col-3 col-md-3 col-lg-3 col-xl-3 align-self-center pl-lg-2 pl-xl-3 pl-1 pl-md-5">
                                            <div class="profile_img-s">
                                                <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6 col-lg-6 col-xl-6 px-0">
                                            <div class="row">
                                                <div class="col-12 px-0">
                                                    <strong class="ft_17px-s fg_green-s">Thamer</strong>
                                                </div>
                                                <div class="col-12 px-0">
                                                    <strong class="fg_lightgrey_s">@Thamermd</strong>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 ft_size_12px-s px-0 mt-2">
                                                    <p>Everyone is waiting.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                                            <div class="mt-3 ft_size_12px-s text-center">
                                                <span>2 Hours</span>
                                            </div>
                                            <div class="message_count-s text-center ml-xl-4 ml-lg-3 ml-md-5">
                                                <p class="fg_white-s mt-3 pt-2 ft_11px-s">12</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>


                        </div>
                        <!-- ----- chat member list - end ----- -->

                        <!-- ----- chat room - start ----- -->
                        <div class="d-none d-lg-block col-12 col-md-12 col-lg-8 mt-4 mt-md-0 col-xl-8 border border-top-0 w-100 chat" id='chat_1'>

                            <!-- profile detail of next person in chat - start -->
                            <div class="row">
                                <div class="col-12 border-bottom">
                                    <div class="row">
                                        <div class="col-10 d-flex">
                                            <div class="align-self-center mr-3">
                                                <a href="" class="chat_back_to_list-d">
                                                    <img src="assets/images/back_arrow.svg" width="18" alt="" />
                                                </a>
                                            </div>
                                            <div class="profile_img-s d-flex justify-content-between">
                                                <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                            </div>
                                            <div class="ml-3 align-self-center">
                                                <strong class="ft_17px-s fg_green-s">Thamer</strong>
                                                <p class="fg_darkgrey_s fs_12px-s">@Thamermd</p>
                                            </div>
                                        </div>
                                        <div class="col-2 text-right align-self-center">
                                            <a href="javascript:void(0)">
                                                <img class="mr-4" src="assets/images/delete_icon.svg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- profile detail of next person in chat - end -->

                            <!-- chat room -start -->
                            <div class="row h_450px-s">
                                <div class="col">

                                    <!-- timeline of chat -->
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center fs_12px-s mt-3">
                                            <span class=""> Today <span>01/01/21</span> </span>
                                        </div>
                                    </div>
                                    <!-- timeline of chat -->

                                    <!-- next person in chat -->

                                    <div class="row py-3">
                                        <div class="mx-2 align-self-end">
                                            <div class="profile_img_in_chat-s">
                                                <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-5 col-lg-6 col-xl-5 ml-md-0 ml-4 py-2 br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar
                                            </p>
                                        </div>
                                        <div class="col-xl-6 col-lg-5 px-0 align-self-end text-right">
                                            <div class="dropdown">
                                                <a type="" class="text-dark" role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <div>
                                                        <a class="ml-4" href="#">
                                                            <img class="mr-4 w_chat_read_icon-s" src="assets/images/delete_icon.svg" alt="">
                                                            <span>Delete</span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a class="ml-4" href="#">
                                                            <img class="mr-4 w_chat_read_icon-s" src="assets/images/chat_reply_icon.svg" alt="">
                                                            <span>Reply</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-8 mx-5 px-0">
                                            <span class="ft_11px-s"> 12:43 PM | <span class="fg_green-s">S</span></span>
                                        </div>
                                    </div>
                                    <!-- next person in chat -->

                                    <!-- first person in chat -->

                                    <div class="row py-3 justify-content-end">
                                        <div class="col-7 col-xl-5 col-lg-6 col-md-5 py-2 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar
                                            </p>
                                        </div>
                                        <div class="ml-2 mr-3 align-self-end">
                                            <div class="profile_img_in_chat-s">
                                                <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                            </div>
                                        </div>

                                        <div class="col-12 mr-xl-5 mr-lg-5 text-right">
                                            <span class="ft_11px-s"> 12:43 AM | <span class="fg_green-s">R</span></span>
                                        </div>
                                    </div>
                                    <!-- first person in chat -->
                                    <!-- next person in chat -->


                                    <div class="row py-3">
                                        <div class="mx-2 align-self-end">
                                            <div class="profile_img_in_chat-s">
                                                <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-5 col-lg-6 col-xl-5 ml-md-0 ml-4 py-2 br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar
                                            </p>
                                        </div>
                                        <div class="col-xl-6 col-lg-5 px-0 align-self-end text-right">
                                            <div class="dropdown">
                                                <a type="" class="text-dark" role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <div>
                                                        <a class="ml-4" href="#">
                                                            <img class="mr-4 w_chat_read_icon-s" src="assets/images/delete_icon.svg" alt="">
                                                            <span>Delete</span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a class="ml-4" href="#">
                                                            <img class="mr-4 w_chat_read_icon-s" src="assets/images/chat_reply_icon.svg" alt="">
                                                            <span>Reply</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-8 mx-5 px-0">
                                            <span class="ft_11px-s"> 12:43 PM | <span class="fg_green-s">S</span></span>
                                        </div>
                                    </div>
                                    <!-- next person in chat -->

                                    <!-- first person in chat -->

                                    <div class="row py-3 justify-content-end">
                                        <div class="col-7 col-xl-5 col-lg-6 col-md-5 py-2 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                            <div class="row">
                                                <div class="col px-3 mx-3 mt-2 pt-2 bg-white br_5px-s">
                                                    <strong class="ft_14px-s fg_green-s">Thamer</strong><span class="text-dark float-right">12:15 PM</span>
                                                    <p class="text-dark">Lorem ipsum dolor sit ametrem ipsum dolor sit ametrem ipsum dolor sit ametv </p>
                                                </div>
                                            </div>
                                            <p class="mt-2">Lorem ipsum dolor sit amet,
                                            </p>
                                        </div>
                                        <div class="ml-2 mr-3 align-self-end">
                                            <div class="profile_img_in_chat-s">
                                                <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                            </div>
                                        </div>

                                        <div class="col-12 mr-xl-5 mr-lg-5 text-right">
                                            <span class="ft_11px-s"> 12:43 PM | <span class="fg_green-s">R</span></span>
                                        </div>
                                    </div>
                                    <!-- first person in chat -->

                                    <!-- chat room - end -->
                                </div>
                            </div>
                            <!-- chat input - start -->
                            <div class="row mt-4 py-2  shadow br_10px-s">
                                <!--reply text area-->
                                <div class="col-12 d-flex">
                                    <div class="bg_grey-s mx-3 w-100 py-3 fs_12px-s mt-3 mb-2 br_10px-s pl-3">
                                        <h6 class="fg_green-s  mb-0"><strong>Thamer</strong></h6>
                                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar</p>
                                    </div>
                                    <span>
                                        <img src="assets/images/close-dark.svg" alt="" class="ml-3 mr-4 mt-3 opacity_23_per-s close_reply_text-d" width="15">
                                    </span>
                                </div>
                                <!--reply text area end-->

                                <!--upload img -->
                                <div class="col-xl-3 col-lg-4 col-md-4 col-12  my-2" >
                                    <img src="assets/images/close-dark.svg" class="position-absolute mt-2 close_upload_img-s close_upload_img-d" width="15" alt="close img">
                                    <div>
                                        <img src="assets/images/images.jpg" width="200" height="200" class="br_10px-s" alt="uplaod img" data-toggle="modal" data-target="#show_upload_img-d">
                                    </div>
                                </div>
                                <!--upload img end-->

                                <!--upload video-->
                                <div class="col-xl-3 col-lg-4 col-md-4 col-12  my-2">
                                    <img src="assets/images/close-dark.svg" class="position-absolute mt-2 close_upload_img-s close_upload_img-d" width="15" alt="close img">
                                    <div>
                                        <img src="assets/images/images.jpg" width="200" height="200" class="br_10px-s" alt="uplaod img">
                                        <img src="assets/images/video_play_btn.svg" class="position-absolute video_play_btn-s" alt="video play btn"  data-toggle="modal" data-target="#video_modal-d">
                                    </div>
                                </div>
                                <!--upload video end-->

                                <!--msg type area-->
                                <div class="col-12 input-group word-break word-wrap">
                                    <span class="input-group-text bg-white border-0 br_right_10px-s opacity_4-s ml-2">
                                        <a href="" role="button" data-toggle="modal" data-target="#upload_img_modal-d"> <img class="" src="assets/images/file.svg" width="18" alt=""></a>
                                    </span>
                                    <textarea type="textarea" name="message" placeholder="Type your message....." class="form-control textarea_h_w-s br_left_10px-s ft_17px-s border-0" id="simple-chat-message"></textarea>
                                    <!-- <a class="" href="javascript:void(0)"><img src="assets/images/chat_send_icon.svg" alt=""></a> -->
                                    <span class="input-group-text bg-white border-0 br_right_10px-s"><img class="" src="assets/images/chat_send_icon.svg" alt=""></span>
                                </div>
                                <!--msg type area end-->
                            </div>
                            <!-- chat input - end -->
                        </div>
                        <!-- ----- chat room - end ----- -->
                        <!-- ----- chat room - start ----- -->
                        <div class="d-none col-12 col-md-12 col-lg-8 col-xl-8 mt-4 mt-md-0 border border-top-0 w-100 chat" id='chat_2'>

                            <!-- profile detail of next person in chat - start -->
                            <div class="row">
                                <div class="col-12 border-bottom">
                                    <div class="row">
                                        <div class="col-10 d-flex">
                                            <div class="align-self-center mr-3">
                                                <a href="" class="chat_back_to_list-d">
                                                    <img src="assets/images/back_arrow.svg" width="18" alt="" />
                                                </a>
                                            </div>
                                            <div class="profile_img-s d-flex justify-content-between">
                                                <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                            </div>
                                            <div class="ml-3 align-self-center">
                                                <strong class="ft_17px-s fg_green-s">Thamer2</strong>
                                                <p class="fg_darkgrey_s fs_12px-s">@Thamermd</p>
                                            </div>
                                        </div>
                                        <div class="col-2 text-right align-self-center">
                                            <a href="javascript:void(0)">
                                                <img class="mr-4" src="assets/images/delete_icon.svg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- profile detail of next person in chat - end -->

                            <!-- chat room -start -->
                            <div class="row h_450px-s">
                                <div class="col">

                                    <!-- timeline of chat -->
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center fs_12px-s mt-3">
                                            <span class=""> Today <span>01/01/21</span> </span>
                                        </div>
                                    </div>
                                    <!-- timeline of chat -->

                                    <!-- next person in chat -->

                                    <div class="row py-3">
                                        <div class="mx-1 align-self-end">
                                            <div class="profile_img_in_chat-s">
                                                <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-5 col-lg-6 col-xl-5 ml-md-0 ml-4 py-2 br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar
                                            </p>
                                        </div>
                                        <div class="col-xl-6 col-lg-5 px-0 align-self-end text-right">
                                            <div class="dropdown">
                                                <a type="" class="text-dark" role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <div>
                                                        <a class="ml-4" href="#">
                                                            <img class="mr-4 w_chat_read_icon-s" src="assets/images/delete_icon.svg" alt="">
                                                            <span>Delete</span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a class="ml-4" href="#">
                                                            <img class="mr-4 w_chat_read_icon-s" src="assets/images/chat_reply_icon.svg" alt="">
                                                            <span>Reply</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-8 mx-5 px-0">
                                            <span class="ft_11px-s"> 12:43 PM | <span class="fg_green-s">R</span></span>
                                        </div>
                                    </div>
                                    <!-- next person in chat -->

                                    <!-- first person in chat -->

                                    <div class="row py-3 justify-content-end">
                                        <div class="col-7 col-xl-5 col-lg-6 col-md-5 py-2 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar
                                            </p>
                                        </div>
                                        <div class="ml-2 mr-3 align-self-end">
                                            <div class="profile_img_in_chat-s">
                                                <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                            </div>
                                        </div>

                                        <div class="col-12 mr-xl-5 mr-lg-5 text-right">
                                            <span class="ft_11px-s"> 12:43 AM | <span class="fg_green-s">R</span></span>
                                        </div>
                                    </div>
                                    <!-- first person in chat -->
                                    <!-- next person in chat -->


                                    <div class="row py-3">
                                        <div class="mx-2 align-self-end">
                                            <div class="profile_img_in_chat-s">
                                                <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-5 col-lg-6 col-xl-5 ml-md-0 ml-4 py-2 br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar
                                            </p>
                                        </div>
                                        <div class="col-xl-6 col-lg-5 px-0 align-self-end text-right">
                                            <div class="dropdown">
                                                <a type="" class="text-dark" role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <div>
                                                        <a class="ml-4" href="#">
                                                            <img class="mr-4 w_chat_read_icon-s" src="assets/images/delete_icon.svg" alt="">
                                                            <span>Delete</span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a class="ml-4" href="#">
                                                            <img class="mr-4 w_chat_read_icon-s" src="assets/images/chat_reply_icon.svg" alt="">
                                                            <span>Reply</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-8 mx-5 px-0">
                                            <span class="ft_11px-s"> 12:43 PM | <span class="fg_green-s">R</span></span>
                                        </div>
                                    </div>
                                    <!-- next person in chat -->

                                    <!-- first person in chat -->

                                    <div class="row py-3 justify-content-end">
                                        <div class="col-7 col-xl-5 col-lg-6 col-md-5 py-2 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                            <div class="row">
                                                <div class="col px-3 mx-3 mt-2 pt-2 bg-white br_5px-s">
                                                    <strong class="ft_14px-s fg_green-s">Thamer</strong><span class="text-dark float-right">12:15 PM</span>
                                                    <p class="text-dark">Lorem ipsum dolor sit ametrem ipsum dolor sit ametrem ipsum dolor sit ametv </p>
                                                </div>
                                            </div>
                                            <p class="mt-2">Lorem ipsum dolor sit amet,
                                            </p>
                                        </div>
                                        <div class="ml-2 mr-3 align-self-end">
                                            <div class="profile_img_in_chat-s">
                                                <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                            </div>
                                        </div>

                                        <div class="col-12 mr-xl-5 mr-lg-5 text-right">
                                            <span class="ft_11px-s"> 12:43 PM | <span class="fg_green-s">R</span></span>
                                        </div>
                                    </div>
                                    <!-- first person in chat -->
                                    <!-- chat room - end -->
                                </div>
                            </div>
                            <!-- chat input - start -->
                            <div class="input-group word-break word-wrap mt-4 py-2  shadow br_10px-s">
                                <span class="input-group-text bg-white border-0 br_right_10px-s opacity_4-s ml-2">
                                    <a href="" role="button" data-toggle="modal" data-target="#upload_img_modal-d"> <img class="" src="assets/images/file.svg" width="18" alt=""></a>
                                </span> <textarea type="textarea" name="message" placeholder="Type your message....." class="form-control textarea_h_w-s br_left_10px-s ft_17px-s border-0" id="simple-chat-message"></textarea>
                                <!-- <a class="" href="javascript:void(0)"><img src="assets/images/chat_send_icon.svg" alt=""></a> -->
                                <span class="input-group-text bg-white border-0 br_right_10px-s"><img class="" src="assets/images/chat_send_icon.svg" alt=""></span>
                            </div>
                            <!-- chat input - end -->
                        </div>
                        <!-- ----- chat room - end ----- -->
                        <!-- ----- chat room - start ----- -->
                        <div class="d-none col-12 col-md-12 col-lg-8 col-xl-8 mt-4 mt-md-0 border border-top-0 w-100 chat" id='chat_3'>

                            <!-- profile detail of next person in chat - start -->
                            <div class="row">
                                <div class="col-12 border-bottom">
                                    <div class="row">
                                        <div class="col-10 d-flex">
                                            <div class="align-self-center mr-3">
                                                <a href="" class="chat_back_to_list-d" id="">
                                                    <img src="assets/images/back_arrow.svg" width="18" alt="" />
                                                </a>
                                            </div>
                                            <div class="profile_img-s d-flex justify-content-between">
                                                <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                            </div>
                                            <div class="ml-3 align-self-center">
                                                <strong class="ft_17px-s fg_green-s">Thamer3</strong>
                                                <p class="fg_darkgrey_s fs_12px-s">@Thamermd</p>
                                            </div>
                                        </div>
                                        <div class="col-2 text-right align-self-center">
                                            <a href="javascript:void(0)">
                                                <img class="mr-4" src="assets/images/delete_icon.svg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- profile detail of next person in chat - end -->

                            <!-- chat room -start -->
                            <div class="row h_450px-s">
                                <div class="col">

                                    <!-- timeline of chat -->
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center fs_12px-s mt-3">
                                            <span class=""> Today <span>01/01/21</span> </span>
                                        </div>
                                    </div>
                                    <!-- timeline of chat -->

                                    <!-- next person in chat -->

                                    <div class="row py-3">
                                        <div class="mx-2 align-self-end">
                                            <div class="profile_img_in_chat-s">
                                                <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-5 col-lg-6 col-xl-5 ml-md-0 ml-4 py-2 br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar
                                            </p>
                                        </div>
                                        <div class="col-xl-6 col-lg-5 px-0 align-self-end text-right">
                                            <div class="dropdown">
                                                <a type="" class="text-dark" role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <div>
                                                        <a class="ml-4" href="#">
                                                            <img class="mr-4 w_chat_read_icon-s" src="assets/images/delete_icon.svg" alt="">
                                                            <span>Delete</span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a class="ml-4" href="#">
                                                            <img class="mr-4 w_chat_read_icon-s" src="assets/images/chat_reply_icon.svg" alt="">
                                                            <span>Reply</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-8 mx-5 px-0">
                                            <span class="ft_11px-s"> 12:43 PM | <span class="fg_green-s">R</span></span>
                                        </div>
                                    </div>
                                    <!-- next person in chat -->

                                    <!-- first person in chat -->

                                    <div class="row py-3 justify-content-end">
                                        <div class="col-7 col-xl-5 col-lg-6 col-md-5 py-2 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar
                                            </p>
                                        </div>
                                        <div class="ml-2 mr-3 align-self-end">
                                            <div class="profile_img_in_chat-s">
                                                <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                            </div>
                                        </div>

                                        <div class="col-12 mr-xl-5 mr-lg-5 text-right">
                                            <span class="ft_11px-s"> 12:43 AM | <span class="fg_green-s">R</span></span>
                                        </div>
                                    </div>
                                    <!-- first person in chat -->
                                    <!-- next person in chat -->


                                    <div class="row py-3">
                                        <div class="mx-2 align-self-end">
                                            <div class="profile_img_in_chat-s">
                                                <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-5 col-lg-6 col-xl-5 ml-md-0 ml-4 py-2 br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar
                                            </p>
                                        </div>
                                        <div class="col-xl-6 col-lg-5 px-0 align-self-end text-right">
                                            <div class="dropdown">
                                                <a type="" class="text-dark" role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <div>
                                                        <a class="ml-4" href="#">
                                                            <img class="mr-4 w_chat_read_icon-s" src="assets/images/delete_icon.svg" alt="">
                                                            <span>Delete</span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a class="ml-4" href="#">
                                                            <img class="mr-4 w_chat_read_icon-s" src="assets/images/chat_reply_icon.svg" alt="">
                                                            <span>Reply</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-8 mx-5 px-0">
                                            <span class="ft_11px-s"> 12:43 PM | <span class="fg_green-s">S</span></span>
                                        </div>
                                    </div>
                                    <!-- next person in chat -->

                                    <!-- first person in chat -->

                                    <div class="row py-3 justify-content-end">
                                        <div class="col-7 col-xl-5 col-lg-6 col-md-5 py-2 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                            <div class="row">
                                                <div class="col px-3 mx-3 mt-2 pt-2 bg-white br_5px-s">
                                                    <strong class="ft_14px-s fg_green-s">Thamer</strong><span class="text-dark float-right">12:15 PM</span>
                                                    <p class="text-dark">Lorem ipsum dolor sit ametrem ipsum dolor sit ametrem ipsum dolor sit ametv </p>
                                                </div>
                                            </div>
                                            <p class="mt-2">Lorem ipsum dolor sit amet,
                                            </p>
                                        </div>
                                        <div class="ml-2 mr-3 align-self-end">
                                            <div class="profile_img_in_chat-s">
                                                <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                            </div>
                                        </div>

                                        <div class="col-12 mr-xl-5 mr-lg-5 text-right">
                                            <span class="ft_11px-s"> 12:43 PM | <span class="fg_green-s">R</span></span>
                                        </div>
                                    </div>
                                    <!-- first person in chat -->
                                    <!-- chat room - end -->
                                </div>
                            </div>
                            <!-- chat input - start -->
                            <div class="input-group word-break word-wrap mt-4 py-2  shadow br_10px-s">
                                <span class="input-group-text bg-white border-0 br_right_10px-s opacity_4-s ml-2">
                                    <a href="" role="button" data-toggle="modal" data-target="#upload_img_modal-d"> <img class="" src="assets/images/file.svg" width="18" alt=""></a>
                                </span> <textarea type="textarea" name="message" placeholder="Type your message....." class="form-control textarea_h_w-s br_left_10px-s ft_17px-s border-0" id="simple-chat-message"></textarea>
                                <!-- <a class="" href="javascript:void(0)"><img src="assets/images/chat_send_icon.svg" alt=""></a> -->
                                <span class="input-group-text bg-white border-0 br_right_10px-s"><img class="" src="assets/images/chat_send_icon.svg" alt=""></span>
                            </div>
                            <!-- chat input - end -->
                        </div>
                        <!-- ----- chat room - end ----- -->





                    </div>
                </div>
            </div>
        </div>
        <!-- container for chat - end -->
    </div>
    <!-- .................Home Page End ......................... -->

    <!--show uplaod img-->
    <div class="modal fade" id="show_upload_img-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="modal-header pb-0 border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="assets/images/close-dark.svg" class="" width="15" alt="close img">
                      </button>
                </div>
                <div class="container-fluid">
                    <div class="modal-body">
                        <img src="assets/images/images.jpg" class="w-100" height="100%" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---show upload img modal end-->

    <!--Video Modal-->
    <div class="modal fade" id="video_modal-d"  tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content br_10px-s border-0">
                <div class="modal-header pb-0 border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="assets/images/close-dark.svg" class="" width="15" alt="close img">
                      </button>
                </div>
                <div class="container-fluid">
                <!-- Modal body -->
                    <div class="modal-body ">
                        <video width="100%" controls>
                            <source id="video_stop-d" src="assets/images/videofile.mp4" type="video/mp4" >
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--Video Modal End-->

    <!-- upload file modal  -->
    <!-- Modal -->
    <div class="modal fade" id="upload_img_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content br_10px-s border-0">
                <div class="modal-header bg_grey-s border-0 br_up_left_right_10px-s">
                    <h5 class="modal-title px-3  text-dark" id="view-head"><strong>Upload</strong></h5>
                </div>
                <div class="container-fluid">
                    <div class="modal-body">

                        <form action="">
                            <div class="row pb-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="caption-d"><Strong>CAPTION</Strong></label>
                                        <textarea class="form-control resize_none-s rounded" id="caption-d" placeholder="write here" rows="1"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <h6><strong>PHOTO/VIDEO</strong></h6>
                                    <div class="w-100 ">
                                        <img src="assets/images/upload_img.svg" class="w_inherit-s" alt="upload img">
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <img src="assets/images/close.svg" class="remove_img-s position-absolute" alt="remove img">
                                    <div class="">
                                        <img src="assets/images/picture.jpg" class="upload_pic-s" alt="uplaod img">
                                    </div>
                                </div>
                            </div>

                        </form>
                        <div class="row py-3">
                            <div class="col-12 d-flex justify-content-center">
                                <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 px-3 px-md-5 mr-md-2 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                                <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white px-3 px-md-5 ml-2 w-100" data-dismiss="modal"><strong>UPLOAD</strong></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.close_upload_img-d').on('click', function(e) {
            elm=$(this);
            elm.parent().remove();

        })
        $(".close_reply_text-d").on('click', function(e) {
            elm = $(this);
            elm.parent().parent().remove();
        })
    </script>

    @endsection
