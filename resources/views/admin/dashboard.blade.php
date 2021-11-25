<div>
    @section("header")

    <a href="" class="breadcrumb--active"> {{ __('Dashboard') }} </a>

    @endsection

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
                                    <div class="text-3xl font-bold leading-8 mt-6">0</div>
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





    @push('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            @this.on('triggerDelete', id => {
                Swal.fire({
                    title: 'Are You Sure?'
                    , text: 'This record will be deleted!'
                    , icon: "warning"
                    , showCancelButton: true
                    , confirmButtonColor: '#3085d6'
                    , cancelButtonColor: '#aaa'
                    , confirmButtonText: 'Delete!'
                }).then((result) => {
                    //if user clicks on delete
                    if (result.value) {
                        // calling destroy method to delete
                        @this.call('delete', id)
                        // success response
                        Swal.fire({
                            title: 'Record deleted successfully!'
                            , icon: 'success'
                        });
                    } else {
                        Swal.fire({
                            title: 'Operation Cancelled!'
                            , icon: 'success'
                        });
                    }
                });
            });
        })

    </script>
    @endpush


</div>
