<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'date',
        'time_start',
        'time_end',
        'location',
        'organized_by',
        'category',
        'category_id',
        'quote',
        'quote_source',
        'image',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function categoryRel(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organized_by');
    }
}
