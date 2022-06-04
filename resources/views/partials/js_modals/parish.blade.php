@can('dashboard.parishs.create')
<script>
    $('#id_parish').select2({
        width: '100%'
    });

    $('.add_parish').click(function(e) {
        e.preventDefault();
        var parish = $('#name_parish').val();

        if (parish) {
            $('.add_parish').attr('disabled', 'disabled');
            $('.add_parish').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: "POST",
                url: "{{url('dashboard/add-parish-modal')}}",
                data: {
                    name: parish,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    if (data.error) {
                        $('.error_parish').html(data.error[0]);
                    } else {
                        $('#id_parish').append(`<option value="${data.id}" selected>${data.name}</option>`);
                        $('.error_parish').html('');
                        $('#id_parish').trigger('change');
                        $('#name_parish').val('');
                        $('#Modalparish').modal('hide');
                    }
                    $('.add_parish').removeAttr('disabled');
                    $('.add_parish').html('Guardar');
                },
                error: function(data) {
                    $('.error_parish').html('');
                    $('.add_parish').removeAttr('disabled');
                    $('.add_parish').html('Guardar');
                }
            })
        }
    });
</script>
@endcan