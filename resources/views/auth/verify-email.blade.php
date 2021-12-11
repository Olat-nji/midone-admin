<x-guest-layout page="Verify Your Email">
    <div class="user-form-area">
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-lg-6 p-0">
                    <div class="user-img">
                        <img src="{{asset('images/user-form-bg.jpg')}}">
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="user-content">
                        <div class="d-table">
                            <div class="d-table-cell">
                                <div class="user-content-inner">
                                    <div class="flex justify-center">
                                        <a href="{{url('/')}}">
                                            <img src="{{asset('logo/apple-touch-icon.png')}}">
                                        </a>

                                    </div>
                                    <div class="top flex-col justify-center">

                                        <h2>Verify Your Email</h2>
                                    </div>
                                    <div class="mb-4 text-sm text-gray-600">
                                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                                    </div>

                                    @if (session('status') == 'verification-link-sent')
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                    </div>
                                    @endif
                                    <div class="mt-4 flex items-center justify-between">
                                        <form method="POST" action="{{ route('verification.send') }}">
                                            @csrf


                                            <div class="row">

                                                <div class="col-lg-12">
                                                    <button type="submit" class="btn">{{ __('Resend Verification Email') }}</button>
                                                </div>
                                            </div>
                                        </form>

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <div class="row">

                                                <div class="col-lg-12">

                                                    <button type="submit" class="btn">
                                                        {{ __('Logout') }}
                                                    </button>
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
