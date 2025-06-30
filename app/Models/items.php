<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model // Corrected class name casing
{
    protected $table = 'items'; // Explicitly specify the table name

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'is_available',
        'BorrowCount',
    ];

    // Add this method inside the Items class
    public function histories()
    {
        return $this->hasMany(\App\Models\ItemHistory::class, 'item_id');
    }
}

?>