@include('modalCustom.themodal', ['message' => 'Yakin Mau Edit Data?', 'form' => 'formEdit'])
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold my-4 dark:text-white text-black">Edit agen {{$agents->name}}</h1>
    <form id="formEdit" action="{{ route('agents.update', $agents->id) }}" method="POST" class="dark:text-white text-black" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-4">
            <label for="name" class="block">Nama</label>
            <input type="text" name="name" value="{{ $agents->name }}" class="w-full px-4 py-2 text-black" required>
        </div>
        <div class="mb-4">
            <label for="address" class="block">Alamat</label>
            <input type="text" name="address" value="{{ $agents->address }}" class="w-full px-4 py-2 text-black" required>
        </div>
        <div class="mb-4">
            <label for="gmaps" class="block">Link Gmaps</label>
            <input type="text" name="gmaps" value="{{ $agents->gmaps }}" class="w-full px-4 py-2 text-black" required>
        </div>
        <div class="mb-4">
            <label for="images" class="block">Gambar (Maks 6 MB)</label>
            <input id="imageInput" type="file" accept=".jpg, .jpeg, .png" name="images" class="w-full px-4 py-2 text-black bg-white mb-2">
            <img id="imagePreview" class="w-[100px] h-[100px]" src="{{config("app.aws_url")}}/agents/{{$agents->images}}" alt="">
        </div>
        <div class="mb-4">
            <label for="telephone" class="block">Telepon</label>
            <input type="text" name="noTelp" value="{{ $agents->noTelp }}" class="w-full px-4 py-2 text-black" required>
        </div>
        <button type="button" onclick="validasiForm()" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
<script>
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            }

            reader.readAsDataURL(file);
        }
    });
</script>