<div class="container mx-auto px-4">
    <div class="flex justify-center mt-6">
        <form action="{{ route('searchStok'.$route) }}" method="GET" class="w-full max-w-xl">
            <div class="flex flex-col items-center border-b border-teal-500 py-2">
                <!-- Input text -->
                <input class="appearance-none bg-transparent border-none w-full text-white mb-3 py-1 px-2 leading-tight focus:outline-none" type="text" name="search" placeholder="Search items..." aria-label="Search items">
                
                
                <!-- Search Button -->
                <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded w-full mb-3" type="submit">
                    Search
                </button>
            </div>
        </form>
    </div>
</div>