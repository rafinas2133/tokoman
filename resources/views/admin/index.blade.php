<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Pegawai') }}
        </h2>
    </x-slot>

    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="openAdminModal()">Ganti Admin Token</button>
                    <!-- Modal -->
                    <div id="adminModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" style="display:none;">
                      <!-- Modal content -->
                      <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <form method="POST" action="{{ route('change.token') }}" onsubmit="closeModal()">
                          @csrf
                          <div class="mt-3 text-center">
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                              <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                              </svg>
                            </div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Ganti Token</h3>
                            <div class="mt-2 px-7 py-3">
                              <input type="password" id="token" name="token" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Masukkan Token" required>
                            </div>
                            <div class="mt-2 px-7 py-3">
                              <input type="password" id="token2" name="token2" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Masukkan Ulang Token" required>
                            </div>
                            <div class="items-center px-4 py-3">
                              <button type="button" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-auto shadow-sm hover:bg-gray-400" onclick="closeModal()">Close</button>
                              <button type="submit" class="ml-3 px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-auto shadow-sm hover:bg-blue-400 ">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>

                    <script>
                    function openAdminModal() {
                        document.getElementById('adminModal').style.display = 'block';
                        document.getElementById('token').value='';  
                    }

                    function closeModal() {
                        document.getElementById('adminModal').style.display = 'none';
                    }
                    </script>
        <a href="{{ route('admin.forgot.token') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block">Kembali</a>
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
