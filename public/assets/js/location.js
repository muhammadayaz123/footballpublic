$(document).ready(function () {

    // alert('helo');


    $('#frm_search_location-d').validate({
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
                    data: $(form).serialize() + "&lat1="+lat1 + "&long1="+long1,
                    beforeSend: function() {
                        showPreLoader();
                    },
                    success: function(response) {
                        console.log('response: ', response);
                           location.reload();
                        return false;


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

});
