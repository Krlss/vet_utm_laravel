<div>

    @if ($user)
        <div class="uppercase w-full text-center mb-2 text-lg font-extrabold">{{trans('lang.data_owner')}}</div>

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
    @endif

    <div class="uppercase w-full text-center mb-2 text-lg font-extrabold">{{trans('lang.data_pet')}}</div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">

        <div class="form-group flex-col">
            {!! Form::label('pet_id', trans('lang.pet_id'), ['class' => '  ']) !!}
            <div class="">
                <p>
                    {!! $pet->pet_id !!}
                </p>
            </div>  
        </div>

        <div class="form-group flex-col">
            {!! Form::label('namePet', trans('lang.namePet'), ['class' => '  ']) !!}
            <div class="">
                <p>
                    {!! $pet->name !!}
                </p>
            </div>
        </div>

        <div class="form-group flex-col">
            {!! Form::label('specie', trans('lang.specie'), ['class' => '  ']) !!}
            <div class="">
                <p>
                    {!! $pet->specie !!}
                </p>
            </div>
        </div>

        <div class="form-group flex-col">
            {!! Form::label('race', trans('lang.race'), ['class' => '  ']) !!}
            <div class="">
                <p>
                    {!! $pet->race !!}
                </p>
            </div>
        </div>

    </div>


    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">

        <div class="form-group flex-col">
            {!! Form::label('sex', trans('lang.sexP'), ['class' => '  ']) !!}
            <div class="">
                <p>
                    {!! $pet->sex == 'M' ? trans('lang.maleP') : trans('lang.femaleP') !!}
                </p>
            </div>  
        </div>

        <div class="form-group flex-col">
            {!! Form::label('birth', trans('lang.birth'), ['class' => '  ']) !!}
            <div class="">
                <p>
                    {!! $pet->birth !!}
                </p>
            </div>
        </div>

        <div class="form-group flex-col">
            {!! Form::label('castrated', trans('lang.castrated'), ['class' => '  ']) !!}
            <div class="">
                <p>
                    {!! $pet->castrated ? trans('lang.yep') : trans('lang.nop') !!}
                </p>
            </div>
        </div>

        <div class="form-group flex-col">
            {!! Form::label('lost', trans('lang.lost'), ['class' => '  ']) !!}
            <div class="">
                <p>
                    {!! $pet->lost ? trans('lang.yep') : trans('lang.nop') !!}
                </p>
            </div>
        </div>

    </div>

</div>
