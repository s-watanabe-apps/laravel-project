<link href="http://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script src="http://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>

<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script>
$(window).on('load', function() {
    var table = $('#dataTable').DataTable({
        aLengthMenu:[50, 100, 200],
        language: {!!json_encode(__('strings.datatables'), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)!!},
        stateSave:true,
        order:[[0, "desc"]],
        columnDefs:[
            {
                "targets": [5],
                "bSortable": false
            },
        ],
        scrollX: true,
    });

    table.columns.adjust();

    $(window).on('resize', function(){
        table.columns.adjust();
    });
});
</script>
