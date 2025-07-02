<?php

namespace App\Http\Controllers;

class ReportSalesDistrictController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('backend.report.rpt_salesPs');
    }

    /**
     * Export filtered sales customer reports to Excel.
     * Accepts POST JSON: { period: 'YYYY-MM-DD', districts: [..] }
     */
    public function exportByCustomer()
    {
        $input = request()->json()->all();
        $period = $input['period'] ?? null;
        $districts = $input['districts'] ?? [];

        $query = \App\Models\SalesCustomerReport::query();
        if ($period) {
            $query->where('period_month', date('m', strtotime($period)))
              ->where('period_year', date('Y', strtotime($period)));
        }
        if (!empty($districts)) {
            $query->whereIn('distName', $districts);
        }

        $periodParam = $period ? date('Y-m', strtotime($period)) : null;

        return new \App\Exports\SalesReportsExport($query, $periodParam);
    }
}
