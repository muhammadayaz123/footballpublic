@extends('layout.app')

@section('content')
      <!-- .................Home Page Start ......................... -->
    <div class="container-fluid px-0 mx-0 ">
        <!-- .................Home Page NavBar Start ......................... -->


        <div class="container-fluid px-xl-5 px-3">
            <div class="row pt-4 pb-3">
                <div class="col-xl-8 col-lg-8 col-md-8 col-12 d-flex order-md-1 order-2">
                    {{--  <a class="td_none-s" href="{{ url('more') }}">
                        <h4 class="pr-2 text-dark fs_sm_21px-s">More</h4>
                    </a>
                    <h4 class="px-2 fs_sm_21px-s"><strong>/</strong></h4>  --}}
                    <h4 class="fg_green-s fs_sm_21px-s pl-2">Help</h4>
                </div>
            </div>
        </div>
        <!-- .................Home Page NavBar End ......................... -->


        <!-- container for favorite players - start -->
        <div class="container-fluid bg-white br_47px-s mh_86vh-s">
            <label class="chat_button-s">
            <img src="{{ asset('assets/images/bot_chat.svg') }}" id="chat_icon-d"  alt="chat icon">
           </label>
            <div class="wrapper border br_10px-s d-none py-3" id="wrapper-d">
                <div class="row px-3 border-bottom">
                    <div class="col-12 chat_header-s fg_green-s mb-3">
                        <h6 class="mb-0">Welcome to the ChatBot</h6>
                    </div>
                </div>
                <div class="container-fluid  message_container-d w_439px_h_633px-s">

                    <div class="row pt-3 px-3">
                        <div class="col-2 px-0 align-self-end">
                            <div class="">
                                <img class="" src="{{ asset('assets/images/bot_chat_icon.svg') }}" alt="bot chat">
                            </div>
                        </div>
                        <div class="col-7 py-2 br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap">
                            <p>sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar
                            </p>
                        </div>
                    </div>

                    {{--  @dd($chatBoxAllMessages)  --}}

                    @foreach ($chatBoxAllMessages as $messages)
                        {{--  @dd($messages)  --}}
                        @if ($messages->user_id == Auth::user()->id)
                            <div class="row py-4 px-3 justify-content-end">
                                <div class="col-7 py-2 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                    <p>
                                        {{ $messages->message }}
                                    </p>
                                </div>
                            </div>

                        @else
                            <div class="row pt-3 px-3 chat_box_message-d">
                                <div class="col-2 px-0 align-self-end">
                                    <div class="">
                                        <img class="" src="{{ asset('assets/images/bot_chat_icon.svg') }}" alt="bot chat">
                                    </div>
                                </div>
                                <div class="col-7 py-2 br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap">
                                    <p>sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar
                                    </p>
                                </div>
                            </div>

                        @endif
                    @endforeach

                        {{-- <div class="row py-4 px-3 justify-content-end user_send_message-d d-none">
                            <div class="col-7 py-2 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                <p class="user_message-d">
                                </p>
                            </div>
                        </div> --}}

                        {{-- <div class="row pt-3 px-3 chat_box_message-d d-none">
                            <div class="col-2 px-0 align-self-end">
                                <div class="">
                                    <img class="" src="{{ asset('assets/images/bot_chat_icon.svg') }}" alt="bot chat">
                                </div>
                            </div>
                            <div class="col-7 py-2 br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap">
                                <p class="reciever_message-d">
                                </p>
                            </div>
                        </div> --}}

                </div>
                <form action="{{ route('chatBoxSendMessage') }}" class="chat_box_send_message-d" method="post">
                    @csrf
                    <div class="row py-2 px-3">
                        <div class="col-12">
                            <div class="input-group word-break word-wrap br_10px-s shadow">
                                <textarea type="textarea" name="message" placeholder="Type your message....." class="  form-control py-1 br_left_10px-s h-100 send_chat_box_message-d textarea_resize_none-s ft_size_14px-s border-0 " id="simple-chat-message"></textarea>
                                <div class="input-group-append ">
                                    <button type="submit" class="border-0 br_right_top_bottom_10px-s py-2 px-1 bg-white  h_50px-s align-self-center" >
                                        <img src="{{ asset('assets/images/chat_send_icon.svg') }}" alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row pt-5 px-xl-4">
                <div class="col-12">
                    <h3 class="fg_green-s">FAQs</h3>
                </div>
            </div>
            <div class="row py-5 px-xl-4">
                <div class="col-12">
                    <div class="accordion" id="help_accordion-d">
                        <div class="card border-0">
                            <div class="card-header border-0 bg-white px-0 d-flex justify-content-between" id="benefits-d">
                                <button class="btn btn-link btn-block px-0 text-left text-dark focus_none-s button_click-s td_none-s d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#benefits_content-d" aria-expanded="true" aria-controls="benefits_content-d">
                          <div>
                            <h5><strong>What are the benefits?</strong></h5>
                          </div>
                          <div class=" text-right dropdown_img_change-d">
                            <img src="{{ asset('assets/images/arrow_up.svg') }}" class="dropdown_img-s" alt="">
                          </div>
                        </button>
                            </div>
                            <div id="benefits_content-d" class="collapse show" aria-labelledby="benefits-d" data-parent="#help_accordion-d">
                                <div class="card-body px-0">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde
                                    omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem
                                    quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci
                                    velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem
                                </div>
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <div class="card border-0">
                            <div class="card-header border-0 px-0 bg-white" id="remove_Account-d">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block px-0 text-left d-flex justify-content-between button_click-s collapsed text-dark focus_none-s td_none-s" type="button" data-toggle="collapse" data-target="#remove_Account_content-d" aria-expanded="false" aria-controls="remove_Account_content-d">
                            <div>
                              <h5><strong>How to remove account?</strong></h5>
                            </div>
                            <div class="text-right dropdown_img_change-d">
                              <img src="{{ asset('assets/images/arrow_down.svg') }}" class="dropdown_img-s" alt="">
                            </div>
                          </button>
                                </h2>
                            </div>
                            <div id="remove_Account_content-d" class="collapse" aria-labelledby="remove_Account-d" data-parent="#help_accordion-d">
                                <div class="card-body px-0">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde
                                    omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem
                                    quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci
                                    velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem
                                </div>
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <div class="card border-0">
                            <div class="card-header border-0 px-0 bg-white" id="app_work-d">
                                <h2 class="mb-0">
                                    <button class="btn btn-link px-0 btn-block text-left collapsed text-dark focus_none-s td_none-s d-flex justify-content-between button_click-s" type="button" data-toggle="collapse" data-target="#app_work_content-d" aria-expanded="false" aria-controls="app_work_content-d">
                            <div>
                              <h5><strong>How this app works?</strong></h5>
                            </div>
                            <div class="text-right dropdown_img_change-d">
                              <img src="{{ asset('assets/images/arrow_down.svg') }}" class="dropdown_img-s" alt="">
                            </div>
                          </button>
                                </h2>
                            </div>
                            <div id="app_work_content-d" class="collapse" aria-labelledby="app_work-d" data-parent="#help_accordion-d">
                                <div class="card-body px-0">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde
                                    omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem
                                    quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci
                                    velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem
                                </div>
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <div class="card border-0">
                            <div class="card-header border-0 bg-white px-0" id="when_used-d">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block px-0 text-left collapsed text-dark focus_none-s td_none-s d-flex justify-content-between button_click-s" type="button" data-toggle="collapse" data-target="#when_used_content-d" aria-expanded="false" aria-controls="when_used_content-d">
                            <div>
                              <h5><strong>When can be used?</strong></h5>
                            </div>
                            <div class="text-right dropdown_img_change-d">
                              <img src="{{ asset('assets/images/arrow_down.svg') }}" class="dropdown_img-s" alt="">
                            </div>
                          </button>
                                </h2>
                            </div>
                            <div id="when_used_content-d" class="collapse" aria-labelledby="when_used-d" data-parent="#help_accordion-d">
                                <div class="card-body px-0">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde
                                    omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem
                                    quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci
                                    velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem
                                </div>
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
              <div class="col-12 text-right">
                <img src="assets/images/bot_chat.svg" class="sticky-bottom" alt="chat icon">
              </div>
            </div>   -->

        </div>
        <!-- container for favorite players - end -->
    </div>
    <!-- .................Home Page End ......................... -->
@endsection
