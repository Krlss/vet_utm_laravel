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

<h6 class="text-gray-400 text-sm my-3 font-bold uppercase flex items-center">
    {!!trans('lang.label_data_user')!!}
    @can('dashboard.users.edit')
    <a href="{{ route('dashboard.users.edit', $user) }}" class='btn btn-link text-gray-500 hover:text-green-700'>
        <i class="fas fa-edit cursor-pointer"></i>
    </a>
    @endcan
    @can('dashboard.users.destroy')
    {!! Form::open(['route' => ['dashboard.users.destroy', $user], 'method' => 'delete']) !!}
    {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-red-700"></i>', [
    'type' => 'submit',
    'class' => '',
    'onclick' => "return confirm('Estás seguro que deseas eliminar a $user->name')",
    ]) !!}
    {!! Form::close() !!}
    @endcan
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

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">

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

    <div class="form-group flex-col">
        {!! Form::label('parish', trans('lang.parishe'), ['class' => ' ']) !!}
        <div class="">
            <p>
                {{ $parish ? $parish->name : trans('lang.without_parishe')}}
            </p>
        </div>
    </div>

</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 ">

    <div class="form-group flex-col">
        {!! Form::label('main_street', trans('lang.main_street'), ['class' => ' ']) !!}
        <div class="">
            <p>
                {!! $user->main_street ? $user->main_street : trans('lang.without_main_street') !!}
            </p>
        </div>
    </div>

    <div class="form-group flex-col">
        {!! Form::label('street_1_sec', trans('lang.street_1_sec'), ['class' => ' ']) !!}
        <div class="">
            <p>
                {!! $user->street_1_sec ? $user->street_1_sec : trans('lang.without_street_1_sec') !!}
            </p>
        </div>
    </div>

</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 ">

    <div class="form-group flex-col">
        {!! Form::label('street_2_sec', trans('lang.street_2_sec'), ['class' => ' ']) !!}
        <div class="">
            <p>
                {!! $user->street_2_sec ? $user->street_2_sec : trans('lang.without_street_2_sec') !!}
            </p>
        </div>
    </div>

    <div class="form-group flex-col">
        {!! Form::label('address_ref', trans('lang.address_ref'), ['class' => ' ']) !!}
        <div class="">
            <p>
                {!! $user->address_ref ? $user->address_ref : trans('lang.without_address_ref') !!}
            </p>
        </div>
    </div>

</div>

<livewire:users.show-list-pets :currentsPets="$pets" :user_id="$user->user_id" :delete="true" />
@livewireScripts