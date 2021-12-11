<x-guest-layout page="Login">
    <div class="user-form-area">
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-lg-6 p-0">
                    <div class="user-img">
                        <img src="{{asset('images/user-form-bg.jpg')}}" alt="User">
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

                                        <h2>Sign In</h2>
                                    </div>

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <x-validation-errors class="mb-4" />
                                        @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Enter your email" type="email" name="email" :value="old('email')" required autofocus />
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Enter your password" type="password" name="password" required autocomplete="current-password" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2 flex justify-between">
                                                <label class="flex items-center">
                                                    <input type="checkbox" class="form-checkbox form-control" name="remember">
                                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                                </label>
                                                @if (Route::has('password.request'))
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                                    {{ __('Forgot your password?') }}
                                                </a>
                                                @endif
                                            </div>
                                            <div class="col-lg-12">
                                                <button type="submit" class="btn">Sign In</button>
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
