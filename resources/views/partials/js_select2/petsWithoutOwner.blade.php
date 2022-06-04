<script>
    $('#pets').select2({
        width: '100%',
        placeholder: "{{__('Type the identifications of the pets or the name')}}",
        minimumInputLength: 2,
        allowClear: true,
        language: {
            noResults: function() {
                return "{{__('No results')}}";
            },
            searching: function() {
                return "{{__('Searching...')}}";
            },
            inputTooShort: function() {
                return "{{__('Type 2 letters of name or identification of the pet, please')}}";
            }
        },
        ajax: {
            url: "{{url('dashboard/PetsWithoutOwner')}}",
            dataType: 'json',
            method: "POST",
            data: function(params) {
                var query = {
                    search: params.term,
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