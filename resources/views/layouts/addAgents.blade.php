<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold my-4">Add Agents</h1>
    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block">Name</label>
            <input type="text" name="name" class="w-full px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="address" class="block">Address</label>
            <input type="text" name="address" class="w-full px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="images" class="block">Images (JSON format)</label>
            <input type="text" name="images" class="w-full px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="telephone" class="block">Telephone</label>
            <input type="text" name="telephone" class="w-full px-4 py-2" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>