<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\ItemHistory;
use App\Models\User;
use App\Models\items;
use App\Models\facList;

class Reports extends Component
{
    public $activeTab = 'users';
    public $userId;
    public $facId;
    public $UserList;
    public $facList;
    public $itemId;
    public $items;
    public $topItems;
    public $tab;
    public $topUsers;
    public $dateToday;

    public function mount()
    {
        // Load basic data
        $this->UserList = User::all();
        $this->facList = facList::all();
        $this->items = items::all();
        $this->dateToday = now();
        // Load data for general tab
        $this->loadGeneralReportData();
    }

    public function exportToPDF(){
        $this->loadGeneralReportData();
        $dateToday = now();
        
        // Generate PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.gen-report', [
            'topItems' => $this->topItems,
            'topUsers' => $this->topUsers
        ]);
        
        // Return PDF for download
        return response()->streamDownload(
            fn () => print($pdf->output()),
            "General Report-{{$dateToday}}_.pdf"
        );
    }
    /**
     * Load data needed for the general reports tab
     */
    private function loadGeneralReportData()
    {
        // Get top borrowed items
        $this->topItems = items::orderBy('BorrowCount', 'desc')->take(3)->get();
        
        try {
            // Get top users who borrowed items
            $this->topUsers = ItemHistory::select('user_id', DB::raw('COUNT(*) as total_entries'))
                ->whereNotNull('user_id')
                ->groupBy('user_id')
                ->orderByDesc('total_entries')
                ->take(3)
                ->with('user')
                ->get();
                
            \Log::info('TopUsers loaded: ' . $this->topUsers->count());
        } catch (\Exception $e) {
            \Log::error('Error loading top users: ' . $e->getMessage());
            $this->topUsers = collect();
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        
        // Refresh data when switching to general tab
        if ($tab === 'general') {
            $this->loadGeneralReportData();
        }
        
        $this->dispatch('tabChanged', ['tab' => $tab]);
    }

    public function render()
    {
        return view('livewire.reports');
    }

    public function overdueItems()
    {
        $now = now();
        $overdueItems = ItemHistory::where('is_borrowed', true)
            ->where('is_returned', false)
            ->whereDate('returnTime', '<', $now)
            ->with(['user', 'item', 'faculty'])
            ->get();
            
            return view('livewire.reports');
    }

    public function generateHistory($userId)
    {
        $history = ItemHistory::where('user_id', $userId)
            ->with(['item', 'faculty'])  // Changed from 'fac_list' to 'faculty'
            ->orderBy('borrowed_at', 'desc')
            ->get();
            
        $user = User::findOrFail($userId);
        
        // Generate PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.user-history', [
            'history' => $history,
            'user' => $user
        ]);
        
        // Return PDF for download
        return response()->streamDownload(
            fn () => print($pdf->output()),
            "{$user->name}_history_.pdf"
        );
    }


    public function generateFacHistory($facId)
    {
        $history = ItemHistory::where('fac_id', $facId)
            ->with(['item', 'user'])  // Include user relationship to show who borrowed the items
            ->orderBy('borrowed_at', 'desc')
            ->get();
            
        $faculty = facList::findOrFail($facId);  // Find the specific faculty
        
        // Generate PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.fac-history', [
            'history' => $history,
            'faculty' => $faculty  // Pass the faculty object, not the collection
        ]);
        
        // Return PDF for download
        return response()->streamDownload(
            fn () => print($pdf->output()),
            "{$faculty->faculty_name}_history.pdf"  // Use the found faculty name
        );
    }

    public function generateItemHistory($itemId)
    {
        $history = ItemHistory::where('fac_id', $facId)
            ->with(['item'])  // Include user relationship to show who borrowed the items
            ->orderBy('borrowed_at', 'desc')
            ->get();
            
        $faculty = facList::findOrFail($facId);  // Find the specific faculty
        
        // Generate PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.fac-history', [
            'history' => $history,
            'items' => $items  // Pass the faculty object, not the collection
        ]);
        
        // Return PDF for download
        return response()->streamDownload(
            fn () => print($pdf->output()),
            "{$items->name}_history.pdf"  // Use the found faculty name
        );
    }

}
