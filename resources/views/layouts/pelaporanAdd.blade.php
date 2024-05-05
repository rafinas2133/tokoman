<div class="flex flex-col items-center justify-center mt-10">
    <h1 class="text-xl text-white font-semibold mb-4">Reporting Form</h1>
    <div class="flex items-center space-x-4 mb-2">
        <form id="reportingForm">
            <div id="inputLines">
                <div class="grid grid-cols-5 gap-4">
                <div>
                    <label for="reportDate" class="block text-sm font-medium text-gray-700">Report Date:</label>
                    <input type="date" id="reportDate" name="reportDate" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="itemName" class="block text-sm font-medium text-gray-700">Item Name:</label>
                    <select id="itemName" name="itemName" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="item1">Item 1</option>
                        <option value="item2">Item 2</option>
                        <option value="item3">Item 3</option>
                    </select>
                </div>
                <div>
                    <label for="itemQuantity" class="block text-sm font-medium text-gray-700">Item Quantity:</label>
                    <input type="number" id="itemQuantity" name="itemQuantity" min="1" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="itemPrice" class="block text-sm font-medium text-gray-700">Item Price:</label>
                    <input type="number" id="itemPrice" name="itemPrice" min="0.01" step="0.01" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total:</label>
                    <span class="inline-block px-3 py-2 mt-1 bg-gray-200 rounded-md shadow-sm">0.00</span>
                </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="button" id="addLineBtn" class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Add Another Line</button>
            </div>
        </form>
    </div>

    <!-- JavaScript to handle adding new input lines -->
    <script>
        const form = document.getElementById('reportingForm');
        const addLineBtn = document.getElementById('addLineBtn');

        addLineBtn.addEventListener('click', () => {
            const inputLinesDiv = document.getElementById('inputLines');
            const newLineDiv = document.createElement('div');
            newLineDiv.className = 'grid grid-cols-5 gap-4 mt-4';
            newLineDiv.innerHTML = `
                <div>
                    <label for="reportDate" class="block text-sm font-medium text-gray-700">Report Date:</label>
                    <input type="date" id="reportDate" name="reportDate" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="itemName" class="block text-sm font-medium text-gray-700">Item Name:</label>
                    <select id="itemName" name="itemName" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="item1">Item 1</option>
                        <option value="item2">Item 2</option>
                        <option value="item3">Item 3</option>
                        <!-- Add more items here -->
                    </select>
                </div>
                <div>
                    <label for="itemQuantity" class="block text-sm font-medium text-gray-700">Item Quantity:</label>
                    <input type="number" id="itemQuantity" name="itemQuantity" min="1" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="itemPrice" class="block text-sm font-medium text-gray-700">Item Price:</label>
                    <input type="number" id="itemPrice" name="itemPrice" min="0.01" step="0.01" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total:</label>
                    <span class="inline-block px-3 py-2 mt-1 bg-gray-200 rounded-md shadow-sm">0.00</span>
                    <span class="inline-block px-3 py-2 mt-1 bg-gray-200 rounded-md shadow-sm">
                        <button type="button" class="text-red-500 hover:text-red-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </span>
                </div>
            `;
            const deleteBtn = newLineDiv.querySelector('button');
            deleteBtn.addEventListener('click', () => {
                inputLinesDiv.removeChild(newLineDiv);
            });
            inputLinesDiv.appendChild(newLineDiv);
        }
        // // Initial call to add the first input line
        // addInputLine();

        // Event listener for the "Add Another Line" button
        // addLineBtn.addEventListener('click', addInputLine); 
    );
    </script>
</div>