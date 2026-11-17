<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Bounty terbuka</h2>
            <a href="{{ route('bounties.create') }}" class="rounded-lg bg-teal-700 px-4 py-2 text-white">Buat bounty</a>
        </div>
    </x-slot>

    <div class="mx-auto max-w-6xl px-4 py-8">
        @if ($bounties->isEmpty())
            <p class="text-gray-600">Belum ada bounty terbuka.</p>
        @endif

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($bounties as $bounty)
                <a href="{{ route('bounties.show', $bounty) }}">
                    @include('bounty.kartu', ['bounty' => $bounty])
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>