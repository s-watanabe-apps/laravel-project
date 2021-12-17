<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
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

      <li class="nav-item nav-hover active">
        <!--<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>-->
        <a class="nav-link" href="/articles/write">
            <i class="fas fa-fw fa-edit"></i><span>@lang('strings.write_articles')</span>
        </a>
      </li>

      <li class="nav-item nav-hover">
        <a class="nav-link" href="/pictures">
            <i class="fas fa-fw fa-images"></i><span>@lang('strings.pictures')</span>
        </a>
      </li>

      <li class="nav-item nav-hover">
        <a class="nav-link" href="/members">
            <i class="fas fa-fw fa-users"></i><span>@lang('strings.members')</span>
        </a>
      </li>

      @if ($user->role_id == \App\Models\Roles::ADMIN)
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
          <div class="dropdown-divider"></div>
          <a class="dropdown-item disabled" href="#">@lang('strings.contents_management')</a>
          <a class="dropdown-item text-black-50" href="/managements/informations">
            <i class="fas fa-info-circle"></i>
            @lang('strings.informations_management')
          </a>
          <a class="dropdown-item text-black-50" href="/managements/users">
            <i class="fas fa-fw fa-users"></i>
            @lang('strings.user_management')
          </a>
        </div>
      </li>
      @endif

    </ul>
  </div>
</nav>