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
            [4, "asc"]
        ],
        "dom": 'lfrtip',
        columnDefs: [{
            orderable: false,
            targets: -1,
        }],
        language: len,
        ajax: {
            url: "{{ route('dashboard.parishs.index') }}",
        },
        columns: [{
                data: 'name',
            },
            {
                data: 'province',
            },
            {
                data: 'canton',
            },
            {
                data: 'created_at',
            },
            {
                data: 'updated_at',
            },
            {
                data: 'actions'
            }
        ]
    });
</script>