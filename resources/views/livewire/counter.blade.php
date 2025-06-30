<div>
    <h1>Halu Warudo</h1>
    <p> {{ $count }} </p>
    <input type="number" wire:model.blur = 'number'/>
    <button wire:click = 'changeCount({{ $number }})'> change count </button>
</div>
