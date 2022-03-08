@extends('layouts.admin')

@section('content')

@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{ trans('lang.permission_table') }}</div>
</div>
@endsection

<div class="table table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="sort">{{ trans('lang.permission') }}</th>
                <!-- <th>{{ trans('lang.guard_name') }}</th> -->
                @foreach ($roles as $role)
                <th class="sticky">{{ $role->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <!-- <td>{{ $permission->guard_name }}</td> -->
                @foreach ($roles as $role)
                <td>
                    @if ($role->hasPermissionTo($permission->name))
                    <div class='checkbox icheck'><label><input type='checkbox' name='namehere' class='permission' data-role-id='{{ $role->id }}' data-permission='{{ $permission->name }}' checked></label></div>
                    @else
                    <div class='checkbox icheck'><label><input type='checkbox' name='namehere' class='permission' data-role-id='{{ $role->id }}' data-permission='{{ $permission->name }}'></label></div>
                    @endif
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts_lib')
<script>
    $('input[type="checkbox"].permission').click(function(event) {
        var url = "";
        var roleId = $(this).data('role-id');
        var permission = $(this).data('permission');
        if ($(this).is(':checked')) {
            url = "{{ url('dashboard/permissions/give-permission-to-role') }}";
        } else {
            url = "{{ url('dashboard/permissions/revoke-permission-to-role') }}";
        }
        $.ajax({
                method: "POST",
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    roleId: roleId,
                    permission: permission
                }
            })
            .done(function(msg) {

            });

    });
</script>
@endpush