<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Pendaftaran OSIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen selection:bg-purple-500 selection:text-white">

    <!-- Background Glow Effect -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 -right-40 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Header / Navbar -->
    <header class="relative z-10 border-b border-slate-800/80 bg-slate-900/50 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-purple-600 to-indigo-600 flex items-center justify-center font-bold text-white shadow-lg shadow-purple-500/20">
                    OS
                </div>
                <div>
                    <h1 class="font-bold text-slate-100 text-sm tracking-wide">OSIS Portal</h1>
                    <p class="text-xs text-slate-400">Sistem Seleksi Candidates 2026</p>
                </div>
            </div>
            
            <div>
                <a href="{{ route('pendaftaran.create') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-semibold text-xs px-5 py-2.5 rounded-xl shadow-lg shadow-purple-600/30 transition-all transform hover:-translate-y-0.5">
                    <span>+ Tambah Pendaftar</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="relative z-10 max-w-7xl mx-auto px-6 py-10">

        <!-- Flash Alert Success -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-emerald-900/30 border border-emerald-500/30 text-emerald-300 text-xs flex items-center justify-between shadow-lg backdrop-blur-md">
                <span class="font-medium">{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-200">✕</button>
            </div>
        @endif

        <!-- Card Container -->
        <div class="bg-slate-800/40 backdrop-blur-2xl rounded-3xl border border-slate-700/60 shadow-2xl overflow-hidden">
            
            <!-- Card Header & Search Bar -->
            <div class="p-6 border-b border-slate-700/60 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-800/20">
                <div>
                    <h2 class="text-base font-bold text-slate-100">Kandidat Terdaftar</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Daftar seluruh calon pengurus OSIS.</p>
                </div>
                
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <!-- Input Search -->
                    <div class="relative w-full sm:w-64">
                        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari nama siswa atau bidang..." class="w-full bg-slate-900/80 border border-slate-700/80 rounded-xl px-4 py-2 text-xs text-slate-200 placeholder-slate-500 focus:outline-none focus:border-purple-500 transition">
                    </div>
                    <div class="px-3 py-2 rounded-xl bg-slate-900/60 border border-slate-700 text-xs font-medium text-slate-300 whitespace-nowrap">
                        Total: <span class="text-purple-400 font-bold" id="totalCount">{{ count($pendaftarans) }}</span>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse" id="pendaftaranTable">
                    <thead>
                        <tr class="border-b border-slate-700/60 text-slate-400 uppercase tracking-wider bg-slate-900/30">
                            <th class="px-6 py-4 font-semibold w-16">No</th>
                            <th class="px-6 py-4 font-semibold">Identitas Siswa</th>
                            <th class="px-6 py-4 font-semibold">Kelas & Gender</th>
                            <th class="px-6 py-4 font-semibold">Pilihan Bidang</th>
                            <th class="px-6 py-4 font-semibold">Motivasi</th>
                            <th class="px-6 py-4 font-semibold text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/40" id="tableBody">
                        @forelse($pendaftarans as $index => $item)
                            <tr class="hover:bg-slate-700/20 transition-colors group data-row">
                                <td class="px-6 py-4 font-medium text-slate-400">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-100 text-sm searchable-name">{{ $item['siswa']['nama'] ?? '-' }}</div>
                                   
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <span class="px-2.5 py-1 rounded-lg bg-slate-700/50 text-slate-300 font-medium border border-slate-600/50">
                                            {{ $item['siswa']['kelas']['nama_kelas'] ?? '-' }}
                                        </span>
                                        <span class="text-slate-400 text-xs">• {{ $item['siswa']['jenis_kelamin']['nama'] ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-purple-500/10 text-purple-300 border border-purple-500/20 capitalize searchable-bidang">
                                        {{ $item['pilihan_bidang'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-200 font-medium max-w-xs truncate">
                                    {{ $item['motivasi'] }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="inline-flex items-center space-x-2">
                                        <!-- Tombol Detail dengan Atribut Data -->
                                        <button type="button" 
                                            data-nama="{{ $item['siswa']['nama'] ?? '-' }}" 
                                            data-kelas="{{ $item['siswa']['kelas']['nama_kelas'] ?? '-' }}" 
                                            data-gender="{{ $item['siswa']['jenis_kelamin']['nama'] ?? '-' }}" 
                                            data-bidang="{{ $item['pilihan_bidang'] }}" 
                                            data-motivasi="{{ $item['motivasi'] }}" 
                                            onclick="openModalFromButton(this)" 
                                            class="px-3 py-1.5 rounded-xl bg-purple-500/10 hover:bg-purple-500/20 text-purple-300 font-semibold border border-purple-500/20 transition cursor-pointer">
                                            Detail
                                        </button>
                                        
                                        <a href="{{ route('pendaftaran.edit', $item['id']) }}" class="px-3 py-1.5 rounded-xl bg-amber-500/10 hover:bg-amber-500/20 text-amber-400 font-semibold border border-amber-500/20 transition">Edit</a>
                                        
                                        <form action="{{ route('pendaftaran.destroy', $item['id']) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 font-semibold border border-rose-500/20 transition">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <p class="text-sm font-medium">Belum ada data pendaftaran.</p>
                                        <p class="text-xs text-slate-500">Klik tombol "+ Tambah Pendaftar" di atas untuk menambahkan data baru.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer Pagination Bar -->
            <div class="p-4 border-t border-slate-700/60 bg-slate-800/20 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-slate-400">
                <span id="pageInfo">Menampilkan 1-10 dari total data</span>
                <div class="flex items-center space-x-2">
                    <button onclick="prevPage()" id="btnPrev" class="px-3 py-1.5 rounded-lg bg-slate-700/60 hover:bg-slate-700 text-slate-200 border border-slate-600/50 disabled:opacity-40 disabled:cursor-not-allowed transition">
                        &larr; Sebelumnya
                    </button>
                    <span class="px-3 py-1.5 rounded-lg bg-slate-900/80 border border-slate-700 text-purple-400 font-bold" id="currentPageNum">1</span>
                    <button onclick="nextPage()" id="btnNext" class="px-3 py-1.5 rounded-lg bg-slate-700/60 hover:bg-slate-700 text-slate-200 border border-slate-600/50 disabled:opacity-40 disabled:cursor-not-allowed transition">
                        Selanjutnya &rarr;
                    </button>
                </div>
            </div>

        </div>
    </main>

    <!-- Modal Pop-up Detail -->
    <div id="detailModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/80 backdrop-blur-sm hidden">
        <div class="bg-slate-800 border border-slate-700 rounded-3xl p-6 max-w-md w-full mx-4 shadow-2xl relative">
            <div class="flex justify-between items-center mb-4 border-b border-slate-700/60 pb-3">
                <h3 class="font-bold text-slate-100 text-sm">Detail Pendaftaran Kandidat</h3>
                <button onclick="closeModal()" class="text-slate-400 hover:text-slate-200 text-sm font-bold">✕</button>
            </div>
            <div class="space-y-3 text-xs">
                <div>
                    <span class="text-slate-400 block mb-0.5">Nama Lengkap Siswa</span>
                    <p id="modalNama" class="font-bold text-slate-100 text-sm">-</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-slate-400 block mb-0.5">Kelas</span>
                        <p id="modalKelas" class="font-semibold text-slate-200">-</p>
                    </div>
                    <div>
                        <span class="text-slate-400 block mb-0.5">Jenis Kelamin</span>
                        <p id="modalGender" class="font-semibold text-slate-200">-</p>
                    </div>
                </div>
                <div>
                    <span class="text-slate-400 block mb-0.5">Pilihan Bidang OSIS</span>
                    <p id="modalBidang" class="font-semibold text-purple-400 capitalize">-</p>
                </div>
                <div>
                    <span class="text-slate-400 block mb-0.5">Motivasi Bergabung</span>
                    <div class="bg-slate-900/60 border border-slate-700/60 rounded-xl p-3 text-slate-200 max-h-36 overflow-y-auto leading-relaxed" id="modalMotivasi">
                        -
                    </div>
                </div>
            </div>
            <div class="mt-6 text-right">
                <button onclick="closeModal()" class="px-5 py-2 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-medium text-xs transition">Tutup</button>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Detail Modal, Search, dan Pagination -->
    <script>
        let currentPage = 1;
        const rowsPerPage = 5; // Jumlah data per halaman

        function getVisibleRows() {
            let allRows = Array.from(document.querySelectorAll('.data-row'));
            return allRows.filter(row => row.getAttribute('data-filtered') !== 'hidden');
        }

        function updatePagination() {
            let visibleRows = getVisibleRows();
            let totalRows = visibleRows.length;
            let totalPages = Math.ceil(totalRows / rowsPerPage) || 1;

            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;

            let start = (currentPage - 1) * rowsPerPage;
            let end = start + rowsPerPage;

            // Sembunyikan semua row yang aktif, lalu tampilkan hanya row pada halaman aktif
            visibleRows.forEach((row, index) => {
                if (index >= start && index < end) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });

            // Update Info Halaman
            document.getElementById('currentPageNum').innerText = currentPage;
            document.getElementById('totalCount').innerText = totalRows;
            
            let displayStart = totalRows === 0 ? 0 : start + 1;
            let displayEnd = Math.min(end, totalRows);
            document.getElementById('pageInfo').innerText = `Menampilkan ${displayStart}-${displayEnd} dari ${totalRows} data`;

            // State tombol
            document.getElementById('btnPrev').disabled = (currentPage === 1);
            document.getElementById('btnNext').disabled = (currentPage === totalPages || totalPages === 0);
        }

        function nextPage() {
            currentPage++;
            updatePagination();
        }

        function prevPage() {
            currentPage--;
            updatePagination();
        }

        function filterTable() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let allRows = document.querySelectorAll('.data-row');

            allRows.forEach(row => {
                let name = row.querySelector('.searchable-name').innerText.toLowerCase();
                let bidang = row.querySelector('.searchable-bidang').innerText.toLowerCase();

                if (name.includes(input) || bidang.includes(input)) {
                    row.setAttribute('data-filtered', 'visible');
                } else {
                    row.setAttribute('data-filtered', 'hidden');
                    row.style.display = "none";
                }
            });

            currentPage = 1;
            updatePagination();
        }

        function openModalFromButton(button) {
            let nama = button.getAttribute('data-nama');
            let kelas = button.getAttribute('data-kelas');
            let gender = button.getAttribute('data-gender');
            let bidang = button.getAttribute('data-bidang');
            let motivasi = button.getAttribute('data-motivasi');

            document.getElementById('modalNama').innerText = nama;
            document.getElementById('modalKelas').innerText = kelas;
            document.getElementById('modalGender').innerText = gender;
            document.getElementById('modalBidang').innerText = bidang;
            document.getElementById('modalMotivasi').innerText = motivasi;
            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        // Jalankan saat halaman siap
        document.addEventListener('DOMContentLoaded', () => {
            updatePagination();
        });
    </script>
</body>
</html>