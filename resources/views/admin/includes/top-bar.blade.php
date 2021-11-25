<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="{{url('dashboard')}}" class="">Application</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> {!! $header ?? $__env->yieldContent('header') !!}</div>

    <div class="intro-x relative mr-3 sm:mr-6">
          @livewire('admin.includes.search')
    </div>






    <div class="intro-x relative mr-3 sm:mr-6">

        <button class="rounded-md focus:outline-none focus:shadow-outline-purple" @click="toggleTheme" aria-label="Toggle color mode">
            <template x-if="!dark">
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
            </template>
            <template x-if="dark">
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                </svg>
            </template>


        </button>

    </div>
    @if(Auth::check())
    <div class="intro-x dropdown mr-auto sm:mr-6">
        <div class="dropdown-toggle notification @if(count($notifications)>0)notification--bullet @endif cursor-pointer"> <i data-feather="bell" class="notification__icon dark:text-gray-300"></i> </div>
        <div class="notification-content pt-2 dropdown-box">
            <div class="notification-content__box dropdown-box__content box dark:bg-dark-6">
                <div class="notification-content__title">Notifications</div>

             
                @forelse($notifications as $notification)
                <div class="cursor-pointer relative flex items-center mt-5" wire:click="viewNotification('{{$notification->id}}')">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="{{$notification->fromUser->name}}" class="rounded-full" src="{{$notification->fromUser->profile_photo_url}}">
                        @if(is_online($notification->fromUser->id)) 
                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                        @endif
                    
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">{{$notification->name}} </a>
                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">{{$notification->created_at->diffForHumans()}}</div>
                        </div>
                        <div class="w-full truncate text-gray-600">{{$notification->message}}</div>
                    </div>
                </div>
                @empty
                <div class="cursor-pointer relative flex items-center mt-5" >
                   
                    <div class="ml-2 overflow-hidden">
                        
                        <div class="w-full truncate text-gray-600">No New Notification ...</div>
                    </div>
                </div>
                @endforelse
                
                
            </div>
        </div>
    </div>
    <div class="intro-x dropdown w-8 h-8">

        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
        </div>
        <div class="dropdown-box w-56">
            <div class="dropdown-box__content box  bg-gray-900 dark:bg-dark-6 text-white">
                <div class="p-4 border-b  border-gray-600 border-opacity-25  dark:border-dark-3">
                    <div class="font-medium">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-theme-41 dark:text-gray-600">{{Auth::user()->currentTeam->name}}</div>
                </div>
                <div class="p-2">
                    <a href="{{ route('profile.show') }}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-gray-700 dark:hover:bg-dark-3 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                    @if (App\Helpers\MainHelper::hasApiFeatures())
                    <a href="{{ route('api-tokens.index') }}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-gray-700 dark:hover:bg-dark-3 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Api Tokens </a>
                    @endif
                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-gray-700 dark:hover:bg-dark-3 rounded-md"> <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
                </div>



                <div class="p-2 border-t  border-gray-600 border-opacity-25 dark:border-dark-3">
                    @if (App\Helpers\MainHelper::hasTeamFeatures())
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                        <i data-feather="settings" class="w-4 h-4 mr-2"></i> {{ __('Team Settings') }}
                    </x-dropdown-link>

                    @can('create', App\Helpers\MainHelper::newTeamModel())
                    <x-dropdown-link href="{{ route('teams.create') }}">
                        <i data-feather="user-plus" class="w-4 h-4 mr-2"></i> {{ __('Create New Team') }}
                    </x-dropdown-link>
                    @endcan
                </div>
                <div class="p-2 border-t  border-gray-600 border-opacity-25 dark:border-dark-3">

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)

                    <form method="POST" action="{{ route('current-team.update') }}">
                        @method('PUT')
                        @csrf

                        <!-- Hidden Team ID -->
                        <input type="hidden" name="team_id" value="{{ $team->id }}">

                        <x-dropdown-link href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                            <div class="flex items-center">
                                @if (Auth::user()->isCurrentTeam($team))
                                <svg class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                @endif

                                <div class="truncate">{{ $team->name }}</div>
                            </div>
                        </x-dropdown-link>
                    </form>
                    @endforeach


                    @endif
                </div>







                <div class="p-2 border-t  border-gray-600 border-opacity-25 dark:border-dark-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="{{ route('logout') }}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-gray-700 dark:hover:bg-dark-3 rounded-md" onclick="event.preventDefault();
                                                this.closest('form').submit();"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="intro-x dropdown mr-auto sm:mr-6">
        <div class="notification cursor-pointer"><a href="{{url('/')}}"> <i data-feather="home" class="notification__icon dark:text-gray-300"></i> </a></div>

    </div>
    @endif


    <!-- END: Account Menu -->
</div>
