<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => '-',
        ]);
    }

    public function asset()
    {
        return $this->belongsTo(Aset::class, 'asset_id')->withDefault([
            'nama' => '-',
            'nama_guide' => '-'
        ]);
    }

    public function jadwal_aset()
    {
        return $this->belongsTo(JadwalAset::class, 'jadwal_asset_id')->withDefault([
            'tgl_jam' => '-',
        ]);
    }
}
