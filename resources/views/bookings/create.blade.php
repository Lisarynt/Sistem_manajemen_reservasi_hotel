<x-app-layout>
    <x-slot name="header">Buat Booking</x-slot>
    <x-slot name="subheader">Buat reservasi baru untuk tamu</x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-100 dark:border-zinc-800 p-8">
                
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Formulir Reservasi Baru</h3>
                    <p class="text-xs text-gray-400 mt-1">Isi data tamu, pilih kamar yang tersedia, serta tentukan jadwal check-in.</p>
                </div>

                <form action="{{ route('bookings.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1.5">Tamu</label>
                        <select name="guest_id" class="w-full rounded-xl border-gray-200 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white text-sm focus:ring-[#FACC15] focus:border-[#FACC15] py-2.5 shadow-sm">
                            <option value="">-- Pilih Tamu --</option>
                            @foreach ($guests as $guest)
                                <option value="{{ $guest->id }}" {{ old('guest_id') == $guest->id ? 'selected' : '' }}>{{ $guest->name }} ({{ $guest->phone }})</option>
                            @endforeach
                        </select>
                        @error('guest_id') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1.5">Kamar (hanya yang tersedia)</label>
                        <select name="room_id" class="w-full rounded-xl border-gray-200 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white text-sm focus:ring-[#FACC15] focus:border-[#FACC15] py-2.5 shadow-sm">
                            <option value="">-- Pilih Kamar --</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>{{ $room->room_number }} - {{ $room->roomType->name }}</option>
                            @endforeach
                        </select>
                        @error('room_id') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    {{-- Baris Tanggal Check-In & Check-Out --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1.5">Tanggal Check-In</label>
                            <input type="date" name="checkin_date" value="{{ old('checkin_date') }}"
                                class="w-full rounded-xl border-gray-200 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white text-sm focus:ring-[#FACC15] focus:border-[#FACC15] py-2.5 shadow-sm">
                            @error('checkin_date') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1.5">Tanggal Check-Out</label>
                            <input type="date" name="checkout_date" value="{{ old('checkout_date') }}"
                                class="w-full rounded-xl border-gray-200 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white text-sm focus:ring-[#FACC15] focus:border-[#FACC15] py-2.5 shadow-sm">
                            @error('checkout_date') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Fasilitas Tambahan (opsional)</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 bg-gray-50 dark:bg-zinc-800/50 p-4 rounded-xl border border-gray-100 dark:border-zinc-800">
                            @foreach ($facilities as $facility)
                                <label class="flex items-center gap-2.5 text-sm text-gray-700 dark:text-gray-300 cursor-pointer select-none">
                                    <input type="checkbox" name="facilities[]" value="{{ $facility->id }}"
                                        {{ is_array(old('facilities')) && in_array($facility->id, old('facilities')) ? 'checked' : '' }}
                                        class="rounded-md border-gray-300 dark:border-zinc-700 text-[#FACC15] focus:ring-[#FACC15]/30 w-4 h-4">
                                    <span class="font-medium text-sm">{{ $facility->name }} <span class="text-xs text-gray-400 dark:text-gray-500 font-normal">(Rp {{ number_format($facility->price, 0, ',', '.') }})</span></span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100 dark:border-zinc-800">
                        <button type="submit" class="bg-[#FACC15] text-zinc-950 px-6 py-2.5 rounded-xl hover:bg-amber-500 transition-colors text-xs font-bold uppercase tracking-wider shadow-sm">
                            Simpan Booking
                        </button>
                        
                        <a href="{{ route('bookings.index') }}" class="bg-white text-gray-700 border border-gray-200 hover:bg-gray-50 px-6 py-2.5 rounded-xl transition-colors text-xs font-bold uppercase tracking-wider shadow-sm text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>