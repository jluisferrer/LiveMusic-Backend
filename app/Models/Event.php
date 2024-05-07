<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'eventName',
        'eventDate',
        'location',
        'eventImage',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'usergroupevent');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'usergroupevent');
    }
}