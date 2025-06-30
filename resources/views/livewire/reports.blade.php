<div class="p-6">
    <div class="max-w-full mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-primary">Reports</h2>
                <p class="mt-2 text-base-content/70">View borrowing information</p>
            </div>
            
            <!-- Toggle Buttons -->
            <div class="tabs tabs-boxed">
                <button wire:click="setActiveTab('users')" class="tab {{ $activeTab == 'users' ? 'tab-active bg-primary text-white font-bold rounded-full' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Users
                </button>
                <button wire:click="setActiveTab('faculty')" class="tab {{ $activeTab == 'faculty' ? 'tab-active bg-primary text-white font-bold rounded-full' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Faculties
                </button>

                <button wire:click="setActiveTab('general')" class="tab {{ $activeTab == 'general' ? 'tab-active bg-primary text-white font-bold rounded-full' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    General
                </button>

            </div>
        </div>
        

        
        <!-- User Table -->
        <div wire:loading.remove wire:target="setActiveTab">
            @if($activeTab == 'users')
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th class="bg-base-200 text-base-content font-bold">Name</th>
                            <th class="bg-base-200 text-base-content font-bold">Email</th>
                            <th class="bg-base-200 text-base-content font-bold">Dept</th>
                            <th class="bg-base-200 text-base-content font-bold">Generate History</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($UserList as $user)
                        <tr wire:key='user-{{$user->id}}' class="hover">
                            <td class="font-medium">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->dept }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" wire:click="generateHistory({{ $user->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg> Generate
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            
            
            <!-- Faculty Table -->
            @if($activeTab == 'faculty')
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th class="bg-base-200 text-base-content font-bold">Faculty Name</th>
                            <th class="bg-base-200 text-base-content font-bold">Faculty ID</th>
                            <th class="bg-base-200 text-base-content font-bold">Department</th>
                            <th class="bg-base-200 text-base-content font-bold">Generate History</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facList as $faculty)
                        <tr wire:key='faculty-{{$faculty->id}}' class="hover">
                            <td class="font-medium">{{ $faculty->faculty_name }}</td>
                            <td>{{ $faculty->facultyID}}</td>
                            <td>{{ $faculty->Dept }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" wire:click="generateFacHistory({{ $faculty->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg> Generate
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif


                        <!-- General Section -->
            @if($activeTab == 'general')
            <div class="overflow-x-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Top Items List - Replacing Chart -->
                    <div class="bg-base-100 rounded-lg shadow-lg p-6">
                        <h4 class="text-lg font-bold mb-4">Most Borrowed Items</h4>
                        <div class="overflow-x-auto">
                            <ul class="menu bg-base-200 w-full rounded-box">
                                @foreach($topItems as $index => $item)
                                <li class="hover:bg-base-300 {{ $index === 0 ? 'border-l-4 border-primary' : '' }}">
                                    <div class="flex justify-between items-center w-full p-2">
                                        <div class="flex items-center">
                                            <span class="badge badge-primary mr-2">{{ $index + 1 }}</span>
                                            <span class="font-medium">{{ $item->name }}</span>
                                        </div>
                                        <div>
                                            <span class="badge badge-lg">{{ $item->BorrowCount }} times</span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Top Users Section (replacing Top Items Details) -->
                    <div class="bg-base-100 rounded-lg shadow-lg p-6">
                        <h4 class="text-lg font-bold mb-4">Most Active Users</h4>
                        <div class="overflow-x-auto">
                            @if($topUsers->isEmpty())
                                <div class="text-center py-4 text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p>No borrowing history available</p>
                                </div>
                            @else
                                <table class="table table-zebra w-full">
                                    <thead>
                                        <tr>
                                            <th class="bg-base-200 text-base-content font-bold">Rank</th>
                                            <th class="bg-base-200 text-base-content font-bold">User</th>
                                            <th class="bg-base-200 text-base-content font-bold">Department</th>
                                            <th class="bg-base-200 text-base-content font-bold">Borrowed Items</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topUsers as $index => $userStat)
                                            @if($userStat->user)
                                                <tr class="{{ $index === 0 ? 'bg-primary/10' : '' }}">
                                                    <td class="font-bold">{{ $index + 1 }}</td>
                                                    <td class="font-medium">{{ $userStat->user->name }}</td>
                                                    <td>{{ $userStat->user->dept ?? 'N/A' }}</td>
                                                    <td>
                                                        <span class="badge badge-primary badge-lg">{{ $userStat->total_entries }}</span>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Moved PDF button outside both tables -->
                <div class="mt-6 text-center">
                    <button class="btn btn-secondary btn-lg" wire:click="exportToPDF">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM14 2v6h6M16 13H8m4 4H8m8-8H8" />
                        </svg>
                        Convert to PDF
                    </button>
                </div>
            </div>
            @endif

        </div>
    </div>

</div>