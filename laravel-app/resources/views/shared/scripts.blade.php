<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="/logout">@lang('auth.logout')</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<!--
<script src="/js/demo/chart-area-demo.js"></script>
<script src="/js/demo/chart-pie-demo.js"></script>
-->

<!-- Date Picker Plugin -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- <script src="https://rawgit.com/jquery/jquery-ui/master/ui/i18n/datepicker-ja.js"></script>-->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/build/jquery.datetimepicker.full.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/jquery.datetimepicker.css">

<script type="text/javascript">
    var clickEventType = ((window.ontouchstart !== null) ? 'click' : 'touchend');
    $(document).on(clickEventType, '#switchFavorites', function(){
        console.log('isFavorite:' + $('#isFavorite').val() + ', uri:' + location.pathname);
        $.ajax({
            type: "POST",
            url: "/api/favorites",
            data: {
                "isFavorite":$('#isFavorite').val(),
                "uri":location.pathname,
            },
        }).done(function(data) {
            if ($('#isFavorite').val() == 0) {
                $('#isFavorite').val(1);
                $('#switchFavorites').children('i').removeClass('far');
                $('#switchFavorites').children('i').addClass('fas');
            } else {
                $('#isFavorite').val(0);
                $('#switchFavorites').children('i').removeClass('fas');
                $('#switchFavorites').children('i').addClass('far');
            }
            $('#toastMessage').text(data.message);
            $('#toast').toast('show');
        }).fail(function(){
            console.log('fail');
        });
    });
</script>