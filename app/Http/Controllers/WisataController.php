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
    public function edit($id = null)
    {
        $wisata = $this->getWisataAdmin();

        if (!$wisata) {
            return redirect()->route('admin.beranda')
                ->with('error', 'Kamu belum memiliki wisata yang dipegang.');
        }

        return view('admin.edit-wisata', compact('wisata'));
    }

    // Simpan update wisata
    public function update(Request $request, $id = null)
    {
        $wisata = $this->getWisataAdmin();

        if (!$wisata) {
            return response()->json(['success' => false, 'message' => 'Wisata tidak ditemukan.']);
        }

        $data = [
            'nama_wisata'    => $request->nama_wisata,
            'lokasi'         => $request->lokasi,
            'tiket_dewasa'   => $request->tiket_dewasa,
            'tiket_anak'     => $request->tiket_anak,
            'biaya_asuransi' => $request->biaya_asuransi,
            'fasilitas'      => $request->fasilitas,
            'deskripsi'      => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            if ($wisata->gambar) {
                Storage::delete('public/destinasi/' . $wisata->gambar);
            }
            $file     = $request->file('gambar');
            $namaFile = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/destinasi', $namaFile);
            $data['gambar'] = $namaFile;
        }

        $wisata->update($data);

        return response()->json(['success' => true, 'message' => 'Wisata berhasil diperbarui.']);
    }
}
