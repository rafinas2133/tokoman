<div class="container mx-auto px-4">
    <h1 class="text-2xl text-white font-bold my-4">Add Agents</h1>
    <form class="text-white" action="{{ route('agents.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block">Name</label>
            <input class="text-black w-full" type="text" name="name" class="w-full px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="address" class="block">Address</label>
            <input class="text-black w-full" type="text" name="address" class="w-full px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="images" class="block">Images</label>
            <input class="text-black w-full" type="text" name="images" class="w-full px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="noTelp" class="block">Telephone</label>
            <input class="text-black w-full" type="text" name="noTelp" class="w-full px-4 py-2" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>