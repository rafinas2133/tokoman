<div class="container mx-auto px-4 dark:text-white text-black">
    <h1 class="text-3xl text-center font-bold my-4">Agents</h1>
    <a href="{{ route('agents.add') }}" class="bg-blue-500 px-4 py-2 rounded hover:bg-gray-700 hover:rounded-md hover:shadow">Add agents</a>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 my-4">
        @foreach ($agents as $agent)
            <div class="dark:bg-gray-500 bg-white p-4 rounded shadow">
                <h2 class="text-xl font-bold">{{ $agent->name }}</h2>
                <!-- ngene lho cok -->
                <!-- <p class=" break-words">{{ $agent->address }} ea gung rapi aokwokwowkok</p> -->
                <p>{{ $agent->address}}</p>
                <p>{{ $agent->noTelp }}</p>
                <div>
                    <img src="https://tokoman.s3.ap-southeast-2.amazonaws.com/agents/{{$agent->images}}" alt="Image" class="w-full h-32 object-cover my-2">
                </div>
                <div class="flex md:max-[840px]:flex-col gap-4 justify-center xitems-center">
                    <a href="{{ route('agents.edit', $agent->id) }}" class="bg-green-500 px-4 py-2 rounded w-fit hover:bg-gray-700 hover:rounded-md hover:shadow">Edit</a>
                    <form action="{{ route('agents.destroy', $agent->id) }}" method="POST" class="">
                        @csrf
                        @method('delete')
                        <button type="submit" class="bg-red-500 px-4 py-2 rounded hover:bg-gray-700 hover:rounded-md hover:shadow">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>