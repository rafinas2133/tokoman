@include('modalCustom.themodal', ['message' => 'Yakin Mau Edit Data?', 'form' => 'formEdit'])
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold my-4 dark:text-white text-black">Edit mitra</h1>
    <form id="formEdit" action="{{ route('mitra.update', $mitra->id) }}" method="POST" class="dark:text-white text-black"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-4">
            <label for="name" class="block">Name</label>
            <input type="text" name="name" value="{{ $mitra->name }}" class="w-full px-4 py-2 text-black" required>
        </div>
        <div class="mb-4">
            <label for="address" class="block">Address</label>
            <input type="text" name="address" value="{{ $mitra->address }}" class="w-full px-4 py-2 text-black"
                required>
        </div>
        <div class="mb-4">
            <label for="images" class="block">Images</label>
            <input type="file" accept=".jpg, .jpeg, .png" name="images" class="w-full px-4 py-2 text-black">
        </div>
        <div class="mb-4">
            <label for="telephone" class="block">Telephone</label>
            <input type="text" name="noTelp" value="{{ $mitra->noTelp }}" class="w-full px-4 py-2 text-black" required>
        </div>
        <button type="button" onclick="validasiForm()" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>