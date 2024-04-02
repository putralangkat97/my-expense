<?php

namespace App\Exports;

use App\Helpers\LocalDateFormat;
use App\Models\Transaction;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class TransactionExport implements FromCollection, WithMapping, WithHeadings, WithEvents, ShouldAutoSize
{
    use Exportable;

    public function __construct(protected string|int $user_id, private int $current_row = 1)
    {
    }

    public function collection(): Collection
    {
        return Transaction::where('user_id', $this->user_id)
            ->orderBy('transaction_date')
            ->get();
    }

    public function prepareRows($rows)
    {
        $sum = 0;
        foreach ($rows as $row) {
            $sum += $row->transaction_value;
        }
        $rows[] = [
            'is_summary' => true,
            'sum_column_3' => $sum
        ];

        return $rows;
    }

    public function map($row): array
    {
        if (isset($row['is_summary']) && $row['is_summary'] === true) {
            //Return a summary row
            return [
                'Total',
                '',
                LocalDateFormat::getLocalCurrency($row['sum_column_3']),
            ];
        } else {
            return [
                $row->transaction_name,
                LocalDateFormat::localDatetimeFormatted(value: $row->transaction_date, format: 'd/m/Y h:i A'),
                LocalDateFormat::getLocalCurrency($row->transaction_value),
            ];
        }
    }

    public function headings(): array
    {
        return [
            'Tranasaction Name',
            'Date',
            'Amount',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:' . $event->sheet->getDelegate()->getHighestColumn() . '1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                // Apply array of styles to B2:G8 cell range
                $styleArray = array(
                    'borders' => array(
                        'allBorders' => array(
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '2d2d2d']
                        )
                    ),
                    'alignment' => array(
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    ),
                );

                $col = $event->sheet->getDelegate()->getHighestColumn();
                $row = $event->sheet->getDelegate()->getHighestRow();
                $event->sheet->getDelegate()->getStyle('A1:' . $col . $row)->applyFromArray($styleArray);

                // Set first row to height 20
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(26);
            }
        ];
    }
}
