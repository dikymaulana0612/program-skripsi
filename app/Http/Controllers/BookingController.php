<?php

namespace App\Http\Controllers;

use App\DataTables\BookingDataTable;
use App\Helpers\MyHelper;
use App\Models\Aset;
use App\Models\Booking;
use App\Models\JadwalAset;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index(BookingDataTable $dataTable)
    {
        return $dataTable->render('booking.index', [
            'title' => 'List Booking',
            'datatable' => true
        ]);
    }

    public function create($id)
    {
        $booking = Aset::findOrFail($id);
        $jadwals = JadwalAset::where('aset_id', $id)->where('tgl_jam', '>=', date('Y-m-d'))->get();
        $data = [
            'title' => 'Tambah Booking',
            'aset' => $booking,
            'jadwals' => $jadwals
        ];
        return view('booking.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => ['required'],
            'jadwal_asset_id' => ['required'],
            'jml_orang' => ['required'],
        ]);

        // cek max pengunjung
        $jadwal_asset = JadwalAset::find($request->jadwal_asset_id);
        if ($request->jml_orang > $jadwal_asset->max_pengunjung) {
            return redirect()->back()->with('error', 'Gagal membuat Booking: Jml pengunjung melebihi batas maksimum.');
        }

        try {
            $booking = new Booking();
            $booking->user_id = Auth::user()->id;
            $booking->asset_id = $request->asset_id;
            $booking->jadwal_asset_id = $request->jadwal_asset_id;
            $booking->jml_orang = $request->jml_orang;
            $booking->status = "pending";
            $booking->save();
            $booking->no_tiket = MyHelper::generateNoFaktur($booking->id);
            $booking->save();

            $booking->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Booking: ' . $e->getMessage());
        }

        return redirect()->route('dashboard.booking.index')->with('success', 'Booking berhasi disimpan.');
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('booking.show', [
            'data' => $booking,
            'title' => 'Detail Booking',
        ]);
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        try {
            $booking->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus Booking.');
    }

    public function gis_aset(Request $request)
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

        return view('gis_aset', $data);
    }

    public function set_paid(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        try {
            $booking->status = 'paid';
            $booking->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengubah status menjadi Terbayar.');
    }

    public function scan_tiket()
    {
        $data = [
            'title' => 'Scan Tiket',
        ];

        return view('booking.scan_tiket', $data);
    }

    public function scan_tiket_process(Request $request)
    {
        $request->validate([
            'no_tiket' => ['required'],
        ]);

        $check = Booking::where('no_tiket', $request->no_tiket)->first();

        $data = [
            'title' => 'Scan Tiket',
            'data' => $check ?? null,
        ];

        return view('booking.scan_tiket', $data);
    }

    public function set_used(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        try {
            $booking->status = 'used';
            $booking->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        $data = [
            'title' => 'Scan Tiket',
            'data' => $booking,
        ];

        return view('booking.scan_tiket', $data)->with('success', 'Berhasil mengubah status menjadi Terpakai.');
    }

    public function komplen($id)
    {
        $booking = Booking::findOrFail($id);
        return view('booking.komplen', [
            'data' => $booking,
            'title' => 'Komplen Booking',
        ]);
    }

    public function komplen_store(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        try {
            $booking->komplen = $request->komplen;

            $booking->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengisi komplen.');
    }

    public function bukti_bayar($id)
    {
        $booking = Booking::findOrFail($id);
        return view('booking.bukti_bayar', [
            'data' => $booking,
            'title' => 'Upload Bukti Bayar',
        ]);
    }

    public function bukti_bayar_store(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'bukti_bayar' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp', 'between:0,5048'],
        ]);

        try {
            if ($request->hasFile('bukti_bayar')) {
                if($booking->bukti_bayar != '') {
                    try {
                        Storage::delete($booking->bukti_bayar);
                    } catch (\Throwable $th) {
                    }
                }
                $filename = Str::random(32) . '.' . $request->file('bukti_bayar')->getClientOriginalExtension();
                $bukti_bayar_path = $request->file('bukti_bayar')->storeAs('public/bukti_bayar', $filename);
                $booking->bukti_bayar = $request->file('bukti_bayar')->getClientOriginalName();
            }
            $booking->bukti_bayar = isset($bukti_bayar_path) ? $bukti_bayar_path : $booking->bukti_bayar;

            $booking->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengisi bukti bayar.');
    }
}
