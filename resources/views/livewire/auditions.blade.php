<div>
    @if(count($audits) || count($currents))
    <div class="flex flex-col my-3">
        {!! Form::label('audit_count', __('Audits quantity').' ('.count($currents).')', ['class' => '']) !!}
        <div class="relative">
            <input class="form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm w-full pr-5" placeholder="{{__('You can search for events (English), responsible, Affected o ID of the auditory')}}" wire:model="search" />
            @if($search <> '') <div wire:click="reset_search" class="cursor-pointer absolute top-2 right-3 text-sm text-gray-600">x</div> @endif
        </div>
    </div>
    <div x-show="open" class="flex gap-5 flex-wrap justify-center">
        @forelse ($audits as $audit)
        <div wire:loading.class="animate-pulse" class="max-w-xs p-3 rounded-md bg-gray-100 w-56 relative">
            <div class="flex flex-row justify-between">
                <div class="flex flex-row space-x-1">
                    <strong>{{__('Audit ID')}}: </strong>
                    <p class="truncate w-20">{{shortenNumber($audit->id)}}</p>
                </div>

                <button type="button" data-toggle="modal" data-target="#exampleModal" data-id="{{$audit->id}}" data-user_type="{{$audit->user_type}}" data-user_id="{{$audit->user_id}}" data-event="{{$audit->event}}" data-auditable_id="{{$audit->auditable_id}}" data-auditable_type="{{$audit->auditable_type}}" data-url="{{$audit->url}}" data-ip_address="{{$audit->ip_address}}" data-user_agent="{{$audit->user_agent}}" data-tags="{{json_encode($audit->tags)}}" data-created_at="{{$audit->created_at}}" data-old_values="{{json_encode($audit->old_values)}}" data-new_values="{{json_encode($audit->new_values)}}">
                    <i class="fas fa-eye text-gray-500 hover:text-blue-700"></i>
                </button>

            </div>
            <div class="flex flex-row space-x-1">
                <strong>{{__('Affected')}}: </strong>
                <p class="truncate w-23">{{$audit->auditable_id}}</p>
            </div>
            <div class="flex flex-row space-x-1">
                <strong>{{__('Event')}}: </strong>
                <p> {{__($audit->event)}}</p>
            </div>
            <div class="flex flex-row space-x-1">
                <strong>{{__('Model')}}: </strong>
                <p>{{__(getModelName($audit->auditable_type))}}</p>
            </div>
            <div class="flex flex-row space-x-1">
                <strong>{{__('Responsible')}}: </strong>
                <p class="truncate w-24">{{$audit->user_id}}</p>
            </div>

        </div>

        @empty
        <small wire:loading.class="animate-pulse">{{__('Audit not found')}}</small>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $audits->links() }}
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-bold" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Modelo:</label>
                        <p class="user_type"> </p>
                    </div>
                    <div class="form-group">
                        <label lass="col-form-label">ID Responsable:</label>
                        <p class="user_id"> </p>
                    </div>
                    <div class="form-group">
                        <label lass="col-form-label">Evento:</label>
                        <p class="event"> </p>
                    </div>
                    <div class="form-group">
                        <label lass="col-form-label">ID Afectado:</label>
                        <p class="auditable_id"> </p>
                    </div>
                    <div class="form-group">
                        <label lass="col-form-label">Modelo afectado:</label>
                        <p class="auditable_type"> </p>
                    </div>
                    <div class="form-group">
                        <label lass="col-form-label">Valores viejos:</label>
                        <p class="old_values"> </p>
                    </div>
                    <div class="form-group">
                        <label lass="col-form-label">Valores nuevos:</label>
                        <p class="new_values"> </p>
                    </div>
                    <div class="form-group">
                        <label lass="col-form-label">URL:</label>
                        <p class="url"> </p>
                    </div>
                    <div class="form-group">
                        <label lass="col-form-label">Dirección ip:</label>
                        <p class="ip_address"> </p>
                    </div>
                    <div class="form-group">
                        <label lass="col-form-label">Navegador:</label>
                        <p class="user_agent"> </p>
                    </div>
                    <div class="form-group">
                        <label lass="col-form-label">tags:</label>
                        <p class="tags"> </p>
                    </div>
                    <div class="form-group">
                        <label lass="col-form-label">Creado hace:</label>
                        <p class="created_at"> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @elseif(!count($audits) && !count($currents))
    <h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
        {!!__('Nothing audit')!!}
    </h6>
    @endif

</div>

@push('js')
<script src="{{ asset('js/alpine.min.js') }}"></script>
<script>
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal 

        var id = button.data('id')
        var user_type = button.data('user_type')
        var user_id = button.data('user_id')
        var event = button.data('event')
        var auditable_id = button.data('auditable_id')
        var auditable_type = button.data('auditable_type')
        var url = button.data('url')
        var ip_address = button.data('ip_address')
        var user_agent = button.data('user_agent')
        var tags = button.data('tags')
        var created_at = button.data('created_at')
        var new_values = button.data('new_values')
        var old_values = button.data('old_values')

        var new_values_ = '';

        for (const key_new_values in new_values) {
            new_values_ += ` ${key_new_values}: ${new_values[key_new_values]},`;
        }

        var old_values_ = '';

        for (const key_old_values in old_values) {
            old_values_ += ` ${key_old_values}: ${old_values[key_old_values]},`;
        }

        var modal = $(this)
        modal.find('.modal-title').text('Información del evento ' + id)
        modal.find('.user_type').text(user_type)
        modal.find('.user_id').text(user_id)
        modal.find('.event').text(event)
        modal.find('.auditable_id').text(auditable_id)
        modal.find('.auditable_type').text(auditable_type)
        modal.find('.url').text(url)
        modal.find('.ip_address').text(ip_address)
        modal.find('.user_agent').text(user_agent)
        modal.find('.tags').text(tags)
        modal.find('.created_at').text(created_at)
        modal.find('.new_values').text(new_values_)
        modal.find('.old_values').text(old_values_)
    })
</script>
@endpush