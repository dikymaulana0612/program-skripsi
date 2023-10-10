<?php

namespace App\Http\Controllers;

use App\Helpers\MyHelper;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function periode(Request $request)
    {
        $title = 'Laporan Booking';

        if ($request->date_from && $request->date_to) {
            $title .= ' Periode ' . Carbon::parse($request->date_from)->locale('id_ID')->isoFormat('LL') . ' s/d ' . Carbon::parse($request->date_to)->locale('id_ID')->isoFormat('LL');
            $data = Booking::with(['asset'])->whereBetween('created_at', [$request->date_from . ' 00:00:00', $request->date_to . ' 23:23:59'])->orderBy('id', 'DESC')
                    ->when(Auth::user()->role == 'admin', function($query) {
                        $query->where('status', 'used');
                    })->when(Auth::user()->role == 'pengelola', function($query) {
                        $query->whereRelation('asset', 'user_id', Auth::user()->id);
                    })->get();
        }
        $data = [
            'title' => $title,
            'date_from' => $request->date_from ?? null,
            'date_to' => $request->date_to ?? null,
            'data' => $data ?? null,
        ];

        return view('laporan.periode', $data);
    }

    public function keuangan(Request $request)
    {
        $title = 'Laporan Keuangan';

        if ($request->date_from && $request->date_to) {
            $title .= ' Periode ' . Carbon::parse($request->date_from)->locale('id_ID')->isoFormat('LL') . ' s/d ' . Carbon::parse($request->date_to)->locale('id_ID')->isoFormat('LL');
            $data_lunas = Booking::join('asets', 'asets.id', '=', 'bookings.asset_id')
                            ->whereBetween('bookings.created_at', [$request->date_from . ' 00:00:00', $request->date_to . ' 23:23:59'])
                            ->when(Auth::user()->role == 'pengelola', function($query) {
                                $query->where('asets.user_id', Auth::user()->id);
                            })->whereIn('bookings.status', ['used', 'paid'])->get();
            $data_belum_lunas = Booking::join('asets', 'asets.id', '=', 'bookings.asset_id')
                            ->whereBetween('bookings.created_at', [$request->date_from . ' 00:00:00', $request->date_to . ' 23:23:59'])
                            ->when(Auth::user()->role == 'pengelola', function($query) {
                                $query->where('asets.user_id', Auth::user()->id);
                            })->where('bookings.status', 'pending')->get();
            $pendapatan = ['lunas' => 0, 'belum_lunas' => 0];
            foreach ($data_lunas as $item) {
                $pendapatan['lunas'] += MyHelper::getHargaFix($item) * $item->jml_orang;
            }
            foreach ($data_belum_lunas as $item) {
                $pendapatan['belum_lunas'] += MyHelper::getHargaFix($item) * $item->jml_orang;
            }
            $jml_booking = Booking::join('asets', 'asets.id', '=', 'bookings.asset_id')
            ->whereBetween('bookings.created_at', [$request->date_from . ' 00:00:00', $request->date_to . ' 23:23:59'])
            ->when(Auth::user()->role == 'pengelola', function($query) {
                $query->where('asets.user_id', Auth::user()->id);
            })->count();

            $pendapatan['jml_booking'] = $jml_booking;
        }

        $data = [
            'title' => $title,
            'date_from' => $request->date_from ?? null,
            'date_to' => $request->date_to ?? null,
            'data' => $pendapatan ?? null,
        ];

        return view('laporan.keuangan', $data);
    }
}
