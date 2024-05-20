<?php $parrent=$parrent??''; 
echo "<script>console.log('".$parrent."')</script>"
?>
@if($message)
    <x-modalCustom name="confirm-user-deletion" :show="true" focusable id="modal-yakin" :parrent="$parrent">
        <div class="space-y-6 p-6">
            <h2 class="text-lg font-medium text-red-500 ">
                {{ __('Tunggu Dulu!') }}
            </h2>

            <p id="massage" class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __($message) }}
            </p>

            <div class="mt-6 flex justify-center">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('ok') }}
                </x-secondary-button>
            </div>
        </div>

    </x-modalCustom>
@endif
