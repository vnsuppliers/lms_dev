<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offline_Documents extends Model
{
    use HasFactory;

     protected $table = 'tbl_offine_documents';
    
    protected $fillable = [
        'course_id', 'assined_id', 'type', 'document_name', 'document_path'
    ];

    public function assign_details()
    {
        return $this->belongsTo('App\Models\Asigneduser','assined_id','id');
    }
}
