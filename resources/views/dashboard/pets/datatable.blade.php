<script src="{{ asset('plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/table.js') }}"></script>
<script type="text/javascript">
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        dataType: 'json',
        type: 'GET',
        order: [
            [6, "desc"]
        ],
        "dom": 'lfrtip',
        language: len,
        ajax: {
            url: "{{ route('dashboard.pets.index') }}",
        },
        columns: [{
                data: 'pet_id',
            },
            {
                data: 'name',
            },
            {
                data: 'castrated',
            },
            {
                data: 'lost',
            },
            {
                data: 'specie',
            },
            {
                data: 'user'
            },
            {
                data: 'updated_at',
            },
            {
                data: 'actions',
                searchable: false,
                orderable: false,
            }
        ]
    });
</script>