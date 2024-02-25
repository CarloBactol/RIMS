<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayLGU extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $table = 'barangay_l_g_u_s';

    // Add other fields that you want to be mass-assignable
    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'isSecretary',
        'isTreasurer',
        'address',
        'contactNo',
        'schedule',
        'role'
    ];
}
