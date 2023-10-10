<?php

namespace App\Http\Controllers;

use App\DataTables\JadwalAssetDataTable;
use App\Models\Aset;
use App\Models\JadwalAset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalAsetController extends Controller
{
    public function index(JadwalAssetDataTable $dataTable)
    {
        return $dataTable->render('jadwal_aset.index', [
            'title' => 'List Jadwal Aset',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Jadwal Aset',
            'asets' => Aset::when(Auth::user()->role == 'pengelola', function($query) {
                $query->where('user_id', Auth::user()->id);
            })->get()
        ];
        return view('jadwal_aset.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_id' => ['nullable'],
            'tgl_jam' => ['nullable'],
            'max_pengunjung' => ['nullable']
        ]);

        try {
            $jadwal_aset = new JadwalAset();
            $jadwal_aset->aset_id = $request->aset_id;
            $jadwal_aset->tgl_jam = $request->tgl_jam;
            $jadwal_aset->max_pengunjung = $request->max_pengunjung;

            $jadwal_aset->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Jadwal Aset: ' . $e->getMessage());
        }

        return redirect()->route('dashboard.jadwal_aset.index')->with('success', 'Jadwal berhasi disimpan.');
    }

    public function edit($id)
    {
        $jadwal_aset = JadwalAset::findOrFail($id);
        return view('jadwal_aset.edit', [
            'data' => $jadwal_aset,
            'title' => 'Edit Jadwal Aset',
            'asets' => Aset::when(Auth::user()->role == 'pengelola', function($query) {
                $query->where('user_id', Auth::user()->id);
            })->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $jadwal_aset = JadwalAset::findOrFail($id);
        $request->validate([
            'aset_id' => ['nullable'],
            'tgl_jam' => ['nullable'],
            'max_pengunjung' => ['nullable'],
        ]);

        try {
            $jadwal_aset->aset_id = $request->aset_id;
            $jadwal_aset->tgl_jam = $request->tgl_jam;
            $jadwal_aset->max_pengunjung = $request->max_pengunjung;

            $jadwal_aset->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->route('dashboard.jadwal_aset.index')->with('success', 'Berhasil mengubah data Jadwal.');
    }

    public function destroy($id)
    {
        $jadwal_aset = JadwalAset::findOrFail($id);
        try {
            $jadwal_aset->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus Jadwal.');
    }
}
