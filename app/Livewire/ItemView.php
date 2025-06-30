<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\items;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\On;

class ItemView extends Component
{
    public $items;
    public $message;
    public $myModal3;
    public $itemID; 

    public $editItemId;
    public $name;
    public $description;
    public $quantity;
    public $is_available;

    #[On('items-created')]
    public function reload(){
        $this->items = items::all();
    }

    public function mount()
    {
        $this->items = items::all();
        
        if (Request::get('success') === 'true') {
            $this->message = 'Item created successfully! The list has been updated.';
        }
    }

    public function refreshItems()
    {
        
        $this->items = items::all();
    }

    public function render()
    {
        return view('livewire.item-view', [
            'items' => items::all(), // <--- Always fetch latest items
            'message' => $this->message
        ]);
    }

    public function delete($id){
        items::find($id)->delete();
        
        return redirect()->route('crud.index')->with('success', 'Item deleted successfully.');

    }

    public function toggleModal3()
    {
        $this->myModal3 = true;
    }

    public function editItem($itemId)
    {
        $this->editItemId = $itemId;
    
        try {
            $item = \App\Models\Items::findOrFail($itemId);
            $this->name = $item->name;
            $this->description = $item->description;
            $this->quantity = $item->quantity;
            $this->is_available = $item->is_available;
            $this->myModal3 = true;
    
    
            $this->refreshItems();
        } catch (\Exception $e) {
            session()->flash('error', 'Item not found.');
        }
    }
    
    
    public function updateItem()
    {
        // Validate the input
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'is_available' => 'required|boolean',
        ]);
        
        try {
            $item = \App\Models\Items::findOrFail($this->editItemId);
            
            $item->update([
                'name' => $this->name,
                'description' => $this->description,
                'quantity' => $this->quantity,
                'is_available' => $this->is_available,
            ]);
            
            // Refresh items after update to show the latest data
            $this->items = items::all();
            
            // Close the modal
            $this->myModal3 = false;
            
            // Reset form fields
            $this->reset(['name', 'description', 'quantity', 'is_available', 'editItemId']);
            
            // Show success message
            session()->flash('success', 'Item updated successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Error updating item: ' . $e->getMessage());
        }
    }
}
