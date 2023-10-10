<?php

namespace App\Http\Controllers;

use App\Helpers\MyHelper;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        if (Auth::user()->role == 'pengunjung') {
            $data = [
                'title' => 'Dashboard',
                'bookingan_saya_belum_terpakai' => Booking::where('user_id', Auth::user()->id)->where('status', '!=', 'used')->count(),
                'bookingan_saya_terpakai' => Booking::where('user_id', Auth::user()->id)->where('status', 'used')->count(),
            ];

            return view('dashboard_pengunjung', $data);
        } else {

            $data_lunas = Booking::join('asets', 'asets.id', '=', 'bookings.asset_id')
                            ->whereYear('bookings.created_at', date('Y'))
                            ->when(Auth::user()->role == 'pengelola', function($query) {
                                $query->where('asets.user_id', Auth::user()->id);
                            })->whereIn('bookings.status', ['used', 'paid'])->count();
            $data_belum_lunas = Booking::join('asets', 'asets.id', '=', 'bookings.asset_id')
                            ->whereYear('bookings.created_at', date('Y'))
                            ->when(Auth::user()->role == 'pengelola', function($query) {
                                $query->where('asets.user_id', Auth::user()->id);
                            })->where('bookings.status', 'pending')->count();
            $pendapatan = ['lunas' => 0, 'belum_lunas' => 0];

            $data = [
                'title' => 'Dashboard',
                'pengelola_aktif' => User::where('role', 'pengelola')->where('is_aktif', 1)->count(),
                'pengelola_tidak_aktif' => User::where('role', 'pengelola')->where('is_aktif', 0)->count(),
                'harian' => Booking::whereDate('created_at', date('Y-m-d'))->count(),
                'bulanan' => Booking::whereMonth('created_at', date('m'))->count(),
                'tahunan' => Booking::whereYear('created_at', date('Y'))->count(),
                'lunas' => $data_lunas,
                'belum_lunas' => $data_belum_lunas,
            ];
        }
        return view('dashboard', $data);

    }
}
