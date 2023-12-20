<div class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/images/header/{{$settings->header_file_name}}" class="d-block w-100" alt="...">
            <div class="carousel-caption" style="color: {{$settings->title_color}};">
                <div class="col-12">
                    <h3 class="font-weight-bold">{{$settings->site_name}}</h3>
                    <span>{!!$settings->site_description!!}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg">
    <a class="sidebar-brand d-flex align-items-center justify-content-center text-decoration-none" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{$settings->site_name}}</div>
    </a>

    <!-- Sidebar Toggle (Topbar) -->
    <button class="btn btn-link d-lg-none rounded-circle" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            @foreach($navigations as $navigation)
            <li class="nav-item nav-hover">
                <a class="nav-link" href="{{$navigation->link}}">
                        <span>{{$navigation->name}}</span>
                </a>
            </li>
            @endforeach

            @if (user()->role_id == \App\Models\Roles::ADMIN || user()->role_id == \App\Models\Roles::SYSTEM)
            <li class="nav-item nav-hover dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @lang('strings.admin_menus')
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item disabled" href="#">@lang('strings.common_settings')</a>
                    <a class="dropdown-item text-black-50" href="/managements/settings">
                        <i class="fas fa-cogs fa-sm fa-fw"></i>
                        @lang('strings.site_settings')
                    </a>
                    <a class="dropdown-item text-black-50" href="/managements/navigations">
                        <i class="fas fa-cogs fa-sm fa-fw"></i>
                        @lang('strings.navigation_management')
                    </a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item disabled" href="#">@lang('strings.user_management')</a>
                    <a class="dropdown-item text-black-50" href="/managements/users">
                        <i class="fas fa-fw fa-users"></i>
                        @lang('strings.user_management')
                    </a>
                    <a class="dropdown-item text-black-50" href="/managements/groups">
                        <i class="fas fa-fw fa-object-group"></i>
                        @lang('strings.group_management')
                    </a>
                    <a class="dropdown-item text-black-50" href="/managements/profile/settings">
                        <i class="fas fa-fw fa-user-edit"></i>
                        @lang('strings.profile_settings')
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item disabled" href="#">@lang('strings.contents_management')</a>
                    <a class="dropdown-item text-black-50" href="/managements/informations">
                        <i class="fas fa-info-circle"></i>
                        @lang('strings.informations_management')
                    </a>
                    <a class="dropdown-item text-black-50" href="/managements/freepages">
                        <i class="fas fa-fw fa-edit"></i>
                        @lang('strings.freepage_management')
                    </a>
                    <a class="dropdown-item text-black-50" href="/managements/uploadfiles">
                        <i class="fas fa-fw fa-upload"></i>
                        @lang('strings.upload_files')
                    </a>
                </div>
            </li>
            @endif

        </ul>
    </div>
</nav>