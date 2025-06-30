<div class="flex justify-center items-center min-h-screen bg-base-200 p-6">
    <div class="card w-full max-w-4xl bg-base-100 shadow-2xl overflow-hidden">
        <div class="card-body p-0">
            <!-- Header with solid blue background -->
            <div class="bg-blue-600 text-white p-10 rounded-t-xl">
                <h2 class="text-4xl font-bold">{{ $isEditing ? 'Edit Item' : 'Create New Item' }}</h2>
                <p class="mt-3 text-xl opacity-90">{{ $isEditing ? 'Update item details' : 'Add a new item to the inventory' }}</p>
            </div>
            
            <!-- Alerts -->
            @if ($errors->any())
                <div id="error-message" class="mx-8 mt-8 mb-0">
                    <div class="alert alert-error shadow-lg p-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-8 w-8" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-lg"><strong>Error!</strong> {{ $errors->first('error') }}</span>
                    </div>
                </div>
            @endif

            @if (session()->has('success'))
                <div id="success-message" class="mx-8 mt-8 mb-0">
                    <div class="alert alert-success shadow-lg p-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-8 w-8" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-lg"><strong>Success!</strong> {{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form wire:submit.prevent='submit' class="space-y-8 p-12" wire:loading.class="opacity-50"> 
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium text-lg">Name</span>
                            <span class="label-text-alt text-error text-base">Required</span>
                        </label>
                        <input wire:model='name' type="text" placeholder="Enter item name" class="input input-bordered w-full h-14 text-lg @error('name') input-error @enderror" required />
                        @error('name') <span class="text-error text-base mt-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium text-lg">Quantity</span>
                            <span class="label-text-alt text-error text-base">Required</span>
                        </label>
                        <input wire:model='quantity' type="number" placeholder="1" min="1" class="input input-bordered w-full h-14 text-lg @error('quantity') input-error @enderror" required />
                        @error('quantity') <span class="text-error text-base mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium text-lg">Description</span>
                        <span class="label-text-alt text-base">Optional</span>
                    </label>
                    <textarea wire:model='description' placeholder="Provide details about this item..." rows="5" class="textarea textarea-bordered w-full text-lg @error('description') textarea-error @enderror"></textarea>
                    @error('description') <span class="text-error text-base mt-2">{{ $message }}</span> @enderror
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium text-lg">Availability Status</span>
                    </label>
                    <div class="flex gap-8">
                        <label class="label cursor-pointer justify-start gap-4">
                            <input wire:model='is_available' type="radio" value="1" class="radio radio-primary w-6 h-6" checked />
                            <span class="label-text text-lg">Available</span>
                        </label>
                        <label class="label cursor-pointer justify-start gap-4">
                            <input wire:model='is_available' type="radio" value="0" class="radio radio-error w-6 h-6" />
                            <span class="label-text text-lg">Not Available</span>
                        </label>
                    </div>
                    @error('is_available') <span class="text-error text-base mt-2">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-between space-x-6 pt-8 mt-8 border-t">
                    <a href="{{ route('crud.index') }}" class="btn btn-outline h-14 px-8 text-lg">
                        Cancel
                    </a>
                    <button type="submit" id="submit-btn" class="btn btn-primary h-14 px-8 text-lg" wire:loading.attr="disabled">
                        <span id="btn-text" wire:loading.class="hidden">{{ $isEditing ? 'Update Item' : 'Create Item' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" wire:loading.class="hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <svg class="w-6 h-6 ml-2 animate-spin hidden" wire:loading.class.remove="hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>