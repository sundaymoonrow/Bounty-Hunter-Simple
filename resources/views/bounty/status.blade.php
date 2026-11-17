@php
    $label = [
        'terbuka' => 'Terbuka',
        'dikerjakan' => 'Dikerjakan',
        'diserahkan' => 'Diserahkan',
        'menunggu_otp' => 'Menunggu OTP',
        'selesai' => 'Selesai',
        'sengketa' => 'Sengketa',
        'dibatalkan' => 'Dibatalkan',
    ];

    $warna = [
        'terbuka' => 'bg-blue-100 text-blue-900',
        'dikerjakan' => 'bg-amber-100 text-amber-900',
        'diserahkan' => 'bg-orange-100 text-orange-900',
        'menunggu_otp' => 'bg-violet-100 text-violet-900',
        'selesai' => 'bg-green-100 text-green-900',
        'sengketa' => 'bg-red-100 text-red-900',
        'dibatalkan' => 'bg-gray-200 text-gray-800',
    ];
@endphp

<span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $warna[$status] ?? 'bg-gray-200 text-gray-800' }}">
    {{ $label[$status] ?? $status }}
</span>