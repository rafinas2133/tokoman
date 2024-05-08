<x-app-layout>
<div class="flex flex-col h-full sm:flex-row dark:bg-black">
        <div class="w-full sm:w-64 dark:bg-gray-800 ">
        @include('layouts.navbarLeft')
        </div>
        <div class="w-full px-4 overflow-x-clip gap-4 dark:black">
        @include('layouts.profile')
        </div>
</div>
</x-app-layout>
