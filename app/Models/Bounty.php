<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bounty extends Model
{
    protected $fillable = [
        'pembuat_id', 'pengerja_id', 'judul', 'deskripsi', 'kategori', 'budget', 'harga_deal', 'tenggat', 'status', 'hasil_link', 'kod_otp', 'hasil_catatan', 'otp_berlaku_sampai', 'otp_salah', 'alasan_sengketa',
    ];

    protected $casts = [
        'tenggat' => 'date',
        'otp_berlaku_sampai' => 'datetime',
    ];

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'pembuat_id');
    }

    public function pengerja()
    {
        return $this->belongsTo(User::class, 'pengerja_id');
    }

    public function tawaran()
    {
        return $this->hasMany(Tawaran::class);
    }

    public function bisaPindah($baru)
    {
        $aturan = [
            'terbuka' => ['dikerjakan', 'dibatalkan'],
            'dikerjakan' => ['diserahkan', 'terbuka', 'sengketa'],
            'diserahkan' => ['menunggu_otp', 'sengketa'],
            'menunggu_otp' => ['selesai', 'sengketa'],
            'sengketa' => ['selesai', 'dibatalkan', 'terbuka'],
        ];

        return in_array($baru, $aturan[$this->status] ?? []);
    }

    public function pindahStatus($baru)
    {
        if (!$this->bisPindah($baru)) {
            throw new \Exception("Status tidak boleh pindah dari {$this->status} ke {$baru}");
        }

        $this->status = $baru;
        $this->save();
    }
}
