<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertifacteLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'residentID', 'certificate_type',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'residentID', 'id');
    }
}


