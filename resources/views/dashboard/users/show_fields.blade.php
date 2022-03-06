@if (session('info'))
<div class="alert alert-info">
    <strong>{{ session('info') }}</strong>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    <strong>{{ session('error') }}</strong>
</div>
@endif

<h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
    {!!trans('lang.label_data_user')!!}
</h6>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">

    <div class="form-group flex-col">
        {!! Form::label('tableUserID', trans('lang.tableUserID'), ['class' => ' ']) !!}
        <div class="">
            <p>
                {!! $user->user_id !!}
            </p>
        </div>
    </div>

    <div class="form-group flex-col">
        {!! Form::label('namesUser', trans('lang.namesUser'), ['class' => ' ']) !!}
        <div class="">
            <p>
                {!! $user->name !!}
            </p>
        </div>
    </div>

    <div class="form-group flex-col">
        {!! Form::label('last_names', trans('lang.last_names'), ['class' => ' ']) !!}
        <div class="">
            <p>
                {!! $user->last_name1 !!} {!! $user->last_name2 !!}
            </p>
        </div>
    </div>



</div>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2">
    <div class="form-group flex-col">
        {!! Form::label('email', trans('lang.email'), ['class' => ' ']) !!}
        <div class="">
            <p>
                {!! $user->email !!}
            </p>
        </div>
    </div>
    <div class="form-group flex-col">
        {!! Form::label('phone', trans('lang.phone'), ['class' => ' ']) !!}
        <div class="">
            <p>
                {!! $user->phone !!}
            </p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 ">

    <div class="form-group flex-col">
        {!! Form::label('address', trans('lang.address'), ['class' => ' ']) !!}
        <div class="">
            <p>
                {!! $user->address ? $user->address : trans('lang.without_address') !!}
            </p>
        </div>
    </div>

</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2">

    <div class="form-group flex-col">
        {!! Form::label('province', trans('lang.province'), ['class' => ' ']) !!}
        <div class="">
            <p>
                {{ $province ? $province->name : trans('lang.without_province') }}
            </p>
        </div>
    </div>

    <div class="form-group flex-col">
        {!! Form::label('canton', trans('lang.canton'), ['class' => ' ']) !!}
        <div class="">
            <p>
                {{ $canton ? $canton->name : trans('lang.without_canton')}}
            </p>
        </div>
    </div>

</div>


@if($pets)
<h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
    {!!trans('lang.label_data_user_pets')!!} ({!! count($pets) !!})
</h6>

<div class="w-full max-h-80 flex flex-row flex-wrap overflow-y-scroll">
    @foreach ($pets as $pet)
    <div class="p-2 col-lg-4">
        <div class="border px-4 py-2 rounded-lg flex flex-row justify-between">
            <div class="flex flex-col">
                <h4 class="uppercase font-bold">{!! $pet->name !!}</h4>
                <small class="uppercase">{!! $pet->pet_id !!}</small>
            </div>
            <div class="flex items-center justify-center">
                @can('dashboard.pets.show')
                <a href="{{ route('dashboard.pets.show', $pet) }}">
                    <i class="fas fa-eye text-gray-500 hover:text-gray-700 cursor-pointer"></i>
                </a>
                @endcan
                @can('dashboard.pets.edit')
                <a href="{{ route('dashboard.pets.edit', $pet) }}" class='btn btn-link'>
                    <i class="fas fa-edit text-gray-500 hover:text-gray-700  cursor-pointer"></i>
                </a>
                @endcan

                @can('dashboard.users.destroy')
                {{ Form::open(['route' => ['dashboard.deletePetUser', $pet], 'method' => 'post']) }}
                @csrf
                {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-gray-700"></i>', [
                'type' => 'submit',
                'class' => '',
                'onclick' => "return confirm('Estás seguro que deseas eliminar a $pet->name de este usuario?')",
                ]) !!}
                {!! Form::close() !!}
                @endcan

            </div>
        </div>

    </div>
    @endforeach
</div>




@else
<h6 class="text-gray-400 text-sm my-3 font-bold uppercase">
    {!!trans('lang.label_data_user_pets_without')!!}
</h6>
@endif