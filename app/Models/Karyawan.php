<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

// Import Attributes Baru Laravel 13
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
// use Illuminate\Database\Eloquent\Attributes\ObservedBy;
// use Illuminate\Database\Eloquent\Attributes\Cast;

#[Table('karyawan')]
#[Fillable(['nik', 'nama', 'jk', 'asal', 'tgl_lahir', 'alamat', 'foto'])]
class Karyawan extends Model
{
    use LogsActivity, HasFactory;

    /**
     * Catatan: PHP Attributes di Laravel 13 menggantikan properti 'protected'.
     * Namun, method seperti getActivitylogOptions() tetap dipertahankan 
     * karena mengandung logika fluent (berantai).
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->useLogName('karyawan') 
            ->dontSubmitEmptyLogs();
    }

    /**
     * Laravel 13 merekomendasikan method casts() menggantikan properti $casts
     * untuk fleksibilitas yang lebih baik.
     */
    protected function casts(): array
    {
        return [
            'tgl_lahir' => 'date',
        ];
    }

    /**
     * Accessor & Mutator tetap menggunakan gaya Laravel 10+ (Attribute Return Type)
     * karena ini sudah sangat modern dan clean.
     */
    protected function tglLahir(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => \Carbon\Carbon::parse($value)->format('d-m-Y'),
            set: fn ($value) => \Carbon\Carbon::parse($value)->format('Y-m-d'),
        );
    }

    // --- RELASI (Tetap Menggunakan Method, tapi lebih Clean) ---

    public function user(): HasOne 
    {
        return $this->hasOne(User::class, 'id_karyawan', 'id');
    }

}