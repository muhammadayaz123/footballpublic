    @extends('layout.app')

    @section('content')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

        <style>
            .profile_chat_img-d{
                height: 64px;
                border: 3px solid green;
                border-radius: 50%;
                width: 64px;
            }
            .opacity_23_per-s {
                opacity: 23%;
            }

            .close_upload_img-s {
                right: -11%;
            }

            .video_play_btn-s {
                top: 36%;
                cursor: pointer;
                width: 50px;
                right: 43%;
            }

            @media screen and (max-width:1440px) {
                .close_upload_img-s {
                    right: -10%;
                }

                .video_play_btn-s {
                    top: 36%;
                    cursor: pointer;
                    width: 50px;
                    right: 39%;
                }
            }

            @media screen and (max-width:768px) {
                .close_upload_img-s {
                    right: 4%;
                }

                .video_play_btn-s {
                    top: 36%;
                    cursor: pointer;
                    width: 50px;
                    right: 45%;
                }
            }

            @media screen and (max-width:425px) {
                .close_upload_img-s {
                    right: 39%;
                }

                .video_play_btn-s {
                    top: 36%;
                    cursor: pointer;
                    width: 50px;
                    right: 67%;
                }
            }

            @media screen and (max-width:375px) {
                .close_upload_img-s {
                    right: 30%;
                }

                .video_play_btn-s {
                    top: 36%;
                    cursor: pointer;
                    width: 50px;
                    right: 62%;
                }
            }

            @media screen and (max-width:320px) {
                .close_upload_img-s {
                    right: 17%;
                }

                .video_play_btn-s {
                    top: 36%;
                    cursor: pointer;
                    width: 50px;
                    right: 56%;
                }
            }

        </style>
        <!-- .................chat Page Start ......................... -->
        <div class="container-fluid px-0 mx-0 ">
            <!-- -------heading container - start -->
            <div id="loader" class='loader_container-s align-self-center d-none w-100 justify-content-center' style="">
                <img class='align-self-center' width='200' height="200" src="{{ asset('assets/images/logo_gif.gif') }}">
            </div>
            <div class="container-fluid">
                <div class="row pb-4 pl-xl-5 mb-4">
                    <div class="col-12 col-md-5 pt-4">
                        <h1 class=""><strong>Chat</strong></h1>
                        <h4 class="">Send messages to other players.</h4>
                    </div>
                    <div class="col-12 col-md-7 align-self-end pr-5">
                        <div class="row d-flex justify-content-center justify-content-md-end">
                            {{-- @if (isset($existingChat) && null !== $existingChat && [] !== $existingChat) --}}
                            {{-- @foreach ($existingChat as $key => $chats)
                            @if (count($chats->messages) > 0)
                                @if ($key < 5)
                                    @foreach ($chats->members as $single_member)
                                        @if (Auth::user()->profile->id != $single_member->member_id)
                                            <div class="profile_img-s mx-3">
                                                <img class="img_set_to_div-s" src="{{ asset($single_member->user->profile_image) ?? asset('assets/images/picture.jpg') }}" alt="">
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                            @endforeach --}}
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- ------heading container - end -->

            {{-- {{ dd($existingChat) }} --}}

            <!-- container for chat - start -->
            <div class="container-fluid bg-white br_47px-s">
                <div class="row pl-xl-5">
                    <div class="col-12 min_h_340px-s">
                        <div class="row chat_module_parent">


                            <!-- ----- chat member list - start ----- -->
                            <div
                                class=" col-xl-4 col-lg-4 col-md-12 col-12 mt-3 chat_member_list_container-d d-lg-block border-0 h_580px-s existing_chat_container-d">

                                <div class="row">
                                    <div class="col-12 ml-xl-2 mt-xl-2 mb-xl-2">
                                        <h6 class="">Chats</h6>
                                    </div>
                                </div>


                                @if (isset($existingChat) && null !== $existingChat && [] !== $existingChat)
                                    {{--  {{ dd($existingChat) }}  --}}
                                    <div class="row d-flex list_member_parent-d justify-content-center "
                                        id="existing_chat_container-d">
                                        @foreach ($existingChat as $key => $chats)
                                            {{-- {{ dd($existingChat, $chats, $chats->members) }} --}}
                                            @php
                                                // $unread_count = $chats->members[0]->unread_count;
                                                // $unread_count2 = $chats->members[1]->unread_count;
                                            @endphp
                                            @foreach ($chats->members as $single_member)
                                                {{-- {{ dd($single_member, $chats->members, Auth::user()->profile->id == $single_member->member_id) }} --}}
                                                @if (Auth::user()->profile->id == $single_member->member_id)
                                                    @php
                                                        // dd($single_member);
                                                        $unread_count = (int) $single_member->unread_count;
                                                        // $unread_count2 = (int)$single_member->unread_count;

                                                        //  dd($unread_count, Auth::user()->profile->id == $single_member->member_id );
                                                    @endphp

                                                @endif
                                                {{-- {{ dd($unread_count, $unread_count2)}} --}}

                                                @if (Auth::user()->profile->id != $single_member->member_id)
                                                    {{--  {{ dd($single_member) }}  --}}
                                                    @if ($key == 0)
                                                        <div
                                                            class="col-10 col-lg-11 br_10px-s my-2 br_on_active-s  br_on_hover-s chat_parent single_chat_user-d chat_single_user-d{{ $chats->uuid }}  chat_single_user-d2{{ $single_member->uuid }}">

                                                                    {{-- @else
                                                                <div class="col-10 col-lg-11 br_10px-s my-2  br_on_hover-s chat_parent single_chat_user-d" >
                                                            @endif --}}
                                                            {{-- @dd($unread_count2) --}}
                                                            {{-- @if (isset($unread_count) && $unread_count != 0) --}}
                                                            @if ($single_member->unread_count != 0)
                                                                <div
                                                                    class="message_count-s text-center ml-xl-4 ml-lg-3 ml-md-5 position-absolute unread_count-d show_unread_count-d2">

                                                                    <p class="fg_white-s pt-2 ft_11px-s">
                                                                        {{ $single_member->unread_count }}</p>

                                                                </div>
                                                            @else
                                                                <div class="message_count-s text-center ml-xl-4 ml-lg-3 ml-md-5 position-absolute unread_count-d show_unread_count_div-d d-none">

                                                                    <p class="fg_white-s pt-2 ft_11px-s show_unread_count-d">

                                                                </div>
                                                            @endif
                                                            <div class="row border br_10px-s py-2 bg-greenish_grey-s d-flex align-items-center">
                                                                <div
                                                                    class="col-3 col-md-3 col-lg-3 col-xl-3 align-self-center pl-lg-2 pl-xl-3 pl-1 pl-md-5">
                                                                    <div class="profile_chat_img-d">
                                                                        <a href="{{ route('othersProfile', [$single_member->user->user->uuid, $single_member->user->uuid, $single_member->user->id]) }}"
                                                                            class="td_none-s">
                                                                            <img class="img_set_to_div-s get_user_chat_image-d"
                                                                                src="{{ asset($single_member->user->profile_image) ?? asset('assets/images/picture.jpg') }}"
                                                                                alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 col-md-6 col-lg-6 col-xl-6 px-0 pl-xl-2  chat-box-updation">
                                                                    <div class="row">
                                                                        <div class="col-12 px-0">
                                                                            <a href="{{ route('othersProfile', [$single_member->user->user->uuid, $single_member->user->uuid, $single_member->user->id]) }}"
                                                                                class="td_none-s">
                                                                                <strong
                                                                                    class="ft_17px-s fg_green-s get_user_chat_name-d">{{ $single_member->user->first_name }}
                                                                                    {{ $single_member->user->last_name }}</strong>
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-12 px-0">
                                                                            <strong class="text-black opacity_4-s get_user_chat_username-d">@<span>{{ $single_member->user->username }}</span></strong>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12 ft_size_12px-s px-0 mt-2 last_message-d">
                                                                            @foreach ($chats->messages as $message)
                                                                                @if ($loop->last)
                                                                                    <p>
                                                                                        {{-- {{ $message->message }} --}}
                                                                                        {{ \Illuminate\Support\Str::limit($message->message ?? 'sent image', 15, $end='...') }}
                                                                                    </p>
                                                                                @endif

                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                                                                    <div
                                                                        class="mt-3 ft_size_12px-s text-black  text-center">
                                                                        <span><strong>
                                                                                @if ($chats->messages)

                                                                                    @foreach ($chats->messages as $message)
                                                                                        @if ($loop->last)
                                                                                            <p  class="last_message_time-d"> {{ \Carbon\Carbon::parse($message->local_created_at)->format(' g:i A') ?? '' }}
                                                                                            {{-- <p  class="last_message_time-d"> {{ \Carbon\Carbon::parse($message->local_created_at)->diffForHumans() ?? '' }} --}}
                                                                                            </p>

                                                                                        @endif

                                                                                    @endforeach
                                                                                @else
                                                                                            <p class="last_message_time-d"> </p>
                                                                                @endif
                                                                        </span></strong>
                                                                    </div>
                                                                    <div class=" text-center mt-4">
                                                                        <a class="delete-chat-d d-flex justify-content-center td_none-s text-dark opacity_4-s fs_15px-s"
                                                                            href="{{ route('deleteChat', $chats->uuid) }}">
                                                                            <img class="mr-1 mt-1"
                                                                                src="{{ asset('assets/images/grey_delete_icon.svg') }}"
                                                                                width="13" height="13" alt="delete icon">
                                                                            <span>Delete</span>
                                                                        </a>
                                                                    </div>
                                                                    <!-- <div class="message_count-s text-center ml-xl-4 ml-lg-3 ml-md-5">
                                                                        {{-- @if ($chats->members[0]->id == Auth::user()->profile->id)
                                                                    <p class="fg_white-s mt-3 pt-2 ft_11px-s unread_count-d">{{ $chats->members[1]->unread_count}}</p>
                                                                    @else
                                                                    <p class="fg_white-s mt-3 pt-2 ft_11px-s unread_count-d">{{ $chats->members[0]->unread_count}}</p>
                                                                    @endif --}}
                                                                    </div> -->
                                                                    <input type="hidden" name="chat_uuid"
                                                                        class="chat_uuid_single_chat-d"
                                                                        value={{ $chats->uuid }}>
                                                                    <input type="hidden" name="chat_member_id"
                                                                        class="chat_member_id-d"
                                                                        value={{ $single_member->member_id }}>
                                                                     <input type="hidden" name="" id="" class="current_chat_user_id-d" value={{ $single_member->member_id }}>
                                                                     <input type="hidden" name="" id="current_user_chat-d"  value={{ $single_member->member_id }}>
                                                                     <input type="hidden" name="" id="current_chat_uuid-d"  value={{ $chats->uuid}}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div
                                                            class="col-10 col-lg-11 br_10px-s my-2  br_on_hover-s chat_parent single_chat_user-d chat_single_user-d{{ $chats->uuid }} chat_single_user-d2{{ $single_member->uuid }}">

                                                            @if ($single_member->unread_count != 0)
                                                                <div
                                                                    class="message_count-s text-center ml-xl-4 ml-lg-3 ml-md-5 position-absolute unread_count-d">
                                                                    <p class="fg_white-s pt-2 ft_11px-s ">
                                                                        {{ $single_member->unread_count }}</p>

                                                                </div>
                                                            @else
                                                                <div class="message_count-s text-center ml-xl-4 ml-lg-3 ml-md-5 position-absolute unread_count-d show_unread_count_div-d  d-none">
                                                                    <p class="fg_white-s pt-2 ft_11px-s show_unread_count-d">
                                                                        {{--  {{ $single_member->unread_count }}  --}}
                                                                    </p>

                                                                </div>
                                                            @endif
                                                            <div class="row border br_10px-s py-2 bg-greenish_grey-s d-flex align-items-center">
                                                                <div
                                                                    class="col-3 col-md-3 col-lg-3 col-xl-3 align-self-center pl-lg-2 pl-xl-3 pl-1 pl-md-5">
                                                                    <div class="profile_chat_img-d">
                                                                        <a href="{{ route('othersProfile', [$single_member->user->user->uuid, $single_member->user->uuid, $single_member->user->id]) }}"
                                                                            class="td_none-s">
                                                                            <img class="img_set_to_div-s get_user_chat_image-d"
                                                                                src="{{ asset($single_member->user->profile_image) ?? asset('assets/images/picture.jpg') }}"
                                                                                alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 col-md-6 col-lg-6 col-xl-6 px-0 pl-xl-2 chat-box-updation">
                                                                    <div class="row">
                                                                        <div class="col-12 px-0">
                                                                            <a href="{{ route('othersProfile', [$single_member->user->user->uuid, $single_member->user->uuid, $single_member->user->id]) }}"
                                                                                class="td_none-s">
                                                                                <strong
                                                                                    class="ft_17px-s fg_green-s get_user_chat_name-d">{{ $single_member->user->first_name }}
                                                                                    {{ $single_member->user->last_name }}</strong>
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-12 px-0">
                                                                            <strong
                                                                                class="text-black opacity_4-s get_user_chat_username-d">@<span>{{ $single_member->user->username }}</span> </strong>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12 ft_size_12px-s px-0 mt-2 last_message-d">
                                                                            @foreach ($chats->messages as $message)
                                                                                @if ($loop->last)
                                                                                    <p>
                                                                                        {{ \Illuminate\Support\Str::limit($message->message ?? '', 15, $end='...') }}
                                                                                        {{--  {{ $message->message }}</p>  --}}
                                                                                @endif

                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3 col-md-3 col-lg-3 col-xl-3">
                                                                    <div
                                                                        class="mt-3 ft_size_12px-s text-black  text-center">
                                                                        <span><strong>
                                                                                @if ($chats->messages)
                                                                                    @foreach ($chats->messages as $message)
                                                                                        @if ($loop->last)
                                                                                            <p class="last_message_time-d"> {{ \Carbon\Carbon::parse($message->created_at)->format(' g:i A') ?? '' }}
                                                                                            </p>
                                                                                        @endif


                                                                                    @endforeach

                                                                                @else
                                                                                            <p class="last_message_time-d"> </p>

                                                                                @endif
                                                                        </span></strong>
                                                                    </div>
                                                                    <div class=" text-center mt-4">
                                                                        <a class="delete-chat-d d-flex justify-content-center td_none-s text-dark opacity_4-s fs_15px-s"
                                                                            href="{{ route('deleteChat', $chats->uuid) }}">
                                                                            <img class="mr-1 mt-1"
                                                                                src="{{ asset('assets/images/grey_delete_icon.svg') }}"
                                                                                width="13" height="13" alt="delete icon">
                                                                            <span>Delete</span>
                                                                        </a>
                                                                    </div>
                                                                    <!-- <div class="message_count-s text-center ml-xl-4 ml-lg-3 ml-md-5">
                                                                        {{-- @if ($chats->members[0]->id == Auth::user()->profile->id)
                                                                    <p class="fg_white-s mt-3 pt-2 ft_11px-s unread_count-d">{{ $chats->members[1]->unread_count}}</p>
                                                                    @else
                                                                    <p class="fg_white-s mt-3 pt-2 ft_11px-s unread_count-d">{{ $chats->members[0]->unread_count}}</p>
                                                                    @endif --}}
                                                                    </div> -->
                                                                    <input type="hidden" name="chat_uuid"
                                                                        class="chat_uuid_single_chat-d"
                                                                        value={{ $chats->uuid }}>
                                                                    <input type="hidden" name="chat_member_id"
                                                                        class="chat_member_id-d"
                                                                        value={{ $single_member->member_id }}>
                                                                     <input type="hidden" name="" class="current_chat_user_id-d" value={{ $single_member->member_id }}>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    @endif
                                                @endif
                                            @endforeach
                                        @endforeach


                                    </div>

                                @else
                                    <h3>No Existing Chat Found</h3>
                                @endif
                            </div>


                            <!-- ----- chat member list - end ----- -->


                            {{-- single chat messages --}}
                            {{-- {{ dd($single_chat) }} --}}
                            @if (isset($existingChat) && null !== $existingChat && [] !== $existingChat && isset($single_chat) && 1 == $single_chat)
                                @foreach ($existingChat as $key => $chats)

                                    {{-- {{ dd($existingChat)}} --}}
                                    @if ($key == 0)
                                        {{-- {{ dd($chats) }} --}}
                                        @foreach ($chats->members as $singleMember)

                                            @php
                                                if (Auth::user()->profile->id == $singleMember->member_id) {
                                                    $user_image_sender = $singleMember->user->profile_image;
                                                } else {
                                                    $user_reciver_image = $singleMember->user->profile_image;
                                                }
                                                $user_receiver_id = $singleMember->user->id;
                                                // dd(Auth::user()->profile->id == $singleMember->member_id);
                                            @endphp
                                            {{-- {{ dd($get_check, $user_chats) }} --}}

                                            @if (Auth::user()->profile->id != $singleMember->member_id)
                                                @if (isset($member_uuid) && isset($single_Member))
                                                    {{-- {{ dd($singleMember, "asdasd") }} --}}

                                                    <div class="d-lg-block d-none col-12 col-md-12 col-lg-8 mt-4 mt-md-0 col-xl-8 py-3 border-left border-top-0 w-100 get_single_chat_user-d chat chat_container_on_page-d user_chats_messages-d"
                                                        id="append_chat-d"  data-src="{{ $chats->uuid }}">
                                                        <div class="row pb-2">
                                                            <div class="col-12 border-bottom pr-xl-5">
                                                                <div class="row">
                                                                    <div class="col-10 d-flex">
                                                                        <div class="align-self-center mr-3 d-lg-none back_to_chat_list-d">
                                                                                {{-- <a href="" class="chat_back_to_list-d align-self-center"> --}}
                                                                                    <img src="{{ asset('assets/images/back_arrow.svg') }}" width="18" alt="" />
                                                                                {{-- </a> --}}
                                                                            </div>
                                                                        <div
                                                                            class="profile_img-s d-flex justify-content-between align-self-center">
                                                                            <a
                                                                                href="{{ route('othersProfile', [$single_Member->user->user->uuid, $single_Member->user->uuid, $single_Member->user->id]) }}" >
                                                                                <img class="img_set_to_div-s user_image-d"
                                                                                    src=" {{ asset($single_Member->user->profile_image) }}"
                                                                                    alt="sadasds">
                                                                            </a>
                                                                        </div>
                                                                        <div class="ml-3 align-self-center">
                                                                            <a
                                                                                href="{{ route('othersProfile', [$single_Member->user->user->uuid, $single_Member->user->uuid, $single_Member->user->id]) }}" class="td_none-s">
                                                                                <strong
                                                                                    class="ft_17px-s fg_green-s user_name-d">{{ $single_Member->user->first_name }}
                                                                                    {{ $single_Member->user->last_name }}</strong>
                                                                            </a>
                                                                            <p
                                                                                class="fg_darkgrey_s fs_12px-s user_username-d mb-0">
                                                                                @ {{ $single_Member->user->username }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2 text-right align-self-center pr-xl-4">
                                                                        <div>
                                                                            @if ($single_Member->user->is_blocked_user == 0)
                                                                                <a href="" data-toggle="modal"
                                                                                    data-target="#report_issue_modal-d-{{ $single_Member->user->id }}">
                                                                                    <img src="{{ asset('assets/images/empty_flag.svg') }}"
                                                                                        class="img-responsive " width="20"
                                                                                        height="20" alt="report flag">
                                                                                </a>
                                                                            @else
                                                                                <img src="{{ asset('assets/images/filled_flag.svg') }}"
                                                                                    class="img-responsive " width="20"
                                                                                    height="20" alt="report flag"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top" title="Report">
                                                                            @endif
                                                                        </div>
                                                                        {{-- <!-- <a class = "delete-chat-d" href="{{route('deleteChat' ,$singleChat->uuid)}}">
                                                                            <img class="mr-4" src="{{ asset('assets/images/delete_icon.svg') }}" alt="">
                                                                        </a> --> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <hr> -->
                                                        </div>
                                                        <!-- profile detail of next person in chat - end -->

                                                        <!-- chat room -start -->
                                                        <div class="row h_450px-s get_messages-d pr-xl-5 pl-xl-3 px-2">
                                                            <div class="col-d2 w-100 ">
                                                                <!-- timeline of chat -->
                                                                <div class="row">
                                                                    <div
                                                                        class="col-12 d-flex justify-content-center fs_12px-s mt-3">
                                                                        <span class=""> Today
                                                                            <span>{{ \Carbon\Carbon::now()->format('d M Y') }}</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!-- timeline of chat -->
                                                                {{-- {{ dd($user_chats) }} --}}
                                                                @foreach ($user_chats->messages as $key => $chat_messages)
                                                                    {{-- {{ dd($chat_messages) }} --}}
                                                                    @if (Auth::user()->id == $chat_messages->sender_id)
                                                                        @if (null == $chat_messages->reply_msg_id)
                                                                            <div
                                                                                class="row py-3 justify-content-end delete_message-{{ $chat_messages->uuid }} uuid2_{{ $chat_messages->uuid }}">
                                                                                <div
                                                                                    class="col-xl-12 col-md-12 col-12 pr-4 align-self-end text-right">
                                                                                    <div class="dropdown">
                                                                                        <a type=""
                                                                                            class="text-dark opacity_4-s"
                                                                                            role="button"
                                                                                            data-toggle="dropdown">
                                                                                            <i class="fa fa-ellipsis-v"></i>
                                                                                        </a>

                                                                                        <div class="dropdown-menu">
                                                                                            <input type="hidden"
                                                                                                class="user_profile_uuid"
                                                                                                value={{ Auth::user()->profile->id }} />
                                                                                            <div class="delete_message-d cursor_pointer-s"
                                                                                                data-src={{ $chat_messages->uuid }}>
                                                                                                <span
                                                                                                    class="ml-4">
                                                                                                    <img class="mr-4 w_chat_read_icon-s "
                                                                                                        src="{{ asset('images/delete_icon.svg') }}"
                                                                                                        alt="">
                                                                                                    <span>Delete</span>
                                                                                                    <input type="hidden"
                                                                                                        class="delete_message_uuid-d"
                                                                                                        value={{ $chat_messages->uuid }} />
                                                                                                </span>
                                                                                                <input type="hidden"
                                                                                                    class="user_profile_uuid"
                                                                                                    value={{ Auth::user()->profile->id }} />

                                                                                            </div>
                                                                                            <div class="replay_message-d cursor_pointer-s"
                                                                                                data-src={{ $chat_messages->uuid }}>
                                                                                                <span
                                                                                                    class="ml-4">
                                                                                                    <img class="mr-4 w_chat_read_icon-s "
                                                                                                        src="{{ asset('images/chat_reply_icon.svg') }}"
                                                                                                        alt="">
                                                                                                    <span>Quote</span>
                                                                                                    <input type="hidden"
                                                                                                        class="delete_message_uuid-d"
                                                                                                        value={{ $chat_messages->uuid }} />
                                                                                                    {{-- <input type="hidden" class="quote-d" value="" /> --}}
                                                                                                </span>
                                                                                                <input type="hidden"
                                                                                                    class="user_profile_uuid"
                                                                                                    value={{ Auth::user()->profile->id }} />
                                                                                                <input type="hidden"
                                                                                                    class="chat_uuid_for_replay-d"
                                                                                                    value={{ Auth::user()->profile->id }} />
                                                                                                <input type="hidden"
                                                                                                    class="chat_message_id-d"
                                                                                                    value={{ $chat_messages->id }} />
                                                                                                <input type="hidden"
                                                                                                    class="reply_message_time-d"
                                                                                                    value={{ \Carbon\Carbon::parse($chat_messages->created_at)->addHour(5)->format('g:i A') }} />
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="col-7 col-xl-5 col-lg-6 col-md-5 py-3 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                                                                    <p class="sender_message-d mb-0 text-wrap text-break" >
                                                                                        @if ($chat_messages->file_path == null)
                                                                                        @else
                                                                                            <img src="{{ $chat_messages->file_path }}"
                                                                                                class="show_upload_image-d mr-2"
                                                                                                width="100" height="100" />
                                                                                        @endif
                                                                                        {{ $chat_messages->message ?? '' }}
                                                                                    </p>
                                                                                </div>



                                                                                <div class="ml-2 mr-3 align-self-end">
                                                                                    {{-- <div class="profile_img_in_chat-s">
                                                                                            <img class="img_set_to_div-s sender_image-d" src="{{ asset(Auth::user()->profile->profile_image)}}" alt="">
                                                                                        </div> --}}
                                                                                </div>

                                                                                <div class="col-11 pr-0 mr-4 text-right">
                                                                                    <span
                                                                                        class="ft_11px-s sender_message_time-d">{{ \Carbon\Carbon::parse($chat_messages->created_at)->addHour(5)->format('g:i A') }}|
                                                                                        <span
                                                                                            class="fg_green-s update_status-d">{{$chat_messages->is_read}}</span></span>
                                                                                </div>


                                                                            </div>
                                                                        @else
                                                                            {{-- {{ dd($chat_messages) }} --}}

                                                                            <div
                                                                                class="row py-3 justify-content-end delete_message-{{ $chat_messages->uuid }} uuid2_{{ $chat_messages->uuid }} ">

                                                                                <div
                                                                                    class="col-xl-12 col-md-12 col-12 pr-4 align-self-end text-right">
                                                                                    <div class="dropdown">
                                                                                        <a type=""
                                                                                            class="text-dark opacity_4-s"
                                                                                            role="button"
                                                                                            data-toggle="dropdown">
                                                                                            <i
                                                                                                class="fa fa-ellipsis-v"></i>
                                                                                        </a>

                                                                                        <div class="dropdown-menu">
                                                                                            <input type="hidden"
                                                                                                class="user_profile_uuid"
                                                                                                value={{ Auth::user()->profile->id }} />
                                                                                            <div class="delete_message-d cursor_pointer-s"
                                                                                                data-src={{ $chat_messages->uuid }}>
                                                                                                <span
                                                                                                    class="ml-4">
                                                                                                    <img class="mr-4 w_chat_read_icon-s "
                                                                                                        src="{{ asset('images/delete_icon.svg') }}"
                                                                                                        alt="">
                                                                                                    <span>Delete</span>
                                                                                                    <input type="hidden"
                                                                                                        class="delete_message_uuid-d"
                                                                                                        value={{ $chat_messages->uuid }} />
                                                                                                </span>
                                                                                                <input type="hidden"
                                                                                                    class="user_profile_uuid"
                                                                                                    value={{ Auth::user()->profile->id }} />

                                                                                            </div>
                                                                                            <div class="replay_message-d cursor_pointer-s"
                                                                                                data-src={{ $chat_messages->uuid }}>
                                                                                                <span
                                                                                                    class="ml-4">
                                                                                                    <img class="mr-4 w_chat_read_icon-s "
                                                                                                        src="{{ asset('images/chat_reply_icon.svg') }}"
                                                                                                        alt="">
                                                                                                    <span>Quote</span>
                                                                                                    <input type="hidden"
                                                                                                        class="delete_message_uuid-d"
                                                                                                        value={{ $chat_messages->uuid }} />
                                                                                                    {{-- <input type="hidden" class="quote-d" value="" /> --}}

                                                                                                </span>
                                                                                                <input type="hidden"
                                                                                                    class="user_profile_uuid"
                                                                                                    value={{ Auth::user()->profile->id }} />
                                                                                                <input type="hidden"
                                                                                                    class="chat_uuid_for_replay-d"
                                                                                                    value={{ Auth::user()->profile->id }} />
                                                                                                <input type="hidden"
                                                                                                    class="chat_message_id-d"
                                                                                                    value={{ $chat_messages->id }} />
                                                                                                <input type="hidden"
                                                                                                    class="reply_message_time-d"
                                                                                                    value={{ \Carbon\Carbon::parse($chat_messages->created_at)->addHour(5)->format('g:i A') }} />
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="col-7 col-xl-5 col-lg-6 col-md-5 py-2 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col px-3 mx-3 mt-2 py-2 bg-white br_5px-s">
                                                                                            @if ($chat_messages->sender_id == $chat_messages->reply_message->sender_id)
                                                                                                <strong
                                                                                                    class="ft_14px-s fg_green-s">You</strong>
                                                                                            @else
                                                                                                <strong
                                                                                                    class="ft_14px-s fg_green-s">{{ $singleMember->user->first_name }}
                                                                                                    {{ $singleMember->user->last_name }}</strong>
                                                                                            @endif
                                                                                            <span
                                                                                                class="text-dark float-right">{{ \Carbon\Carbon::parse($chat_messages->reply_message->created_at)->format('g:i A') }}</span><br>
                                                                                            @if ($chat_messages->reply_message->file_path == null)
                                                                                            @else
                                                                                                {{-- <img src="{{ $chat_messages->file_path }}" class="message_image-d mr-2" width="100" height="100" /> --}}
                                                                                                <img src="{{ $chat_messages->reply_message->file_path }}"
                                                                                                    class="reply_message_image-d  mt-1"
                                                                                                    width="40"
                                                                                                    height="40" />
                                                                                            @endif

                                                                                            <p class="text-dark mb-0 text-wrap text-break">
                                                                                                {{ $chat_messages->reply_message->message ?? '' }}

                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <p class="mt-2 mb-0 sender_message-d text-wrap text-break">
                                                                                        @if ($chat_messages->file_path == null)
                                                                                        @else
                                                                                            {{-- <img src="{{ $chat_messages->file_path }}" class="message_image-d mr-2" width="100" height="100" /> --}}
                                                                                            <img src="{{ $chat_messages->file_path }}"
                                                                                                class="show_reply_image_over-d"
                                                                                                width="40" height="40" />
                                                                                        @endif
                                                                                        {{ $chat_messages->message ?? '' }}
                                                                                    </p>
                                                                                </div>

                                                                                <div class="ml-2 mr-3 align-self-end">
                                                                                    {{-- <div class="profile_img_in_chat-s">
                                                                                            <img class="img_set_to_div-s sender_image-d" src="{{ asset(Auth::user()->profile->profile_image)}}" alt="">
                                                                                        </div> --}}
                                                                                </div>
                                                                                <div class="col-11 pr-0 mr-4 text-right">
                                                                                    <span
                                                                                        class="ft_11px-s sender_message_time-d">
                                                                                        {{ \Carbon\Carbon::parse($chat_messages->created_at)->addHour(5)->format('g:i A') }}|
                                                                                        <span
                                                                                            class="fg_green-s update_status-d">{{$chat_messages->is_read}}</span></span>
                                                                                </div>



                                                                            </div>
                                                                        @endif

                                                                    @else
                                                                        @if (null == $chat_messages->reply_msg_id)

                                                                            <div
                                                                                class="row py-3 pl-2 pr-xl-4 uuid2_{{ $chat_messages->uuid }} ">
                                                                                <div
                                                                                    class="col-md-7 col-9 ml-md-0 pr-2  pt-3 d-flex ">
                                                                                    <div class="mx-2 align-self-end">

                                                                                        <div
                                                                                            class="profile_img_in_chat-s reciever_image-d">
                                                                                            <img class="img_set_to_div-s"
                                                                                                src="{{ asset($user_reciver_image) }}"
                                                                                                alt="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap py-3 px-3 w-100">
                                                                                        <p class="reciever_message-d mb-0 text-wrap text-break">
                                                                                            @if ($chat_messages->file_path == null)

                                                                                            @else
                                                                                                <img src="{{ $chat_messages->file_path }}"
                                                                                                    class="reciever_message_image-d"
                                                                                                    width="100"
                                                                                                    height="100" />
                                                                                            @endif
                                                                                            {{ $chat_messages->message ?? '' }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-3 col-md-5 px-0 align-self-center">
                                                                                    {{-- <div class="dropdown">
                                                                                            <a type="" class="text-dark opacity_4-s" role="button" data-toggle="dropdown">
                                                                                                <i class="fa fa-ellipsis-v"></i>
                                                                                            </a>
                                                                                            <div class="dropdown-menu"  >
                                                                                                <input type="hidden" class="user_profile_uuid" value={{ $user_receiver_id }} />
                                                                                                <div class = "delete_message-d cursor_pointer-s" data-src={{ $chat_messages->uuid }}>
                                                                                                    <span class="ml-4">
                                                                                                        <img class="mr-4 w_chat_read_icon-s " src="{{ asset('images/delete_icon.svg') }}" alt="" >
                                                                                                        <span >Delete</span>
                                                                                                        <input type="hidden" class="delete_message_uuid-d" value={{ $chat_messages->uuid }}/>
                                                                                                    </span>
                                                                                                    <input type="hidden" class="user_profile_uuid" value={{ $user_receiver_id }} />
                                                                                                </div> --}}
                                                                                    <div class="replay_message-d cursor_pointer-s"
                                                                                        data-src={{ $chat_messages->uuid }}>
                                                                                        <span class="">
                                                                                            <img class="mr-2  "
                                                                                                width="17" height="17"
                                                                                                src="{{ asset('images/chat_reply_icon.svg') }}"
                                                                                                alt="">

                                                                                            <input type="hidden"
                                                                                                class="delete_message_uuid-d"
                                                                                                value={{ $chat_messages->uuid }} />
                                                                                        </span>
                                                                                        <input type="hidden"
                                                                                            class="user_profile_uuid"
                                                                                            value={{ $user_receiver_id }} />
                                                                                        <input type="hidden"
                                                                                            class="chat_uuid_for_replay-d"
                                                                                            value={{ $user_receiver_id }} />
                                                                                        <input type="hidden"
                                                                                            class="chat_message_id-d"
                                                                                            value={{ $chat_messages->id }} />
                                                                                        <input type="hidden"
                                                                                            class="reply_message_time-d"
                                                                                            value={{ \Carbon\Carbon::parse($chat_messages->created_at)->addHour(5)->format('g:i A') }} />
                                                                                    </div>
                                                                                    <!-- </div>
                                                                                            </div> -->
                                                                                </div>
                                                                                <div class="col-11 ml-5">
                                                                                    <span
                                                                                        class="ft_11px-s reciever_time-d">{{ \Carbon\Carbon::parse($chat_messages->created_at)->addHour(5)->format('g:i A') }}
                                                                                        | <span
                                                                                            class="fg_green-s update_status-d">{{$chat_messages->is_read}}</span></span>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            {{-- {{ dd($chat_messages) }} --}}

                                                                            <div
                                                                                class="row py-3 pl-2 pr-xl-4 uuid2_{{ $chat_messages->uuid }} ">
                                                                                <div
                                                                                    class="col-md-7 col-9 ml-md-0 pr-2  pt-3 d-flex ">
                                                                                    <div class="ml-2 mr-1 align-self-end">
                                                                                        <div
                                                                                            class="profile_img_in_chat-s reciever_image-d">
                                                                                            <img class="img_set_to_div-s"
                                                                                                src="{{ asset($user_reciver_image) }}"
                                                                                                alt="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="row br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap mx-1 px-3 pt-3 pb-2 w-100">
                                                                                        <div
                                                                                            class="col-12 py-2 bg-white br_5px-s">
                                                                                            @if ($chat_messages->sender_id == $chat_messages->reply_message->sender_id)
                                                                                                <strong
                                                                                                    class="ft_14px-s fg_green-s">{{ $singleMember->user->first_name }}
                                                                                                    {{ $singleMember->user->last_name }}</strong><span
                                                                                                    class="text-dark float-right">{{ \Carbon\Carbon::parse($chat_messages->reply_message->created_at)->addHour(5)->format('g:i A') }}</span><br>

                                                                                            @else
                                                                                                <strong
                                                                                                    class="ft_14px-s fg_green-s">You</strong><span
                                                                                                    class="text-dark float-right">{{ \Carbon\Carbon::parse($chat_messages->reply_message->created_at)->addHour(5)->format('g:i A') }}</span><br>
                                                                                            @endif
                                                                                            @if ($chat_messages->reply_message->file_path == null)
                                                                                            @else
                                                                                                <img src="{{ $chat_messages->reply_message->file_path ?? '' }}"
                                                                                                    class="reply_message_image-d  mt-1"
                                                                                                    width="40"
                                                                                                    height="40" />
                                                                                            @endif
                                                                                            <p class="text-dark mb-0 text-wrap text-break">
                                                                                                {{ $chat_messages->reply_message->message ?? '' }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <p
                                                                                            class="reciever_message-d mb-0 mt-2 text-wrap text-break">
                                                                                            @if ($chat_messages->file_path == null)
                                                                                            @else
                                                                                                <img src="{{ $chat_messages->file_path ?? '' }}"
                                                                                                    class="reciever_message_image-d"
                                                                                                    width="40"
                                                                                                    height="40" />
                                                                                            @endif

                                                                                            {{ $chat_messages->message ?? '' }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-3 col-md-5 px-0 align-self-center">
                                                                                    {{-- <div class="dropdown">
                                                                                            <a type="" class="text-dark opacity_4-s" role="button" data-toggle="dropdown">
                                                                                                <i class="fa fa-ellipsis-v"></i>
                                                                                            </a>

                                                                                            <div class="dropdown-menu"  >
                                                                                                <input type="hidden" class="user_profile_uuid" value={{ Auth::user()->profile->id }} />
                                                                                                <div class = "delete_message-d cursor_pointer-s" data-src={{ $chat_messages->uuid }}>
                                                                                                    <span class="ml-4">
                                                                                                        <img class="mr-4 w_chat_read_icon-s " src="{{ asset('images/delete_icon.svg') }}" alt="" >
                                                                                                        <span >Delete</span>
                                                                                                        <input type="hidden" class="delete_message_uuid-d" value={{ $chat_messages->uuid }} />
                                                                                                    </span>
                                                                                                    <input type="hidden" class="user_profile_uuid" value={{ Auth::user()->profile->id }} />

                                                                                                </div> --}}
                                                                                    <div class="replay_message-d cursor_pointer-s"
                                                                                        data-src={{ $chat_messages->uuid }}>
                                                                                        <span class="">
                                                                                            <img class=""
                                                                                                width="17" height="17"
                                                                                                src="{{ asset('images/chat_reply_icon.svg') }}"
                                                                                                alt="">
                                                                                            <!-- <span >Reply</span> -->
                                                                                            <input type="hidden"
                                                                                                class="delete_message_uuid-d"
                                                                                                value={{ $chat_messages->uuid }} />
                                                                                        </span>
                                                                                        <input type="hidden"
                                                                                            class="user_profile_uuid"
                                                                                            value={{ Auth::user()->profile->id }} />
                                                                                        <input type="hidden"
                                                                                            class="chat_uuid_for_replay-d"
                                                                                            value={{ Auth::user()->profile->id }} />
                                                                                        <input type="hidden"
                                                                                            class="chat_message_id-d"
                                                                                            value={{ $chat_messages->id }} />
                                                                                        <input type="hidden"
                                                                                            class="reply_message_time-d"
                                                                                            value={{ \Carbon\Carbon::parse($chat_messages->created_at)->addHour(5)->format('g:i A') }} />
                                                                                    </div>
                                                                                    <!-- </div>
                                                                                            </div> -->
                                                                                </div>

                                                                                <div class="col-11 ml-5">
                                                                                    <span
                                                                                        class="ft_11px-s reciever_time-d">
                                                                                        {{ \Carbon\Carbon::parse($chat_messages->created_at)->addHour(5)->format('g:i A') }}
                                                                                        | <span
                                                                                            class="fg_green-s update_status-d">{{$chat_messages->is_read}}</span></span>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                @endforeach

                                                            </div>
                                                        </div>



                                                        <!-- chat input - start -->
                                                        <form action={{ route('sendMessageToUser') }}
                                                            class="send_message_d d-flex w-100" method="post">
                                                            @csrf
                                                            <div class="row mt-4 py-2 w_96-s shadow br_10px-s ml-1">
                                                                <div class="col-12 d-none show_reply_text-d">
                                                                    <div
                                                                        class="bg_grey-s mx-3 w-100 py-3 fs_12px-s mt-3 mb-2 br_10px-s pl-3 d-flex get_replay_message-d ">
                                                                        <!-- <h6 class="fg_green-s  mb-0"><strong>Thamer</strong></h6> -->
                                                                        {{-- for quote --}}
                                                                        <input type="hidden" class="quote-d"
                                                                            value="" />


                                                                        {{--  --}}

                                                                        <img src="" alt=""
                                                                            class="get_replay_message d-none mr-2"
                                                                            width="30" height="30">
                                                                        <p class="mb-0 message_replay-d align-self-center text-wrap text-break">
                                                                        </p>
                                                                        <input type="hidden" name=""
                                                                            class="reply_user_name-d"
                                                                            value="{{ $singleMember->user->first_name }} {{ $singleMember->user->last_name }}">
                                                                        <input type="hidden" name="chat_message_id"
                                                                            class="reply_msg_id-d" value="">
                                                                        <input type="hidden" name="chat_message_time_id"
                                                                            class="reply_msg_time-d" value="">
                                                                        <input type="hidden" name="media22"
                                                                            class="get_replay_message_t" value="">
                                                                        <input type="hidden" name="media11"
                                                                            class="get_replay_message_t" value="">

                                                                    </div>
                                                                    <span>
                                                                        <img src="{{ asset('assets/images/close-dark.svg') }}"
                                                                            alt=""
                                                                            class="ml-3 mr-4 mt-3 opacity_23_per-s close_reply_text-d"
                                                                            width="15">
                                                                    </span>
                                                                </div>
                                                                <!--reply text area end-->


                                                                {{-- <input id="media14" type="file" name="media" value=""  style="display: none"/> --}}
                                                                <input type="hidden" name="media2" class="get_link-d"
                                                                    value="" id="send_img-d">
                                                                <input type="hidden" name="media" class="get_link2-d"
                                                                    value="">
                                                                <!--upload img -->
                                                                <div
                                                                    class="col-xl-3 col-lg-4 col-md-4 col-12  my-2 hide_upload_image-d d-none">
                                                                    <img src="{{ asset('assets/images/close-dark.svg') }}"
                                                                        class="position-absolute mt-2 close_upload_img-s close_upload_img-d"
                                                                        width="15" alt="close img">
                                                                    <div>
                                                                        <img src="" width="234" height="200"
                                                                            class="br_10px-s uploaded_image-d previewImg2 image_url-d object_fit_cover-s "
                                                                            alt="uplaod img">
                                                                    </div>
                                                                </div>
                                                                <!--upload img -->
                                                                {{-- <div class="col-xl-3 col-lg-4 col-md-4 col-12 my-2" >
                                                                        <img src="{{ asset('assets/images/close-dark.svg') }}" class="position-absolute mt-2 close_upload_img-s close_upload_img-d" width="15" alt="close img">
                                                                        <div>
                                                                            <img src="{{ asset('assets/images/images.jpg') }}" width="200" height="200" class="br_10px-s" alt="uplaod img" data-toggle="modal" data-target="#show_upload_img-d">
                                                                        </div>
                                                                    </div> --}}
                                                                <!--upload img end-->

                                                                {{-- <!--upload video-->
                                                                    <div class="col-xl-3 col-lg-4 col-md-4 col-12  my-2">
                                                                        <img src="{{ asset('assets/images/close-dark.svg') }}" class="position-absolute mt-2 close_upload_img-s close_upload_img-d" width="15" alt="close img">
                                                                        <div>
                                                                            <img src="{{ asset('assets/images/images.jpg') }}" width="200" height="200" class="br_10px-s" alt="uplaod img">
                                                                            <img src="{{ asset('assets/images/video_play_btn.svg') }}" class="position-absolute video_play_btn-s" alt="video play btn"  data-toggle="modal" data-target="#video_modal-d">
                                                                        </div>
                                                                    </div> --}}
                                                                <!--upload video end-->

                                                                <!--msg type area-->
                                                                <div
                                                                    class="col-12 input-group word-break word-wrap emoji-picker-container">
                                                                    {{-- <span class="input-group-text bg-white border-0 br_right_10px-s">
                                                                            <a href="javascript:void(0)" role="button" > <img class="" src="{{ asset('assets/images/smile_emoji.svg') }}" width="18" alt=""></a>
                                                                        </span> --}}
                                                                    {{-- <textarea type="textarea" name="message" placeholder="Type your message....." class="form-control textarea_h_w-s br_left_10px-s pl-3 pt-3 ft_17px-s border-0 simple-chat-message" data-emojiable="true" id="simple-chat-message"></textarea>
                                                                        </span> --}}
                                                                    <textarea type="textarea" name="message"
                                                                        placeholder="Type your message....."
                                                                        class="form-control textarea_h_w-s  br_left_10px-s pl-3 pt-3 fs_12px-s br_left_10px-s ml-4 ft_17px-s  border-0 message_send-d simple-chat-message"
                                                                        data-emojiable="true"
                                                                        id="simple-chat-message"></textarea>
                                                                    {{-- <input type="hidden" name="chat_uuid" class="chat_uuid-d" value="{{ $singleChat->uuid  }}"> --}}

                                                                    <!-- <a class="" href="javascript:void(0)"><img src="assets/images/chat_send_icon.svg" alt=""></a> -->
                                                                    {{-- <span class="input-group-text bg-white border-0 br_right_10px-s"><img class="" src="{{ asset('assets/images/chat_send_icon.svg') }}" alt=""></span> --}}
                                                                    <span
                                                                        class="input-group-text bg-white border-0 br_right_10px-s  ml-2">
                                                                        <a href="" role="button" data-toggle="modal"
                                                                            data-target="#upload_img_modal-d"> <img
                                                                                class=""
                                                                                src="{{ asset('assets/images/file.svg') }}"
                                                                                width="18" alt=""></a>
                                                                    </span>
                                                                    <input type="hidden" name="chat_uuid"
                                                                        class="chat_uuid-d"
                                                                        value="{{ $chats->uuid }}">
                                                                    <button type="submit"
                                                                        class="btn p-0 border-0 send_button-d br_10px-s">
                                                                        <span
                                                                            class="input-group-text bg-white border-0 pr-0 ">
                                                                            <img class=""
                                                                                src="{{ asset('assets/images/chat_send_icon.svg') }}"
                                                                                alt="">
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                                <!--msg type area end-->
                                                            </div>
                                                        </form>
                                                        <!-- chat input - end -->
                                                    </div>
                                                    {{-- {{ dd($singleMember->user->uuid == $member_uuid, $member_uuid) }} --}}

                                                    <!-- Modal -->
                                                    <div class="modal fade report_player_modal-d"
                                                        id="report_issue_modal-d-{{ $single_Member->user->id }}"
                                                        tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered ">
                                                            <div class="modal-content br_10px-s border-0">
                                                                <!--header image-->
                                                                <div
                                                                    class="modal-header bg_grey-s border-0 br_up_left_right_10px-s">
                                                                    <h4 class="modal-title text-dark" id="view-head">
                                                                        <strong>REPORT ISSUES</strong></h4>
                                                                </div>
                                                                <!--header image end-->

                                                                <div class="container-fluid">
                                                                    <div class="row modal-body">
                                                                        <div class="col-12 error_msg-d d-none text-danger">
                                                                            <p class="">Please Select One
                                                                                Option</p>
                                                                        </div>
                                                                        <!--modal text-->
                                                                        <div class="col-12 ">
                                                                            <h6 class="fg_darkgrey_s opacity_4-s">SELECT
                                                                                ISSUE</h6>

                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 mt-2 bb_lightgrey-s bg_grey_on_hover-s report_options-d active">
                                                                            <h6 class="mb-0">Spam</h6>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">Nudity and sexual
                                                                                activity</h6>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">Hate speech or
                                                                                symbols</h6>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">False Information
                                                                            </h6>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">Scam or fraud</h6>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">Bullying or
                                                                                harassment</h6>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">Violence or
                                                                                dangerous organizations</h6>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">Intellectual
                                                                                property violation</h6>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">Sale of illegal or
                                                                                regulated goods</h6>
                                                                        </div>
                                                                        {{-- <div class="col-12 py-3  bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">Something else</h6>
                                                                            <textarea name="your_reason" class="your_reason-d form-control mt-3" id="message" cols="5 " rows="5"></textarea>

                                                                        </div> --}}
                                                                        <!--modal text end-->
                                                                    </div>
                                                                    <div class="row px-3 pt-3 pb-5">
                                                                        <!--cancel button-->
                                                                        <div class="col-6 pr-2">
                                                                            <button type="button"
                                                                                class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100"
                                                                                data-dismiss="modal"><strong>CANCEL</strong></button>
                                                                        </div>
                                                                        <!--cancel button end-->

                                                                        <!--report button-->
                                                                        <div class="col-6 pl-2">
                                                                            <button type="button"
                                                                                class="btn bg_green-s br_10px-s py-3 text-white w-100 block_player_by_user-d"><strong>REPORT</strong></button>
                                                                        </div>
                                                                        <!--report button end-->
                                                                        <input type="hidden" name="" class="blocker_id-d"
                                                                            value="{{ Auth::user()->profile->id }}">
                                                                        <input type="hidden" name="" class="player_id-d"
                                                                            value="{{ $single_Member->user->id }}">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else

                                                    <div class="d-lg-block d-none col-12 col-md-12 col-lg-8 mt-4 mt-md-0 col-xl-8 py-3 border-left border-top-0 w-100 get_single_chat_user-d chat chat_container_on_page-d user_chats_messages-d"
                                                        id="append_chat-d" data-src="{{ $chats->uuid }}">
                                                        <div class="row ">
                                                            <div class="col-12 border-bottom pr-xl-5">
                                                                <div class="row pb-2">
                                                                    <div class="col-10 d-flex">
                                                                        <div class="align-self-center mr-3 d-lg-none back_to_chat_list-d">
                                                                                {{-- <a href="" class="chat_back_to_list-d align-self-center"> --}}
                                                                                    <img src="{{ asset('assets/images/back_arrow.svg') }}" width="18" alt="" />
                                                                                {{-- </a> --}}
                                                                            </div>
                                                                        <div
                                                                            class="profile_img-s d-flex justify-content-between align-self-center">
                                                                            <a
                                                                                href="{{ route('othersProfile', [$singleMember->user->user->uuid, $singleMember->user->uuid, $singleMember->user->id]) }}">
                                                                                <img class="img_set_to_div-s user_image-d"
                                                                                    src=" {{ asset($singleMember->user->profile_image) }}"
                                                                                    alt="">
                                                                            </a>
                                                                        </div>
                                                                        <div class="ml-3 align-self-center">
                                                                            <a
                                                                                href="{{ route('othersProfile', [$singleMember->user->user->uuid, $singleMember->user->uuid, $singleMember->user->id]) }}" class="td_none-s">
                                                                                <strong
                                                                                    class="ft_17px-s fg_green-s user_name-d">{{ $singleMember->user->first_name }}
                                                                                    {{ $singleMember->user->last_name }}</strong>
                                                                            </a>
                                                                            <p
                                                                                class="fg_darkgrey_s fs_12px-s user_username-d mb-0">
                                                                                @ {{ $singleMember->user->username }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="col-2 text-right align-self-center pr-xl-4">
                                                                        <div>
                                                                            @if ($singleMember->user->is_blocked_user == 0)
                                                                                <a href="" data-toggle="modal"
                                                                                    data-target="#report_issue_modal-d-{{ $singleMember->user->id }}">
                                                                                    <img src="{{ asset('assets/images/empty_flag.svg') }}"
                                                                                        class="img-responsive " width="20"
                                                                                        height="20" alt="report flag">
                                                                                </a>
                                                                            @else
                                                                                <img src="{{ asset('assets/images/filled_flag.svg') }}"
                                                                                    class="img-responsive " width="20"
                                                                                    height="20" alt="report flag"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top" title="Report">
                                                                            @endif
                                                                        </div>
                                                                        {{-- <!-- <a class = "delete-chat-d" href="{{route('deleteChat' ,$singleChat->uuid)}}">
                                                                            <img class="mr-4" src="{{ asset('assets/images/delete_icon.svg') }}" alt="">
                                                                        </a> --> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <hr> -->
                                                        </div>
                                                        <!-- profile detail of next person in chat - end -->

                                                        <!-- chat room -start -->
                                                        <div class="row h_450px-s get_messages-d pr-xl-5 pl-xl-3 px-2">
                                                            <div class="col-d2 w-100 ">
                                                                <!-- timeline of chat -->
                                                                <div class="row">
                                                                    <div
                                                                        class="col-12 d-flex justify-content-center fs_12px-s mt-3">
                                                                        <span class=""> Today
                                                                            <span>{{ \Carbon\Carbon::now()->format('d M Y') }}</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!-- timeline of chat -->
                                                                @foreach ($chats->messages as $key => $chat_messages)
                                                                    {{-- {{ dd($chats->messages, $chat_messages) }} --}}
                                                                    @if (Auth::user()->id == $chat_messages->sender_id)
                                                                        @if (null == $chat_messages->reply_msg_id)
                                                                            <div
                                                                                class="row py-3 justify-content-end delete_message-{{ $chat_messages->uuid }} uuid2_{{ $chat_messages->uuid }}">
                                                                                <div
                                                                                    class="col-xl-12 col-md-12 col-12 pr-4 align-self-end text-right">
                                                                                    <div class="dropdown">
                                                                                        <a type=""
                                                                                            class="text-dark opacity_4-s"
                                                                                            role="button"
                                                                                            data-toggle="dropdown">
                                                                                            <i
                                                                                                class="fa fa-ellipsis-v"></i>
                                                                                        </a>

                                                                                        <div class="dropdown-menu">
                                                                                            <input type="hidden"
                                                                                                class="user_profile_uuid"
                                                                                                value={{ Auth::user()->profile->id }} />
                                                                                            <div class="delete_message-d cursor_pointer-s"
                                                                                                data-src={{ $chat_messages->uuid }}>
                                                                                                <span
                                                                                                    class="ml-4">
                                                                                                    <img class="mr-4 w_chat_read_icon-s "
                                                                                                        src="{{ asset('images/delete_icon.svg') }}"
                                                                                                        alt="">
                                                                                                    <span>Delete</span>
                                                                                                    <input type="hidden"
                                                                                                        class="delete_message_uuid-d"
                                                                                                        value={{ $chat_messages->uuid }} />
                                                                                                </span>
                                                                                                <input type="hidden"
                                                                                                    class="user_profile_uuid"
                                                                                                    value={{ Auth::user()->profile->id }} />

                                                                                            </div>
                                                                                            <div class="replay_message-d cursor_pointer-s"
                                                                                                data-src={{ $chat_messages->uuid }}>
                                                                                                <span
                                                                                                    class="ml-4">
                                                                                                    <img class="mr-4 w_chat_read_icon-s "
                                                                                                        src="{{ asset('images/chat_reply_icon.svg') }}"
                                                                                                        alt="">
                                                                                                    <span>Quote</span>
                                                                                                    <input type="hidden"
                                                                                                        class="delete_message_uuid-d"
                                                                                                        value={{ $chat_messages->uuid }} />
                                                                                                    {{-- <input type="hidden" class="quote-d" value="" /> --}}
                                                                                                </span>
                                                                                                <input type="hidden"
                                                                                                    class="user_profile_uuid"
                                                                                                    value={{ Auth::user()->profile->id }} />
                                                                                                <input type="hidden"
                                                                                                    class="chat_uuid_for_replay-d"
                                                                                                    value={{ Auth::user()->profile->id }} />
                                                                                                <input type="hidden"
                                                                                                    class="chat_message_id-d"
                                                                                                    value={{ $chat_messages->id }} />
                                                                                                <input type="hidden"
                                                                                                    class="reply_message_time-d"
                                                                                                    value={{ \Carbon\Carbon::parse($chat_messages->created_at)->addHour(5)->format('g:i A') }} />
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="col-7 col-xl-5 col-lg-6 col-md-5 py-3 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                                                                    <p class="sender_message-d mb-0 text-wrap text-break">
                                                                                        @if ($chat_messages->file_path == null)
                                                                                        @else
                                                                                            <img src="{{ $chat_messages->file_path }}"
                                                                                                class="show_upload_image-d mr-2"
                                                                                                width="100" height="100" />
                                                                                        @endif
                                                                                        {{ $chat_messages->message ?? '' }}
                                                                                    </p>
                                                                                </div>



                                                                                <div class="ml-2 mr-3 align-self-end">
                                                                                    {{-- <div class="profile_img_in_chat-s">
                                                                                            <img class="img_set_to_div-s sender_image-d" src="{{ asset(Auth::user()->profile->profile_image)}}" alt="">
                                                                                        </div> --}}
                                                                                </div>

                                                                                <div class="col-11 pr-0 mr-4 text-right">
                                                                                    <span
                                                                                        class="ft_11px-s sender_message_time-d">{{ \Carbon\Carbon::parse($chat_messages->created_at)->addHour(5)->format('g:i A') }}|
                                                                                        <span
                                                                                            class="fg_green-s update_status-d">{{$chat_messages->is_read}}</span></span>
                                                                                </div>


                                                                            </div>
                                                                        @else
                                                                            {{-- {{ dd($chat_messages) }} --}}

                                                                            <div
                                                                                class="row py-3 justify-content-end delete_message-{{ $chat_messages->uuid }} uuid2_{{ $chat_messages->uuid }} ">

                                                                                <div
                                                                                    class="col-xl-12 col-md-12 col-12 pr-4 align-self-end text-right">
                                                                                    <div class="dropdown">
                                                                                        <a type=""
                                                                                            class="text-dark opacity_4-s"
                                                                                            role="button"
                                                                                            data-toggle="dropdown">
                                                                                            <i
                                                                                                class="fa fa-ellipsis-v"></i>
                                                                                        </a>

                                                                                        <div class="dropdown-menu">
                                                                                            <input type="hidden"
                                                                                                class="user_profile_uuid"
                                                                                                value={{ Auth::user()->profile->id }} />
                                                                                            <div class="delete_message-d cursor_pointer-s"
                                                                                                data-src={{ $chat_messages->uuid }}>
                                                                                                <span
                                                                                                    class="ml-4">
                                                                                                    <img class="mr-4 w_chat_read_icon-s "
                                                                                                        src="{{ asset('images/delete_icon.svg') }}"
                                                                                                        alt="">
                                                                                                    <span>Delete</span>
                                                                                                    <input type="hidden"
                                                                                                        class="delete_message_uuid-d"
                                                                                                        value={{ $chat_messages->uuid }} />
                                                                                                </span>
                                                                                                <input type="hidden"
                                                                                                    class="user_profile_uuid"
                                                                                                    value={{ Auth::user()->profile->id }} />

                                                                                            </div>
                                                                                            <div class="replay_message-d cursor_pointer-s"
                                                                                                data-src={{ $chat_messages->uuid }}>
                                                                                                <span
                                                                                                    class="ml-4">
                                                                                                    <img class="mr-4 w_chat_read_icon-s "
                                                                                                        src="{{ asset('images/chat_reply_icon.svg') }}"
                                                                                                        alt="">
                                                                                                    <span>Quote</span>
                                                                                                    <input type="hidden"
                                                                                                        class="delete_message_uuid-d"
                                                                                                        value={{ $chat_messages->uuid }} />
                                                                                                    {{-- <input type="hidden" class="quote-d" value="" /> --}}

                                                                                                </span>
                                                                                                <input type="hidden"
                                                                                                    class="user_profile_uuid"
                                                                                                    value={{ Auth::user()->profile->id }} />
                                                                                                <input type="hidden"
                                                                                                    class="chat_uuid_for_replay-d"
                                                                                                    value={{ Auth::user()->profile->id }} />
                                                                                                <input type="hidden"
                                                                                                    class="chat_message_id-d"
                                                                                                    value={{ $chat_messages->id }} />
                                                                                                <input type="hidden"
                                                                                                    class="reply_message_time-d"
                                                                                                    value={{ \Carbon\Carbon::parse($chat_messages->created_at)->addHour(5)->format('g:i A') }} />
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="col-7 col-xl-5 col-lg-6 col-md-5 py-2 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col px-3 mx-3 mt-2 py-2 bg-white br_5px-s">
                                                                                            @if ($chat_messages->sender_id == $chat_messages->reply_message->sender_id)
                                                                                                <strong
                                                                                                    class="ft_14px-s fg_green-s">You</strong>
                                                                                            @else
                                                                                                <strong
                                                                                                    class="ft_14px-s fg_green-s">{{ $singleMember->user->first_name }}
                                                                                                    {{ $singleMember->user->last_name }}</strong>
                                                                                            @endif
                                                                                            <span
                                                                                                class="text-dark float-right">{{ \Carbon\Carbon::parse($chat_messages->reply_message->created_at)->format('g:i A') }}</span><br>
                                                                                            @if ($chat_messages->reply_message->file_path == null)
                                                                                            @else
                                                                                                {{-- <img src="{{ $chat_messages->file_path }}" class="message_image-d mr-2" width="100" height="100" /> --}}
                                                                                                <img src="{{ $chat_messages->reply_message->file_path }}"
                                                                                                    class="reply_message_image-d  mt-1"
                                                                                                    width="40"
                                                                                                    height="40" />
                                                                                            @endif

                                                                                            <p class="text-dark mb-0 text-wrap text-break">
                                                                                                {{ $chat_messages->reply_message->message ?? '' }}

                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <p class="mt-2 mb-0 sender_message-d text-wrap text-break">
                                                                                        @if ($chat_messages->file_path == null)
                                                                                        @else
                                                                                            {{-- <img src="{{ $chat_messages->file_path }}" class="message_image-d mr-2" width="100" height="100" /> --}}
                                                                                            <img src="{{ $chat_messages->file_path }}"
                                                                                                class="show_reply_image_over-d"
                                                                                                width="40" height="40" />
                                                                                        @endif
                                                                                        {{ $chat_messages->message ?? '' }}
                                                                                    </p>
                                                                                </div>

                                                                                <div class="ml-2 mr-3 align-self-end">
                                                                                    {{-- <div class="profile_img_in_chat-s">
                                                                                            <img class="img_set_to_div-s sender_image-d" src="{{ asset(Auth::user()->profile->profile_image)}}" alt="">
                                                                                        </div> --}}
                                                                                </div>
                                                                                <div class="col-11 pr-0 mr-4 text-right">
                                                                                    <span
                                                                                        class="ft_11px-s sender_message_time-d">
                                                                                        {{ \Carbon\Carbon::parse($chat_messages->created_at)->addHour(5)->format('g:i A') }}|
                                                                                        <span
                                                                                            class="fg_green-s update_status-d">{{$chat_messages->is_read}}</span></span>
                                                                                </div>



                                                                            </div>
                                                                        @endif

                                                                    @else
                                                                        @if (null == $chat_messages->reply_msg_id)

                                                                            <div
                                                                                class="row py-3 pl-2 pr-xl-4 uuid2_{{ $chat_messages->uuid }} ">
                                                                                <div
                                                                                    class="col-md-7 col-9 ml-md-0 pr-2  pt-3 d-flex ">
                                                                                    <div class="mx-2 align-self-end">

                                                                                        <div
                                                                                            class="profile_img_in_chat-s reciever_image-d">
                                                                                            <img class="img_set_to_div-s"
                                                                                                src="{{ asset($user_reciver_image) }}"
                                                                                                alt="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap py-3 px-3 w-100">
                                                                                        <p class="reciever_message-d mb-0 text-wrap text-break">
                                                                                            @if ($chat_messages->file_path == null)

                                                                                            @else
                                                                                                <img src="{{ $chat_messages->file_path }}"
                                                                                                    class="reciever_message_image-d"
                                                                                                    width="100"
                                                                                                    height="100" />
                                                                                            @endif
                                                                                            {{ $chat_messages->message ?? '' }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-3 col-md-5 px-0 align-self-center">
                                                                                    {{-- <div class="dropdown">
                                                                                            <a type="" class="text-dark opacity_4-s" role="button" data-toggle="dropdown">
                                                                                                <i class="fa fa-ellipsis-v"></i>
                                                                                            </a>
                                                                                            <div class="dropdown-menu"  >
                                                                                                <input type="hidden" class="user_profile_uuid" value={{ $user_receiver_id }} />
                                                                                                <div class = "delete_message-d cursor_pointer-s" data-src={{ $chat_messages->uuid }}>
                                                                                                    <span class="ml-4">
                                                                                                        <img class="mr-4 w_chat_read_icon-s " src="{{ asset('images/delete_icon.svg') }}" alt="" >
                                                                                                        <span >Delete</span>
                                                                                                        <input type="hidden" class="delete_message_uuid-d" value={{ $chat_messages->uuid }}/>
                                                                                                    </span>
                                                                                                    <input type="hidden" class="user_profile_uuid" value={{ $user_receiver_id }} />
                                                                                                </div> --}}
                                                                                    <div class="replay_message-d cursor_pointer-s"
                                                                                        data-src={{ $chat_messages->uuid }}>
                                                                                        <span class="">
                                                                                            <img class="mr-2  "
                                                                                                width="17" height="17"
                                                                                                src="{{ asset('images/chat_reply_icon.svg') }}"
                                                                                                alt="">

                                                                                            <input type="hidden"
                                                                                                class="delete_message_uuid-d"
                                                                                                value={{ $chat_messages->uuid }} />
                                                                                        </span>
                                                                                        <input type="hidden"
                                                                                            class="user_profile_uuid"
                                                                                            value={{ $user_receiver_id }} />
                                                                                        <input type="hidden"
                                                                                            class="chat_uuid_for_replay-d"
                                                                                            value={{ $user_receiver_id }} />
                                                                                        <input type="hidden"
                                                                                            class="chat_message_id-d"
                                                                                            value={{ $chat_messages->id }} />
                                                                                        <input type="hidden"
                                                                                            class="reply_message_time-d"
                                                                                            value={{ \Carbon\Carbon::parse($chat_messages->created_at)->addHour(5)->format('g:i A') }} />
                                                                                    </div>
                                                                                    <!-- </div>
                                                                                            </div> -->
                                                                                </div>
                                                                                <div class="col-11 ml-5">
                                                                                    <span
                                                                                        class="ft_11px-s reciever_time-d">{{ \Carbon\Carbon::parse($chat_messages->created_at)->addHour(5)->format('g:i A') }}
                                                                                        | <span
                                                                                            class="fg_green-s update_status-d">{{$chat_messages->is_read}}</span></span>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            {{-- {{ dd($chat_messages) }} --}}

                                                                            <div
                                                                                class="row py-3 pl-2 pr-xl-4 uuid2_{{ $chat_messages->uuid }} ">
                                                                                <div
                                                                                    class="col-md-7 col-9 ml-md-0 pr-2  pt-3 d-flex ">
                                                                                    <div class="ml-2 mr-1 align-self-end">
                                                                                        <div
                                                                                            class="profile_img_in_chat-s reciever_image-d">
                                                                                            <img class="img_set_to_div-s"
                                                                                                src="{{ asset($user_reciver_image) }}"
                                                                                                alt="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="row br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap mx-1 px-3 pt-3 pb-2 w-100">
                                                                                        <div
                                                                                            class="col-12 py-2 bg-white br_5px-s">
                                                                                            @if ($chat_messages->sender_id == $chat_messages->reply_message->sender_id)
                                                                                                <strong
                                                                                                    class="ft_14px-s fg_green-s">{{ $singleMember->user->first_name }}
                                                                                                    {{ $singleMember->user->last_name }}</strong><span
                                                                                                    class="text-dark float-right">{{ \Carbon\Carbon::parse($chat_messages->reply_message->created_at)->addHour(5)->format('g:i A') }}</span><br>

                                                                                            @else
                                                                                                <strong
                                                                                                    class="ft_14px-s fg_green-s">You</strong><span
                                                                                                    class="text-dark float-right">{{ \Carbon\Carbon::parse($chat_messages->reply_message->created_at)->addHour(5)->format('g:i A') }}</span><br>
                                                                                            @endif
                                                                                            @if ($chat_messages->reply_message->file_path == null)
                                                                                            @else
                                                                                                <img src="{{ $chat_messages->reply_message->file_path ?? '' }}"
                                                                                                    class="reply_message_image-d  mt-1"
                                                                                                    width="40"
                                                                                                    height="40" />
                                                                                            @endif
                                                                                            <p class="text-dark mb-0 text-wrap text-break">
                                                                                                {{ $chat_messages->reply_message->message ?? '' }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <p
                                                                                            class="reciever_message-d mb-0 mt-2 text-wrap text-break">
                                                                                            @if ($chat_messages->file_path == null)
                                                                                            @else
                                                                                                <img src="{{ $chat_messages->file_path ?? '' }}"
                                                                                                    class="reciever_message_image-d"
                                                                                                    width="40"
                                                                                                    height="40" />
                                                                                            @endif

                                                                                            {{ $chat_messages->message ?? '' }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-3 col-md-5 px-0 align-self-center">
                                                                                    {{-- <div class="dropdown">
                                                                                            <a type="" class="text-dark opacity_4-s" role="button" data-toggle="dropdown">
                                                                                                <i class="fa fa-ellipsis-v"></i>
                                                                                            </a>

                                                                                            <div class="dropdown-menu"  >
                                                                                                <input type="hidden" class="user_profile_uuid" value={{ Auth::user()->profile->id }} />
                                                                                                <div class = "delete_message-d cursor_pointer-s" data-src={{ $chat_messages->uuid }}>
                                                                                                    <span class="ml-4">
                                                                                                        <img class="mr-4 w_chat_read_icon-s " src="{{ asset('images/delete_icon.svg') }}" alt="" >
                                                                                                        <span >Delete</span>
                                                                                                        <input type="hidden" class="delete_message_uuid-d" value={{ $chat_messages->uuid }} />
                                                                                                    </span>
                                                                                                    <input type="hidden" class="user_profile_uuid" value={{ Auth::user()->profile->id }} />

                                                                                                </div> --}}
                                                                                    <div class="replay_message-d cursor_pointer-s"
                                                                                        data-src={{ $chat_messages->uuid }}>
                                                                                        <span class="">
                                                                                            <img class=""
                                                                                                width="17" height="17"
                                                                                                src="{{ asset('images/chat_reply_icon.svg') }}"
                                                                                                alt="">
                                                                                            <!-- <span >Reply</span> -->
                                                                                            <input type="hidden"
                                                                                                class="delete_message_uuid-d"
                                                                                                value={{ $chat_messages->uuid }} />
                                                                                        </span>
                                                                                        <input type="hidden"
                                                                                            class="user_profile_uuid"
                                                                                            value={{ Auth::user()->profile->id }} />
                                                                                        <input type="hidden"
                                                                                            class="chat_uuid_for_replay-d"
                                                                                            value={{ Auth::user()->profile->id }} />
                                                                                        <input type="hidden"
                                                                                            class="chat_message_id-d"
                                                                                            value={{ $chat_messages->id }} />
                                                                                        <input type="hidden"
                                                                                            class="reply_message_time-d"
                                                                                            value={{ \Carbon\Carbon::parse($chat_messages->created_at)->addHour(5)->format('g:i A') }} />
                                                                                    </div>
                                                                                    <!-- </div>
                                                                                            </div> -->
                                                                                </div>

                                                                                <div class="col-11 ml-5">
                                                                                    <span
                                                                                        class="ft_11px-s reciever_time-d">
                                                                                        {{ \Carbon\Carbon::parse($chat_messages->created_at)->addHour(5)->format('g:i A') }}
                                                                                        | <span
                                                                                            class="fg_green-s update_status-d">{{$chat_messages->is_read}}</span></span>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                @endforeach

                                                            </div>
                                                        </div>



                                                        <!-- chat input - start -->
                                                        <form action={{ route('sendMessageToUser') }}
                                                            class="send_message_d d-flex w-100" method="post">
                                                            @csrf
                                                            <div class="row mt-4 py-2 w_96-s shadow br_10px-s ml-1">
                                                                <div class="col-12 d-none show_reply_text-d">
                                                                    <div
                                                                        class="bg_grey-s mx-3 w-100 py-3 fs_12px-s mt-3 mb-2 br_10px-s pl-3 d-flex get_replay_message-d ">
                                                                        <!-- <h6 class="fg_green-s  mb-0"><strong>Thamer</strong></h6> -->
                                                                        {{-- for quote --}}
                                                                        <input type="hidden" class="quote-d"
                                                                            value="" />


                                                                        {{--  --}}

                                                                        <img src="" alt=""
                                                                            class="get_replay_message d-none mr-2"
                                                                            width="30" height="30">
                                                                        <p class="mb-0 message_replay-d align-self-center text-wrap text-break">
                                                                        </p>
                                                                        <input type="hidden" name=""
                                                                            class="reply_user_name-d"
                                                                            value="{{ $singleMember->user->first_name }} {{ $singleMember->user->last_name }}">
                                                                        <input type="hidden" name="chat_message_id"
                                                                            class="reply_msg_id-d" value="">
                                                                        <input type="hidden" name="chat_message_time_id"
                                                                            class="reply_msg_time-d" value="">
                                                                        <input type="hidden" name="media22"
                                                                            class="get_replay_message_t" value="">
                                                                        <input type="hidden" name="media11"
                                                                            class="get_replay_message_t" value="">

                                                                    </div>
                                                                    <span>
                                                                        <img src="{{ asset('assets/images/close-dark.svg') }}"
                                                                            alt=""
                                                                            class="ml-3 mr-4 mt-3 opacity_23_per-s close_reply_text-d"
                                                                            width="15">
                                                                    </span>
                                                                </div>
                                                                <!--reply text area end-->


                                                                {{-- <input id="media14" type="file" name="media" value=""  style="display: none"/> --}}
                                                                <input type="hidden" name="media2" class="get_link-d"
                                                                    value="" id="send_img-d">
                                                                <input type="hidden" name="media" class="get_link2-d"
                                                                    value="">
                                                                <!--upload img -->
                                                                <div
                                                                    class="col-xl-3 col-lg-4 col-md-4 col-12  my-2 hide_upload_image-d d-none">
                                                                    <img src="{{ asset('assets/images/close-dark.svg') }}"
                                                                        class="position-absolute mt-2 close_upload_img-s close_upload_img-d"
                                                                        width="15" alt="close img">
                                                                    <div>
                                                                        <img src="" width="234" height="200"
                                                                            class="br_10px-s uploaded_image-d previewImg2 image_url-d object_fit_cover-s "
                                                                            alt="uplaod img">
                                                                    </div>
                                                                </div>
                                                                <!--upload img -->
                                                                {{-- <div class="col-xl-3 col-lg-4 col-md-4 col-12 my-2" >
                                                                        <img src="{{ asset('assets/images/close-dark.svg') }}" class="position-absolute mt-2 close_upload_img-s close_upload_img-d" width="15" alt="close img">
                                                                        <div>
                                                                            <img src="{{ asset('assets/images/images.jpg') }}" width="200" height="200" class="br_10px-s" alt="uplaod img" data-toggle="modal" data-target="#show_upload_img-d">
                                                                        </div>
                                                                    </div> --}}
                                                                <!--upload img end-->

                                                                {{-- <!--upload video-->
                                                                    <div class="col-xl-3 col-lg-4 col-md-4 col-12  my-2">
                                                                        <img src="{{ asset('assets/images/close-dark.svg') }}" class="position-absolute mt-2 close_upload_img-s close_upload_img-d" width="15" alt="close img">
                                                                        <div>
                                                                            <img src="{{ asset('assets/images/images.jpg') }}" width="200" height="200" class="br_10px-s" alt="uplaod img">
                                                                            <img src="{{ asset('assets/images/video_play_btn.svg') }}" class="position-absolute video_play_btn-s" alt="video play btn"  data-toggle="modal" data-target="#video_modal-d">
                                                                        </div>
                                                                    </div> --}}
                                                                <!--upload video end-->

                                                                <!--msg type area-->
                                                                <div
                                                                    class="col-12 input-group word-break word-wrap emoji-picker-container">
                                                                    {{-- <span class="input-group-text bg-white border-0 br_right_10px-s">
                                                                            <a href="javascript:void(0)" role="button" > <img class="" src="{{ asset('assets/images/smile_emoji.svg') }}" width="18" alt=""></a>
                                                                        </span> --}}
                                                                    {{-- <textarea type="textarea" name="message" placeholder="Type your message....." class="form-control textarea_h_w-s br_left_10px-s pl-3 pt-3 ft_17px-s border-0 simple-chat-message" data-emojiable="true" id="simple-chat-message"></textarea>
                                                                        </span> --}}
                                                                    <textarea type="textarea" name="message"
                                                                        placeholder="Type your message....."
                                                                        class="form-control textarea_h_w-s  br_left_10px-s pl-3 pt-3 fs_12px-s br_left_10px-s ml-4 ft_17px-s  border-0 message_send-d simple-chat-message"
                                                                        data-emojiable="true"
                                                                        id="simple-chat-message"></textarea>
                                                                    {{-- <input type="hidden" name="chat_uuid" class="chat_uuid-d" value="{{ $singleChat->uuid  }}"> --}}

                                                                    <!-- <a class="" href="javascript:void(0)"><img src="assets/images/chat_send_icon.svg" alt=""></a> -->
                                                                    {{-- <span class="input-group-text bg-white border-0 br_right_10px-s"><img class="" src="{{ asset('assets/images/chat_send_icon.svg') }}" alt=""></span> --}}
                                                                    <span
                                                                        class="input-group-text bg-white border-0 br_right_10px-s  ml-2">
                                                                        <a href="" role="button" data-toggle="modal"
                                                                            data-target="#upload_img_modal-d"> <img
                                                                                class=""
                                                                                src="{{ asset('assets/images/file.svg') }}"
                                                                                width="18" alt=""></a>
                                                                    </span>
                                                                    <input type="hidden" name="chat_uuid"
                                                                        class="chat_uuid-d"
                                                                        value="{{ $chats->uuid }}">
                                                                    <button type="submit"
                                                                        class="btn p-0 border-0 send_button-d br_10px-s">
                                                                        <span
                                                                            class="input-group-text bg-white border-0 pr-0 ">
                                                                            <img class=""
                                                                                src="{{ asset('assets/images/chat_send_icon.svg') }}"
                                                                                alt="">
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                                <!--msg type area end-->
                                                            </div>
                                                        </form>
                                                        <!-- chat input - end -->
                                                    </div>

                                                    <!-- Modal -->
                                                    <div class="modal fade report_player_modal-d"
                                                        id="report_issue_modal-d-{{ $singleMember->user->id }}"
                                                        tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered ">
                                                            <div class="modal-content br_10px-s border-0">
                                                                <!--header image-->
                                                                <div
                                                                    class="modal-header bg_grey-s border-0 br_up_left_right_10px-s">
                                                                    <h4 class="modal-title text-dark" id="view-head">
                                                                        <strong>REPORT ISSUES</strong></h4>
                                                                </div>
                                                                <!--header image end-->

                                                                <div class="container-fluid">
                                                                    <div class="row modal-body">
                                                                        <div class="col-12 error_msg-d d-none text-danger">
                                                                            <p class="">Please Select One
                                                                                Option</p>
                                                                        </div>
                                                                        <!--modal text-->
                                                                        <div class="col-12 ">
                                                                            <h6 class="fg_darkgrey_s opacity_4-s">SELECT
                                                                                ISSUE</h6>

                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 mt-2 bb_lightgrey-s bg_grey_on_hover-s report_options-d active">
                                                                            <h6 class="mb-0">Spam</h6>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">Nudity and sexual
                                                                                activity</h6>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">Hate speech or
                                                                                symbols</h6>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">False Information
                                                                            </h6>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">Scam or fraud</h6>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">Bullying or
                                                                                harassment</h6>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">Violence or
                                                                                dangerous organizations</h6>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">Intellectual
                                                                                property violation</h6>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">Sale of illegal or
                                                                                regulated goods</h6>
                                                                        </div>
                                                                        <!-- <div class="col-12 py-3  bg_grey_on_hover-s report_options-d">
                                                                            <h6 class="mb-0">Something else</h6>
                                                                            <textarea name="your_reason" class="your_reason-d form-control mt-3" id="message" cols="5 " rows="5"></textarea>

                                                                        </div> -->
                                                                        <!--modal text end-->
                                                                    </div>
                                                                    <div class="row px-3 pt-3 pb-5">
                                                                        <!--cancel button-->
                                                                        <div class="col-6 pr-2">
                                                                            <button type="button"
                                                                                class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100"
                                                                                data-dismiss="modal"><strong>CANCEL</strong></button>
                                                                        </div>
                                                                        <!--cancel button end-->

                                                                        <!--report button-->
                                                                        <div class="col-6 pl-2">
                                                                            <button type="button"
                                                                                class="btn bg_green-s br_10px-s py-3 text-white w-100 block_player_by_user-d"><strong>REPORT</strong></button>
                                                                        </div>
                                                                        <!--report button end-->
                                                                        <input type="hidden" name="" class="blocker_id-d"
                                                                            value="{{ Auth::user()->profile->id }}">
                                                                        <input type="hidden" name="" class="player_id-d"
                                                                            value="{{ $singleMember->user->id }}">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif

                            <!-- ----- chat room - start ----- -->
                            @if (isset($newChat) && '' != $newChat)
                                {{-- <h5>new chat created</h5> --}}

                                @foreach ($newChat as $singleChat)
                                    {{-- {{ dd($newChat, $singleChat) }} --}}
                                    @foreach ($singleChat->members as $singleMember)
                                        {{-- {{ dd( $singleChat->uuid, $singleMember) }} --}}
                                        <div class="d-lg-block d-none col-12 col-md-12 col-lg-8 mt-4 mt-md-0 col-xl-8 py-3 border-left border-top-0 w-100 chat123123 chat chat_container_on_page-d user_chats_messages-d"
                                            id="append_chat-d" data-src="{{ $singleChat->uuid }}">
                                            <div class="row ">
                                                <div class="col-12 border-bottom pr-xl-5">
                                                    <div class="row pb-2">
                                                        <div class="col-10 d-flex">
                                                            <div class="align-self-center mr-3 d-lg-none back_to_chat_list-d">
                                                                {{-- <a href="" class="chat_back_to_list-d align-selfcenter"> --}}
                                                                    <img src="{{ asset('assets/images/back_arrow.svg') }}" width="18" alt="" />
                                                                {{-- </a> --}}
                                                            </div>
                                                            <div class="profile_img-s d-flex justify-content-between align-self-center">
                                                                <a
                                                                    href="{{ route('othersProfile', [$singleMember->user->user->uuid, $singleMember->user->uuid, $singleMember->user->id]) }}">
                                                                    <img class="img_set_to_div-s user_image-d"
                                                                        src=" {{ asset($singleMember->user->profile_image) }}"
                                                                        alt="">
                                                                </a>
                                                            </div>
                                                            <div class="ml-3 align-self-center">
                                                                <a
                                                                    href="{{ route('othersProfile', [$singleMember->user->user->uuid, $singleMember->user->uuid, $singleMember->user->id]) }}" class="td_none-s">
                                                                    <strong
                                                                        class="ft_17px-s fg_green-s user_name-d">{{ $singleMember->user->first_name }}
                                                                        {{ $singleMember->user->last_name }}</strong>
                                                                </a>
                                                                <p class="fg_darkgrey_s fs_12px-s user_username-d mb-0">@
                                                                    {{ $singleMember->user->username }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 text-right align-self-center pr-xl-4">
                                                            <div>
                                                                @if ($singleMember->user->is_blocked_user == 0)
                                                                    <a href="" data-toggle="modal"
                                                                        data-target="#report_issue_modal-d-{{ $singleMember->user->id }}">
                                                                        <img src="{{ asset('assets/images/empty_flag.svg') }}"
                                                                            class="img-responsive " width="20" height="20"
                                                                            alt="report flag">
                                                                    </a>
                                                                @else
                                                                    <img src="{{ asset('assets/images/filled_flag.svg') }}"
                                                                        class="img-responsive " width="20" height="20"
                                                                        alt="report flag" data-toggle="tooltip"
                                                                        data-placement="top" title="Report">
                                                                @endif
                                                            </div>
                                                            {{-- <!-- <a class = "delete-chat-d" href="{{route('deleteChat' ,$singleChat->uuid)}}">
                                                                    <img class="mr-4" src="{{ asset('assets/images/delete_icon.svg') }}" alt="">
                                                                </a> --> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <hr> -->
                                            </div>
                                            <!-- profile detail of next person in chat - end -->

                                            <!-- chat room -start -->
                                            <div class="row h_450px-s get_messages-d pr-xl-5 pl-xl-3 px-2">
                                                <div class="col-d2 w-100 ">
                                                    <!-- timeline of chat -->
                                                    <div class="row">
                                                        <div class="col-12 d-flex justify-content-center fs_12px-s mt-3">
                                                            <span class=""> Today
                                                                <span>{{ \Carbon\Carbon::now()->format('d M Y') }}</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <!-- timeline of chat -->


                                                </div>
                                            </div>



                                            <!-- chat input - start -->
                                            <form action={{ route('sendMessageToUser') }}
                                                class="send_message_d d-flex w-100" method="post">
                                                @csrf
                                                <div class="row mt-4 py-2 w_96-s shadow br_10px-s ml-1">

                                                    <div class="col-12 d-none show_reply_text-d">
                                                        <div
                                                            class="bg_grey-s mx-3 w-100 py-3 fs_12px-s mt-3 mb-2 br_10px-s pl-3 d-flex get_replay_message-d ">

                                                            <input type="hidden" class="quote-d" value="" />


                                                            <!-- <h6 class="fg_green-s  mb-0"><strong>Thamer</strong></h6> -->
                                                            <img src="" alt="" class="get_replay_message d-none mr-2"
                                                                width="30" height="30">
                                                            <p class="mb-0 message_replay-d align-self-center text-wrap text-break"></p>
                                                            <input type="hidden" name="" class="reply_user_name-d"
                                                                value="">




                                                            <input type="hidden" name="chat_message_id"
                                                                class="reply_msg_id-d" value="">
                                                            <input type="hidden" name="chat_message_time_id"
                                                                class="reply_msg_time-d" value="">
                                                            <input type="hidden" name="media22"
                                                                class="get_replay_message_t" value="">
                                                            <input type="hidden" name="media11"
                                                                class="get_replay_message_t" value="">

                                                        </div>
                                                        <span>
                                                            <img src="{{ asset('assets/images/close-dark.svg') }}"
                                                                alt=""
                                                                class="ml-3 mr-4 mt-3 opacity_23_per-s close_reply_text-d"
                                                                width="15">
                                                        </span>
                                                    </div>

                                                    {{-- <input id="media14" type="file" name="media" value=""  style="display: none"/> --}}
                                                    <input type="hidden" name="media2" class="get_link-d" value=""
                                                        id="send_img-d">
                                                    <input type="hidden" name="media" class="get_link2-d" value="">
                                                    <!--upload img -->
                                                    <div
                                                        class="col-xl-3 col-lg-4 col-md-4 col-12  my-2 hide_upload_image-d d-none">
                                                        <img src="{{ asset('assets/images/close-dark.svg') }}"
                                                            class="position-absolute mt-2 close_upload_img-s close_upload_img-d"
                                                            width="15" alt="close img">
                                                        <div>
                                                            <img src="" width="234" height="200"
                                                                class="br_10px-s uploaded_image-d previewImg2 image_url-d object_fit_cover-s "
                                                                alt="uplaod img">
                                                        </div>
                                                    </div>
                                                    <!--upload img -->
                                                    {{-- <div class="col-xl-3 col-lg-4 col-md-4 col-12 my-2" >
                                                                <img src="{{ asset('assets/images/close-dark.svg') }}" class="position-absolute mt-2 close_upload_img-s close_upload_img-d" width="15" alt="close img">
                                                                <div>
                                                                    <img src="{{ asset('assets/images/images.jpg') }}" width="200" height="200" class="br_10px-s" alt="uplaod img" data-toggle="modal" data-target="#show_upload_img-d">
                                                                </div>
                                                            </div> --}}
                                                    <!--upload img end-->

                                                    {{-- <!--upload video-->
                                                            <div class="col-xl-3 col-lg-4 col-md-4 col-12  my-2">
                                                                <img src="{{ asset('assets/images/close-dark.svg') }}" class="position-absolute mt-2 close_upload_img-s close_upload_img-d" width="15" alt="close img">
                                                                <div>
                                                                    <img src="{{ asset('assets/images/images.jpg') }}" width="200" height="200" class="br_10px-s" alt="uplaod img">
                                                                    <img src="{{ asset('assets/images/video_play_btn.svg') }}" class="position-absolute video_play_btn-s" alt="video play btn"  data-toggle="modal" data-target="#video_modal-d">
                                                                </div>
                                                            </div> --}}
                                                    <!--upload video end-->

                                                    <!--msg type area-->
                                                    <div
                                                        class="col-12 input-group word-break word-wrap emoji-picker-container">
                                                        {{-- <span class="input-group-text bg-white border-0 br_right_10px-s">
                                                                    <a href="javascript:void(0)" role="button" > <img class="" src="{{ asset('assets/images/smile_emoji.svg') }}" width="18" alt=""></a>
                                                                </span> --}}
                                                        {{-- <textarea type="textarea" name="message" placeholder="Type your message....." class="form-control textarea_h_w-s br_left_10px-s pl-3 pt-3 ft_17px-s border-0 simple-chat-message" data-emojiable="true" id="simple-chat-message"></textarea>
                                                                </span> --}}
                                                        <textarea type="textarea" name="message"
                                                            placeholder="Type your message....."
                                                            class="form-control textarea_h_w-s  br_left_10px-s pl-3 pt-3 fs_12px-s br_left_10px-s ml-4 ft_17px-s message_send-d  border-0 simple-chat-message"
                                                            data-emojiable="true" id="simple-chat-message"></textarea>
                                                        {{-- <input type="hidden" name="chat_uuid" class="chat_uuid-d" value="{{ $singleChat->uuid  }}"> --}}

                                                        <!-- <a class="" href="javascript:void(0)"><img src="assets/images/chat_send_icon.svg" alt=""></a> -->
                                                        {{-- <span class="input-group-text bg-white border-0 br_right_10px-s"><img class="" src="{{ asset('assets/images/chat_send_icon.svg') }}" alt=""></span> --}}
                                                        <span
                                                            class="input-group-text bg-white border-0 br_right_10px-s  ml-2">
                                                            <a href="" role="button" data-toggle="modal"
                                                                data-target="#upload_img_modal-d"> <img
                                                                    class=""
                                                                    src="{{ asset('assets/images/file.svg') }}"
                                                                    width="18" alt=""></a>
                                                        </span>
                                                        <input type="hidden" name="chat_uuid" class="chat_uuid-d"
                                                            value="{{ $singleChat->uuid }}">
                                                        <button type="submit" class="btn p-0 border-0 send_button-d br_10px-s">
                                                            <span class="input-group-text bg-white border-0 pr-0 ">
                                                                <img class=""
                                                                    src="{{ asset('assets/images/chat_send_icon.svg') }}"
                                                                    alt="">
                                                            </span>
                                                        </button>
                                                    </div>
                                                    <!--msg type area end-->
                                                </div>
                                            </form>
                                            <!-- chat input - end -->


                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade report_player_modal-d"
                                            id="report_issue_modal-d-{{ $singleMember->user->id }}" tabindex="-1"
                                            aria-labelledby="view-head" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered ">
                                                <div class="modal-content br_10px-s border-0">
                                                    <!--header image-->
                                                    <div class="modal-header bg_grey-s border-0 br_up_left_right_10px-s">
                                                        <h4 class="modal-title text-dark" id="view-head"><strong>REPORT
                                                                ISSUES</strong></h4>
                                                    </div>
                                                    <!--header image end-->

                                                    <div class="container-fluid">
                                                        <div class="row modal-body">
                                                            <div class="col-12 error_msg-d d-none text-danger">
                                                                <p class="">Please Select One Option</p>
                                                            </div>
                                                            <!--modal text-->
                                                            <div class="col-12 ">
                                                                <h6 class="fg_darkgrey_s opacity_4-s">SELECT ISSUE</h6>

                                                            </div>
                                                            <div
                                                                class="col-12 py-3 mt-2 bb_lightgrey-s bg_grey_on_hover-s report_options-d active">
                                                                <h6 class="mb-0">Spam</h6>
                                                            </div>
                                                            <div
                                                                class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                <h6 class="mb-0">Nudity and sexual activity</h6>
                                                            </div>
                                                            <div
                                                                class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                <h6 class="mb-0">Hate speech or symbols</h6>
                                                            </div>
                                                            <div
                                                                class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                <h6 class="mb-0">False Information</h6>
                                                            </div>
                                                            <div
                                                                class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                <h6 class="mb-0">Scam or fraud</h6>
                                                            </div>
                                                            <div
                                                                class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                <h6 class="mb-0">Bullying or harassment</h6>
                                                            </div>
                                                            <div
                                                                class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                <h6 class="mb-0">Violence or dangerous
                                                                    organizations</h6>
                                                            </div>
                                                            <div
                                                                class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                <h6 class="mb-0">Intellectual property violation
                                                                </h6>
                                                            </div>
                                                            <div
                                                                class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                                                <h6 class="mb-0">Sale of illegal or regulated
                                                                    goods</h6>
                                                            </div>
                                                            <!-- <div class="col-12 py-3  bg_grey_on_hover-s report_options-d">
                                                                    <h6 class="mb-0">Something else</h6>
                                                                    <textarea name="your_reason" class="your_reason-d form-control mt-3" id="message" cols="5 " rows="5"></textarea>

                                                                </div> -->
                                                            <!--modal text end-->
                                                        </div>
                                                        <div class="row px-3 pt-3 pb-5">
                                                            <!--cancel button-->
                                                            <div class="col-6 pr-2">
                                                                <button type="button"
                                                                    class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100"
                                                                    data-dismiss="modal"><strong>CANCEL</strong></button>
                                                            </div>
                                                            <!--cancel button end-->

                                                            <!--report button-->
                                                            <div class="col-6 pl-2">
                                                                <button type="button"
                                                                    class="btn bg_green-s br_10px-s py-3 text-white w-100 block_player_by_user-d"><strong>REPORT</strong></button>
                                                            </div>
                                                            <!--report button end-->
                                                            <input type="hidden" name="" class="blocker_id-d"
                                                                value="{{ Auth::user()->profile->id }}">
                                                            <input type="hidden" name="" class="player_id-d"
                                                                value="{{ $singleMember->user->id }}">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                @endforeach
                            @endif


                            <div class="d-lg-block d-none col-12 col-md-12 col-lg-8 mt-4 mt-md-0 col-xl-8 py-3 border-left border-top-0 chat12312 w-100 chat_container_on_page-d chat user_chats_messages-d"
                                id="append_chat-d" style="display: none !important">

                                <div class="row ">
                                    <div class="col-12 border-bottom pr-xl-5">
                                        <div class="row pb-2">
                                            <div class="col-10 d-flex">
                                                <div class="align-self-center mr-3 d-lg-none back_to_chat_list-d">
                                                    {{-- <a href="" class="chat_back_to_list-d align-self-center"> --}}
                                                        <img src="{{ asset('assets/images/back_arrow.svg') }}" width="18" alt="" />
                                                    {{-- </a> --}}
                                                </div>
                                                <div class="profile_img-s d-flex justify-content-between align-self-center">
                                                    <a class="send_user_other_profile-d" href="">
                                                        <img class="img_set_to_div-s user_image-d"
                                                            src=" {{ asset('assets/images/picture.jpg') }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="ml-3 align-self-center">
                                                    <a class="send_user_other_profile-d td_none-s" href="">
                                                        <strong class="ft_17px-s fg_green-s user_name-d"> </strong>
                                                    </a>
                                                    <p class="fg_darkgrey_s fs_12px-s user_username-d mb-0">@ </p>
                                                </div>
                                            </div>
                                            <div class="col-2 text-right align-self-center pr-xl-4">
                                                <div>
                                                    {{-- @if ($user->profile->is_blocked_user == 0) --}}
                                                    <a href="" data-toggle="modal" class="open_flag_to_report-d"
                                                        data-target="">
                                                        <img src="{{ asset('assets/images/empty_flag.svg') }}"
                                                            class="img-responsive report_flag-d" width="20" height="20"
                                                            alt="report flag">
                                                    </a>

                                                    {{-- @else --}}
                                                    <img src="{{ asset('assets/images/filled_flag.svg') }}"
                                                        class="img-responsive reported_flag-d" width="20" height="20"
                                                        alt="report flag" data-toggle="tooltip" data-placement="top"
                                                        title="Report">
                                                    {{-- <img src="{{ asset('assets/images/filled_flag.svg') }}" class="img-responsive " width="20" height="20" alt="report flag"> --}}
                                                    {{-- @endif --}}
                                                </div>

                                                {{-- <!-- <a class="delete-chat-d" href="javascript:void(0)">
                                                        <img class="mr-4" src="{{ asset('assets/images/delete_icon.svg') }}" alt="">
                                                    </a> --> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <hr> -->
                                <!-- profile detail of next person in chat - end -->

                                <!-- chat room -start -->
                                <div class="row h_450px-s get_messages-d pr-xl-5 pl-xl-3 px-2">
                                    <div class="col-d2 w-100 get_show_images-d ">
                                        <!-- timeline of chat -->
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-center fs_12px-s mt-3">
                                                <span class=""> Today
                                                    <span>{{ \Carbon\Carbon::now()->format('d M Y') }}</span> </span>
                                            </div>
                                        </div>
                                        <!-- timeline of chat -->
                                        <!-- next person in chat -->

                                        <div class="row py-3">
                                            <div class="mx-2 align-self-end">
                                                {{-- <div class="profile_img_in_chat-s">
                                                        <img class="img_set_to_div-s" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                                                    </div> --}}
                                            </div>
                                            <div
                                                class="col-7 col-md-5 col-lg-6 col-xl-5 ml-md-0 ml-4 py-2 br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
                                                    bibendum justo at magna pulvinar. Lorem ipsum dolor sit amet,
                                                    consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar
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
                                                                <img class="mr-4 w_chat_read_icon-s"
                                                                    src="{{ asset('assets/images/delete_icon.svg') }}"
                                                                    alt="">
                                                                <span>Delete</span>
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a class="ml-4" href="#">
                                                                <img class="mr-4 w_chat_read_icon-s"
                                                                    src="{{ asset('assets/images/chat_reply_icon.svg') }}"
                                                                    alt="">
                                                                <span>Reply</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-11 ml-5">
                                                <span class="ft_11px-s"> 12:43 PM | <span
                                                        class="fg_green-s update_status-d">S</span></span>
                                            </div>
                                        </div>
                                        <!-- next person in chat -->

                                        <!-- first person in chat -->

                                        <div class="row py-3 justify-content-end">
                                            <div
                                                class="col-7 col-xl-5 col-lg-6 col-md-5 py-2 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
                                                    bibendum justo at magna pulvinar. Lorem ipsum dolor sit amet,
                                                    consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar
                                                </p>
                                            </div>
                                            <div class="ml-2 mr-3 align-self-end">
                                                <div class="profile_img_in_chat-s">
                                                    <img class="img_set_to_div-s"
                                                        src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                                        alt="">
                                                </div>
                                            </div>

                                            <div class="col-11 pr-0 mr-4 text-right">
                                                <span class="ft_11px-s"> 12:43 AM | <span
                                                        class="fg_green-s update_status-d"></span></span>
                                            </div>
                                        </div>
                                        <!-- first person in chat -->

                                    </div>
                                </div>
                                <!-- chat input - start -->
                                {{-- <form action={{ route('sendMessageToUser') }} class="send_message_d d-flex w-100"  method="post">
                                    <div class="mt-3 w-100">

                                            <div class="border py-3 pl-2 bg_grey-s  message_replay-d ">
                                                helo again
                                            </div>
                                            <input type="hidden" name="chat_message_id" class="reply_msg_id-d" value="">
                                            <input type="hidden" name="chat_message_time_id" class="reply_msg_time-d" value="">
                                        <div class="input-group word-break word-wrap  py-2 shadow br_10px-s"> --}}

                                {{-- <form action={{ route('sendMessageToUser') }} class="send_message_d d-flex w-100"  method="post"> --}}
                                {{-- <span class="input-group-text bg-white border-0 br_right_10px-s opacity_4-s ml-2"> --}}
                                {{-- <a href="" role="button" data-toggle="modal" data-target="#upload_img_modal-d">
                                                    <img class="" src="{{asset ('assets/images/file.svg') }}" width="18" alt="">
                                                </a> --}}
                                {{-- </span>
                                                @csrf
                                                <input type="textarea" name="message" placeholder="Type your message....." class="form-control textarea_h_w-s pl-3 pt-3 ml-4 br_left_10px-s ft_17px-s border-0  message_send-d" id="simple-chat-message"> --}}
                                <!-- <a class="" href="javascript:void(0)"><img src="assets/images/chat_send_icon.svg" alt=""></a> -->
                                {{-- <input type="hidden" name="chat_uuid" class="chat_uuid-d" value="">
                                                <button type="submit" class="border-0">
                                                    <span class="input-group-text bg-white border-0">
                                                        <img class="" src="{{ asset('assets/images/chat_send_icon.svg') }}" alt="">
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </form> --}}
                                <!-- chat input - end -->



                                <form action={{ route('sendMessageToUser') }} class="send_message_d d-flex w-100"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mt-4 py-2 w_96-s shadow br_10px-s ml-1">
                                        <!--reply text area-->
                                        <div class="col-12 d-none show_reply_text-d">
                                            <div
                                                class="bg_grey-s mx-3 w-100 py-3 fs_12px-s mt-3 mb-2 br_10px-s pl-3 d-flex get_replay_message-d ">
                                                <!-- <h6 class="fg_green-s  mb-0"><strong>Thamer</strong></h6> -->
                                                <img src="" alt="" class="get_replay_message d-none mr-2" width="30"
                                                    height="30">
                                                <p class="mb-0 message_replay-d align-self-center text-wrap text-break"></p>
                                                <input type="hidden" name="" class="reply_user_name-d" value="">

                                                <input type="hidden" name="chat_message_id" class="reply_msg_id-d"
                                                    value="">
                                                <input type="hidden" name="chat_message_time_id" class="reply_msg_time-d"
                                                    value="">
                                                <input type="hidden" name="media22" class="get_replay_message_t" value="">
                                                <input type="hidden" name="media11" class="get_replay_message_t" value="">

                                            </div>
                                            <span>
                                                <img src="{{ asset('assets/images/close-dark.svg') }}" alt=""
                                                    class="ml-3 mr-4 mt-3 opacity_23_per-s close_reply_text-d" width="15">
                                            </span>
                                        </div>
                                        <!--reply text area end-->


                                        {{-- <input id="media14" type="file" name="media" value=""  style="display: none"/> --}}
                                        <input type="hidden" name="media2" class="get_link-d" value="" id="send_img-d">
                                        <input type="hidden" name="media" class="get_link2-d" value="">
                                        <!--upload img -->
                                        <div class="col-xl-3 col-lg-4 col-md-4 col-12  my-2 hide_upload_image-d d-none">
                                            <img src="{{ asset('assets/images/close-dark.svg') }}"
                                                class="position-absolute mt-2 close_upload_img-s close_upload_img-d"
                                                width="15" alt="close img">
                                            <div>
                                                <img src="" width="234" height="200"
                                                    class="br_10px-s uploaded_image-d previewImg2 image_url-d object_fit_cover-s "
                                                    alt="uplaod img">
                                            </div>
                                        </div>
                                        <!--upload img end-->

                                        <!--upload video-->
                                        <!-- <div class="col-xl-3 col-lg-4 col-md-4 col-12  my-2">
                                                    <img src="assets/images/close-dark.svg" class="position-absolute mt-2 close_upload_img-s close_upload_img-d" width="15" alt="close img">
                                                    <div>
                                                        <img src="assets/images/images.jpg" width="200" height="200" class="br_10px-s" alt="uplaod img">
                                                        <img src="assets/images/video_play_btn.svg" class="position-absolute video_play_btn-s" alt="video play btn" data-toggle="modal" data-target="#video_modal-d">
                                                    </div>
                                                </div> -->
                                        <!--upload video end-->

                                        <!--msg type area-->
                                        <div class="col-12 input-group word-break word-wrap">
                                            <!-- <span class="input-group-text bg-white border-0 br_right_10px-s">
                                                        <a href="javascript:void(0)" role="button" > <img class="" src="{{ asset('assets/images/smile_emoji.svg') }}" width="18" alt=""></a>
                                                    </span> -->
                                            <textarea type="textarea" name="message" placeholder="Type your message....."
                                                class="form-control fs_12px-s textarea_h_w-s pl-3 pt-3 br_left_10px-s ml-4 ft_17px-s border-0 simple-chat-message message_send-d remove_validate-d"
                                                data-emojiable="true" data-emoji-input="unicode"
                                                id="simple-chat-message"></textarea>
                                            <!-- <a class="" href="javascript:void(0)"><img src="assets/images/chat_send_icon.svg" alt=""></a> -->
                                            {{-- <span class="input-group-text bg-white border-0 br_right_10px-s"><img class="" src="{{ asset('assets/images/chat_send_icon.svg') }}" alt=""></span> --}}
                                            <span class="input-group-text bg-white border-0 br_right_10px-s  ml-2">
                                                <a href="" role="button" data-toggle="modal"
                                                    data-target="#upload_img_modal-d"> <img class=""
                                                        src="{{ asset('assets/images/file.svg') }}" width="18"
                                                        alt=""></a>
                                            </span>
                                            <input type="hidden" name="chat_uuid" class="chat_uuid-d" value="">
                                            <button type="submit" class="btn p-0 border-0 send_button-d br_10px-s">
                                                <span class="input-group-text bg-white border-0 pr-0">
                                                    <img class=""
                                                        src="{{ asset('assets/images/chat_send_icon.svg') }}" alt="">
                                                </span>
                                            </button>
                                        </div>
                                        <!--msg type area end-->
                                    </div>
                                    <!-- chat input - end -->
                                </form>



                            </div>



                        </div>
                    </div>
                </div>
            </div>
            <!-- container for chat - end -->
        </div>
        <!-- .................chat Page End ......................... -->

        <!-- Modal -->
        <div class="modal fade open_flag_to_report_modal-d" id="" tabindex="-1" aria-labelledby="view-head"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content br_10px-s border-0">
                    <!--header image-->
                    <div class="modal-header bg_grey-s border-0 br_up_left_right_10px-s">
                        <h4 class="modal-title text-dark" id="view-head"><strong>REPORT ISSUES</strong></h4>
                    </div>
                    <!--header image end-->

                    <div class="container-fluid">
                        <div class="row modal-body">
                            <!--modal text-->
                            <div class="col-12 ">
                                <h6 class="fg_darkgrey_s opacity_4-s">SELECT ISSUE</h6>

                            </div>
                            <div class="col-12 py-3 mt-2 bb_lightgrey-s bg_grey_on_hover-s report_options-d active">
                                <h6 class="mb-0">Spam</h6>
                            </div>
                            <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                <h6 class="mb-0">Nudity and sexual activity</h6>
                            </div>
                            <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                <h6 class="mb-0">Hate speech or symbols</h6>
                            </div>
                            <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                <h6 class="mb-0">False Information</h6>
                            </div>
                            <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                <h6 class="mb-0">Scam or fraud</h6>
                            </div>
                            <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                <h6 class="mb-0">Bullying or harassment</h6>
                            </div>
                            <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                <h6 class="mb-0">Violence or dangerous organizations</h6>
                            </div>
                            <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                <h6 class="mb-0">Intellectual property violation</h6>
                            </div>
                            <div class="col-12 py-3 bb_lightgrey-s bg_grey_on_hover-s report_options-d">
                                <h6 class="mb-0">Sale of illegal or regulated goods</h6>
                            </div>
                            {{--  <div class="col-12 py-3  bg_grey_on_hover-s report_options-d">
                                <h6 class="mb-0">Something else</h6>
                                <textarea name="your_reason" class="your_reason-d form-control mt-3" id="message" cols="5 "
                                    rows="5"></textarea>

                            </div>  --}}
                            <!--modal text end-->
                        </div>
                        <div class="row px-3 pt-3 pb-5">
                            <!--cancel button-->
                            <div class="col-6 pr-2">
                                <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 w-100"
                                    data-dismiss="modal"><strong>CANCEL</strong></button>
                            </div>
                            <!--cancel button end-->

                            <!--report button-->
                            <div class="col-6 pl-2">
                                <button type="button"
                                    class="btn bg_green-s br_10px-s py-3 text-white w-100 block_player_by_user-d"><strong>REPORT</strong></button>
                            </div>
                            <!--report button end-->
                            <input type="hidden" name="" class="blocker_id-d"
                                value="{{ Auth::user()->profile->id }}">
                            <input type="hidden" name="" class="player_id-d" value="">

                        </div>
                    </div>
                </div>
            </div>
        </div>



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

                            {{-- <form action="">
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
                                        <img src="{{ asset('assets/images/upload_img.svg') }}" class="w_inherit-s" alt="upload img">
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <img src="{{ asset('assets/images/close.svg') }}" class="remove_img-s position-absolute" alt="remove img">
                                    <div class="">
                                        <img src="{{ asset('assets/images/picture.jpg') }}" class="upload_pic-s" alt="uplaod img">
                                    </div>
                                </div>
                            </div>

                        </form>
                        <div class="row py-3">
                            <div class="col-12 d-flex justify-content-center">
                                <button type="button" class="btn bg_grey-s br_10px-s fg_green-s py-3 px-5 mr-md-2 w-100" data-dismiss="modal"><strong>CANCEL</strong></button>
                                <button type="submit" class="btn bg_green-s br_10px-s py-3 text-white px-5 ml-2 w-100" data-dismiss="modal"><strong>UPLOAD</strong></button>
                            </div>
                        </div> --}}

                            {{-- <form action="{{ route('userMedia') }}"  method="post" enctype="multipart/form-data" id="upload_media-d">
                            @csrf --}}
                            <div class="row pb-3">
                                <!-- <div class="col-12">
                                        <div class="form-group">
                                            <label for="caption-d"><Strong>CAPTION</Strong></label>
                                            <textarea class="form-control resize_none-s rounded" name="caption" id="caption-d" placeholder="write here" rows="1"></textarea>
                                        </div>
                                    </div> -->
                                <div class="col-12 mt-3">
                                    <h6><strong>PHOTO/VIDEO</strong></h6>
                                    <div class="w-100 ">
                                        <label for="media13" class="w-100">
                                            <img src="{{ asset('assets/images/img_upload.svg') }}"
                                                class="w_inherit-s img-fluid" alt="upload img" />
                                        </label>
                                        <input id="media13" type="file" name="media" style="display: none" />
                                    </div>
                                </div>
                                <div class="col-12 mt-4 media_image-d d-none">
                                    <img src="{{ asset('assets/images/close.svg') }}"
                                        class="remove_img-s position-absolute" alt="remove img">
                                    <div class="">
                                        <img class="previewImg2" src="" class="upload_img_video-d" width="100px"
                                            height="100px" />
                                        {{-- <video src=""></video> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-12 d-flex justify-content-center">
                                    <button type="button"
                                        class="btn bg_grey-s br_10px-s fg_green-s py-3 px-5 mr-md-2 w-100 cancel_modal-d"
                                        data-dismiss="modal"><strong>CANCEL</strong></button>
                                    <button type="button"
                                        class="btn bg_green-s br_10px-s py-3 text-white px-5 ml-2 w-100 upload_pic_media-d"
                                        id=""><strong>UPLOAD</strong></button>
                                </div>
                            </div>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>




        {{-- Modals --}}

        <!--show uplaod img-->
        <div class="modal fade" id="show_upload_img-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered ">
                <div class="modal-content br_10px-s border-0">
                    <div class="modal-header pb-0 border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('assets/images/close-dark.svg') }}" class="" width="15"
                                alt="close img">
                        </button>
                    </div>
                    <div class="container-fluid">
                        <div class="modal-body">
                            {{-- <img src="{{ asset('images/images.jpg') }}" class="w-100" height="100%" alt=""> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!---show upload img modal end-->

        <!--Video Modal-->
        <div class="modal fade" id="video_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content br_10px-s border-0">
                    <div class="modal-header pb-0 border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('assets/images/close-dark.svg') }}" class="" width="15"
                                alt="close img">
                        </button>
                    </div>
                    <div class="container-fluid">
                        <!-- Modal body -->
                        <div class="modal-body ">
                            <video width="100%" controls>
                                <source id="video_stop-d" src="{{ asset('assets/images/videofile.mp4') }}"
                                    type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Video Modal End-->



    @endsection
