<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function welcome(Request $request)
    {
        if ($request->has('kecamatan_id') && $request->kecamatan_id != '') {
            $kecamatan = Kecamatan::find($request->kecamatan_id);
        }

        if ($request->has('keyword') && $request->keyword != '') {
            $keyword = $request->keyword;
        }

        $data = [
            'title' => 'Pemetaan Aset',
            'kecamatans' => Kecamatan::all(),
            'kecamatan' => isset($kecamatan) ? $kecamatan : null,
            'keyword' => isset($keyword) ? $keyword : null,
        ];

        return view('welcome', $data);
    }
}
