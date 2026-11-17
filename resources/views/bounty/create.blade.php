<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Buat bounty</h2>
    </x-slot>

    <div class="mx-auto max-w-2xl px-4 py-8">
        <form method="POST" action="{{ route('bounties.store') }}" class="space-y-5 rounded-xl bg-white p-6 shadow-sm">
            @csrf

            <div>
                <x-input-label for="judul" value="Judul" />
                <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full" :value="old('judul')" />
                <x-input-error :messages="$errors->get('judul')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="deskripsi" value="Deskripsi" />
                <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300">{{ old('deskripsi') }}</textarea>
                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="kategori" value="Kategori" />
                <select id="kategori" name="kategori" class="mt-1 block w-full rounded-md border-gray-300">
                    @foreach ($kategori as $item)
                        <option value="{{ $item }}" @selected(old('kategori') === $item)>{{ $item }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="budget" value="Budget maksimal (Rp)" />
                <x-text-input id="budget" name="budget" type="number" class="mt-1 block w-full" :value="old('budget')" />
                <x-input-error :messages="$errors->get('budget')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="tenggat" value="Tenggat" />
                <x-text-input id="tenggat" name="tenggat" type="date" class="mt-1 block w-full" :value="old('tenggat')" />
                <x-input-error :messages="$errors->get('tenggat')" class="mt-2" />
            </div>

            <x-primary-button>Posting bounty</x-primary-button>
        </form>
    </div>
</x-app-layout>