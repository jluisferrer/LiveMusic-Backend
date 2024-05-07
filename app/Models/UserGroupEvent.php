<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroupEvent extends Model
{
    use HasFactory;

    protected $table = 'usergroupevent';
    
    protected $fillable = [
        'user_id',
        'group_id',
        'event_id',
        'created_at',
        'updated_at'
    ];
}