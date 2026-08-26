<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sector',
        'location',
        'host',
        'category',
        'category_id',
        'date',
        'time',
        'description',
        'status',
        'image',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function categoryRel()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
