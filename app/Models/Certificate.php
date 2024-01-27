<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    // Add other fields that you want to be mass-assignable
    protected $fillable = [
        'residentID', 'certificateType', 'issueDate', 'expiryDate', 'officerID',
    ];

    // Relationship with Resident
    public function resident()
    {
        return $this->belongsTo(Resident::class, 'residentID', 'id');
    }
}
