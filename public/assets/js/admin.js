$(document).ready(function () {
      //delete user by admin
    $('.delete_user-d').on('click',  function () {
        console.log('ok');
        let elm = $(this);
        let user_uuid = elm.find('.signle_user_uuid-d').val();
        console.log('user_uuid: ', user_uuid);
        $.ajax({
            type: "get",
            url: deleteUser,
            data: {user_uuid: user_uuid},
            dataType: "json",
            success: function (response) {
                if(response.status == true)
                {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        // $(this).parent().remove();
                        elm.parent().remove()
                    });
                }else {
                    errorAlert(response.message);
                }
            }
        });
    });


    $("#set_post_comment-d").on('click', function(){
        let elm = $(this);

        let post_length =  elm.parent().find('.post_comment-d').val();
        console.log('post_length: ', post_length);


    });

    // post comment length
    $('#post_comment_length-d').validate({
        ignore: ".ignore",
        rules: {
            post_comment_length: {
                required: true,
                // minlength: 11,
            }
        },
        messages: {
            post_comment_length: {
                required: "Post Comment Length is required.",
                // minlength : "Min length is 11 digits.",
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

    // ADMIN JS - START HERE

    $('html').click(function() {
        $(".custom-menu").addClass("d-none");
        $(".card_hover_effect-s").addClass("d-none");
        $(".player_card_hover_effect-s").addClass("d-none");
        $(".stadium_hover_effect-s").addClass("d-none");
        $(".sidebar").addClass("d-none");
        $(".sidebar_button-d").removeClass("d-none");
        $(".reported_card_hover_effect-s").addClass("d-none");
        console.log('hello');
    });


     //show sidebar onclick
     $(".sidebar_button-d").on('click', function (e) {
        e.stopPropagation();
        item = $(".sidebar");
        if(item.hasClass("d-none")){
            item.removeClass("d-none");
            $(this).addClass("d-none");
        }

    });

    $(".close_sidebar-d").on('click', function(e){
        item = $(".sidebar");
        if(!item.hasClass("d-none")){
            item.addClass("d-none");
            $(".sidebar_button-d").removeClass("d-none");
        }

    });

    // disable right click and show custom context menu
    $(".card_dropdown-d").bind('contextmenu' , function (e) {
        // Avoid the real one
        e.preventDefault();

        // Show contextmenu
        $(".custom-menu").addClass("d-none");
        $(".card_hover_effect-s").addClass("d-none");
        $(this).parent().find(".card_hover_effect-s").removeClass("d-none");
        $(".custom-menu").removeClass("d-none");
        $(".custom-menu").css({
            top: e.pageY ,
            left: e.pageX -110
        });
        return false;
    });

    // disable right click and show custom menu in Player Profile information
    $(".player_card_info-d").bind('contextmenu' , function (e) {
        console.log("sdcasd");
        // Avoid the real one
        e.stopPropagation();
        e.preventDefault();
        // Show contextmenu
        $(".card_hover_effect-s").removeClass("d-none");
        $(".custom-menu").removeClass("d-none");
        //   $(".custom-menu").finish().toggle(100);

        // In the right position (the mouse)
        $(".custom-menu").css({
            top: e.pageY ,
            left: e.pageX -45
        });
        return false;
    });

    // onclick show edit player performance tab
    $(".show_player_edit_performance-d").on('click', function(e) {
        $("#home").find(".performance_img").addClass("d-none");
        $(".edit_player_performance-d").removeClass("d-none");
    });

    // onclick hide edit player performance tab
    $(".hide_edit_rating-d").on('click', function(e) {
        $("#home").find(".performance_img").removeClass("d-none");
        $(".edit_player_performance-d").addClass("d-none");
    });

    var current = location.pathname;
    console.log(current);
    $('.nav_link_active-d').each(function(){

        var $this = $(this);
        // if the current path is like this link, make it active
        if($this.attr('href').indexOf(current) !== -1){
            $(".nav_link_active-d").removeClass("active change_color_of_nav_icon-s");
            $this.addClass('active change_color_of_nav_icon-s');
        }
    });

    // Show selected filter form - START

    $(".active_filter_btn-d").on('click', function(e) {
        elm = $(this);
        $(".active_filter_btn-d").removeClass("active");
        data_id = elm.attr("data-filter");
        console.log('elm.attr("data-filter");: ', elm.attr("data-filter"));
        console.log('!$(".filter_frm-d").hasClass("d-none"): ', !$(".filter_frm-d").hasClass("d-none"));
        if($(".filter_frm-d").hasClass("d-none")){
            console.log("sdasd");
            $(".filter_frm-d").addClass("d-none");
        }
        elm.addClass("active");
        console.log('elm.addClass("active"): ', elm.addClass("active"));
        $("."+data_id).find(".filter_frm-d").removeClass("d-none");
        console.log('$(data_id).find(".filter_frm-d").removeClass("d-none"): ', $("."+data_id));
    });

    // Show selected filter form - END

    // hide filter form - START

    // disable right click and show custom menu in Published Stadium Card
    $(".published_stadium_card-d").bind('contextmenu' , function (e) {
        // Avoid the real one
        e.preventDefault();

        // Show contextmenu
        $(".published_card-d").addClass("d-none");
        $(".card_hover_effect-s").addClass("d-none");
        $(this).parent().find(".card_hover_effect-s").removeClass("d-none");
        $(".published_card-d").removeClass("d-none");
        $(".published_card-d").css({
            top: e.pageY ,
            left: e.pageX -110
        });
        return false;
    });


    // disable right click and show custom menu in Pending Stadium Card
    $(".pending_stadium_card-d").bind('contextmenu' , function (e) {
        // Avoid the real one
        e.preventDefault();

        // Show contextmenu
        $(".pending_card-d").addClass("d-none");
        $(".card_hover_effect-s").addClass("d-none");
        $(this).parent().find(".card_hover_effect-s").removeClass("d-none");
        $(".pending_card-d").removeClass("d-none");
        $(".pending_card-d").css({
            top: e.pageY ,
            left: e.pageX -110
        });
        return false;
    });

    // disable right click and show custom menu in Reported Car in Help Page
    $(".player_reported_card-d").bind('contextmenu' , function (e) {
        // Avoid the real one
        e.preventDefault();

        // Show contextmenu
        $(".reported_dropdown-d").addClass("d-none");
        $(".card_hover_effect-s").addClass("d-none");
        $(this).parent().find(".card_hover_effect-s").removeClass("d-none");
        $(".reported_dropdown-d").removeClass("d-none");
        $(".reported_dropdown-d").css({
            top: e.pageY ,
            left: e.pageX -110
        });
        return false;
    });

    // Show Selected Stadium -START
    $(".show_filter_stadium-d").on('click', function(e){
        elm = $(this);
        $(".show_filter_stadium-d").removeClass("active");
        elm.addClass("active");
        let active_value = elm.attr('data-value');
        let container = $(".all_stadium_container-d");
        container.find(".single_stadium_container-d").addClass("d-none");
        console.log(active_value == "published");
        console.log(active_value == "pending");

        if(active_value == "published"){
            container.find(".single_approved_stadium_container-d").removeClass("d-none");
        }
        else if(active_value == "pending"){
            container.find(".single_pending_stadium_container-d").removeClass("d-none");
        }
        else {
            container.find(".single_cancelled_stadium_container-d").removeClass("d-none");
        }
    });


    // onclick delete row of Ad Detail
    $(".all_payment_container-d").on('click', ".delete_ad-d" ,  function(e){
        elm = $(this);
        let parent = elm.parents(".single_row_ad_detail-d");
        parent.remove();
    });

    // onclick delete row of Admin Detail
    $(".all_admin_container-d").on('click', ".delete_admin-d" ,  function(e){
        elm = $(this);
        let parent = elm.parents(".single_row_admin_detail-d");
        parent.remove();
    });

    //onclick on issue card show right chat box
    $( ".issue_card-d" ).on('click', function(e) {
        elm = $(this);
        let ticket_name = elm.find(".ticket_name-d").text();
        console.log(ticket_name);
        let container = $(".issue_chat_box-d");
        let chat_ticket_name = container.find(".chat_ticket_name-d");
        // chat_ticket_name.text();
        chat_ticket_name.text(ticket_name);
        container.addClass("d-none");
        console.log("df");
        container.removeClass("d-none");
    });

    //onclick on Email card show right chat box
    $( ".email_card-d" ).on('click', function(e) {
        elm = $(this);
        let ticket_name = elm.find(".ticket_name-d").text();
        console.log(ticket_name);
        let container = $(".email_chat_box-d");
        let chat_ticket_name = container.find(".chat_ticket_name-d");
        // chat_ticket_name.text();
        chat_ticket_name.text(ticket_name);
        container.addClass("d-none");
        console.log("df");
        container.removeClass("d-none");
    });

    //onclick close the right chat box of Email tab
    $(".email_chat_box-d").on('click', ".close_chat_box-d" , function(e){
        elm = $(this);
        let parent = elm.parents(".email_chat_box-d");
        parent.addClass("d-none");
    });

    //onclick close the right chat box of issue tab
    $(".issue_chat_box-d").on('click', ".close_chat_box-d" , function(e){
        elm = $(this);
        let parent = elm.parents(".issue_chat_box-d");
        parent.addClass("d-none");
    });

    //onclick nav item active in help page
    $('.nav_tabs-d').on('click' , ".help_desk_navbar-d", function(e){
        elm = $(this);
        $(".help_desk_navbar-d").removeClass("active");
        elm.addClass("active");
        let data_id = elm.attr("data-parent");
        let container = $(".tab_content-d");
        container.addClass("d-none");
        $("#"+data_id).removeClass("d-none");
        console.log($("#"+data_id));
    })
});
