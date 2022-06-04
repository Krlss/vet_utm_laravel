<script>
    $('#id_canton').on('change', function() {
        $('#id_parish').html('');
        $("#id_parish").val([]);
        $('#select2-id_parish-container').html('');
        $.ajax({
            dataType: "json",
            method: "GET",
            url: "{{ url('dashboard/provinces/cantons/parishes') }}",
            data: {
                id_canton: $('#id_canton').val()
            }
        }).done(function(msg) {
            let parishesOptions;
            if (msg.length <= 0) {
                parishesOptions = "<option value>{{__('First select a canton')}}</option>"
            } else {
                parishesOptions = "<option value>{{__('Select a parish')}}</option>";
                $.each(msg, function(i, parishes) {
                    parishesOptions += '<option value="' + parishes.id + '">' + parishes.name + '</option>';
                });
            }
            $('#id_parish').html(parishesOptions);
        });
    });
</script>