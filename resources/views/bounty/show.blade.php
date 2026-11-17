<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <h2 class="text-xl font-semibold text-gray-800">{{ $bounty->judul }}</h2>
            @include('bounty.status', ['status' => $bounty->status])
        </div>
    </x-slot>

    <div class="mx-auto grid max-w-6xl gap-6 px-4 py-8 lg:grid-cols-3">
        <section class="rounded-xl bg-white p-6 shadow-sm lg:col-span-2">
            <p class="text-sm font-semibold text-teal-700">{{ $bounty->kategori }}</p>
            <h3 class="mt-4 font-semibold">Deskripsi</h3>
            <p class="mt-1 whitespace-pre-line text-gray-700">{{ $bounty->deskripsi }}</p>
        </section>

        <aside class="space-y-3 rounded-xl bg-white p-6 shadow-sm">
            <p>Budget maksimal: <strong>Rp{{ number_format($bounty->budget, 0, ',', '.') }}</strong></p>
            <p>Tenggat: <strong>{{ $bounty->tenggat->format('d M Y') }}</strong></p>
            <p>Dibuat oleh: <strong>{{ $bounty->pembuat->name }}</strong></p>
            @if ($bounty->pengerja)
                <p>Dikerjakan oleh: <strong>{{ $bounty->pengerja->name }}</strong></p>
            @endif
        </aside>
    </div>

    <div class="mx-auto max-w-6xl px-4 pb-8">
        <section class="rounded-xl bg-white p-6 shadow-sm">
            <h3 class="font-semibold">Tawaran masuk ({{ $bounty->tawaran->count() }})</h3>

            @forelse ($bounty->tawaran as $tawaran)
                <div class="mt-3 flex justify-between gap-4 border-t pt-3">
                    <div>
                        <p class="font-medium">{{ $tawaran->penawar->name }}</p>
                        <p class="text-sm text-gray-600">{{ $tawaran->catatan }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold">Rp{{ number_format($tawaran->harga, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600">{{ $tawaran->lama_hari }} hari</p>
                    </div>
                </div>
            @empty
                <p class="mt-3 text-gray-600">Belum ada tawaran.</p>
            @endforelse
        </section>
    </div>
</x-app-layout>