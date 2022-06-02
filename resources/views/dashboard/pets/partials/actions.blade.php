<div class="flex items-center justify-center space-x-3">
    @can('dashboard.pets.show')
    <button>
        <a href="{{ route('dashboard.pets.show', $pet) }}">
            <i class="fas fa-eye text-gray-500 hover:text-blue-700"></i>
        </a>
    </button>
    @endcan
    @can('dashboard.pets.edit')
    <button>
        <a href="{{ route('dashboard.pets.edit', $pet) }}" class=''>
            <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
        </a>
    </button>
    @endcan
    @can('dashboard.pets.destroy')
    {!! Form::open(['route' => ['dashboard.pets.destroy', $pet], 'method' => 'delete']) !!}
    {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-red-700"></i>', [
    'type' => 'submit',
    'class' => '',
    'onclick' => "return confirm('Estás seguro que deseas eliminar a $pet->name')",
    ]) !!}
    {!! Form::close() !!}
    @endcan
</div>