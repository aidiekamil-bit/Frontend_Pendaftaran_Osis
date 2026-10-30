<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PendaftaranFrontendController extends Controller
{
    // 1. Menampilkan daftar pendaftaran (GET) - Urutkan data terbaru di atas
    public function index()
    {
        // Mengambil data dari API Project A
        $response = Http::get(env('API_BASE_URL') . '/pendaftaran-osis');
        $rawPendaftarans = $response->successful() ? $response->json()['data'] ?? [] : [];

        // Mengurutkan data agar ID terbesar / data terbaru berada di posisi paling atas
        $pendaftarans = collect($rawPendaftarans)->sortByDesc('id')->values()->all();

        return view('pendaftaran.index', compact('pendaftarans'));
    }

    // 2. Menampilkan form tambah & daftar siswa untuk pilihan (GET)
    public function create()
    {
        // Ambil data siswa dari API untuk pilihan dropdown
        $resSiswa = Http::get(env('API_BASE_URL') . '/siswa');
        $siswas = $resSiswa->successful() ? $resSiswa->json()['data'] ?? [] : [];

        return view('pendaftaran.create', compact('siswas'));
    }

    // 3. Menyimpan data pendaftaran baru (POST)
    public function store(Request $request)
    {
        $response = Http::post(env('API_BASE_URL') . '/pendaftaran-osis', [
            'siswa_id' => $request->siswa_id,
            'pilihan_bidang' => $request->pilihan_bidang,
            'motivasi' => $request->motivasi,
        ]);

        if ($response->failed()) {
            // Jika validasi gagal (misal 422), kembalikan ke form beserta pesan error-nya
            return back()->withErrors($response->json()['errors'] ?? [])->withInput();
        }

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil ditambahkan!');
    }

    // 4. Menampilkan form edit dengan data lama (GET)
    public function edit($id)
    {
        $resDetail = Http::get(env('API_BASE_URL') . "/pendaftaran-osis/{$id}");
        $resSiswa = Http::get(env('API_BASE_URL') . '/siswa');

        if ($resDetail->failed()) {
            return redirect()->route('pendaftaran.index')->with('error', 'Data tidak ditemukan.');
        }

        $pendaftaran = $resDetail->json()['data'] ?? [];
        $siswas = $resSiswa->successful() ? $resSiswa->json()['data'] ?? [] : [];

        return view('pendaftaran.edit', compact('pendaftaran', 'siswas'));
    }

    // 5. Mengubah data pendaftaran (PUT)
    public function update(Request $request, $id)
    {
        $response = Http::put(env('API_BASE_URL') . "/pendaftaran-osis/{$id}", [
            'siswa_id' => $request->siswa_id,
            'pilihan_bidang' => $request->pilihan_bidang,
            'motivasi' => $request->motivasi,
        ]);

        if ($response->failed()) {
            return back()->withErrors($response->json()['errors'] ?? [])->withInput();
        }

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil diubah!');
    }

    // 6. Menghapus data pendaftaran (DELETE)
    public function destroy($id)
    {
        Http::delete(env('API_BASE_URL') . "/pendaftaran-osis/{$id}");

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil dihapus!');
    }
}