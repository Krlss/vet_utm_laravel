<script>
    $('#id_province').on('change', function() {
        $('#id_canton').html('');
        $("#id_canton").val([]);
        $('#id_parish').html('');
        $("#id_parish").val([]);
        $('#select2-id_canton-container').html('');
        $.ajax({
            dataType: "json",
            method: "GET",
            url: "{{ url('dashboard/provinces/cantons') }}",
            data: {
                id_province: $('#id_province').val()
            }
        }).done(function(msg) {
            let cantonsOptions;
            $('#id_parish').html("<option value>{{__('First select a canton')}}</option>");
            if (msg.length <= 0) {
                cantonsOptions = "<option value>{{__('First select a province')}}</option>"
            } else {
                cantonsOptions = "<option value>{{__('Select a canton')}}</option>";
                $.each(msg, function(i, canton) {
                    cantonsOptions += '<option value="' + canton.id + '">' + canton.name + '</option>';
                });
            }
            $('#id_canton').html(cantonsOptions);
        });
    });
</script>