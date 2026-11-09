<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'tbl_permissions';

    protected $fillable = [
         'permission',
        'status',
        'main_menu_type'

    ];

    /**
     * The permissions that belong to the role.
     */
    public function role()
    {
        return $this->belongsto(Roles::class,'role_id','id');
    }
}
