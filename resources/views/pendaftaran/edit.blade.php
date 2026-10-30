<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pendaftaran OSIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4 selection:bg-indigo-500 selection:text-white">

    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-purple-600/20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative z-10 max-w-lg w-full bg-slate-800/60 backdrop-blur-2xl rounded-3xl border border-slate-700/60 shadow-2xl overflow-hidden p-8">
        
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="font-bold text-xl text-slate-100">Edit Pendaftaran</h1>
                <p class="text-xs text-slate-400 mt-1">Perbarui data kandidat pilihan.</p>
            </div>
            <a href="{{ route('pendaftaran.index') }}" class="w-8 h-8 rounded-xl bg-slate-700/50 hover:bg-slate-700 flex items-center justify-center text-slate-400 hover:text-slate-200 text-xs transition">✕</a>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-rose-900/30 border border-rose-500/30 text-rose-300 text-xs">
                <p class="font-bold mb-1">Periksa kembali inputan Anda:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pendaftaran.update', $pendaftaran['id']) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Pilih Siswa</label>
                <select name="siswa_id" class="w-full bg-slate-900/80 border border-slate-700/80 rounded-xl px-4 py-3 text-xs text-slate-200 focus:outline-none focus:border-purple-500 transition" required>
                    <option value="" class="bg-slate-900">-- Pilih Siswa --</option>
                    @foreach($siswas as $siswa)
                        <option value="{{ $siswa['id'] }}" class="bg-slate-900" {{ (old('siswa_id', $pendaftaran['siswa_id'] ?? $pendaftaran['siswa']['id'] ?? '') == $siswa['id']) ? 'selected' : '' }}>
                            {{ $siswa['nama'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Pilihan Bidang</label>
    <select name="pilihan_bidang" class="w-full bg-slate-900/80 border border-slate-700/80 rounded-xl px-4 py-3 text-xs text-slate-200 focus:outline-none focus:border-purple-500 transition capitalize" required>
        <option value="" class="bg-slate-900">-- Pilih Bidang OSIS --</option>
        <option value="kepemimpinan" class="bg-slate-900" {{ (old('pilihan_bidang', $pendaftaran['pilihan_bidang'] ?? '') == 'kepemimpinan') ? 'selected' : '' }}>Kepemimpinan</option>
        <option value="keagamaan" class="bg-slate-900" {{ (old('pilihan_bidang', $pendaftaran['pilihan_bidang'] ?? '') == 'keagamaan') ? 'selected' : '' }}>Keagamaan</option>
        <option value="olahraga" class="bg-slate-900" {{ (old('pilihan_bidang', $pendaftaran['pilihan_bidang'] ?? '') == 'olahraga') ? 'selected' : '' }}>Olahraga</option>
        <option value="seni" class="bg-slate-900" {{ (old('pilihan_bidang', $pendaftaran['pilihan_bidang'] ?? '') == 'seni') ? 'selected' : '' }}>Seni</option>
    </select>
</div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Motivasi Bergabung</label>
                <textarea name="motivasi" rows="4" class="w-full bg-slate-900/80 border border-slate-700/80 rounded-xl px-4 py-3 text-xs text-slate-200 focus:outline-none focus:border-purple-500 transition" required>{{ old('motivasi', $pendaftaran['motivasi'] ?? '') }}</textarea>
            </div>

            <div class="pt-2 flex items-center justify-end space-x-3">
                <a href="{{ route('pendaftaran.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-medium text-slate-400 hover:text-slate-200 transition">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-semibold text-white bg-amber-600 hover:bg-amber-500 shadow-lg shadow-amber-600/30 transition">Perbarui Data</button>
            </div>
        </form>
    </div>

</body>
</html>