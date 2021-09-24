<style type="text/css">
<!--
.toast-area {
    position: absolute;
    z-index: 1;
    top: 20%;
    left: 50%;
    width: 300px;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
}
-->
</style>

<div class="toast-area">
    <div id="toast" class="toast text-center" data-delay="3000"
        role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="..." class="mr-2" alt="">
            <strong class="mr-auto">{{$settings->site_name}}</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="toastMessage" class="toast-body bg-light text-success"></div>
    </div>
</div>
