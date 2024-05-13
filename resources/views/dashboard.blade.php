<x-app-layout>
    <div class="flex flex-col h-full sm:flex-row dark:bg-gray-800">
        <div class=" w-full sm:w-64 dark:bg-gray-800">
            @include('layouts.navbarLeft') 
        </div>
        <aside class="overflow-auto w-full px-4 py-2 dark:bg-gray-800">
            @include('layouts.homeContent')
        </aside>
    </div>
</x-app-layout>