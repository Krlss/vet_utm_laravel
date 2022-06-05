@can('dashboard.provinces.create')
<form autocomplete="off">
    <div class="modal fade" id="Modalprovince" tabindex="-1" role="dialog" aria-labelledby="Modalprovince" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="flex flex-col">
                        <h5 class="font-bold">{{__('Quick creation of a new province')}}</h5>
                        <small class="header-error text-red-500">{{!$lettersAvailable ? __('There are no letters available... You cannot create more provinces :(') : ''}}</small>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="grid grid-cols-1">
                        <!-- Name province -->
                        <div class="flex flex-col px-2 md:mb-0 mb-2">
                            {!! Form::label('letter', __('Letters Available') . '*' , ['class' => '']) !!}
                            {!! Form::select('letter', $lettersAvailable, null, ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'id'=>'letter', 'placeholder' => $lettersAvailable ? __('Select a letter') : __('There are no letters available...'), 'required' => true]) !!}
                            <span class="text-danger error_letter"></span>
                        </div>
                    </div>
                    <div class="grid grid-cols-1">
                        <!-- Name province -->
                        <div class="flex flex-col px-2 md:mb-0 mb-2">
                            {!! Form::label('name_province', __('Name') . '*', ['class' => '']) !!}
                            {!! Form::text('name_province', old('name_province'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Name'), 'required' => true]) !!}
                            <span class="text-danger error_province"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <x-submit-button-default />
                </div>
            </div>
        </div>
    </div>
</form>
@endcan