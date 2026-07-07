<x-app-layout>
    <x-slot name="header">Activity Log</x-slot>
    <x-slot name="subheader">Riwayat aktivitas sistem</x-slot>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-600">
                        <th class="py-2 text-sm font-semibold text-gray-500 dark:text-gray-300">Waktu</th>
                        <th class="py-2 text-sm font-semibold text-gray-500 dark:text-gray-300">Pengguna</th>
                        <th class="py-2 text-sm font-semibold text-gray-500 dark:text-gray-300">Aktivitas</th>
                        <th class="py-2 text-sm font-semibold text-gray-500 dark:text-gray-300">Detail Perubahan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activities as $activity)
                        <tr class="border-b border-gray-100 dark:border-gray-700">
                            <td class="py-3 text-sm text-gray-600 dark:text-gray-300">{{ $activity->created_at->format('d/m/Y H:i') }}</td>
                            <td class="py-3 text-sm text-gray-900 dark:text-gray-200">
                                {{ $activity->causer->name ?? 'System' }}
                            </td>
                            <td class="py-3">
                                <span class="text-xs px-2 py-1 rounded-full font-medium bg-[#facc15]/20 text-[#a16207]">
                                    {{ $activity->description }}
                                </span>
                            </td>
                            <td class="py-3 text-sm text-gray-500 dark:text-gray-400">
                                @if ($activity->properties->has('attributes'))
                                    @foreach ($activity->properties['attributes'] as $key => $value)
                                        <span class="inline-block mr-2">{{ $key }}: <strong>{{ is_array($value) ? json_encode($value) : $value }}</strong></span>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-gray-400">Belum ada aktivitas tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $activities->links() }}
        </div>
    </div>
</x-app-layout>