<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riwayat;
use Carbon\Carbon;
class riwayatController extends Controller
{

    public function index()
    {
        $riwayatTerbaru = Riwayat::select([
            'riwayat.*',
            \DB::raw("DATE_FORMAT(riwayat.created_at, '%H:%i') as jam_dibuat"),
            \DB::raw("stok_barangs.harga_beli * riwayat.jumlah as total_harga")
        ])
            ->join('stok_barangs', 'stok_barangs.id', '=', 'riwayat.id_barang')
            ->orderBy('riwayat.created_at', 'desc')
            ->take(5)
            ->get();

        return view("dashboard", ['riwayatTerbaru' => $riwayatTerbaru]);
    }
    public function tampilkan()
    {
        $years = Riwayat::selectRaw('YEAR(tanggal) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        $months = Riwayat::selectRaw('MONTH(tanggal) as month')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $riwayatTerbaru = Riwayat::select([
            'riwayat.*',
            \DB::raw("DATE_FORMAT(riwayat.created_at, '%H:%i') as jam_dibuat"),
            \DB::raw("stok_barangs.harga_beli * riwayat.jumlah as total_harga")
        ])
            ->join('stok_barangs', 'stok_barangs.id', '=', 'riwayat.id_barang')
            ->orderBy('riwayat.created_at', 'desc')
            ->paginate(5);

        return view('riwayat.index', [
            'riwayatTerbaru' => $riwayatTerbaru,
            'years' => $years,
            'months' => $months
        ]);
    }
    public function filterResults(Request $request){
        $query = Riwayat::select([
            'riwayat.*',
            \DB::raw("DATE_FORMAT(riwayat.created_at, '%H:%i') as jam_dibuat"),
            \DB::raw("stok_barangs.harga_beli * riwayat.jumlah as total_harga")
        ])
            ->join('stok_barangs', 'stok_barangs.id', '=', 'riwayat.id_barang')
            ->orderBy('riwayat.created_at', 'desc');
        $years = Riwayat::selectRaw('YEAR(tanggal) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        $months = Riwayat::selectRaw('MONTH(tanggal) as month')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
        
        if($request->has('week')&&$request->week=='today'){
            $query->whereDate('tanggal', '=', date('Y-m-d'));
            
           
            if ($request->has('jenis_riwayat') && $request->jenis_riwayat != '') {
                $query->where('riwayat.jenis_riwayat', $request->jenis_riwayat);
            }
            $riwayatTerbaru = $query->paginate(5);
            return view('riwayat.index', [
                'riwayatTerbaru' => $riwayatTerbaru,
                'years' => $years,
                'months' => $months
            ]);
        }
        if ($request->has('jenis_riwayat') && $request->jenis_riwayat != '') {
            $query->where('riwayat.jenis_riwayat', $request->jenis_riwayat);
        }
        
       
        if ($request->has('year') && $request->year != '') {
            $query->whereYear('riwayat.created_at', $request->year);
        }
    
        if ($request->has('month') && $request->month != '') {
            $query->whereMonth('riwayat.created_at', $request->month);
        }
    
        if ($request->has('week') && $request->week != '') {
            $year = $request->year ?? date('Y');
            $month = $request->month ?? date('m');
            $firstOfMonth = Carbon::createFromDate($year, $month, 1);
            $daysInMonth = $firstOfMonth->daysInMonth;
    
            // Calculate the start and end dates for the selected week
            $startDay = ($request->week - 1) * 7 + 1;
            $endDay = $startDay + 6;
    
            // Adjust the end day for the last week of the month
            if ($endDay > $daysInMonth) {
                $endDay = $daysInMonth;
            }
    
            $startDate = $firstOfMonth->copy()->addDays($startDay - 1);
            $endDate = $firstOfMonth->copy()->addDays($endDay - 1);
    
            $query->whereBetween('riwayat.created_at', [$startDate, $endDate]);
        }
        
    
        $results = $query->paginate(5); // Adjust pagination as needed
    
        // Append all current request parameters to the pagination links
    
        return view('riwayat.index', [
            'riwayatTerbaru' => $results,
            'years' => $years,
            'months' => $months
        ]);
    }

}
