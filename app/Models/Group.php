<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'groupName',
        'groupDescription',
        'groupImage',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'usergroupevent');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'usergroupevent');
    }
}
