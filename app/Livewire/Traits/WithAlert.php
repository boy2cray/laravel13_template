<?php

namespace App\Livewire\Traits;

trait WithAlert
{
    protected function dispatchAlert(array $data): void
    {
        $data['componentId'] = $this->getId();

        $this->dispatch('app:alert', $data);
    }

    // ✅ SUCCESS
    protected function success(string $message, string $title = 'Berhasil'): void
    {
        $this->dispatchAlert([
            'type' => 'success',
            'title' => $title,
            'message' => $message,
            'toast' => true,
        ]);
    }

    // ❌ ERROR
    protected function error(string $message, string $title = 'Oops...'): void
    {
        $this->dispatchAlert([
            'type' => 'error',
            'title' => $title,
            'message' => $message,
        ]);
    }

    // ⚠️ WARNING
    protected function warning(string $message, string $title = 'Perhatian'): void
    {
        $this->dispatchAlert([
            'type' => 'warning',
            'title' => $title,
            'message' => $message,
        ]);
    }

    // ℹ️ INFO
    protected function info(string $message, string $title = 'Informasi'): void
    {
        $this->dispatchAlert([
            'type' => 'info',
            'title' => $title,
            'message' => $message,
            'toast' => true,
        ]);
    }

    // 🔥 CONFIRM
    protected function confirm(
        string $message,
        string $method,
        string $title = 'Konfirmasi'
    ): void {
        $this->dispatchAlert([
            'type' => 'warning',
            'title' => $title,
            'message' => $message,
            'confirm' => true,
            'onConfirm' => $method,
        ]);
    }
}