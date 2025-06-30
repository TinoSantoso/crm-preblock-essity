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
        $data = $this->fetchSalesPanelReports();
        return view('backend.report.rpt_salesPs');
    }

    protected function fetchSalesPanelReports()
    {
        return \DB::table('sales_panel_reports')->get();
    }
}
