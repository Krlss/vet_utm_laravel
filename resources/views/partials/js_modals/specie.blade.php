@can('dashboard.species.create')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const preview = document.getElementById('preview');

    image.onchange = evt => {
        const [file] = image.files
        if (file) {
            if (preview.classList.contains('hidden')) {
                preview.classList.remove('hidden')
                preview.classList.add('flex')
            }
            img.src = URL.createObjectURL(file)
        }
    }

    const button = document.getElementById('button');
    const input = document.getElementById('image');

    button.addEventListener('click', () => {
        input.value = '';
        preview.classList.add('hidden');
    })

    $('#upload_form').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $('.add_specie').attr('disabled', 'disabled');
        $('.add_specie').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: "POST",
            url: "{{url('dashboard/add-specie-modal')}}",
            contentType: false,
            processData: false,
            data: formData,
            success: function(data) {
                if (data.error) {
                    $('.error_specie').html(data.error[0]);
                } else {
                    $('#id_specie').append(`<option value="${data.id}" selected>${data.name}</option>`);
                    $('.error_specie').html('');
                    $('#id_specie').trigger('change');
                    $('#name_specie').val('');
                    $('#Modalspecie').modal('hide');
                    $('#image').val('');
                    $('#preview').addClass('hidden');
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
    })
</script>
@endcan