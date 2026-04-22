<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    // Tampilkan semua wisata (admin beranda)
    public function index()
    {
        $destinasi = Wisata::orderBy('id_wisata', 'asc')->get();
        return view('admin.beranda', compact('destinasi'));
    }

    // Form tambah wisata
    public function create()
    {
        return view('admin.tambah-wisata');
    }

    // Simpan wisata baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_wisata' => 'required|string|max:255',
            'lokasi'      => 'required|string',
            'gambar'      => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $gambarNama = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $gambarNama = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/destinasi', $gambarNama);
        }

        Wisata::create([
            'nama_wisata'    => $request->nama_wisata,
            'lokasi'         => $request->lokasi,
            'tiket_dewasa'   => $request->harga_dewasa ?? 0,
            'tiket_anak'     => $request->harga_anak ?? 0,
            'biaya_asuransi' => $request->biaya_asuransi ?? 500,
            'fasilitas'      => $request->fasilitas ?? '',
            'deskripsi'      => $request->deskripsi ?? '',
            'nama_admin'     => session('admin_name'),
            'gambar'         => $gambarNama,
        ]);

        return redirect('/admin/beranda')->with('success', 'Destinasi berhasil ditambahkan.');
    }

    // Form edit wisata
    public function edit($id)
    {
        $wisata = Wisata::findOrFail($id);
        return view('admin.edit-wisata', compact('wisata'));
    }

    // Update wisata
    public function update(Request $request, $id)
    {
        $wisata = Wisata::findOrFail($id);

        $data = [
            'nama_wisata'    => $request->nama_wisata,
            'lokasi'         => $request->lokasi,
            'tiket_dewasa'   => $request->tiket_dewasa,
            'tiket_anak'     => $request->tiket_anak,
            'biaya_asuransi' => $request->biaya_asuransi,
            'fasilitas'      => $request->fasilitas,
            'deskripsi'      => $request->deskripsi,
            'nama_admin'     => $request->nama_admin,
        ];

        // Ganti gambar jika ada file baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($wisata->gambar) {
                Storage::delete('public/destinasi/' . $wisata->gambar);
            }
            $file = $request->file('gambar');
            $gambarNama = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/destinasi', $gambarNama);
            $data['gambar'] = $gambarNama;
        }

        $wisata->update($data);

        return response()->json(['success' => true, 'message' => 'Data wisata berhasil diperbarui.']);
    }

    // Hapus wisata
    public function destroy($id)
    {
        $wisata = Wisata::findOrFail($id);

        // Hapus file gambar dari storage
        if ($wisata->gambar) {
            Storage::delete('public/destinasi/' . $wisata->gambar);
        }

        $wisata->delete();

        return redirect('/admin/beranda')->with('success', 'Destinasi berhasil dihapus.');
    }
}