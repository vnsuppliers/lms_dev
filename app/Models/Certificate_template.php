<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate_template extends Model
{
    use HasFactory;

     protected $table = 'tbl_certificate_templates';
    
    protected $fillable = [
        'template_name', 'template_image', 'template_pdf_html', 'template_html', 'status'
    ];

}
