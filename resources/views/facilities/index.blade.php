<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Fasilitas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-900 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-zinc-800 p-8">

                {{-- Alert Notification --}}
                @if (session('success'))
                    <div class="mb-5 p-4 bg-green-50 dark:bg-green-950/40 text-green-700 dark:text-green-400 rounded-xl border border-green-100 dark:border-green-900/50 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Daftar Fasilitas</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Kelola seluruh item fasilitas tambahan yang dapat dipilih oleh tamu.</p>
                    </div>
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('facilities.create') }}" class="bg-[#FACC15] text-zinc-950 px-4 py-2.5 rounded-xl hover:bg-amber-500 transition-colors text-xs font-bold uppercase tracking-wider shadow-sm">
                            + Tambah Fasilitas
                        </a>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100 dark:border-zinc-800">
                                <th class="pb-3 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Nama Fasilitas</th>
                                <th class="pb-3 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Harga Layanan</th>
                                <th class="pb-3 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-zinc-800/50">
                            @forelse ($facilities as $facility)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-zinc-800/20 transition-colors">
                                    <td class="py-4 text-sm font-semibold text-gray-900 dark:text-zinc-200">{{ $facility->name }}</td>
                                    <td class="py-4 text-sm font-mono font-medium text-gray-600 dark:text-zinc-400">Rp {{ number_format($facility->price, 0, ',', '.') }}</td>
                                    <td class="py-4 text-sm font-medium text-right space-x-3">
                                        <a href="{{ route('facilities.show', $facility) }}" class="text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white transition-colors">Detail</a>
                                        
                                        @if (auth()->user()->role === 'admin')
                                            <a href="{{ route('facilities.edit', $facility) }}" class="text-amber-600 hover:text-amber-700 dark:text-amber-500 dark:hover:text-[#FACC15] transition-colors">Edit</a>
                                            
                                            <form action="{{ route('facilities.destroy', $facility) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus fasilitas ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-8 text-center text-sm text-gray-400 dark:text-zinc-500 italic">Belum ada data fasilitas yang tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Blok Pagination --}}
                <div class="mt-6">
                    {{ $facilities->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>