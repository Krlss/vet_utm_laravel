@can('dashboard.furs.create')
<script>
    $('.add_fur').click(function(e) {
        e.preventDefault();
        var fur = $('#name_fur').val();
        if (fur) {
            $('.add_fur').attr('disabled', 'disabled');
            $('.add_fur').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                type: "POST",
                url: "{{url('dashboard/add-fur-modal')}}",
                data: {
                    name: fur,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    if (data.error) {
                        $('.error_fur').html(data.error[0]);
                    } else {
                        $('#id_fur').append(`<option value="${data.id}" selected>${data.name}</option>`);
                        $('.error_fur').html('');
                        $('#id_fur').trigger('change');
                        $('#name_fur').val('');
                        $('#Modalfur').modal('hide');
                    }
                    $('.add_fur').removeAttr('disabled');
                    $('.add_fur').html('Guardar');
                },
                error: function(data) {
                    $('.error_fur').html('');
                    $('.add_fur').removeAttr('disabled');
                    $('.add_fur').html('Guardar');
                }
            })
        }
    });
</script>
@endcan