@can('dashboard.races.create')
<script>
    $('.add_race').click(function(e) {
        e.preventDefault();
        var race = $('#name_race').val();
        var id_specie = $('#id_specie').val();

        if (id_specie && race) {
            $('.add_race').attr('disabled', 'disabled');
            $('.add_race').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                type: "POST",
                url: "{{url('dashboard/add-race-modal')}}",
                data: {
                    name: race,
                    id_specie,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    if (data.error) {
                        $('.error_race').html(data.error[0]);
                    } else {
                        $('#id_race').append(`<option value="${data.id}" selected>${data.name}</option>`);
                        $('.error_race').html('');
                        $('#id_race').trigger('change');
                        $('#name_race').val('');
                        $('#Modalrace').modal('hide');
                    }
                    $('.add_race').removeAttr('disabled');
                    $('.add_race').html('Guardar');
                },
                error: function(data) {
                    $('.error_race').html('');
                    $('.add_race').removeAttr('disabled');
                    $('.add_race').html('Guardar');
                }
            })
        }
    });

    $('#Modalrace').on('show.bs.modal', function(event) {
        var modal = $(this)
        if (!$('#id_specie').val())
            modal.find('.header-error').text('Primero debes seleccionar una especie');
        else
            modal.find('.header-error').text('');
    })
</script>
@endcan