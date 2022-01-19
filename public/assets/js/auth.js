$(function(event) {

    // $(".append_phone_code-d").val(function() {
    //     return this.value + '+1';
    // });

    // hide and show password
    $('#frm_login-d').on('click', '.toggle_eye_icon-d', function(e){
        let elm = $(this);
        let view_icon_url = $(elm).attr('data-view_icon_url');
        let dont_view_icon_url = $(elm).attr('data-dont_view_icon_url');
        let imgSrc = $(elm).attr('src');
        // console.log(imgSrc);

        let container = $('.password_container-d');
        if(imgSrc == dont_view_icon_url){ // case its visiblle
            $(elm).attr('src', view_icon_url);
            $(container).find('.password-d').attr('type', 'text');
        }
        else{ // case its hidden
            $(elm).attr('src', dont_view_icon_url);
            $(container).find('.password-d').attr('type', 'password');
        }
    });

    // Validate and then process login form
    $('#frm_login-d').validate({
        ignore: ".ignore",
        rules: {
            email: {
                required: true,
                email: true,
                minlength: 5,
            },
            password: {
                required: true,
                minlength: 8
            },
        },
        messages: {
            email: {
                required: "Email is Required",
                minlength: "Email Should have atleast 5 characters",
                email: "Email Format is not valid"
            },
            password: {
                required: "Password is Required.",
                minlength: "Password Should have atleast 8 characters",
            },
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element.closest('div'));
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' fs_14px-s text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
            $("#wrong_password-d").addClass("d-none");

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
                success: function(response) {
                    // console.log('response: ', response);
                    // return false;

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
                        // console.log(response);
                        // console.log(response.data.user.user_type);
                        // // return false;
                        // if(response.data.user.user_type == 'admin')
                        // {
                        //     window.location.href = admin;
                        // }
                        // else {
                        // }
                        location.reload();
                    }else{
                        // errorAlert(response.message);
                        console.log(response.message);
                        $("#wrong_password-d").removeClass("d-none");
                        $("#wrong_password-d").text(response.message);

                    }
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
            return false;
        }
    });

    // // Validate and then process registeration form
    // $('#frm_signup-d').validate({
    //     ignore: ".ignore",
    //     rules: {
    //         email: {
    //             required: true,
    //             minlength: 6,
    //         },
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
    //         password: {
    //             required: true,
    //             minlength: 8
    //         },
    //         favouriteclub: {
    //             required: true,
    //             minlength: 3,
    //         },
    //         date_of_birth: {
    //             required: true,
    //         },
    //         phone_no: {
    //             required: true,
    //             minlength: 12
    //         },
    //         price: {
    //             required: true,
    //             minlength: 2
    //         },
    //     },
    //     messages: {
    //         email: {
    //             required: "Email is Required",
    //             minlength: "Email Should have atleast 5 characters",
    //             email: "Email Format is not valid"
    //         },
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
    //         password: {
    //             required: "Password is Required.",
    //             minlength: "Password Should have atleast 8 characters",
    //         },
    //         favouriteclub: {
    //             required: "Favourite club is Required.",
    //             minlength: "Favourite club have atleast 3 characters",
    //         },
    //         phone_no: {
    //             required: "Phone no  is Required.",
    //             minlength: "Phone no have atleast 12 numbers",
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
    //         // console.log('submit handler');
    //         $.ajax({
    //             url: $(form).attr('action'),
    //             type: 'POST',
    //             dataType: 'json',
    //             data: $(form).serialize(),
    //             beforeSend: function() {
    //                 showPreLoader();
    //             },
    //             success: function(response) {
    //                 Swal.fire({
    //                     title: 'Success',
    //                     text: response.message,
    //                     icon: 'success',
    //                     showConfirmButton: false,
    //                     timer: 2000
    //                 }).then((result) => {
    //                     window.location.href = LOGIN;


    //                 });
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

    // forgot password
    $('#frm_fogrot_password-d').validate({
        ignore: ".ignore",
        rules: {
            email: {
                required: true,
                email: true,
                minlength: 5,
            },
        },
        messages: {
            email: {
                required: "Email is Required",
                minlength: "Email Should have atleast 5 characters",
                email: "Email Format is not valid"
            }
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' fs_14px-s text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
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
                success: function(response) {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        // window.location.href = APP_URL;
                        // window.location.href = reset_password_page_url + '?email=' + response.data.email + '&vcode=' + response.data.code;
                        window.location.href = HOMEURL;
                    });
                },
                error: function(xhr, message, code) {
                    response = xhr.responseJSON;
                    if (404 == response.exceptionCode) {
                        let container = $('#txt_forgot_pass_email-d').parent();
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
                            // location.reload();
                            // $('#frm_donate-d').trigger('reset');
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

    // move to next input field
    $('#frm_validate_code-d').on('keydown', '.v_code-d', function(e) {
        let elm = $(this);
        let text = $(elm).val().trim();
        console.log('ok', text);

        if (text.length > 0) {
            if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
                $(elm).val('');
            }
        }
    });

    // $('#frm_validate_code-d').on('keyup', '.v_code-d', function(e) {
    //     let elm = $(this);
    //     let text = $(elm).val().trim();

    //     if (text.length > 0) {
    //         if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
    //             if ($(elm).hasClass('last-d') == false) {
    //                 $(elm).trigger('focusout');
    //                 let nextInputElm = $(elm).closest('.code_border-d').next().find('.v_code-d');
    //                 $(nextInputElm).trigger('focusin').focus();
    //             }
    //         }
    //     }

    //     // set hidden field in form to send in request
    //     let codeValue = '';
    //     $.each($('.v_code-d'), function(index, elm) {
    //         let elmValue = $(elm).val();
    //         if (elmValue == '') {
    //             codeValue = '';
    //             return;
    //         }
    //         codeValue += elmValue;
    //     });
    //     $('#hdn_activation_code-d').val(codeValue).attr('value', codeValue);
    //     $('#hdn_set_pass_activation_code-d').val(codeValue).attr('value', codeValue);
    // });

    // // validate Activation code
    // $('#frm_validate_code-d').validate({
    //     ignore: ".ignore",
    //     rules: {
    //         email: {
    //             required: true,
    //             email: true,
    //             minlength: 5,
    //         },
    //         activation_code: {
    //             required: true,
    //             minlength: 4
    //         },
    //         number_box_1: {
    //             required: true,
    //             min: 0,
    //             max: 9,
    //             maxlength: 1
    //         },
    //         number_box_2: {
    //             required: true,
    //             min: 0,
    //             max: 9,
    //             maxlength: 1
    //         },
    //         number_box_3: {
    //             required: true,
    //             min: 0,
    //             max: 9,
    //             maxlength: 1
    //         },
    //         number_box_4: {
    //             required: true,
    //             min: 0,
    //             max: 9,
    //             maxlength: 1
    //         }
    //     },
    //     messages: {
    //         email: {
    //             required: "Email is Required",
    //             minlength: "Email Should have atleast 5 characters",
    //             email: "Email Format is not valid"
    //         },
    //         activation_code: {
    //             required: "Activation Code is Required.",
    //             minlength: "Activation Code Should have atleast 4 characters",
    //         },
    //         number_box_1: {
    //             required: '***',
    //             max: 'max 09',
    //             maxlength: "Length = 1"
    //         },
    //         number_box_2: {
    //             required: '***',
    //             max: 'max 09',
    //             maxlength: "Length = 1"
    //         },
    //         number_box_3: {
    //             required: '***',
    //             max: 'max 09',
    //             maxlength: "Length = 1"
    //         },
    //         number_box_4: {
    //             required: '***',
    //             max: 'max 09',
    //             maxlength: "Length = 1"
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
    //         // console.log('submit handler');

    //         $.ajax({
    //             url: $(form).attr('action'),
    //             type: 'POST',
    //             dataType: 'json',
    //             data: $(form).serialize(),
    //             beforeSend: function() {
    //                 showPreLoader();
    //             },
    //             success: function(response) {
    //                 if (response.status) {
    //                     Swal.fire({
    //                         title: 'Success',
    //                         text: response.message,
    //                         icon: 'success',
    //                         showConfirmButton: false,
    //                         timer: 2000
    //                     }).then((result) => {
    //                         // $('#validate_code_container-d').hide();
    //                         // $('#set_password_container-d').show();
    //                         window.location.href = APP_URL;
    //                         console.log(response);
    //                         // return false;
    //                     });
    //                 } else {
    //                     Swal.fire({
    //                         title: 'Error',
    //                         text: response.message,
    //                         icon: 'error',
    //                         showConfirmButton: false,
    //                         timer: 2000
    //                     }).then((result) => {
    //                         // do nothing
    //                     });
    //                 }
    //             },
    //             error: function(xhr, message, code) {
    //                 response = xhr.responseJSON;
    //                 Swal.fire({
    //                     title: 'Error',
    //                     text: response.message,
    //                     icon: 'error',
    //                     showConfirmButton: false,
    //                     timer: 2000
    //                 }).then((result) => {
    //                     // do nothing
    //                 });
    //                 // console.log(xhr, message, code);
    //                 hidePreLoader();
    //             },
    //             complete: function() {
    //                 hidePreLoader();
    //             },
    //         });
    //         return false;
    //     }
    // });

    // // Resend verification Code to email
    // $('#frm_validate_code-d').on('click', '.resend_code-d', function(e) {
    //     let elm = $(this);
    //     let targetUrl = $(elm).attr('data-href');
    //     let targetEmail = $('#hdn_email-d').val();
    //     let form = $(this).parents('form');

    //     if (targetEmail == '') {
    //         Swal.fire({
    //             title: 'Error',
    //             text: 'Email incorrect or not provided',
    //             icon: 'error',
    //             showConfirmButton: false,
    //             timer: 2000
    //         }).then((result) => {
    //             return false;
    //         });
    //         return false;
    //     }

    //     $.ajax({
    //         url: targetUrl,
    //         type: 'POST',
    //         dataType: 'json',
    //         data: { email: targetEmail },
    //         beforeSend: function() {
    //             showPreLoader();
    //         },
    //         success: function(response) {
    //             Swal.fire({
    //                 title: 'Success',
    //                 text: response.message,
    //                 icon: 'success',
    //                 showConfirmButton: false,
    //                 timer: 2000
    //             }).then((result) => {
    //                 // do nothing
    //                 $(form).find('.v_code-d').val('').attr('value', '');
    //             });
    //         },
    //         error: function(xhr, message, code) {
    //             response = xhr.responseJSON;
    //             Swal.fire({
    //                 title: 'Error',
    //                 text: response.message,
    //                 icon: 'error',
    //                 showConfirmButton: false,
    //                 timer: 2000
    //             }).then((result) => {
    //                 // don nothing
    //                 // location.reload();
    //             });
    //             // console.log(xhr, message, code);
    //             hidePreLoader();
    //         },
    //         complete: function() {
    //             hidePreLoader();
    //         },
    //     });
    // });


    // Set Password
    $('#frm_set_password-d').validate({
        ignore: ".ignore",
        rules: {

            email: {
                required: true,
                email: true,
                minlength: 5,
            },
            activation_code: {
                required: true,
                minlength: 4
            },
            password: {
                required: true,
                minlength: 8,
            },
            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: '.set_pass_pswd-d'
            },
        },
        messages: {

             email: {
                required: "Email is Required",
                minlength: "Email Should have atleast 5 characters",
                email: "Email Format is not valid"
            },
            code: {
                required: "Activation Code is Required.",
                minlength: "Activation Code Should have atleast 4 characters",
            },
            password: {
                required: "Password is Required",
                minlength: "Password Should have atleast 8 characters",
            },
            password_confirmation: {
                required: "Confirm Password is Required",
                minlength: "Password Should have atleast 8 characters",
                equalTo: 'Confirm Password MUST be Equal to Password'
            },
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $(`#${error.attr('id')}`).replaceWith('<span class="text-danger" id="' + error.attr('id') + '" class="text-danger ' + error.attr('class') + ' fs_14px-s text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
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
                success: function(response) {
                    // Swal.fire({
                    //     title: 'Success',
                    //     text: response.message,
                    //     icon: 'success',
                    //     showConfirmButton: false,
                    //     timer: 2000
                    // }).then((result) => {
                        window.location.href = login_page_url;
                    // });
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


    // popup signup category modal
    $('.open_signup_category-d').on('click', function(e) {
        $('#add_signup_category_modal-d').modal('show');
    });

    // select calendar activity type
    $('#add_signup_category_modal-d').on('click', '.category_signup-d', function(e) {
        let elm = $(this);
        let activity_type = $(elm).attr('data-activity_type');
        $('.category_signup-d').removeClass('active');
        $(elm).addClass('active');
        console.log(activity_type);
        $('#add_signup_category_modal-d').find('.hdn_category_signup-d').val(activity_type).attr('value', activity_type);
    });

    $('#add_signup_category_modal-d').on('click', '.btn_activity_page_next-d', function(e) {
        let categorySingup = $('.hdn_category_signup-d').val();
        // alert(categorySingup);
        if (categorySingup == 'student') {
            window.location.href = STUDENT_SIGNUP;
        } else {
            // alert('parent');
            window.location.href = PARENT_SIGNUP;
        }
    });










 // Validate and then process registeration form testing testing
 $.validator.addMethod("strong_password", function (value, element) {
    let password = value;
    // if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%&])(.{3,10}$)/.test(password))) {
    if (!(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])(.{8,20}$)/.test(password))) {
        //  new RegExp(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,100}$')
        return false;
    }
    return true;
 }, 'Password must contain one capital letter,one numerical and one special character');


$.validator.addMethod('image_exists', function(value, element) {
   if (this.optional(element)) {
    return true;
  }
});

// hide and show password
$('#frm_signup-d').on('click', '.toggle_eye_icon-d', function(e){
    let elm = $(this);
    let view_icon_url = $(elm).attr('data-view_icon_url');
    let dont_view_icon_url = $(elm).attr('data-dont_view_icon_url');
    let imgSrc = $(elm).attr('src');
    // console.log(imgSrc);

    let container = $('.password_container-d');
    if(imgSrc == dont_view_icon_url){ // case its visiblle
        $(elm).attr('src', view_icon_url);
        $(container).find('.password-d').attr('type', 'text');
    }
    else{ // case its hidden
        $(elm).attr('src', dont_view_icon_url);
        $(container).find('.password-d').attr('type', 'password');
    }
});



$("#phone_number-d").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) ) {
        return false;
    }
});


    $('#frm_signup-d').validate({
        ignore: ".ignore",
        rules: {
             media:{
                required: true,
                // image_exists: true,
                // extension: "jep | jpeg | png | gif | bmp"
            },
            email: {
                required: true,
                minlength: 6,
            },
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
            password: {
                required: true,
                minlength: 8,
                strong_password:true
            },
            favouriteclub: {
                required: true,
                minlength: 3,
            },
            city: {
                required: true,
                minlength: 3,
            },
            country: {
                required: true,
                // minlength: 3,
            },
            address: {
                required: true,
                minlength: 3,
            },
            date_of_birth: {
                required: true,
                dateISO: true
            },
            phone_no: {
                required: true,
                // minlength: 12,
                maxlength: 14
            },
            price: {
                required: true,
                minlength: 2
            },
            check:{
                // required: function() {
                //     return $('#radio-d').is(':checked');
                // },
                required: true,
                // minlength: 0
            },
            // termsandconditions: {
            //     required: true,
            // }
        },
        messages: {
            media: {
                required: "Profile Image is required",
                // image_exists: true,
                // extension : "Please provide image in extension for following jep | jpeg | png | gif | bmp ",
            },
            email: {
                required: "Email is Required",
                minlength: "Email Should have atleast 5 characters",
                email: "Email Format is not valid"
            },
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
            password: {
                required: "Password is Required.",
                minlength: "Password Should have atleast 8 characters",
            },
            favouriteclub: {
                required: "Favourite club is Required.",
                minlength: "Favourite club have atleast 3 characters",
            },
            city: {
                required: "City is Required.",
                minlength: "City should have atleast 3 characters",
            },
            country: {
                required: "Country is Required.",
                // minlength: "Country should have atleast 3 characters",
            },
            address: {
                required: "Address is Required.",
                minlength: "Address should have atleast 3 characters",
            },
            date_of_birth: {
                required: "Date of birth is Required.",
            },
            phone_no: {
                required: "Phone no  is Required.",
                // minlength: "Phone no have max 13 numbers",
                maxlength: "Phone no have max 13 numbers",
            },
            price: {
                required: "Price is Required.",
                minlength: "Price have atleast 2 numbers",
            },
            check: {
                required: "Check Terms and policy.",
            },
            // termsandconditions: {
            //     required: "Terms and conditions must be accepted. "
            // }
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
        submitHandler: function(form) {
            // e.preventDefault();

            // form.submit();
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

                            // location.reload();
                            window.location.href = LOGIN;
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


    $("#accept_tmd").on('click', function(){

        let val = "1";
        localStorage.setItem('setValue', val);
        // location.href = `${singUp}?val=1` ;
        location.href = singUp;


    });

    $("#reject_term_condition-d").on('click', function(){

          let val = "";
        localStorage.setItem('setValue', val);
        errorAlert('Accept Terms and conditions');
        // console.log("error");
        setTimeout(() => {

            location.reload();
        }, 2000);
    });




    $(".sign_in-s").on('click', function(){
        window.location.href = LOGIN;
    })


    $(".cancel_forgot_password-d").on('click', function(){
        $(".code_input-s").val("");
    })

});
