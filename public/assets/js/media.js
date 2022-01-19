$(document).ready(function() {

    //for signup
     $("#profile_image-d").on("change", function () {
            console.log("ok0");
            $("#profile_image-d-error").remove();
            var file = $("#profile_image-d").get(0).files[0];

            if(file){
                var reader = new FileReader();

                reader.onload = function(){
                    $("#previewProfileImg").attr("src", reader.result).addClass('block').css({'width': "70px", 'height': "70px",'margin-top': "8px", 'border-radius': "50%", 'border': "2px solid green", 'object-fit': "cover" });
                    // $("#previewProfileImg").removeClass('d-none').addClass('block');
                }

                reader.readAsDataURL(file);
            }
        });



    // for user profile
        $("#media12").on("change", function () {
            let elm = $(this);


            console.log("ok0");
            var file = $("#media12").get(0).files[0];
            console.log('file: ', file);
            var ext = file.name.split('.').pop();
            console.log('ext: ', ext);

            if(ext =='mp4')
            {
                var fileReader = new FileReader();
                fileReader.onload = function() {
                    var blob = new Blob([fileReader.result], {type: file.type});
                    var url = URL.createObjectURL(blob);
                    var video = document.createElement('video');
                    var timeupdate = function() {
                        if (snapImage()) {
                            console.log("++", timeupdate, "checkmate");
                            video.removeEventListener('timeupdate', timeupdate);
                            video.pause();
                        }
                    };
                    video.addEventListener('loadeddata', function() {
                        if (snapImage()) {
                            video.removeEventListener('timeupdate', timeupdate);
                        }
                    });
                    var snapImage = function() {
                        var canvas = document.createElement('canvas');
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                        var image = canvas.toDataURL();
                        console.log('image: ', image.length);
                        var success = image.length > 100000;
                        if (success) {
                        var img = document.createElement('img');
                        img.src = image;
                        // img.setAttribute('class', 'video_preview');
                        img.setAttribute('class', 'video_preview object_fit_cover-s');
                        img.setAttribute('width', '100px');
                        img.setAttribute('height', '100px');
                        $(".media_video-d").append(img);
                        // let elm = $(".media_video-d");

                        // $("#previewImg").attr("src", img.src);

                        $(elm).parent().parent().parent().find(".media_video-d").removeClass('d-none');
                        // document.getElementsByClassName('media_image-d')[0].appendChild(img);
                        URL.revokeObjectURL(url);
                            // reader.readAsDataURL(file);

                        }
                        return success;
                    };
                    video.addEventListener('timeupdate', timeupdate);
                    video.preload = 'metadata';
                    video.src = url;
                    // Load video in Safari / IE11
                    video.muted = true;
                    video.playsInline = true;
                    video.play();
                    };
                    fileReader.readAsArrayBuffer(file);
            }

            // if(file){

               else {
                    var reader = new FileReader();
                    reader.onload = function(){
                            console.log('reader: ', reader);
                            $("#previewImg").attr("src", reader.result);
                            console.log('reader.result: ', reader.result);
                            $(elm).parent().parent().parent().find(".media_image-d").removeClass('d-none');
                        }
                    }


                $("#media12-error").remove();
            // }
            reader.readAsDataURL(file);
        });



        // $(".media_modal-d").on("click", function(){
        //     // console.log('ok');
        //     let elm = $(this);
        //     let post_uuid =  elm.find(".post_uuid-d").val();

        //     $(".like_post_uuid-d").val(post_uuid);
        //     $(".post_comment_post_uuid-d").val(post_uuid);
        //     // $(".delete_post-d").addClass(post_uuid);
        //     $(".delete_post-d").attr("data-post",post_uuid);

        //     let like =elm.find(".post_like-d").val();
        //       $(".like-d").val(like);
        //     // alert(post_uuid);

        //     $.ajax({
        //         type: "get",
        //         url: MEDIA_POST ,
        //         data: {post_uuid: post_uuid},
        //         dataType: 'json',
        //         success: function (response) {
        //             console.log(response, "response data");



        //             let data = response.data;
        //             let comments = response.data.post.comments;
        //             let media = response.data.post.media.path;

        //             let div = "";
        // //                 '<div><a href="javascript:void(0)"class="td_none-s">'+
        // //                 '<h6 class="fg_green-s mb-0"><strong>Ahmad</strong></h6>'+
        // //                 '<span class="fs_12px-s text-dark">@ahmad123</span></a></div>'+
        // //                 '<div><span class="fs_12px-s">2 days ago | 12:30 pm</span></div>';

        // //  alert(div);

        //             $("#append_div-d").empty();
        //                     // console.log(asset);


        //             $.each(comments, function (i, elm) {


        //                 console.log(elm);
        //                 div ='<div class="col-1 px-0">' +
        //                 '<img src="'+ public_path+elm.profile.profile_image +'" width="37" class="img-fluid rounded-circle border_green-s" alt=""> </div>' +
        //                 ' <div class="col-lg-11 col-11" >' +
        //                 '<div class="d-flex justify-content-between">'+
        //                 '<div><a href="javascript:void(0)"class="td_none-s">'+
        //                 '<h6 class="fg_green-s mb-0"><strong>'+elm.profile.first_name+'</strong></h6>'+
        //                 '<span class="fs_12px-s text-dark">@'+elm.profile.username+'</span></a></div>'+
        //                 '<div><span class="fs_12px-s">2 days ago | 12:30 pm</span></div></div>'+
        //                 '<p class="fs_12px-s">'+elm.comment+' </p></div>';

        //                 $("#append_div-d").append(div);
        //             });

        //             $("#caption_description-d").text(data.post.caption);
        //             $("#liked_count-d").text(data.post.like_count);

        //         }
        //     });

        //     $("#post_modal-d").modal('show');

        // })






        //for update profile pic
        $("#update_profile_image-d").on("change", function () {
            console.log("ok0");
            var file = $("#update_profile_image-d").get(0).files[0];

            if(file){
                var reader = new FileReader();

                reader.onload = function(){
                    $("#updatePreview").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        });


        // post new comment
        $(`.frm_new_comment-d`).each(function(){
                let elm = $(this);
                $(this).validate({
                ignore: ".ignore",
                rules: {
                    comment: {
                        required: true,
                        // minlength: 3,
                    }
                },
                messages: {
                    comment: {
                        required: "Comment is Required",
                        // minlength: "Comment Should have atleast 3 characters",
                    }
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
                                console.log(response);
                                let date = response.data.comment_date;
                                let time = response.data.comment_time;

                                let data_response = response.data.response;
                                console.log(date);
                                console.log(time);



                                let post_id = $(elm).find(".post_id-d").val();
                                console.log('post_id: ', post_id);

                                // let append = $(`.append_div-d_`).addClass(`.append_div-d_${post_id}`);
                                // console.log('append: ', append);

                                // let path = "http://localhost";
                                // if(data_response.comment.profile.profile_image.include(path)) {
                                //     public_path = '';
                                // }


                                // return false;
                                // let data = response.data;
                            console.log(response);
                                div ='<div class="col-1 px-0">' +
                                '<img src="'+public_path+data_response.comment.profile.profile_image +'" width="37" style="height:38px;" class="profile_img rounded-circle border_green-s" alt=""> </div>' +
                                ' <div class="col-lg-11 col-11" >' +
                                '<div class="d-flex justify-content-between">'+
                                '<div><a href="javascript:void(0)"class="td_none-s">'+
                                '<h6 class="fg_green-s mb-0"><strong>'+data_response.comment.profile.first_name+'</strong></h6>'+
                                '<span class="fs_12px-s text-dark">@'+data_response.comment.profile.username+'</span></a></div>'+
                                '<div><span class="fs_12px-s">'+ date + '|' +  time + '</span></div></div>'+
                                '<p class="fs_12px-s">'+data_response.comment.comment+' </p></div>';

                                $(`.append_div-d_${post_id}`).append(div);

                                $(".add_comment-d").val('');

                            }
                            else {
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

        });


        // post like

        $(".post_liked-d").click(function(){
        // $(".user_post_image-d").on('click', '.post_liked-d', function(){

            let elm = $(this);
            console.log('elm: ', elm);

            let post_uuid = $(elm).find(".like_post_uuid-d").val();
            console.log('post_uuid : ', post_uuid );

            let like = $(elm).find('.like-d').val();
            console.log('like: ', like);

            let total_like = $(elm).parent().find('.liked_count-d').text();
            console.log('total_like: ', total_like);
            let total_like_count = $(elm).find('.liked_count_show-d-'+post_uuid).val();
            console.log('total_like_count: ', total_like_count);

            if(like == 0)
            {
                like = 1;
                ++ total_like;
                ++ total_like_count;
                // elm.removeClass("change_color-d");
                $.ajax({
                   type: "GET",
                   url: LikePost,
                   data: {post_uuid: post_uuid, like: like},
                   dataType: 'json',
                   success: function (response) {
                     $(elm).find('.like-d').val(1);
                     $('.liked_count_show-d-'+post_uuid).text(total_like_count);
                     $(elm).find('.liked_count_show-d-'+post_uuid).val(total_like_count);
                     $(elm).parent().find('.liked_count-d').text(total_like);

                      console.log('ok', total_like);
                      $(elm).find(".change_image-d").attr("src", public_path+'images/green_thumbs_up.svg')

                   }
               });
            }
            else if(like == 1) {
                // $(elm).find('').addClass("change_color-d");
                like = 0;
                total_like  = total_like - 1;
                // console.log('total_like_count12342test: ', total_like_count);

                total_like_count  = total_like_count - 1;
                // -- total_like ;
                // -- total_like_count ;
                // console.log('total_like_count12342: ', total_like_count);
                // return false;

                $.ajax({
                   type: "GET",
                   url: LikePost,
                   data: {post_uuid: post_uuid, like: like},
                   dataType: 'json',
                   success: function (response) {

                       $(elm).find(".like-d").val(0);
                       $(".liked_count_show-d-"+post_uuid).text(total_like_count);
                        $(elm).find('.liked_count_show-d-'+post_uuid).val(total_like_count);

                       $(elm).parent().find(".liked_count-d").text(total_like);

                      $(elm).find(".change_image-d").attr("src", public_path+'images/like_black.svg');

                   }
               });
            }


        });

        //delete post delete_post-d

        $(".delete_post-d").on("click", function(){
        // $("span[data-post='true']").on("click", function(){
            //    alert("ok");
            let elm = $(this);

            let post_uuid = $(elm).find(".delete_post_uuid-d").val();
            // console.log(post_uuid);
            // return false;
                $.ajax({
                   type: "GET",
                   url: deletePost,
                   data: {post_uuid: post_uuid},
                   dataType: 'json',
                   success: function (response) {
                       console.log('ok', response);
                       elm.parent().parent().parent().parent().remove();

                       $("#post_modal-d"+post_uuid).modal('hide');

                    //    $("")
                        // return false;
                        // location.reload();
                   }

               });
               console.log('not ok');
               return false;

        });


        //delete post delete_post-d modal
        $(".delete_post_modal-d").on("click", function(){
            // $("span[data-post='true']").on("click", function(){
            //    alert("ok");
            let elm = $(this);

            let post_uuid = $(elm).find(".delete_post_uuid-d").val();

            // console.log(post_uuid);
            // return false;
                $.ajax({
                   type: "GET",
                   url: deletePost,
                   data: {post_uuid: post_uuid},
                   dataType: 'json',
                   success: function (response) {
                       console.log('ok', response);
                       elm.parent().parent().parent().parent().remove();

                       $("#post_modal-d"+post_uuid).modal('hide');

                    //    let div = $(".media_modal-d").attr("data-target");
                    //    console.log('div: ', div);

                    $(".post_modal-d" +post_uuid).remove();

                   }

               });
               console.log('not ok');
               return false;

        });


        // //upload pic button
        // $("#upload_pic-d").on("click", function(){
        //     // location.reload();

        //     let post  = $(".write_post-d").val();
        //     console.log('post: ', post);
        //     if(!post)
        //     {
        //         console.log('not ok');
        //     }
        //     else {
        //         console.log('ok');
        //     }
        //     return false;
        //     $('#upload_pic-d').attr('disabled','disabled');
        //     $("#upload_media-d").submit();
        // });


// Validate and then process registeration form testing testing
//  $.validator.addMethod("file_extension", function (value, element){
//      let file = value;
//     //  accept:  "jpg|jpeg|png|mp4";
//      if(!(accept:  "jpg|jpeg|png|mp4")){
//          return false;
//      }
//     return true;
//  }, 'Please provide image/ in extension for following jpp | jpeg | png | gif | bmp | mp4');

        //upload pic button
        $("#upload_media-d").validate({

        ignore: ".ignore",
        rules: {
            media:{
                required: true,
                // image_exists: true,
                extension: "jpg|jpeg|png|mp4"
                // accept:  "jpg|jpeg|png|mp4",
                // file_extension: true
            },
            caption: {
                required: true,
                minlength: 6,
            }
        },
        messages: {
            media: {
                required: "Image/Video required",
                // image_exists: true,
                extension : "Please provide image/video in extension for following jpp | jpeg | png | gif | mp4 ",
                // accept : "Please provide image/ in extension for following jpp | jpeg | png | gif | bmp | mp4 ",
            },
            caption: {
                required: "Post Comment Required",
                minlength: "Post Comment Should have atleast 6 characters",
            }

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
            // let image = $(".upload_media-d").val();
            // console.log('image: ', image);

            // if($("media").attr('src')) {

            // }

            e.preventDefault();

            form.submit();

        }
    });
    // if($('#previewImg').attr('src') != "") {
    //     console.log("Sdfs");
    //     $('#media12-error').addClass('d-none'); // <- force re-validation
    // }

    // $(".user_post_image-d").on('click', function(){
    //     let elm = $(this);
    //     let uuid = elm.find('.post_uuid-d').val();
    //     console.log('uuid: ', uuid);
    //     let user_post_img_src = elm.find(".user_post_image_src-d").attr('src');
    //     console.log('user_post_img_src: ', user_post_img_src);
    //     let user_profile_img_src = elm.find(".user_profile_image-d").attr('src');
    //     console.log('user_profile_img_src: ', user_profile_img_src);



    // })


    $(".no_of_views-d").on('click', function(){
        let elm = $(this);

        let profile_ids = $(elm).find(".user_profile_id-d").val();
        let post_uuid = $(elm).find(".post_uuid-d").val();

        console.log(profile_ids, post_uuid);
        $.ajax({
            type: "get",
            url: postViewsCount,
            data: {profile_ids: profile_ids, post_uuid: post_uuid},
            dataType: 'json',
            success: function (response) {
                console.log('response: ', response);
                let view_count = response.view_count;

                $(elm).find(".show_view_count-d").text(' '+view_count);
            }
        });
    });



     
   $(".close_post_block_modal-d").on('click', '.close_report_modal-d', function() {
            let elm = this;
            console.log(elm);
            // alert("hi");
            let post_id = $(this).parent().find(".other_post_id-d").val();
                console.log(post_id, $(".other_post_id-d").val());
                let model_close =$("#report_issue_modal-d-"+post_id);
                    console.log(model_close);
                $("#report_issue_modal-d-"+post_id).modal('hide');

        });

})
