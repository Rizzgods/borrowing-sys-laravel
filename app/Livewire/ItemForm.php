<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\items;

class ItemForm extends Component
{
    public string $name = '';
    public string $description = '';
    public int $quantity = 1;
    public bool $is_available = true;
    public $itemId = null;
    public $isEditing = false;
    
    // Rules for validation
    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'quantity' => 'required|integer|min:1',
        'is_available' => 'boolean',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->itemId = $id;
            $this->isEditing = true;
            $this->loadItem();
        }
    }

    public function loadItem()
    {
        $item = items::find($this->itemId);
        if ($item) {
            $this->name = $item->name;
            $this->description = $item->description ?? '';
            $this->quantity = $item->quantity;
            $this->is_available = $item->is_available;
        }
    }

    public function submit()
    {
        try {
            // Validate form data
            $this->validate();

            // Process form data
            $itemData = [
                'name' => $this->name,
                'description' => $this->description,
                'quantity' => $this->quantity,
                'is_available' => (bool)$this->is_available,
            ];
            
            if ($this->isEditing) {
                $item = items::find($this->itemId);
                if (!$item) {
                    $this->addError('error', 'Item not found.');
                    return;
                }
                
                $item->update($itemData);
                session()->flash('success', 'Item updated successfully!');
            } else {
                // Add BorrowCount field only for new items
                $itemData['BorrowCount'] = 0;
                
                items::create($itemData);
                session()->flash('success', 'Item created successfully!');
            }
            
            $this->reset(['name', 'description', 'quantity', 'is_available']);
            
            return redirect()->route('crud.index');
            
        } catch (\Exception $e) {
            $this->addError('error', 'Error saving item. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.item-form');
    }
}
