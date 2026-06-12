<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class KasirPaymentHistoryController extends Controller
{
    public function index(Request $request)
    {
        $cabang = auth()->user()->cabang;
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $riwayatPembayaran = Reservasi::with(['user', 'transaksi'])
            ->where('cabang', $cabang)
            ->whereHas('transaksi')
            ->when($search, function ($query, $search) {
                $query->where(function ($sub) use ($search) {
                    $sub->where('nama_pasien', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('nama', 'like', "%{$search}%");
                        });
                });
            })
            ->when($startDate, function ($query, $startDate) {
                $query->whereDate('updated_at', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                $query->whereDate('updated_at', '<=', $endDate);
            })
            ->orderByDesc('updated_at')
            ->get();

        return view('kasir.riwayat_pembayaran', compact('riwayatPembayaran', 'search', 'startDate', 'endDate'));
    }
}
