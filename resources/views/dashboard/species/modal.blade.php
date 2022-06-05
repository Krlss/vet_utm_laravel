@can('dashboard.species.create')
<form autocomplete="off" method="post" id="upload_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="modal fade" id="Modalspecie" tabindex="-1" role="dialog" aria-labelledby="Modalspecie" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="font-bold">{{__('Quick creation of a new specie')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="grid grid-cols-1">
                        <!-- Name specie -->
                        <div class="flex flex-col px-2 md:mb-0 mb-2">
                            {!! Form::label('name_specie', __('Name') . '*', ['class' => '']) !!}
                            {!! Form::text('name_specie', old('name_specie'), ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Name'), 'required' => true]) !!}
                            <span class="text-danger error_specie"></span>
                        </div>

                        <div class="px-2 md:mb-0 mb-2">
                            <label for="image" class="cursor-pointer flex items-center mb-2 bg-yellow-400 hover:bg-yellow-500 p-2 rounded justify-center relative">
                                {{__('Select a image')}}*
                                <li class="fa fa-upload ml-2"></li>
                                <input type="file" id="image" accept="image/*" name="image" required class="absolute left-auto top-0 z-0 opacity-0 cursor-pointer" />
                            </label>
                            <small>{{__('This image will be displayed in app mobile, is required selected one')}}</small>
                            <div class="flex-col items-center justify-center hidden" id="preview">
                                <img class="bg-contain bg-center w-48 h-48" id="img" src="#" />
                                <button type="button" id="button" class="bg-red-600 hover:bg-red-500 text-white px-2 py-1 rounded-md mt-2">{{__('Remove photo')}}</button>
                            </div>
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