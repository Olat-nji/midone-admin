<x-guest-layout page="Register">
    <div class="user-form-area">
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-lg-6 p-0">
                    <div class="user-img">
                        <img src="public/images/user-form-bg.jpg" alt="User">
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="user-content">
                        <div class="d-table">
                            <div class="d-table-cell">
                                <div class="user-content-inner">
                                    <div class="flex justify-center">
                                        <a href="{{url('/')}}">
                                            <img src="{{asset('public/img/apple-touch-icon.png')}}">
                                        </a>

                                    </div>
                                    <div class="top flex-col justify-center">

                                        <h2>Sign In</h2>
                                    </div>

                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <x-validation-errors class="mb-4" />
                                      
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Enter your Name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Enter your email" type="email" name="email" :value="old('email')" required />
                                                </div>
                                            </div>
                                              <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Enter your Phone Number" type="phone" name="phone" :value="old('phone')" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Enter your password" type="password" name="password" required autocomplete="new-password" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Confirm your password" type="password" name="password_confirmation" required autocomplete="new-password" />
                                                </div>
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
