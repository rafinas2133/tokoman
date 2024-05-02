@if ($barang -> stok > 0)
<?php $pathimage='https://tokoman.s3.ap-southeast-2.amazonaws.com/asset/pngwing.com.png'?>
<div class="mx-auto w-[380px] rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-500 bg-gray-100 dark:bg-gray-700 mb-10">
    @if($barang->pathImg1=='')
    <img class="mx-auto w-[300px] h-[300px] rounded-lg" src="https://placeholder.pics/svg/300" alt="Gambar {{ $barang->nama_barang }}">
    @else
    @if($barang->pathImg2=='')
    <img class="mx-auto w-[300px] h-[300px] rounded-lg" src="{{$barang->pathImg1}}" alt="Gambar {{ $barang->nama_barang }}">
    @else
    <div class="mx-auto w-[300px] h-[300px] rounded-lg">
    <!-- Slides -->
    <div class="flex gap-2">
    <?php echo"<button id='$barang->id' class='w-[30px] h-[30px] my-auto' onclick='showNextImage$barang->id()'><img src='https://tokoman.s3.ap-southeast-2.amazonaws.com/asset/pngwing.com+(3).png'></button>";?>
    <div class="{{$barang->nama_barang}} transition-opacity duration-1000 ease-in-out">
        <img src="{{$barang->pathImg1}}" class="w-[250px] mx-auto h-[250px]">
    </div>

    <div class="{{$barang->nama_barang}}2 hidden transition-opacity duration-1000 ease-in-out">
        <img src="{{$barang->pathImg2}}" class="w-[250px] mx-auto h-[250px]">
    </div>
    
   <?php echo"<button id='$barang->id' class='w-[30px] h-[30px] my-auto' onclick='showNextImage$barang->id()'><img src='https://tokoman.s3.ap-southeast-2.amazonaws.com/asset/pngwing.com+(2).png'></button>";?>
    </div>
    
    
    <?php 
    
$idimage2= $barang->nama_barang.'2';
$nama_barang=$barang->nama_barang;
$idelements1=$nama_barang.'img1';
$idelements2=$nama_barang.'img2';
echo "<script>
    let $barang->nama_barang=0;
    let $idelements1 = document.getElementsByClassName('$barang->nama_barang');
    let $idelements2 = document.getElementsByClassName('$idimage2');
    function showNextImage$barang->id() {
            for (let i = 0; i < $idelements1.length; i++) {
            if ($barang->nama_barang==0||$barang->nama_barang%2==0) {
                $idelements1"."[i].classList.add('transition-opacity', 'opacity-0');
                $idelements2"."[i].classList.remove('transition-opacity', 'opacity-0');
                setTimeout(() => {
                    $idelements1"."[i].classList.add('hidden');
                    $idelements2"."[i].classList.remove('hidden');
                }, 1000);
            }
            else{
                $idelements1"."[i].classList.remove('transition-opacity', 'opacity-0');
                $idelements2"."[i].classList.add('transition-opacity', 'opacity-0');
                setTimeout(() => {
                $idelements2"."[i].classList.remove('transition-opacity', 'opacity-0');
                $idelements1"."[i].classList.remove('hidden');
                $idelements2"."[i].classList.add('hidden');
                }, 1000);
            }
            $barang->nama_barang++
        }
    }
</script>";
?>
</div>



    @endif
    @endif
    <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2 text-blue-800">{{ $barang->nama_barang }}</div>
        <p class="text-white text-base">
            <strong>Jenis Tutup:</strong> {{ $barang->jenis_tutup }}<br>
        </p>
        <p class="text-white text-base">
            <strong>Ukuran:</strong> {{ $barang->ukuran }}
        </p>
        <p class="text-white text-base">
            <strong>Stok:</strong> {{ $barang->stok }}
        </p>
        <p class="text-white text-base">
            <strong>Isi per Bal:</strong> {{ $barang->bal }}
        </p>
        <p class="text-white text-base">
            <strong>Harga:</strong> {{ $barang->harga_jual }}
        </p>
        <div class="text-white text-base">
            <strong>Minat?</strong>
        </div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2 flex">
        <a href="https://wa.me/08231231412?text=Halo,%20Saya%20Ingin%20Order%20Botol%20{{$barang->nama_barang}}" class="mr-2">Order di sini</a>
        <img class="max-w-[30px] max-h-[30px]" src="{{ $pathimage }}" alt="">
        </button>
        
    </div>
</div>
@endif