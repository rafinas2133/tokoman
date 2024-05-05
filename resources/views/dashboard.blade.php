<x-app-layout>
    <div class="flex flex-col h-screen sm:flex-row">
        <div class="w-full sm:w-1/3">
            @include('layouts.navbarLeft') 
        </div>
        <div class="w-full mt-2">
        @include('layouts.homeContent')
        </div>
    </div>
</x-app-layout>

