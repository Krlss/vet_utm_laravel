@can('dashboard.cantons.create')
<script>
    $('#id_canton').select2({
        width: '100%',
    });

    $('#id_province').select2({
        width: '100%',
        dropdownParent: $('#Modalcanton')
    });

    $('.add_canton').click(function(e) {
        e.preventDefault();
        var canton = $('#name_canton').val();
        var province = $('#id_province').val();

        if (canton && province) {
            $('.add_canton').attr('disabled', 'disabled');
            $('.add_canton').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                type: "POST",
                url: "{{url('dashboard/add-canton-modal')}}",
                data: {
                    name: canton,
                    id_province: province,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    if (data.error) {
                        $('.error_canton').html(data.error.name && data.error.name[0]);
                        $('.error_province').html(data.error.id_province && data.error.id_province[0]);
                    } else {
                        $('#id_canton').append(`<option value="${data.id}" selected>${data.name}</option>`);
                        $('#id_canton').trigger('change');
                        $('#name_canton').val('');
                        $('#Modalcanton').modal('hide');
                    }
                    $('.add_canton').removeAttr('disabled');
                    $('.add_canton').html('Guardar');
                },
                error: function(data) {
                    $('.add_canton').removeAttr('disabled');
                    $('.add_canton').html('Guardar');
                }
            })
        }
    });
</script>
@endcan