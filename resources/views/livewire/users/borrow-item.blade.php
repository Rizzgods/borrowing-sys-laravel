<div class="max-w-4xl mx-auto">


    <!-- Header Section -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-primary">Borrow Items</h1>
        @if($user)
        <div class="mt-2 p-3 bg-base-200 rounded-lg">
            <div class="flex items-center gap-3">
                
                <div>
                    <p class="font-medium"> User: {{ $user->name }}</p>
                    @if(isset($user->email))
                    <p class="text-sm opacity-70">Email: {{ $user->email }}</p>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Borrowing Form -->
    <div class="bg-base-100 rounded-box shadow-xl p-6">
        <x-form wire:submit="saveBorrow" method="POST">
        @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- User information -->
                <div>
                    <h2 class="text-lg font-medium mb-3">Borrower Information</h2>
                    
                    <div class="mt-4">
                        <x-input 
                            type="time" 
                            label="Return Time" 
                            wire:model="returnTime" 
                            icon="o-calendar"
                            hint="When will the item be returned?"
                        />
                    </div>
                </div>
                
                <!-- Item selection -->
                <div>
                    <h2 class="text-lg font-medium mb-3">Item Selection</h2>
                    
                    <x-select 
                        label="Faculty" 
                        wire:model="facID" 
                        :options="$faculty" 
                        option-label="faculty_name"
                        placeholder="Select your professor"
                        option-value="id"
                        icon="o-academic-cap" 
                        hint="Select professor"
                    />
                    
                    


                    <div class="mt-4">
                        <x-select
                            label="Select Item to Borrow"
                            wire:model="itemID"
                            :options="$items"
                            option-label="name"
                            option-value="id"
                            placeholder="Choose an item"
                            placeholder-value="0"
                            icon="o-cube"
                            hint="Available items for borrowing"
                        />
                    </div>
                    
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="divider my-6"></div>
            
            <x-slot:actions>
                <div class="flex justify-between items-center w-full">
                    <x-button 
                        label="Cancel" 
                        class="btn-ghost" 
                        type="button"
                    />
                    <x-button 
                        label="Borrow Item" 
                        class="btn-primary" 
                        type="submit" 
                        icon="o-arrow-right" 
                        spinner="save2"
                    />
                </div>
            </x-slot:actions>
        </x-form>
    </div>
    
   
</div>