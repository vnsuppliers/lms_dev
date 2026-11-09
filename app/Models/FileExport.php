<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileExport extends Model
{
    use HasFactory;

    protected $fillable = [
        'export_type',
        
    ];
}
