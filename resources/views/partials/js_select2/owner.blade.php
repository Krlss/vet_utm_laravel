<script>
    $('#user_id').select2({
        width: '100%',
        placeholder: "Digite la cedula o RUC del dueño",
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
                return "Por favor ingresa al menos dos letras... (cedula, ruc o nombres del usuario)";
            }
        },
        ajax: {
            url: "{{url('dashboard/pet/user')}}",
            method: "POST",
            data: function(params) {
                var query = {
                    search: params.term,
                    "_token": "{{csrf_token()}}"
                }
                return query;
            },
            dataType: "json",
            processResults: function(data) {
                return {
                    results: $.map(data, function(user) {
                        return {
                            text: user.name + " " + user.last_name1 + " " + user.last_name2 + " - " + user.user_id,
                            id: user.user_id
                        }
                    })
                };
            }
        }
    });
</script>