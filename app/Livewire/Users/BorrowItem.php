<?php

namespace App\Livewire\Users;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\User;
use App\Models\items;
use App\Models\ItemHistory;
use App\Models\facList;
use Illuminate\Support\Facades\DB;

class BorrowItem extends Component
{
    public $userId;
    public $user;
    public $items;
    public $faculty;
    public $selectedFaculty = null;


    public $facID;
    public $itemID;
    public $returnTime;
    
    public function mount($userId = null)
    {   
        
        $this->items = items::all();
        
        $this->faculty = facList::all()->map(function ($faculty) {
            return [
                'id' => $faculty->id,
                'faculty_name' => $faculty->faculty_name,
            ];
        })->toArray(); // Ensure proper key-value structure

        $this->userId = $userId;
        
        if ($this->userId) {
            $this->user = User::find($this->userId);
        }
    }
    
    public function render()
    {
        return view('livewire.users.borrow-item');
    }

    public function saveBorrow(){
        $this->validate([
            'itemID' => 'required',
            'facID' => 'required',
            'returnTime' => 'required',
        ]);

        try {
            DB::beginTransaction();

            ItemHistory::create([
                'user_id' => $this->userId,
                'item_id' => $this->itemID,
                'is_borrowed' => true,
                'borrowed_at' => now(),
                'is_returned' => false,
                'returned_at' => null,
                'fac_id' => $this->facID,
                'returnTime' => $this->returnTime,
            ]);

            $item = Items::findOrFail($this->itemID);
            $item->increment('BorrowCount', 1);

            DB::commit();

            $this->reset(['itemID', 'facID', 'returnTime']);
            session()->flash('success', 'Item borrowed successfully!');
            return redirect()->route('home');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }
}