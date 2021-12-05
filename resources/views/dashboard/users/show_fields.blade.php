<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">

    <div class="form-group flex-col">
        {!! Form::label('tableUserID', trans('lang.tableUserID'), ['class' => '  ']) !!}
        <div class="">
            <p>
                {!! $user->user_id !!}
            </p>
        </div>
    </div>

    <div class="form-group flex-col">
        {!! Form::label('namesUser', trans('lang.namesUser'), ['class' => '  ']) !!}
        <div class="">
            <p>
                {!! $user->name !!}
            </p>
        </div>
    </div>

    <div class="form-group flex-col">
        {!! Form::label('last_names', trans('lang.last_names'), ['class' => '  ']) !!}
        <div class="">
            <p>
                {!! $user->last_name1 !!} {!! $user->last_name2 !!}
            </p>
        </div>
    </div>



</div>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2">
    <div class="form-group flex-col">
        {!! Form::label('email', trans('lang.email'), ['class' => '  ']) !!}
        <div class="">
            <p>
                {!! $user->email !!}
            </p>
        </div>
    </div>
    <div class="form-group flex-col">
        {!! Form::label('phone', trans('lang.phone'), ['class' => '  ']) !!}
        <div class="">
            <p>
                {!! $user->phone !!}
            </p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 ">

    <div class="form-group flex-col">
        {!! Form::label('address', trans('lang.address'), ['class' => '  ']) !!}
        <div class="">
            <p>
                {!! $user->address !!}
            </p>
        </div>
    </div>

</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2">

    @if ($province)
        <div class="form-group flex-col">
            {!! Form::label('province', trans('lang.province'), ['class' => '  ']) !!}
            <div class="">
                <p>
                    {{ $province->name }}
                </p>
            </div>
        </div>
    @endif

    @if ($canton)
        <div class="form-group flex-col">
            {!! Form::label('canton', trans('lang.canton'), ['class' => '  ']) !!}
            <div class="">
                <p>
                    {{ $canton->name }}
                </p>
            </div>
        </div>
    @endif

</div>
