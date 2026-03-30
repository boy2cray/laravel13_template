<button
    @if($action) wire:click="{{ $action }}" @endif
    wire:loading.attr="disabled"
    {{ $attributes->merge([
        'class' => 'w-full sm:w-auto mt-auto group flex items-center justify-center gap-3 px-8 py-3.5 rounded-2xl text-sm font-black
        bg-gradient-to-br from-indigo-600 to-violet-700 text-white hover:shadow-[0_15px_30px_rgba(79,70,229,0.4)]
        transition-all duration-500 hover:-translate-y-1 active:scale-95
        disabled:opacity-75 disabled:cursor-not-allowed disabled:shadow-none'
    ]) }}
>

    {{-- ICON NORMAL --}}
    <span wire:loading.remove wire:target="{{ $action }}">
        @isset($icon)
            {{ $icon }}
        @else
            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                      d="M12 4v16m8-8H4"/>
            </svg>
        @endisset
    </span>

    {{-- ICON LOADING --}}
    <span wire:loading wire:target="{{ $action }}">
        @isset($loadingIcon)
            {{ $loadingIcon }}
        @else
            <svg class="w-5 h-5 animate-spin"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
            </svg>
        @endisset
    </span>

    {{-- TEXT --}}
    <span wire:loading.remove wire:target="{{ $action }}">
        {{ $label }}
    </span>

    <span wire:loading wire:target="{{ $action }}">
        {{ $loadingLabel }}
    </span>

</button>