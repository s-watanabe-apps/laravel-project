<header>
    <div class="flex-contents">
        <div class="logo">
            <a href="/">{{$settings['site_name']}}</a>
        </div>
        <div id="hamburger">
            <div class="icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <nav class="sm">
            <ul>
                @foreach ($navigations as $nav)
                <li><a href="{{$nav['link']}}">{{$nav['name']}}</a></li>
                @endforeach
            </ul>
            <div class="nav-title">@lang('strings.member_menus')</div>
            <ul>
                @if (auth()->check())
                <li><a href="/mypage">@lang('strings.mypage')</a>
                <li><a href="/profiles/{{user()->id}}">@lang('strings.profile')</a>
                <li><a href="/massages/inbox">@lang('strings.message')</a>
                <li><a href="/logout">@lang('auth.logout')</a>
                @else
                <li><a href="/logout">ログアウト</a></li>
                <li><a></a></li>
                @endif
            </ul>
            @if (user()->role_id == \App\Models\Roles::ADMIN || user()->role_id == \App\Models\Roles::SYSTEM)
            <div class="nav-title">@lang('strings.admin_menus')</div>
            <ul>
                <li><a href="/managements/settings">@lang('strings.site_settings')</a>
                <li><a href="/managements/navigations">@lang('strings.navigation_management')</a>
                <li><a href="/managements/users">@lang('strings.user_management')</a></li>
                <li><a href="/managements/groups">@lang('strings.group_management')</a></li>
                <li><a href="/managements/profile/settings">@lang('strings.profile_settings')</a></li>
                <li><a href="/managements/informations">@lang('strings.informations_management')</a></li>
                <li><a href="/managements/freepages">@lang('strings.freepage_management')</a></li>
                <li><a href="/managements/uploadfiles">@lang('strings.upload_files')</a></li>
                <li><a href="/managements/ads">@lang('strings.ads_management')</a></li>
                <li><a></a></li>
            </ul>
            @endif
        </nav>
        <nav class="pc">
            <ul>
                @foreach ($navigations as $nav)
                <li><a href="{{$nav['link']}}">{{$nav['name']}}</a></li>
                @endforeach
            </ul>
        </nav>
    </div>
</header>
<script>
    $('#hamburger').on('click', function(){
        $('.icon').toggleClass('close');
        $('.sm').slideToggle();
    });
</script>