<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use SoftDeletes;

     protected $table = 'tbl_certificates';
    
    protected $fillable = [
        'template_id', 'certificate_name', 'code', 'cerificate_issue_name', 'status', 'signature_image', 'signature_drawn', 'category_id', 'parent_id', 'type'
    ];

     public function template_data()
    {
        return $this->belongsTo('App\Models\Certificate_template','template_id','id');
    }

}
