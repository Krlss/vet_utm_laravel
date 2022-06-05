<div>
    <!-- 1 row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2">
        <!-- Name specie -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('name', __('Name') . '*', ['class' => '']) !!}
            {!! Form::text('name', $province->name ?? null, ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Name'), 'required' => true]) !!}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- letter -->
        <div class="flex flex-col px-2 md:mb-0 mb-2">
            {!! Form::label('letter', __('Letter') , ['class' => '']) !!}
            {!! Form::select('letter', $lettersAvailable, $province->letter ?? null, ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'id'=>'letter', 'placeholder' => $lettersAvailable ? null : __('There are no more letters available... :(')]) !!}
            @error('letter')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <x-submit-button-default />

</div>