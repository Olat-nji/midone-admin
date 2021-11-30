<x-app-layout>
    <div>
        @section("header")

        <a href="" class="breadcrumb--active"> Profile</a>


        @endsection

        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto"> Profile</h2>
        </div>
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: Profile Menu -->
            <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
                <div class="intro-y box mt-5">
                    <div class="relative flex items-center p-5">
                        <div class="w-12 h-12 image-fit">
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-full">
                        </div>
                        <div class="ml-4 mr-auto">
                            <div class="font-medium text-base">{{ Auth::user()->name }}</div>
                            <div class="text-gray-600">{{Auth::user()->currentTeam->name}}</div>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle w-5 h-5 block" href="javascript:;">
                                <i data-feather="more-horizontal" class="w-5 h-5 text-gray-700 dark:text-gray-300"></i>
                            </a>
                            <div class="dropdown-box w-56">
                                <div class="dropdown-box__content box dark:bg-dark-1">
                                    <div class="p-4 border-b border-gray-200 dark:border-dark-5 font-medium">Export Options</div>
                                    <div class="p-2">
                                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                            <i data-feather="activity" class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"></i> English
                                        </a>
                                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                            <i data-feather="box" class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"></i>
                                            Indonesia
                                            <div class="text-xs text-white px-1 rounded-full bg-theme-6 ml-auto">10</div>
                                        </a>
                                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                            <i data-feather="layout" class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"></i> English
                                        </a>
                                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                            <i data-feather="sidebar" class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"></i> Indonesia
                                        </a>
                                    </div>
                                    <div class="px-3 py-3 border-t border-gray-200 dark:border-dark-5 font-medium flex">
                                        <button type="button" class="button button--sm bg-theme-1 text-white">Settings</button>
                                        <button type="button" class="button button--sm bg-gray-200 text-gray-600 dark:bg-dark-5 dark:text-gray-300 ml-auto">View Profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                        <a class="flex items-center mt-5" href="#profile-information" data-turbolinks="false">
                            <i data-feather="activity" class="w-4 h-4 mr-2"></i> Profile Information
                        </a>

                        <a class="flex items-center mt-5" href="#update-password" data-turbolinks="false">
                            <i data-feather="lock" class="w-4 h-4 mr-2"></i> Update Password
                        </a>
                        <a class="flex items-center mt-5" href="#two-factor-authentication" data-turbolinks="false">
                            <i data-feather="unlock" class="w-4 h-4 mr-2"></i> Two Factor Authentication
                        </a>
                        <a class="flex items-center mt-5" href="#browser-sessions" data-turbolinks="false">
                            <i data-feather="box" class="w-4 h-4 mr-2"></i> Browser Sessions
                        </a>
                        <a class="flex items-center mt-5" href="#delete-account" data-turbolinks="false">
                            <i data-feather="trash" class="w-4 h-4 mr-2"></i> Delete Account
                        </a>
                    </div>

                </div>
            </div>
            <!-- END: Profile Menu -->
            <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
                @livewire('admin.profile.update-profile-information-form')
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('admin.profile.update-password-form')
                </div>
                @endif

                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <x-section-border />

                <div class="mt-10 sm:mt-0" id="two-factor-authentication">
                    @livewire('admin.profile.two-factor-authentication-form')
                </div>
                @endif

                <x-section-border />

                <div class="mt-10 sm:mt-0" id="browser-sessions">
                    @livewire('admin.profile.logout-other-browser-sessions-form')
                </div>

                <x-section-border />

                <div class="mt-10 sm:mt-0" id="delete-account">
                    @livewire('admin.profile.delete-user-form')
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
