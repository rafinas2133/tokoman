@if ($barang -> stok > 0)
<?php $pathimage='https://w7.pngwing.com/pngs/362/594/png-transparent-whatsapp-inc-business-whatsapp-text-logo-sign-thumbnail.png'?>
<div class="mx-auto w-[380px] rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-500 bg-gray-100 dark:bg-gray-700 mb-10">
    @if($barang->pathImg1=='')
    <img class="mx-auto w-[300px] h-[300px] rounded-lg" src="https://placeholder.pics/svg/300" alt="Gambar {{ $barang->nama_barang }}">
    @else
    @if($barang->pathImg2=='')
    <img class="mx-auto w-[300px] h-[300px] rounded-lg" src="{{$barang->pathImg1}}" alt="Gambar {{ $barang->nama_barang }}">
    @else
    <div class="mx-auto w-[300px] h-[300px] rounded-lg">
    <!-- Slides -->
    <div class="mySlide transition-opacity duration-1000 ease-in-out">
        <img src="{{$barang->pathImg1}}" class="w-[300px] mx-auto h-[300px]">
    </div>

    <div class="mySlide2 hidden transition-opacity duration-1000 ease-in-out">
        <img src="{{$barang->pathImg2}}" class="w-[300px] mx-auto h-[300px]">
    </div>
</div>

<script>
let images = ["{{$barang->pathImg1}}", "{{$barang->pathImg2}}"];
let currentImageIndex = 0;
let imgElements = document.getElementsByClassName('mySlide');
let imgElements2 = document.getElementsByClassName('mySlide2');

function showNextImage() {
    for (let i = 0; i < imgElements.length; i++) {
        if (currentImageIndex === 0) {
            imgElements[i].classList.add('transition-opacity', 'opacity-0');
            imgElements2[i].classList.remove('transition-opacity', 'opacity-0');
            setTimeout(() => {
                imgElements[i].classList.add('hidden');
                imgElements2[i].classList.remove('hidden');
            }, 1000);
            
        } else {
            imgElements[i].classList.remove('transition-opacity', 'opacity-0');
            imgElements2[i].classList.add('transition-opacity', 'opacity-0');
            setTimeout(() => {
                imgElements2[i].classList.remove('transition-opacity', 'opacity-0');
                imgElements[i].classList.remove('hidden');
                imgElements2[i].classList.add('hidden');
            }, 1000);
            
        }
    }

    currentImageIndex = (currentImageIndex + 1) % images.length;
}

setInterval(showNextImage, 3000); // Ganti gambar setiap 3 detik
</script>
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
        <a href="" class="mr-2">Order di sini</a>
        <img class="max-w-[30px] max-h-[30px]" src="{{ $pathimage }}" alt="">
        </button>
        
    </div>
</div>
@endif