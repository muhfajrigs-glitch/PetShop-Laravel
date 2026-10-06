@props(['headers', 'rows'])

<div class="overflow-x-auto">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-soft-yellow border-b-2 border-coral">
                @foreach($headers as $header)
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">
                        {{ $header }}
                    </th>
                @endforeach
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $row)
                <tr class="border-b hover:bg-cream transition">
                    {{ $slot }}
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($headers) + 1 }}" class="px-6 py-4 text-center text-gray-500">
                        No data available
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>