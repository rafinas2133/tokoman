<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="/admin" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-3 inline-block">Kembali</a>
    
 <form action="/admin/editsave" method="post" class="text-white">
    @csrf
    <p class="text-red-500 text-xs italic">Kosongkan jika tidak ingin mengedit.</p>
    <div class="mb-4">
        <label for="id" class="block text-white text-sm font-bold mb-2">ID:</label>
        <input type="text" id="id" name="id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly value="{{$user->id}}">
    </div>
    <div class="mb-4">
        <label for="nama" class="block text-white text-sm font-bold mb-2">Nama:</label>
        <input type="text" id="nama" name="nama" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{$user->name}}" required>
    </div>
    <div class="mb-4">
    <label for="email" class="block text-sm font-bold mb-2">Email:</label>
    <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{$user->email}}" required>
    </div>

    <div class="mb-4">
    <label for="password" class="block text-sm font-bold mb-2">Password:</label>
    <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="mb-4">
        <label for="password_confirmation" class="block text-sm font-bold mb-2">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Simpan Data</button>
    </form>
 
      
                </div>
            </div>
        </div>
    </div>            <
</x-app-layout>
