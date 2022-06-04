@can('dashboard.species.create')
<script>
    $('.add_specie').click(function(e) {
        e.preventDefault();
        var specie = $('#name_specie').val();

        if (specie) {
            $('.add_specie').attr('disabled', 'disabled');
            $('.add_specie').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: "POST",
                url: "{{url('dashboard/add-specie-modal')}}",
                data: {
                    name: specie,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    if (data.error) {
                        $('.error_specie').html(data.error[0]);
                    } else {
                        $('#id_specie').append(`<option value="${data.id}" selected>${data.name}</option>`);
                        $('.error_specie').html('');
                        $('#id_specie').trigger('change');
                        $('#name_specie').val('');
                        $('#Modalspecie').modal('hide');
                    }
                    $('.add_specie').removeAttr('disabled');
                    $('.add_specie').html('Guardar');
                },
                error: function(data) {
                    $('.error_specie').html('');
                    $('.add_specie').removeAttr('disabled');
                    $('.add_specie').html('Guardar');
                }
            })
        }
    });
</script>
@endcan