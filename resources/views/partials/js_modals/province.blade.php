@can('dashboard.provinces.create')
<script>
    $('.add_province').click(function(e) {
        e.preventDefault();
        var province = $('#name_province').val();
        var letter = $('#letter').val();

        if (province && letter) {
            $('.add_province').attr('disabled', 'disabled');
            $('.add_province').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                type: "POST",
                url: "{{url('dashboard/add-province-modal')}}",
                data: {
                    name: province,
                    letter,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    if (data.error) {
                        $('.error_province').html(data.error[0]);
                    } else {
                        $('#id_province').append(`<option value="${data.id}" selected>${data.name}</option>`);
                        $('#id_province').trigger('change');
                        $('#name_province').val('');
                        $('.error_province').html('');
                        $(`#letter option[value='${letter}']`).remove();
                        $('#Modalprovince').modal('hide');
                    }
                    $('.add_province').removeAttr('disabled');
                    $('.add_province').html('Guardar');
                },
                error: function(data) {
                    $('.error_province').html('');
                    $('.add_province').removeAttr('disabled');
                    $('.add_province').html('Guardar');
                }
            })
        }
    });
</script>
@endcan