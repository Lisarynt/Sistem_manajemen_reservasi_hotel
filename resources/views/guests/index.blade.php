<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Tamu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-900 overflow-hidden shadow-sm rounded-2xl p-8 border border-gray-100 dark:border-zinc-800">

                @if (session('success'))
                    <div class="mb-5 p-4 bg-green-50 dark:bg-green-950/40 text-green-700 dark:text-green-400 rounded-xl border border-green-100 dark:border-green-900/50 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-5 p-4 bg-red-50 dark:bg-red-950/40 text-red-700 dark:text-red-400 rounded-xl border border-red-100 dark:border-red-900/50 text-sm font-medium">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Daftar Tamu</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Manajemen informasi profil dan data identitas tamu yang menginap.</p>
                    </div>
                    
                    <a href="{{ route('guests.create') }}" class="bg-[#FACC15] text-zinc-950 px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-amber-500 transition-colors shadow-sm">
                        + Tambah Tamu
                    </a>
                </div>

                <form method="GET" action="{{ route('guests.index') }}" class="mb-6">
                    <div class="relative w-full md:w-1/3">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, telepon, atau no. identitas..."
                            class="w-full rounded-xl border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-400 shadow-sm focus:border-[#FACC15] focus:ring-[#FACC15]/30 text-sm py-2.5 pl-4">
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100 dark:border-zinc-800 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">
                                <th class="pb-3 px-4">Nama</th>
                                <th class="pb-3 px-4">Telepon</th>
                                <th class="pb-3 px-4">No. Identitas</th>
                                <th class="pb-3 px-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-50 dark:divide-zinc-800/50">
                            @forelse ($guests as $guest)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-zinc-800/20 transition-colors">
                                    <td class="py-4 px-4 font-semibold text-gray-900 dark:text-zinc-200">{{ $guest->name }}</td>
                                    <td class="py-4 px-4 text-gray-600 dark:text-zinc-400 font-medium">{{ $guest->phone }}</td>
                                    <td class="py-4 px-4 text-gray-600 dark:text-zinc-400 font-mono text-xs">{{ $guest->id_number }}</td>
                                    <td class="py-4 px-4 text-right space-x-3 font-medium">
                                        <a href="{{ route('guests.show', $guest) }}" class="text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white transition-colors">Detail</a>
                                        <a href="{{ route('guests.edit', $guest) }}" class="text-amber-600 hover:text-amber-700 dark:text-amber-500 dark:hover:text-[#FACC15] transition-colors">Edit</a>
                                        
                                        <form action="{{ route('guests.destroy', $guest) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus tamu ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-gray-400 dark:text-zinc-500 italic">Belum ada data tamu tercatat atau tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Blok Pagination --}}
                <div class="mt-6">
                    {{ $guests->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>