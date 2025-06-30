<div class="p-6">
    <div class="max-w-full mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-primary">Available Items</h2>
                <p class="mt-2 text-base-content/70">Manage your inventory items</p>
            </div>
            
            <button class="btn btn-primary" onclick="window.location.href='{{ route('crud.form') }}'">
                <x-icon name="o-plus" class="w-5 h-5 mr-2" />
                Add New Item
            </button>
        </div>
        
        @if (session('success'))
        <div id="success-message" class="alert alert-success mb-6">
            <div class="flex">
                <x-icon name="o-check-circle" class="w-5 h-5 mr-2" />
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if ($message)
        <div id="message" class="alert alert-info mb-6">
            <div class="flex">
                <x-icon name="o-information-circle" class="w-5 h-5 mr-2" />
                <span>{{ $message }}</span>
            </div>
        </div>
        @endif

        <div class="card bg-base-100 shadow-xl overflow-hidden">
            <!---Start of modal --->
            <x-modal wire:model="myModal3" title="Edit Item" subtitle="Update item information">
                <x-form no-separator>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Name</span>
                        </label>
                        <input wire:model='name' type="text" name="name" class="input input-bordered w-full"  required />
                    </div>
    
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Description</span>
                        </label>
                        <textarea wire:model='description' name="description" rows="5" class="textarea textarea-bordered w-full"></textarea>
                    </div>
    
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Quantity</span>
                        </label>
                        <input wire:model='quantity' type="number" name="quantity" min="0" class="input input-bordered w-full" required />
                    </div>
    
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Availability Status</span>
                        </label>
                        <select wire:model='is_available' name="is_available" class="select select-bordered w-full">
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>
                        </select>
                    </div>
                    
                    <x-slot:actions>
                        <x-button label="Cancel" @click="$wire.myModal3 = false" class="btn-outline" />
                        <x-button label="Save Changes" class="btn-primary" wire:click="updateItem" />
                    </x-slot:actions>
                </x-form>
            </x-modal>
            <!---End of modal --->
            
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th class="bg-base-200 text-base-content font-bold">Name</th>
                            <th class="bg-base-200 text-base-content font-bold">Description</th>
                            <th class="bg-base-200 text-base-content font-bold">Quantity</th>
                            <th class="bg-base-200 text-base-content font-bold">Status</th>
                            <th class="bg-base-200 text-base-content font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr wire:key='{{$item->id}}' wire:transition class="hover">
                            <td class="font-medium">
                                {{ $item->name }}
                            </td>
                            <td>
                                {{ $item->description }}
                            </td>
                            <td>
                                {{ $item->quantity }}
                            </td>
                            <td>
                                <span class="badge {{ $item->is_available ? 'badge-success' : 'badge-error' }} gap-1">
                                    @if($item->is_available)
                                        <x-icon name="o-check-circle" class="w-4 h-4" />
                                        Available
                                    @else
                                        <x-icon name="o-x-circle" class="w-4 h-4" />
                                        Not Available
                                    @endif
                                </span>
                            </td>
                            <td class="text-right">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('crud.edit', $item->id) }}" class="btn btn-sm btn-outline btn-info">
                                        <x-icon name="o-pencil-square" class="w-4 h-4" />
                                        Edit
                                    </a>
                                    <button wire:click="editItem({{ $item->id }})" class="btn btn-sm btn-primary">
                                        <x-icon name="o-pencil" class="w-4 h-4 mr-1" />
                                        Modal Edit
                                    </button>
                                    <button wire:click="delete({{ $item->id }})" 
                                        wire:confirm="Are you sure you want to delete this item?"
                                        class="btn btn-sm btn-error">
                                        <x-icon name="o-trash" class="w-4 h-4" />
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if(count($items) == 0)
            <div class="p-12 text-center">
                <div class="inline-flex rounded-full bg-base-200 p-4 mb-4">
                    <x-icon name="o-archive-box" class="w-8 h-8 text-base-content/70" />
                </div>
                <h3 class="text-lg font-semibold">No items found</h3>
                <p class="text-base-content/70 mt-2">Start by adding some items to your inventory</p>
                <button onclick="window.location.href='{{ route('crud.form') }}'" class="btn btn-primary mt-4">
                    <x-icon name="o-plus" class="w-5 h-5 mr-2" />
                    Add First Item
                </button>
            </div>
            @endif
        </div>
    </div>
</div>
