<div class="flex justify-center items-center min-h-screen bg-base-200">
    <div class="card w-full max-w-md bg-base-100 shadow-xl p-8">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-primary">CRUD App</h1>
            <p class="text-base-content/70 mt-1">Inventory Management System</p>
        </div>
        
        <h2 class="text-xl font-semibold text-center mb-6">Administrator Login</h2>
        
        <!-- Alert message -->
        @if($errorMessage)
        <div class="alert alert-error mb-4">
            <div class="flex items-center">
                <x-icon name="o-x-circle" class="w-5 h-5 mr-2" />
                <span>{{ $errorMessage }}</span>
            </div>
        </div>
        @endif
        
        <!-- Login Form -->
        <form wire:submit.prevent="login" class="space-y-6">
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Email</span>
                </label>
                <input type="email" wire:model="email" placeholder="Enter your email" 
                    class="input input-bordered w-full bg-base-100" required />
                @error('email') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Password</span>
                </label>
                <input type="password" wire:model="password" placeholder="••••••••" 
                    class="input input-bordered w-full bg-base-100" required />
                @error('password') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary w-full">Sign In</button>
        </form>
        
        <div class="divider my-6">Secure Admin Access</div>
        
        <div class="text-center text-sm text-base-content/70">
            <a href="{{ route('crud.register') }}" class="link link-hover link-primary">Need an account? Register here</a>
        </div>
    </div>
</div>
