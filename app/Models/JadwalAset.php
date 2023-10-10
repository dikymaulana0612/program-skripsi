<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalAset extends Model
{
    use HasFactory;

    public function asset()
    {
        return $this->belongsTo(Aset::class, 'aset_id')->withDefault([
            'nama' => '-',
        ]);
    }

    public function getTglJamFixedAttribute()
    {
        return Carbon::parse($this->tgl_jam)->locale('id_ID')->isoFormat('LLL');
    }

    protected $appends = [
        'tgl_jam_fixed'
    ];
}
