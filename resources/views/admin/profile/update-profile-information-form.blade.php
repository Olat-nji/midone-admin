<div class="intro-y box lg:mt-5">
    <form wire:submit.prevent="updateProfileInformation">
        <div class=" p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">Profile Information</h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ __("Update your account's profile information and email address. ") }}
            </p>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-12 gap-5">
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-12 xl:col-span-4">
                    <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                        <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto" x-show="! photoPreview">

                            <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">


                        </div>
                        <div class="mt-2" x-show="photoPreview">
                            <span class="block rounded-full w-20 h-20" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>
                        <div class="w-40 mx-auto cursor-pointer relative mt-5">


                            <button type="button" x-on:click.prevent="$refs.photo.click()" class="button w-full mb-2  bg-gray-700 text-white">Change Photo</button>
                            @if ($this->user->profile_photo_path)
                            <button type="button" wire:click="deleteProfilePhoto" class="button  w-full  bg-gray-700 text-white">Remove Photo</button>
                            @endif


                            <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />
                        </div>


                    </div>
                </div>
                <div class="col-span-12 xl:col-span-8">
                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
                        <x-input-error for="name" class="mt-2" />
                    </div>
                    <div class="mt-3">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
                        <x-input-error for="email" class="mt-2" />
                    </div>

                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">

            

                        <x-button wire:loading.remove wire:target="photo">
                            {{ __('Save') }}
                        </x-button>
                        <x-button wire:loading wire:loading.class="bg-opacity-25" wire:target="photo">
                            {{ __('Saving ...') }}
                        </x-button>
                                    <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000);  })" x-show.transition.opacity.out.duration.1500ms="shown" style="display: none;" class='text-sm text-gray-600 text-center w-20 pt-5'>
                            {{ 'Saved.' }} </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
