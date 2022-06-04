<script>
    $('#id_specie').on('change', function() {
        $('#id_race').html('');
        $("#id_race").val([]);
        $('#id_fur').html('');
        $("#id_fur").val([]);
        $('#pather').val(null).trigger('change');
        $('#pather').html('');
        $('#mother').val(null).trigger('change');
        $('#mother').html('');
        $('#childrens').val(null).trigger('change');
        $('#childrens').html('');
        $('#select2-id_race-container').html('');

        $.ajax({
            dataType: "json",
            method: "GET",
            url: "{{url('dashboard/getRacesToSpeciesAjax')}}",
            data: {
                id_specie: $('#id_specie').val()
            }
        }).done(function(msg) {
            let raceOptions;
            if (msg.length <= 0) {
                if (!$("#id_specie").val())
                    raceOptions = "<option selected value>Primero seleccione una especie</option>"
                else
                    raceOptions = "<option selected value>No hay razas para esa especie</option>"
            } else {
                raceOptions = "<option selected value>Seleccione una raza</option>";
                $.each(msg, function(i, races) {
                    raceOptions += '<option value="' + races.id + '">' + races.name + '</option>';
                });
            }
            $('#id_race').html(raceOptions);
            $('#id_race').trigger('change')
        });

        $.ajax({
            dataType: "json",
            method: "GET",
            url: "{{url('dashboard/getFursToSpeciesAjax')}}",
            data: {
                id_specie: $('#id_specie').val()
            }
        }).done(function(msg) {
            let furOptions;
            if (msg.length <= 0) {
                if (!$("#id_specie").val())
                    furOptions = "<option selected value>Primero seleccione una especie</option>"
                else
                    furOptions = "<option selected value>No hay pelajes para esa especie</option>"
            } else {
                furOptions = "<option selected value>Seleccione un pelaje</option>";
                $.each(msg, function(i, furs) {
                    furOptions += '<option value="' + furs.id + '">' + furs.name + '</option>';
                });
            }
            $('#id_fur').html(furOptions);
            $('#id_fur').trigger('change')
        });
    });
</script>