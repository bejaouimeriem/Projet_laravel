<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use App\Models\Utilisateur;
use App\Models\Test;
use App\Models\Quote;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    /**
     * Get application statistics
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatistics(): JsonResponse
    {
        try {
            $period = request()->query('period', 'year');
            
            // Calculate date range based on period
            $dateRange = $this->getDateRange($period);
            
            $stats = [
                'users' => Utilisateur::whereBetween('created_at', $dateRange)->count(),
                'chapters' => Chapitre::whereBetween('created_at', $dateRange)->count(),
                'tests' => Test::whereBetween('created_at', $dateRange)->count(),
                'quotes' => Quote::whereBetween('created_at', $dateRange)->count(),
            ];
    
            return response()->json(['data' => $stats]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    protected function getDateRange($period)
    {
        $now = Carbon::now();
        
        switch ($period) {
            case 'day':
                return [$now->copy()->startOfDay(), $now->copy()->endOfDay()];
            case 'week':
                return [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()];
            case 'month':
                return [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()];
            case 'year':
                return [$now->copy()->startOfYear(), $now->copy()->endOfYear()];
            default:
                return [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()];
        }
    }
}