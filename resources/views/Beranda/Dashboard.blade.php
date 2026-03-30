@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div x-data="{ modalTambah : false ,
            }"
            @buka-modal-pinjaman.window="modalTambah = true"
            @tutup-modal-pinjaman.window="modalTambah = false"  
        >

        <livewire:beranda />

        {{-- modal --}}
        
    
</div>

@endsection