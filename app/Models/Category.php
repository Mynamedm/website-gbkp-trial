<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'category_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'category_id');
    }
}
