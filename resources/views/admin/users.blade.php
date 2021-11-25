<div>


    @section("header")

    <a href="" class="breadcrumb--active"> {{ __('Users') }}</a>

    @endsection

    @if(is_admin())
    <h2 class="intro-y text-lg font-medium mt-10">
        Users
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">


            <div class="hidden md:block mx-auto text-gray-600">{{$users->links('admin.components/showing')}}</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..." wire:model="q">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        @if(count($users)==0)
        <div class="col-span-12 text-center pt-5" wire:loading.remove>
            No Results Found ...
        </div>
        @endif

        {{-- Loading Icon --}}
        <div class="col-span-12 text-center flex justify-center " wire:loading.class="p-10">
            <div wire:loading>
                <i data-loading-icon="three-dots" class=" w-8 h-8"></i>
            </div>
        </div>

        @foreach($users as $key=>$user)
        <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
            <div class="box">
                <div class="flex items-start px-5 pt-5">
                    <div class="w-full flex flex-col lg:flex-row items-center">
                        <div class="w-16 h-16 image-fit">
                            <img alt="{{$user->name}}" class="rounded-full" src="{{$user->profile_photo_url}}">
                        </div>
                        <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                            <a href="" class="font-medium">{{$user->name}}</a>
                            <div class="text-gray-600 text-xs">Created {{$user->created_at->diffForHumans()}}</div>
                        </div>
                    </div>
                    <div class="absolute right-0 top-0 dropdown">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-horizontal" class="w-5 h-5 text-gray-700 dark:text-gray-300"></i> </a>
                        <div class="dropdown-box w-40">
                            <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="edit-2" class="w-4 h-4 mr-2"></i> Edit </a>
                                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="trash" class="w-4 h-4 mr-2"></i> Delete </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center lg:text-left p-5">
                    <div> Teams : @foreach($user->allTeams() as $key => $value)
                        <a href="{{url('teams/'.$value->id)}}" class="text-theme-3">{{$value->name}}</a>
                        @if($value->id!=$user->allTeams()->last()->id)
                        ,
                        @endif
                        @endforeach</div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-5"> <i data-feather="mail" class="w-3 h-3 mr-2"></i>{{$user->email}}</div>
                    @if($user->phone!=null)<div class="flex items-center justify-center lg:justify-start text-gray-600 mt-5"> <i data-feather="phone" class="w-3 h-3 mr-2"></i>{{$user->phone}}</div>@endif

                </div>
                <div class="text-center lg:text-right p-5 border-t border-gray-200 dark:border-dark-5">
                    <a href="{{url('chat?user='.$user->id)}}" class="button button--sm text-white bg-theme-1 mr-2">Message</a>
                    <a href="{{url('projects?user='.$user->id)}}" class="button button--sm text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300">Projects</a>
                </div>
            </div>
        </div>
        @endforeach

        <!-- END: Users Layout -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
            {{$users->links('admin.components.pagination')}}

            <select class="w-20 input box mt-3 sm:mt-0" wire:model="pages">
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>
    @else
    <x-live-chat />
    @endif




    

</div>
