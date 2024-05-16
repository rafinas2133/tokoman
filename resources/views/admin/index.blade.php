<x-app-layout>
    <div class="flex flex-col h-full sm:flex-row dark:bg-gray-800">
        <div class="w-full sm:w-64 dark:bg-gray-800">
            @include('layouts.navbarLeft')
        </div>
        <div class="w-full h-full overflow-auto px-4 dark:bg-gray-800">
            @include('layouts.adminIndex')
        </div>
    </div>
</x-app-layout>