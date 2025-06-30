<div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-br from-blue-100 to-indigo-100 p-8 relative overflow-hidden">
    @if (session('success'))
    <div id="success-message" class="mb-6 transition-opacity duration-500 ease-in-out opacity-100">
        <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-md relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline ml-2">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    
    <!-- RFID Capture Modal -->
    <x-modal wire:model="BorrowModal" title="RFID Authentication" persistent separator>
        <div class="p-6">
            <div class="flex items-center mb-6">
                <x-icon name="o-credit-card" class="h-10 w-10 text-primary mr-4" />
                <div>
                    <h3 class="text-xl font-semibold">{{ $processingMessage }}</h3>
                    @if($isCapturing)
                        <p class="text-gray-600 mt-2">Please scan your RFID card or tag to continue.</p>
                    @endif
                </div>
            </div>
            
            <div class="flex justify-center items-center p-6">
                <x-loading class="loading-infinity text-primary" size="lg" />
            </div>
                <!-- Hidden input to capture RFID without showing it -->
            @if($isCapturing)
                <input 
                    type="password" 
                    wire:model.live="BorrowRFID"
                    class="opacity-0 h-0 w-0 absolute -z-10 pointer-events-none"
                    id="rfidInput"
                    autofocus
                />
            @endif
            
            @if($isCapturing)
                <!-- Visual indicator of RFID input (masked) -->
                <div class="flex justify-center space-x-2 my-4">
                    @for($i = 0; $i < 10; $i++)
                        <div class="w-4 h-8 rounded-full {{ $i < strlen($BorrowRFID) ? 'bg-primary' : 'bg-gray-200' }}"></div>
                    @endfor
                </div>
            @endif
        </div>
        <x-slot:actions>
            <x-button 
                label="Cancel" 
                @click="$wire.BorrowModal = false; $wire.isCapturing = false;" 
                class="btn-outline" 
            />
        </x-slot:actions>
    </x-modal>

    <!-- Decorative circles in background -->
    <div class="absolute top-20 left-20 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-20 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl"></div>
    
    <!-- Main card with increased size and glass effect -->
    <div class="card w-full max-w-4xl bg-white/80 backdrop-blur-md shadow-2xl p-16 z-10 border border-white/20 relative">
        <!-- Corner accents -->
        <div class="absolute top-0 left-0 w-24 h-24 border-t-4 border-l-4 border-primary -mt-2 -ml-2 rounded-tl-lg"></div>
        <div class="absolute bottom-0 right-0 w-24 h-24 border-b-4 border-r-4 border-accent -mb-2 -mr-2 rounded-br-lg"></div>
        
        <!-- Logo with enhanced presentation -->
        <div class="flex justify-center mb-10">
            <div class="relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-primary to-accent blur-sm opacity-30 rounded-full"></div>
                <img 
                    src="{{ asset('storage/images/user/logo.png') }}" 
                    alt="Logo" 
                    class="relative h-52 w-auto object-contain drop-shadow-lg"
                    onerror="this.onerror=null; this.src='https://placehold.co/400x200/607D8B/FFFFFF?text=COMPANY+LOGO';"
                >
            </div>
        </div>
        
        <!-- Title with gradient text -->
        <h1 class="text-5xl font-bold text-center mb-14 text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent">PLV BORROWING SYSTEM</h1>
        
        <!-- Button container with enhanced spacing -->
        <div class="flex flex-col gap-10 sm:flex-row sm:justify-center mb-8">
            <!-- Borrow button with hover effects -->
            <x-button 
            icon="o-arrow-down-tray" 
            label="Borrow Item" 
            class="btn-primary text-2xl py-10 px-16 w-full sm:w-80 h-auto transform transition-all duration-300 hover:scale-105 hover:shadow-lg"
            right-icon="o-chevron-right"
            wire:click="startBorrow"
            />
            
            <!-- Receive button with hover effects -->
            <x-button 
                icon="o-arrow-up-tray" 
                label="Return Item" 
                class="btn-accent text-2xl py-10 px-16 w-full sm:w-80 h-auto transform transition-all duration-300 hover:scale-105 hover:shadow-lg"
                right-icon="o-chevron-right"
                wire:click="startReturn"
            />
        </div>

        <!-- Divider with subtle decoration -->
        <div class="flex items-center justify-center my-12">
            <div class="h-px w-1/4 bg-gradient-to-r from-transparent via-base-content/30 to-transparent"></div>
            <span class="text-2xl text-base-content/70 px-6">User Portal</span>
            <div class="h-px w-1/4 bg-gradient-to-r from-transparent via-base-content/30 to-transparent"></div>
        </div>
        
        <!-- Information text -->
        <p class="text-center text-base-content/60 italic">
            Select an option above to continue
        </p>
    </div>
    
    <!-- Footer with more detailed information -->
    <div class="mt-8 text-center text-gray-700 bg-white/50 backdrop-blur-sm px-6 py-3 rounded-full">
        <p>© {{ date('Y') }} PLV Borrowing System. All rights reserved.</p>
    </div>


    
</div>



<script>
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none'; 
        }
    }, 6000); 
</script>