<?php

// app/Models/Assigned_Group.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Group;
use App\Models\User;

class Assigned_Group extends Model
{
    protected $table = 'tbl_assigned_groups';
    protected $fillable = [
        'user_id',
        'group_id',
        'status'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

