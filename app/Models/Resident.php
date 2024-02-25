<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $primaryKey = 'id';

    // Add other fields that you want to be mass-assignable
    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'dateOfBirth',
        'age',
        'nationality',
        'civilStatus',
        'address',
        'contactNumber',
        'gender',
        'barangay',
        'purpose',
        'isBlotter',
    ];

    // Relationship with Information Filing


    // Relationship with Certificates
    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'residentID', 'id');
    }

    // Relationship with business permit
    public function business()
    {
        return $this->hasOne(BusinessPermit::class, 'residentID', 'id')->withDefault(true);
    }

    public function certLog()
    {
        return $this->hasOne(CertifacteLog::class, 'residentID', 'id')->withDefault(true);
    }
}
