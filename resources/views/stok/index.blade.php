<x-app-layout>
    @if($error == 'true')
    <div class="error hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
    <strong class="font-bold">Error!</strong>
    <span class="block sm:inline">{{$error}}</span>
    </div>
    <script>
        var error = document.querySelector('.error');
        error.classList.remove('hidden');
        setTimeout(() => {
        error.classList.add('hidden');
        }, 3000);
    </script>
    @else 
    @endif
    <div class="flex flex-col h-full sm:flex-row dark:bg-gray-800">
        <div class="w-full sm:w-64 dark:bg-gray-800">
        @include('layouts.navbarLeft')
        </div>
        <div class="w-full px-4 overflow-x-clip gap-4 dark:bg-gray-800">
        @include('layouts.indexStok')
        </div>
    </div>
    
</x-app-layout>
