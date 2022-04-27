   @if($email_verified_at)
   <i data-tooltip-target="tooltip-dark" class="fa fa-check-circle text-green-500"></i>
   <div id="tooltip-dark" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
       {{trans('lang.email_veri')}}
       <div class="tooltip-arrow" data-popper-arrow></div>
   </div>
   @else
   @if(!$send)
   <button type="button" id="email_verificate" wire:click="send_verification">
       <i wire:loading data-tooltip-target="tooltip-email" class="fa fa-spinner animate-spin text-gray-500 hidden"></i>
       <i wire:loading.class="hidden" data-tooltip-target="tooltip-email" class="fa fa-check-circle text-gray-500"></i>
       <div id="tooltip-email" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
           @if(!$send)
           <p wire:loading class="hidden">{{trans('lang.email_no_veri_loading')}}</p>
           <p wire:loading.class="hidden" class="">{{trans('lang.email_no_veri')}}</p>
           @else($send)
           <p>{{trans('lang.envoy_email')}}</p>
           @endif
           <div class="tooltip-arrow" data-popper-arrow></div>
       </div>
   </button>
   @else
   <button type="button" id="email_verificate" disabled>
       <i wire:loading data-tooltip-target="tooltip-email" class="fa fa-spinner animate-spin text-gray-500 hidden"></i>
       <i wire:loading.class="hidden" data-tooltip-target="tooltip-email" class="fa fa-check-circle text-gray-500"></i>
       <div id="tooltip-email" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
           @if(!$send)
           <p wire:loading class="hidden">{{trans('lang.email_no_veri_loading')}}</p>
           <p wire:loading.class="hidden" class="">{{trans('lang.email_no_veri')}}</p>
           @else($send)
           <p>{{trans('lang.envoy_email')}}</p>
           @endif
           <div class="tooltip-arrow" data-popper-arrow></div>
       </div>
   </button>
   @endif
   @endif