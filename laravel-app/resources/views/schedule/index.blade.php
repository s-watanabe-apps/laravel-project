@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-calendar-alt"></i>@lang('strings.monthry_calendar')</li>
            </ol>
        </nav>
    </div>

    <div id='calendar'></div>

</div>
<!-- /.container-fluid -->

<!-- Full Calendar -->
<script src="../packages/core/locales-all.js"></script>
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      timeZone: 'UTC',
      initialView: 'dayGridMonth',
      businessHours: true,
      headerToolbar: {
        left: "dayGridMonth,listMonth",
        center: "title",
        right: "today prev,next"
      },
      buttonText: {
        today: '今月',
        month: '月',
        list: 'リスト'
      },
      locale: 'ja',
      events: {!!$events!!},
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
      editable: true,
      selectable: true
    });

    calendar.render();
  });
</script>
@endsection