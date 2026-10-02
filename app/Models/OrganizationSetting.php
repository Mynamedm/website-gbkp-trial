<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrganizationSetting extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'periode',
        'hero_image',
    ];

    public static function current(): self
    {
        return static::query()->firstOr(fn () => static::create([
            'title' => 'Struktur Organisasi',
        ]));
    }

    public function getHeroImageUrlAttribute(): ?string
    {
        if (blank($this->hero_image)) {
            return null;
        }

        if (Str::startsWith($this->hero_image, ['http://', 'https://'])) {
            return $this->hero_image;
        }

        return Storage::disk('public')->url($this->hero_image);
    }

    public function deleteHeroImageFromDisk(): void
    {
        if (filled($this->hero_image) && ! Str::startsWith($this->hero_image, ['http://', 'https://'])) {
            Storage::disk('public')->delete($this->hero_image);
        }
    }
}
