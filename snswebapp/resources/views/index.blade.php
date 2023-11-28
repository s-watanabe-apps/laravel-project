@extends('layouts.app')
@section('content')
<!-- Content Row -->
<div class="row">

    <!-- Content Column -->
    <div class="col-lg-8 mb-4">

        <!-- Informations -->
        @foreach ($informations as $information)
        <div class="card shadow mb-3">
            <!-- Card Header - Accordion -->
            <a href="#collapseCard-information-{{$information->id}}" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas {{$information->mark}} text-primary-50"></i>
                    {{$information->title}}
                    @if ($information->is_new)
                    <span class="badge badge-pill badge-success blink">new !</span>
                    @endif
                </h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCard-information-{{$information['id']}}">
                <div class="card-body pb-0 py-2">
                    {!!$information->body!!}

                    <div class="col-12 text-right">
                        <span>{{$information->start_time}}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="d-sm-flex align-items-center justify-content-between">
            <div class="h6 text-gray-800 font-weight-bold">&nbsp;<i class="fas fa-blog"></i> @lang('strings.latest_articles')</div>
        </div>

        @foreach ($articles as $value)
        <div class="card bg-light text-black shadow mb-3">
            <div class="card-body py-3">
                <div class="h6 font-weight-bold">{{$value->title}}</div>
                <div class="">{!!$value->body_text!!}</div>
                
                <div class="row">
                    <div class="col-6 text-left">
                        <span><a href="/articles/{{$value->id}}">@lang('strings.read_article')</a></span>
                    </div>
                    <div class="col-6 text-right">
                        <span>{{$value->created_at->format(\DateFormat::getDateTimeFormat())}}</span>
                        <span>(0)</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


    </div>

    <div class="col-lg-4 mb-4">
        <!-- Calendar -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-calendar-alt text-primary-50"></i>
                    @lang('strings.weekly_calendar')
                </h6>
            </div>
            <table class="table table-bordered">
                <tbody>
                    @foreach ($calendar as $date)
                    <tr>
                        <th class="text-center p-1
                        @switch($date['date']->dayOfWeek)
                            @case(0)
                                text-danger
                            @case(6)
                                text-primary
                            @default
                        @endswitch
                        " style="width:20%;"><small class="font-weight-bold">{{$date['date']->format(\DateFormat::getDateFormatShort())}}</small></th>
                        <td style="width:80%;" class="p-1">
                        @foreach ($date['users'] as $birthdayUser)
                            <small class="mb-0"><a href="/profiles/{{$birthdayUser->id}}"><i class="fas fa-birthday-cake text-danger"></i> {{$birthdayUser->name}}</a></small>
                        @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pb-3 pr-3 text-right">
                <a href="/schedule">@lang('strings.show_more')</a>
            </div>
        </div>

        <!-- AD -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">AD</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                        src="img/undraw_posting_photo.svg" alt="...">
                </div>
            </div>
        </div>

        <!-- AD -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">AD</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                        src="img/undraw_posting_photo.svg" alt="...">
                </div>
            </div>
        </div>

    </div>

</div>
@endsection