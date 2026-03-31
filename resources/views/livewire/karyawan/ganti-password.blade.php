<x-modal-input
    idModal='modalEdit'
    icon='edit'
    labelModal='Ganti Password'
    clickEvent='editPwd'
    buttonLabel='Ganti'
    ukuran='max-w-xs'
>

    <x-err-validation/>

    <x-floating-input
        wire:model="password_old"
        name="password_old"
        label="Password Lama"
        type="password"
        icon="kunci"
        :floating="false"
    />
    
    <x-floating-input
        wire:model="password"
        name="password"
        label="Password Baru"
        type="password"
        icon="kunci"
        :floating="false"
    />

    <x-floating-input
        wire:model="password_confirmation"
        name="password_confirmation"
        label="Konfirmasi Password"
        type="password"
        icon="kunci"
        :floating="false"
    />

</x-modal-input>