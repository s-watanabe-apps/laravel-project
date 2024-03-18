@extends('app')
@section('content')

<div class="contents mypage">
    <div class="subject">
        <span><a href="/managements/users"><i class="fas fa-fw fa-users"></i> @lang('strings.user_management')</a></span>
        <span>&gt; @lang('strings.add')</span>
    </div>

    @include('mypage.formset.account_settings', [
        'email' => '',
        'attributes' => [],
        'change_link' => false,
    ])

</div>

@endsection