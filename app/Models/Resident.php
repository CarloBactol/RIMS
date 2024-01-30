<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $primaryKey = 'id';

    // Add other fields that you want to be mass-assignable
    protected $fillable = [
        'firstName',
        'lastName',
        'dateOfBirth',
        'age',
        'nationality',
        'civilStatus',
        'address',
        'contactNumber',
        'gender',
        'barangay',
        'status',
        'purpose',
        'isBlotter',
    ];

    // Relationship with Information Filing
    public function informationFilings()
    {
        return $this->hasMany(InformationFiling::class, 'residentID', 'id');
    }

    // Relationship with Blotter Records
    public function blotterRecords()
    {
        return $this->hasMany(BlotterRecord::class, 'residentID', 'id')->withDefault(true);
    }

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
}
