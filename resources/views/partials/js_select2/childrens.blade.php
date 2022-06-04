<script>
    $('#childrens').select2({
        width: '100%',
        placeholder: "Digita los identificadores de las mascotas",
        minimumInputLength: 2,
        allowClear: true,
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
        ajax: {
            url: "{{url('dashboard/childrens')}}",
            dataType: 'json',
            method: "POST",
            data: function(params) {
                var specieValue = $("[name='id_specie']").val();
                var query = {
                    search: params.term,
                    specie: specieValue,
                    pet_id: $("[name='pet_id']").val(),
                    pather_seleted: $("[name='pather']").val(),
                    mother_seleted: $("[name='mother']").val(),
                    sex: $("[name='sex']").val(),
                    "_token": "{{csrf_token()}}"
                }
                return query;
            },
            processResults: function(data) {
                data.pets = data.pets.map(function(obj) {
                    return {
                        "text": obj.name + " - " + obj.pet_id,
                        "id": obj.pet_id
                    };
                });
                return {
                    results: data.pets
                };
            },
            cache: true
        }
    });
</script>