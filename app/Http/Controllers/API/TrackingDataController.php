<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AssetCollection;
use App\Models\Aset;
use Illuminate\Http\Request;

class TrackingDataController extends Controller
{
    public function get_tracking_aset(Request $request)
    {
        $aset = Aset::join('users', 'users.id', '=', 'asets.user_id');
        $kecamatan_id = $request->kecamatan_id;
        $keyword = $request->keyword;
        if ($request->filter != '') {
            $aset->where(function ($query) {
                $query->where('latitude', 'not like', '%E%');
                $query->orWhere('latitude', 'not like', '%?%');
                $query->orWhere('latitude', '!=', 0);
                $query->orWhere('latitude', '!=', 1);
                $query->orWhere('longitude', 'not like', '%E%');
                $query->orWhere('longitude', 'not like', '%?%');
                $query->orWhere('longitude', '!=', 0);
                $query->orWhere('longitude', '!=', 1);
            })->get();
        }
        $aset = $aset->where(function ($query) {
            $query->where('latitude', 'not like', '%E%');
            $query->where('latitude', 'not like', '%?%');
            $query->where('latitude', '!=', 0);
            $query->where('latitude', '!=', 1);
            $query->where('longitude', 'not like', '%E%');
            $query->where('longitude', 'not like', '%?%');
            $query->where('longitude', '!=', 0);
            $query->where('longitude', '!=', 1);
        })
            ->when($request->kecamatan_id != '', function ($query) use ($kecamatan_id) {
                $query->where('kecamatan_id', $kecamatan_id);
            })
            ->when($request->keyword != '', function ($query) use ($keyword) {
                $query->where('nama', $keyword);
                $query->orWhere('harga', $keyword);
                $query->orWhere('letak', $keyword);
                $query->orWhere('asal', $keyword);
                $query->orWhere('penemu', $keyword);
                $query->orWhere('status', $keyword);
                $query->orWhere('kondisi', $keyword);
            })
            ->select('asets.*')->get();
        $data = AssetCollection::collection($aset);
        return response()->json($data);
    }
}
