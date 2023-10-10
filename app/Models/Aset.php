<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Aset extends Model
{
    use HasFactory;

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class)->withDefault([
            'nama' => 'Belum ada kecamatan',
        ]);
    }
}
