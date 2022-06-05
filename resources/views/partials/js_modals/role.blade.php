@can('dashboard.roles.create')
<script>
    $('.add_role').click(function(e) {
        e.preventDefault();
        var role = $('#name_role').val();

        if (role) {
            $('.add_role').attr('disabled', 'disabled');
            $('.add_role').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                type: "POST",
                url: "{{url('dashboard/add-role-modal')}}",
                data: {
                    name: role,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    if (data.error) {
                        $('.error_role').html(data.error[0]);
                    } else {
                        $('#roles').append(`<option value="${data.id}" selected>${data.name}</option>`);
                        $('.error_role').html('');
                        $('#roles').trigger('change');
                        $('#name_role').val('');
                        $('#Modalrole').modal('hide');
                    }
                    $('.add_role').removeAttr('disabled');
                    $('.add_role').html('Guardar');
                },
                error: function(data) {
                    $('.error_role').html('');
                    $('.add_role').removeAttr('disabled');
                    $('.add_role').html('Guardar');
                }
            })
        }
    });
</script>
@endcan