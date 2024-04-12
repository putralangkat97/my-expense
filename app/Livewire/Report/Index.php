<?php

namespace App\Livewire\Report;

use App\Exports\TransactionExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public $selectedMonth;
    public $selectedYear;

    #[Computed]
    public function months()
    {
        $data = [];
        for ($i = 0; $i < 12; $i++) {
            $month = Carbon::today()->startOfYear()->addMonth($i)->format('F');
            $data[] = [
                'name' => $month,
                'value' => $i + 1 > 9 ? $i + 1 : "0" . $i + 1,
            ];
        }

        return $data;
    }

    #[Computed]
    public function years()
    {
        $data = [];
        for ($i = 24; $i <= 30; $i++) {;
            $data[] = 20 . $i;
        }

        return $data;
    }

    public function mount()
    {
        $this->selectedYear = date('Y');
        $this->selectedMonth = date('m');
    }

    public function export()
    {
        $this->validate([
            'selectedMonth' => 'required',
            'selectedYear' => 'required',
        ], [
            'selectedMonth.required' => __('Please select month'),
            'selectedYear.required' => __('Please select year'),
        ]);

        return (new TransactionExport(
            user_id: Auth::user()->id,
            month: $this->selectedMonth,
            year: $this->selectedYear
        ))->download(date('Y-m-d-H-i-s', strtotime(now())) . '-export.xlsx');
    }

    public function clear()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.report.index');
    }
}
