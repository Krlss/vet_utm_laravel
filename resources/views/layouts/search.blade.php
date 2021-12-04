@push('css_lib')
    <style>
        .page-link{
            width: 45px !important;
        }
        thead{
            font-size: 14px;
        }
        thead tr th a{
            color: black;
        }
        thead tr th a i{
            color: lightgray !important;
            margin-left: 15px;
        }
        .animationload {
            background-color: rgba(255,255,255,0.6);
            height: 100%;
            left: 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10000;
        }
        .osahanloading {
            animation: 1.5s linear 0s normal none infinite running osahanloading;
            background: #fed37f none repeat scroll 0 0;
            border-radius: 50px;
            height: 50px;
            left: 50%;
            margin-left: -25px;
            margin-top: -25px;
            position: absolute;
            top: 50%;
            width: 50px;
        }
        .osahanloading::after {
            animation: 1.5s linear 0s normal none infinite running osahanloading_after;
            border-color: #85d6de transparent;
            border-radius: 80px;
            border-style: solid;
            border-width: 10px;
            content: "";
            height: 80px;
            left: -15px;
            position: absolute;
            top: -15px;
            width: 80px;
        }
        @keyframes osahanloading {
            0% {
                transform: rotate(0deg);
            }
            50% {
                background: #85d6de none repeat scroll 0 0;
                transform: rotate(180deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush
<div class="row">
    <div class="col-lg-4 col-xs-12"></div>
    <div class="ml-auto">
        <form action="" method="GET" onsubmit="showLoading(event)" id="form_search">
            <div id="dataTableBuilder_filter" class="row" style="margin-bottom: 15px; margin-left: 25px">
                <div class="col-3">Buscar:</div>
                <div class="col-7">
                    <input autocomplete="off" type="search" list="options" name="search" value="{{isset($_REQUEST['search']) ? $_REQUEST['search'] : ''}}" class="form-control form-control-sm" placeholder="" aria-controls="dataTableBuilder">
                    <datalist id="options">
                        @if(isset($options))
                            @foreach($options as $key => $option)
                                <option value="{{$key}}">{{$option['value']}}</option>
                            @endforeach
                        @endif
                    </datalist>
                </div>
                <div class="col-2" style="margin-top: -6px">
                    <button type="submit" class="btn btn-light" style="float: right"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>

    </div>
</div>

<div>
    <div class="animationload" id="loading_gif" style="display: none">
        <button class="btn btn-light close-loading" ><i class="fa fa-close"></i></button>
        <div class="osahanloading"></div>
    </div>
</div>
