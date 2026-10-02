<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Reflection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'date',
        'church_day',
        'theme',
        'bible_verse',
        'bible_translation',
        'excerpt',
        'body',
        'image',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    protected $appends = ['image_url', 'summary'];

    protected static function booted(): void
    {
        static::saving(function (self $reflection) {
            if (blank($reflection->slug)) {
                $reflection->slug = static::uniqueSlug($reflection->title, $reflection->id);
            }
        });
    }

    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'renungan';
        $slug = $base;
        $suffix = 2;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn (Builder $q) => $q->whereKeyNot($ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$suffix++;
        }

        return $slug;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderByDesc('date')->orderByDesc('id');
    }

    public function getImageUrlAttribute(): ?string
    {
        if (blank($this->image)) {
            return null;
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        return Storage::disk('public')->url($this->image);
    }

    public function deleteImageFromDisk(): void
    {
        if (filled($this->image) && ! Str::startsWith($this->image, ['http://', 'https://'])) {
            Storage::disk('public')->delete($this->image);
        }
    }

    public function getSummaryAttribute(): string
    {
        return filled($this->excerpt)
            ? $this->excerpt
            : Str::limit(strip_tags((string) $this->body), 220);
    }
}