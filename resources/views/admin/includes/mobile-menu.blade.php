<div>
    <div class="border-gray-600 mobile-menu md:hidden border-opacity-25" style="--border-opacity: 0.2;
    border-color: #718096;
    border-color: rgba(113, 128, 150, var(--border-opacity));">
        <div class="mobile-menu-bar ">
            <a href="{{url('/')}}" class="flex mr-auto" data-turbolinks="false">
                <img alt="{{config('app.name', 'Skylevel')}}" class="w-12 h-12" src="{{asset('img/apple-touch-icon.png')}}">
            </a>
            <a href="javascript:;" :class="{ 'text-gray-200': dark }" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 transform -rotate-90"></i> </a>
        </div>

        <ul class="border-t border-theme-24 border-opacity-25 border-gray-600  py-5 hidden">
            <li>
                <a href="{{url('dashboard')}}" class="menu  @if(request()->routeIs('dashboard')) menu--active @endif">
                    <div class="menu__icon " :class="{ 'text-gray-800': !dark }" :class="{ 'text-gray-200': dark }"> <i data-feather="home"></i> </div>
                    <div class="menu__title " :class="{ 'text-gray-800': !dark }" :class="{ 'text-gray-200': dark }"> Dashboard </div>
                </a>
            </li>

            <li>
                <a href="{{url('users')}}" class="menu  @if(request()->routeIs('users')) menu--active @endif">
                    <div class="menu__icon " :class="{ 'text-gray-800': !dark }" :class="{ 'text-gray-200': dark }"> <i data-feather="users"></i> </div>
                    <div class="menu__title " :class="{ 'text-gray-800': !dark }" :class="{ 'text-gray-200': dark }"> Users</div>
                </a>
            </li>


        </ul>
    </div>






    <!-- BEGIN: Side Menu -->
</div>
