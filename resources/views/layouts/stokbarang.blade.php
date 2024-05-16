<div class="gap-6 ">
    <div class="flex justify-center mt-6">

        <form action="{{ route('search') }}" method="GET" class="w-full max-w-xl">
            <div class="flex flex-col items-center border-b border-teal-500 py-2">
                <!-- Input text -->
                <input
                    class="appearance-none bg-transparent border-none w-full text-white mb-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text" name="search" placeholder="Search items..." aria-label="Search items">

                <!-- Dropdowns -->
                <div class="flex w-full justify-between mb-3">
                    <select name="stock"
                        class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline text-black mr-2">
                        <option value="">All Stocks</option>
                        <option value="high">High Stock (>20)</option>
                    </select>
                    <select name="type"
                        class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline text-black">
                        <option value="">All Types</option>
                        <option value="tinggi">Tinggi</option>
                        <option value="rendah">Rendah</option>
                    </select>
                </div>

                <!-- Search Button -->
                <button
                    class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded w-full mb-3"
                    type="submit">
                    Search
                </button>

                <!-- Dashboard Link -->

            </div>
        </form>
    </div>

    <div class="w-full flex justify-center items-center">
        <div class="container my-10">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 lg:grid-cols-2 max-lg:gap-4">
                @foreach ($barangs as $barang)
                    <x-stok-barang-card :barang="$barang" />
                @endforeach
            </div>
        </div>
    </div>
    <div class="mt-8 flex sm:justify-center mx-auto overflow-auto">
        {{ $barangs->appends(request()->query())->onEachSide(1)->links() }}
    </div>
</div>