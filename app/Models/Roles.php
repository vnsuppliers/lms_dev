<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'tbl_roles';

    protected $fillable = [
        'role',
        'permission_id',
        'status'
    ];

    /**
     * The permissions that belong to the role.
     */
    public function permissions()
{
    return $this->hasMany('App\Models\Permission', 'id', 'permission_id');
}
}


