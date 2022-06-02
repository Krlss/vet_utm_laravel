<div class="flex items-center justify-center space-x-1">
    @can('dashboard.reports.show')
    <button>
        <a href="{{ route('dashboard.reports.show', $pet) }}">
            <i class="fas fa-eye text-gray-500 hover:text-blue-700"></i> </a>
    </button>
    @endcan
    @can('dashboard.reports.edit')
    <button>
        <a href="{{ route('dashboard.reports.edit', $pet) }}" class='btn btn-link'>
            <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
        </a>
    </button>
    @endcan
</div>