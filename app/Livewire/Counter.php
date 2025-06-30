<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public int $count = 10;
    public int $number = 0; // Remove int type hint to allow null initial state

    public function changeCount(int $number)
    {
        
        $this->count = $number;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}