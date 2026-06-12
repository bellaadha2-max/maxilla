<?php

namespace App\Http\Controllers\Apoteker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    public function index(Request $request)
    {
        $cabang = auth()->user()->cabang;
        
        $search = $request->input('search');
        
        $obats = Obat::where('cabang', $cabang)
                     ->when($search, function($query) use ($search) {
                         $query->where('nama_obat', 'like', "%{$search}%");
                     })
                     ->orderBy('nama_obat', 'asc')
                     ->paginate(15);
                     
        return view('apoteker.obat.index', compact('obats', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'harga_beli' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0', // harga jual
            'stok' => 'required|integer|min:0'
        ]);

        $cabang = auth()->user()->cabang;

        // Check for duplicates in the same branch
        $existing = Obat::where('nama_obat', $request->nama_obat)
                        ->where('cabang', $cabang)
                        ->first();
                        
        if ($existing) {
            return redirect()->back()->with('error', 'Obat dengan nama tersebut sudah ada di cabang Anda. Silakan edit stoknya.');
        }

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'harga_beli' => $request->harga_beli,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'cabang' => $cabang
        ]);

        return redirect()->route('apoteker.obat.index')->with('success', 'Data obat berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'harga_beli' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0'
        ]);

        $obat = Obat::where('id_obat', $id)->where('cabang', auth()->user()->cabang)->firstOrFail();
        
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'harga_beli' => $request->harga_beli,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect()->route('apoteker.obat.index')->with('success', 'Data obat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $obat = Obat::where('id_obat', $id)->where('cabang', auth()->user()->cabang)->firstOrFail();
        $obat->delete();

        return redirect()->route('apoteker.obat.index')->with('success', 'Data obat berhasil dihapus.');
    }
}
