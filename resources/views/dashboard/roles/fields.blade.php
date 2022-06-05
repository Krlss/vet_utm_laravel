<!-- Name Field -->
<div class="form-group col-6">
    {!! Form::label('name', __('Name') . '*', ['class' => '']) !!}

    {!! Form::text('name', $role ? $role->name : null, ['class' => 'form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm', 'placeholder' => __('Name'), 'required' => true]) !!}

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-right">
    <x-submit-button-default />
</div>