$(document).ready(function() {

    //set date and time on send invitation
// $(".invitation_hours-d").on('keyup', function(e){
//     // console.log('dasd');

//     if( (e.keyCode == 9))
//     {
//         console.log((e.keyCode == 9));
//         return false;
//     }
//     // console.log((e.keyCode == 18) || (e.keyCode == 9));
//     let hours = $(".invitation_hours-d").val();
//     // console.log('hours: ', hours);

//     if(hours >= 12)
//     {
//         console.log("overflow");
//        $(".invitation_hours-d").val(12);

//         // alert("hours can not be greater than 12");
//         // return false;
//     }
//     if(hours == 0 && hours != '')
//     {
//      hours = $(".invitation_hours-d").val(1);

//     }

//     hours = $(".invitation_hours-d").val();
//     $(".invitation_time-d").text(hours);
//     $(".input_invitation_time-d").val(hours);

//     if(hours == '' || $(".invitation_time-d").text() == '')
//     {
//         console.log('ok');
//         hours = 12;
//         // console.log('hours: ', hours);
//        $(".invitation_time-d").text(hours);
//     //    $(".select_time-d").addClass('d-none');
//     //    $(".select_hours-d").addClass('d-none');
//     //    if(!(".input_mints_time-d").val())
//     //    {
//     //        $(".select_mins-d").removeClass('d-none');
//     //    }
//     }
//     // // console.log('hours: ', hours);
// });


// $("#am-d").on('click', function(){
//     let elm = $(this);
//     let parent = elm.parent();
//         parent.find("#pm-d").removeClass("bg_green-s").removeClass("text-white").addClass("bg_grey-s");
//         elm.addClass("bg_green-s").addClass("text-white").removeClass("bg_grey-s");
//         $(".AM_PM_time-d").text(' '+ 'AM');
//         $(".input_AM_PM_time-d").val('AM')
// });

// $("#pm-d").on('click', function(){
//     let elm = $(this);
//     let parent = elm.parent();
//         parent.find("#am-d").removeClass("bg_green-s").removeClass("text-white").addClass("bg_grey-s");
//         elm.addClass("bg_green-s").addClass("text-white").removeClass("bg_grey-s");
//         $(".AM_PM_time-d").text(' '+'PM');
//         $(".input_AM_PM_time-d").val('PM')

// });

// let pm = $("#pm-d").text();
// $(".AM_PM_time-d").text(" "+pm);
// $(".input_AM_PM_time-d").val(pm);



// $(".invitation_minutes-d").on('keyup', function(e){
//     let min = $(".invitation_minutes-d").val();
//       if( (e.keyCode == 9))
//     {
//         console.log((e.keyCode == 9));
//         return false;
//     }

//     if(min > 60)
//     {
//         $(".invitation_minutes-d").val(59);

//     }
//     if(min == 0 && min != '')
//     {
//         $(".invitation_minutes-d").val();
//     }
//     min = $(".invitation_minutes-d").val();
//     $(".mints_time-d").text(min);
//     $(".input_mints_time-d").val(min);

//     if(min == '' || $(".mints_time-d").text() == '')
//     {
//         console.log('ok');
//         min = 00;
//        $(".mints_time-d").text(min);
//         console.log("text");

//         // $(".select_mins-d").addClass('d-none');
//         // if(!(".input_mints_time-d").val())
//         // {
//         //     $(".select_hours-d").removeClass('d-none');
//         // }


//     }
//     else{
//         $(".select_time-d").addClass('d-none');
//     }

// });





    // add new stadium
    $('#frm_new_stadium-d').validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
                minlength: 3,
            },
            address: {
                required: true,
                minlength: 3,
            }
        },
        messages: {
            name: {
                required: "Stadium Name is Required",
                minlength: "Stadium Name Should have atleast 3 characters",
            },
            address: {
                required: "Address is Required",
                minlength: "Address Should have atleast 3 characters",
            }
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            // console.log('submit handler');
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
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {

                          location.reload();
                        // $("#add_stadium_modal-d").modal('hide');

                        });
                    }else{
                        errorAlert(response.message);
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



    //accept or reject invitation
    $(`.submit_accept`).on('click',function(){

		let parent = $(this).parent().parent().parent();
		console.log(parent);

		let player_name     = parent.find(`.player_name-d`).text();
		let player_position = parent.find(`.player_position-d`).text();
		let player_amount   = parent.find(`.player_amount-d`).text();
		let username        = parent.find(`.username-d`).text();
		let invitation_uuid     = parent.find(`.invitation_uuid-d`).val();
		let player_id  = parent.find(`.player_id-d`).val();
		let host_id  = parent.find(`.host_id-d`).val();
		let host_user_uuid   = parent.find(`.host_user_uuid-d`).val();
        let status = 'accepted';

		$(`#accept_invitation_modal-d`).find(`.player_name-d`).text(player_name)
		$(`#accept_invitation_modal-d`).find(`.player_position-d`).text(player_position)
		$(`#accept_invitation_modal-d`).find(`.player_amount-d`).text(player_amount)
		$(`#accept_invitation_modal-d`).find(`.username-d`).text(`@${username}`)


		$(`.yes_submit-d`).on('click',function(){

			    $.ajax({

		           type:'GET',
		           url: ACCEPT_OR_REJECT,
		           data:{invitation_uuid:invitation_uuid,status:status, player_id:player_id, host_id:host_id, host_user_uuid:host_user_uuid},
                   dataType: 'json',
                    success: function (response) {
                        socket.emit('for_all_send', {
                            'type': 'send_invitation_message',
                            'additional_data': response,
                        });

                        location.reload();
                    }
		        });

			});

		// console.log(player_name, player_position, player_amount);
	});

    $(`.cancel_invitation`).on('click',function(){
            // debugger;

		let parent = $(this).parent().parent().parent();
		console.log(parent);

		let player_name     = parent.find(`.player_name-d`).text();
		let player_position = parent.find(`.player_position-d`).text();
		let player_amount   = parent.find(`.player_amount-d`).text();
		let username        = parent.find(`.username-d`).text();
		let invitation_uuid     = parent.find(`.invitation_uuid-d`).val();
        let status = 'rejected';

		$(`#cancel_invitation_modal-d`).find(`.player_name-d`).text(player_name)
		$(`#cancel_invitation_modal-d`).find(`.player_position-d`).text(player_position)
		$(`#cancel_invitation_modal-d`).find(`.player_amount-d`).text(player_amount)
		$(`#cancel_invitation_modal-d`).find(`.username-d`).text(`@${username}`)


		$(`.cancel_button-d`).on('click',function(){
            // debugger;
			    $.ajax({

		           type:'GET',
		           url: ACCEPT_OR_REJECT,
		           data:{invitation_uuid:invitation_uuid,status:status},
                   dataType: 'json',
                    success: function (response) {
                        location.reload();
                    }
		        });

			});

		// console.log(player_name, player_position, player_amount);
	});


     $(`.cancel_invitation_by_host`).on('click',function(){

		let parent = $(this).parent().parent().parent();
		console.log(parent);


		let player_name     = parent.find(`.player_name-d`).text();
		let player_position = parent.find(`.player_position-d`).text();
		let player_amount   = parent.find(`.player_amount-d`).text();
		let username        = parent.find(`.username-d`).text();
		let invitation_uuid     = parent.find(`.invitation_uuid-d`).val();
        console.log('invitation_uuid: ', invitation_uuid);
        // let status = 'rejected';

		$(`#cancel_invitation_by_host_modal-d`).find(`.player_name-d`).text(player_name)
		$(`#cancel_invitation_by_host_modal-d`).find(`.player_position-d`).text(player_position)
		$(`#cancel_invitation_by_host_modal-d`).find(`.player_amount-d`).text(player_amount)
		$(`#cancel_invitation_by_host_modal-d`).find(`.username-d`).text(`@${username}`)


		$(`.cancel_by_host_button-d`).on('click',function(){

            // alert('Cancel');
            // return false;
			    $.ajax({
		           type:'GET',
		           url: CANCEL_INVITATION_BY_HOST,
		           data:{invitation_uuid:invitation_uuid},
                   dataType: 'json',
                    success: function (response) {
                        // alert('Success deleted');
                        console.log(response);
                        if(response.status == true)
                        {
                            Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                            }).then((result) => {

                            location.reload();

                            });
                        }
                        else {
                             errorAlert(response.message);
                        }
                    }
		        });

			});

		// console.log(player_name, player_position, player_amount);
	});




    $(".apply_date-d").on('click', function(){
        $(`.pignose-calendar-unit-d`).submit();

    })
    // get invitation based on selected dateManager
    // $(".pignose-calendar-unit").on('click',function(){
    //     // let elm = $(this);
    //     $(`.pignose-calendar-unit-d`).submit();
    // });



    $(".hire_apply_date-d").on('click', function(){

        $(`.pignose-calendar-unit-date-d`).submit();
    })

    // get invitation based on selected dateManager
    // $(".pignose-calendar-unit-date").on('click',function(){
    //     // let elm = $(this);
    //     $(`.pignose-calendar-unit-date-d`).submit();
    // });


    //     let time = $(".invitation_time-d").val();
    //     console.log('time: ', time);

    //    if(!time)
    //    {
    //     //    $(".select_invitation_time-d").removeClass("d-none");
    //    }
    //    else {
    //        $(".select_invitation_time-d").addClass("d-none");
    //    }

        $('.invitation_time-d').change(function () {
           console.log("time is", $(".invitation_time-d").val());
           if(!$(".select_invitation_time-d").hasClass("d-none"))
           {
                $(".select_invitation_time-d").addClass("d-none");

           }
        });





    $(".open_send_invitation_modal-d").on('click',function(){
       let get_date = $(".input_select_invitation_date-d").val();
    //     let get_time_hours = $(".input_invitation_time-d").val();
    //    let get_time_mins = $(".input_mints_time-d").val();
        let invitation_time = $(".invitation_time-d").val();
        console.log('invitation_time: ', invitation_time);
       let get_stadium = $(".select_stadium-d").val();
       console.log(get_stadium);
       if(!get_stadium) {
           $(".stadium_error-d").removeClass("d-none");
       }
       else{
           $(".stadium_error-d").addClass("d-none");
       }

       console.log('get_date: ', get_date.length);

       if(!get_date)
       {
           $(".select_date-d").removeClass("d-none")
       }else {
           console.log("date found");
           $(".select_date-d").addClass("d-none")

       }
        // console.log(!get_time_hours && !get_time_mins);
    //    if(!get_time_hours && !get_time_mins)
    //    {
    //         console.log("not date found");
    //        $(".select_time-d").removeClass("d-none")
    //    }
    //    else
    //    {
    //        $(".select_time-d").addClass("d-none");

    //    }
    console.log(!invitation_time);

       if(!invitation_time)
       {
           $(".select_invitation_time-d").removeClass("d-none");
       }
       else {
           $(".select_invitation_time-d").addClass("d-none");
       }

       if($(".select_date-d").hasClass("d-none") &&  $(".select_invitation_time-d").hasClass("d-none") && $(".stadium_error-d").hasClass("d-none"))
       {
        $('#send_invitation_modal-d').modal('show');
       }
       else{
        $('#send_invitation_modal-d').modal('hide');

       }


    });




    // $("#frm_send_invitaion-d").on('click', '#send_invition-d', function(){
    //     $.ajax({
    //         type: "post",
    //         url: sendInvitation,
    //         data: "data",
    //         dataType: "dataType",
    //         success: function (response) {

    //         }
    //     });
    // })



      $('#frm_send_invitaion-d').validate({
        ignore: ".ignore",
        rules: {

        },
        messages: {

        },
        // errorPlacement: function(error, element) {
        //     $('#' + error.attr('id')).remove();
        //     error.insertAfter(element);
        //     $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        // },
        // success: function(label, element) {
        //     // console.log(label, element);
        //     $(element).removeClass('error');
        //     $(element).parent().find('span.error').remove();
        // },
        submitHandler: function(form) {
            // console.log('submit handler');
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
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            console.log(response);
                              socket.emit('for_all_send', {
                                'type': 'send_invitation_message',
                                'additional_data': response,
                            });
                            // return false;
                            window.location.href = HOMEURL;

                        });
                    }else{
                        errorAlert(response.message);
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


    $(".rate_played_user_player-d").on('click', function() {
        let elm = $(this);
        let player_uuid = $(elm).find(".rated_player_uuid").val();
        let invitation_uuid = $(elm).find(".rated_player_invitation_uuid").val();

        $.ajax({
            type: "get",
            url: ratedPlayer,
            data: {player_uuid: player_uuid, invitation_uuid: invitation_uuid},
            dataType: "json",
            success: function (response) {
                console.log('response: ', response);
                if(response.message != 'No Rating Yet')
                {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
                else {
                    $(elm).parent().parent().find('#player_played_modal-d').modal('show');
                }

            }
        });
    })

});
