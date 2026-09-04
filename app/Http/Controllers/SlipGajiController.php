<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\RekapKehadiran;
use App\Models\SlipGaji;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SlipGajiController extends Controller
{
    public function index()
    {
        // Menampilkan daftar slip gaji yang sudah dibuat
        $slips = SlipGaji::with('karyawan')->get();
        return view('slip_gaji.index', compact('slips'));
    }

    public function create($id_karyawan)
    {
        // Mengambil data karyawan & kehadiran untuk bahan kalkulasi
        $karyawan = Karyawan::where('id_karyawan', $id_karyawan)->firstOrFail();
        $kehadiran = RekapKehadiran::where('karyawan_id', $id_karyawan)->first();

        return view('slip_gaji.kalkulasi', compact('karyawan', 'kehadiran'));
    }

    public function store(Request $request)
    {
        // Proses simpan hasil kalkulasi ke database
        SlipGaji::create($request->all());
        return redirect()->route('slip_gaji.index')->with('success', 'Slip Gaji berhasil dibuat!');
    }

    public function cetak_pdf($id)
    {
        // DATA SEMENTARA: Ini disamakan persis dengan foto desain yang di-ACC
        // Nanti kita ganti ini dengan data asli dari database
        $data = [
            'periode' => '28-Jul-26',
            'nip' => '1.012.010',
            'nama' => 'Erlin Puspitasari',
            'jabatan' => 'Manager General Affair',
            'divisi' => 'General Affair',
            'penerimaan' => [
                'Gaji Pokok' => 3000000,
                'Jabatan' => 0,
                'Makan' => 220000,
                'Kehadiran' => 440000,
                'Kedisiplinan' => 0,
                'Lembur' => 0,
                'Bonus' => 0,
                'Transport' => 0,
            ],
            'potongan' => [
                'Sakit' => 0,
                'Ijin' => 0,
                'Alpha' => 0,
                'BPJS Kesehatan' => 52888,
                'BPJS Ketenagakerjaan' => 100653,
                'PPH 21 TAHUN 2025' => 0,
                'Keterlambatan' => 0,
                'Dinas' => 0,
            ]
        ];

        // Menghitung otomatis
        $total_penerimaan = array_sum($data['penerimaan']);
        $total_potongan = array_sum($data['potongan']);
        $take_home_pay = $total_penerimaan - $total_potongan;

        // Memanggil desain PDF
        $pdf = Pdf::loadView('slip_gaji.cetak_pdf', compact('data', 'total_penerimaan', 'total_potongan', 'take_home_pay'));
        
        // Mengatur ukuran kertas (A4)
        $pdf->setPaper('A4', 'portrait');

        // Menampilkan PDF di browser
        return $pdf->stream('Slip-Gaji-'.$data['nama'].'.pdf');
    }
}