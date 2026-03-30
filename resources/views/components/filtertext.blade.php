<div class="relative w-full" wire:key="search-component">

    <input type="text" class="hidden" autocomplete="username">
    <input type="password" class="hidden" autocomplete="new-password">

    <label for="search_box" class="sr-only">Pencarian</label>
    
    <input
        type="search"
        id="search_box"
        name="search_box"
        placeholder="Cari ..."
        aria-label="Kotak Pencarian"
        wire:model.live.debounce.500ms="search"
        autocomplete="off"
        autocorrect="off"
        autocapitalize="off"
        spellcheck="false"
        class="w-full border border-gray-300 rounded-lg py-2.5 px-4 pl-10 pr-12
               text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400
               focus:border-transparent bg-white shadow-sm hover:shadow-md transition-all
               dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200
               dark:placeholder-gray-500 
               [&::-webkit-search-cancel-button]:hidden"
    >

    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <i class="fa-solid fa-magnifying-glass text-gray-500 dark:text-gray-400"></i>
    </div>

    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
        <div wire:loading.flex wire:target="search" class="items-center text-blue-500">
            <i class="fa-solid fa-spinner fa-spin"></i>
        </div>
    </div>

</div>