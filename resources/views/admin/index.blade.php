<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Pegawai') }}
        </h2>
    </x-slot>

    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
       
        <a href="/dashboard" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block">Kembali</a>
    </div>
    <div class="p-6 text-gray-900 dark:text-gray-100 text-center mx-auto">
        <a href="/admin/add" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block"> + Tambah data pegawai</a>
        <a href="/admin/deleteAll" class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block"> - Hapus semua data pegawai</a>
    </div>
    @if($users->isEmpty())
        <div class="text-center text-info">
            <p>Belum ada data</p>
        </div>
    @else
        <div class="overflow-auto">
            <table class="table-auto border-collapse border mx-auto w-fit">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Password</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Dibuat pada</th>
                        <th class="px-4 py-2">Diupdate pada</th>
                        <th class="px-4 py-2">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $usr)
                    <tr class="bg-gray-100">
                        <td class="border px-4 py-2">{{ $usr->email }}</td>
                        <td class="border px-4 py-2">{{ $usr->password }}</td>
                        <td class="border px-4 py-2">{{ $usr->name }}</td>
                        <td class="border px-4 py-2">{{ $usr->created_at }}</td>
                        <td class="border px-4 py-2">{{ $usr->updated_at }}</td>
                        <td class="border px-4 py-2">
                            <a href="/admin/edit/{{ $usr->id }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                            <a href="/admin/delete/{{ $usr->id }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded ml-2">Hapus</a>
                        </td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <!-- Pagination Links -->
    <div class="text-center mt-4, bg-blue-700, text-white">
        {{ $users->links('vendor.pagination.tailwind') }}
    </div>
</x-app-layout>
