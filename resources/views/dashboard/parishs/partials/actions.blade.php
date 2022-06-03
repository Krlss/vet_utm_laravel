<div class="flex items-center justify-center space-x-3">

    @can('dashboard.parishs.edit')
    <button>
        <a href="{{ route('dashboard.parishs.edit', $parish) }}" class=''>
            <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
        </a>
    </button>
    @endcan

    @can('dashboard.parishs.destroy')
    {!! Form::open(['route' => ['dashboard.parishs.destroy', $parish], 'method' => 'delete']) !!}
    {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-red-700"></i>', [
    'type' => 'submit',
    'class' => '',
    'onclick' => "return confirm('Estás seguro que deseas eliminar a $parish->name')",
    ]) !!}
    {!! Form::close() !!}
    @endcan

</div>