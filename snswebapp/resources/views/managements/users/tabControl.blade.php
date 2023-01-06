<div class="col-lg-2 mb-4 text-left">
    <div class="row">
        <a href="/managements/users"
            class="col-lg-12 col-6 py-2 border text-decoration-none text-nowrap tab-item
            @if($index == 1) tab-active @endif">
            <i class="fas fa-users ml-2"></i> @lang('strings.user_list')
        </a>
        <a href="/managements/users/create"
            class="col-lg-12 col-6 py-2 border text-decoration-none text-nowrap tab-item
            @if($index == 2) tab-active @endif">
            <i class="fas fa-user-plus ml-2"></i> @lang('strings.add_user')
        </a>
    </div>
</div>
