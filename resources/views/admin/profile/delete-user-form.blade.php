<div>
    <div class="intro-y box mt-5">
        <div class=" px-5 py-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                {{ __('Delete Account') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Permanently delete your account.') }}
            </p>

        </div>
        <div class=" py-5" id="announcement">
            <div class="px-5">

                <div class="text-gray-700 dark:text-gray-600 mt-2">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}</div>

                <div class="flex items-center mt-5">
                    <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                        {{ __('Delete Account') }}
                    </x-danger-button>

                    <!-- Delete User Confirmation Modal -->
                    <x-dialog-modal wire:model="confirmingUserDeletion">
                        <x-slot name="title">
                            {{ __('Delete Account') }}
                        </x-slot>

                        <x-slot name="content">
                            {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}

                            <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                                <x-input type="password" class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" x-ref="password" wire:model.defer="password" wire:keydown.enter="deleteUser" />

                                <x-input-error for="password" class="mt-2" />
                            </div>
                        </x-slot>

                        <x-slot name="footer">
                            <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                                {{ __('Nevermind') }}
                            </x-secondary-button>

                            <x-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                                {{ __('Delete Account') }}
                            </x-danger-button>
                        </x-slot>
                    </x-dialog-modal>



                </div>
            </div>

        </div>
    </div>


</div>
