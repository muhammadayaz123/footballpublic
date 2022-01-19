
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>



    {{--  <script src="jquery.min.js" type="text/javascript"></script>
    <script src="jquery.timeago.js" type="text/javascript"></script>  --}}



    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#wrapper .version strong').text('v' + $.fn.pignoseCalendar.version);


                const today = new Date();
                const yesterday = new Date(today);

                yesterday.setDate(yesterday.getDate() - 1);
                today.toDateString()

                let yest = yesterday.toISOString().split('T')[0]
                let current_date = today.toISOString().split('T')[0]

                // console.log('yest: ', yest);
                // console.log('tod: ', tod);
                function onSelectHandler(date, context) {
                    console.log('date: ', date);
                /**
                 * @date is an array which be included dates(clicked date at first index)
                 * @context is an object which stored calendar interal data.
                 * @context.calendar is a root element reference.
                 * @context.calendar is a calendar element reference.
                 * @context.storage.activeDates is all toggled data, If you use toggle type calendar.
                 * @context.storage.events is all events associated to this date
                 */
                var $element = context.element;
                var $calendar = context.calendar;
                var $box = $element.siblings('.box').show();
                var text = '';

                if (date[0] !== null) {
                    text += date[0].format('YYYY-MM-DD');
                }

                if (date[0] !== null && date[1] !== null) {
                    text += ' ~ ';
                } else if (date[0] === null && date[1] == null) {
                    text += 'nothing';
                }

                if (date[1] !== null) {
                    text += date[1].format('YYYY-MM-DD');
                }

                let change = moment(text).format('DD/MM/YYYY')
                console.log('change: ', change);

                // $(".select_invitation_date-d").text('dd/mm/yyyy');
                // $(".select_date-d").removeClass('d-none');
                // $(".input_select_invitation_date-d").val('');
                // $("#exampleModal").modal('hide');

                if(change === 'Invalid date')
                {
                    $(".select_invitation_date-d").text('dd/mm/yyyy');
                    $(".select_date-d").removeClass('d-none');
                    $(".input_select_invitation_date-d").val('');
                    $("#exampleModal").modal('hide');

                }
                else {
                    $(".select_invitation_date-d").text(change);
                    $(".select_date-d").addClass('d-none');
                    $(".input_select_invitation_date-d").val(text);
                    $("#exampleModal").modal('hide');
                }

                $box.text(text);

                $(".filter_by_date-d").val(text);
                $(`#date_of_birth-d`).val(text);
                $('.dropdown-menu').removeClass('show');
                // console.log(change);
                // console.log(text);

            }

            function onApplyHandler(date, context) {
                /**
                 * @date is an array which be included dates(clicked date at first index)
                 * @context is an object which stored calendar interal data.
                 * @context.calendar is a root element reference.
                 * @context.calendar is a calendar element reference.
                 * @context.storage.activeDates is all toggled data, If you use toggle type calendar.
                 * @context.storage.events is all events associated to this date
                 */

                var $element = context.element;
                var $calendar = context.calendar;
                var $box = $element.siblings('.box').show();
                var text = 'You applied date ';

                if (date[0] !== null) {
                    text += date[0].format('YYYY-MM-DD');
                }

                if (date[0] !== null && date[1] !== null) {
                    text += ' ~ ';
                } else if (date[0] === null && date[1] == null) {
                    text += 'nothing';
                }

                if (date[1] !== null) {
                    text += date[1].format('YYYY-MM-DD');
                }

                $box.text(text);

            }

            // Default Calendar
            $('.calendar').pignoseCalendar({

                dateFormat: 'dd / mm / yy',
                minDate: current_date,
                select: onSelectHandler,
                // toggle: true,

            });

            $('.calendar_2').pignoseCalendar({

                dateFormat: 'dd / mm / yy',
                select: onSelectHandler,

            });


            $('.calendar3').pignoseCalendar({
                page: function(info, context) {
                    /**
                     * @params context PignoseCalendarPageInfo
                     * @params context PignoseCalendarContext
                     * @returns void
                     */

                    // This is clicked arrow button element.
                    var $this = $(this);

                    // `info` parameter gives useful information of current date.
                    var type = info.type; // it will be one of `next`, `prev`, `unkown`.
                    var year = info.year; // current year (number type), ex: 2017
                    var month = info.month; // current month (number type), ex: 6
                    var day = info.day; // current day (number type), ex: 22

                    // You can get target element in `context` variable.
                    var $element = context.element;

                    // You can also get calendar element, It is calendar view DOM.
                    var $calendar = context.calendar;
                },
                 dateFormat: 'dd / mm / yy',
                minDate: current_date,
                select: onSelectHandler
            });


            // Input Calendar
            $('.input-calendar').pignoseCalendar({
                apply: onApplyHandler,
                buttons: true, // It means you can give bottom button controller to the modal which be opened when you click.
            });

            // Calendar modal
            var $btn = $('.btn-calendar').pignoseCalendar({
                apply: onApplyHandler,
                modal: true, // It means modal will be showed when you click the target button.
                buttons: true
            });

            // Color theme type Calendar
            $('.calendar-dark').pignoseCalendar({
                theme: 'dark', // light, dark, blue
                select: onSelectHandler
            });

            // Blue theme type Calendar
            $('.calendar-blue').pignoseCalendar({
                theme: 'blue', // light, dark, blue
                select: onSelectHandler
            });

            // Schedule Calendar
            $('.calendar-schedules').pignoseCalendar({
                scheduleOptions: {
                    colors: {
                        holiday: '#2fabb7',
                        seminar: '#5c6270',
                        meetup: '#ef8080'
                    }
                },
                schedules: [{
                    name: 'holiday',
                    date: '2017-08-08'
                }, {
                    name: 'holiday',
                    date: '2017-09-16'
                }, {
                    name: 'holiday',
                    date: '2017-10-01',
                }, {
                    name: 'holiday',
                    date: '2017-10-05'
                }, {
                    name: 'holiday',
                    date: '2017-10-18',
                }, {
                    name: 'seminar',
                    date: '2017-11-14'
                }, {
                    name: 'seminar',
                    date: '2017-12-01',
                }, {
                    name: 'meetup',
                    date: '2018-01-16'
                }, {
                    name: 'meetup',
                    date: '2018-02-01',
                }, {
                    name: 'meetup',
                    date: '2018-02-18'
                }, {
                    name: 'meetup',
                    date: '2018-03-04',
                }, {
                    name: 'meetup',
                    date: '2018-04-01'
                }, {
                    name: 'meetup',
                    date: '2018-04-19',
                }],
                select: function(date, context) {
                    var message = `You selected ${(date[0] === null ? 'null' : date[0].format('YYYY-MM-DD'))}.
							   <br />
							   <br />
							   <strong>Events for this date</strong>
							   <br />
							   <br />
							   <div class="schedules-date"></div>`;
                    var $target = context.calendar.parent().next().show().html(message);

                    for (var idx in context.storage.schedules) {
                        var schedule = context.storage.schedules[idx];
                        if (typeof schedule !== 'object') {
                            continue;
                        }
                        $target.find('.schedules-date').append('<span class="ui label default">' + schedule.name + '</span>');
                    }
                }
            });

            // Multiple picker type Calendar
            $('.multi-select-calendar').pignoseCalendar({
                multiple: true,
                select: onSelectHandler
            });

            // Toggle type Calendar
            $('.toggle-calendar').pignoseCalendar({
                toggle: true,
                select: function(date, context) {
                    var message = `You selected ${(date[0] === null ? 'null' : date[0].format('YYYY-MM-DD'))}.
                                <br />
                                <br />
                                <strong>Events for this date</strong>
                                <br />
                                <br />
                                <div class="active-dates"></div>`;
                    var $target = context.calendar.parent().next().show().html(message);

                    for (var idx in context.storage.activeDates) {
                        var date = context.storage.activeDates[idx];
                        if (typeof date !== '<span class="ui label"><i class="fas fa-code"></i>string</span>') {
                            continue;
                        }
                        $target.find('.active-dates').append('<span class="ui label default">' + date + '</span>');
                    }
                }
            });

            // Disabled date settings.
            (function() {
                // IIFE Closure
                var times = 30;
                var disabledDates = [];
                for (var i = 0; i < times; /* Do not increase index */ ) {
                    var year = moment().year();
                    var month = 0;
                    var day = parseInt(Math.random() * 364 + 1);
                    var date = moment().year(year).month(month).date(day).format('YYYY-MM-DD');
                    if ($.inArray(date, disabledDates) === -1) {
                        disabledDates.push(date);
                        i++;
                    }
                }

                disabledDates.sort();

                var $dates = $('.disabled-dates-calendar').siblings('.guide').find('.guide-dates');
                for (var idx in disabledDates) {
                    $dates.append('<span>' + disabledDates[idx] + '</span>');
                }

                $('.disabled-dates-calendar').pignoseCalendar({
                    select: onSelectHandler,
                    disabledDates: disabledDates
                });
            }());

            // Disabled Weekdays Calendar.
            $('.disabled-weekdays-calendar').pignoseCalendar({
                select: onSelectHandler,
                disabledWeekdays: [0, 6]
            });

            // Disabled Range Calendar.
            var minDate = moment().set('dates', Math.min(moment().day(), 2 + 1)).format('YYYY-MM-DD');
            var maxDate = moment().set('dates', Math.max(moment().day(), 24 + 1)).format('YYYY-MM-DD');
            $('.disabled-range-calendar').pignoseCalendar({
                select: onSelectHandler,
                minDate: minDate,
                maxDate: maxDate
            });

            // Multiple Week Select
            $('.pick-weeks-calendar').pignoseCalendar({
                pickWeeks: true,
                multiple: true,
                select: onSelectHandler
            });

            // Disabled Ranges Calendar.
            $('.disabled-ranges-calendar').pignoseCalendar({
                select: onSelectHandler,
                disabledRanges: [
                    ['2016-10-05', '2016-10-21'],
                    ['2016-11-01', '2016-11-07'],
                    ['2016-11-19', '2016-11-21'],
                    ['2016-12-05', '2016-12-08'],
                    ['2016-12-17', '2016-12-18'],
                    ['2016-12-29', '2016-12-30'],
                    ['2017-01-10', '2017-01-20'],
                    ['2017-02-10', '2017-04-11'],
                    ['2017-07-04', '2017-07-09'],
                    ['2017-12-01', '2017-12-25'],
                    ['2018-02-10', '2018-02-26'],
                    ['2018-05-10', '2018-09-17'],
                ]
            });

            // I18N Calendar
            $('.language-calendar').each(function() {
                var $this = $(this);
                var lang = $this.data('lang');
                $this.pignoseCalendar({
                    lang: lang
                });
            });

            // This use for DEMO page tab component.
            // $('.menu .item').tab();
        });
        //]]>
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script type="text/javascript" src="{{ asset('assets/js/pignose.calendar.full.min.js') }}"></script>

    <!-- Begin emoji-picker JavaScript -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/util.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.emojiarea.js') }}"></script>
    <script src="{{ asset('assets/js/emoji-picker.js') }}"></script>
    <!-- End emoji-picker JavaScript -->

    <script src="{{ asset('assets/js/functional.js') }}"></script>
    <script src="{{ asset('assets/js/common.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/profile.js') }}"></script>
    <script src="{{ asset('assets/js/media.js') }}"></script>
    <script src="{{ asset('assets/js/invitation.js') }}"></script>
    <script src="{{ asset('assets/js/rate.js') }}"></script>
    <script src="{{ asset('assets/js/chat.js') }}"></script>
    <script src="{{ asset('assets/js/share.js') }}"></script>
    <script src="{{ asset('assets/js/admin.js') }}"></script>
    <script src="{{ asset('assets/js/chatbox.js') }}"></script>
    <script src="{{ asset('assets/js/location.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    {{--  <script src="{{ asset('assets/js/marker.js') }}"  type="text/javascript"></script>  --}}

    <script>
        let HOMEURL = "{{ route('home') }}";
        let playersByLocation = "{{ route('playersByLocation') }}";

        let MEDIA_POST = "{{ route('getUserMediaPost') }}"

        // let public_path = "http://localhost/football/public/";
        let public_path =  "{{ config('app.url').'/public/' }}" ;


        let ACCEPT_OR_REJECT = "{{ route('acceptRejectInvitation') }}";

        let CANCEL_INVITATION_BY_HOST = "{{ route('cancelInvitation')}}";

        let LikePost = "{{ route('likePost') }}";

        let singleChat = "{{ route('chat') }}";

        let current_user_id = "{{ Auth::user()->id }}";

        let deleteMessage = "{{ route('deleteUserMessage') }}";

        let deletePost = "{{ route('deletePost') }}";

        let deleteChat = "{{ route('deleteChat') }}";

        //admin side
        let deleteUser =  "{{ route('delete_user') }}";

        let block_user = "{{ route('block_player') }}";

        let send_invitation_notification_to_user = "{{ Auth::user()->uuid }}";
        let send_chat_notification_to_user = "{{ Auth::user()->id }}";


        //get on game invitations
        let gameInvitation = "{{ route('game_invitation') }}";

        //get on game invitations
        let hirePlayer = "{{ route('hirePlayer') }}";

        // already rated player

        let ratedPlayer = "{{ route('ratedPlayer') }}";


        //get other profile
        let otherProfile = '{{ route("othersProfile", [":uuid", ":profile_uuid", ":user_profile_id"]) }}';

        let getChats = '{{ route("chat") }}';
        let userChat = '{{ route("userChat") }}';

        // let sendInvitation = "{{ route('getSignleUser', Auth::user()->uuid) }}"

        let postViewsCount = '{{ route("postViewsCount")}}';


        let chatBox = '{{ route("chatBoxSendMessage") }}';

        // unread_count set 0
        let unreadChatCount = "{{ route('chatUnReadCount')}}";

    </script>

    <script>
        $(function() {
            // Initializes and creates emoji set from sprite sheet
            window.emojiPicker = new EmojiPicker({
            emojiable_selector: '[data-emojiable=true]',
            assetsPath: "{{asset('assets/img/')}}",
            popupButtonClasses: 'fa fa-smile-o'
            });
            // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
            // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
            // It can be called as many times as necessary; previously converted input fields will not be converted again
            window.emojiPicker.discover();
        });
    </script>
    <script>
        // Google Analytics
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-49610253-3', 'auto');
        ga('send', 'pageview');
    </script>



</body>

</html>
