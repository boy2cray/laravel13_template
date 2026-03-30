@extends('layouts.app')

@section('title', 'Profil Karyawan')

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
        title='Profil Karyawan'
        description='Halaman berisi informasi profil karyawan'
         :addbutton=false
    />

    {{-- TABEL UTAMA --}}
    
   
    
    {{-- MODAL --}}
   
    
</div>



@endsection