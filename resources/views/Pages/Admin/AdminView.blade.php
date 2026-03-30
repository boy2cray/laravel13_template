@extends('layouts.app')

@section('title', 'Data Admin')

@section('content')

<div x-data="{ modalTambah : false ,
                modalEdit : false,
                modalHapus : false,
                modalImport : false,
            }"
            @close-modal.window="modalTambah = false"
            @close-edit-modal.window="modalEdit = false"
            @tampil-edit-modal.window="modalEdit = true"
            @close-hapus-modal.window="modalHapus = false"
            @tampil-hapus-modal.window="modalHapus = true"
            @close-modal-import.window="modalImport = false"     
        >

    <x-headerHalaman
        title='Data Admin'
        description='Halaman berisi informasi data admin'
        :addbutton=true
        :showImport=true
    />

    {{-- TABEL UTAMA --}}
   
    
    {{-- MODAL --}}
    
    
</div>



@endsection