<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class SlipGajiController extends Controller
{
    public function index()
    {
        return redirect('/slip-gaji/kalkulasi');
    }

    // Menampilkan halaman daftar karyawan untuk dicetak slipnya
    public function create()
    {
        $karyawan = DB::table('karyawan')->get();
        return view('slip_gaji.kalkulasi', compact('karyawan'));
    }

    public function store(Request $request)
    {
        // Fungsi simpan riwayat slip gaji bisa dikembangkan di masa depan
    }

    // MESIN PENGHITUNG OTOMATIS & CETAK PDF
    public function cetak_pdf($id_karyawan)
    {
        // 1. Ambil data master karyawan
        $karyawan = DB::table('karyawan')->where('id_karyawan', $id_karyawan)->first();
        if(!$karyawan) return "Data karyawan tidak ditemukan!";

        // 2. Ambil data rekap kehadiran bulan ini (Sistem 5 Kode)
        $periode = date('Y-m'); // Bulan berjalan
        $kehadiran = DB::table('rekap_kehadiran')
            ->where('karyawan_id', $id_karyawan)
            ->where('periode_bulan', $periode)
            ->get();

        $mt = $kehadiran->where('kode_absensi', 'MT')->sum('jumlah');
        $tmi = $kehadiran->where('kode_absensi', 'TMI')->sum('jumlah');
        $tmdl = $kehadiran->where('kode_absensi', 'TMDL')->sum('jumlah');
        $tmtd = $kehadiran->where('kode_absensi', 'TMTD')->sum('jumlah');
        $ta = $kehadiran->where('kode_absensi', 'TA')->sum('jumlah');

        // 3. Konstanta Nilai Keuangan (Bisa disesuaikan HRD)
        $uang_makan_harian = 20000;
        $uang_transport_harian = 15000;
        $potongan_terlambat = 10000;
        $hari_kerja_sebulan = 22; 

        // Logika hari masuk kerja
        $hari_tidak_masuk = $tmi + $tmtd + $ta;
        $hari_masuk = $hari_kerja_sebulan - $hari_tidak_masuk; 
        // Catatan: TMDL (Dinas Luar) tetap dihitung masuk penuh

        // 4. Kalkulasi Total Penerimaan
        $penerimaan = [
            'Gaji Pokok' => $karyawan->gaji_pokok ?? 0,
            'Tunjangan Jabatan' => $karyawan->tunjangan_jabatan ?? 0,
            'Uang Makan' => $hari_masuk * $uang_makan_harian,
            'Tunj. Kehadiran' => ($ta > 0 || $tmtd > 0) ? 0 : 200000, // Hangus jika ada Alpa/TMTD
            'Tunj. Kedisiplinan' => ($mt > 0) ? 0 : 100000, // Hangus jika ada Keterlambatan
            'Uang Lembur' => 0, // Manual entry masa depan
            'Bonus' => 0,       // Manual entry masa depan
            'Tunj. Transport' => $hari_masuk * $uang_transport_harian,
        ];

        // 5. Kalkulasi Total Potongan
        $potongan = [
            'Sakit / Ijin (TMI)' => 0, // Dianggap tidak potong gaji pokok, tapi uang makan otomatis turun
            'Alpha (TA)' => $ta * 50000, // Misal denda Alpa Rp 50.000/hari
            'BPJS Kesehatan' => $karyawan->potongan_bpjs_kesehatan ?? 0,
            'BPJS Ketenagakerjaan' => $karyawan->potongan_bpjs_ketenagakerjaan ?? 0,
            'PPh 21' => 0,
            'Keterlambatan (MT)' => $mt * $potongan_terlambat,
            'Dinas (TMDL)' => 0,
        ];

        $total_penerimaan = array_sum($penerimaan);
        $total_potongan = array_sum($potongan);
        $take_home_pay = $total_penerimaan - $total_potongan;

        // 6. Siapkan Data untuk Dikirim ke Template PDF
        $data = [
            'periode' => date('d-M-Y'),
            'nip' => $karyawan->id_karyawan,
            'nama' => $karyawan->nama_lengkap,
            'jabatan' => $karyawan->jabatan ?? '-',
            'divisi' => $karyawan->divisi ?? '-',
            'penerimaan' => $penerimaan,
            'potongan' => $potongan,
        ];

        $pdf = Pdf::loadView('slip_gaji.cetak_pdf', compact('data', 'total_penerimaan', 'total_potongan', 'take_home_pay'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('Slip-Gaji-'.$data['nama'].'.pdf');
    }
}