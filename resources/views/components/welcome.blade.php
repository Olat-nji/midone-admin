<div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        General Report
                    </h2>
                    <a class="ml-auto flex text-theme-1 dark:text-theme-10 cursor-pointer" wire:click="$refresh" wire:ignore> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> <span wire:loading.remove>Reload Data</span> <span wire:loading> Reloading Data ...</span></a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex" wire:ignore>
                                    <i data-feather="users" class="report-box__icon text-theme-10"></i>
                                    {{-- <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="33% Higher than last month"> 33% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                    </div> --}}
                                </div>
                                <div class=" mt-6"><span class="text-3xl font-bold leading-8"> {{$usersCount}}</span> <span class="text-2lg font-bold leading-8"> +{{ $adminUsersCount }}</span></div>

                                <div class="text-base text-gray-600 mt-1">Total Users</div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex" wire:ignore>
                                    <i data-feather="monitor" class="report-box__icon text-theme-12"></i>
                                    {{-- <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="12% Higher than last month"> 12% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                    </div> --}}
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{$allProjects->get()->count()}}</div>
                                <div class="text-base text-gray-600 mt-1">Total Projects</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex" wire:ignore>
                                    <i data-feather="user" class="report-box__icon text-theme-9"></i>
                                    {{-- <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="22% Higher than last month"> 22% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                    </div> --}}
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">152</div>
                                <div class="text-base text-gray-600 mt-1">Unique Visitors</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- END: General Report -->
            <!-- BEGIN: Weekly Top Products -->
            @if(count($projects)>0)
            <div class="col-span-12 mt-6">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Projects
                </h2>
                
            </div>
            <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                <table class="table table-report sm:mt-2">
                    <thead>
                        <tr>

                            <th class="whitespace-no-wrap">NAME</th>
                            <th class="whitespace-no-wrap">PRICE</th>
                            <th class="text-center whitespace-no-wrap">APPROVED</th>
                            <th class="text-center whitespace-no-wrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $key => $project)
                        <tr class="intro-x">

                            <td>
                                <a href="" class="font-medium whitespace-no-wrap">{{$project->name}}</a>
                                <div class="text-gray-600 text-xs whitespace-no-wrap">{{$project->user()->get()->first()->name}}</div>
                            </td>
                            <td>
                                <a href="" class="font-medium whitespace-no-wrap">₦{{number_format($project->price)}}</a>
                                <div class="text-gray-600 text-xs whitespace-no-wrap">{{$project->created_at->diffForHumans()}}</div>
                            </td>

                           <td class="w-40" wire:ignore>
                            @if ($project->approved)<div class="flex items-center justify-center text-theme-9" wire:ignore> <i data-feather="check-square" class="w-4 h-4 mr-2"></i> Approved </div>
                            @if($project->sold)
                            <div class="flex items-center justify-center">-- Sold</div>
                            @else
                            <div class="flex items-center justify-center">-- OnSale</div>
                            @endif
                            @else
                            <div class="flex items-center justify-center text-theme-6" wire:ignore> <i data-feather="check-square" class="w-4 h-4 mr-2"></i> Pending </div>
                            @endif

                        </td>
                            <td class="table-report__action w-56" wire:ignore>
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="{{url("projects/".$project->id.'/edit')}}" wire:ignore> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                <button class="flex items-center text-theme-6" wire:click="$emit('triggerDelete',{{ $project->id }})"  wire:ignore> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </button>
                            </div>
                        </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <div class="intro-y flex flex-wrap sm:flex-row sm:flex-no-wrap items-center mt-3">
                {{$projects->links('admin.components.pagination')}}

                <select class="w-20 input box mt-3 sm:mt-0">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
        </div>
            @endif
            <!-- END: Weekly Top Products -->
        </div>
    </div>

    <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
        <div class="xxl:pl-6 grid grid-cols-12 gap-6">
            <!-- BEGIN: Transactions -->
            

            <div class="col-span-12 md:col-span-6 xl:col-span-6 xxl:col-span-12 mt-3">
                <div class="intro-x flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Recent Activities
                    </h2>
                    <a href="" class="ml-auto text-theme-1 dark:text-theme-10 truncate">See all</a>
                </div>
                <div class="report-timeline mt-5 relative">
                    @foreach($users as $key => $user)
                    <div class="intro-x relative flex items-center mb-3">
                        <div class="report-timeline__image">
                            <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                <img alt="{{$user->name}}" src="{{$user->profile_photo_url}}">
                            </div>
                        </div>
                        <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                            <div class="flex items-center">
                                <div class="font-medium">{{$user->name}}</div>
                                <div class="text-xs text-gray-500 ml-auto">{{$user->created_at->diffForHumans()}}</div>
                            </div>
                            <div class="text-gray-600 mt-1"> Created an Account</div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <!-- END: Recent Activities -->
            <!-- BEGIN: Important Notes -->
            @if(count($messages)>0)
            <div class="col-span-12 md:col-span-6 xl:col-span-12 xxl:col-span-12 xl:col-start-1 xl:row-start-1 xxl:col-start-auto xxl:row-start-auto mt-3">
                <div class="intro-x flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-auto">
                        Enquiry Messages
                    </h2>
                    <button data-projectousel="important-notes" data-target="prev" class="tiny-slider-navigator button px-2 border border-gray-400 dark:border-dark-5 flex items-center text-gray-700 dark:text-gray-600 mr-2" wire:ignore> <i data-feather="chevron-left" class="w-4 h-4"></i> </button>
                    <button data-projectousel="important-notes" data-target="next" class="tiny-slider-navigator button px-2 border border-gray-400 dark:border-dark-5 flex items-center text-gray-700 dark:text-gray-600" wire:ignore> <i data-feather="chevron-right" class="w-4 h-4"></i> </button>
                </div>
                <div class="mt-5 intro-x">
                    <div class="box zoom-in">
                        <div class="tiny-slider" id="important-notes">
                            @foreach($messages as $key => $message)
                            <div class="p-5">
                                <div class="text-base font-medium truncate">{{$message->subject}} From {{$message->email}}</div>
                                <div class="text-gray-500 mt-1">{{$message->created_at->diffForHumans()}}</div>
                                <div class="text-gray-600 text-justify mt-1">{{Illuminate\Support\Str::words($message->message,10,' ...')}}</div>
                                <div class="font-medium flex mt-5">
                                    <button type="button" class="button button--sm bg-gray-200 dark:bg-dark-5 text-gray-600 dark:text-gray-300">View Message</button>
                                    <button type="button" class="button button--sm border border-gray-300 dark:border-dark-5 text-gray-600 ml-auto">Dismiss</button>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- END: Important Notes -->
            <!-- BEGIN: Schedules -->

            <!-- END: Schedules -->
        </div>
    </div>
</div>
