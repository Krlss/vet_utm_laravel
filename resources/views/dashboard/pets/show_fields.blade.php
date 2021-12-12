<div>

    @if ($user)
        <div class="uppercase w-full text-center mb-2 text-lg font-extrabold">{{ trans('lang.data_owner') }}</div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
            {{-- User ID --}}
            <div class="form-group flex-col">
                {!! Form::label('tableUserID', trans('lang.tableUserID'), ['class' => '  ']) !!}
                <div class="">
                    <p>
                        {!! $user->user_id !!}
                    </p>
                </div>
            </div>
            {{-- User first_name --}}
            <div class="form-group flex-col">
                {!! Form::label('namesUser', trans('lang.namesUser'), ['class' => '  ']) !!}
                <div class="">
                    <p>
                        {!! $user->name !!}
                    </p>
                </div>
            </div>
            {{-- User last_name --}}
            <div class="form-group flex-col">
                {!! Form::label('last_names', trans('lang.last_names'), ['class' => '  ']) !!}
                <div class="">
                    <p>
                        {!! $user->last_name1 !!} {!! $user->last_name2 !!}
                    </p>
                </div>
            </div>
            {{-- UserEmail --}}
            <div class="form-group flex-col">
                {!! Form::label('email', trans('lang.email'), ['class' => '  ']) !!}
                <div class="">
                    <p>
                        {!! $user->email !!}
                    </p>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1">
            {{-- User address --}}
            <div class="form-group flex-col">
                {!! Form::label('address', trans('lang.address'), ['class' => '  ']) !!}
                <div class="">
                    <p>
                        {!! $user->address !!}
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
            {{-- User province --}}
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
            {{-- User Canton --}}
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

            {{-- User Phone --}}
            <div class="form-group flex-col">
                {!! Form::label('phone', trans('lang.phone'), ['class' => '  ']) !!}
                <div class="">
                    <p>
                        {!! $user->phone !!}
                    </p>
                </div>
            </div>

        </div>
    @endif

    <div class="uppercase w-full text-center mb-2 text-lg font-extrabold">{{ trans('lang.data_pet') }}</div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
        {{-- Pet ID --}}
        <div class="form-group flex-col">
            {!! Form::label('pet_id', trans('lang.pet_id'), ['class' => '  ']) !!}
            <div class="">
                <p>
                    {!! $pet->pet_id !!}
                </p>
            </div>
        </div>
        {{-- Pet name --}}
        <div class="form-group flex-col">
            {!! Form::label('namePet', trans('lang.namePet'), ['class' => '  ']) !!}
            <div class="">
                <p>
                    {!! $pet->name !!}
                </p>
            </div>
        </div>
        {{-- Pet Specie --}}
        <div class="form-group flex-col">
            {!! Form::label('specie', trans('lang.specie'), ['class' => '  ']) !!}
            <div class="">
                <p>
                    {!! trans('lang.' . $pet->specie) !!}
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



    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5">

        <div class="form-group flex-col">
            {!! Form::label('sex', trans('lang.sexP'), ['class' => '  ']) !!}
            <div class="">
                <p>

                    @if ($pet->sex == '##########')
                        {{ $pet->sex }}
                    @else
                        {{ $pet->sex == 'M' ? trans('lang.maleP') : trans('lang.femaleP') }}
                    @endif
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

        <div class="form-group flex-col">
            {!! Form::label('n_lost', trans('lang.n_lost'), ['class' => '  ']) !!}
            <div class="">
                <p>
                    {!! $pet->n_lost !!}
                </p>
            </div>
        </div>

    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
        <div class="form-group flex-col">
            {!! Form::label('pather', trans('lang.pather'), ['class' => '  ']) !!}
            <div class="">
                @if ($pet->id_pet_pather)
                    <a href={{ route('dashboard.pets.show', $pet->id_pet_pather) }}>
                        {!! $pet->id_pet_pather !!}
                    </a>
                @else
                    <p>{{ trans('lang.it_doesnt_have') }}</p>
                @endif
            </div>
        </div>

        <div class="form-group flex-col">
            {!! Form::label('mother', trans('lang.mother'), ['class' => '  ']) !!}
            <div class="">
                @if ($pet->id_pet_mother)
                    <a href={{ route('dashboard.pets.show', $pet->id_pet_mother) }}>
                        {!! $pet->id_pet_mother !!}
                    </a>
                @else
                    <p>{{ trans('lang.it_doesnt_have') }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1">
        <div class="form-group flex-col">
            {!! Form::label('childs', trans('lang.childs'), ['class' => '  ']) !!}
            <div class="flex flex-wrap space-x-2">
                @if (count($childs))
                    @foreach ($childs as $child)
                        <div class="p-1 border-2">
                            <a href={{ route('dashboard.pets.show', $child->pet_id) }}>
                                {!! $child->pet_id !!}
                            </a>
                        </div>
                    @endforeach
                @else
                    <p>{{ trans('lang.it_doesnt_have') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
