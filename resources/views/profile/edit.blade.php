<x-app-layout>
<div class="flex flex-col h-full sm:flex-row dark:bg-black">
        <div class="w-full sm:w-64 dark:bg-black">
        @include('layouts.navbarLeft')
        </div>
        <div class="w-full px-4 overflow-x-clip gap-4 dark:bg-black">
        @include('layouts.profile')
        </div>
</div>
</x-app-layout>
