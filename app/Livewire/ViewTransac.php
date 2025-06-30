<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ItemHistory;

class ViewTransac extends Component
{
    public $itemHistories;
    public $filterStatus = 'all'; // Default filter to show all items
    
    public function filter($status)
    {
        $this->filterStatus = $status;
    }

    public function render()
    {
        
        $query = ItemHistory::query();
        
       
        if ($this->filterStatus === 'returned') {
            $query->where('is_returned', true);
        } elseif ($this->filterStatus === 'borrowed') {
            $query->where('is_returned', false);
        }

        $this->itemHistories = $query->orderBy('borrowed_at', 'desc')->get();
        
        return view('livewire.view-transac');
    }
}