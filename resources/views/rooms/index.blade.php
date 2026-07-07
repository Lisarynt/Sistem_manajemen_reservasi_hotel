<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Notifikasi Sukses Minimalis --}}
            @if (session('success'))
                <div class="mb-5 p-4 bg-green-50 dark:bg-green-950/20 text-green-700 dark:text-green-400 rounded-xl border border-green-100 dark:border-green-900/30 text-xs font-bold uppercase tracking-wider">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Kontainer Utama Putih Bersih Modern --}}
            <div class="bg-white dark:bg-zinc-900 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-zinc-800">
                
                <div class="p-6 flex justify-between items-center border-b border-gray-100 dark:border-zinc-800">
                    <div>
                        <h3 class="text-base font-bold text-gray-900 dark:text-white">Daftar Kamar</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Kelola informasi unit kamar, tipe properti, dan status ketersediaan.</p>
                    </div>
                    @if (auth()->user()->role === 'admin')
                        {{-- Tombol Utama: Kuning Emas, Teks Hitam Pekat --}}
                        <a href="{{ route('rooms.create') }}" class="bg-[#FACC15] text-zinc-950 px-4 py-2.5 rounded-xl font-bold text-xs tracking-wider uppercase hover:bg-amber-500 transition-colors shadow-sm">
                            + Tambah Kamar
                        </a>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="border-b border-gray-100 dark:border-zinc-800 text-[10px] font-bold tracking-wider uppercase text-gray-400 dark:text-gray-500 bg-gray-50/50 dark:bg-zinc-800/20">
                                <th class="px-6 py-3.5">Foto</th>
                                <th class="px-6 py-3.5">No. Kamar</th>
                                <th class="px-6 py-3.5">Tipe</th>
                                <th class="px-6 py-3.5">Status</th>
                                <th class="px-6 py-3.5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-zinc-800/60 text-sm">
                            @forelse ($rooms as $room)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-zinc-800/10 transition-colors">
                                    {{-- Thumbnail Foto --}}
                                    <td class="px-6 py-4">
                                        @if ($room->images->first())
                                            <img src="{{ Storage::url($room->images->first()->image_path) }}" class="w-12 h-12 object-cover rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700">
                                        @else
                                            <div class="w-12 h-12 bg-gray-50 dark:bg-zinc-800 rounded-xl flex items-center justify-center border border-dashed border-gray-200 dark:border-zinc-700">
                                                <span class="text-[10px] text-gray-400 font-medium">Kosong</span>
                                            </div>
                                        @endif
                                    </td>
                                    
                                    {{-- Nomor Kamar --}}
                                    <td class="px-6 py-4 font-bold text-gray-900 dark:text-zinc-200">
                                        {{ $room->room_number }}
                                    </td>
                                    
                                    {{-- Tipe Kamar --}}
                                    <td class="px-6 py-4 text-gray-600 dark:text-zinc-400">
                                        {{ $room->roomType->name }}
                                    </td>
                                    
                                    {{-- Status Badge Modern --}}
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                            @if($room->status === 'available') bg-green-50 text-green-700 dark:bg-green-950/30 dark:text-green-400
                                            @elseif($room->status === 'occupied') bg-red-50 text-red-700 dark:bg-red-950/30 dark:text-red-400
                                            @else bg-amber-50 text-amber-700 dark:bg-amber-950/30 dark:text-amber-400 @endif">
                                            {{ $room->status }}
                                        </span>
                                    </td>
                                    
                                    {{-- Tombol Aksi --}}
                                    <td class="px-6 py-4 text-right space-x-3 text-xs font-bold uppercase tracking-wider">
                                        <a href="{{ route('rooms.show', $room) }}" class="text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white transition-colors">
                                            Detail
                                        </a>
                                        @if (auth()->user()->role === 'admin')
                                            <a href="{{ route('rooms.edit', $room) }}" class="text-amber-600 hover:text-amber-700 transition-colors">
                                                Edit
                                            </a>
                                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus kamar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-600 transition-colors font-bold uppercase">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400 dark:text-zinc-500 italic text-xs">
                                        Belum ada data unit kamar yang tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Panel --}}
                @if ($rooms->hasPages())
                    <div class="p-6 border-t border-gray-100 dark:border-zinc-800 bg-gray-50/30 dark:bg-zinc-800/10">
                        {{ $rooms->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>