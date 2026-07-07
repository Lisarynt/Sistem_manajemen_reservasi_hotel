<x-app-layout>
    <x-slot name="header">Edit Booking</x-slot>
    <x-slot name="subheader">Kode: {{ $booking->booking_code }}</x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-100 dark:border-zinc-800 p-8">
                
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Perbarui Informasi Reservasi</h3>
                    <p class="text-xs text-gray-400 mt-1">Sesuaikan penempatan kamar, tanggal kunjungan, serta fasilitas tamu.</p>
                </div>

                <form action="{{ route('bookings.update', $booking) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <!-- Tamu -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1.5">Tamu</label>
                        <select name="guest_id" class="w-full rounded-xl border-gray-200 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white text-sm focus:ring-[#FACC15] focus:border-[#FACC15] py-2.5 shadow-sm">
                            @foreach ($guests as $guest)
                                <option value="{{ $guest->id }}" {{ $booking->guest_id == $guest->id ? 'selected' : '' }}>{{ $guest->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kamar -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1.5">Kamar</label>
                        <select name="room_id" class="w-full rounded-xl border-gray-200 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white text-sm focus:ring-[#FACC15] focus:border-[#FACC15] py-2.5 shadow-sm">
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" {{ $booking->room_id == $room->id ? 'selected' : '' }}>{{ $room->room_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1.5">Tanggal Check-In</label>
                            <input type="date" name="checkin_date" value="{{ $booking->checkin_date->format('Y-m-d') }}"
                                class="w-full rounded-xl border-gray-200 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white text-sm focus:ring-[#FACC15] focus:border-[#FACC15] py-2.5 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1.5">Tanggal Check-Out</label>
                            <input type="date" name="checkout_date" value="{{ $booking->checkout_date->format('Y-m-d') }}"
                                class="w-full rounded-xl border-gray-200 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white text-sm focus:ring-[#FACC15] focus:border-[#FACC15] py-2.5 shadow-sm">
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1.5">Status</label>
                        <select name="status" class="w-full rounded-xl border-gray-200 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white text-sm focus:ring-[#FACC15] focus:border-[#FACC15] py-2.5 shadow-sm">
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="checked_in" {{ $booking->status == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                            <option value="checked_out" {{ $booking->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <!-- Fasilitas Tambahan -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Fasilitas Tambahan</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 bg-gray-50 dark:bg-zinc-800/50 p-4 rounded-xl border border-gray-100 dark:border-zinc-800">
                            @foreach ($facilities as $facility)
                                <label class="flex items-center gap-2.5 text-sm text-gray-700 dark:text-gray-300 cursor-pointer select-none">
                                    <input type="checkbox" name="facilities[]" value="{{ $facility->id }}"
                                        {{ $booking->facilities->contains($facility->id) ? 'checked' : '' }}
                                        class="rounded-md border-gray-300 dark:border-zinc-700 text-[#FACC15] focus:ring-[#FACC15]/30 w-4 h-4">
                                    <span class="font-medium text-sm">{{ $facility->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100 dark:border-zinc-800">
                        <button type="submit" class="bg-[#FACC15] text-zinc-950 px-6 py-2.5 rounded-xl hover:bg-amber-500 transition-colors text-xs font-bold uppercase tracking-wider shadow-sm">
                            Update Booking
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