<?php
// ItemHistory.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\facList;


class ItemHistory extends Model
{
    protected $table = 'itemhistory';
    protected $fillable = [
        'user_id',
        'item_id',
        'is_borrowed',
        'borrowed_at',
        'is_returned',
        'returned_at',
        'fac_id',
        'returnTime',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function item()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }
    public function faculty()
    {
        return $this->belongsTo(facList::class, 'fac_id');
    }

    
}

