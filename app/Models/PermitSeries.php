<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitSeries extends Model
{
    use HasFactory;
    protected $table = 'permit_series';
    protected $fillable = ['permitNo', 'series', 'userID'];
}
