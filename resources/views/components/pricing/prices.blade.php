<div>

    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Pricing
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="button text-white bg-theme-1 shadow-md mr-2" @click="tab = 'create'">Add New Price</button>

        </div>
    </div>
    <!-- BEGIN: Pricing Layout -->
    <div class="intro-y box grid grid-cols-12 gap-6 mt-5 mt-5">
        @foreach ($pricings as $index => $pricing)
        <div class="intro-y col-span-12 lg:col-span-6 border-b border-t lg:border-b-0 lg:border-t-0 flex-1 p-5 lg:border-l lg:border-r border-gray-200 dark:border-dark-5 py-16">
            <i data-feather="credit-card" class="w-12 h-12 text-theme-1 dark:text-theme-10 mx-auto"></i>
            <div class="text-xl font-medium text-center mt-10">{{$pricing->name}}</div>
            <div class="text-gray-700 dark:text-gray-600 text-center mt-5">
                @foreach(explode(',',$pricing->features) as $key => $feature)
                {{$feature}}
                @if($key!=count(explode(',',$pricing->features)))
                <span class="mx-1">•</span>
                @endif
                @endforeach </div>

            <div class="flex justify-center">
                <div class="relative text-5xl font-semibold mt-8 mx-auto"> {{$pricing->price}} <span class="absolute text-2xl top-0 right-0 text-gray-500 -mr-4 mt-1">₦</span> </div>
            </div>
            <div class="flex justify-center">
                <a href="{{url('settings/pricing/'.$pricing->id.'/edit')}}" class="button button--lg text-white bg-theme-1 rounded-full mx-auto mt-8">EDIT</a>
                <button type="button" wire:click="confirmDelete({{$pricing->id}})" class="button button--lg text-white bg-theme-6 rounded-full mx-auto mt-8">DELETE</button>
            </div>
        </div>



        @endforeach

    </div>
    <x-dialog-modal wire:model="confirmingDelete">
        <x-slot name="title">
            {{ __('Are You Sure You want to Delete?') }}
        </x-slot>

        <x-slot name="content">
            {{ __('This information would be lost forever!') }}


        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingDelete')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete') }}
                </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
