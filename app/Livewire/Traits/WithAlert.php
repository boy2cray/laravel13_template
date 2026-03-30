<?php

namespace App\Livewire\Traits;

use Illuminate\Support\Facades\Log;

trait WithAlert
{
    /**
     * Tampilkan alert dengan SweetAlert2
     * 
     * @param string $type Tipe alert: 'success', 'error', 'warning', 'info'
     * @param string $message Pesan yang ditampilkan
     * @param array $options Opsi tambahan (confirm, onConfirm, toast, dll)
     */
    protected function alert(
        string $type,
        string $message,
        array $options = []
    ): void {
        
        // Validasi type
        $validTypes = ['success', 'error', 'warning', 'info'];
        if (!in_array($type, $validTypes)) {
            $type = 'info';
        }

        $payload = array_merge([
            'type'    => $type,
            'message' => $message,
            'title'   => match ($type) {
                'error'   => 'Oops...',
                'warning' => 'Perhatian',
                'info'    => 'Informasi',
                default   => 'Berhasil'
            },
            'toast'   => in_array($type, ['success', 'info']),
            'confirm' => false,
            // Mengambil ID unik komponen untuk keperluan callback
            'componentId' => $this->getId(), 
        ], $options);
        
        // Validasi onConfirm jika confirm true
        if ($payload['confirm'] && !isset($payload['onConfirm'])) {
            Log::warning('Alert dengan confirm=true harus memiliki onConfirm', ['componentId' => $this->getId()]);
        }

        // Mengirim payload sebagai satu objek utuh, bukan argumen terpisah
        $this->dispatch('app:alert', $payload);
    }
}
