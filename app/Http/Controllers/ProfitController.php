<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modal;
use App\Models\Laporan;
use Carbon\Carbon;

class ProfitController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->input('period', 'day');
        $fromDate = $request->input('from_date', Carbon::now()->subWeek()->toDateString());
        $toDate = $request->input('to_date', Carbon::now()->toDateString());

        switch ($period) {
            case 'week':
                $fromDate = Carbon::parse($fromDate)->startOfWeek();
                $toDate = Carbon::parse($toDate)->endOfWeek();
                break;
            case 'year':
                $fromDate = Carbon::parse($fromDate)->startOfYear();
                $toDate = Carbon::parse($toDate)->endOfYear();
                break;
            default:
                // Default to day
                break;
        }

        // Hitung total modal dari tanggal yang dipilih
        $totalModal = Modal::whereBetween('Tanggal', [$fromDate, $toDate])->sum('Total_modal');

        // Hitung total penjualan dari tanggal yang dipilih
        $totalPenjualan = Laporan::whereBetween('tanggal_laporan', [$fromDate, $toDate])->sum('total');

        // Hitung profit
        $profit = $totalPenjualan - $totalModal;

        return view("hitungProfit", compact('period', 'fromDate', 'toDate', 'profit'));
    }

    public function getProfitData($period, $fromDate, $toDate)
    {
        switch ($period) {
            case 'week':
                $fromDate = Carbon::parse($fromDate)->startOfWeek();
                $toDate = Carbon::parse($toDate)->endOfWeek();
                break;
            case 'year':
                $fromDate = Carbon::parse($fromDate)->startOfYear();
                $toDate = Carbon::parse($toDate)->endOfYear();
                break;
            default:
                // Default to day
                break;
        }

        // Hitung total modal dari tanggal yang dipilih
        $totalModal = Modal::whereBetween('Tanggal', [$fromDate, $toDate])->sum('Total_modal');

        // Hitung total penjualan dari tanggal yang dipilih
        $totalPenjualan = Laporan::whereBetween('tanggal_laporan', [$fromDate, $toDate])->sum('total');

        // Hitung profit
        $profit = $totalPenjualan - $totalModal;

        return [
            'period' => $period,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'profit' => $profit,
        ];
    }



}
