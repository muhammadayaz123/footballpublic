



$( document ).ready(function() {

    // if($("for_all_recieve")){

    // socket notification for send invitation
        socket.on('for_all_recieve', function(data) {
                  if(data.type == 'send_invitation_message')
                  {
                      console.log('noti data', data );
                      let reciever_noti_uuid = data.additional_data.data[1];
                      console.log('reciever_noti_data: ', reciever_noti_uuid);

        //               console.log("data un read count", data.additional_data.data[0]);

        //               let total_recieved_notifications = data.additional_data.data[0].unreadCount;
        //               console.log('total_recieved_notifications: ', total_recieved_notifications);

                      if(send_invitation_notification_to_user == reciever_noti_uuid )
                      {
                          $(".show_notification-d").removeClass('d-none');
                      }

                  }

          });
    // }WSSS


    // socket for send chat messages
            socket.on('for_all_recieve', function(data) {
                  if(data.type == 'send_chat_message')
                  {
                      console.log('noti data', data );
                      let reciever_noti_id = data.additional_data.data[0].reciever;
                      console.log('reciever_noti_id: ', reciever_noti_id);

                    //   console.log("data un read count", data.additional_data.data[0]);

                    //   let total_recieved_notifications = data.additional_data.data[0].unreadCount;
                    //   console.log('total_recieved_notifications: ', total_recieved_notifications);
                        console.log(send_chat_notification_to_user == reciever_noti_id);

                      if(send_chat_notification_to_user == reciever_noti_id )
                      {
                          $(".show_notification-d").removeClass('d-none');
                      }

                  }

          });

            // socket for send chat messages
            socket.on('for_all_recieve', function(data) {
                  if(data.type == 'rate_player')
                  {
                      console.log('noti data', data );
                      let reciever_noti_id = data.additional_data.data.rating.player_id;
                      console.log('reciever_noti_id: ', reciever_noti_id);

                        //   console.log("data un read count", data.additional_data.data[0]);

                        //   let total_recieved_notifications = data.additional_data.data[0].unreadCount;
                        //   console.log('total_recieved_notifications: ', total_recieved_notifications);
                        console.log(send_chat_notification_to_user == reciever_noti_id);

                      if(send_chat_notification_to_user == reciever_noti_id )
                      {
                          $(".show_notification-d").removeClass('d-none');
                      }

                  }

          });

	$(`#noti`).on('click', function() {
		$(this).attr('data-route');
        var action = $(this).attr('data-route');
		// console.log("$(this).attr('data-route')", $(this).attr('data-route'));

        $(".show_notification-d").addClass('d-none');


        $.ajax({
            type: "get",
            url: action,
            data: "data",
            dataType: "json",
            beforeSend: function() {
                showPreLoaderNotification();
                console.log("123123");
            },
            success: function (data) {

                console.log(data);
                // return false;

                 if ( data != null ){
                let text = '';
                let noti_message = '';
                let noti_today = '';
                let noti_yesterday = '';
                let noti_older = '';
                $.each(data,function(i,e){
                    console.log(e);
                    // return false;
                    console.log("e.status", e.date_condition);

                    let user_uuid = e.sender.user.uuid;
                    let user_profile_uuid = e.sender.uuid;

                    let user_profile_id = e.sender.id;

                    console.log(otherProfile);
                    let getOtherProfile = otherProfile;

                    // let url = '{{ route("othersProfile", ":uuid", ":profile_uuid", ":user_profile_id") }}';

                    let get_url = getOtherProfile.replace(':uuid', user_uuid ).replace(':profile_uuid', user_profile_uuid).replace(':user_profile_id', user_profile_id);
                    console.log('get_url: ', get_url);

                    let send_user_to_game_invitation = null;

                    if(e.noti_text == 'pending' ){
                        text = `Invited you to join him in his game`
                        noti_message = '';
                        send_user_to_game_invitation = gameInvitation;

                    }
                    if(e.noti_text == 'accepted' ){
                        text = `accepted your ${e.noti_type}`
                        noti_message = '';
                        send_user_to_game_invitation = hirePlayer;

                    }

                    if(e.noti_text == 'sent you a message'){
                        text = `sent you message`
                        noti_message = e.noti_message.slice(0, 15)+'...';
                        send_user_to_game_invitation = getChats;

                    }

                    if(e.noti_text == 'Rate you' ){
                        text = `Rate you`
                        noti_message = '';
                        send_user_to_game_invitation = "";

                    }

                    if( e.date_condition == 'today'  ){
                        noti_today +=
                        `
                            <a class="dropdown-item ${e.is_read == 1 ? 'bg-white' : 'bg_lightgrey-s' }  py-2" href="${send_user_to_game_invitation}/null/${e.type_id}">
                                <div class=" d-flex">
                                    <div>
                                        <img class="rounded-circle " width="35" height= "35" src="${public_path}${e.sender.profile_image}" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <strong class="fg_green-s">
                                            ${e.sender.first_name}
                                        </strong>
                                        <span>
                                            ${text}
                                        </span>
                                        <h6 class="opacity_4-s text-dark fs_14px-s">${moment(e.created_at).fromNow()}</h6>

                                        <p class="mb-0 text-dark fs_14px-s" > ${noti_message} </p>
                                    </div>

                                </div>
                                <hr class="mb-0">
                            </a>
                        `
                    }
                    else if( e.date_condition == 'yesterday'  ){
                        noti_yesterday +=

                        `
                            <a class="dropdown-item ${e.is_read == 1 ? 'bg-white' : 'bg_lightgrey-s' }  py-2" href="${send_user_to_game_invitation}/null/${e.type_id}">
                                <div class=" d-flex">
                                    <div>
                                        <img class="rounded-circle " width="35" height= "35" src="${public_path}${e.sender.profile_image}" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <strong class="fg_green-s">
                                            ${e.sender.first_name}
                                        </strong>
                                        <span>
                                            ${text}
                                        </span>
                                        <h6 class="opacity_4-s text-dark fs_14px-s">${moment(e.created_at).fromNow()}</h6>

                                        <p class="mb-0 text-dark fs_14px-s" > ${noti_message} </p>
                                    </div>

                                </div>
                                <hr class="mb-0">
                            </a>
                        `
                    }
                    else if( e.date_condition == 'older'  ){
                        noti_older +=

                        `
                            <a class="dropdown-item ${e.is_read == 1 ? 'bg-white' : 'bg_lightgrey-s' }  py-2" href="${send_user_to_game_invitation}/null/${e.type_id}">
                                <div class=" d-flex">
                                    <div>
                                        <img class="rounded-circle " width="35" height= "35" src="${public_path}${e.sender.profile_image}" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <strong class="fg_green-s">
                                            ${e.sender.first_name}
                                        </strong>
                                        <span>
                                            ${text}
                                        </span>
                                        <h6 class="opacity_4-s text-dark fs_14px-s">${moment(e.created_at).fromNow()}</h6>

                                        <p class="mb-0 text-dark fs_14px-s" > ${noti_message} </p>
                                    </div>

                                </div>
                                <hr class="mb-0">
                            </a>
                        `
                    }


                 });
                if(noti_today != ''){
                    $(`#today-d`).removeClass(`d-none`);
                    $(`#today-noti-d`).empty();
                }
                if(noti_yesterday != ''){
                    $(`#yesterday-d`).removeClass(`d-none`);
                    $(`#yesterday-noti-d`).empty();
                }
                if(noti_older != ''){
                    $(`#older-d`).removeClass(`d-none`);
                    $(`#older-noti-d`).empty();
                }
                $(`#today-noti-d`).append(noti_today);
                $(`#yesterday-noti-d`).append(noti_yesterday);
                $(`#older-noti-d`).append(noti_older);
                }
            },
            complete: function() {
                hidePreLoaderNotification();
            },

        });


		// $.get($(this).attr('data-route'), function(data){
		//   	console.log(data);
        //     if ( data != null ){
        //         let text = '';
        //         let noti_message = '';
        //         let noti_today = '';
        //         let noti_yesterday = '';
        //         let noti_older = '';
        //         $.each(data,function(i,e){
        //             console.log(e);
        //             // return false;
        //             console.log("e.status", e.date_condition);

        //             let user_uuid = e.sender.user.uuid;
        //             let user_profile_uuid = e.sender.uuid;

        //             let user_profile_id = e.sender.id;

        //             console.log(otherProfile);
        //             let getOtherProfile = otherProfile;

        //             // let url = '{{ route("othersProfile", ":uuid", ":profile_uuid", ":user_profile_id") }}';

        //             let get_url = getOtherProfile.replace(':uuid', user_uuid ).replace(':profile_uuid', user_profile_uuid).replace(':user_profile_id', user_profile_id);
        //             console.log('get_url: ', get_url);

        //             let send_user_to_game_invitation = null;

        //             if(e.noti_text == 'pending' ){
        //                 text = `Invited you to join him in his game`
        //                 noti_message = '';
        //                 send_user_to_game_invitation = gameInvitation;

        //             }
        //             if(e.noti_text == 'accepted' ){
        //                 text = `accepted your ${e.noti_type}`
        //                 noti_message = '';
        //                 send_user_to_game_invitation = hirePlayer;

        //             }

        //             if(e.noti_text == 'sent you a message'){
        //                 text = `sent you message`
        //                 noti_message = e.noti_message.slice(0, 15)+'...';
        //                 send_user_to_game_invitation = getChats;

        //             }

        //             if(e.noti_text == 'Rate you' ){
        //                 text = `Rate you`
        //                 noti_message = '';
        //                 send_user_to_game_invitation = "";

        //             }

        //             if( e.date_condition == 'today'  ){
        //                 noti_today +=
        //                 `
        //                     <a class="dropdown-item ${e.is_read == 1 ? 'bg-white' : 'bg_lightgrey-s' }  py-2" href="${send_user_to_game_invitation}/null/${e.type_id}">
        //                         <div class=" d-flex">
        //                             <div>
        //                                 <img class="rounded-circle " width="35" height= "35" src="${public_path}${e.sender.profile_image}" alt="">
        //                             </div>
        //                             <div class="ml-2">
        //                                 <strong class="fg_green-s">
        //                                     ${e.sender.first_name}
        //                                 </strong>
        //                                 <span>
        //                                     ${text}
        //                                 </span>
        //                                 <h6 class="opacity_4-s text-dark fs_14px-s">${moment(e.created_at).fromNow()}</h6>

        //                                 <p class="mb-0 text-dark fs_14px-s" > ${noti_message} </p>
        //                             </div>

        //                         </div>
        //                         <hr class="mb-0">
        //                     </a>
        //                 `
        //             }
        //             else if( e.date_condition == 'yesterday'  ){
        //                 noti_yesterday +=

        //                 `
        //                     <a class="dropdown-item ${e.is_read == 1 ? 'bg-white' : 'bg_lightgrey-s' }  py-2" href="${send_user_to_game_invitation}/null/${e.type_id}">
        //                         <div class=" d-flex">
        //                             <div>
        //                                 <img class="rounded-circle " width="35" height= "35" src="${public_path}${e.sender.profile_image}" alt="">
        //                             </div>
        //                             <div class="ml-2">
        //                                 <strong class="fg_green-s">
        //                                     ${e.sender.first_name}
        //                                 </strong>
        //                                 <span>
        //                                     ${text}
        //                                 </span>
        //                                 <h6 class="opacity_4-s text-dark fs_14px-s">${moment(e.created_at).fromNow()}</h6>

        //                                 <p class="mb-0 text-dark fs_14px-s" > ${noti_message} </p>
        //                             </div>

        //                         </div>
        //                         <hr class="mb-0">
        //                     </a>
        //                 `
        //             }
        //             else if( e.date_condition == 'older'  ){
        //                 noti_older +=

        //                 `
        //                     <a class="dropdown-item ${e.is_read == 1 ? 'bg-white' : 'bg_lightgrey-s' }  py-2" href="${send_user_to_game_invitation}/null/${e.type_id}">
        //                         <div class=" d-flex">
        //                             <div>
        //                                 <img class="rounded-circle " width="35" height= "35" src="${public_path}${e.sender.profile_image}" alt="">
        //                             </div>
        //                             <div class="ml-2">
        //                                 <strong class="fg_green-s">
        //                                     ${e.sender.first_name}
        //                                 </strong>
        //                                 <span>
        //                                     ${text}
        //                                 </span>
        //                                 <h6 class="opacity_4-s text-dark fs_14px-s">${moment(e.created_at).fromNow()}</h6>

        //                                 <p class="mb-0 text-dark fs_14px-s" > ${noti_message} </p>
        //                             </div>

        //                         </div>
        //                         <hr class="mb-0">
        //                     </a>
        //                 `
        //             }


        //          });
        //         if(noti_today != ''){
        //             $(`#today-d`).removeClass(`d-none`);
        //             $(`#today-noti-d`).empty();
        //         }
        //         if(noti_yesterday != ''){
        //             $(`#yesterday-d`).removeClass(`d-none`);
        //             $(`#yesterday-noti-d`).empty();
        //         }
        //         if(noti_older != ''){
        //             $(`#older-d`).removeClass(`d-none`);
        //             $(`#older-noti-d`).empty();
        //         }
        //         $(`#today-noti-d`).append(noti_today);
        //         $(`#yesterday-noti-d`).append(noti_yesterday);
        //         $(`#older-noti-d`).append(noti_older);
        //     }
		//   });
	});

    let aglity = 5;

	$(function() {
		var timeout = 3000; // in miliseconds (3*1000)
		$('.alert').delay(timeout).fadeOut(300);
	});
    //Radar chart js
    $(`#ability`).on('change', function () {
       aglity = $(this).val();

       setInterval(function(){
            myChart.data.datasets[0].data[1] = aglity;
            myChart.update();
        });
    });

    $(`#pace`).on('change', function () {
       pace = $(this).val();

       setInterval(function(){
            myChart.data.datasets[0].data[0] = pace;
            myChart.update();
        });
    });

    $(`#stamina`).on('change', function () {
       stamina = $(this).val();

       setInterval(function(){
            myChart.data.datasets[0].data[2] = stamina;
            myChart.update();
        });
    });

    $(`#strength`).on('change', function () {
       strength = $(this).val();

       setInterval(function(){
            myChart.data.datasets[0].data[3] = strength;
            myChart.update();
        });
    });

    $(`#passes`).on('change', function () {
       passes = $(this).val();

       setInterval(function(){
            myChart.data.datasets[0].data[4] = passes;
            myChart.update();
        });
    });
            // animations: {
            //   tension: {
            //     duration: 1,
            //     easing: 'linear',
            //   }
            // },
    $(`#shoots`).on('change', function () {
       shoots = $(this).val();

       setInterval(function(){
            myChart.data.datasets[0].data[5] = shoots;
            myChart.update();
        });
    });


    var ctx = document.getElementById('myChart');
    if(ctx != null){
        var myChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: [
                    'Pace',
                    'Agility',
                    'Stamina',
                    'Strength',
                    'Passing',
                    'Shooting',
                ],
                datasets: [{
                    label: 'Player Rating',
                    data: [$(`#pace`).val(), $(`#ability`).val(), $(`#stamina`).val(), $(`#strength`).val(), $(`#passes`).val(), $(`#shoots`).val()],
                    fill: true,
                    backgroundColor: 'rgba(34,139,34, 0.4)',
                    borderColor: 'rgb(34,139,34)',
                    borderWidth:'5px',
                    pointBackgroundColor: 'rgb(34,139,34)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(34,139,34)',
                }]

            },
            options: {
                responsive: true,
                animations:  false,
                scales: {
                    r: {
                        max: 5,
                            min: 0,
                        grid: {
                            circular: true,
                        },
                        ticks: {
                            stepSize: 0.5,
                            backdropColor: 'transparent',
                        }
                    },
                },
                plugins:{
                    legend:{
                    display:false
                    }
                }
            }
        });
    }



      var ctx = document.getElementById('myProfileChart');
    if(ctx != null){
        var myChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: [
                    'Pace',
                    'Agility',
                    'Stamina',
                    'Strength',
                    'Passing',
                    'Shooting',
                ],
                datasets: [{
                    label: 'Player Rating',
                    data: [$(`#pace`).val(), $(`#ability`).val(), $(`#stamina`).val(), $(`#strength`).val(), $(`#passes`).val(), $(`#shoots`).val()],
                    fill: true,
                    backgroundColor: 'rgba(34,139,34, 0.4)',
                    borderColor: 'rgb(34,139,34)',
                    pointBackgroundColor: 'rgb(34,139,34)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(34,139,34)',

                }]
            },
            options: {
                responsive: true,
                animations:  false,
                scales: {
                    r: {
                        max: 5,
                            min: 0,
                        grid: {
                            circular: true,
                        },
                        ticks: {
                            stepSize: 0.5,
                            backdropColor: 'transparent',
                        }
                    },
                },
                plugins:{
                    legend:{
                    display:false
                    }
                }
            }
        });
    }



    var ctxr = document.getElementById('my_Chart-d');
    if(ctxr != null){
        var myChart = new Chart(ctxr, {
            type: 'radar',
            data: {
                labels: [
                    'Pace',
                    'Agility',
                    'Stamina',
                    'Strength',
                    'Passing',
                    'Shooting',
                ],
                datasets: [{
                    label: 'Player Rating',
                    data: [$(`#pace`).val(), $(`#ability`).val(), $(`#stamina`).val(), $(`#strength`).val(), $(`#passes`).val(), $(`#shoots`).val()],
                    fill: true,
                    backgroundColor: 'rgba(34,139,34, 0.4)',
                    borderColor: 'rgb(34,139,34)',
                    pointBackgroundColor: 'rgb(34,139,34)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(34,139,34)',

                }]

            },
            options: {
                responsive: true,
                animations:  false,
                scales: {
                    r: {
                        max: 5,
                            min: 0,
                        grid: {
                            circular: true,
                        },
                        ticks: {
                            stepSize: 0.5,
                            backdropColor: 'transparent',
                        }
                    },
                },
                plugins:{
                    legend:{
                    display:false
                    }
                }
            }
        });
    }


    $(`.remove_img-s`).on('click',function() {
        $(`#previewImg`).attr('src','');
        $(`.previewImg2`).attr('src','');
        $(this).parent().addClass('d-none');
        $("#media12").val('');
        $("#media13").val('');
        $(".get_link2-d").val('');
        $(".get_link-d").val('');
        $(".hide_upload_image-d").addClass('d-none');

        // $(".video_preview").attr('src','');
        $(".video_preview").remove();
    });




    $(".show_no_modal-d").on('click', function () {
        $("#player_played_modal-d").modal('hide');

        $("#player_not_played_modal-d").modal('show');
    })

    $("#country_code-d").on('change' , function(e) {
        console.log($('#country_code-d').val());
        $("#phone_number-d").val($(this).data("dial-code"));
        console.log($("#phone_number-d").val($(this).data("dial-code")));
    });

    // $('.modal').on('click', `.show_no_modal-d`, function(e) {

    //     switchModal('player_played_modal-d', 'player_not_played_modal-d');
    // });

    // Chart.pluginService.register({
    //     beforeDraw: function(chart) {
    //       var width = chart.chart.width,
    //           height = chart.chart.height,
    //           ctx = chart.chart.ctx;

    //       ctx.restore();
    //       var fontSize = (height / 114).toFixed(2);
    //       ctx.font = fontSize + "em sans-serif";
    //       ctx.textBaseline = "middle";

    //       var text = "75%",
    //           textX = Math.round((width - ctx.measureText(text).width) / 2),
    //           textY = height / 2;

    //       ctx.fillText(text, textX, textY);
    //       ctx.save();
    //     }
    //   });
    console.log("total_amount" , $(".total_amount_recieved-d").text());
    var ctrx = document.getElementById('donut_chart-d');
    if(ctrx != null){
        var myDoughnutChart = new Chart(ctrx, {
            type: 'doughnut',
            data: {

                datasets: [{
                    label: 'My First Dataset',
                    data: [$(".total_amount_recieved-d").text(), $(".total_amount_sent-d").text(), $(".total_amount_pending-d").text()],
                    backgroundColor: [
                      'green',
                      'red',
                      '#E5EEE7'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                elements: {
                    center: {
                      text: 'Red is 2/3 of the total numbers',
                      color: '#FF6384', // Default is #000000
                      fontStyle: 'Arial', // Default is Arial
                      sidePadding: 20, // Default is 20 (as a percentage)
                      minFontSize: 25, // Default is 20 (in px), set to false and text will not wrap.
                      lineHeight: 25 // Default is 25 (in px), used for when text wraps
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            },
        });
    }


});
