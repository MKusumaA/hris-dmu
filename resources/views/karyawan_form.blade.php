<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS - {{ $karyawan ? 'Edit' : 'Tambah' }} Karyawan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" border-blue-600 text-blue-600", " border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className = evt.currentTarget.className.replace(" border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300", " border-blue-600 text-blue-600");
        }
    </script>
</head>
<body class="bg-slate-100 font-sans">
    <div class="flex h-screen">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-white border-r border-slate-200 p-5 flex flex-col gap-2">
            <div class="text-xl font-bold text-slate-800 mb-6 px-2">HRIS Dashboard</div>
            <a href="/" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-700 rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
            <a href="/karyawan" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-700 rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Data Karyawan
            </a>
            <a href="/kehadiran" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-700 rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Rekap Kehadiran
            </a>
            <a href="/slip-gaji/kalkulasi" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-700 rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Kalkulasi Gaji
            </a>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="flex-1 p-8 overflow-y-auto">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-slate-800">{{ $karyawan ? 'Edit Karyawan' : 'Tambah Karyawan' }}</h1>
                <p class="text-slate-500 text-sm mt-1">Lengkapi informasi karyawan di bawah ini.</p>
            </div>

            <form action="{{ $karyawan ? route('karyawan.update', $karyawan->id_karyawan) : route('karyawan.store') }}" method="POST" class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <!-- TABS HEADER -->
                <div class="border-b border-slate-200">
                    <nav class="flex -mb-px px-6" aria-label="Tabs">
                        <button type="button" class="tablinks w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm border-blue-600 text-blue-600" onclick="openTab(event, 'Identitas')">Identitas & PT</button>
                        <button type="button" class="tablinks w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300" onclick="openTab(event, 'Penerimaan')">Penerimaan</button>
                        <button type="button" class="tablinks w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300" onclick="openTab(event, 'Potongan')">Potongan</button>
                        <button type="button" class="tablinks w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300" onclick="openTab(event, 'Rekening')">Rekening & Pajak</button>
                    </nav>
                </div>

                <!-- TAB 1: IDENTITAS -->
                <div id="Identitas" class="tabcontent p-6 block">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">NIP / ID Karyawan *</label>
                            <input type="text" name="id_karyawan" value="{{ $karyawan ? $karyawan->id_karyawan : '' }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" {{ $karyawan ? 'readonly' : '' }}>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap *</label>
                            <input type="text" name="nama_lengkap" value="{{ $karyawan ? $karyawan->nama_lengkap : '' }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Divisi</label>
                            <input type="text" name="divisi" value="{{ $karyawan ? $karyawan->divisi : '' }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Jabatan</label>
                            <input type="text" name="jabatan" value="{{ $karyawan ? $karyawan->jabatan : '' }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Status Kerja</label>
                            <select name="status_kerja" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <option value="TETAP" {{ ($karyawan && $karyawan->status_kerja == 'TETAP') ? 'selected' : '' }}>TETAP</option>
                                <option value="KONTRAK" {{ ($karyawan && $karyawan->status_kerja == 'KONTRAK') ? 'selected' : '' }}>KONTRAK</option>
                                <option value="MAGANG" {{ ($karyawan && $karyawan->status_kerja == 'MAGANG') ? 'selected' : '' }}>MAGANG</option>
                                <option value="PERCOBAAN" {{ ($karyawan && $karyawan->status_kerja == 'PERCOBAAN') ? 'selected' : '' }}>PERCOBAAN</option>
                                <option value="LAINYA" {{ ($karyawan && $karyawan->status_kerja == 'LAINYA') ? 'selected' : '' }}>LAINYA</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Bergabung</label>
                            <input type="date" name="tgl_bergabung" value="{{ $karyawan ? $karyawan->tgl_bergabung : '' }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Nama PT (Perusahaan)</label>
                            <input type="text" name="nama_pt" value="{{ $karyawan ? $karyawan->nama_pt : '' }}" placeholder="PT. Contoh Sejahtera" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Nama HRD (Pencetak)</label>
                            <input type="text" name="nama_hrd" value="{{ $karyawan ? $karyawan->nama_hrd : '' }}" placeholder="Budi Santoso" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- TAB 2: PENERIMAAN -->
                <div id="Penerimaan" class="tabcontent p-6 hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Gaji Pokok</label>
                            <input type="text" name="gaji_pokok" value="{{ $karyawan ? $karyawan->gaji_pokok : 0 }}" class="format-rupiah w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Tunjangan Jabatan</label>
                            <input type="text" name="tunjangan_jabatan" value="{{ $karyawan ? $karyawan->tunjangan_jabatan : 0 }}" class="format-rupiah w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Tunjangan Makan</label>
                            <input type="text" name="tunjangan_makan" value="{{ $karyawan ? $karyawan->tunjangan_makan : 0 }}" class="format-rupiah w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Tunjangan Transport</label>
                            <input type="text" name="tunjangan_transport" value="{{ $karyawan ? $karyawan->tunjangan_transport : 0 }}" class="format-rupiah w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Tunjangan Kehadiran</label>
                            <input type="text" name="tunjangan_kehadiran" value="{{ $karyawan ? $karyawan->tunjangan_kehadiran : 0 }}" class="format-rupiah w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Tunjangan Kedisiplinan</label>
                            <input type="text" name="tunjangan_kedisiplinan" value="{{ $karyawan ? $karyawan->tunjangan_kedisiplinan : 0 }}" class="format-rupiah w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Uang Lembur</label>
                            <input type="text" name="uang_lembur" value="{{ $karyawan ? $karyawan->uang_lembur : 0 }}" class="format-rupiah w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Bonus</label>
                            <input type="text" name="bonus" value="{{ $karyawan ? $karyawan->bonus : 0 }}" class="format-rupiah w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- TAB 3: POTONGAN -->
                <div id="Potongan" class="tabcontent p-6 hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Potongan Sakit</label>
                            <input type="text" name="potongan_sakit" value="{{ $karyawan ? $karyawan->potongan_sakit : 0 }}" class="format-rupiah w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Potongan Ijin</label>
                            <input type="text" name="potongan_ijin" value="{{ $karyawan ? $karyawan->potongan_ijin : 0 }}" class="format-rupiah w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Potongan Alpha</label>
                            <input type="text" name="potongan_alpha" value="{{ $karyawan ? $karyawan->potongan_alpha : 0 }}" class="format-rupiah w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Potongan Keterlambatan</label>
                            <input type="text" name="potongan_keterlambatan" value="{{ $karyawan ? $karyawan->potongan_keterlambatan : 0 }}" class="format-rupiah w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Potongan Dinas Luar</label>
                            <input type="text" name="potongan_dinas" value="{{ $karyawan ? $karyawan->potongan_dinas : 0 }}" class="format-rupiah w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Potongan BPJS Kesehatan</label>
                            <input type="text" name="potongan_bpjs_kesehatan" value="{{ $karyawan ? $karyawan->potongan_bpjs_kesehatan : 0 }}" class="format-rupiah w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Potongan BPJS Ketenagakerjaan</label>
                            <input type="text" name="potongan_bpjs_ketenagakerjaan" value="{{ $karyawan ? $karyawan->potongan_bpjs_ketenagakerjaan : 0 }}" class="format-rupiah w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Potongan PPh21 2025</label>
                            <input type="text" name="potongan_pph21_2025" value="{{ $karyawan ? $karyawan->potongan_pph21_2025 : 0 }}" class="format-rupiah w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- TAB 4: REKENING & PAJAK -->
                <div id="Rekening" class="tabcontent p-6 hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">NPWP</label>
                            <input type="text" name="npwp" value="{{ $karyawan ? $karyawan->npwp : '' }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Status PTKP</label>
                            <input type="text" name="status_ptkp" value="{{ $karyawan ? $karyawan->status_ptkp : '' }}" placeholder="TK/0, K/1, dll" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">No. BPJS Ketenagakerjaan</label>
                            <input type="text" name="no_bpjs_tk" value="{{ $karyawan ? $karyawan->no_bpjs_tk : '' }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">No. BPJS Kesehatan</label>
                            <input type="text" name="no_bpjs_kes" value="{{ $karyawan ? $karyawan->no_bpjs_kes : '' }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Bank Tujuan</label>
                            <input type="text" name="bank_tujuan" value="{{ $karyawan ? $karyawan->bank_tujuan : '' }}" placeholder="BCA / Mandiri / BRI" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Nomor Rekening</label>
                            <input type="text" name="no_rekening" value="{{ $karyawan ? $karyawan->no_rekening : '' }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Atas Nama Rekening</label>
                            <input type="text" name="atas_nama" value="{{ $karyawan ? $karyawan->atas_nama : '' }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex justify-end gap-3">
                    <a href="/karyawan" class="px-5 py-2.5 bg-white border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors">Batal</a>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        Simpan Data
                    </button>
                </div>
            </form>
        </main>
    </div>
    <script>
        function formatRupiah(angka) {
            var number_string = angka.toString().replace(/[^0-9]/g, '');
            var split = number_string.split(',');
            var sisa = split[0].length % 3;
            var rupiah = split[0].substr(0, sisa);
            var ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            
            if (ribuan) {
                var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            return rupiah;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.format-rupiah');
            
            // Format on load
            inputs.forEach(function(input) {
                if(input.value) {
                    input.value = formatRupiah(input.value);
                }
                
                // Format on type
                input.addEventListener('input', function(e) {
                    this.value = formatRupiah(this.value);
                });
            });

            // Unmask on submit
            const form = document.querySelector('form');
            if(form) {
                form.addEventListener('submit', function() {
                    inputs.forEach(function(input) {
                        input.value = input.value.replace(/\./g, '');
                    });
                });
            }
        });
    </script>
</body>
</html>
