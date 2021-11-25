<div>
    @if (Gate::check('addTeamMember', $team))
    <div class="intro-y box mt-5">
        <form wire:submit.prevent="addTeamMember">
            <div class=" px-5 py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    {{ __('Add Team Member') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Add a new team member to your team, allowing them to collaborate with you.') }}
                </p>

            </div>
            <div class=" py-5" id="announcement">
                <div class="px-5">

                    <div class="text-gray-700 dark:text-gray-600 mt-2">
                        <div class="col-span-6">
                            <div class="max-w-xl text-sm text-gray-600">
                                {{ __('Please provide the email address of the person you would like to add to this team. The email address must be associated with an existing account.') }}
                            </div>
                        </div>
                    </div>

                    <div class="text-gray-700 dark:text-gray-600 mt-2">
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="name" list="use" type="text" class="mt-1 block w-full" wire:model.defer="addTeamMemberForm.email" />
                            <datalist id="use">

                                @foreach(App\Models\User::all() as $key => $value)
                                @if($value->email != auth()->user()->email)
                                <option value="{{ $value->email }}">
                                    @endif
                                    @endforeach
                            </datalist>

                            <x-input-error for="email" class="mt-2" />
                        </div>

                    </div>
                    @if (count($this->roles) > 0)
                    <div class="col-span-6 lg:col-span-4">
                        <x-label for="role" value="{{ __('Role') }}" />
                        <x-input-error for="role" class="mt-2" />

                        <div class="mt-1 border border-gray-200 rounded-lg cursor-pointer">
                            @foreach ($this->roles as $index => $role)
                            <div class="px-4 py-3 {{ $index > 0 ? 'border-t border-gray-200' : '' }}" wire:click="$set('addTeamMemberForm.role', '{{ $role->key }}')">
                                <div class="{{ isset($addTeamMemberForm['role']) && $addTeamMemberForm['role'] !== $role->key ? 'opacity-50' : '' }}">
                                    <!-- Role Name -->
                                    <div class="flex items-center">
                                        <div class="text-sm text-gray-600 {{ $addTeamMemberForm['role'] == $role->key ? 'font-semibold' : '' }}">
                                            {{ $role->name }}
                                        </div>

                                        @if ($addTeamMemberForm['role'] == $role->key)
                                        <svg class="ml-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        @endif
                                    </div>

                                    <!-- Role Description -->
                                    <div class="mt-2 text-xs text-gray-600">
                                        {{ $role->description }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif




                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000);  })" x-show.transition.opacity.out.duration.1500ms="shown" style="display: none;" class='text-sm text-gray-600'>
                            {{ 'Added.' }}
                        </div>

                            <x-button>
                                {{ __('Add') }}
                                </x-jet-button>


                    </div>
                </div>

            </div>
        </form>
    </div>
    @endif


@if ($team->users->isNotEmpty())
    <div class="intro-y box mt-5">
        
            <div class=" px-5 py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    {{ __('Team Members') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('All of the people that are part of this team.') }}
                </p>

            </div>
            <div class=" py-5" id="announcement">
                <div class="px-5">

                    

                    
                    <div class="space-y-6">
                    @foreach ($team->users->sortBy('name') as $user)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img class="w-8 h-8 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                            <div class="ml-4">{{ $user->name }}</div>
                        </div>

                        <div class="flex items-center">
                            <!-- Manage Team Member Role -->
                            @if (Gate::check('addTeamMember', $team) && App\Helpers\MainHelper::hasRoles())
                            <button class="ml-2 text-sm text-gray-400 underline" wire:click="manageRole('{{ $user->id }}')">
                                {{ App\Helpers\MainHelper::findRole($user->membership->role)->name }}
                            </button>
                            @elseif (App\Helpers\MainHelper::hasRoles())
                            <div class="ml-2 text-sm text-gray-400">
                                {{ App\Helpers\MainHelper::findRole($user->membership->role)->name }}
                            </div>
                            @endif

                            <!-- Leave Team -->
                            @if ($this->user->id === $user->id)
                            <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none" wire:click="$toggle('confirmingLeavingTeam')">
                                {{ __('Leave') }}
                            </button>

                            <!-- Remove Team Member -->
                            @elseif (Gate::check('removeTeamMember', $team))
                            <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none" wire:click="confirmTeamMemberRemoval('{{ $user->id }}')">
                                {{ __('Remove') }}
                            </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000);  })" x-show.transition.opacity.out.duration.1500ms="shown" style="display: none;" class='text-sm text-gray-600'>
                            {{ 'Added.' }}
                        </div>

                            <x-button>
                                {{ __('Add') }}
                                </x-jet-button>


                    </div>
                </div>


            </div>
        
    </div>
<x-dialog-modal wire:model="currentlyManagingRole">
        <x-slot name="title">
            {{ __('Manage Role') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-1 border border-gray-200 rounded-lg cursor-pointer">
                @foreach ($this->roles as $index => $role)
                <div class="px-4 py-3 {{ $index > 0 ? 'border-t border-gray-200' : '' }}" wire:click="$set('currentRole', '{{ $role->key }}')">
                    <div class="{{ $currentRole !== $role->key ? 'opacity-50' : '' }}">
                        <!-- Role Name -->
                        <div class="flex items-center">
                            <div class="text-sm text-gray-600 {{ $currentRole == $role->key ? 'font-semibold' : '' }}">
                                {{ $role->name }}
                            </div>

                            @if ($currentRole == $role->key)
                            <svg class="ml-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            @endif
                        </div>

                        <!-- Role Description -->
                        <div class="mt-2 text-xs text-gray-600">
                            {{ $role->description }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="stopManagingRole" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
                </x-jet-secondary-button>

                <x-button class="ml-2" wire:click="updateRole" wire:loading.attr="disabled">
                    {{ __('Save') }}
                    </x-jet-button>
        </x-slot>
        </x-jet-dialog-modal>

        <!-- Leave Team Confirmation Modal -->
        <x-confirmation-modal wire:model="confirmingLeavingTeam">
            <x-slot name="title">
                {{ __('Leave Team') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you would like to leave this team?') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingLeavingTeam')" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                    </x-jet-secondary-button>

                    <x-danger-button class="ml-2" wire:click="leaveTeam" wire:loading.attr="disabled">
                        {{ __('Leave') }}
                        </x-jet-danger-button>
            </x-slot>
            </x-jet-confirmation-modal>

            <!-- Remove Team Member Confirmation Modal -->
            <x-confirmation-modal wire:model="confirmingTeamMemberRemoval">
                <x-slot name="title">
                    {{ __('Remove Team Member') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('Are you sure you would like to remove this person from the team?') }}
                </x-slot>

                <x-slot name="footer">
                    <x-secondary-button wire:click="$toggle('confirmingTeamMemberRemoval')" wire:loading.attr="disabled">
                        {{ __('Nevermind') }}
                        </x-jet-secondary-button>

                        <x-danger-button class="ml-2" wire:click="removeTeamMember" wire:loading.attr="disabled">
                            {{ __('Remove') }}
                            </x-jet-danger-button>
                </x-slot>
                </x-jet-confirmation-modal>


@endif



</div>




