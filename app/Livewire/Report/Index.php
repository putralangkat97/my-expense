<?php

namespace App\Livewire\Report;

use App\Exports\TransactionExport;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    // TODO: implement filter by date range

    public function export()
    {
        return (new TransactionExport(user_id: Auth::user()->id))
            ->download('tranasction_export.xlsx');
    }

    public function render()
    {
        return view('livewire.report.index');
    }
}
