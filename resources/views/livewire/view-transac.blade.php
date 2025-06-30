<div class="max-w-6xl mx-auto p-6 bg-base-100 rounded-box shadow-lg">
    <h1 class="text-2xl font-bold text-primary mb-4">Item History</h1>

    <!-- Filter Controls -->
    <div class="mb-6">
        <div class="flex items-center">
            <span class="mr-3 font-medium">Filter by status:</span>
            <div class="btn-group">
                <button 
                    class="btn btn-sm {{ $filterStatus === 'all' ? 'btn-primary' : 'btn-outline' }}" 
                    wire:click="filter('all')"
                >
                    All Items
                </button>
                <button 
                    class="btn btn-sm {{ $filterStatus === 'borrowed' ? 'btn-primary' : 'btn-outline' }}" 
                    wire:click="filter('borrowed')"
                >
                    Borrowed
                </button>
                <button 
                    class="btn btn-sm {{ $filterStatus === 'returned' ? 'btn-primary' : 'btn-outline' }}" 
                    wire:click="filter('returned')"
                >
                    Returned
                </button>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Item</th>
                    <th>Faculty</th>
                    <th>Borrowed At</th>
                    <th>Return Time</th>
                    <th>Returned</th>
                </tr>
            </thead>
            <tbody>
                @forelse($itemHistories as $history)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $history->user->name ?? 'N/A' }}</td>
                        <td>{{ $history->item->name ?? 'N/A' }}</td>
                        <td>{{ $history->faculty->faculty_name ?? 'N/A' }}</td>
                        <td>{{ $history->borrowed_at }}</td>
                        <td>{{ $history->returnTime }}</td>
                        <td>
                            @if($history->is_returned)
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-error">No</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No items found with the current filter.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>