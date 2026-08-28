<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralWorship extends Model
{
    protected $table = 'general_worships';

    protected $fillable = [
        'session',
        'time',
        'location',
        'preacher',
        'liturgist',
        'coordinator',
        'prayer_leader',
        'announcement',
        'offering',
        'collector_1',
        'collector_2',
        'greeter_1',
        'greeter_2',
        'organist_1',
        'organist_2',
        'song_leader_1',
        'song_leader_2',
        'worship_leader',
        'multimedia',
        'praise_offering',
    ];

    public function getSessionLabelAttribute(): string
    {
        return $this->session === 'morning' ? 'Pagi' : 'Sore';
    }
}
