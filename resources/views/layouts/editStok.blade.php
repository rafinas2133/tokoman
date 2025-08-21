<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="/stok"
                    class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded mb-3 inline-block">Kembali</a>

                <form action="{{url('/stok/editsave/' . $brg->id_barang)}}" method="post" id="formEdit"
                    class="needs-validation" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-bold mb-2">Nama Barang:</label>
                        <input type="text" id="nama" name="nama" value="{{$brg->nama_barang}}" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="stok" class="block text-sm font-bold mb-2">Stok:</label>
                        <input type="number" id="stok" name="stok" required value="{{$brg->stok}}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="bal" class="block text-sm font-bold mb-2">Isi Per Bal:</label>
                        <input type="number" id="bal" name="bal" required value="{{$brg->bal}}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label for="jenis" class="block text-sm font-bold mb-2">Jenis Tutup:</label>
                        <select id="jenis" name="jenis" required value="{{$brg->jenis_tutup}}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="tinggi" {{ $brg->jenis_tutup == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                            <option value="rendah" {{ $brg->jenis_tutup == 'rendah' ? 'selected' : '' }}>Rendah</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="ukuran" class="block text-sm font-bold mb-2">Ukuran:</label>
                        <input type="text" id="ukuran" name="ukuran" required value="{{$brg->ukuran}}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="buy" class="block text-sm font-bold mb-2">Harga Beli:</label>
                        <input type="text" id="buy" name="buy" required value="{{$brg->harga_beli}}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="sell" class="block text-sm font-bold mb-2">Harga Jual:</label>
                        <input type="text" id="sell" name="sell" required value="{{$brg->harga_jual}}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4 flex gap-2">
                        <label for="ukuran" class="block text-sm font-bold mb-2">Gambar 1: *maks 6MB</label>
                        <input type="file" accept=".jpg, .jpeg, .png" id="imageInput1" name="gambar1"
                            class="h-[50px] shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <img id="imagePreview1" class="w-[100px] h-[100px]" src="{{$brg->pathImg1 ?: '#'}}" alt="Image Preview" style="{{ $brg->pathImg1 ? '' : 'display: none;' }}">
                    </div>
                    <div class="mb-4 flex gap-2">
                        <label for="ukuran" class="block text-sm font-bold mb-2">Gambar 2: *maks 6MB</label>
                        <input type="file" accept=".jpg, .jpeg, .png" id="imageInput2" name="gambar2"
                            class=" h-[50px] shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <img id="imagePreview2" class="w-[100px] h-[100px]" src="{{ $brg->pathImg2 ?: '#' }}" alt="Image Preview" style="{{ $brg->pathImg2 ? '' : 'display: none;' }}">
                    </div>
                    <div class="flex gap-4">
                        <button type="button" onclick ="validasiForm()"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 h-fit rounded">Simpan
                            Data</button>
                </form>
                @if($brg->pathImg2 != '')
                        <form action="/deleteImg/{{$brg->id_barang}}" method="POST" id="deleteForm{{$brg->id}}">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="validasiForm{{$brg->id}}()"
                                class="bg-blue-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mb-3 inline-block h-fit">Hapus
                                Gambar 2</button>
                        </form>
                    </div>
                    @include('modalCustom.themodal', ['message' => 'Yakin Mau Hapus Gambar 2?', 'form' => 'deleteForm'.$brg->id,'theVal'=>$brg->id])
                @endif
        </div>
    </div>
</div>
</div>
</div>
@include('modalCustom.themodal', ['message' => 'Yakin Mau Edit Data?', 'form' => 'formEdit'])
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
                imagePreview1.style.display = 'block';
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
                imagePreview2.style.display = 'block';
            }

            reader.readAsDataURL(file);
        }
    });
</script>