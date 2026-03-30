@props(['id'])

<div x-show="activeTab === '{{ $id }}'" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300" 
     x-transition:enter-start="opacity-0 translate-y-2" 
     {{-- Memungkinkan kamu menimpa atau menambah class CSS seperti padding --}}
     {{ $attributes->merge(['class' => 'p-4 md:p-6 space-y-6 animate-fade-in']) }}>
     
    {{ $slot }}
    
</div>