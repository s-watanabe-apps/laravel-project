@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fas fa-fw fa-edit"></i>
                    {{sprintf(__('strings.articles_index_title'), $articlesUser->name)}}
                </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-8 mb-12">
            @foreach ($articles as $value)
            <div class="card bg-light text-black shadow">
                <div class="card-body">
                    <div class="h5">{{$value->title}}</div>
                    <hr>
                    <div class="text-black-50 small">#f8f9fc</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-lg-4 mb-12">
            <small><div id='calendar'></div></small>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Full Calendar -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      dayCellContent: function(e) {
        e.dayNumberText = e.dayNumberText.replace('日', '');
      },
      themeSystem: 'bootstrap',
      timeZone: 'UTC',
      initialView: 'dayGridMonth',
      businessHours: true,
      footerToolbar: {
        left: "dayGridMonth,listMonth",
        //center: "title",
        //right: "today prev,next"
      },
      buttonText: {
        today: '@lang('strings.fullcalendar.today')',
        month: '@lang('strings.fullcalendar.month')',
        list: '@lang('strings.fullcalendar.list')'
      },
      locale: '{{\App::getLocale()}}',
      height: "auto",
      contentHeight: 10,
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
      //  title: 'TEST',
      //  start: '2022-04-15',
      //  constraint: 'availableForMeeting', // defined below
      //  color: '#257e4a'
      //}]);
    });

    $('.fc-prev-button').on('click', function(){
      console.log('prev');
    });
  });
</script>
@endsection