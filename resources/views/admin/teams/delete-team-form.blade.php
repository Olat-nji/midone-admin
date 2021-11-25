<div>
    <div class="intro-y box mt-5">
        <div class=" px-5 py-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                {{ __('Delete Team') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Permanently delete this team.') }}
            </p>

        </div>
        <div class=" py-5" id="announcement">
            <div class="px-5">

                <div class="text-gray-700 dark:text-gray-600 mt-2">
                    {{ __('Once a team is deleted, all of its resources and data will be permanently deleted. Before deleting this team, please download any data or information regarding this team that you wish to retain.') }}
                </div>

                <div class="flex items-center mt-5">
                    <x-danger-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                        {{ __('Delete Team') }}
                        </x-jet-danger-button>


                        <x-confirmation-modal wire:model="confirmingTeamDeletion">
                            <x-slot name="title">
                                {{ __('Delete Team') }}
                            </x-slot>

                            <x-slot name="content">
                                {{ __('Are you sure you want to delete this team? Once a team is deleted, all of its resources and data will be permanently deleted.') }}
                            </x-slot>

                            <x-slot name="footer">
                                <x-secondary-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                                    {{ __('Nevermind') }}
                                    </x-jet-secondary-button>

                                    <x-danger-button class="ml-2" wire:click="deleteTeam" wire:loading.attr="disabled">
                                        {{ __('Delete Team') }}
                                        </x-jet-danger-button>
                            </x-slot>
                            </x-jet-confirmation-modal>


                </div>
            </div>

        </div>
    </div>


</div>
