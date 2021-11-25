<div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            FAQ
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="button text-white bg-theme-1 shadow-md mr-2" @click="tab = 'create'">Add New FAQ</button>

        </div>
    </div>
    <!-- BEGIN: Pricing Layout -->
    <div class="intro-y box grid grid-cols-12 gap-6 mt-5 mt-5 ">
    @foreach ($faqs as $index => $faq)
        <div class="intro-y col-span-12 lg:col-span-6 px-5 py-5 border-b border-t lg:border-b-0 lg:border-t-0  lg:border-l lg:border-r border-gray-200 dark:border-dark-5">
            <img class="w-12  mx-auto" src="{{$faq->image}}"/>
            <div class="text-xl font-medium text-center mt-10">{{$faq->name}}</div>
            
            <div class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2">{{$faq->description}}</div>
            
            <div class="flex justify-center">
                <a href="{{url('settings/faqs/'.$faq->id.'/edit')}}" class="button button--lg text-white bg-theme-1 rounded-full mx-auto mt-8">EDIT</a>
                <button type="button" wire:click="confirmDelete({{$faq->id}})" class="button button--lg text-white bg-theme-6 rounded-full mx-auto mt-8">DELETE</button>
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
