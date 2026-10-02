<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferingCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'qris_image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getQrCodeUrlAttribute(): string
    {
        $payload = vsprintf('%s|%s|%s', [
            $this->bank_account_number ?? '',
            $this->bank_account_name ?? '',
            $this->bank_name ?? '',
        ]);

        return 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($payload);
    }
}
