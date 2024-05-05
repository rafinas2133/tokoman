<?php
$line=1;
?>
<div class="flex flex-col items-center justify-center mt-10">
    <h1 class="text-xl text-white font-semibold mb-4">Reporting Form</h1>
    <div class="flex items-center space-x-4 mb-2">
        <form action="{{route('pelaporan.store')}}" method="post" id="reportingForm">
            @csrf
            <input type="hidden" name="line" id="line" value="1">
            <div id="inputLines">
                <div class="grid grid-cols-5 gap-4">
                <div>
                    <label for="reportDate1" class="block text-sm font-medium text-white">Report Date:</label>
                    <input type="date" id="reportDate1" name="reportDate1" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="itemName1" class="block text-sm font-medium text-white">Item Name:</label>
                    <select id="itemName1" name="itemName1" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="item1">Item 1</option>
                        <option value="item2">Item 2</option>
                        <option value="item3">Item 3</option>
                    </select>
                </div>
                <div>
                    <label for="itemQuantity1" class="block text-sm font-medium text-white">Item Quantity:</label>
                    <input type="number" id="itemQuantity1" name="itemQuantity1" min="1" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="itemPrice1" class="block text-sm font-medium text-white">Item Price:</label>
                    <input type="number" id="itemPrice1" name="itemPrice1" min="0.01" step="0.01" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="button" id="addLineBtn" class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Add Another Line</button>
            </div>
            <div class="mt-4">
                <button type="Submit" class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Submit</button>
            </div>
        </form>
    </div>

    <!-- JavaScript to handle adding new input lines -->
    <script>
        let line=1;
        const form = document.getElementById('reportingForm');
        const addLineBtn = document.getElementById('addLineBtn');

        addLineBtn.addEventListener('click', () => {
            line++;
            const hitungLine = document.getElementById('line');
            hitungLine.value = line;
            const inputLinesDiv = document.getElementById('inputLines');
            const newLineDiv = document.createElement('div');
            newLineDiv.className = 'grid grid-cols-5 gap-4 mt-4';
            newLineDiv.innerHTML = `
                <div>
                    <label for="reportDate${line}" class="block text-sm font-medium text-white">Report Date:</label>
                    <input type="date" id="reportDate${line}" name="reportDate${line}" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="itemName${line}" class="block text-sm font-medium text-white">Item Name:</label>
                    <select id="itemName${line}" name="itemName${line}" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="item1">Item 1</option>
                        <option value="item2">Item 2</option>
                        <option value="item3">Item 3</option>
                        <!-- Add more items here -->
                    </select>
                </div>
                <div>
                    <label for="itemQuantity${line}" class="block text-sm font-medium text-white">Item Quantity:</label>
                    <input type="number" id="itemQuantity${line}" name="itemQuantity${line}" min="1" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="itemPrice${line}" class="block text-sm font-medium text-white">Item Price:</label>
                    <input type="number" id="itemPrice${line}" name="itemPrice${line}" min="0.01" step="0.01" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-red-700 text-sm font-medium">delete</label>
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
                line--;
                const hitungLine = document.getElementById('line');
                hitungLine.value = line;
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