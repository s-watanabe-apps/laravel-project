@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-calendar-alt"></i> @lang('strings.monthry_calendar')</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-10">
        <div id='calendar'></div>
    </div>
    <div class="col-md-2">
        AD
    </div>
</div>


<!-- Full Calendar -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            timeZone: 'UTC',
            initialView: 'dayGridMonth',
            businessHours: true,
            headerToolbar: {
                left: "dayGridMonth,listMonth",
                center: "title",
                right: "today prev,next"
            },
            buttonText: {
                today: '@lang('strings.fullcalendar.today')',
                month: '@lang('strings.fullcalendar.month')',
                list: '@lang('strings.fullcalendar.list')'
            },
            locale: '{{\App::getLocale()}}',
            //events: {!!$events!!},
/**
            [
                {
                    title: 'Test 1',
                    start: '2022-03-25',
                    url: 'https://google.com/'
                },
                {
                    title: 'Meeting',
                    start: '2022-03-28T11:00:00',
                    constraint: 'availableForMeeting', // defined below
                    color: '#257e4a'
                },
                {
                    title: 'Conference',
                    constraint: 'businessHours',
                    start: '2022-03-15',
                    end: '2022-03-18'
                }
            ],
 */
            //events: 'https://fullcalendar.io/api/demo-feeds/events.json',
            events: '/api/events',
            editable: true,
            selectable: true
        });

        calendar.render();

        calendar.on('dateClick', function(info) {
            console.log('clicked on ' + info.dateStr);
        });

        $('.fc-next-button').on('click', function(){
            console.log('next');
            //calendar.addEventSource([{
            //    title: 'TEST',
            //    start: '2022-04-15',
            //    constraint: 'availableForMeeting', // defined below
            //    color: '#257e4a'
            //}]);
        });

        $('.fc-prev-button').on('click', function(){
            console.log('prev');
        });
    });
</script>
@endsection