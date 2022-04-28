<div>
    @if(count($audits) || count($currents))
    <div class="flex flex-col my-3">
        {!! Form::label('audit_count', trans('lang.audit_count').' ('.count($currents).')', ['class' => 'text-gray-400 text-sm font-bold uppercase']) !!}
        <div class="relative">
            <input class="form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm w-full pr-5" placeholder="Busca por evento, responsable, afectado" wire:model="search" />
            @if($search <> '') <div wire:click="reset_search" class="cursor-pointer absolute top-2 right-3 text-sm text-gray-600">x</div> @endif
        </div>
    </div>
    <div x-show="open" class="flex gap-5 flex-wrap justify-center">
        @forelse ($audits as $audit)
        <div wire:loading.class="animate-pulse" class="max-w-xs p-3 rounded-md bg-gray-100 w-56 relative">
            <div class="flex flex-row justify-between">
                <div class="flex flex-row space-x-1">
                    <strong>Registro ID: </strong>
                    <p> {{$audit->id}}</p>
                </div>
                <!-- <button data-modal-toggle="{{$audit->id}}">
                    <i class="fas fa-eye text-gray-500 hover:text-blue-700"></i>
                </button> -->
            </div>
            <div class="flex flex-row space-x-1">
                <strong>Evento: </strong>
                <p> {{trans('lang.'.$audit->event)}}</p>
            </div>
            <div class="flex flex-row space-x-1">
                <strong>Responsable: </strong>
                <p>{{$audit->user_id}}</p>
            </div>
            <div class="flex flex-row space-x-1">
                <strong>Afectado: </strong>
                <p>{{$audit->auditable_id}}</p>
            </div>
            <div class="flex flex-row space-x-1">
                <strong>Modelo: </strong>
                <p>{{trans('lang.'.$audit->auditable_type)}}</p>
            </div>
        </div>

        @empty
        <small wire:loading.class="animate-pulse">{{trans('lang.data_not_found')}}</small>
        @endforelse
    </div>



    <div class="mt-4">
        {{ $audits->links() }}
    </div>

    @elseif(!count($audits) && !count($currents))
    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
        {!!trans('lang.label_data_user_pets_without')!!}
    </h6>
    @endif

</div>

@push('scripts_lib')
<script src="//unpkg.com/alpinejs"></script>
@endpush