<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function index()
    {
        // 1. DATA PEGAWAI (Revisi: Hanya mengambil admin dan investigator)
        $dataPegawai = User::whereIn('peran', ['admin', 'investigator'])->latest()->get();

        // 2. DATA PENGGUNA (PELAPOR)
        $dataPengguna = User::where('peran', 'pelapor')->latest()->get();

        // 3. DATA KASUS
        $dataKasus = Pengaduan::latest()->get();

        // 4. DATA TINGKAT PELANGGARAN 
        $dataPelanggaran = Pengaduan::whereNotNull('tingkat_pelanggaran')->latest()->get();

        // 5. DATA BUKTI
        $dataBukti = Pengaduan::where(function($q) {
                                $q->whereNotNull('lampiran_bukti')
                                ->orWhereNotNull('bukti_investigasi');
                            })
                            ->latest()
                            ->get();

        // 6. DATA INVESTIGASI
        $dataInvestigasi = Pengaduan::where(function($q) {
                                        $q->whereNotNull('fakta_lapangan')
                                        ->orWhereNotNull('hasil_investigasi');
                                    })
                                    ->latest()
                                    ->get();

        // 7. ANTREAN INPUT TINDAK LANJUT (Kasus sudah diinvestigasi, menunggu sanksi Admin)
        $kasusPerluTindakLanjut = Pengaduan::whereNotNull('kesimpulan')
                                        ->whereNull('tindak_lanjut')
                                        ->latest()
                                        ->get();

        // 8. DATA TINDAK LANJUT (Data arsip sanksi yang SUDAH diinput oleh Admin)
        $dataTindakLanjut = Pengaduan::whereNotNull('tindak_lanjut')
                                    ->latest()
                                    ->get();

        // 9. DATA TANGGAPAN (Menu ke-6 Layanan Pengaduan)
        $dataTanggapan = Tanggapan::with(['pengaduan', 'user'])
                                    ->latest()
                                    ->get();

        return view('admin.dashboard', compact(
            'dataPegawai', 
            'dataPengguna', 
            'dataKasus', 
            'dataPelanggaran', 
            'dataBukti', 
            'dataInvestigasi',
            'kasusPerluTindakLanjut',
            'dataTindakLanjut',
            'dataTanggapan'
        ));
    }

    // FUNGSI MENAMPILKAN BERKAS KASUS (DETAIL ADMIN)
    public function show($id)
    {
        // Ambil data pengaduan berdasarkan ID
        $pengaduan = Pengaduan::findOrFail($id);
        
        // Lempar ke tampilan admin.detail
        return view('admin.detail', compact('pengaduan'));
    }

    // FUNGSI HALAMAN INPUT TINDAK LANJUT
    public function editTindakLanjut($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if (empty($pengaduan->kesimpulan)) {
            return redirect()->route('admin.dashboard')->with('error', 'Kasus ini belum memiliki Kertas Kerja / Kesimpulan dari tim Investigator!');
        }

        return view('admin.tindaklanjut', compact('pengaduan'));
    }

    public function updateTindakLanjut(Request $request, $id)
    {
        $validatedData = $request->validate([
            'pihak_penindak'        => 'required|string',
            'tanggal_tindak_lanjut' => 'required|date',
            'tindak_lanjut'         => 'required|string',
        ]);

        /** @var \App\Models\Pengaduan $kasus */
        $kasus = \App\Models\Pengaduan::findOrFail($id);

        $kasus->update(array_merge($validatedData, [
            'status' => 'selesai'
        ]));

        return redirect()->route('admin.dashboard')->with('success', 'Data Tindak Lanjut / Keputusan berhasil disimpan!');
    }

    // CRUD MASTER DATA PEGAWAI
    public function storePegawai(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'peran' => 'required|in:admin,investigator', // Revisi: petugas_verifikasi dihapus
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'peran' => $request->peran,
        ]);

        return redirect()->back()->with('success', 'Data Pegawai Berhasil Ditambahkan');
    }

    public function updatePegawai(Request $request, $id)
    {
        $pegawai = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$pegawai->id,
            'peran' => 'required|in:admin,investigator', // Revisi: petugas_verifikasi dihapus
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'peran' => $request->peran,
        ];

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8']);
            $data['password'] = Hash::make($request->password);
        }

        $pegawai->update($data);

        return redirect()->back()->with('success', 'Data Pegawai berhasil diperbarui!');
    }

    public function destroyPegawai($id)
    {
        if (Auth::id() == $id) {
            return redirect()->back()->with('error', 'Peringatan: Anda tidak bisa menghapus akun Anda sendiri!');
        }

        $pegawai = User::findOrFail($id);
        $pegawai->delete();
        
        return redirect()->back()->with('success', 'Data Pegawai berhasil dihapus!');
    }

    // CRUD MASTER DATA PELAPOR
    public function storePengguna(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'peran' => 'pelapor', 
        ]);

        return redirect()->back()->with('success', 'Data Masyarakat berhasil ditambahkan!');
    }

    public function updatePengguna(Request $request, $id)
    {
        $pengguna = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$pengguna->id,
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8']);
            $data['password'] = Hash::make($request->password);
        }

        $pengguna->update($data);

        return redirect()->back()->with('success', 'Data Masyarakat berhasil diperbarui!');
    }

    public function destroyPengguna($id)
    {
        $pengguna = User::findOrFail($id);
        $pengguna->delete();
        return redirect()->back()->with('success', 'Data Masyarakat berhasil dihapus!');
    }

    public function updateKasus(Request $request, $id)
    {
        $request->validate([
            'judul_laporan' => 'required|string|max:255',
            'kategori_laporan' => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'lokasi_kejadian' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'status' => 'required|string',
        ]);

        $kasus = \App\Models\Pengaduan::findOrFail($id);
        $kasus->update([
            'judul_laporan' => $request->judul_laporan,
            'kategori_laporan' => $request->kategori_laporan,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'isi_laporan' => $request->isi_laporan,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Data Kasus berhasil diperbarui!');
    }

    public function destroyKasus($id)
    {
        $kasus = \App\Models\Pengaduan::findOrFail($id);
        if ($kasus->lampiran_bukti && Storage::disk('public')->exists($kasus->lampiran_bukti)) {
            Storage::disk('public')->delete($kasus->lampiran_bukti);
        }
        if ($kasus->bukti_investigasi && Storage::disk('public')->exists($kasus->bukti_investigasi)) {
            Storage::disk('public')->delete($kasus->bukti_investigasi);
        }
        $kasus->delete();

        return redirect()->back()->with('success', 'Data Kasus beserta buktinya berhasil dihapus permanen!');
    }

    public function updatePelanggaran(Request $request, $id)
    {
        $request->validate([
            'tingkat_pelanggaran' => 'nullable|string',
            'investigator_id' => 'nullable|exists:users,id',
            'catatan_verifikator' => 'nullable|string',
        ]);

        $kasus = \App\Models\Pengaduan::findOrFail($id);
        $kasus->update([
            'tingkat_pelanggaran' => $request->tingkat_pelanggaran,
            'investigator_id' => $request->investigator_id,
            'catatan_verifikator' => $request->catatan_verifikator,
        ]);

        return redirect()->back()->with('success', 'Data Verifikasi Pelanggaran berhasil diperbarui!');
    }

    public function destroyPelanggaran($id)
    {
        $kasus = \App\Models\Pengaduan::findOrFail($id);
        $kasus->update([
            'tingkat_pelanggaran' => null,
            'investigator_id'     => null,
            'catatan_verifikator' => null,
            'status'              => 'masuk', 
        ]);

        return redirect()->back()->with('success', 'Data Verifikasi berhasil direset!');
    }

    public function updateInvestigasi(Request $request, $id)
    {
        $request->validate([
            'fakta_lapangan' => 'required|string',
            'pihak_terlibat' => 'required|string',
            'kesimpulan' => 'required|string',
        ]);

        $kasus = \App\Models\Pengaduan::findOrFail($id);
        $kasus->update([
            'fakta_lapangan' => $request->fakta_lapangan,
            'pihak_terlibat' => $request->pihak_terlibat,
            'kesimpulan' => $request->kesimpulan,
        ]);

        return redirect()->back()->with('success', 'Kertas kerja investigasi berhasil dikoreksi!');
    }

    public function destroyInvestigasi($id)
    {
        $kasus = \App\Models\Pengaduan::findOrFail($id);
        if ($kasus->bukti_investigasi && Storage::disk('public')->exists($kasus->bukti_investigasi)) {
            Storage::disk('public')->delete($kasus->bukti_investigasi);
        }

        $kasus->update([
            'fakta_lapangan' => null,
            'pihak_terlibat' => null,
            'kesimpulan' => null,
            'bukti_investigasi' => null,
            'status' => 'investigasi', 
        ]);

        return redirect()->back()->with('success', 'Data investigasi berhasil direset. Status kasus dikembalikan menjadi Proses Investigasi.');
    }

    public function destroyTindakLanjut($id)
    {
        $kasus = \App\Models\Pengaduan::findOrFail($id);
        
        $kasus->update([
            'pihak_penindak'        => null,
            'tanggal_tindak_lanjut' => null,
            'tindak_lanjut'         => null,
            'status'                => 'selesai', 
        ]);

        return redirect()->back()->with('success', 'Keputusan Tindak Lanjut berhasil dibatalkan. Data dikembalikan ke tabel Antrean Input Tindak Lanjut.');
    }

    public function updateBukti(Request $request, $id)
    {
        $request->validate([
            'lampiran_bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'bukti_investigasi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        /** @var \App\Models\Pengaduan $kasus */
        $kasus = \App\Models\Pengaduan::findOrFail($id);

        if ($request->hasFile('lampiran_bukti')) {
            if ($kasus->lampiran_bukti && Storage::disk('public')->exists($kasus->lampiran_bukti)) {
                Storage::disk('public')->delete($kasus->lampiran_bukti);
            }
            $kasus->lampiran_bukti = $request->file('lampiran_bukti')->store('bukti_pengaduan', 'public');
        }
        if ($request->hasFile('bukti_investigasi')) {
            if ($kasus->bukti_investigasi && Storage::disk('public')->exists($kasus->bukti_investigasi)) {
                Storage::disk('public')->delete($kasus->bukti_investigasi);
            }
            $kasus->bukti_investigasi = $request->file('bukti_investigasi')->store('bukti_investigasi', 'public');
        }

        $kasus->save();

        return redirect()->back()->with('success', 'File bukti berhasil diganti/diperbarui!');
    }

    public function destroyBukti($id)
    {
        /** @var \App\Models\Pengaduan $kasus */
        $kasus = \App\Models\Pengaduan::findOrFail($id);
        if ($kasus->lampiran_bukti && Storage::disk('public')->exists($kasus->lampiran_bukti)) {
            Storage::disk('public')->delete($kasus->lampiran_bukti);
        }
        if ($kasus->bukti_investigasi && Storage::disk('public')->exists($kasus->bukti_investigasi)) {
            Storage::disk('public')->delete($kasus->bukti_investigasi);
        }
        $kasus->update([
            'lampiran_bukti' => null,
            'bukti_investigasi' => null
        ]);

        return redirect()->back()->with('success', 'Seluruh file bukti pada kasus ini berhasil dihapus permanen!');
    }

    public function updateTanggapan(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kategori_tanggapan' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        $tanggapan = \App\Models\Tanggapan::findOrFail($id);
        $tanggapan->update($validatedData);

        return redirect()->back()->with('success', 'Pesan tanggapan berhasil diperbarui!');
    }

    public function destroyTanggapan($id)
    {
        $tanggapan = \App\Models\Tanggapan::findOrFail($id);
        if ($tanggapan->lampiran_tambahan && Storage::disk('public')->exists($tanggapan->lampiran_tambahan)) {
            Storage::disk('public')->delete($tanggapan->lampiran_tambahan);
        }

        $tanggapan->delete();

        return redirect()->back()->with('success', 'Tanggapan beserta lampirannya berhasil dihapus permanen!');
    }

    // FUNGSI CETAK PDF DETAIL KASUS
    public function cetakPdf($id)
    {
        $pengaduan = \App\Models\Pengaduan::with(['user', 'investigator'])->findOrFail($id);
        $pdf = pdf::loadView('admin.pdf_detail', compact('pengaduan'));

        // Fitur Pratinjau Diaktifkan
        return $pdf->stream('Laporan_SAPA_PEMKO_'. $pengaduan->kode_tiket . '.pdf', ['Attachment' => false]);
    }

    // FUNGSI CETAK REKAPITULASI
    public function cetakRekap($kategori)
    {
        $title = "";
        $data = [];

        switch ($kategori) {
            case 'kasus':
                $title = "LAPORAN REKAPITULASI DATA KASUS";
                $data = \App\Models\Pengaduan::with('user')->latest()->get();
                break;
            case 'pelanggaran':
                $title = "LAPORAN REKAPITULASI DATA PELANGGARAN";
                $data = \App\Models\Pengaduan::whereNotNull('tingkat_pelanggaran')->latest()->get();
                break;
            case 'investigasi':
                $title = "LAPORAN REKAPITULASI DATA HASIL INVESTIGASI";
                $data = \App\Models\Pengaduan::whereNotNull('fakta_lapangan')->latest()->get();
                break;
            case 'tindaklanjut':
                $title = "LAPORAN REKAPITULASI DATA TINDAK LANJUT";
                $data = \App\Models\Pengaduan::whereNotNull('tindak_lanjut')->latest()->get();
                break;
            case 'bukti':
                $title = "LAPORAN REKAPITULASI ARSIP LAMPIRAN BUKTI";
                $data = \App\Models\Pengaduan::whereNotNull('lampiran_bukti')->orWhereNotNull('bukti_investigasi')->latest()->get();
                break;
            case 'tanggapan':
                $title = "LAPORAN REKAPITULASI DATA TANGGAPAN PELAPOR";
                $data = \App\Models\Tanggapan::with(['pengaduan', 'user'])->latest()->get();
                break;
            case 'pegawai':
                $title = "LAPORAN REKAPITULASI DATA PEGAWAI INTERNAL";
                // Revisi: Hanya memuat admin & investigator
                $data = \App\Models\User::whereIn('peran', ['admin', 'investigator'])->latest()->get();
                break;
            case 'pengguna':
                $title = "LAPORAN REKAPITULASI DATA PELAPOR";
                $data = \App\Models\User::where('peran', 'pelapor')->orWhereNull('peran')->latest()->get();
                break;

            default:
                return redirect()->back()->with('error', 'Kategori rekapitulasi tidak valid!');
        }

        $pdf = Pdf::loadView('admin.pdf_rekap', compact('data', 'title', 'kategori'));
        
        // Fitur Pratinjau Diaktifkan
        return $pdf->stream('Rekap_' . $kategori . '_' . date('Ymd') . '.pdf', ['Attachment' => false]);
    }

    // FUNGSI KHUSUS: ADMIN EKSEKUSI VERIFIKASI & DISPOSISI KASUS
    public function verifikasiKasus(Request $request, $id)
    {
        $kasus = Pengaduan::findOrFail($id);

        if ($request->keputusan == 'tolak') {
            $kasus->update([
                'status' => 'ditolak',
                'catatan_verifikator' => $request->catatan_verifikator
            ]);
            $pesan = 'Laporan kasus berhasil ditolak & ditutup!';
        } else {
            $request->validate([
                'tingkat_pelanggaran' => 'required|string',
                'investigator_id' => 'required|exists:users,id',
            ]);

            $kasus->update([
                'status' => 'investigasi',
                'tingkat_pelanggaran' => $request->tingkat_pelanggaran,
                'investigator_id' => $request->investigator_id,
                'catatan_verifikator' => $request->catatan_verifikator
            ]);
            $pesan = 'Laporan berhasil diverifikasi & didisposisikan ke meja Investigator!';
        }

        return redirect()->back()->with('success', $pesan);
    }
}