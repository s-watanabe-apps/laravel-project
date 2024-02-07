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
        <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        <link href='https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/styles/default.min.css' rel='stylesheet'>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/highlight.min.js'></script>

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
--></script>


<style>
.trigger {
    cursor: pointer;
}
.hide .target {
    display:none;
}
body {
    position: relative;
    top: 52px;
    font-family: 'Nunito', sans-serif;
    margin-right: auto;
    margin-left: auto;
    max-width: 992px;
    min-height: 800px;
    border-left: 1px solid;
    border-right: 1px solid;
}

a {
    text-decoration: none;
}
a:hover {
    opacity: 0.7;
}
p {
    margin: 0 !important;
}
input[type = "submit"],
input[type = "button"],
input[type = "text"],
input[type = "select"] {
    padding: 3px;
    min-width: 100px;
}
input[type = "submit"],
input[type = "button"] {
    margin: 0 8px 0 8px;
}
input.search {
    background: #0000cd;
    font-weight: bold;
    color: #dddddd;
}
input.post {
    background: #2e8b57;
    font-weight: bold;
    color: #dddddd;
}
input.cancel {
    background: #bcbcbc;
    font-weight: bold;
    color: #676767;
}
label.file {
    font-size: 14px;
    background: #0000cd;
    font-weight: bold;
    color: #dddddd;
    cursor: pointer;
    padding: 3px 6px 3px 6px;
    border: 2px solid #444;
}
select {
    padding: 3px;
}
img {
    border-radius: 5px;
}
header {
    max-width: 992px;
    height: auto;
    width: 100%;
    position: fixed;
    top: 0;
    z-index: 10;
    display: grid;
}
.logo {
  font-size: 25px;
}
nav {
  margin: 0 0 0 auto;
}
nav > ul {
  display: flex;
  list-style: none;
  padding: 0;
  margin: 0;
}
header a {
  color: #ffffff;
  text-decoration: none;
  display: block;
  line-height: 60px;
  padding: 0 20px;
}
header .sm {
  display: none;
}
.grid {
    display: flex;
}
.main {
    width: 75%;
    padding: 6px 12px 6px 12px;
    min-height: 800px;
}
.main > .container {
    padding-top: 8px;
    border-bottom: 2px dotted #ddd;
}
.main > .container:last-child {
    padding-top: 8px;
    border-bottom: none;
}
.subject {
    font-size: larger;
    font-weight: bold;
    word-break: break-all;
    padding: 10px 0px 6px 0px;
    border-bottom: 2px solid #eee;
    margin-bottom: 10px;
}
.body {
    display: flex;
    margin: 3px 0px 5px 0px;
    word-break: break-all;
}
.body > .image {
    width: 160px;
    height: auto;
    margin-right: 10px;
}
.description {
    display: grid;
    word-break: break-all;
    width: 100%;
}
.source {
    margin: 3px 0px 5px 0px;
    font-size: 14px;
    text-align: right;
    width: 100%;
    word-break: break-all;
}
.footer {
    display: flex;
}
.tags {
    margin-bottom: 10px;
    display: flex;
}
.grid-contents {
    display: flex;
}
.contents {
}
.w-20 {
    padding: 0 5px 0 5px;
    margin: 0 4px 0 4px;
    width: 20%;
}
.w-25 {
    padding: 0 5px 0 5px;
    margin: 0 4px 0 4px;
    width: 25%;
}
.w-33 {
    padding: 0 5px 0 5px;
    margin: 0 4px 0 4px;
    width: 33%;
}
.w-50 {
    padding: 0 5px 0 5px;
    margin: 0 4px 0 4px;
    width: 50%;
}
.w-75 {
    padding: 0 5px 0 5px;
    margin: 0 4px 0 4px;
    width: 75%;
}

.profile-image {
    width: 100%;
    max-height: 165px;
    object-fit: contain;
}

span.tag {
    border:2px solid;
    border-radius: 15px;
    padding-left: 5px;
    padding-right: 5px;
    margin-left: 2px;
    margin-right: 2px;
    font-size: 14px;
    font-weight: bold;
    color: #565656;
    white-space: nowrap;
}
.pagination {
    text-align: center;
    font-size: 20px;
    padding-top: 10px;
}
.pagination > a {
    padding: 10px;
}
.title {
    font-size: midium;
    font-weight: bold;
    word-break: break-all;
    padding-top: 5px;
}
.side {
    width: 25%;
    padding: 8px;
    padding-top: 20px;
}
.side > .container {
    text-align: center;
    padding-bottom: 16px;
    padding-left: 5px;
    padding-right: 5px;
}
.side > .container > .title {
    padding-bottom: 5px;
    font-weight: bold;
}
.feature-tags {
    line-height: 30px;
    text-align: center;
    border: 1px solid #bbb;
    padding: 5px 3px 5px 3px;
}
span.ad {
    background: #dedede;
    border: 2px solid #9a9a9a;
    font-size: 10px;
    margin: 0 3px 0 0;
    padding: 0 2px 0 2px;
    position: relative;
    top: -2px;
}

.ad-sns-webapp {
    background: #ffffe0;
    border:2px solid #2e8b57;
    padding: 5px;
    text-align: left;
    font-size: 14px;
}

.hidden_radio {
    display: none;
}

input[type="radio"]:checked + label > div {
    outline:3px solid #ff0000;
}

/* Calendar */
#calendar {
    display: flex;
    flex-wrap: wrap;
}
#calendar table {
    border-spacing: 0;
    border-collapse: collapse;
    background: #fefefe;
    color: #565656;
}
#calendar table td {
    border: 1px solid;
    padding: 5px;
    text-align: center;
}
td.today {
    background: #ffccee;
}
#calendar > section > table th {
    border: 1px solid;
    text-align: center;
    font-size: 11px;
    height: 30px;
}

#calendar > section > table td:first-child,
#calendar > section > table th:first-child  {
    color: red;
}

#calendar > section > table td:last-child,
#calendar > section > table th:last-child {
    color: royalblue;
}

td.is-disabled {
    color: #ccc !important;
}
input#prev, input#next {
    width: 18px;
    height: 18px;
    position: relative;
    top: 3px;
}
#calendar table td:hover {
    cursor: pointer;
    background: #bee9f7;
} 

/* Weather */
table.weather {
    width: 100%;
    border: 1px solid #ddd;
    border-spacing: 0;
    border-collapse: collapse;
    background: #fefefe;
    color: #565656;
}
table.weather th {
    border: 1px solid #ddd;
    background: #eee;
    text-align: center;
    font-size: 11px;
    height: 30px;
    font-weight: bold;
}
table.weather td {
    border: 1px solid #ddd;
    text-align: center;
    height: 30px;
}
table.weather img {
    width: 26px;
    height: 26px;
    position: relative;
    top: 2px;
}
table.weather .temp {
    color: #777;
    font-size: 14px;
    position: relative;
    top: -5px;
}

/* Normal Table */
table {
    width: 100%;
    border: 1px solid #ddd;
    border-spacing: 0;
    border-collapse: collapse;
}
table th {
    font-weight: bold;
    border: 1px solid;
    text-align: center;
}
table td {
    border: 1px solid #ddd;
    text-align: center;
    height: 30px;
}

/* Profiles Table */
table.profiles {
    width: 100%;
    border: 0px;
    border-spacing: 0;
    border-collapse: collapse;
}
table.profiles th {
    width: 10%;
    font-weight: bold;
    border: 0px;
    text-align: right;
    padding: 5px 5px 0 15px;
    vertical-align: top;
    font-size: 14px;
    white-space: nowrap;
}
table.profiles td {
    border: 0px;
    text-align: left;
}
table.profiles input, table.profiles select, table.profiles textarea {
    margin: 1px;
    width: auto;
}

.flex-contents {
    text-align: center;
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.flex-contents > .view-item {
    text-align: center;
    display: grid;
    width: 20%;
    font-size: 14px;
}
.flex-contents > .view-item > a {
    margin: 10px;
}
.flex-contents > .search-item {
    text-align: center;
    width: 40%;
    font-size: 14px;
    font-weight: bold;
    margin: 5px 0 5px 0;
}
.flex-contents > .search-submit {
    text-align: center;
    width: 20%;
    font-size: 14px;
    font-weight: bold;
    margin: 5px 0 5px 0;
}
.search-box {
    width: auto;
    margin-top: 10px;
    padding: 15px;
    border: 1px solid #ddd;
}
.formset-box {
    width: auto;
    margin: 10px 0 10px 0;
    padding: 15px;
    border: 1px solid #ddd;
}

.vertical-contents {
    display: grid;
    padding: 10px 0 10px 0;
}
.input-label{
    position: relative;
    padding: 5px 0 3px 16px;
    font-weight: bold;
    font-size: 14px;
}
.input-label::before{
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    border: 5px solid transparent;
    border-left: 8px solid #9a9a9a;
}
.text-preview {
    padding: 4px;
    border: 1px dotted #9a9a9a;
}
.text-danger {
    color: #ff0000;
    font-size: 14px;
}

.profile-articles {
    border-bottom: 1px dotted #dedede;
}
.articles-body {
    padding: 10px 4px 10px 4px;
    border-bottom: 1px dotted #acacac;
}

/* User Menus */
.user-menus {
    border: 1px solid #baba99;
}
.user-menus > ul {
    margin-top: 6px !important;
    margin-bottom: 6px !important;
    font-size: 14px;
    text-align: left;
    border-bottom: 1px solid;
}
.user-menus > ul > section {
    font-weight: bold;
    position: relative;
    left: -18px;
}
.user-menus > ul:last-child {
    border-bottom: none;
}

/* Admin Menus */
.admin-menus {
    border: 1px solid #baba99;
}
.admin-menus > ul {
    margin-top: 6px !important;
    margin-bottom: 6px !important;
    font-size: 14px;
    text-align: left;
    border-bottom: 1px solid;
}
.admin-menus > ul > section {
    font-weight: bold;
    position: relative;
    left: -18px;
}
.admin-menus > ul:last-child {
    border-bottom: none;
}

/* User Managements */
table.user-managements {
    font-size: 14px;
}

/* Enable, Disable */
span.enable {
    background: #228B22;
    color: #efefef;
    font-weight: bold;
    padding: 0 4px 0 4px;
    border-bottom: 2px solid #116911;
    border-radius: 10px;
}
span.disable {
    background: #ee1111;
    color: #efefef;
    font-weight: bold;
    padding: 0 4px 0 4px;
    border-bottom: 2px solid #990000;
    border-radius: 10px;
}

@media only screen and (max-width:991px) {
    .grid {
        display: grid;
    }
    .main {
        width: auto;
    }
    .side {
        width: auto;
        display: grid;
        grid-template-columns: repeat(2 , 1fr);
    }
    .side > .container {
        width: auto;
    }
    #calendar > section > table th {
        font-size: 15px;
    }
    table.weather th {
        font-size: 15px;
    }
}

@media (max-width: 638px) {
    .side {
        display: grid;
        grid-template-columns: repeat(1 , 1fr);
    }
    .side > .container {
        width: auto;
    }
    .main > .footer {
        display: grid;
    }
    .pc {
        display: none;
    }
    #hamburger {
        background-color: transparent;
        position: relative;
        cursor: pointer;
        margin: 0 0 0 auto;
        height: 60px;
        width: 60px;
    }
    .icon span {
        position: absolute;
        left: 15px;
        width: 30px;
        height: 4px;
        background-color: white;
        border-radius: 8px;
        transition: ease 0.75s;
    }
    .icon span:nth-of-type(1) {
        top: 16px;
    }
    .icon span:nth-of-type(2) {
        top: 28px;
    }
    .icon span:nth-of-type(3) {
        bottom: 16px;
    }
    .close span:nth-of-type(1) {
        transform: rotate(45deg);
        top: 28px;
    }
    .close span:nth-of-type(2) {
        opacity: 0;
    }
    .close span:nth-of-type(3) {
        transform: rotate(-45deg);
        top: 28px;
    }
    .sm {
        top: 60px;
        left: 0px;
        position: absolute;
        z-index: 10;
        width: 100%;
        background-color: rgba(34, 49, 52, 0.9);
    }
    header ul {
        flex-direction: column;
    }
    header a {
        text-align: center; 
        border-top: solid 0.5px rgba(255, 255, 255, 0.6);
    }
    .grid-contents {
        display: grid;
    }
    .w-25 {
        width: auto;
        text-align: center;
    }
    .w-33 {
        width: auto;
    }
    .w-50 {
        width: auto;
    }
    .w-75 {
        width: auto;
    }
    .profile-image {
        width: 60%;
        max-height: 220px;
    }
    .flex-contents > .view-item {
        width: 33%;
    }
    .flex-contents > .search-item {
        width: 100%;
    }
    .flex-contents > .search-submit {
        width: 100%;
    }

    table.profiles th, table.profiles td{
      display: block;
    }
    table.profiles th{
        position: relative;
        padding: 5px 0 3px 16px;
        font-weight: bold;
        font-size: 14px;
    }
    table.profiles th::before{
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        border: 5px solid transparent;
        border-left: 8px solid #9a9a9a;
    }

}

/** Theme */
body {
    background: {{$settings['body_color']}} !important;
    color: {{$settings['text_color']}} !important;
    border-color: {{$settings['border_color']}} !important;
}
.main, .side, .pagination {
    background: {{$settings['background_color']}} !important;
}
header {
    background: {{$settings['header_color']}} !important;
    border-left:1px solid {{$settings['border_color']}} !important;
    border-right:1px solid {{$settings['border_color']}} !important;
}
div, table, th, td, ul {
    border-color: {{$settings['border_color']}} !important;
}
table th {
    background: {{$settings['th_color']}} !important;
}
table.profiles th {
    background: {{$settings['background_color']}} !important;
}
.user-menus, .admin-menus, .feature-tags {
    background-color: {{$settings['box_color']}} !important;
}
.search-box, .formset-box, .contents-box {
    background-color: {{$settings['contents_color']}} !important;
}
a {
    color: {{$settings['a_color']}};
}

        </style>
    </head>
    <body>
        @include('header', compact('lang'))
        <div class="grid">
            <div class="side">
                <div class="container">
                    <div class="{{$user_menus_status}}">
                        <div class="title">
                            <div id="trigger-1" class="trigger" data-name="user-menus">会員メニュー&nbsp;<img src="/img/arrow-down.png"></img></div>
                        </div>
                        <div class="target user-menus">
                            @if (auth()->check())
                            <ul>
                                <li><a href="/mypage">@lang('strings.mypage')</a>
                                <li><a href="/profiles/{{user()->id}}">@lang('strings.profile')</a>
                                <li><a href="/massages/inbox">@lang('strings.message')</a>
                                <li><a href="/logout">@lang('auth.logout')</a>
                            </ul>
                            @else
                            <ul>
                                <li><a href="/login">@lang('auth.login')</a>
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
                @if (user()->role_id == \App\Models\Roles::ADMIN || user()->role_id == \App\Models\Roles::SYSTEM)
                <div class="container">
                    <div class="{{$admin_menus_status}}">
                        <div class="title">
                            <div id="trigger-2" class="trigger" data-name="admin-menus">管理者メニュー&nbsp;<img src="/img/arrow-down.png"></img></div>
                        </div>
                        <div class="target admin-menus">
                            <ul>
                                <section>@lang('strings.common_settings')</section>
                                <li><a href="/managements/settings">@lang('strings.site_settings')</a>
                                <li><a href="/managements/navigations">@lang('strings.navigation_management')</a>
                            </ul>
                            <ul>
                                <section>@lang('strings.user_management')</section>
                                <li><a href="/managements/users">@lang('strings.user_management')</a> &gt; <a href="/managements/users/add">@lang('strings.add')</a></li>
                                <li><a href="/managements/groups">@lang('strings.group_management')</a></li>
                                <li><a href="/managements/profile/settings">@lang('strings.profile_settings')</a></li>
                            </ul>
                            <ul>
                                <section>@lang('strings.contents_management')</section>
                                <li><a href="/managements/informations">@lang('strings.informations_management')</a></li>
                                <li><a href="/managements/freepages">@lang('strings.freepage_management')</a></li>
                                <li><a href="/managements/uploadfiles">@lang('strings.upload_files')</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                <div class="container">
                    <div class="title">{{str_date_format($date)}}&nbsp;<select name="city_id" style="font-size: 16px;">
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
                        <a href="/{{$lang}}/?tag={{$tag['value']}}"><span class="tag" style="border-color: {{$tag['frame_color']}}; background: {{$tag['body_color']}}">{{$tag['value']}}</span></a>
                        @endforeach
                    </div>
                </div>
                <div class="container">
                    <div class="title"><span class="ad">AD</span>SNS WebApp</div>
                    <div class="ad-sns-webapp">
                        @lang('strings.ad_sns_webapp')<a href="#"><b>@lang('strings.click_here')</b></a>
                    </div>
                </div>
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
