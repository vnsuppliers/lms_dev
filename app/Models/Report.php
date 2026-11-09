<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $fillable = [
        'name',
        'description',
        'data_source',
        'configuration',
        'created_by',
        'status',
    ];

    protected $casts = [
        'configuration' => 'array',
        'status' => 'integer',
    ];

    /**
     * Get user who created this report.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
