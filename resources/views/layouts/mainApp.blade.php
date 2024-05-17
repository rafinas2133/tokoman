<x-app-layout>
    <div class="flex flex-col min-h-screen h-full sm:flex-row dark:bg-gray-800">
        <div class=" w-full sm:w-64 dark:bg-gray-800 bg-slate-300">
            @include('layouts.navbarLeft') 
        </div>
        <aside class="overflow-auto w-full max-sm:min-h-screen px-4 py-2 dark:bg-gray-800 bg-slate-300">
            {{ $slot }}
        </aside>
    </div>
</x-app-layout>