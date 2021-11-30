<div>
    <div class="intro-y box mt-5">
        <div class=" px-5 py-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                {{ __('Two Factor Authentication') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Add additional security to your account using two factor authentication.') }}
            </p>

        </div>
        <div class=" py-5" id="announcement">
            <div class="px-5">
                <div class="font-medium text-md">
                    @if ($this->enabled)
                    {{ __('You have enabled two factor authentication.') }}
                    @else
                    {{ __('You have not enabled two factor authentication.') }}
                    @endif
                </div>
                <div class="text-gray-700 dark:text-gray-600 mt-2">{{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}</div>
                <div class="text-gray-700 dark:text-gray-600 mt-2">

                    @if ($this->enabled)
                    @if ($showingQrCode)
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
                        </p>
                    </div>

                    <div class="mt-4">
                        {!! $this->user->twoFactorQrCodeSvg() !!}
                    </div>
                    @endif

                    @if ($showingRecoveryCodes)
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                        @endforeach
                    </div>
                    @endif
                    @endif

                </div>
                <div class="flex items-center mt-5">
                    @if (! $this->enabled)
                    <x-confirms-password wire:then="enableTwoFactorAuthentication">
                        <x-button type="button" wire:loading.attr="disabled">
                            {{ __('Enable') }}
                        </x-button>
                    </x-confirms-password>
                    @else
                    @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-secondary-button class="mr-3">
                            {{ __('Regenerate Recovery Codes') }}
                        </x-secondary-button>
                    </x-confirms-password>
                    @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <x-secondary-button class="mr-3">
                            {{ __('Show Recovery Codes') }}
                        </x-secondary-button>
                    </x-confirms-password>
                    @endif

                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-danger-button wire:loading.attr="disabled">
                            {{ __('Disable') }}
                        </x-danger-button>
                    </x-confirms-password>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
