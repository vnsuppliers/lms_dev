<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $table= 'tbl_logo_application';
   
    protected $fillable = [
        'site_name', 
        
        'favicon',
        'banner_image',
        'hide_sitename', 
    ];
}