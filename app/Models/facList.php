<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class facList extends Model // Corrected class name casing
{
    protected $table = 'Fac_list'; // Explicitly specify the table name

    protected $fillable = [
        'faculty_name',
        'facultyid',
        'dept',
    ];

    public function histories()
    {
        return $this->hasMany(\App\Models\ItemHistory::class, 'fac_id'); // CORRECT
    }
}
