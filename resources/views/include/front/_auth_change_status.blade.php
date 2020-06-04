@auth
<div style="position: fixed; top:3em; right:0em;">
    <input class="switch_status" type="checkbox" data-toggle="toggle" data-table="<?php echo @$table?>" data-switch-id="<?php echo @$var->id?>" <?php echo @$var->status == '1' ? 'checked' : '' ;?> data-onstyle="success" data-offstyle="danger">
</div>
@endauth

@push('js')
    <!-- สถานะ -->
    <!-- switch toggle -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
    $(function() {
        $(document).on('change', ".switch_status", function () {
            $.ajax({
                url: "{{ url('ajaxChangeStatus') }}",
                data:{ table : $(this).data('table'), status : $(this).prop('checked'), id : $(this).data('switch-id') },
                dataType: "json",
            });
        });
    });
    </script>
@endpush