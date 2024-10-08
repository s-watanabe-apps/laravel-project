<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$settings['site_name']}}</title>
<!--
        <link rel="stylesheet" href="{{asset('css/app.css')}}"></link>
        <script src="{{asset('js/app.js')}}"></script>
-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

        <link href='https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/styles/default.min.css' rel='stylesheet'>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/highlight.min.js'></script>

        <script src="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/build/jquery.datetimepicker.full.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/jquery.datetimepicker.css">

<!-- expand js -->
<script type='text/javascript'><!--
hljs.initHighlightingOnLoad();
// initialize on page load
window.onload = initExpand;

// toggle class when trigger is clicked
function toggleExpand(t) {
    var name = t.dataset.name;
    var img = t.children[0];
    for (var i = 0; i < 3; i++) {
        var t = t.parentNode;
        //console.log(t.getElementsByTagName('div'));

        if (t.className == 'hide') {
            t.className = 'show';
            img.setAttribute('src', '/img/arrow-down.png');
            document.cookie = name + '=show'
            //console.log(document.cookie);
            break;
        } else if (t.className == 'show') {
            t.className = 'hide';
            img.setAttribute('src', '/img/arrow-right.png');
            document.cookie = name + '=hide'
            //console.log(document.cookie);
            break;
        }
    }
}

// initialize
function initExpand() {
    $("#trigger-1").on('click', function() {
        toggleExpand(this);
    });
    $("#trigger-2").on('click', function() {
        toggleExpand(this);
    });
}

// トップへ戻るアクション
jQuery(function() {
    var pagetop = $('#pagetop');
    pagetop.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {  //100pxスクロールしたら表示
            pagetop.fadeIn();
        } else {
            pagetop.fadeOut();
        }
    });
    pagetop.click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500); //0.5秒かけてトップへ移動
        return false;
    });
});
--></script>

    @include('style')
    </head>
    <body>
        <div id="pagetop"><a href="#top"><i class="fas fa-angle-double-up"></i></a></div>
        @include('header', compact('lang'))
        <div class="grid">
            <div class="side">
                <div class="container pc">
                    <div class="{{$user_menus_status}}">
                        <div class="title">
                            <div id="trigger-1" class="trigger" data-name="user-menus">@lang('strings.member_menus')&nbsp;<img src="/img/arrow-down.png"></img></div>
                        </div>
                        <div class="target user-menus">
                            @if (auth()->check())
                            <ul>
                                <li><a href="/mypage">@lang('strings.mypage')</a>
                                <li><a href="/profiles/{{user()->id}}">@lang('strings.profile')</a>
                                <li><a href="/massages/inbox">@lang('strings.message')</a>
                                <li><a href="/inquiry">@lang('strings.contact_admin')</a>
                                <li><a href="/logout">@lang('auth.logout')</a>
                            </ul>
                            @else
                            <ul>
                                <li><a href="/inquiry">@lang('strings.contact_admin')</a>
                                <li><a href="/login">@lang('auth.login')</a>
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
                @if (user()->role_id == \App\Models\Roles::ADMIN || user()->role_id == \App\Models\Roles::SYSTEM)
                <div class="container pc">
                    <div class="{{$admin_menus_status}}">
                        <div class="title">
                            <div id="trigger-2" class="trigger" data-name="admin-menus">@lang('strings.admin_menus')&nbsp;<img src="/img/arrow-down.png"></img></div>
                        </div>
                        <div class="target admin-menus">
                            <ul>
                                <section>@lang('strings.common_settings')</section>
                                <li><a href="/managements/settings">@lang('strings.site_settings')</a>
                                <li><a href="/managements/navigations">@lang('strings.navigation_management')</a>
                            </ul>
                            <ul>
                                <section>@lang('strings.user_management')</section>
                                <li><a href="/managements/users">@lang('strings.user_management')</a></li>
                                <li><a href="/managements/groups">@lang('strings.group_management')</a></li>
                                <li><a href="/managements/profile/settings">@lang('strings.profile_settings')</a></li>
                            </ul>
                            <ul>
                                <section>@lang('strings.contents_management')</section>
                                <li><a href="/managements/informations">@lang('strings.informations_management')</a></li>
                                <li><a href="/managements/freepages">@lang('strings.freepage_management')</a></li>
                                <li><a href="/managements/uploadfiles">@lang('strings.upload_files')</a></li>
                                <li><a href="/managements/ads">@lang('strings.ads_management')</a></li>
                            </ul>
                            <ul>
                                <section>@lang('strings.inquiry_management')</section>
                                <li><a href="/managements/inquiry/types">@lang('strings.inquiry_type')</a></li>
                                <li><a href="/managements/inquiries">@lang('strings.inquiry_list')</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                <div class="container">
                    <div class="title">{{str_date_format($date)}}&nbsp;<select name="city_id">
                        @foreach($cities as $city)
                        <option value="{{$city['id']}}">
                            @if ($lang == 'ja')
                                {{$city['name']}}
                            @else
                                {{$city['code']}}
                            @endif
                        </option>
                        @endforeach
                    </select></div>
                    <table class="weather">
                        <tbody>
                            <tr>
                            @for($i = 0; $i < 4; $i++)
                                <th>{{date('H:i', strtotime($weathers[$i]['time']))}}</th>
                            @endfor
                            </tr>
                            <tr>
                            @for($i = 0; $i < 4; $i++)
                                <td>
                                @if(isset($weathers[$i]['temp']))
                                    <img src="/images/weather-icons/{{$weathers[$i]['weather_icon']}}@2x.png" />
                                    <br><span class="temp">{{intval($weathers[$i]['temp'])}}℃</span>
                                @else
                                    <span class="temp">-</span>
                                @endif
                                </td>
                            @endfor
                            </tr>
                            <tr>
                            @for($i = 4; $i < 8; $i++)
                                <th>{{date('H:i', strtotime($weathers[$i]['time']))}}</th>
                            @endfor
                            </tr>
                            <tr>
                            @for($i = 4; $i < 8; $i++)
                                <td>
                                @if(isset($weathers[$i]['temp']))
                                    <img src="/images/weather-icons/{{$weathers[$i]['weather_icon']}}@2x.png" />
                                    <br><span class="temp">{{intval($weathers[$i]['temp'])}}℃</span>
                                @else
                                    <span class="temp">-</span>
                                @endif
                                </td>
                            @endfor
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="container">
                    <div class="title">
                        <input id="prev" type="image" src="/img/prev.png"></input>
                        <span id="select_month"></span>
                        <input id="next" type="image" src="/img/next.png"></input>
                    </div>
                    <div id="calendar"></div>
                </div>
                <div class="container">
                    <div class="title">@lang('strings.feature_tags')</div>
                    <div class="feature-tags">
                        @foreach($feature_tags as $tag)
                        <a href="/{{$lang}}/?tag={{$tag['value']}}"><span class="tag">{{$tag['value']}}</span></a>
                        @endforeach
                    </div>
                </div>
                @foreach($ads[\App\Models\Ads::TYPE_SIDE] as $ad)
                <div class="container">
                    <div class="title"><span class="ad">AD</span>{{$ad['title']}}</div>
                    <div class="ad-sns-webapp">
                        {!!$ad['body']!!}
                    </div>
                </div>
                @endforeach
            </div>
            <div class="main">
                @yield('content')
            </div>
        </div>
    </body>
    <script src="{{asset('js/calendar.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js" defer></script>
    <script>
        $(window).on('load', function() {
            $(".lazyload").lazyload();
        });
    </script>
</html>
