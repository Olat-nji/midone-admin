<x-app-layout>
    @section("header")
        
       <a href="" class="breadcrumb--active"> Teams</a>
       <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="" class="breadcrumb--active">Create</a>
        
    @endsection

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('admin.teams.create-team-form')
        </div>
    </div>
</x-app-layout>
