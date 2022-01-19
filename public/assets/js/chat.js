$(document).ready(function () {
    //socket reciever s

    function  updateStatusChat(chat_uuid, user_id) {
          socket.emit('for_all_send', {
            'type': 'status_changed',
            'additional_data': {chat_uuid, user_id },
        });

    }

    $('form').each(function () {
        if ($(this).data('validator'))
            $(this).data('validator').settings.ignore = ".note-editor *";
    });



        socket.on('for_all_recieve', function (data) {
            if(data.type == 'status_changed')
            {
                let user_data = data;
                console.log('user_data: ', user_data);

                let user_id = data.additional_data.user_id;
                let chat_uuid = data.additional_data.chat_uuid;

                 let data_src =   $(".user_chats_messages-d").attr("data-src");
                    console.log('data_src: ', data_src);

                if((current_user_id == user_id) &&  (chat_uuid == data_src ))
                {
                    $(".update_status-d").text("R");
                    // $.ajax({
                    //     type: "method",
                    //     url: "url",
                    //     data: "data",
                    //     dataType: "dataType",
                    //     success: function (response) {

                    //     }
                    // });
                }
            }
        })

            socket.on('for_all_recieve', function(data) {
                // console.log('recieve_data', data );
                // console.log('delete_data', data );
                if(data.type == 'send_football_message')
                {
                    let consoledata = data;
                    console.log('consoledata: ', consoledata);

                    let reciver_data = data.additional_data.data[0].message;
                    console.log('reciver_data: ', reciver_data);
                    let reciever_id = data.additional_data.data[0].reciever;
                    console.log('reciever_id: ', reciever_id);


                    let unread_count = data.additional_data.data[0].unread_count.unread_count;
                    console.log('unread_count: ', unread_count);


                    let user_id = reciver_data.sender.user_id;
                    console.log('user_id: ', user_id);

                    let chat_uuid = data.additional_data.data[1][0].uuid;
                    console.log('chat_uuid: ', chat_uuid);

                    let show_un_read_user = data.additional_data.data[1][0].members;

                    let show_un_read_user_d = "";

                    $(show_un_read_user).each(function(i,e) {
                        console.log(e.member_id == user_id);
                        if(e.member_id != user_id)
                        {
                            show_un_read_user_d = data.additional_data.data[1][0].members[0].uuid;

                        }else {
                            show_un_read_user_d = data.additional_data.data[1][0].members[1].uuid;
                        }
                    });

                    console.log(show_un_read_user_d);

                    // return false;



                    // let show_un_read_user = data.additional_data.data[1][0].members[0].uuid;
                    // console.log('show_un_read_user: ', show_un_read_user);

                    let get_class_single_chat_list = '.chat_single_user-d2' + show_un_read_user_d;
                    console.log('get_class_single_chat_list: ', get_class_single_chat_list);

                    // $(get_class_single_chat_list).find('.show_unread_count-d').text(unread_count).parent().removeClass('d-none');

                    // return false;

                    let date = reciver_data.created_at;
                    let new_date = new Date(date);
                    let time =  new_date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });


                    let sender_image = public_path+reciver_data.sender.profile_image;
                    let message = reciver_data.message;
                    if(message == null)
                    {
                        message = '';
                    }
                    let message_uuid = reciver_data.uuid;
                    console.log('message_uuid: ', message_uuid);
                    let message_id = reciver_data.id;
                    console.log('message_id: ', message_id);

                    let rev = ''
                    // console.log(current_user_id,reciver_data.sender.id );

                    let data_src =   $(".user_chats_messages-d").attr("data-src");
                    console.log('data_src: ', data_src);

                    if((current_user_id != reciver_data.sender.id) && (current_user_id == data.additional_data.data[0].reciever) && (data_src == chat_uuid))
                    {

                        $.ajax({
                            type: "get",
                            url: unreadChatCount,
                            data: {chat_uuid: chat_uuid},
                            dataType: "json",
                            success: function (response) {
                                console.log('response:234234234 ', response);

                            }
                        });

                        if(reciver_data.reply_msg_id == null)
                        {
                            let reciever_image_message = reciver_data.file_path;

                            let selector = '.uuid2_'+message_uuid;
                            rev=`<div class="row py-3 pl-2 pr-xl-4 uuid2_${message_uuid}">
                                    <div class="col-md-7 col-9 ml-md-0 pr-2  pt-3 d-flex">
                                        <div class="mx-2 align-self-end">
                                            <div class="profile_img_in_chat-s reciever_image-d">
                                                <img class="img_set_to_div-s" src="${sender_image}" alt="">
                                            </div>
                                        </div>
                                        <div class=" br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap px-3 py-3 w-100">
                                        <p class="reciever_message-d mb-0 text-wrap text-break">
                                            <img src="${reciever_image_message}" class="reciever_message_image-d" width="100" height="100" />
                                        ${message}
                                        </p>
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-5 px-0 align-self-center">

                                        <div class="replay_message-d cursor_pointer-s" data-src=${message_uuid}>
                                                <span class="">
                                                    <img class=""  width="17" height="17"  src="${public_path}images/chat_reply_icon.svg" alt="">
                                                    <input type="hidden" class="delete_message_uuid-d" value=${message_uuid} />
                                                </span>
                                                <input type="hidden" class="user_profile_uuid" value=${reciever_id} />
                                                <input type="hidden" class="chat_uuid_for_replay-d" value=${reciever_id} />
                                                <input type="hidden" class="chat_message_id-d" value=${message_id} />
                                                <input type="hidden" class="reply_message_time-d" value=${time} />
                                        </div>

                                    </div>
                                    <div class="col-11 ml-5">
                                        <span class="ft_11px-s reciever_time-d"> ${time}  | <span class="fg_green-s update_status-d">R</span></span>
                                    </div>
                                </div>`

                                $('.col-d2').append(rev);

                                if(reciever_image_message == null)
                                {
                                    $(selector).find(".reciever_message_image-d").addClass("d-none")
                                }else {
                                    $(selector).find(".reciever_message_image-d").removeClass("d-none")

                                }

                                updateStatusChat(chat_uuid, user_id);
                                    // socket.emit('for_all_send', {
                                    //     'type': 'status_changed',
                                    //     'additional_data': {chat_uuid, user_id },
                                    // });

                        }
                        else {



                            // let sender_username = e.sender.username;
                            //         console.log('sender_username: ', sender_username);

                            //         let replay_time = e.reply_message.created_at;
                            //         let date = new Date(replay_time);
                            //         let change_format_time = date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });


                            //         console.log('replay_time: ', replay_time);

                                    // let replay_message = e.reply_message.message;
                                    // console.log('replay_message: ', replay_message);

                                    // let reply_image_message  = e.reply_message.file_path;
                                    // console.log('reply_image_message: ', reply_image_message);

                                    // let image = e.file_path;

                                    // let selector = '.uuid2_'+message_uuid;





                                let sender_username = reciver_data.sender.first_name + reciver_data.sender.last_name;
                                console.log('sender_username: ', sender_username);
                                if(reciver_data.sender_id == reciver_data.reply_message.sender_id)
                                {
                                    sender_username = reciver_data.sender.first_name +" " +  reciver_data.sender.last_name;
                                }

                                else{
                                        sender_username = "You";
                                }


                                let replay_time = reciver_data.reply_message.created_at;
                                console.log('replay_time: ', replay_time);

                                let date = new Date(replay_time);
                                let change_format_time = date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });




                                let replay_message = reciver_data.reply_message.message;
                                console.log('replay_message: ', replay_message);

                                if(replay_message == null)
                                {
                                    replay_message = '';
                                }


                                let reply_image_message  = reciver_data.reply_message.file_path;
                                console.log('reply_image_message: ', reply_image_message);

                                let image = reciver_data.file_path;

                                let selector = '.uuid2_'+message_uuid;


                            rev =`<div class="row py-3 pl-2 pr-xl-4 uuid2_${message_uuid}">
                                <div class="col-md-7 col-9 ml-md-0 pr-2  pt-3 d-flex  ">
                                        <div class="ml-2 mr-1 align-self-end">
                                            <div class="profile_img_in_chat-s reciever_image-d">
                                                <img class="img_set_to_div-s" src="${sender_image}" alt="">
                                            </div>
                                        </div>
                                        <div class="row ft_size_12px-s bg-greenish_grey-s word-break word-wrap br_10x10-s mx-1 px-3 pt-3 pb-2 w-100">
                                            <div class="col-12 py-2 bg-white br_5px-s">
                                                <strong class="ft_14px-s fg_green-s">${sender_username}</strong><span class="text-dark float-right">${change_format_time}</span>
                                                    <img src="${reply_image_message}" class="reply_message_image-d d-none mt-1" width="40" height="40" />

                                                <p class="text-dark mb-0 text-wrap text-break">${replay_message}
                                                </p>
                                            </div>

                                            <p class="reciever_message-d mb-0 mt-2 text-wrap text-break">
                                                <img src="${image}" class="reciever_message_image-d d-none" width="40" height="40" />
                                                ${message}
                                            </p>
                                        </div>

                                    </div>
                                    <div class="col-3 col-md-5 px-0 align-self-center">
                                        <div class="replay_message-d cursor_pointer-s" data-src=${message_uuid}>
                                            <span class="">
                                                <img class=" "  width="17" height="17"  src="${public_path}images/chat_reply_icon.svg" alt="">
                                                <input type="hidden" class="delete_message_uuid-d" value=${message_uuid} />
                                            </span>
                                            <input type="hidden" class="user_profile_uuid" value=${reciever_id} />
                                            <input type="hidden" class="chat_uuid_for_replay-d" value=${reciever_id} />
                                            <input type="hidden" class="chat_message_id-d" value=${message_id} />
                                            <input type="hidden" class="reply_message_time-d" value=${time} />
                                        </div>
                                    </div>
                                    <div class="col-11 ml-5">
                                        <span class="ft_11px-s reciever_time-d"> ${time}  | <span class="fg_green-s update_status-d">R</span></span>
                                    </div>
                                </div>`

                                $('.col-d2').append(rev);
                                 //  $('.get_messages-d').find('.col-d2').append(rev2);
                                if(reply_image_message == null)
                                {
                                    $(selector).find(".reply_message_image-d").addClass("d-none")
                                }else {
                                    $(selector).find(".reply_message_image-d").removeClass("d-none")

                                }

                                if(image == null) {
                                console.log(selector);
                                $(selector).find(".reciever_message_image-d").addClass("d-none");
                                // $('.close_upload_img-d').attr('src', '').parent().addClass("d-none");

                                } else {
                                    // $(selector).find(".show_upload_image-d").attr('src', '').addClass("d-none");
                                    $(selector).find(".reciever_message_image-d").removeClass("d-none");

                                }


                                updateStatusChat(chat_uuid, user_id);


                        }
                    }
                    else {



                        // $(".fg_green-s").text("R");

                        $(get_class_single_chat_list).find('.show_unread_count_div-d').removeClass('d-none');
                        $(get_class_single_chat_list).find('.show_unread_count-d').text(unread_count).parent().removeClass('d-none');

                    }

                }

                if(data.type == 'delete_football_message')
                {
                    console.log('delete_message', data);
                    let message_uuid = data.additional_data[1];
                    let reciever_uuid = data.additional_data[2];
                    let parseIntReciver_id = parseInt(reciever_uuid);
                    console.log('message_uuid: ', message_uuid);


                    if(current_user_id != parseIntReciver_id)
                    {
                        console.log(current_user_id ,  parseIntReciver_id);

                        let div = $(`.delete_message-${message_uuid}`);
                        div.remove();
                    }
                }

            });

            // $(".get_single_chat_user-d").removeClass("d-none");


    // alert(current_user_id);
    $(".single_chat_user-d").on('click', function(){
            let elm = $(this);
            $(".single_chat_user-d").removeClass("br_on_active-s");
            $(elm).addClass("br_on_active-s");
            // $(".get_single_chat_user-d").addClass("d-none");

            let chat_uuid =  elm.find(".chat_uuid_single_chat-d").val();
            let user_id =  elm.find(".current_chat_user_id-d").val();


            console.log('chat_uuid : ', chat_uuid );
            $(".chat_uuid-d").val(chat_uuid);
            // $(this).off('click');
            // return false;
            let member_id =$(".chat_member_id-d").val();
            console.log('member_id: ', member_id);

            // console.log('chat_uuid: ', chat_uuid);
            // return false;
            // if(".user_chats_messages-d".length )
            // $(".user_chats_messages-d").empty();

            $("#append_chat-d").removeAttr("style");
            // $("#append_chat-d").removeAttr("style");


            let read_count = 0;
            $(elm).find(".unread_count-d").text(read_count);
            $(elm).find(".unread_count-d").addClass('d-none');
            let image = $(elm).find(".get_user_chat_image-d").attr("src");
            let name = $(elm).find(".get_user_chat_name-d").text();
            let username = $(elm).find(".get_user_chat_username-d").text();

            console.log('image: ', image);

            $(".user_image-d").attr('src', image);
            $(".user_name-d").text(name);
            $(".reply_user_name-d").val(name);
            $(".user_username-d").text(username);


            // $(".user_chats_messages-d").addClass(div_uuid);
            $(".user_chats_messages-d").attr("data-src" , chat_uuid);

            updateStatusChat(chat_uuid, user_id);


            $(`.col-d2`).empty();


            // console.log('chat_uuid: ', chat_uuid);
            $.ajax({
                type: "GET",
                url: singleChat,
                data: {chat_uuid: chat_uuid, member_id: member_id},
                dataType: "json",
                beforeSend: function() {
                    showPreLoader();
                },
                success: function (response) {

                    // response
                    console.log('response: ', response);
                    // return false;
                    if($("#append_chat-d").hasClass('d-none'))
                    {
                        $("#append_chat-d").removeClass("d-none");
                        $(".chat_member_list_container-d").addClass("d-none");


                        let scroll_bottom = $('.bg_img-s');
                        scroll_bottom.scrollTop(scroll_bottom.prop("scrollHeight"));
                    }

                    // return false;

                    let reciever_data =response.getMessagesUser.chat.members[0].user;
                    console.log('reciever_data: ', reciever_data);
                    // return false;

                    // $(".user_chats_messages-d").show();

                    // $(`.col-d2`).empty();


                      let dateada = reciever_data.created_at;
                      let new_dateadas = new Date(dateada);
                      let ampm = new_dateadas.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });

                        var d = new Date();
                        let current_date =  (d.getDate()+'/'+(d.getMonth()+1)+'/'+  d.getFullYear());


                        let div_date = ` <div class="row">
                                            <div class="col-12 d-flex justify-content-center fs_12px-s mt-3">
                                                <span class=""> Today <span>${current_date}</span> </span>
                                            </div>
                                        </div>`

                                $('.col-d2').append(div_date);

                      let get_messages = response.getMessagesUser.messages;



                        // $(".user_image-d").attr('src', public_path+reciever_data.profile_image);
                        // $(".user_name-d").text(reciever_data.first_name + ' '+ reciever_data.last_name);
                        // $(".user_username-d").text("@"+reciever_data.username );
                        // $(`.delete-chat-d`).attr("href",`${deleteChat}/${chat_uuid}`);
                        let receiver_user_uuid = reciever_data.user.uuid;
                        let receiver_user_profile_uuid = reciever_data.uuid;
                        let receiver_user_profile_id = reciever_data.id;

                        console.log(otherProfile);
                        let getOtherProfile = otherProfile;

                        let get_url = getOtherProfile.replace(':uuid', receiver_user_uuid ).replace(':profile_uuid', receiver_user_profile_uuid).replace(':user_profile_id', receiver_user_profile_id);
                            console.log('get_url: ', get_url);

                            // return false;
                            $(".send_user_other_profile-d").attr("href", get_url);
                            // $(".send_user_other_profile-d2").attr("href", get_url);

                        // let div= '';
                        // let rev = ''

                        console.log(reciever_data.is_blocked_user);

                        if(reciever_data.is_blocked_user == 0)
                        {

                              if($(".open_flag_to_report-d").attr("data-target") == '')
                            {
                                // console.log('ok');

                                let flag = '#report_issue_modal-d-'+ reciever_data.uuid;

                                console.log('flag: ', flag);

                                $(".open_flag_to_report-d").attr("data-target", flag);

                                let flag_modal = 'report_issue_modal-d-'+ reciever_data.uuid;
                                console.log('flag_modal: ', flag_modal);

                                $(".open_flag_to_report_modal-d").attr("id", flag_modal);
                            }
                            else {
                                console.log("not ok");
                            }



                            $(".player_id-d").val(reciever_data.id);

                            $(".reported_flag-d").addClass('d-none');
                            $(".report_flag-d").removeClass('d-none');


                        }
                        else if(reciever_data.is_blocked_user == 1){
                            $(".report_flag-d").addClass('d-none');
                            $(".reported_flag-d").removeClass('d-none');

                        }




                        $.each(get_messages, function (i, e) {

                            console.log(e, "sdfsdjkfhsdjkfhsdkjfh");

                            let date = e.created_at;
                            console.log('date: ', date);
                            let new_date = new Date(date);

                            // console.log('current_date: ', current_date);
                            // let current_date = new_date.toISOString().split('T')[0];

                            let time =  new_date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
                            console.log(time);
                            let message = e.message;
                            if(message == null)
                            {
                                message = '';
                            }

                            let message_id = e.id;

                            let message_uuid = e.uuid;
                            // console.log('message_uuid: ', message_uuid);

                            let sender_image = public_path+e.sender.profile_image;


                            if(current_user_id == e.sender.id)
                            {
                                console.log(e, "sender1234332");
                                // return false;
                                let sender_id = e.sender.id;
                                console.log("sender_id", current_user_id , e.sender.id);
                                let image_message  = e.file_path;
                                console.log('image_message: ', image_message);
                                    // return false;
                                    let read_status = e.is_read;
                                    console.log('is_read: ', read_status);
                                    // if(current_user_id == e.reciever_id)
                                    // {
                                    //     is_read = e.is_read;
                                    // }
                                    // else {
                                    //     is_read = 'S';
                                    // }

                                if(null == e.reply_msg_id)
                                {
                                    // debugger;
                                    let selector = '.uuid2_'+message_uuid;

                                   let div2 =  `<div class="row py-3 justify-content-end delete_message-${message_uuid} uuid2_${message_uuid}">
                                                        <div class="col-xl-12 col-md-12 col-12 pr-4 align-self-end text-right">
                                                            <div class="dropdown">
                                                                <a type="" class="text-dark opacity_4-s" role="button" data-toggle="dropdown">
                                                                    <i class="fa fa-ellipsis-v"></i>
                                                                </a>

                                                                <div class="dropdown-menu"  >
                                                                    <input type="hidden" class="user_profile_uuid" value=${sender_id} />
                                                                    <div class = "delete_message-d cursor_pointer-s" data-src=${message_uuid}>
                                                                        <span class="ml-4">
                                                                            <img class="mr-4 w_chat_read_icon-s " src="${public_path}images/delete_icon.svg" alt="" >
                                                                            <span >Delete</span>
                                                                            <input type="hidden" class="delete_message_uuid-d" value=${message_uuid} />
                                                                        </span>
                                                                        <input type="hidden" class="user_profile_uuid" value=${sender_id} />

                                                                    </div>
                                                                    <div class="replay_message-d cursor_pointer-s" data-src=${message_uuid}>
                                                                        <span class="ml-4">
                                                                            <img class="mr-4 w_chat_read_icon-s " src="${public_path}images/chat_reply_icon.svg" alt="" >
                                                                            <span >Quote </span>
                                                                            <input type="hidden" class="delete_message_uuid-d" value=${message_uuid} />
                                                                        </span>
                                                                        <input type="hidden" class="user_profile_uuid" value=${sender_id} />
                                                                        <input type="hidden" class="chat_uuid_for_replay-d" value=${sender_id} />
                                                                        <input type="hidden" class="chat_message_id-d" value=${message_id} />
                                                                        <input type="hidden" class="reply_message_time-d" value=${time} />
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    <div class="col-7 col-xl-5 col-lg-6 col-md-5 py-3 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                                        <p class="sender_message-d mb-0 text-wrap text-break">
                                                            <img src="${image_message}" class="show_upload_image-d mr-2" width="100" height="100" />
                                                                ${message}
                                                        </p>
                                                    </div>
                                                    <div class="ml-2 mr-3 align-self-end">

                                                    </div>

                                                    <div class="col-11 pr-0 mr-4 text-right">
                                                        <span class="ft_11px-s sender_message_time-d"> ${time}| <span class="fg_green-s update_status-d">${read_status}</span></span>
                                                    </div>





                                                </div>`

                                    $('.col-d2').append(div2);

                                    if(image_message == null)
                                    {
                                        $(selector).find(".show_upload_image-d").addClass("d-none")
                                    }else {
                                        $(selector).find(".show_upload_image-d").removeClass("d-none")

                                    }

                                    // return;

                                }
                                else {


                                      console.log(e.reply_msg_id, "asdasdas");
                                    // let replay_message_uuid = e.reply_message.uuid;
                                    // let reciever_username = $(".user_name-d").text();
                                    let reciever_username = name;
                                    console.log('reciever_username: ', reciever_username);

                                    if(e.sender_id ==  e.reply_message.sender_id)
                                    {
                                        reciever_username = "You";
                                    }


                                    let replay_time = e.reply_message.created_at;
                                    console.log('replay_time: ', replay_time);
                                    let date = new Date(replay_time);

                                    let change_format_time = date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
                                    console.log('change_format_time: ', change_format_time);


                                    let replay_message = e.reply_message.message;
                                    // console.log('replay_message: ', replay_message);
                                    if(replay_message == null)
                                    {
                                        replay_message = '';
                                    }

                                    console.log(e, "asdasdasd");
                                    // // return false;
                                    let reply_image_message  = e.reply_message.file_path;
                                    console.log('reply_image_message: ', reply_image_message);

                                    // let image = $(".image_url-d").attr('src');
                                    //             console.log('image: ', image);

                                    let image = e.file_path;

                                                // return false;

                                    let selector = '.uuid2_'+message_uuid;


                                      let div1 =  `<div class="row py-3 justify-content-end delete_message-${message_uuid} uuid2_${message_uuid} ">
                                                    <div class="col-xl-12 col-md-12 col-12 pr-4 align-self-end text-right">
                                                        <div class="dropdown">
                                                            <a type="" class="text-dark opacity_4-s" role="button" data-toggle="dropdown">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </a>

                                                            <div class="dropdown-menu"  >
                                                                <input type="hidden" class="user_profile_uuid" value=${sender_id} />
                                                                <div class = "delete_message-d cursor_pointer-s" data-src=${message_uuid}>
                                                                    <span class="ml-4">
                                                                        <img class="mr-4 w_chat_read_icon-s " src="${public_path}images/delete_icon.svg" alt="" >
                                                                        <span >Delete</span>
                                                                        <input type="hidden" class="delete_message_uuid-d" value=${message_uuid} />
                                                                    </span>
                                                                    <input type="hidden" class="user_profile_uuid" value=${sender_id} />

                                                                </div>
                                                                <div class="replay_message-d cursor_pointer-s" data-src=${message_uuid}>
                                                                    <span class="ml-4">
                                                                        <img class="mr-4 w_chat_read_icon-s " src="${public_path}images/chat_reply_icon.svg" alt="" >
                                                                        <span >Quote </span>
                                                                        <input type="hidden" class="delete_message_uuid-d" value=${message_uuid} />
                                                                    </span>
                                                                    <input type="hidden" class="user_profile_uuid" value=${sender_id} />
                                                                    <input type="hidden" class="chat_uuid_for_replay-d" value=${sender_id} />
                                                                    <input type="hidden" class="chat_message_id-d" value=${message_id} />
                                                                    <input type="hidden" class="reply_message_time-d" value=${time} />
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                            <div class="col-7 col-xl-5 col-lg-6 col-md-5 py-2 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                                <div class="row">
                                                    <div class="col px-3 mx-3 mt-2 py-2 bg-white br_5px-s">
                                                        <strong class="ft_14px-s fg_green-s">${reciever_username}</strong><span class="text-dark float-right">${change_format_time}</span><br>
                                                            <img src="${reply_image_message}" class="reply_message_image-d d-none mt-1" width="40" height="40" />

                                                        <p class="text-dark mb-0 text-wrap text-break">${replay_message}

                                                        </p>
                                                    </div>
                                                </div>
                                                <p class="mt-2 mb-0 sender_message-d text-wrap text-break">
                                                    <img src="${image}" class="show_reply_image_over-d d-none" width="40" height="40" />
                                                    ${message}
                                                </p>
                                            </div>


                                            <div class="ml-2 mr-3 align-self-end">

                                            </div>

                                            <div class="col-11 pr-0 mr-4 text-right">
                                                <span class="ft_11px-s sender_message_time-d"> ${time}| <span class="fg_green-s update_status-d">${read_status}</span></span>
                                            </div>







                                        </div>`

                                         $('.col-d2').append(div1);
                                        //   $('.get_messages-d').find('.col-d2').append(div1);
                                        //  return;

                                        if(reply_image_message == null)
                                        {
                                            $(selector).find(".reply_message_image-d").addClass("d-none")
                                        }else {
                                            $(selector).find(".reply_message_image-d").removeClass("d-none")

                                        }

                                        if(image == null) {
                                            console.log(selector);
                                            $(selector).find(".show_reply_image_over-d").addClass("d-none");
                                            // $('.close_upload_img-d').attr('src', '').parent().addClass("d-none");

                                        } else {
                                            // $(selector).find(".show_upload_image-d").attr('src', '').addClass("d-none");
                                            $(selector).find(".show_reply_image_over-d").removeClass("d-none");

                                        }


                                }

                            }
                            else {
                                let reciever_id = e.sender.id;
                                console.log('reciever_id: ', reciever_id);

                                console.log(e, "reciever");
                                // console.log(current_user_id , e.sender.id);
                                let reciever_image_message  = e.file_path;

                                if(null == e.reply_msg_id)
                                {
                                    let selector = '.uuid2_'+message_uuid;

                                    let rev1 =  `<div class="row py-3 pl-2 pr-xl-4 uuid2_${message_uuid} ">
                                                    <div class="col-md-7 col-9 ml-md-0 pr-2  pt-3 d-flex ">
                                                        <div class="mx-2 align-self-end">
                                                            <div class="profile_img_in_chat-s reciever_image-d">
                                                                <img class="img_set_to_div-s" src="${sender_image}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap py-3 px-3 w-100">
                                                            <p class="reciever_message-d mb-0 text-wrap text-break">
                                                                <img src="${reciever_image_message}" class="reciever_message_image-d" width="100" height="100" />

                                                                ${message}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 col-md-5 px-0 align-self-center">
                                                        <div class="replay_message-d cursor_pointer-s" data-src=${message_uuid}>
                                                            <span class="">
                                                                <img class="" width="17" height="17" src="${public_path}images/chat_reply_icon.svg" alt="" >
                                                                <input type="hidden" class="delete_message_uuid-d" value=${message_uuid} />
                                                            </span>
                                                            <input type="hidden" class="user_profile_uuid" value=${reciever_id} />
                                                            <input type="hidden" class="chat_uuid_for_replay-d" value=${reciever_id} />
                                                            <input type="hidden" class="chat_message_id-d" value=${message_id} />
                                                            <input type="hidden" class="reply_message_time-d" value=${time} />
                                                        </div>
                                                    </div>
                                                    <div class="col-11 ml-5">
                                                        <span class="ft_11px-s reciever_time-d"> ${time}  | <span class="fg_green-s update_status-d">R</span></span>
                                                    </div>
                                            </div>`

                                    $('.col-d2').append(rev1);

                                     if(reciever_image_message == null)
                                        {
                                            $(selector).find(".reciever_message_image-d").addClass("d-none")
                                        }else {
                                            $(selector).find(".reciever_message_image-d").removeClass("d-none")

                                        }


                                }
                                else {

                                    console.log(e);
                                    console.log(reciever_id);
                                    let sender_username = e.sender.first_name + e.sender.last_name;
                                    console.log('sender_username: ', sender_username);

                                    if(e.sender_id ==  e.reply_message.sender_id)
                                    {
                                        sender_username =  e.sender.first_name +" " + e.sender.last_name;
                                    }
                                    else{
                                        sender_username = "You";
                                    }


                                    let replay_time = e.reply_message.created_at;
                                    let date = new Date(replay_time);
                                    let change_format_time = date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });


                                    console.log('replay_time: ', replay_time);

                                    let replay_message = e.reply_message.message;
                                    console.log('replay_message: ', replay_message);
                                    if(replay_message == null)
                                    {
                                        replay_message = '';
                                    }

                                    let reply_image_message  = e.reply_message.file_path;
                                    console.log('reply_image_message: ', reply_image_message);

                                     let image = e.file_path;

                                    let selector = '.uuid2_'+message_uuid;


                                    let rev2 =`<div class="row py-3 pl-2 pr-xl-4 uuid2_${message_uuid} ">
                                        <div class="col-md-7 col-9 ml-md-0 pr-2  pt-3 d-flex">
                                            <div class="ml-2 mr-1 align-self-end">
                                                <div class="profile_img_in_chat-s reciever_image-d">
                                                    <img class="img_set_to_div-s" src="${sender_image}" alt="">
                                                </div>
                                            </div>
                                                <div class="row br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap mx-1 px-3 pt-3 pb-2 w-100">
                                                    <div class="col-12 py-2 bg-white br_5px-s">
                                                        <strong class="ft_14px-s fg_green-s">${sender_username}</strong><span class="text-dark float-right">${change_format_time}</span><br>
                                                        <img src="${reply_image_message}" class="reply_message_image-d d-none mt-1" width="40" height="40" />
                                                         <p class="text-dark mb-0 text-wrap text-break">${replay_message}
                                                         </p>
                                                    </div>
                                                    <p class="reciever_message-d mb-0 mt-2 text-wrap text-break">
                                                       <img src="${image}" class="reciever_message_image-d d-none" width="40" height="40" />
                                                        ${message}
                                                    </p>
                                                </div>
                                             </div>
                                            <div class="col-3 col-md-5 px-0 align-self-center">
                                                <div class="replay_message-d cursor_pointer-s" data-src=${message_uuid}>
                                                    <span class="">
                                                        <img class="" width="17" height="17" src="${public_path}images/chat_reply_icon.svg" alt="" >
                                                        <input type="hidden" class="delete_message_uuid-d" value=${message_uuid} />
                                                    </span>
                                                    <input type="hidden" class="user_profile_uuid" value=${reciever_id} />
                                                    <input type="hidden" class="chat_uuid_for_replay-d" value=${reciever_id} />
                                                    <input type="hidden" class="chat_message_id-d" value=${message_id} />
                                                    <input type="hidden" class="reply_message_time-d" value=${time} />
                                                </div>
                                            </div>
                                             <div class="col-11 ml-5">
                                                 <span class="ft_11px-s reciever_time-d"> ${time}  | <span class="fg_green-s update_status-d">R</span></span>
                                             </div>
                                         </div>`

                                         $('.col-d2').append(rev2);
                                        //  $('.get_messages-d').find('.col-d2').append(rev2);
                                         if(reply_image_message == null)
                                        {
                                            $(selector).find(".reply_message_image-d").addClass("d-none")
                                        }else {
                                            $(selector).find(".reply_message_image-d").removeClass("d-none")

                                        }

                                         if(image == null) {
                                            console.log(selector);
                                            $(selector).find(".reciever_message_image-d").addClass("d-none");
                                            // $('.close_upload_img-d').attr('src', '').parent().addClass("d-none");

                                        } else {
                                            // $(selector).find(".show_upload_image-d").attr('src', '').addClass("d-none");
                                            $(selector).find(".reciever_message_image-d").removeClass("d-none");

                                        }

                                }



                            }

                        });
                        let scroll_bottom  = $('.get_messages-d');
                        scroll_bottom .scrollTop(scroll_bottom.prop("scrollHeight"));
                },
                error: function(xhr, message, code) {
                    // console.log(xhr.status, message, code);
                    // return false;
                    response = xhr.responseJSON;
                    if (422 == xhr.status) {
                    // if (response.status == false) {
                        console.log(response.status);
                        let container = $('.password-d').parent();
                        if ($(container).find('.error').length > 0) {
                            $(container).find('.error').remove();
                        }
                        // $(container).append("<span class='error fs_14px-s text-danger'>" + response.message + "</span>");
                        $("#wrong_password-d").removeClass("d-none").text(response.message);
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {

                            location.reload();

                        });


                    }
                    // console.log(xhr, message, code);
                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
    });


    $(".send_message_d").on('keypress' , ".send_msg_on_enter-d" ,function(e) {
        let elm = $(this);
        let form = $(elm).closest('.send_message_d');
        console.log("byyeee");
        // e.stopPropagation();
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code == 13){
            console.log("ignoree");
            $(form).find(".send_button-d").trigger('click');
            return false;
        }
    })

    // send message
$(".send_message_d").each(function() {
    $(this).validate({
        ignore: ".ignore",
        rules: {
            message: {
                    required: function(element){
                        return $("#send_img-d").val().length == 0;
                    }
                },
            // media2: {
            //         required: function(element){
            //             return $("#simple-chat-message").val().length == 0;
            //         }
            //     }
        },
        messages: {
            message: {
                required: "Please enter message",
            },
            // media2: {
            //     required: "Please select image",
            // }

        },
        errorPlacement: function(error, element) {
            // $('#' + error.attr('id')).remove();
            // error.insertAfter(element.closest('div'));
            // $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' fs_14px-s text-danger ml-5" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            // console.log('submit handler');

            console.log('test', $(form).attr('action'));
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response) {
                    if(response.status == true)
                    {
                        let elm = $(this);
                        console.log('elm: ', elm);
                        console.log(response);
                        console.log(response.data[1][0]);
                        // let get_selected_chat_uuid = response.data[1][0].members[0].uuid;
                        // let get_selected_chat_uuid = response.data[1][0].uuid;
                        // let  get_selected_chat =  '.chat_single_user-d'+ get_selected_chat_uuid
                        // console.log('get_selected_chat: ', get_selected_chat);
                        // $(get_selected_chat).find('.last_message-d').text($(".message_send-d").val());
                        // $(get_selected_chat).find('.last_message-d').text($(".message_send-d").val());


                        // $(get_selected_chat).addClass("order-first");

                            // $(".previewImg2").attr("src", "");

                        // return false;

                        let data = response.data[0].message;
                        // console.log(response);

                        // return false;
                        // debugger;

                        let date = data.created_at;
                        console.log('date: ', date);
                        let new_date = new Date(date);
                        console.log(new_date);
                        let time =  new_date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
                        console.log('time: ', time);


                        let chat_message_send_by_user = $(".message_send-d").val();
                        console.log('chat_message_send_by_user: ', chat_message_send_by_user)
                        let uploaded_chat_image = $(".get_link-d").val();
                        console.log('uploaded_chat_image: ', uploaded_chat_image)

                        let  show_chat_message = "";
                        if(chat_message_send_by_user  == "" && uploaded_chat_image !="")
                        {
                            show_chat_message = "sent an image";
                        }
                        else if(chat_message_send_by_user != "" && uploaded_chat_image == "")
                        {
                            show_chat_message =   (chat_message_send_by_user.slice(0, 15)+'...');
                        }
                        else {
                            show_chat_message =   (chat_message_send_by_user.slice(0, 15)+'...');
                        }

                        console.log(show_chat_message, "show_chat_message");


                        let read_count = 0;

                        let get_selected_chat_uuid = response.data[1][0].uuid;
                        let  get_selected_chat =  '.chat_single_user-d'+ get_selected_chat_uuid
                        console.log('get_selected_chat: ', get_selected_chat);
                        $(get_selected_chat).find('.last_message-d').text(show_chat_message);
                        $(get_selected_chat).find('.last_message_time-d').text(time);
                        $(get_selected_chat).find('.show_unread_count-d2').addClass('d-none');


                        $(get_selected_chat).addClass("order-first");




                        let message = data.message;
                        if(null == message)
                        {
                            message = '';
                        }
                        let message_uuid = data.uuid;
                        let message_id = data.id;
                        console.log('message_uuid: ', message_uuid);

                        let sender_image = public_path+data.sender.profile_image;



                        socket.emit('for_all_send', {
                            'type': 'send_football_message',
                            'additional_data': response,
                        });

                        socket.emit('for_all_send', {
                            'type': 'send_chat_message',
                            'additional_data': response,
                        });


                        //
                        let sender_id = data.sender.id;




                        // let user_name = $(".user_name-d").text();


                        let user_name = $(form).find(".reply_user_name-d").val();

                    // for quote response m
                        let quote_val = $(".quote-d").val();
                        if(quote_val == '1')
                        {
                            user_name = "You";
                        }

                        let reply_message = $(form).find(".message_replay-d").text();

                        let replay_time = $(form).find(".reply_msg_time-d").val();

                        let message_send = $(".message_send-d").val();


                        console.log('data.replay_msg_id: ', data.reply_msg_id);

                        let image = $(".image_url-d").attr('src');
                        console.log('image: ', image);


                        let replay_image_send = $(".get_replay_message_t").val();
                        console.log('replay_image_send: ', replay_image_send);


                        $('.col-d2').animate({scrollTop:$(document).height()}, 'slow');


                        if(null != data.reply_msg_id )

                        {
                            // let div_replay =
                            console.log('in reply message');
                            // return false;
                            let selector = '.uuid2_'+message_uuid;

                            let div =  `<div class="row py-3 justify-content-end delete_message-${message_uuid} uuid2_${message_uuid}">

                                            <div class="col-xl-12 col-md-12 col-12 pr-4 align-self-end text-right">
                                                <div class="dropdown">
                                                    <a type="" class="text-dark opacity_4-s" role="button" data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>

                                                    <div class="dropdown-menu"  >
                                                        <input type="hidden" class="user_profile_uuid" value=${sender_id} />
                                                        <div class = "delete_message-d cursor_pointer-s" data-src=${message_uuid}>
                                                            <span class="ml-4">
                                                                <img class="mr-4 w_chat_read_icon-s " src="${public_path}images/delete_icon.svg" alt="" >
                                                                <span >Delete</span>
                                                                <input type="hidden" class="delete_message_uuid-d" value=${message_uuid} />
                                                            </span>
                                                            <input type="hidden" class="user_profile_uuid" value=${sender_id} />

                                                        </div>
                                                        <div class="replay_message-d cursor_pointer-s" data-src=${message_uuid}>
                                                            <span class="ml-4">
                                                                <img class="mr-4 w_chat_read_icon-s " src="${public_path}images/chat_reply_icon.svg" alt="" >
                                                                <span>Quote </span>
                                                                <input type="hidden" class="delete_message_uuid-d" value=${message_uuid} />
                                                            </span>
                                                            <input type="hidden" class="user_profile_uuid" value=${sender_id} />
                                                            <input type="hidden" class="chat_uuid_for_replay-d" value=${sender_id} />
                                                            <input type="hidden" class="chat_message_id-d" value=${message_id} />
                                                            <input type="hidden" class="reply_message_time-d" value=${time} />
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-7 col-xl-5 col-lg-6 col-md-5 py-2 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                            <div class="row">
                                                <div class="col px-3 mx-3 mt-2 py-2 bg-white br_5px-s">
                                                    <strong class="ft_14px-s fg_green-s">${user_name}</strong><span class="text-dark float-right">${replay_time}</span><br>

                                                    <img src="" class="show_upload_image-d d-none mt-1" width="40" height="40" />
                                                    <p class="text-dark mb-0 text-wrap text-break">${reply_message} </p>


                                                </div>
                                            </div>
                                            <div>
                                            </div>
                                            <p class="mt-2 mb-0 text-wrap text-break">
                                                    <img src="" class="show_reply_image-d d-none" width="40" height="40" />

                                                ${message_send}
                                            </p>
                                        </div>



                                        <div class="ml-2 mr-3 align-self-end">

                                        </div>

                                        <div class="col-11 pr-0 mr-4 text-right">
                                            <span class="ft_11px-s sender_message_time-d"> ${time}| <span class="fg_green-s update_status-d">S</span></span>
                                        </div>




                                </div>`

                            $('.get_messages-d').find('.col-d2').append(div);
                            $(".col-d2").stop().animate({ scrollTop: $(".col-d2")[0].scrollHeight}, 1000);

                            $("#simple-chat-message").val('');
                            $(".simple-chat-message").empty();
                            $(".get_link-d").val("");
                            $(".get_link2-d").val("");

                            if(!$(".show_reply_text-d").hasClass('d-none')){

                                $(".show_reply_text-d").removeClass("d-flex").addClass('d-none');
                                $(".show_reply_text-d").find(".reply_msg_id-d").val('');
                                $(".show_reply_text-d").find(".reply_msg_time-d").val('');

                            }

                            if(!$(".hide_upload_image-d").hasClass("d-none"))
                            {
                                console.log("jdhwinjdn");
                                $(".hide_upload_image-d").addClass("d-none");
                                $(".hide_upload_image-d").find(".uploaded_image-d").attr("src", '');
                            }

                            if(image.length > 0){
                                    console.log(selector);
                                    $(selector).find(".show_reply_image-d").attr('src', image).removeClass("d-none");
                                    $('.close_upload_img-d').parent().addClass("d-none");

                                } else {
                                    $(selector).find(".show_upload_image-d").attr('src', '').addClass("d-none");
                                }


                                if(replay_image_send.length > 0){
                                    console.log(selector);
                                    $(selector).find(".show_upload_image-d").attr('src', replay_image_send).removeClass("d-none");

                                        $('.close_upload_img-d').parent().addClass("d-none");
                                }else {
                                    $(selector).find(".show_upload_image-d").attr('src', '').addClass("d-none");

                                }

                                $(".quote-d").val('');
                                //  $(document).scrollTop($(document).height());
                                // $('html, body').animate({ scrollTop: $(document).height() }, 1200);
                                $('.col-d2').animate({scrollTop:$(document).height()}, 'slow');
                                $(".reply_user_name-d").val('');

                            return;

                        }
                        else {
                            console.log('not in reply message');
                            // return false;
                            let selector = '.uuid2_'+message_uuid;
                            let div =  `<div class="row py-3 justify-content-end delete_message-${message_uuid} uuid2_${message_uuid}">
                                            <div class="col-xl-12 col-md-12 col-12 pr-4 align-self-end text-right">
                                                <div class="dropdown">
                                                    <a type="" class="text-dark opacity_4-s" role="button" data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>

                                                    <div class="dropdown-menu"  >
                                                        <input type="hidden" class="user_profile_uuid" value=${sender_id} />
                                                        <div class = "delete_message-d cursor_pointer-s" data-src=${message_uuid}>
                                                            <span class="ml-4">
                                                                <img class="mr-4 w_chat_read_icon-s " src="${public_path}images/delete_icon.svg" alt="" >
                                                                <span >Delete</span>
                                                                <input type="hidden" class="delete_message_uuid-d" value=${message_uuid} />
                                                            </span>
                                                            <input type="hidden" class="user_profile_uuid" value=${sender_id} />

                                                        </div>

                                                        <div class="replay_message-d cursor_pointer-s" data-src=${message_uuid}>
                                                            <span class="ml-4">
                                                                <img class="mr-4 w_chat_read_icon-s " src="${public_path}images/chat_reply_icon.svg" alt="" >
                                                                <span >Quote </span>
                                                                <input type="hidden" class="delete_message_uuid-d" value=${message_uuid} />
                                                            </span>
                                                            <input type="hidden" class="user_profile_uuid" value=${sender_id} />
                                                            <input type="hidden" class="chat_uuid_for_replay-d" value=${sender_id} />
                                                            <input type="hidden" class="chat_message_id-d" value=${message_id} />
                                                            <input type="hidden" class="reply_message_time-d" value=${time} />
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-7 col-xl-5 col-lg-6 col-md-5 py-3 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                                <p class="sender_message-d mb-0 text-wrap text-break">
                                                    <img src="" class="show_upload_image-d d-none mr-2" width="100" height="100" />
                                                    ${message}
                                                </p>
                                            </div>

                                            <div class="ml-2 mr-3 align-self-end">

                                            </div>

                                            <div class="col-11 pr-0 mr-4 text-right">
                                                <span class="ft_11px-s sender_message_time-d"> ${time}| <span class="fg_green-s update_status-d">S</span></span>
                                            </div>

                                        </div>`

                                $('.get_messages-d').find('.col-d2').append(div);
                                $(".col-d2").stop().animate({ scrollTop: $(".col-d2")[0].scrollHeight}, 1000);


                                $("#simple-chat-message").val('');
                                $(".simple-chat-message").empty();
                                $(".get_link-d").val("");
                                $(".get_link2-d").val("");

                                if(!$(".show_reply_text-d").hasClass('d-none')){

                                    $(".show_reply_text-d").removeClass("d-flex").addClass('d-none');
                                    $(".show_reply_text-d").find(".reply_msg_id-d").val('');
                                    $(".show_reply_text-d").find(".reply_msg_time-d").val('');

                                }

                                if(!$(".hide_upload_image-d").hasClass("d-none"))
                                {
                                    console.log("jdhwinjdn");
                                    $(".hide_upload_image-d").addClass("d-none");
                                    $(".hide_upload_image-d").find(".uploaded_image-d").attr("src", '');
                                }

                                if(image.length > 0){
                                    console.log(selector);
                                    $(selector).find(".show_upload_image-d").attr('src', image).removeClass("d-none");
                                    $('.close_upload_img-d').parent().addClass("d-none");

                                } else {
                                    $(selector).find(".show_upload_image-d").attr('src', '').addClass("d-none");
                                }

                                $(".quote-d").val('');
                                // $(document).scrollTop($(document).height());
                                // $('html, body').animate({ scrollTop: $(document).height() }, 1200);
                                let scroll_bottom  = $('.get_messages-d');
                                scroll_bottom.scrollTop(scroll_bottom.prop("scrollHeight"));
                                return false;
                        }

                        // let div =  `<div class="row py-3 justify-content-end delete_message-${message_uuid}">

                        //     <div class="col-7 col-xl-5 col-lg-6 col-md-5 py-2 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                        //         <p class="sender_message-d">
                        //         ${message}
                        //         </p>
                        //     </div>
                        //     <div class="ml-2 mr-3 align-self-end">
                        //         <div class="profile_img_in_chat-s">
                        //             <img class="img_set_to_div-s sender_image-d" src="${sender_image}" alt="">
                        //         </div>
                        //     </div>

                        //     <div class="col-12 mr-xl-5 mr-lg-5 text-right">
                        //         <span class="ft_11px-s sender_message_time-d"> ${time}| <span class="fg_green-s">R</span></span>
                        //     </div>
                        //     </div>`

                        // $('.get_messages-d').find('.col').append(div);

                        // $("#simple-chat-message").val('');
                }

                },
                error: function(xhr, message, code) {
                    response = xhr.responseJSON;
                    if (404 == response.exceptionCode) {
                        let container = $('.pswd_password-d').parent();
                        if ($(container).find('.error').length > 0) {
                            $(container).find('.error').remove();
                        }
                        $(container).append("<span class='error'>" + response.message + "</span>");
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {

                        });
                    }
                    // console.log(xhr, message, code);
                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
            return false;
        }
    });
});



    //delete message
    $(".get_messages-d").on('click', ".delete_message-d", function (){
    // $(".delete_message-d").on('click', function (){

        let elm = $(this);
        console.log('elm: ', elm);

        let message_uuid = $(this).attr("data-src");
        console.log('uuid: ', message_uuid);

        let reciever_id = elm.find('.user_profile_uuid').val();
        console.log('reciever_id: ', reciever_id);

        // return false;

        let parent = elm.parent().parent().parent().parent();
        console.log('parent: ', parent);
        // return false;

        $.ajax({
            type: "Get",
            url: deleteMessage,
            data: {message_uuid: message_uuid,
                    reciever_id: reciever_id},
            dataType: "json",
            success: function (response) {
                socket.emit('for_all_send', {
                    'type': 'delete_football_message',
                    'additional_data': [response,message_uuid,reciever_id],
                });

                parent.remove();
                console.log('parent.remove(): ', parent.remove());

            }
        });

    });




       //replay message
    $(".get_messages-d").on('click', ".replay_message-d", function (){
    // $(".delete_message-d").on('click', function (){
        // debugger;
        let elm = $(this);
        // console.log('elm: ', elm);

        let message_uuid = $(this).attr("data-src");
        // console.log('uuid: ', message_uuid);
        // return false;

        let reciever_id = elm.find('.user_profile_uuid').val();
        // console.log('reciever_id: ', reciever_id);

        // let parent = $(elm).parent().parent().parent().parent();
        let parent = $(elm).parents('.uuid2_'+message_uuid);
        // let parent1 = $(elm).parents('.uuid_'+message_uuid);
        // console.log('parent: ', parent);

        let quote ="";
        let message =  $(parent).find(".reciever_message-d").text();
            if(message == "")
            {
                message = $(parent).find(".sender_message-d").text();

                // if(message == "")
                // {
                //     message = $(parent1).find(".sender_message-d").text();

                // }
                 quote = 1;

            }

            // console.log('message: ', message);

        let chat_message_id =  $(parent).find(".chat_message_id-d").val();
        // let reply_message_time =  $(parent).find(".reply_message_time-d").val();
        let reply_message_time_am_pm =  $(parent).find(".reciever_time-d").text();
        let time_slice = reply_message_time_am_pm.slice(0,-4);
          console.log('time_slice: ', time_slice);
            if(reply_message_time_am_pm == "")
            {
                // reply_message_time_am_pm = $(parent).find(".reply_message_time-d").val();
                time_slice = $(parent).find(".reply_message_time-d").val();
            }
        // console.log('reply_message_time_am_pm: ', reply_message_time_am_pm);



        let get_replay_image = $(parent).find(".reciever_message_image-d").attr("src");
        console.log('get_replay_image: ',  typeof(get_replay_image), get_replay_image);
        if(get_replay_image == undefined || get_replay_image == "")
        {
            // console.log("no image selected");
            get_replay_image = $(parent).find(".show_upload_image-d").attr("src");
              quote = 1;

            if(get_replay_image == undefined || get_replay_image == "")
            {
                get_replay_image = $(parent).find(".show_reply_image_over-d").attr("src");
                  quote = 1;
                // console.log('get_replay_image: ', get_replay_image);
            }

        }

        // console.log(( null == get_replay_image.trim()));
        console.log('get_replay_image: ',  typeof(get_replay_image), get_replay_image);


        console.log('chat_message_id: ', chat_message_id);

        console.log('message: ', message);

        $(".message_replay-d").text(message);
        $(".quote-d").val(quote);
        $(".reply_msg_id-d").val(chat_message_id);
        // $(".reply_msg_time-d").val(reply_message_time);
        $(".reply_msg_time-d").val(time_slice);

        $(".show_reply_text-d").removeClass("d-none").addClass("d-flex");
         if(get_replay_image == 'null' || typeof(get_replay_image) == 'undefined' || get_replay_image == "")
        {
            console.log("dont show ");
            // $(".get_replay_message-d").find(".get_replay_message-d").addClass("d-none");
            $(".show_reply_text-d").find(".get_replay_message").addClass("d-none");
            $(".show_reply_text-d").find(".get_replay_message_t").val("");
        }
        else {
            // $(".get_replay_message-d").find(".get_replay_message").attr("src", get_replay_image).removeClass("d-none");
            $(".show_reply_text-d").find(".get_replay_message").attr("src", get_replay_image).removeClass("d-none");
            $(".show_reply_text-d").find(".get_replay_message_t").val(get_replay_image);
        }

        return false;
    });


    $('.close_upload_img-d').on('click', function(e) {
        elm=$(this);
        elm.parent().addClass('d-none');
        $('.uploaded_image-d').attr('src', "");
        $(".get_link-d").val('');
        $(".get_link2-d").val('');

    })
    $(".close_reply_text-d").on('click', function(e) {
        elm = $(this);
        elm.parent().parent().removeClass("d-flex").addClass("d-none");
        $(".message_replay-d").text('');
        $(".reply_msg_id-d").val('');
        $(".reply_msg_time-d").val('');
        $(".get_replay_message_t").val('');
    });



      // for user profile
        $("#media13").on("change", function () {
            let elm = $(this);
            console.log("ok0");
            var file = $("#media13").get(0).files[0];
            // console.log('file: ', file);
            //     var ext = file.name.split('.').pop();
            //     console.log('ext: ', ext);

                // if(ext =='mp4')
                // {
                //     var fileReader = new FileReader();
                //     fileReader.onload = function() {
                //         var blob = new Blob([fileReader.result], {type: file.type});
                //         var url = URL.createObjectURL(blob);
                //         var video = document.createElement('video');
                //         var timeupdate = function() {
                //             if (snapImage()) {
                //             video.removeEventListener('timeupdate', timeupdate);
                //             video.pause();
                //             }
                //         };
                //         video.addEventListener('loadeddata', function() {
                //             if (snapImage()) {
                //             video.removeEventListener('timeupdate', timeupdate);
                //             }
                //         });
                //         var snapImage = function() {
                //             var canvas = document.createElement('canvas');
                //             canvas.width = video.videoWidth;
                //             canvas.height = video.videoHeight;
                //             canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                //             var image = canvas.toDataURL();
                //             var success = image.length > 100000;
                //             if (success) {
                //             var img = document.createElement('img');
                //             img.src = image;
                //              $(".media_image-d").append(img);
                //             $(elm).parent().parent().parent().find(".media_image-d").removeClass('d-none');
                //             // document.getElementsByClassName('media_image-d')[0].appendChild(img);
                //             URL.revokeObjectURL(url);
                //             }
                //             return success;
                //         };
                //         video.addEventListener('timeupdate', timeupdate);
                //         video.preload = 'metadata';
                //         video.src = url;
                //         // Load video in Safari / IE11
                //         video.muted = true;
                //         video.playsInline = true;
                //         video.play();
                //         };
                //         fileReader.readAsArrayBuffer(file);


                //     // let ext1 = "https://www.youtube.com/watch?v=9YOEIqI-zpY";
                //     // let div = `<video src="${ext1}#t=7"></video>`
                //     // $(".media_image-d").append(div);
                //     // $(elm).parent().parent().parent().find(".media_image-d").removeClass('d-none');
                //     // return false;

                // }
            // var file = $("#media14").get(0).files[0];

            if(file){
                var reader = new FileReader();

                reader.onload = function(){
                    console.log('reader: ', reader);
                    $(".previewImg2").attr("src", reader.result);
                    $(".get_link2-d").val(reader.result);
                    $(elm).parent().parent().parent().find(".media_image-d").removeClass('d-none');
                    // console.log($(elm).parent().parent().parent());
                    console.log('asdasd');
                }

                reader.readAsDataURL(file);
            }
        });




    $(".upload_pic_media-d").on("click", function(){
    //     alert('ok');
    //    let path =  $(".upload_img_video-d").attr("src");
    let path = $("#media13").val();
    if (path.substring(3,11) == 'fakepath') {
        path = path.substring(12);
    }
    $(".get_link-d").val('');
    console.log('path: ', path);
    let img_path =  public_path + path;
    $(".get_link-d").val(img_path);


    // $("#media13").val('');

        $("#upload_img_modal-d").modal("hide");
        if($('.previewImg2').attr("src") != "") {
            $(".hide_upload_image-d").removeClass('d-none');
        }
        else{
            $(".hide_upload_image-d").addClass('d-none');
        }
        $('.media_image-d').find('.previewImg2').attr("src", " ");
        $('.media_image-d').addClass('d-none');
    //    console.log('path: ', img_path);
    });

    console.log($("#existing_chat_container-d").length);
    if($("#existing_chat_container-d").length > 0)
    {
        let elm = $(this);
        console.log('elm: ', elm);

    }

    $(".cancel_modal-d").on('click', function(e){
        $("#upload_img_modal-d").modal("hide");
        $('.media_image-d').find('.previewImg2').attr("src", " ");

        $(".hide_upload_image-d").addClass('d-none');
        // $(".get_link-d").val('');
        // $('.get_link2-d').val('');
        // // $('.media_image-d').find('.previewImg2').attr("src", " ");
        $('.media_image-d').addClass('d-none');

        $(`#previewImg`).attr('src','');
        $(`.previewImg2`).attr('src','');
        // $(this).parent().addClass('d-none');
        $("#media12").val('');
        $("#media13").val('');
        $(".get_link2-d").val('');
        $(".hide_upload_image-d").addClass('d-none');
    });

    // $(".simple-chat-message").on('keypress' , function(e){
    //     // $('.send_button-d').removeClass('d-none');
    //     console.log('this.value.length > 3: ', this.value.length > 3);
    //     if(this.value.length > 3){
    //         $('.send_button-d').removeClass("d-none");
    //     }
    //     else{
    //         $('.send_button-d').addClass("d-none");
    //     }
    // });

    // console.log($(".uploaded_image-d").attr("src") != "");
    // if($(".uploaded_image-d").attr("src") != "") {
    //     // debugger;
    //     console.log($(".uploaded_image-d").attr("src") != "");
    //     $('.send_button-d').removeClass("d-none");
    // }
    // else{
    //     $('.send_button-d').addClass("d-none");
    // }

    // $(".replay_message-d").on("click" , function(e){
    //     if(!$(".show_reply_text-d").hasClass("d-none")){
    //         $(".send_button-d").removeClass("d-none");
    //     }
    //     else{
    //         $(".send_button-d").addClass("d-none");

    //     }
    // });


    //get all chats
    $("#get_chats-d").on("click", function() {

        $.ajax({
            type: "get",
            url: getChats,
            data: "",
            dataType: "json",
            beforeSend: function() {
                showPreLoader();
            },
            success: function (response) {
                let data = response.data;
                // console.log('data: ', data);

                console.log(response);
                return false;
                // if(response.status == true)
                // {
                //     $.ajax({
                //         type: "get",
                //         url: userChat,
                //         data: {data:data}, // chat id of first conversation
                //         dataType: "json",
                //         success: function (response) {

                //         }
                //     });
                //     // window.location.href = userChat;

                // }
            }
        });

        //   $.ajax({
        //         url: $(form).attr('action'),
        //         type: 'POST',
        //         dataType: 'json',
        //         data: $(form).serialize(),
        //         beforeSend: function() {
        //             showPreLoader();
        //         },
        //         success: function(response) {
        //             // console.log('response: ', response);
        //             // return false;

        //             if(response.status == true)
        //             {

        //                 // Swal.fire({
        //                 //     title: 'Success',
        //                 //     text: response.message,
        //                 //     icon: 'success',
        //                 //     showConfirmButton: false,
        //                 //     timer: 2000
        //                 // }).then((result) => {

        //                 // });
        //                 // console.log(response);
        //                 // console.log(response.data.user.user_type);
        //                 // // return false;
        //                 // if(response.data.user.user_type == 'admin')
        //                 // {
        //                 //     window.location.href = admin;
        //                 // }
        //                 // else {
        //                 // }
        //                 location.reload();
        //             }else{
        //                 // errorAlert(response.message);
        //                 console.log(response.message);
        //                 $("#wrong_password-d").removeClass("d-none");
        //                 $("#wrong_password-d").text(response.message);

        //             }
        //         },
        //         error: function(xhr, message, code) {
        //             // console.log(xhr.status, message, code);
        //             // return false;
        //             response = xhr.responseJSON;
        //             if (422 == xhr.status) {
        //             // if (response.status == false) {
        //                 console.log(response.status);
        //                 let container = $('.password-d').parent();
        //                 if ($(container).find('.error').length > 0) {
        //                     $(container).find('.error').remove();
        //                 }
        //                 // $(container).append("<span class='error fs_14px-s text-danger'>" + response.message + "</span>");
        //                 $("#wrong_password-d").removeClass("d-none").text(response.message);
        //             } else {
        //                 Swal.fire({
        //                     title: 'Error',
        //                     text: response.message,
        //                     icon: 'error',
        //                     showConfirmButton: false,
        //                     timer: 2000
        //                 }).then((result) => {

        //                     location.reload();

        //                 });


        //             }
        //             // console.log(xhr, message, code);
        //             hidePreLoader();
        //         },
        //         complete: function() {
        //             hidePreLoader();
        //         },
        //     });

    });

    let scroll_bottom = $('.get_messages-d');
    scroll_bottom.scrollTop(scroll_bottom.prop("scrollHeight"));


    $(".back_to_chat_list-d").on('click',function () {
        if($(".chat_member_list_container-d").hasClass('d-none'))
        {
            $(".chat_member_list_container-d").removeClass("d-none");
            $(this).parents("#append_chat-d").addClass("d-none");
        }
    });

    let chat_uuid = $("#current_chat_uuid-d").val();
    let user_id = $("#current_user_chat-d").val();
    // console.log(chat_uuid, user_id);
    updateStatusChat(chat_uuid, user_id);

      socket.emit('for_all_send', {
            'type': 'load_messages',
            'additional_data': {chat_uuid, user_id }
    });


});
