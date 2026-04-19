<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori; // 1. Pastikan Model Kategori di-import

class BerandaController extends Controller
{
    public function berandaBackend()
    {
        return view('backend.v_beranda.index', [
            'judul' => 'Beranda',
            'sub'   => 'Halaman Beranda',
        ]);
    }

    public function index()
    {
        // 2. Ambil data kategori agar loop @foreach ($kategori as $row) tidak error
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        
        $produk = Produk::where('status', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(6);

        return view('v_beranda.index', [
            'judul'    => 'Halaman Beranda', // Perbaikan typo "Halan"
            'produk'   => $produk,
            'kategori' => $kategori, // 3. Kirim variabel kategori ke view
        ]);
    }
}