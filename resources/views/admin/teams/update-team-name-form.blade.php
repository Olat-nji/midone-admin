<div>
    <div class="intro-y box mt-5">
        <form wire:submit.prevent="updateTeamName">
            <div class=" px-5 py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    {{ __('Team Name') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('The team\'s name and owner information.') }}
                </p>

            </div>
            <div class=" py-5" id="announcement">
                <div class="px-5">

                    <div class="text-gray-700 dark:text-gray-600 mt-2">
                        <div class="col-span-6">
                            <x-label value="{{ __('Team Owner') }}" />

                            <div class="flex items-center mt-2">
                                <img class="w-12 h-12 rounded-full object-cover" src="{{ $team->owner->profile_photo_url }}" alt="{{ $team->owner->name }}">

                                <div class="ml-4 leading-tight">
                                    <div>{{ $team->owner->name }}</div>
                                    <div class="text-gray-700 text-sm">{{ $team->owner->email }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-gray-700 dark:text-gray-600 mt-2">
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="name" value="{{ __('Team Name') }}" />

                            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" :disabled="! Gate::check('update', $team)" />

                            <x-input-error for="name" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                        @if (Gate::check('update', $team))
                        <x-slot name="actions">
                            <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000);  })" x-show.transition.opacity.out.duration.1500ms="shown" style="display: none;" class='text-sm text-gray-600'>
                                {{ 'Saved.' }}
                            </div>

                            <x-button>
                                {{ __('Save') }}
                                </x-jet-button>
                        </x-slot>
                        @endif


                    </div>
                </div>

            </div>
        </form>
    </div>


</div>
