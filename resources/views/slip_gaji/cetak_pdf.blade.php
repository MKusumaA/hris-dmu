<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Slip Gaji</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; color: #000; }
        .tabel-utama { width: 100%; border: 2px solid black; border-collapse: collapse; }
        .tabel-utama td { padding: 4px; }
        .border-b { border-bottom: 2px solid black; }
        .border-r { border-right: 2px solid black; }
        .garis-tipis { border: 1px solid black; }
        
        .tabel-dalam { width: 100%; border-collapse: collapse; }
        .tabel-dalam td { padding: 2px 4px; }
        
        .bold { font-weight: bold; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .bg-abu { background-color: #e5e5e5; }
        
        /* Kotak Khusus */
        .kotak-thp { border: 2px solid black; padding: 5px; font-weight: bold; width: 250px; }
    </style>
</head>
<body>

<table class="tabel-utama">
    <!-- BARIS 1: HEADER -->
    <tr class="border-b">
        <td colspan="2">
            <table style="width: 100%;">
                <tr>
                    <td class="bold" style="font-size: 14px; width: 50%;">SLIP GAJI</td>
                    <td class="text-right bold" style="width: 50%;">Periode : &nbsp;&nbsp;&nbsp; {{ $data['periode'] }}</td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- BARIS 2: DATA KARYAWAN & PERIJINAN -->
    <tr class="border-b">
        <td style="width: 50%; vertical-align: top;" class="border-r">
            <table class="tabel-dalam garis-tipis" style="margin-bottom: 5px;">
                <tr><td colspan="3" class="text-center bold bg-abu">DATA KARYAWAN</td></tr>
                <tr><td width="30%">NIP</td><td width="5%">:</td><td>{{ $data['nip'] }}</td></tr>
                <tr><td>NAMA</td><td>:</td><td class="bold">{{ $data['nama'] }}</td></tr>
                <tr><td>JABATAN</td><td>:</td><td>{{ $data['jabatan'] }}</td></tr>
                <tr><td>DIVISI</td><td>:</td><td>{{ $data['divisi'] }}</td></tr>
            </table>
        </td>
        <td style="width: 50%; vertical-align: top;">
            <table class="tabel-dalam garis-tipis" style="width: 70%; float: right;">
                <tr><td colspan="3" class="text-center bold bg-abu">REKAP PERIJINAN</td></tr>
                <tr><td width="50%">Keterlambatan</td><td width="5%">:</td><td class="text-right">-</td></tr>
                <tr><td>Sakit</td><td>:</td><td class="text-right">-</td></tr>
                <tr><td>Ijin</td><td>:</td><td class="text-right">-</td></tr>
                <tr><td>Alpha</td><td>:</td><td class="text-right">-</td></tr>
            </table>
        </td>
    </tr>

    <!-- BARIS 3: PENERIMAAN & POTONGAN -->
    <tr>
        <td class="border-r" style="vertical-align: top;">
            <div class="bold" style="margin-bottom: 5px; text-decoration: underline;">PENERIMAAN</div>
            <table class="tabel-dalam">
                @foreach($data['penerimaan'] as $nama => $jumlah)
                <tr>
                    <td width="40%">{{ $nama }}</td>
                    <td width="5%">:</td>
                    <td class="text-right">{{ $jumlah > 0 ? number_format($jumlah, 0, ',', '.') : '-' }}</td>
                </tr>
                @endforeach
            </table>
        </td>
        <td style="vertical-align: top;">
            <div class="bold" style="margin-bottom: 5px; text-decoration: underline;">POTONGAN</div>
            <table class="tabel-dalam">
                @foreach($data['potongan'] as $nama => $jumlah)
                <tr>
                    <td width="50%">{{ $nama }}</td>
                    <td width="5%">:</td>
                    <td class="text-right">{{ $jumlah > 0 ? number_format($jumlah, 0, ',', '.') : '-' }}</td>
                </tr>
                @endforeach
            </table>
        </td>
    </tr>

    <!-- BARIS 4: TOTAL -->
    <tr class="border-b garis-tipis bg-abu bold">
        <td class="border-r">
            <table class="tabel-dalam">
                <tr>
                    <td width="45%">TOTAL PENERIMAAN</td>
                    <td class="text-right">{{ number_format($total_penerimaan, 0, ',', '.') }}</td>
                </tr>
            </table>
        </td>
        <td>
            <table class="tabel-dalam">
                <tr>
                    <td width="55%">TOTAL POTONGAN</td>
                    <td class="text-right">{{ number_format($total_potongan, 0, ',', '.') }}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<!-- BAGIAN BAWAH: THP & TTD -->
<div style="margin-top: 10px;">
    <table style="width: 100%;">
        <tr>
            <td style="width: 60%; vertical-align: top;">
                <div class="kotak-thp bg-abu">
                    <table style="width: 100%; font-weight: bold;">
                        <tr>
                            <td>TAKE HOME PAY</td>
                            <td class="text-right">{{ number_format($take_home_pay, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
                
                <table style="margin-top: 20px; font-size: 11px;">
                    <tr><td width="100">Ditransfer ke</td><td width="10">:</td><td class="bold">Muamalat</td></tr>
                    <tr><td>Nomer Rekening</td><td>:</td><td>-</td></tr>
                    <tr><td>Atas nama</td><td>:</td><td>Erlin Puspitasari</td></tr>
                </table>
            </td>
            <td style="width: 40%; vertical-align: bottom; text-align: center;">
                <div>PT. Daya Matahari Utama</div>
                <br><br><br><br>
                <div class="bold" style="text-decoration: underline;">Erlin Puspitasari, SE</div>
            </td>
        </tr>
    </table>
</div>

</body>
</html>