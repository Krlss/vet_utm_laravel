<script>
    $(document).ready(function() {
        var cantoncurrent = "<?php echo $user->id_canton; ?>";
        var parishecurrent = "<?php echo $user->id_parish; ?>";
        var provincecurrent = "<?php echo $user->id_province; ?>";
        $('#id_canton').val(null);
        $('#id_canton').html('');
        $.ajax({
            dataType: "json",
            method: "GET",
            url: "{{ url('dashboard/provinces/cantons') }}",
            data: {
                id_province: provincecurrent
            }
        }).done(function(msg) {
            let cantonsOptions;
            if (msg.length <= 0) {
                cantonsOptions = "<option value>{{__('First select a province')}}</option>";
            } else {
                cantonsOptions = "<option value>{{__('Select a canton')}}</option>";
            }
            $.each(msg, function(i, canton) {
                if (cantoncurrent == canton.id) {
                    cantonsOptions += '<option selected="selected" value="' + canton.id + '">' + canton.name + '</option>';
                } else {
                    cantonsOptions += '<option value="' + canton.id + '">' + canton.name + '</option>';
                }
            });
            $('#id_canton').html(cantonsOptions);
        });

        $('#id_parish').val(null);
        $('#id_parish').html('');

        /* Parroquias.. */
        $.ajax({
            dataType: "json",
            method: "GET",
            url: "{{ url('dashboard/provinces/cantons/parishes') }}",
            data: {
                id_canton: cantoncurrent
            }
        }).done(function(msg) {
            let parishesOptions;
            if (msg.length <= 0) {
                parishesOptions = "<option value>{{__('First select a canton')}}</option>"
            } else {
                parishesOptions = "<option value>{{__('Select a parish')}}</option>";
            }
            $.each(msg, function(i, parishe) {
                if (parishecurrent == parishe.id) {
                    parishesOptions += '<option selected="selected" value="' + parishe.id + '">' + parishe.name + '</option>';
                } else {
                    parishesOptions += '<option value="' + parishe.id + '">' + parishe.name + '</option>';
                }
            });
            $('#id_parish').html(parishesOptions);
        });
    });
</script>