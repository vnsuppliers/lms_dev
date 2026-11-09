<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Assigned_Group;

class Group extends Model
{
    protected $table = 'tbl_groups';
    protected $fillable = [
        'name',
        'status'
    ];

    public function assignedGroups()
    {
        return $this->hasMany(Assigned_Group::class, 'group_id', 'id');
    }

      public function assignedUsers()
    {
        return $this->hasMany(Asigneduser::class, 'group_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'tbl_assigned_groups', 'group_id', 'user_id');
    }
}
