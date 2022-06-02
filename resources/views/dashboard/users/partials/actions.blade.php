<div class="flex items-center justify-center space-x-3">
    @can('dashboard.users.show')
    <button>
        <a href="{{ route('dashboard.users.show', $user) }}">
            <i class="fas fa-eye text-gray-500 hover:text-blue-700"></i>
        </a>
    </button>
    @endcan
    @can('dashboard.users.edit')
    <button>
        <a href="{{ route('dashboard.users.edit', $user) }}" class=''>
            <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
        </a>
    </button>
    @endcan

    @can('dashboard.users.destroy')
    {!! Form::open(['route' => ['dashboard.users.destroy', $user], 'method' => 'delete']) !!}
    {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-red-700"></i>', [
    'type' => 'submit',
    'class' => '',
    'onclick' => "return confirm('Estás seguro que deseas eliminar a $user->name')",
    ]) !!}
    {!! Form::close() !!}
    @endcan
</div>