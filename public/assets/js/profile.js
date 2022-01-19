$(function(event) {

    // // Validate and then process profile update form
    // $('#frm_edit_profile-d').validate({
    //     ignore: ".ignore",
    //     rules: {
    //         first_name: {
    //             required: true,
    //             minlength: 3
    //         },
    //         last_name: {
    //             required: true,
    //             minlength: 3
    //         },
    //         username: {
    //             required: true,
    //             minlength: 3
    //         },
    //         favouriteclub: {
    //             required: true,
    //             minlength: 3,
    //         },
    //         dob: {
    //             required: true,
    //         },

    //         price: {
    //             required: true,
    //             minlength: 2
    //         },
    //     },
    //     messages: {
    //         first_name: {
    //             required: "First Name is Required.",
    //             minlength: "First Name Should have atleast 3 characters",
    //         },
    //         last_name: {
    //             required: "Last Name is Required.",
    //             minlength: "Last Name Should have atleast 3 characters",
    //         },
    //         username: {
    //             required: "Username is Required.",
    //             minlength: "Username Should have atleast 3 characters",
    //         },
    //         favouriteclub: {
    //             required: "Favourite club is Required.",
    //             minlength: "Favourite club have atleast 3 characters",
    //         },
    //         price: {
    //             required: "Price is Required.",
    //             minlength: "Price have atleast 2 numbers",
    //         },
    //     },
    //     errorPlacement: function(error, element) {
    //         $('#' + error.attr('id')).remove();
    //         error.insertAfter(element);
    //         $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + '" for="' + error.attr('for') + '">' + error.text() + '</span>');
    //     },
    //     success: function(label, element) {
    //         // console.log(label, element);
    //         $(element).removeClass('error');
    //         $(element).parent().find('span.error').remove();
    //     },
    //     submitHandler: function(form) {
    //         $.ajax({
    //             url: $(form).attr('action'),
    //             type: 'POST',
    //             dataType: 'json',
    //             data: $(form).serialize(),
    //             beforeSend: function() {
    //                 showPreLoader();
    //             },
    //             success: function(response){
    //                 if(response.status == true)
    //                 {
    //                     Swal.fire({
    //                         title: 'Success',
    //                         text: response.message,
    //                         icon: 'success',
    //                         showConfirmButton: false,
    //                         timer: 2000
    //                     }).then((result) => {

    //                         location.reload();

    //                     });
    //                 }else{
    //                     errorAlert(response.message);
    //                 }
    //             },
    //             error: function(xhr, message, code) {
    //                 response = xhr.responseJSON;
    //                 if (404 == response.exceptionCode) {
    //                     let container = $('.pswd_password-d').parent();
    //                     if ($(container).find('.error').length > 0) {
    //                         $(container).find('.error').remove();
    //                     }
    //                     $(container).append("<span class='error'>" + response.message + "</span>");
    //                 } else {
    //                     Swal.fire({
    //                         title: 'Error',
    //                         text: response.message,
    //                         icon: 'error',
    //                         showConfirmButton: false,
    //                         timer: 2000
    //                     }).then((result) => {

    //                     });
    //                 }

    //                 hidePreLoader();
    //             },
    //             complete: function() {
    //                 hidePreLoader();
    //             },
    //         });
    //         return false;
    //     }
    // });


     // Validate and then process profile update form
    $('#frm_edit_profile-d').validate({
        ignore: ".ignore",
        rules: {
            first_name: {
                required: true,
                minlength: 3
            },
            last_name: {
                required: true,
                minlength: 3
            },
            username: {
                required: true,
                minlength: 3
            },
            favouriteclub: {
                required: true,
                minlength: 3,
            },
            dob: {
                required: true,
            },

            price: {
                required: true,
                minlength: 2
            },
        },
        messages: {
            first_name: {
                required: "First Name is Required.",
                minlength: "First Name Should have atleast 3 characters",
            },
            last_name: {
                required: "Last Name is Required.",
                minlength: "Last Name Should have atleast 3 characters",
            },
            username: {
                required: "Username is Required.",
                minlength: "Username Should have atleast 3 characters",
            },
            favouriteclub: {
                required: "Favourite club is Required.",
                minlength: "Favourite club have atleast 3 characters",
            },
            price: {
                required: "Price is Required.",
                minlength: "Price have atleast 2 numbers",
            },
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' fs_14px-s text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            // $.ajaxStart();

            // $(form).submit();


             let newFormData = new FormData(form);

            $.ajax({
              url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                data: newFormData,
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
                            timer: 3000
                        }).then((result) => {

                            location.reload();
                            // window.location.href = LOGIN;
                        });
                        // console.log(response);

                    }else{
                        // console.log("in else part", response.responseJSON);
                        // errorAlert(response.responseJSON.data);

                    }
                },
                error: function(xhr, message, code) {
                    // console.log(xhr, message, code);
                    // return false;
                    response = xhr.responseJSON;
                    if (404 == response.exceptionCode) {
                        console.log(response.status);
                        let container = $('.pswd_password-d').parent();
                        if ($(container).find('.error').length > 0) {
                            $(container).find('.error').remove();
                        }
                        $(container).append("<span class='error'>" + response.message + "</span>");
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.data,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {

                            // location.reload();

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


    // Validate and then process and update phone number
    $('#frm_edit_profile-d').validate({
        ignore: ".ignore",
        rules: {
            number: {
                required: true,
                minlength: 8
            },
            password: {
                required: true,
                minlength: 8
            },
        },
        messages: {
            number: {
                required: "Phone Number is Required.",
                minlength: "Phone Number Should have atleast 8 characters",
            },
            password: {
                required: "Password is Required.",
                minlength: "Password Should have atleast 3 characters",
            }
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' fs_14px-s text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response){
                    if(response.status == true)
                    {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {

                            $("#num_verification_modal-d").modal('show');

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

                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
            return false;
        }
    });


    // Validate and then process and update password
    $('.frm_update_password-d').validate({
        ignore: ".ignore",
        rules: {
            email: {
                required: true,
            }
        },
        messages: {
            number: {
                required: "Email is Required.",
            }
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' fs_14px-s text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response){
                    if(response.status == true)
                    {
                        // Swal.fire({
                        //     title: 'Success',
                        //     text: response.message,
                        //     icon: 'success',
                        //     showConfirmButton: false,
                        //     timer: 2000
                        // }).then((result) => {


                        // });
                        let user_email_get = $(".email-t").val();
                        console.log('user_email_get: ', user_email_get);

                        $("#get_user_email-d").val(user_email_get);

                        $("#update_password_modal-d").modal('hide');
                        $("#password_verification_modal-d").modal('show');
                        $("#update_password-d").val('update password');
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

                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
            return false;
        }
    });



    // Validate and then process and update password
    $('.frm_update_forogot_password-d').validate({
        ignore: ".ignore",
        rules: {
            email: {
                required: true,
            }
        },
        messages: {
            number: {
                required: "Email is Required.",
            }
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' fs_14px-s text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response){
                    if(response.status == true)
                    {
                        // Swal.fire({
                        //     title: 'Success',
                        //     text: response.message,
                        //     icon: 'success',
                        //     showConfirmButton: false,
                        //     timer: 2000
                        // }).then((result) => {


                        // });
                        let user_email_get = $(".email-t").val();
                        console.log('user_email_get: ', user_email_get);

                        $("#get_user_email-d").val(user_email_get);

                        $("#update_forgot_password_modal-d").modal('hide');
                        $("#forgot_password_verification_modal-d").modal('show');
                        $("#update_password-d").val('update password');
                        console.log( $("#update_password-d").val('update password'));
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

                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
            return false;
        }
    });





    // Input field text accept only numaric digits
    $(".v_code-d").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });

    // code enter
        $('.frm_validate_code-d').on('keyup', '.v_code-d', function(e) {
        let elm = $(this);
        let parentForm = $(elm).parents('form');
        let text = $(elm).val().trim();
        console.log('ok');

        if (text.length > 0) {
            if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
                if ($(elm).hasClass('last-d') == false) {
                    $(elm).trigger('focusout');
                    let nextInputElm = $(elm).closest('.code_border-d').next().find('.v_code-d');
                    $(nextInputElm).trigger('focusin').focus();
                }
            }
        }

        // set hidden field in form to send in request
        let codeValue = '';
        let codeFields = $(parentForm).find('.v_code-d');
        $.each(codeFields, function(index, elm) {
            let elmValue = $(elm).val();
            if (elmValue == '') {
                codeValue = '';
                return;
            }
            else
            codeValue += elmValue;
        });
        $(parentForm).find('#hdn_activation_code-d').val(codeValue).attr('value', codeValue);
        // $(parentForm).find('#hdn_set_pass_activation_code-d').val(codeValue).attr('value', codeValue);
    });




    // Validate and then process and validate code
    $('#frm_validate_password_code-d').validate({
        ignore: ".ignore",
        rules: {
             number_box_1: {
                required: true,
                min: 0,
                max: 9,
                maxlength: 1
            },
            number_box_2: {
                required: true,
                min: 0,
                max: 9,
                maxlength: 1
            },
            number_box_3: {
                required: true,
                min: 0,
                max: 9,
                maxlength: 1
            },
            number_box_4: {
                required: true,
                min: 0,
                max: 9,
                maxlength: 1
            }
        },
        messages: {
            number_box_1: {
                required: 'Enter single digit',
                max: 'max 09',
                maxlength: "Length = 1"
            },
            number_box_2: {
                required: 'Enter single digit',
                max: 'max 09',
                maxlength: "Length = 1"
            },
            number_box_3: {
                required: 'Enter single digit',
                max: 'max 09',
                maxlength: "Length = 1"
            },
            number_box_4: {
                required: 'Enter single digit',
                max: 'max 09',
                maxlength: "Length = 1"
            },
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' fs_14px-s text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response){
                    console.log('response: ', response);
                    if(response.status == true)
                    {
                        // Swal.fire({
                        //     title: 'Success',
                        //     text: response.message,
                        //     icon: 'success',
                        //     showConfirmButton: false,
                        //     timer: 2000
                        // }).then((result) => {


                        // });
                        let code_value = $("#hdn_activation_code-d").val();
                        $("#password_verification_modal-d").modal('hide');
                        $("#code_hdn-d").val(code_value);
                        $("#code_hdn_email-d").val(code_value);
                        $("#code_phone_no-d").val(code_value);


                        let update_password = $("#update_password-d").val();
                        let update_email = $("#update_email-d").val();
                        let update_phone = $("#update_phone-d").val();
                        if('' != update_password)
                        {
                            $("#new_password_modal-d").modal('show');
                        }
                        else if('' != update_email)
                        {
                            $("#new_email_modal-d").modal('show');
                        }
                        else if('' != update_phone)
                        {
                            $("#new_num_modal-d").modal('show');
                        }
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

                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
            return false;
        }
    });

   // Validate and then process and forgot password validate code
    $('#frm_validate_forogot_password_code-d').validate({
        ignore: ".ignore",
        rules: {
             number_box_1: {
                required: true,
                min: 0,
                max: 9,
                maxlength: 1
            },
            number_box_2: {
                required: true,
                min: 0,
                max: 9,
                maxlength: 1
            },
            number_box_3: {
                required: true,
                min: 0,
                max: 9,
                maxlength: 1
            },
            number_box_4: {
                required: true,
                min: 0,
                max: 9,
                maxlength: 1
            }
        },
        messages: {
            number_box_1: {
                required: 'Enter single digit',
                max: 'max 09',
                maxlength: "Length = 1"
            },
            number_box_2: {
                required: 'Enter single digit',
                max: 'max 09',
                maxlength: "Length = 1"
            },
            number_box_3: {
                required: 'Enter single digit',
                max: 'max 09',
                maxlength: "Length = 1"
            },
            number_box_4: {
                required: 'Enter single digit',
                max: 'max 09',
                maxlength: "Length = 1"
            },
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' fs_14px-s text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response){
                    console.log('response: ', response);
                    if(response.status == true)
                    {
                        // Swal.fire({
                        //     title: 'Success',
                        //     text: response.message,
                        //     icon: 'success',
                        //     showConfirmButton: false,
                        //     timer: 2000
                        // }).then((result) => {


                        // });
                        let code_value = $("#hdn_activation_code-d").val();
                        $("#forgot_password_verification_modal-d").modal('hide');
                        $("#reset_code_hdn-d").val(code_value);
                        // $("#code_hdn_email-d").val(code_value);
                        // $("#code_phone_no-d").val(code_value);
                        console.log($("#reset_code_hdn-d").val(code_value));

                        let forgotPassword = $(".forgot_password-value-d").val();


                        if('' != forgotPassword)
                        {
                            $("#new_reset_password_modal-d").modal('show');
                        }
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

                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
            return false;
        }
    });



    // Validate and then process and update new password
    $('#frm_update_new_password-d').validate({
        ignore: ".ignore",
        rules: {
            current_password: {
                required: true,
                minlength: 8
            },
            new_password: {
                required: true,
                minlength: 8,
            },
        },
        messages: {
            current_password: {
                required: "Current password is required.",
                minlength: "Current password should have at least 8 characters"
            },
            new_password: {
                required: 'New password is required',
                minlength: "New password should have at least 8 characters",
            },
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' fs_14px-s text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response){
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

                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
            return false;
        }
    });


       // Validate and then process and update new password
    $('#frm_update_new_rest_password-d').validate({
        ignore: ".ignore",
        rules: {
            current_password: {
                required: true,
                minlength: 8
            },
            new_password: {
                required: true,
                minlength: 8,
            },
        },
        messages: {
            current_password: {
                required: "Current password is required.",
                minlength: "Current password should have at least 8 characters"
            },
            new_password: {
                required: 'New password is required',
                minlength: "New password should have at least 8 characters",
            },
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' fs_14px-s text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response){
                    if(response.status == true)
                    {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {


                        });
                        location.reload();
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

                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
            return false;
        }
    });



  // Validate and then process and update email
    $('#frm_update_email-d').validate({
        ignore: ".ignore",
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 8,
            },
        },
        messages: {
            email: {
                required: "Current Email is required.",

            },
            password: {
                required: 'Current password is required',
                minlength: "Current password should have at least 8 characters",
            },
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' fs_14px-s text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response){
                    if(response.status == true)
                    {
                        // Swal.fire({
                        //     title: 'Success',
                        //     text: response.message,
                        //     icon: 'success',
                        //     showConfirmButton: false,
                        //     timer: 2000
                        // }).then((result) => {


                        // });
                        $("#update_email_modal-d").modal('hide');
                        $("#password_verification_modal-d").modal('show');
                        $("#update_email-d").val('update email');
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

                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
            return false;
        }
    });



    // Validate and then process and update new email
    $('#frm_create_email-d').validate({
        ignore: ".ignore",
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 8,
            },
        },
        messages: {
            email: {
                required: "Email is required.",

            },
            password: {
                required: 'Current password is required',
                minlength: "Current password should have at least 8 characters",
            },
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' fs_14px-s text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response){
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

                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
            return false;
        }
    });



    // Validate and  process phone no
    $('#frm_update_phone_number-d').validate({
        ignore: ".ignore",
        rules: {
            phone_number: {
                required: true,
                minlength: 11,
            },
            password: {
                required: true,
                minlength: 8,
            },
        },
        messages: {
            phone_number: {
                required: "Phone number is required.",
                minlength : "Min length is 11 digits.",
            },
            password: {
                required: 'Current password is required',
                minlength: "Current password should have at least 8 characters",
            },
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' fs_14px-s text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response){
                    if(response.status == true)
                    {
                        // Swal.fire({
                        //     title: 'Success',
                        //     text: response.message,
                        //     icon: 'success',
                        //     showConfirmButton: false,
                        //     timer: 2000
                        // }).then((result) => {



                        // });
                        $(".update_phone-d").val('update_phone');
                        $("#update_phone_num_modal-d").modal('hide');
                        $("#password_verification_modal-d").modal('show');
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

                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
            return false;
        }
    });

    // Validate and  update new phone no
    $('#update_new_phone_no-d').validate({
        ignore: ".ignore",
        rules: {
            new_phone_number: {
                required: true,
                minlength: 11,
            },
            password: {
                required: true,
                minlength: 8,
            },
        },
        messages: {
            new_phone_number: {
                required: "Phone number is required.",
                minlength : "Min length is 11 digits.",
            },
            password: {
                required: 'Current password is required',
                minlength: "Current password should have at least 8 characters",
            },
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' fs_14px-s text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response){
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
