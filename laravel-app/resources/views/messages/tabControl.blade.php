<div class="col-lg-2 mb-4 text-left">
    <div class="row">
        <a href="/messages/inbox" class="col-lg-12 col-4 py-2 border sub-menu text-decoration-none text-nowrap">
            @if ($index == 1)
            @endif
            <i class="fas fa-fw fa-inbox"></i> @lang('strings.inbox') ({{$sizes['inbox']}})<!-- <span class="badge badge-danger rounded-pill">1</span>-->
        </a>
        <a href="/messages/outbox" div class="col-lg-12 col-4 py-2 border sub-menu text-decoration-none text-nowrap">
            <i class="fas fa-paper-plane"></i> @lang('strings.outbox') ({{$sizes['outbox']}})
        </a>
        <a href="/messages/garbage" div class="col-lg-12 col-4 py-2 border sub-menu text-decoration-none text-nowrap">
            <i class="fas fa-trash-alt"></i> @lang('strings.garbage')
        </a>
    </div>
</div>
