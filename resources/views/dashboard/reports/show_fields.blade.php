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
                        {{ $user->address ? $user->address : trans('lang.without_address') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
            {{-- User province --}}
            <div class="form-group flex-col">
                {!! Form::label('province', trans('lang.province'), ['class' => '  ']) !!}
                <div class="">
                    <p>
                        {{ $province ? $province->name : trans('lang.without_province') }}
                    </p>
                </div>
            </div>

            {{-- User Canton --}}
            <div class="form-group flex-col">
                {!! Form::label('canton', trans('lang.canton'), ['class' => '  ']) !!}
                <div class="">
                    <p>
                        {{ $canton ? $canton->name : trans('lang.without_canton') }}
                    </p>
                </div>
            </div>

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

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">

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

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2">

        <div class="form-group flex-col">
            {!! Form::label('published', trans('lang.published'), ['class' => '  ']) !!}
            <div class="">
                <p>
                    {!! $pet->published ? trans('lang.yep') : trans('lang.nop') !!}
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

    @if (count($images) > 0)
        <div class="uppercase w-full text-center mb-2 text-lg font-extrabold">{{ trans('lang.photos_report') }}</div>
    @else
        <div class="uppercase w-full text-center mb-2 text-lg font-extrabold">
            {{ trans('lang.not_photos_report') }}
        </div>
        <div class="w-full text-left">
            {{ trans('lang.recommendable_not_published') }}
        </div>
    @endif

    <div class="flex flex-wrap w-full h-full">
        @foreach ($images as $img)
            <img class="w-60 object-cover p-2" src={{ $img->url }} />
        @endforeach
    </div>

</div>