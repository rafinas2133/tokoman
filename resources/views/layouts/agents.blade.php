<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold my-4">agents</h1>
    <a href="{{ route('agents.add') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add agents</a>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 my-4">
        @foreach ($agents as $agent)
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-xl font-bold">{{ $agent->name }}</h2>
                <p>{{ $agent->address }}</p>
                <p>{{ $agent->telephone }}</p>
                <div>
                    @foreach (json_decode($agent->images) as $image)
                        <img src="{{ $image }}" alt="Image" class="w-full h-32 object-cover my-2">
                    @endforeach
                </div>
                <a href="{{ route('agentss.edit', $agent->id) }}" class="bg-green-500 text-white px-4 py-2 rounded">Edit</a>
                <form action="{{ route('agentss.destroy', $agent->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
</div>