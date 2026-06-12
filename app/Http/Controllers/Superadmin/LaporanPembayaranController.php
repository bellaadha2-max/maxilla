<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class LaporanPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $cabang = $request->input('cabang');
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Transaksi::with(['reservasi.user', 'reservasi']);

        // Filter cabang
        if ($cabang && $cabang !== 'semua') {
            $query->whereHas('reservasi', function ($q) use ($cabang) {
                $q->where('cabang', $cabang);
            });
        }

        // Filter search (nama pasien atau ID reservasi)
        if ($search) {
            $query->whereHas('reservasi', function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('nama_pasien', 'like', "%{$search}%")
                        ->orWhere('id_reservasi', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('nama', 'like', "%{$search}%");
                        });
                });
            });
        }

        // Filter tanggal
        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $pembayaran = $query->orderByDesc('created_at')->get();

        // Hitung statistik
        $totalTransaksi = $pembayaran->count();
        $totalNominal = $pembayaran->sum('total_bayar');
        $rataRata = $totalTransaksi > 0 ? $totalNominal / $totalTransaksi : 0;

        // Get list cabang
        $cabangList = Reservasi::select('cabang')->distinct()->pluck('cabang');

        return view('superadmin.arsip_laporan.laporan-pembayaran', compact(
            'pembayaran',
            'cabangList',
            'totalTransaksi',
            'totalNominal',
            'rataRata',
            'cabang',
            'search',
            'startDate',
            'endDate'
        ));
    }
}
