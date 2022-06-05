@can('dashboard.cantons.create')
<form autocomplete="off" method="post">
    <div class="modal fade" id="Modalcanton" tabindex="-1" role="dialog" aria-labelledby="Modalcanton" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="flex flex-col">
                        <h5 class="font-bold">{{__('Quick creation of a new canton')}}</h5>
                        <small class="header-error text-red-500"></small>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="grid grid-cols-1">
                        <!-- Name canton -->
                        <div class="flex flex-col px-2 md:mb-0 mb-2">
                            {!! Form::label('id_province', __('Provinces') . '*' , ['class' => '']) !!}
                            {!! Form::select('id_province', $provinces, null, ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'id'=>'id_province', 'placeholder' => $provinces ? null : __('There are no provinces available... :('), 'required' => true]) !!}
                            <span class="text-danger error_province"></span>
                        </div>
                    </div>
                    <div class="grid grid-cols-1">
                        <!-- Name canton -->
                        <div class="flex flex-col px-2 md:mb-0 mb-2">
                            {!! Form::label('name_canton', __('Name') . '*', ['class' => '']) !!}
                            {!! Form::text('name_canton', old('name_canton'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Name'), 'required' => true]) !!}
                            <span class="text-danger error_canton"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <x-submit-button />
                </div>
            </div>
        </div>
    </div>
</form>
@endcan