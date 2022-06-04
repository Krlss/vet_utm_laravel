@can('dashboard.races.create')
<div class="modal fade" id="Modalrace" tabindex="-1" role="dialog" aria-labelledby="Modalrace" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="flex flex-col">
                    <h5 class="font-bold">{{__('Quick creation of a new race')}}</h5>
                    <small class="header-error text-red-500"></small>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="grid grid-cols-1">
                    <!-- Name race -->
                    <div class="flex flex-col px-2 md:mb-0 mb-2">
                        {!! Form::label('name_race', __('Name') . '*', ['class' => '']) !!}
                        {!! Form::text('name_race', old('name_race'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Name'), 'required' => true]) !!}
                        <span class="text-danger error_race"></span>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="bg-green-500 hover:bg-green-600 shadow-sm p-2 px-4 mt-2 rounded-md text-whire font-medium text-white add_race">{{__('Save')}}</button>
            </div>
        </div>
    </div>
</div>
@endcan