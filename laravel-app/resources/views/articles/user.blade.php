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
            <table id="dataTable" class="display cell-border compact responsive nowrap" style="margin: unset; width: 100%;">
                <thead>
                    <tr class="text-nowrap">
                        <th class="dt-center">ID</th>
                        <th class="dt-center">@lang('strings.title')</th>
                        <th class="dt-center">@lang('strings.contribute_date')</th>
                        <th class="dt-center">@lang('strings.updated_at')</th>
                        @if ($articlesUser->id == $user->id)
                        <th class="dt-center">@lang('strings.status')</th>
                        <th class="dt-center">@lang('strings.comment_count')</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $value)
                    <tr>
                        <td class="dt-center">
                            {{$value->id}}
                        </td>
                        <td class="dt-center">
                            <a href="/articles/{{$value->id}}">{{$value->title}}</a>
                        </td>
                        <td class="dt-center">
                            {{$value->created_at->format($dateFormat->getDateFormat())}}
                        </td>
                        <td class="dt-center">
                            {{$value->updated_at->format($dateFormat->getDateFormat())}}
                        </td>
                        @if ($articlesUser->id == $user->id)
                        <td class="dt-center">
                            <input type="checkbox"
                                @if ($value->status == \App\Libs\Status::ENABLED)
                                    checked                                                
                                @endif
                                data-onstyle="success" data-offstyle="secondary"
                                data-toggle="toggle"
                                data-size="sm"
                                data-on="@lang('strings.enable')"
                                data-off="@lang('strings.disable')" />
                        </td>
                        <td class="dt-center">
                            10
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="col-lg-4 mb-12">
            <small><div id='calendar'></div></small>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- DataTables -->
@include('shared.datatables')

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