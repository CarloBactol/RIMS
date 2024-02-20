<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blotter extends Model
{
    use HasFactory;
    protected $table = 'blotters';
    protected $fillable = ['description', "complainant_id","respondent_id"];

    public function complainant()
    {
        return $this->belongsTo(People::class, 'complainant_id');
    }

    /**
     * Get the respondent for the blotter.
     */
    public function respondent()
    {
        return $this->belongsTo(People::class, 'respondent_id');
    }

   
}
