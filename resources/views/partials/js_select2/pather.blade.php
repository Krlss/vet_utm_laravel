<script>
    $('#pather').select2({
        width: '100%',
        placeholder: "Digite el identificador del padre",
        minimumInputLength: 2,
        language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando..";
            },
            inputTooShort: function() {
                return "Por favor ingresa al menos dos letras... (identificador o nombre de la mascota)";
            }
        },
        allowClear: true,
        ajax: {
            url: "{{url('dashboard/parents')}}",
            method: "POST",
            data: function(params) {
                var specieValue = $("[name='id_specie']").val();
                var childrensSeleted = $("#childrens").val();
                var query = {
                    search: params.term,
                    specie: specieValue,
                    pet_id: $("[name='pet_id']").val() ?? null,
                    childrensSeleted: childrensSeleted,
                    sex: 'M',
                    "_token": "{{csrf_token()}}"
                }
                return query;
            },
            dataType: "json",
            processResults: function(data) {
                return {
                    results: $.map(data, function(pet) {
                        return {
                            text: pet.name + " - " + pet.pet_id,
                            id: pet.pet_id
                        }
                    })
                };
            }
        }
    });
</script>