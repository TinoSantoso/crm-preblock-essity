<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Excel;


class SalesReportsExport implements FromQuery, WithHeadings, WithMapping, Responsable, WithStyles
{
    use \Maatwebsite\Excel\Concerns\Exportable;

    private $fileName;
    private $writerType = Excel::XLSX;
    protected $query;

    /**
     * @param Builder $query
     * @param string|null $period Format: YYYY-MM (e.g. 2025-07)
     */
    public function __construct(Builder $query, $period = null)
    {
        $this->query = $query;
        $this->fileName = $this->generateFileName($period);
    }

    /**
     * Apply styles to the worksheet (bold first row)
     */
    public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
    {
        // Bold first row (row 1)
        $sheet->getStyle('A1:S2')->getFont()->setBold(true);
        // Center and merge currentMonth (L1:O1) and lastYearMonth (P1:S1)
        $sheet->mergeCells('L1:O1');
        $sheet->mergeCells('P1:S1');
        $sheet->getStyle('L1:O1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('P1:S1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Apply background color to both heading rows (A1:S2) to cover LY Nett
        $sheet->getStyle('A1:S2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFE6EEF5');
    }
    

    /**
     * Generate file name based on period (YYYY-MM)
     */
    private function generateFileName($period)
    {
        if ($period && preg_match('/^\\d{4}-\\d{2}$/', $period)) {
            // Get last date of the month
            $lastDate = date('t-m-Y', strtotime($period.'-01'));
            return 'Sales By Customer '.$lastDate.'.xlsx';
        }
        return 'Sales By Customer.xlsx';
    }

    public function query()
    {
        return $this->query;
    }

    public function headings(): array
    {
        // Get current month and last year month for headings
        $period = null;
        if (preg_match('/Sales By Customer (\d{4}-\d{2}-\d{2})\.xlsx/', $this->fileName, $matches)) {
            $period = $matches[1];
        }
        $currentMonth = $period ? date('F Y', strtotime($period)) : 'Current Month';
        $lastYearMonth = $period ? date('F Y', strtotime('-1 year', strtotime($period))) : 'Last Year';

        // First row: merged headings
        $headings[] = [
            'District',
            'Area Name',
            'Employee Name',
            'Original Branch',
            'Branch',
            'Channel Name',
            'Reference Code',
            'Customer Code',
            'Customer Name',
            'Product Group',
            'Product Name',
            $currentMonth, '', '', '',
            $lastYearMonth, '', '', '',
        ];

        // Second row: sub-headings
        $headings[] = [
            '', '', '', '', '', '', '', '', '', '', '',
            'Gross', 'Qty', 'Discount', 'Nett',
            'LY Gross', 'LY Qty', 'LY Discount', 'LY Nett',
        ];

        return $headings;
    }

    public function map($row): array
    {
        return [
            $row->distName ?? '',
            $row->areaName ?? '',
            $row->empName ?? '',
            $row->oriBranchName ?? '',
            $row->branchName ?? '',
            $row->channelName ?? '',
            $row->referenceCode ?? '',
            $row->custCode ?? '',
            $row->custName ?? '',
            $row->prodGroup ?? '',
            $row->prod_name ?? '',
            $row->gross ?? 0,
            $row->qty ?? 0,
            $row->discount ?? 0,
            $row->netSales ?? 0,
            $row->ly_gross ?? 0,
            $row->ly_qty ?? 0,
            $row->ly_discount ?? 0,
            $row->ly_netSales ?? 0,
        ];
    }
}
