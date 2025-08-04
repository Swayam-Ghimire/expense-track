<div>
    @if(count($visibleErrors))
        <ul class="px-4 py-2 bg-red-100">
            @foreach ($visibleErrors as $index => $error)
            <li class="my-2" wire:key="error-{{ $index }}">
                <div id="alert-2" 
                    class="flex items-center justify-between p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <div class="ms-3 text-sm font-medium">
                    <p>{{ $error }}</p>
                    </div>
                    <button type="button" wire:click="remove({{ $index }})"
                        class="cursor-pointer ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                        aria-label="Close">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            </li>
            @endforeach
        </ul>
    @else
        @if((session('success') || $message) && $clear != 'true')
        <div id="alert-3"
            class="flex items-center justify-between p-4 my-2 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <div class="ms-3 text-sm font-medium">
                <p>{{ session('success') }} {{ $message }}</p>
            </div>
            <button type="button" wire:click='toggleMsg()'
                class="cursor-pointer ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-3" aria-label="Close">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
        @endif
    @endif
</div>




