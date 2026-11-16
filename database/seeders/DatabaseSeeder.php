<?php

namespace Database\Seeders;

use App\Models\Bounty;
use App\Models\Tawaran;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = $this->buatUser('Admin Sekolah', 'admin@bounty.test', '62800000000', 'admin');
        $rani = $this->buatUser('Rani', 'rani@bounty.test', '62800000001');
        $dimas = $this->buatUser('Dimas', 'dimas@bounty.test', '62800000002');
        $ayu = $this->buatUser('Ayu', 'ayu@bounty.test', '62800000003');
        $bagus = $this->buatUser('Bagus', 'bagus@bounty.test', '62800000004');

        $poster = $this->buatBounty([
            'pembuat_id' => $dimas->id,
            'judul' => 'Poster acara Pensi Sekolah',
            'kategori' => 'Desain grafis',
            'budget' => 80000,
        ]);
        $this->buatBounty([
            'pembuat_id' => $ayu->id,
            'judul' => 'Video dokumentasi ekskul',
            'kategori' => 'Edit video',
        ]);
        $this->buatBounty([
            'pembuat_id' => $bagus->id,
            'judul' => 'Foto acara lomba kelas',
            'kategori' => 'Foto dan dokumentasi',
            'budget' => 60000,
        ]);
        $this->buatBounty([
            'pembuat_id' => $rani->id,
            'judul' => 'Rapikan laporan kegiatan OSIS',
            'kategori' => 'Ketik dan rapikan dokumen',
            'budget' => 40000,
        ]);

        Tawaran::create(['bounty_id' => $poster->id, 'penawar_id' => $rani->id, 'harga' => 65000, 'lama_hari' => 3, 'catatan' => 'Pernah buat poster OSIS.', 'status' => 'menunggu']);
        Tawaran::create(['bounty_id' => $poster->id, 'penawar_id' => $ayu->id, 'harga' => 70000, 'lama_hari' => 2, 'catatan' => 'Bisa dikerjakan dua hari.', 'status' => 'menunggu']);
        Tawaran::create(['bounty_id' => $poster->id, 'penawar_id' => $bagus->id, 'harga' => 50000, 'lama_hari' => 4, 'catatan' => 'Siap kirim contoh karya.', 'status' => 'menunggu']);

        $this->buatBounty([
            'pembuat_id' => $dimas->id,
            'pengerja_id' => $rani->id,
            'judul' => 'Edit video profil sekolah',
            'kategori' => 'Edit video',
            'harga_deal' => 90000,
            'status' => 'dikerjakan',
        ]);

        $this->buatBounty([
            'pembuat_id' => $ayu->id,
            'pengerja_id' => $dimas->id,
            'judul' => 'Desain sertifikat lomba',
            'kategori' => 'Desain grafis',
            'harga_deal' => 90000,
            'status' => 'diserahkan',
            'hasil_link' => 'https://contoh.test/hasil',
            'hasil_catatan' => 'Hasil sudah dikirim, silakan diperiksa.',
        ]);

        $this->buatBounty([
            'pembuat_id' => $bagus->id,
            'pengerja_id' => $rani->id,
            'judul' => 'Foto dokumentasi rapat OSIS',
            'kategori' => 'Foto dan dokumentasi',
            'harga_deal' => 90000,
            'status' => 'menunggu_otp',
            'hasil_link' => 'https://contoh.test/foto',
            'kode_otp' => '482917',
            'otp_berlaku_sampai' => now()->addDays(2),
        ]);

        $this->buatBounty([
            'pembuat_id' => $rani->id,
            'pengerja_id' => $ayu->id,
            'judul' => 'Ketik ulang soal latihan',
            'kategori' => 'Ketik dan rapikan dokumen',
            'harga_deal' => 40000,
            'status' => 'selesai',
        ]);

        $this->buatBounty([
            'pembuat_id' => $dimas->id,
            'pengerja_id' => $bagus->id,
            'judul' => 'Desain spanduk lomba',
            'kategori' => 'Desain grafis',
            'harga_deal' => 90000,
            'status' => 'sengketa',
            'alasan_sengketa' => 'Hasil sudah diterima tapi kode OTP belum diberikan.',
        ]);
    }

    private function buatUser($nama, $email, $wa, $role = 'member')
    {
        return User::forceCreate([
            'name' => $nama,
            'email' => $email,
            'password' => Hash::make('password'),
            'no_wa' => $wa,
            'role' => $role,
        ]);
    }

    private function buatBounty(array $data)
    {
        $dasar = [
            'deskripsi' => 'Contoh bounty untuk data demo.',
            'kategori' => 'Desain grafis',
            'budget' => 100000,
            'tenggat' => now()->addDays(5),
            'status' => 'terbuka',
        ];

        return Bounty::create(array_merge($dasar, $data));
    }
}