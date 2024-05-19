<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold my-4">Edit agents</h1>
    <form action="{{ route('agents.edit', $agents->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block">Name</label>
            <input type="text" name="name" value="{{ $agents->name }}" class="w-full px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="address" class="block">Address</label>
            <input type="text" name="address" value="{{ $agents->address }}" class="w-full px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="images" class="block">Images (JSON format)</label>
            <input type="text" name="images" value="{{ json_decode($agents->images) }}" class="w-full px-4 py-2"
                required>
        </div>
        <div class="mb-4">
            <label for="telephone" class="block">Telephone</label>
            <input type="text" name="telephone" value="{{ $agents->telephone }}" class="w-full px-4 py-2" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>