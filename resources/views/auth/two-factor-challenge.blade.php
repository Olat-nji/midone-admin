<x-guest-layout page="Two Factor Challenge">
    <div class="user-form-area">
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-lg-6 p-0">
                    <div class="user-img">
                        <img src="images/user-form-bg.jpg" alt="User">
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="user-content">
                        <div class="d-table">
                            <div class="d-table-cell">
                                <div class="user-content-inner">
                                    <div class="flex justify-center">
                                        <a href="{{url('/')}}">
                                            <img src="{{asset('img/apple-touch-icon.png')}}">
                                        </a>

                                    </div>
                                    <div class="top flex-col justify-center">

                                        <h2>Two Factor Challenge</h2>
                                    </div>
                                    <div x-data="{ recovery: false }">
                                        <form method="POST" action="/two-factor-challenge">
                                            @csrf
                                            <x-validation-errors class="mb-4" />

                                            <div class="mb-4 text-sm text-gray-600" x-show="! recovery">
                                                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                                            </div>

                                            <div class="mb-4 text-sm text-gray-600" x-show="recovery">
                                                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                                            </div>
                                            <div class="row">

                                                <div class="col-lg-12" x-show="! recovery">
                                                    <div class="form-group">
                                                        <input class="form-control" Placeholder="{{ __('Code') }}" type="text" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12" x-show="recovery">
                                                    <div class="form-group">
                                                        <input class="form-control" placeholder="{{ __('Recovery Code') }}" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                                                    </div>
                                                </div>


                                                <div class="col-lg-12">
                                                    <div class="flex items-center justify-end mt-4">
                                                        <button type="button" class="btn" x-show="! recovery" x-on:click="recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })">
                                                            {{ __('Use a recovery code') }}
                                                        </button>
                                                        <button type="button" class="btn ml-2" x-show="recovery" x-on:click="recovery = false;
                                        $nextTick(() => { $refs.code.focus() })">
                                                            {{ __('Use an authentication code') }}
                                                        </button>
                                                        <button type="submit" class="btn ml-4">{{ __('Login') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    @include('auth.includes.bottom')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
