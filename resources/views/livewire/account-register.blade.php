<div class="flex justify-center items-center min-h-screen bg-base-200 p-6">
    <div class="card w-full max-w-4xl bg-base-100 shadow-2xl overflow-hidden">
        <!-- Header with solid blue background -->
        <div class="bg-blue-600 text-white p-10 text-center">
            
            <p class="text-xl opacity-90">Inventory Management System</p>
            <div class="mt-6 inline-block px-8 py-4 bg-white/20 rounded-lg">
                <h2 class="text-3xl font-semibold">Account Registration</h2>
            </div>
        </div>
        
        <div class="p-12">
            <!-- Error messages -->
            @if ($errors->any())
                <div class="alert alert-error mb-10 shadow-lg p-6">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-8 w-8" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <div>
                            <ul class="list-disc list-inside text-lg ml-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Success message -->
            @if (session()->has('message'))
                <div class="alert alert-success mb-10 shadow-lg p-6">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-8 w-8" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <p class="text-lg ml-2">{{ session('message') }}</p>
                    </div>
                </div>
            @endif
            
            <!-- Register Form -->
            <form wire:submit.prevent="register" class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium text-lg">Full Name</span>
                            <span class="label-text-alt text-error text-base">Required</span>
                        </label>
                        <div class="flex relative">
                            <div class="bg-gray-100 border-y border-l border-gray-300 rounded-l-lg flex items-center justify-center px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text" wire:model="name" placeholder="Enter your full name" 
                                class="input input-bordered rounded-l-none flex-1 h-14 text-lg @error('name') input-error @enderror" required />
                        </div>
                        @error('name') <span class="text-error text-base mt-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium text-lg">Email Address</span>
                            <span class="label-text-alt text-error text-base">Required</span>
                        </label>
                        <div class="flex relative">
                            <div class="bg-gray-100 border-y border-l border-gray-300 rounded-l-lg flex items-center justify-center px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input type="email" wire:model="email" placeholder="your.email@example.com" 
                                class="input input-bordered rounded-l-none flex-1 h-14 text-lg @error('email') input-error @enderror" required />
                        </div>
                        @error('email') <span class="text-error text-base mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium text-lg">Password</span>
                            <span class="label-text-alt text-error text-base">Required</span>
                        </label>
                        <div class="flex relative">
                            <div class="bg-gray-100 border-y border-l border-gray-300 rounded-l-lg flex items-center justify-center px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" wire:model="password" placeholder="••••••••" 
                                class="input input-bordered rounded-l-none flex-1 h-14 text-lg @error('password') input-error @enderror" required />
                        </div>
                        @error('password') <span class="text-error text-base mt-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium text-lg">Confirm Password</span>
                            <span class="label-text-alt text-error text-base">Required</span>
                        </label>
                        <div class="flex relative">
                            <div class="bg-gray-100 border-y border-l border-gray-300 rounded-l-lg flex items-center justify-center px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" wire:model="password_confirmation" placeholder="••••••••" 
                                class="input input-bordered rounded-l-none flex-1 h-14 text-lg" required />
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary w-full text-xl h-16 mt-10">
                    <span>Create Account</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </form>
            

        </div>
    </div>
</div>