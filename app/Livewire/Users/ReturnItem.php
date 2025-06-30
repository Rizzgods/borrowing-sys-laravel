<?php

namespace App\Livewire\Users; // Remove duplicate namespace

use Livewire\Component;
use App\Models\User;
use App\Models\items;
use App\Models\ItemHistory;
use App\Models\facList;

class ReturnItem extends Component
{
    public $itemHistories;
    public $userId;

    public function mount($userId = null)
    {
        $this->userId = $userId;
    }

    public function render()
    {
        if ($this->userId) {
            $this->itemHistories = ItemHistory::where('user_id', $this->userId)
                ->where('is_returned', false)
                ->get();
        } else {
            $this->itemHistories = ItemHistory::where('is_returned', false)->get();
        }
        
        return view('livewire.users.return-item'); // Fix view path
    }


   
    public function saveReturn($historyId)
    {
        try {
            $history = ItemHistory::findOrFail($historyId);
            
            $history->update([
                'is_returned' => true,
                'returned_at' => now(),
            ]);
            
            
            if ($history->item) {
                $history->item->update(['status' => 'available']);
            }
            
            session()->flash('success', $history->item->name . ' returned successfully!');
            return redirect()->route('return', [$this->userId]);
        }
        catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }
}
