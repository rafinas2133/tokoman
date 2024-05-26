@include('modalCustom.themodal', ['message' => 'Yakin Mau Tambahkan Data?', 'form' => 'addForm'])
<div class="container mx-auto px-4">
    <h1 class="text-2xl dark:text-white text-black font-bold my-4">Add Mitra</h1>
    <form id="addForm" class="dark:text-white text-black" action="{{ route('mitra.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="name" class="block">Name</label>
            <input class="text-black w-full" type="text" name="name" class="w-full px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="address" class="block">Address</label>
            <input class="text-black w-full" type="text" name="address" class="w-full px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="images" class="block">Images</label>
            <input type="file" class="text-black bg-white w-full" accept=".jpg, .jpeg, .png" name="images" id="images"
                class="w-full px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="noTelp" class="block">Telephone</label>
            <input class="text-black w-full" type="text" name="noTelp" class="w-full px-4 py-2" required>
        </div>
        <button type="button" onclick="validasiForm()" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>