<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Models\Riwayat;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class riwayatController extends Controller
{
    public function exportPDF(Request $request)
    {
        $imageData = $request->chart_image;
        // Menghapus bagian awal dari string base64 yang tidak diperlukan untuk konversi
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $decodedImageData = base64_decode($imageData);

        // Menyimpan gambar ke dalam storage
        Storage::disk('s3')->put('chart.png', $decodedImageData);
        $dataIn = Riwayat::select('tanggal', 'id_barang', 'jenis_riwayat', \DB::raw('SUM(jumlah) as total'), 'nama_barang')
            ->where('jenis_riwayat', 'masuk') // Filter hanya untuk jenis riwayat 'masuk'
            ->groupBy('tanggal', 'jenis_riwayat', 'id_barang', 'nama_barang')
            ->orderBy('tanggal', 'asc')
            ->get();
        $dataOut = Laporan::select('tanggal_laporan', 'id_barang', \DB::raw('SUM(jumlah_barang) as total'), 'nama_barang')
            ->groupBy('tanggal_laporan', 'id_barang', 'nama_barang')
            ->orderBy('tanggal_laporan', 'asc')
            ->get();
        $pdf = PDF::loadView('pdf.view', compact('dataIn', 'dataOut'));
        return $pdf->download('riwayatTraficTokoman-' . now() . '.pdf');
    }
    public function index()
    {
        // Query untuk mengambil data masuk dari Riwayat
        $dataMasuk = \DB::table('riwayat')
            ->select(
                \DB::raw('DATE(tanggal) as tanggal'),
                \DB::raw('SUM(jumlah) as totalMasuk'),
                \DB::raw('0 as totalKeluar')  // Kolom dummy untuk totalKeluar
            )
            ->where('jenis_riwayat', 'masuk')
            ->groupBy(\DB::raw('DATE(tanggal)'));

        // Query untuk mengambil data keluar dari Laporan
        $dataKeluar = \DB::table('laporan')
            ->select(
                \DB::raw('DATE(tanggal_laporan) as tanggal'),
                \DB::raw('0 as totalMasuk'),  // Kolom dummy untuk totalMasuk
                \DB::raw('SUM(jumlah_barang) as totalKeluar')
            )
            ->groupBy(\DB::raw('DATE(tanggal_laporan)'));

        // Menggabungkan kedua query dengan UNION ALL dan menghitung total masuk dan keluar
        $combinedData = \DB::query()
            ->select('tanggal', \DB::raw('SUM(totalMasuk) as totalMasuk'), \DB::raw('SUM(totalKeluar) as totalKeluar'))
            ->fromSub(function ($query) use ($dataMasuk, $dataKeluar) {
                $query->fromSub($dataMasuk, 'masuk')
                    ->unionAll($dataKeluar);
            }, 'combined')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();
        // Total penjualan hari ini untuk barang keluar
        $totalToday = Laporan::whereDate('laporan.tanggal_laporan', Carbon::today())
            ->sum(\DB::raw('laporan.total'));

        // Total penjualan kemarin untuk barang keluar
        $totalYesterday = Laporan::whereDate('laporan.tanggal_laporan', Carbon::yesterday())
            ->sum(\DB::raw('laporan.total'));
        $dataThisMonth = Laporan::whereMonth('laporan.tanggal_laporan', '=', Carbon::now()->month)
            ->whereYear('laporan.tanggal_laporan', '=', Carbon::now()->year)
            ->sum(\DB::raw('laporan.total'));
        $dataLastMonth = Laporan::whereMonth('laporan.tanggal_laporan', '=', Carbon::now()->month - 1)
            ->whereYear('laporan.tanggal_laporan', '=', Carbon::now()->year)
            ->sum(\DB::raw('laporan.total'));
        $percentageThisMonth = 0;
        if ($dataLastMonth != 0) {
            $percentageThisMonth = ($dataThisMonth - $dataLastMonth) / $dataLastMonth * 100;
        }
        // Menghitung perbedaan dalam persen
        $differencePercentage = 0;
        if ($totalYesterday != 0) { // Hindari pembagian dengan nol
            $differencePercentage = (($totalToday - $totalYesterday) / $totalYesterday) * 100;
        }
        $barangPenjualan = Laporan::all()->sum('jumlah_barang');
        $riwayatTerbaru = Riwayat::select([
            'riwayat.*',
            \DB::raw("DATE_FORMAT(riwayat.created_at, '%H:%i') as jam_dibuat"),
            \DB::raw("CASE 
                        WHEN riwayat.jenis_riwayat = 'keluar' THEN stok_barangs.harga_jual * riwayat.jumlah
                        WHEN riwayat.jenis_riwayat = 'masuk' THEN stok_barangs.harga_beli * riwayat.jumlah
                      END as total_harga")
        ])
            ->join('stok_barangs', 'stok_barangs.id', '=', 'riwayat.id_barang')
            ->orderBy('riwayat.created_at', 'desc')
            ->take(5)
            ->get();

        return view(
            "dashboard",
            [
                'riwayatTerbaru' => $riwayatTerbaru,
                'totalToday' => $totalToday,
                'differencePercentage' => number_format($differencePercentage, 2, '.', ','),
                'dataThisMonth' => $dataThisMonth,
                'percentageThisMonth' => number_format($percentageThisMonth, 2, '.', ','),
                'barangPenjualan' => $barangPenjualan,
                'combinedData' => $combinedData
            ]
        );
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
            \DB::raw("CASE 
                        WHEN riwayat.jenis_riwayat = 'keluar' THEN stok_barangs.harga_jual * riwayat.jumlah
                        WHEN riwayat.jenis_riwayat = 'masuk' THEN stok_barangs.harga_beli * riwayat.jumlah
                      END as total_harga")
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
    public function filterResults(Request $request)
    {
        $query = Riwayat::select([
            'riwayat.*',
            \DB::raw("DATE_FORMAT(riwayat.created_at, '%H:%i') as jam_dibuat"),
            \DB::raw("CASE 
                        WHEN riwayat.jenis_riwayat = 'keluar' THEN stok_barangs.harga_jual * riwayat.jumlah
                        WHEN riwayat.jenis_riwayat = 'masuk' THEN stok_barangs.harga_beli * riwayat.jumlah
                      END as total_harga")
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

        if ($request->has('week') && $request->week == 'today') {
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
