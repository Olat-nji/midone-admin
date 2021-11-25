<div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Add New Price
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">

            <button class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white" @click="tab = 'index'"> <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>Go Back</button>

        </div>
    </div>
    <form wire:submit.prevent="new">
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">

                    <div>
                        <label> Name</label>
                        <input type="text" class="input w-full border @error('name')border-theme-6 @enderror  mt-2" wire:model="name">
                        @error('name')<div class="text-theme-6 mt-2">{{$message}}</div>@enderror
                    </div>



                    <div class="mt-3">
                        <label>Price</label>

                        <div class="relative mt-2">
                            <div class="absolute top-0 left-0 rounded-l w-12 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">₦</div>
                            <div class="pl-3">
                                <input type="text" class="input pl-12 w-full border @error('price')border-theme-6 @enderror col-span-4" placeholder="Price" wire:model="price">
                                @error('price')<div class="text-theme-6 mt-2">{{$message}}</div>@enderror
                            </div>
                        </div>


                    </div>

                    <div class="mt-3">
                        <label>Features</label>
                        <textarea class="input w-full border @error('features')border-theme-6 @enderror mt-2" wire:model="features"></textarea>
                        @error('features')<div class="text-theme-6 mt-2">{{$message}}</div>@enderror
                        <div class="text-xs text-gray-600 mt-2">Seperate each feature by a comma ','</div>
                    </div>

                    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                        <div class="mr-auto">
                            <button type="button" @click="tab = 'index'" class="button w-24 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">Cancel</button>
                            
                        </div>
                        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">


                            <button wire:loading.remove wire:target="new" type="submit" class="button w-24 bg-theme-1 text-white mr-auto">Save</button>
                            <button wire:loading wire:target="new" class="bg-opacity-75 button w-24 bg-theme-1 text-white mr-auto"> Saving ...</button>
                            
                        </div>
                    </div>
                </div>
                <!-- END: Form Layout -->
            </div>
        </div>
    </form>

</div>
