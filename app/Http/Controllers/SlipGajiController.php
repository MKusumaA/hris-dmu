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

        // 3. Kalkulasi Total Penerimaan (MURNI dari Database)
        $penerimaan = [
            'Gaji Pokok' => $karyawan->gaji_pokok ?? 0,
            'Tunjangan Jabatan' => $karyawan->tunjangan_jabatan ?? 0,
            'Uang Makan' => $karyawan->tunjangan_makan ?? 0,
            'Tunj. Kehadiran' => $karyawan->tunjangan_kehadiran ?? 0,
            'Tunj. Kedisiplinan' => $karyawan->tunjangan_kedisiplinan ?? 0,
            'Uang Lembur' => $karyawan->uang_lembur ?? 0,
            'Bonus' => $karyawan->bonus ?? 0,
            'Tunj. Transport' => $karyawan->tunjangan_transport ?? 0,
        ];

        // 4. Kalkulasi Total Potongan (MURNI dari Database)
        $potongan = [
            'Sakit / Ijin' => $karyawan->potongan_sakit ?? 0, 
            'Alpha' => $karyawan->potongan_alpha ?? 0,
            'BPJS Kesehatan' => $karyawan->potongan_bpjs_kesehatan ?? 0,
            'BPJS Ketenagakerjaan' => $karyawan->potongan_bpjs_ketenagakerjaan ?? 0,
            'PPh 21' => $karyawan->potongan_pph21_2025 ?? 0,
            'Keterlambatan' => $karyawan->potongan_keterlambatan ?? 0,
            'Dinas' => $karyawan->potongan_dinas ?? 0,
        ];

        $total_penerimaan = array_sum($penerimaan);
        $total_potongan = array_sum($potongan);
        $take_home_pay = $total_penerimaan - $total_potongan;

        // 5. Siapkan Data untuk Dikirim ke Template PDF
        $data = [
            'periode' => date('d-M-Y'),
            'nip' => $karyawan->id_karyawan,
            'nama' => $karyawan->nama_lengkap,
            'jabatan' => $karyawan->jabatan ?? '-',
            'divisi' => $karyawan->divisi ?? '-',
            'penerimaan' => $penerimaan,
            'potongan' => $potongan,
            'kehadiran' => [
                'Keterlambatan' => $mt,
                'Sakit' => $tmi,
                'Ijin' => $tmtd,
                'Alpha' => $ta
            ]
        ];

        $pdf = Pdf::loadView('slip_gaji.cetak_pdf', compact('data', 'total_penerimaan', 'total_potongan', 'take_home_pay', 'karyawan'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('Slip-Gaji-'.$data['nama'].'.pdf');
    }
}