<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrmVisit;
use App\Models\CrmVisitDetail;

class PreblockMclVisitController extends Controller
{
    /**
     * Get a list of crm_visits with their details, filtered by emp_id, period (year & month), and visit date.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Intentionally left empty
    }
    /**
     * Retrieve a list of crm_visits with their details, filtered by emp_id, period (year & month), and visit date.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVisits(Request $request)
    {
        $query = CrmVisit::with(['details']);

        // Filter by emp_id
        if ($request->filled('emp_id')) {
            $query->where('emp_id', $request->input('emp_id'));
        }

        // Filter by period (year & month) extracted from 'periode' (format: YYYY-MM)
        if ($request->filled('periode')) {
            [$year, $month] = explode('-', $request->input('periode'));
            $query->where('year', $year)->where('month', $month);
        }

        // Filter by visit date (in details)
        if ($request->filled('visit_date')) {
            $query->whereHas('details', function($q) use ($request) {
                $q->whereDate('visit_date', $request->input('visit_date'));
            });
        }

        $visits = $query->get();

        return response()->json($visits);
    }
}
