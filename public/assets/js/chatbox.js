$( document ).ready(function() {

    // $(".chat_box_send_message-d").on('click', function(){
    //     alert("ok");
    // })
    $(".chat_box_send_message-d").validate({
            ignore: ".ignore",
            rules: {
                // message: {
                //         required: function(element){
                //             // return $("#send_img-d").val().length == 0;
                //         }
                //     }

            },
            messages: {
                // message: {
                //     required: "Please enter message",
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

                $.ajax({
                    type: "POST",
                    url: $(form).attr('action'),
                    data:  $(form).serialize(),
                    dataType: "json",
                     beforeSend: function() {
                        showPreLoader();
                    },
                    success: function (response) {
                            console.log(response);
                            let data = response.data;

                            let user_type = data.user_type;

                            let message = data.message;

                            if(user_type == 'sender')
                            {
                                // console.log($(form).parents(".user_send_message-d").text());
                                // $(form).parents().find(".user_message-d").text(message);
                                // $(form).parents().find(".user_send_message-d").removeClass('d-none');

                                let div =  `<div class="row py-4 px-3 justify-content-end">
                                                <div class="col-7 py-2 br_10px10px-s ft_size_12px-s fg_white-s bg_green-s word-break word-wrap">
                                                    <p>
                                                        ${message}
                                                    </p>
                                                </div>
                                            </div>`
                                    $('.message_container-d').append(div)
                                    $(".send_chat_box_message-d").val('');

                                let scroll_bottom = $('.message_container-d');
                                scroll_bottom.scrollTop(scroll_bottom.prop("scrollHeight"));

                            }
                            else {
                                    // $(".reciever_message-d").text(message);

                                    // $(".chat_box_message-d").removeClass('d-none');
                                    // $(".send_chat_box_message-d").val('');


                                let div = ` <div class="col-7 py-2 br_10x10-s ft_size_12px-s bg-greenish_grey-s word-break word-wrap">
                                                <p>sit amet, consectetur adipiscing elit. Vestibulum bibendum justo at magna pulvinar
                                                </p>
                                            </div>`
                                            $('chat_box_message-d').append(div);
                                            $(".send_chat_box_message-d").val('');

                                            let scroll_bottom = $('.message_container-d');
                                            scroll_bottom.scrollTop(scroll_bottom.prop("scrollHeight"));
                            }

                        //  $("send_chat_box_message-d").val('');
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

            }

        });

    // let scroll_bottom = $('.message_container-d');
    // scroll_bottom.scrollTop(scroll_bottom.prop("scrollHeight"));

});
