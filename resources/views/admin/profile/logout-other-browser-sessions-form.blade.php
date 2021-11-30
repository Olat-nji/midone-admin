<div>
    <div class="intro-y box mt-5">
        <div class=" px-5 py-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                {{ __('Browser Sessions') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Manage and logout your active sessions on other browsers and devices.') }}
            </p>

        </div>
        <div class=" py-5" id="announcement">
            <div class="px-5">

                <div class="text-gray-700 dark:text-gray-600 mt-2">{{ __('If necessary, you may logout of all of your other browser sessions across all of your devices. If you feel your account has been compromised, you should also update your password.') }}</div>
                <div class="text-gray-700 dark:text-gray-600 mt-2">

                    @if (count($this->sessions) > 0)
                    <div class="mt-5 space-y-6">
                        <!-- Other Browser Sessions -->
                        @foreach ($this->sessions as $session)
                        <div class="flex items-center">
                            <div>
                                @if ($session->agent->isDesktop())
                                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                    <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-gray-500">
                                    <path d="M0 0h24v24H0z" stroke="none"></path>
                                    <rect x="7" y="4" width="10" height="16" rx="1"></rect>
                                    <path d="M11 5h2M12 17v.01"></path>
                                </svg>
                                @endif
                            </div>

                            <div class="ml-3">
                                <div class="text-sm text-gray-600">
                                    {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
                                </div>

                                <div>
                                    <div class="text-xs text-gray-500">
                                        {{ $session->ip_address }},

                                        @if ($session->is_current_device)
                                        <span class="text-green-500 font-semibold">{{ __('This device') }}</span>
                                        @else
                                        {{ __('Last active') }} {{ $session->last_active }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                </div>
                <div class="flex items-center mt-5">
                    <x-button wire:click="confirmLogout" wire:loading.attr="disabled">
                        {{ __('Logout Other Browser Sessions') }}
                    </x-button>


                    <div x-data="{ shown: false, timeout: null }" x-init="@this.on('loggedOut', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000);  })" x-show.transition.opacity.out.duration.1500ms="shown" style="display: none;" class='text-sm text-gray-600'>
                        {{ 'Saved.' }}
                    </div>
                    <x-dialog-modal wire:model="confirmingLogout">
                        <x-slot name="title">
                            {{ __('Logout Other Browser Sessions') }}
                        </x-slot>

                        <x-slot name="content">
                            {{ __('Please enter your password to confirm you would like to logout of your other browser sessions across all of your devices.') }}

                            <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                                <x-input type="password" class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" x-ref="password" wire:model.defer="password" wire:keydown.enter="logoutOtherBrowserSessions" />

                                <x-input-error for="password" class="mt-2" />
                            </div>
                        </x-slot>

                        <x-slot name="footer">
                            <x-secondary-button wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                                {{ __('Nevermind') }}
                            </x-secondary-button>

                            <x-button class="ml-2" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                                {{ __('Logout Other Browser Sessions') }}
                            </x-button>
                        </x-slot>
                    </x-dialog-modal>
                </div>
            </div>

        </div>
    </div>

</div>
