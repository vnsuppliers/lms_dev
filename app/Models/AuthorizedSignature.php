<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizedSignature extends Model
{
    use HasFactory;

    protected $table = 'tbl_authorized_signature';

    protected $fillable  = [
        'authorised_sign'
    ];
}