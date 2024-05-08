<div>
    <div class="flex mb-4">
        <!-- Search -->
        <div class="container mx-auto px-4 max-w-md">
            <div class="flex justify-center mt-6">
                <form action="{{ route('searchStokadmin') }}" method="GET" class="w-full max-w-xl">
                    <div class="flex flex-col items-center border-b border-teal-500 py-2">
                        <!-- Input text -->
                        <input
                            class="appearance-none bg-transparent border-none w-full text-white mb-3 py-1 px-2 leading-tight focus:outline-none"
                            type="text" name="search" placeholder="Search items..." aria-label="Search items">
                        <select name="type"
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline text-black mb-2">
                            <option value="">All Types</option>
                            <option value="tinggi">Tinggi</option>
                            <option value="rendah">Rendah</option>
                        </select>

                        <!-- Search Button -->
                        <button
                            class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded w-full mb-3"
                            type="submit">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!--tambah data-->
        <div class="absolute top-[180px] right-4">
            <div class="p-6 text-gray-900 dark:text-gray-100 start-0 ">
                <a href="/stok/add"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 mb-2 px-4 rounded justify-end">
                    + Tambah data barang</a>
            </div>
        </div>
    </div>
</div>