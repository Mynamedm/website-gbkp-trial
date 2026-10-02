<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrganizationMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'slug',
        'position',
        'name',
        'description',
        'photo',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = ['photo_url'];

    protected static function booted(): void
    {
        static::saving(function (self $member) {
            if (blank($member->slug)) {
                $member->slug = static::uniqueSlug($member->position, $member->id);
            }
        });
    }

    public static function uniqueSlug(string $position, ?int $ignoreId = null): string
    {
        $base = Str::slug($position) ?: 'jabatan';
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

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')
            ->orderBy('sort_order')
            ->orderBy('position');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeRoots(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }

    public function getPhotoUrlAttribute(): ?string
    {
        if (blank($this->photo)) {
            return null;
        }

        if (Str::startsWith($this->photo, ['http://', 'https://'])) {
            return $this->photo;
        }

        return Storage::disk('public')->url($this->photo);
    }

    public function deletePhotoFromDisk(): void
    {
        if (filled($this->photo) && ! Str::startsWith($this->photo, ['http://', 'https://'])) {
            Storage::disk('public')->delete($this->photo);
        }
    }

    public function descendantIds(): array
    {
        $ids = [];
        $children = $this->children()->pluck('id');

        foreach ($children as $childId) {
            if (in_array($childId, $ids, true)) {
                continue;
            }

            $ids[] = $childId;
            $ids = array_merge($ids, static::find($childId)?->descendantIds() ?? []);
        }

        return $ids;
    }

    public function hasChildren(): bool
    {
        return $this->children()->exists();
    }

    public static function tree(bool $activeOnly = false): Collection
    {
        $members = static::query()
            ->when($activeOnly, fn (Builder $query) => $query->active())
            ->orderBy('sort_order')
            ->orderBy('position')
            ->get();

        $ids = $members->map(fn (self $member) => $member->id)->all();

        $grouped = $members->groupBy(fn (self $member) => (string) $member->parent_id);

        $branch = function (?int $parentId, array $ancestors) use (&$branch, $grouped): Collection {
            return $grouped->get((string) $parentId, collect())
                ->reject(fn (self $member) => in_array($member->id, $ancestors, true))
                ->map(function (self $member) use (&$branch, $ancestors) {
                    $member->setRelation('children', $branch($member->id, [...$ancestors, $member->id]));

                    return $member;
                })
                ->values();
        };

        return $members
            ->filter(fn (self $member) => $member->parent_id === null || ! in_array((int) $member->parent_id, $ids, true))
            ->map(fn (self $member) => $member->setRelation('children', $branch($member->id, [$member->id])))
            ->values();
    }
}
