<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tawaran extends Model
{
    protected $fillable = ['bounty_id', 'penawar_id', 'harga', 'lama_hari', 'catatan', 'status'];

    public function bounty()
    {
        return $this->belongsTo(Bounty::class);
    }

    public function penawar()
    {
        return $this->belongsTo(User::class, 'penawar_id');
    }
}
