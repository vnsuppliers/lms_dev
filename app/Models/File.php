<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'tbl_files';

    protected $fillable = [
        'file_name',
        'file_type',
        'user_id',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
