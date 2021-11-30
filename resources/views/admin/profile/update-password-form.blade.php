<div>
    <div class="col-span-12 lg:col-span-8 xxl:col-span-9" id="update-password">
        <form wire:submit.prevent="updatePassword">
            <!-- BEGIN: Change Password -->
            <div class="intro-y box lg:mt-5">
                <div class=" p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        {{ __('Update Password') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </p>

                </div>
                <div class="p-5">
                    <div>
                        <x-label for="current_password" value="{{ __('Current Password') }}" />
                        <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
                        <x-input-error for="current_password" class="mt-2" />
                    </div>
                    <div class="mt-3">
                        <x-label for="password" value="{{ __('New Password') }}" />
                        <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
                        <x-input-error for="password" class="mt-2" />
                    </div>
                    <div class="mt-3">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
                        <x-input-error for="password_confirmation" class="mt-2" />
                    </div>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">



                        <x-button>
                            {{ __('Save') }}
                        </x-button>

                        <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000);  })" x-show.transition.opacity.out.duration.1500ms="shown" style="display: none;" class='text-sm text-gray-600 text-center w-20 pt-5'>
                            {{ 'Saved.' }} </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- END: Change Password -->
    </div>
</div>
