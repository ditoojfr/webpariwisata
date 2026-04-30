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
    $galeri           = []; // <-- TAMBAHAN 1: Inisialisasi default kosong

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

        // <-- TAMBAHAN 2: Tarik semua foto event berdasarkan id_wisata
        $galeri = \Illuminate\Support\Facades\DB::table('galeri_event')
                    ->where('id_wisata', $wisata->id_wisata)
                    ->get();
    }

    return view('admin.beranda', compact(
        'wisata',
        'totalPendapatan',
        'tiketHariIni',
        'transaksiHariIni',
        'transaksi',
        'chartLabels',
        'chartData',
        'galeri' // <-- TAMBAHAN 3: Lempar variabelnya ke view
    ));
}
    // Form edit wisata miliknya
  public function edit()
{
    $admin = DB::table('data_admin')->where('id_admin', session('user_id'))->first();

    // 1. Cek dulu admin punya wisata atau nggak
    if (!$admin || !$admin->id_wisata) {
        return redirect()->route('admin.beranda')->with('error', 'Anda belum memiliki wisata yang dikelola.');
    }

    // 2. Kalau aman, baru tarik datanya
    $wisata = DB::table('data_wisata')->where('id_wisata', $admin->id_wisata)->first();

    // Debug: Pastikan data wisata ada di database
    if (!$wisata) {
        return back()->with('error', 'Data wisata tidak ditemukan');
    }

    // 3. Tarik data galeri event
    $galeri = DB::table('galeri_event')->where('id_wisata', $admin->id_wisata)->get();

    // 4. Kirim ke view
    return view('admin.edit-wisata', compact('wisata', 'galeri'));
}

    // Update data wisata
// Update data wisata
    // Update data wisata
public function update(Request $request)
{
    $admin = DB::table('data_admin')->where('id_admin', session('user_id'))->first();
    
    if (!$admin || !$admin->id_wisata) {
        return back()->with('error', 'Anda tidak memiliki wisata untuk diedit.');
    }

    $wisata = DB::table('data_wisata')->where('id_wisata', $admin->id_wisata)->first();
    
    $validated = $request->validate([
        'nama_wisata'    => 'required|string|max:255',
        'lokasi'         => 'required|string',
        'tiket_dewasa'   => 'required|numeric',
        'tiket_anak'     => 'required|numeric',
        'biaya_asuransi' => 'nullable|numeric',
        'fasilitas'      => 'nullable|string',
        'deskripsi'      => 'required|string',
        'gambar_utama'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        'gambar_event.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // REVISI: Samakan dengan nama input/DB
    ]);

    $data = [
        'nama_wisata'    => $request->nama_wisata,
        'lokasi'         => $request->lokasi,
        'tiket_dewasa'   => $request->tiket_dewasa,
        'tiket_anak'     => $request->tiket_anak,
        'biaya_asuransi' => $request->biaya_asuransi,
        'fasilitas'      => $request->fasilitas,
        'deskripsi'      => $request->deskripsi,
    ];

    // 1. LOGIKA GAMBAR UTAMA
    if ($request->hasFile('gambar_utama')) {
        if ($wisata->gambar && file_exists(public_path('images/destinasi/' . $wisata->gambar))) {
            unlink(public_path('images/destinasi/' . $wisata->gambar));
        }
        $file = $request->file('gambar_utama');
        $namaFile = uniqid() . '_utama.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/destinasi'), $namaFile); 
        $data['gambar'] = $namaFile;
    }

// 2. // LOGIKA GAMBAR EVENT (DYNAMIC ARRAY)
if ($request->hasFile('gambar_event')) {
    $files = $request->file('gambar_event');
    $tgl_mulai = $request->input('tgl_mulai');
    $tgl_selesai = $request->input('tgl_selesai');

    foreach ($files as $index => $fileEvent) {
        // Pengecekan biar nggak error kalau file kosong
        if ($fileEvent) {
            $namaEvent = uniqid() . '_event.' . $fileEvent->getClientOriginalExtension();
            $fileEvent->move(public_path('images/destinasi'), $namaEvent); 
            
            DB::table('galeri_event')->insert([
                'id_wisata'     => $admin->id_wisata,
                'gambar_poster' => $namaEvent,
                // Ambil tanggal sesuai urutan index file-nya
                'tgl_mulai'     => $tgl_mulai[$index] ?? null,
                'tgl_selesai'   => $tgl_selesai[$index] ?? null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}

    DB::table('data_wisata')
    ->where('id_wisata', $admin->id_wisata)
    ->update($data);

    return redirect()->route('admin.beranda')->with('success', '✅ Data wisata & Galeri Event berhasil diperbarui!');
}

// Fungsi khusus buat hapus poster event satuan
    public function hapusEvent($id)
    {
        // Cari data event berdasarkan id_galeri
        $event = DB::table('galeri_event')->where('id_galeri', $id)->first();
        
        if ($event) {
            // Hapus file fisiknya dari folder
            if (file_exists(public_path('images/destinasi/' . $event->gambar_poster))) {
                unlink(public_path('images/destinasi/' . $event->gambar_poster));
            }
            // Hapus datanya dari database
            DB::table('galeri_event')->where('id_galeri', $id)->delete();
        }

        return back()->with('success', '✅ Poster event berhasil dihapus!');
    }
}