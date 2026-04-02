@extends('layouts.app')

@section('title', 'Data Karyawan')

@section('content')

<div x-data="{ modalTambah : false ,
                modalEdit : false,
                modalHapus : false,
                modalImport : false,
                modalEksport : false,
            }"
            @close-modal.window="modalTambah = false"
            @close-edit-modal.window="modalEdit = false"
            @tampil-edit-modal.window="modalEdit = true"
            @close-hapus-modal.window="modalHapus = false"
            @tampil-hapus-modal.window="modalHapus = true"
            @close-modal-import.window="modalImport = false"
            @close-modal-eksport.window="modalEksport = false"    
        >

    <x-headerHalaman
        title='Data Karyawan'
        description='Halaman berisi informasi data karyawan'
        :addbutton=true
        :showImport=true
        :showEksport=true
    />

    {{-- TABEL UTAMA --}}
    <livewire:karyawan.karyawan-data />
   
    
    {{-- MODAL --}}
    <livewire:karyawan.add-karyawan />
    <livewire:karyawan.edit-karyawan />
    <livewire:karyawan.del-karyawan />
    <livewire:karyawan.import-karyawan />
    <livewire:karyawan.eksport-karyawan />
    
</div>



@endsection