<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AssetCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'harga' => $this->harga,
            'harga_instansi' => $this->harga_instansi,
            'letak' => $this->letak,
            'asal' => $this->asal,
            'penemu' => $this->penemu,
            'status' => $this->status,
            'kondisi' => $this->kondisi,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'booking_url' => route('dashboard.booking.create', $this->id),
            'marker_icon' => asset('img/default.png'),
            'dokumen_aset' => $this->dokumen_aset == null ? asset('img/default.png') : url(Storage::url($this->dokumen_aset)),
            'foto1' => $this->foto1 == null ? asset('img/default.png') : url(Storage::url($this->foto1)),
            'foto2' => $this->foto2 == null ? asset('img/default.png') : url(Storage::url($this->foto2)),
        ];
    }
}
