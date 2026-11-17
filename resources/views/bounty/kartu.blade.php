<div class="rounded-xl border border-stone-200 bg-white p-5 shadow-sm hover:shadow-md transition">
    <div class="flex items-center justify-between gap-3">
        <span class="text-sm font-semibold text-teal-700">{{ $bounty->kategori }}</span>
        @include('bounty.status', ['status' => $bounty->status])
    </div>

    <h3 class="mt-2 text-lg font-semibold text-gray-900">{{ $bounty->judul }}</h3>

    <div class="mt-3 flex items-center justify-between gap-3">
        <span class="text-xl font-semibold">Rp{{ number_format($bounty->budget, 0, ',', '.') }}</span>
        <span class="text-sm text-gray-600">
            {{ $bounty->tawaran->count() }} tawaran · tenggat {{ $bounty->tenggat->format('d M') }}
        </span>
    </div>

    <p class="mt-3 text-sm text-gray-600">Oleh {{ $bounty->pembuat->name }}</p>
</div>