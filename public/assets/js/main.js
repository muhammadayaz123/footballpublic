// Get the container element
// var Container = document.getElementById("nav_bar-d");

// Get all nav items with class="nav_link_active-d" inside the container

// var items = Container.getElementsByClassName("nav_link_active-d");

//loop for all nav link items to active them on click
$(document).ready(function() {




    // console.log('test');
    // console.log('window.location.hostname: ', (window.location.href.substring(window.location.href.lastIndexOf('/'))).replace('/', ''));

    // let url = (Window.location.href.substring(window.location.href.lastIndexOf('/'))).replace('/', '');
    // console.log('url: ', url);
    $(`a[href$="#"]`).addClass('active').addClass('change_color_of_nav_icon-s');


    $(`.player_position_button-s`).click(function() {
        $(`.active_position-s`).removeClass(`active_position-s`).find('.child').addClass(`opacity_4-s`);
        $(this).addClass('active_position-s');
        $(this).find(`.opacity_4-s`).removeClass(`opacity_4-s`);
    });

    // $(`.chat_parent`).click(function() {
    //     $(`.list_member_parent-d`).find('.br_on_active-s').removeClass('br_on_active-s');
    //     $(this).addClass(`br_on_active-s`);
    //     $(`.chat_module_parent`).find('.d-lg-block').removeClass('d-lg-block').addClass('d-none');
    //     $(`#${$(this).attr('data-parent-chat')}`).removeClass('d-none').addClass('d-lg-block');
    //     $(`.chat_member_list_container-d`).addClass('d-none').addClass('d-lg-block');
    // });
    // $(`.chat_back_to_list-d`).click(function() {
    //     $(`.chat_member_list_container-d`).removeClass('d-none');
    // });

});



// $('.player_position_button-s').click(function() {
//     $('.active_position-s').removeClass(".active_position-s");
//     $(this).find(`.opacity_4-s`).removeClass(`opacity_4-s`);
//     $(this).addClass("active_position-s");
// });

// $(document).on('click', '.btn-grp button', function(e) {
//     $(".active_position-s").not($(this).addClass('active_position-s')).removeClass();
// });



document.addEventListener('DOMContentLoaded', function() {

    // $(`#lower,#upper`).on('input', function() {
    //     let rating_Value = $(`#rating_value-d`);
    //     let rating_Value_upper = $(`#rating_value-d2`);
    //     let rating_slider = $(`#lower`);
    //     let rating_slider_upper = $(`#upper`);

    //     $(rating_Value_upper).text($(rating_slider_upper).val());
    //     $(rating_Value).text($(rating_slider).val());

    //     $(rating_Value).position() = ($(rating_slider).val() / 2) + `%`;
    // });
    // rating_slider.oninput = ( ()=> {
    //     let value = rating_slider.value;
    //     console.log(rating_Value.textContent);
    //     rating_Value. textContent = value;

    //     rating_Value.style.left =(value/2) + "%";
    // });

    $(`.min_input-d`).on('input change', function(){
        const
        maxInput = $(this).parent().find('.max_input-d'),
        maxValue = $(this).parent().find('.max_value-d'),
        minValue = $(this).prev(),

        setMinValue = ()=>{
            let
            newValue = Number(($(this).val() - $(this).attr('min')) * 100 / ($(this).attr('max') - $(this).attr('min'))),

            newPosition = 10 - (newValue * 0.2);
            $(minValue).html( `<span>${$(this).val()}</span>` );
            $(minValue).css('left', `calc(${newValue}% + (${newPosition}px))`);
            if( $(this).val() >  $(maxInput).val() ){
                $(maxInput).val($(this).val()) ;
                $(maxValue).html('');
            }
        };
        $(document).ready("DOMContentLoaded", setMinValue);
        $(this).on('input', setMinValue);

    });

    $(`.max_input-d`).on('input change', function(){
        const
        minInput = $(this).parent().find('.min_input-d'),
        minValue = $(this).parent().find('.min_value-d'),
        maxValue = $(this).prev(),
        setMaxValue = ()=>{
            let
            newValues = Number( ($(this).val() - $(this).attr("max")) * 100 / ($(this).attr('min') - $(this).attr('max')) ),
            newPositions = 10 - (newValues * 0.2);
            $(maxValue).html(`<span>${$(this).val()}</span>`) ;
            $(maxValue).css('right', `calc(${newValues}% + (${newPositions}px))`) ;
            if( $(this).val() <  $(minInput).val() ){
                $(minInput).val($(this).val());
                $(minValue).html('');
            }
        };
        $(document).ready("DOMContentLoaded", setMaxValue);
        $(this).on('input', setMaxValue);

    });



    $(`.button_click-s`).click(function() {
        let img = $(this).find(`.dropdown_img_change-d`).find(`.dropdown_img-s`).attr('src');

        img = img == `${public_path}assets/images/arrow_down.svg` ? `${public_path}assets/images/arrow_up.svg` : (img == `${public_path}assets/images/arrow_up.svg` ? `${public_path}assets/images/arrow_down.svg` : `${public_path}assets/images/arrow_up.svg`);

        $(this).find(`.dropdown_img_change-d`).find(`.dropdown_img-s`).attr('src', img);
        console.log(img);
    });

    let chat_icon = document.getElementById("chat_icon-d");
    if (chat_icon != null) {
        chat_icon.addEventListener("click", changeImg);

        function changeImg() {
            var img = this.src;

            if (img.indexOf("bot_chat.svg") != -1) {
                this.src = `${public_path}assets/images/close_chat.svg`;
            } else {
                this.src = `${public_path}assets/images/bot_chat.svg`;
            }

            var show_chat = document.getElementById("wrapper-d");
            if (show_chat.classList.contains("d-none")) {
                show_chat.classList.remove("d-none");
                show_chat.classList.add("d-block");

                let scroll_bottom = $('.message_container-d');
                scroll_bottom.scrollTop(scroll_bottom.prop("scrollHeight"));

            } else {
                show_chat.classList.remove("d-block");
                show_chat.classList.add("d-none");
            }
        }
    }

    $(`.slider-d`).on('input', function() {
        $(`.${$(this).attr('data-parent')}`).text($(this).val());
    });

    let img = document.getElementsByClassName("change_img-d");
    if (img != null) {
        Array.from(img).forEach(elm => {
            elm.addEventListener("click", toggleCalendar);
        });

        function toggleCalendar() {
            let calendar = document.getElementById("toggle_calendar-d");
            if (this.src == "assets/images/arrow_down_green.svg" || calendar.classList.contains("d-none")) {
                this.setAttribute("width", 18);
                this.src = `${public_path}assets/images/up_arrow.svg`;
                calendar.classList.remove("d-none");
            } else {
                this.setAttribute("width", 17);
                this.src = `${public_path}assets/images/arrow_down_green.svg`;
                calendar.classList.add("d-none");
            }

        }
    }

    // ------ For game invitation switch modals ----->


    $('.modal').on('click', `#switch_to_select_date-d`, function(e) {
        // $(`#accept_invitation_modal-d`).modal().hide();
        // $(`#accept_invitation_modal-d`).modal('hide', 500);
        // $(`#select_date_modal-d`).modal('show');

        switchModal('accept_invitation_modal-d', 'select_date_modal-d');
    });
    // $(`#cancel_modal-d`).click(function() {
    //     window.location.href = "hire_Players.html";
    // });
    // $(`#cancel_modal-d`).click(function() {
    //     alert('text');
    //     window.location.href = "game_invitation.html";
    // });

    /**  --------------- jquery of switch modals for new phone number ----------- */

    // ------ For verify code to phone update switch modals ----->
    $('.modal').on('click', `#switch_to_phone_verify_code-d`, function(e) {
        switchModal('update_phone_num_modal-d', 'num_verification_modal-d');

    });
    // $("#switch_to_phone_verify_code-d").click(function() {
    // $("#update_phone_num_modal-d").modal('hide');
    // $("#num_verification_modal-d").modal('show');
    // $(`#cal`).click(function() {
    //     window.location.href = "hire_Players.html";
    // });

    // ------ For enter new phone verify code switch modals ----->
    $('.modal').on('click', `#switch_to_new_phone_modal-d`, function(e) {
        switchModal('num_verification_modal-d', 'new_num_modal-d');

    });

    // $("#switch_to_new_phone_modal-d").click(function() {
    //     $("#num_verification_modal-d").modal('hide');
    //     $("#new_num_modal-d").modal('show');
    // });

    // ------ For success new phone switch modals ----->
    $('.modal').on('click', `#phone_success_modal-d`, function(e) {
        switchModal('new_num_modal-d', 'success_phone_num_modal-d');

    });

    // $("#phone_success_modal-d").click(function() {
    //     $("#new_num_modal-d").modal('hide');
    //     $("#success_phone_num_modal-d").modal('show');
    // });

    /**  --------------- jquery of switch modals for new phone number ----------- */


    /**  --------------- jquery of switch modals for new email ----------- */

    // ------For enter verify code to update email switch modals ----->
    $('.modal').on('click', `#switch_to_email_verify_code_modal-d`, function(e) {
        switchModal('update_email_modal-d', 'email_verification_modal-d');

    });

    // $("#switch_to_email_verify_code_modal-d").click(function() {
    //     $("#update_email_modal-d").modal('hide');
    //     $("#email_verification_modal-d").modal('show');
    // });

    // ------For enter new email switch modals ----->
    $('.modal').on('click', `#switch_to_new_email_modal-d`, function(e) {
        switchModal('email_verification_modal-d', 'new_email_modal-d');

    });

    // $("#switch_to_new_email_modal-d").click(function() {
    //     $("#email_verification_modal-d").modal('hide');
    //     $("#new_email_modal-d").modal('show');
    // });


    // ------ For success new email switch modals ----->
    $('.modal').on('click', `#email_success_modal-d`, function(e) {
        switchModal('new_email_modal-d', 'success_email_modal-d');

    });

    // $("#email_success_modal-d").click(function() {
    //     $("#new_email_modal-d").modal('hide');
    //     $("#success_email_modal-d").modal('show');
    // });

    /**  --------------- jquery of switch modals for new email ----------- */


    /**  --------------- jquery of switch modals for new password ----------- */

    // ------For enter verify code to update password switch modals ----->
    $('.modal').on('click', `#switch_to_password_verify_code_modal-d`, function(e) {
        switchModal('update_password_modal-d', 'password_verification_modal-d');

    });

    // $("#switch_to_password_verify_code_modal-d").click(function() {
    //     $("#update_password_modal-d").modal('hide');
    //     $("#password_verification_modal-d").modal('show');
    // });

    // ------For enter new password switch modals ----->
    $('.modal').on('click', `#switch_to_new_password_modal-d`, function(e) {
        switchModal('password_verification_modal-d', 'new_password_modal-d');

    });

    // $("#switch_to_new_password_modal-d").click(function() {
    //     $("#password_verification_modal-d").modal('hide');
    //     $("#new_password_modal-d").modal('show');
    // });

    // ------ For success new password switch modals ----->
    $('.modal').on('click', `#password_success_modal-d`, function(e) {
        switchModal('new_password_modal-d', 'success_password_modal-d');

    });

    // $("#password_success_modal-d").click(function() {
    //     $("#new_password_modal-d").modal('hide');
    //     $("#success_password_modal-d").modal('show');
    // });

    /**  --------------- jquery of switch modals for new password ----------- */

    /**-------------------- switch modal for rating or not -------------------- */

    $('.modal').on('click', `#switch_to_no_rating_modal`, function(e) {
        switchModal('player_played_modal-d', 'player_not_played_modal-d');

    });

    // $("#switch_to_no_rating_modal").click(function() {
    //     $("#player_played_modal-d").modal('hide');
    //     $("#player_not_played_modal-d").modal('show');
    // });


    /** -------------- for add stadium modal --------------- */

    $("#switch_to_add_stadium_modal-d").click(function() {
        $("#send_invitation_modal-d").modal('hide');
        $("#add_stadium_modal-d").modal('show');
    });

    // filter modals switch


    $('.modal').on('click', '.trigger_rating-d', function(e) {
        // console.log('fefefefe');
        $("#option_of_filter_modal-d").modal('hide');
        $("#filter_by_rating_modal-d").modal('show');
    });

    $('.modal').on('click', '.trigger_price-d', function(e) {
        // $(".option_of_filter_modal-d").modal('hide');
        // $("#filter_by_price_modal-d").modal('show');
         $("#option_of_filter_modal-d").modal('hide');
        $("#filter_by_price_modal-d").modal('show');
        // switchModal('option_of_filter_modal-d', 'filter_by_price_modal-d');

    });


    $('.modal').on('click', '.trigger_location-d', function(e) {
        // $(".option_of_filter_modal-d").modal('hide');
        // $("#filter_by_distance_modal-d").modal('show');
         $("#option_of_filter_modal-d").modal('hide');
        $("#filter_by_distance_modal-d").modal('show');
        // switchModal('option_of_filter_modal-d', 'filter_by_distance_modal-d');
    });

    $(`.p_tab`).click(function() {
        elm = $(`.tab-content`);
        $(`.nav-tabs`).find(`.performance_text`).removeClass('performance_text');
        $(this).addClass('performance_text');
        elm.find('.active').removeClass('active').removeClass('show');
        $(`#${$(this).attr('href').replace('#','')}`).addClass('active').addClass('show');
        console.log($(`.tab-content`).find("#home").hasClass("active"));
        if(elm.find("#menu2").hasClass("active") || elm.find("#menu3").hasClass("active")) {
            $(".upload_img_btn-d").removeClass('d-none').addClass('d-flex');
        }
        else {
            $(".upload_img_btn-d").removeClass('d-flex').addClass('d-none');

        }

    })

    $('.calendar').pignoseCalendar();


    $("#isdn_code-d").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });

    // validation on form merchant account
    $('#frm_merchant_account-d').validate({
        ignore: ".ignore",
        rules: {
            isdn_code:{
                required: true,
                maxlength: 15,
                minlength: 5,
            },
            iban_no: {
                required: true,
                maxlength: 34,
                minlength: 18,
            },
            swift_code: {
                required: true,
                maxlength: 11,
                minlength: 4,
            },
            kent: {
                // required: true,
                required: function(element){
                    return $("#credit-d").val() == " ";
                },
                required: function(element){
                    return $("#bookey-d").val() == " ";
                },
                required: function(element){
                    return $("#amex-d").val() == " ";
                }
            },
            credit: {
                // required: true,
                required: function(element){
                    return $("#kent-d").val() == " ";
                },
                required: function(element){
                    return $("#bookey-d").val() == " ";
                },
                required: function(element){
                    return $("#amex-d").val() == " ";
                }
            },
            bookey: {
                // required: true,
                required: function(element){
                    return $("#kent-d").val() == " ";
                },
                required: function(element){
                    return $("#credit-d").val()== " ";
                },
                required: function(element){
                    return $("#amex-d").val()== " ";
                }
            },
            amex: {
                // required: true,
                required: function(element){
                    return $("#kent-d").val()== " ";
                },
                required: function(element){
                    return $("#credit-d").val()== " ";
                },
                required: function(element){
                    return $("#bookey-d").val()== " ";
                }
            },
        },
        messages: {
            isdn_code:{
                required: "ISDN code is required.",
                // maxlength: "ISDN code should have at least 15 character long.",
                minlength: "ISDN code should have at least 5 character long.",
            },
            iban_no: {
                required: "IBAN No. is required.",
                // maxlength: "ISDN code should have at least 34 character long.",
                minlength: "ISDN code should have at least 18 character long.",
            },
            swift_code: {
                required: "SWIFT code is required.",
                // maxlength: "ISDN code should have at least 11 character long.",
                minlength: "ISDN code should have at least 4 character long.",
            },
            kent: {
                required: "Select atleast one k option.",
            },
            credit: {
                required: "Select atleast one c option.",
            },
            bookey: {
                required: "Select atleast one b option.",
            },
            amex: {
                required: "Select atleast one a  option.",
            },
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element.closest('div'));
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' fs_14px-s text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form,e) {
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: function(xhr, message, code) {
                    response = xhr.responseJSON;
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        // don nothing
                        // location.reload();
                    });
                    // console.log(xhr, message, code);
                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
        }
    });


    $('.report_options-d').on('click', function(e) {
        if(!$(".error_msg-d").hasClass('d-none')){
            $(".error_msg-d").addClass('d-none');
        }
        else{
            elm = $(this);
            $('.report_options-d').removeClass('active');
            elm.addClass('active');

        }
    });



    $('.report_player_modal-d').on('keypress', function(e) {
        if(e.which == 13){
            $(".block_player_by_user-d").click();
            return false;
        }
    })

    $(".block_player_by_user-d").on('click', function(e) {


        let elm = $(this);
        let parent = elm.parent().parent().parent();
        let getActive = $(parent).find('.active');
        console.log('getActive: ', getActive, getActive.length);
        if(getActive.length < 1)
        {
            console.log("helll");
            // alert('please select one option');
            parent.find(".error_msg-d").removeClass('d-none');
        }
        else {
            parent.find(".error_msg-d").addClass('d-none');
            let reason = getActive.find(".mb-0").text();
            let blocker_id = parent.find(".blocker_id-d").val();
            let player_id = parent.find(".player_id-d").val();

            let post_id = parent.find(".other_profile_post_id-d").val();

            if(reason == "Something else"){
                // console.log("ok");
                reason =  $(parent).find("#message").val();
            }

            console.log('reason: ', reason, blocker_id, post_id, player_id);

            // return false;

            $.ajax({
                url:  block_user,
                type: 'get',
                dataType: 'json',
                data: {reason: reason, blocker_id: blocker_id, player_id: player_id, post_id: post_id},
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: function(xhr, message, code) {
                    response = xhr.responseJSON;
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        // don nothing
                        // location.reload();
                    });
                    // console.log(xhr, message, code);
                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
        }

        console.log(getActive.find(".mb-0").text());

    })
});
