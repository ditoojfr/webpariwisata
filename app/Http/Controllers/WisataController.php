<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class WisataController extends Controller
{
    // Helper: ambil wisata milik admin yang login
    private function getWisataAdmin()
    {
        $admin = DB::table('data_admin')
            ->where('id_admin', session('user_id'))
            ->first();

        if (!$admin || !$admin->id_wisata) return null;

        return Wisata::find($admin->id_wisata);
    }

    // Beranda admin — tampilkan wisata + statistik
    public function index()
    {
        $wisata = $this->getWisataAdmin();

        // Default kosong kalau tidak ada wisata
        $totalPendapatan  = 0;
        $tiketHariIni     = 0;
        $transaksiHariIni = 0;
        $transaksi        = collect();
        $chartLabels      = [];
        $chartData        = [];

        if ($wisata) {
            $today = Carbon::today();

            // Total pendapatan semua waktu
            $totalPendapatan = Transaksi::where('id_wisata', $wisata->id_wisata)
                ->sum('harga_total');

            // Tiket hari ini
            $tiketHariIni = Transaksi::where('id_wisata', $wisata->id_wisata)
                ->whereDate('tanggal_pesan', $today)
                ->sum('jml_tiket');

            // Jumlah transaksi hari ini
            $transaksiHariIni = Transaksi::where('id_wisata', $wisata->id_wisata)
                ->whereDate('tanggal_pesan', $today)
                ->count();

            // Semua transaksi wisata ini (terbaru dulu)
            $transaksi = Transaksi::where('id_wisata', $wisata->id_wisata)
                ->orderBy('tanggal_pesan', 'desc')
                ->get();

            // Data chart 7 hari terakhir
            for ($i = 6; $i >= 0; $i--) {
                $tanggal       = Carbon::today()->subDays($i);
                $chartLabels[] = $tanggal->format('d M');
                $chartData[]   = Transaksi::where('id_wisata', $wisata->id_wisata)
                    ->whereDate('tanggal_pesan', $tanggal)
                    ->sum('harga_total');
            }
        }

        return view('admin.beranda', compact(
            'wisata',
            'totalPendapatan',
            'tiketHariIni',
            'transaksiHariIni',
            'transaksi',
            'chartLabels',
            'chartData'
        ));
    }

    // Form edit wisata miliknya
   public function edit()
{
    $adminId = session('user_id');
    $admin = DB::table('data_admin')->where('id_admin', $adminId)->first();

    if (!$admin || !$admin->id_wisata) {
        return redirect()->route('admin.beranda')->with('error', 'Anda belum memiliki wisata yang dikelola.');
    }

    // Ambil data wisata
    $wisata = DB::table('data_wisata')->where('id_wisata', $admin->id_wisata)->first();

    // Debug: Pastikan data ada
    if (!$wisata) {
        return back()->with('error', 'Data wisata tidak ditemukan');
    }

    // Kirim ke view dengan variabel $wisata
    return view('admin.edit-wisata', compact('wisata'));
}

    // Update data wisata
   public function update(Request $request)
{
    // 1. Ambil admin dari session
    $admin = DB::table('data_admin')->where('id_admin', session('user_id'))->first();
    
    if (!$admin || !$admin->id_wisata) {
        return back()->with('error', 'Anda tidak memiliki wisata untuk diedit.');
    }

    // 2. Cari data wisata
    $wisata = DB::table('data_wisata')->where('id_wisata', $admin->id_wisata)->first();
    
    if (!$wisata) {
        return back()->with('error', 'Data wisata tidak ditemukan.');
    }

    // 3. Validasi input
    $validated = $request->validate([
        'nama_wisata' => 'required|string|max:255',
        'lokasi' => 'required|string',
        'tiket_dewasa' => 'required|numeric',
        'tiket_anak' => 'required|numeric',
        'biaya_asuransi' => 'nullable|numeric',
        'fasilitas' => 'nullable|string',
        'deskripsi' => 'required|string',
        'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
    ]);

    // 4. Siapkan data update
    $data = [
        'nama_wisata' => $request->nama_wisata,
        'lokasi' => $request->lokasi,
        'tiket_dewasa' => $request->tiket_dewasa,
        'tiket_anak' => $request->tiket_anak,
        'biaya_asuransi' => $request->biaya_asuransi,
        'fasilitas' => $request->fasilitas,
        'deskripsi' => $request->deskripsi,
    ];

    // 5. Handle upload GAMBAR UTAMA
    if ($request->hasFile('gambar_utama')) {
        // Hapus gambar lama
        if ($wisata->gambar && Storage::disk('public')->exists('destinasi/' . $wisata->gambar)) {
            Storage::disk('public')->delete('destinasi/' . $wisata->gambar);
        }
        
        // Simpan gambar baru
        $file = $request->file('gambar_utama');
        $namaFile = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/destinasi', $namaFile);
        $data['gambar'] = $namaFile;
    }

    // 6. UPDATE KE DATABASE
    DB::table('data_wisata')
        ->where('id_wisata', $admin->id_wisata)
        ->update($data);

    return back()->with('success', '✅ Data wisata berhasil diperbarui!');
}
}