<x-guest-layout page="Forgot Password">
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

                                        <h2>Forgot Password</h2>
                                    </div>

                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                                        <x-validation-errors class="mb-4" />
                                        @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Enter Your Email" type="email" name="email" :value="old('email')" required autofocus />
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <button type="submit" class="btn">{{ __('Email Password Reset Link') }}</button>
                                            </div>
                                        </div>
                                    </form>
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
