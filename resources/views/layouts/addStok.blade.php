<div class="py-12 ">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="/stok"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-3 inline-block">Kembali</a>

                <form id="addForm" action="{{url('/stok/addsave')}}" method="post" class="needs-validation"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-bold mb-2">Nama Barang:</label>
                        <input type="text" id="nama" name="nama" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="stok" class="block text-sm font-bold mb-2">Stok:</label>
                        <input type="number" id="stok" name="stok" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="bal" class="block text-sm font-bold mb-2">Isi Per Bal:</label>
                        <input type="number" id="bal" name="bal" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="jenis" class="block text-sm font-bold mb-2">Jenis Tutup:</label>
                        <select id="jenis" name="jenis" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="tinggi">Tinggi</option>
                            <option value="rendah">Rendah</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="ukuran" class="block text-sm font-bold mb-2">Ukuran:</label>
                        <input type="text" id="ukuran" name="ukuran" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="buy" class="block text-sm font-bold mb-2">Harga Beli:</label>
                        <input type="text" id="buy" name="buy" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="sell" class="block text-sm font-bold mb-2">Harga Jual:</label>
                        <input type="text" id="sell" name="sell" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="ukuran" class="block text-sm font-bold mb-2">Gambar 1: *wajib maks 2MB</label>
                        <input type="file" accept=".jpg, .jpeg, .png" id="imageInput1" name="gambar1" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <img id="imagePreview1" class="w-[100px] h-[100px]" src="#" alt="" class="hidden">
                    </div>
                    <div class="mb-4">
                        <label for="ukuran" class="block text-sm font-bold mb-2">Gambar 2: *maks 2MB</label>
                        <input type="file" accept=".jpg, .jpeg, .png" id="imageInput2" name="gambar2"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <img id="imagePreview2" class="w-[100px] h-[100px]" src="#" alt="" class="hidden">
                    </div>
                    <button type="button" onclick="validasiForm()"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Simpan
                        Data</button>
                </form>


            </div>
        </div>
    </div>
</div>
@include('modalCustom.themodal', ['message' => 'Yakin Mau Tambahkan Data?', 'form' => 'addForm'])
<script>
    const imageInput1 = document.getElementById('imageInput1');
    const imagePreview1 = document.getElementById('imagePreview1');
    const imageInput2 = document.getElementById('imageInput2');
    const imagePreview2 = document.getElementById('imagePreview2');

    imageInput1.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview1.src = e.target.result;
                imagePreview1.classList.remove('hidden');
            }

            reader.readAsDataURL(file);
        }
    });

    imageInput2.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview2.src = e.target.result;
                imagePreview2.classList.remove('hidden');
            }

            reader.readAsDataURL(file);
        }
    });
</script>