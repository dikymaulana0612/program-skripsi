<?php

namespace App\Http\Controllers;

use App\DataTables\AsetDataTable;
use App\Models\Aset;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AsetController extends Controller
{
    public function index(AsetDataTable $dataTable)
    {
        return $dataTable->render('master.aset.index', [
            'title' => 'List Aset',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Aset',
            'kecamatans' => Kecamatan::all()
        ];
        return view('master.aset.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required'],
            'latitude' => ['nullable'],
            'longitude' => ['nullable'],
            'harga' => ['nullable'],
            'letak' => ['nullable'],
            'asal' => ['nullable'],
            'penemu' => ['nullable'],
            'status' => ['nullable'],
            'kondisi' => ['nullable'],
            'dokumen_aset' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp', 'between:0,5048'],
            'foto1' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,5048'],
            'foto2' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,5048'],
        ]);

        try {
            $aset = new Aset();
            $aset->user_id = Auth::user()->id;
            $aset->latitude = $request->latitude;
            $aset->nama = $request->nama;
            $aset->latitude = $request->latitude;
            $aset->longitude = $request->longitude;
            $aset->harga = $request->harga;
            $aset->harga_instansi = $request->harga_instansi;
            $aset->letak = $request->letak;
            $aset->asal = $request->asal;
            $aset->penemu = $request->penemu;
            $aset->status = $request->status;
            $aset->kondisi = $request->kondisi;
            $aset->kecamatan_id = $request->kecamatan_id;
            $aset->nama_guide = $request->nama_guide;

            if ($request->hasFile('dokumen_aset')) {
                $filename = Str::random(32) . '.' . $request->file('dokumen_aset')->getClientOriginalExtension();
                $dokumen_aset_path = $request->file('dokumen_aset')->storeAs('public/dokumen_aset', $filename);
                $aset->dokumen_aset = isset($dokumen_aset_path) ? $dokumen_aset_path : '';
            }
            if ($request->hasFile('foto1')) {
                $filename = Str::random(32) . '.' . $request->file('foto1')->getClientOriginalExtension();
                $foto1_path = $request->file('foto1')->storeAs('public/foto1', $filename);
                $aset->foto1 = isset($foto1_path) ? $foto1_path : '';
            }
            if ($request->hasFile('foto2')) {
                $filename = Str::random(32) . '.' . $request->file('foto2')->getClientOriginalExtension();
                $foto2_path = $request->file('foto2')->storeAs('public/foto2', $filename);
                $aset->foto2 = isset($foto2_path) ? $foto2_path : '';
            }

            $aset->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Aset: ' . $e->getMessage());
        }

        return redirect()->route('dashboard.aset.index')->with('success', 'Aset berhasi disimpan.');
    }

    public function edit($id)
    {
        $aset = Aset::findOrFail($id);
        return view('master.aset.edit', [
            'data' => $aset,
            'title' => 'Edit Aset',
            'kecamatans' => Kecamatan::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $aset = Aset::findOrFail($id);
        $request->validate([
            'nama' => ['required'],
            'latitude' => ['nullable'],
            'longitude' => ['nullable'],
            'harga' => ['nullable'],
            'letak' => ['nullable'],
            'asal' => ['nullable'],
            'penemu' => ['nullable'],
            'status' => ['nullable'],
            'kondisi' => ['nullable'],
            'dokumen_aset' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,webp', 'between:0,5048'],
            'foto1' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,5048'],
            'foto2' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,5048'],
        ]);

        try {
            $aset->latitude = $request->latitude;
            $aset->nama = $request->nama;
            $aset->latitude = $request->latitude;
            $aset->longitude = $request->longitude;
            $aset->harga = $request->harga;
            $aset->harga_instansi = $request->harga_instansi;
            $aset->letak = $request->letak;
            $aset->asal = $request->asal;
            $aset->penemu = $request->penemu;
            $aset->status = $request->status;
            $aset->kondisi = $request->kondisi;
            $aset->kecamatan_id = $request->kecamatan_id;
            $aset->nama_guide = $request->nama_guide;

            if ($request->hasFile('dokumen_aset')) {
                if($aset->dokumen_aset != '') {
                    try {
                        Storage::delete($aset->dokumen_aset);
                    } catch (\Throwable $th) {
                    }
                }
                $filename = Str::random(32) . '.' . $request->file('dokumen_aset')->getClientOriginalExtension();
                $dokumen_aset_path = $request->file('dokumen_aset')->storeAs('public/dokumen_aset', $filename);
                $aset->dokumen_aset = $request->file('dokumen_aset')->getClientOriginalName();
            }
            $aset->dokumen_aset = isset($dokumen_aset_path) ? $dokumen_aset_path : $aset->dokumen_aset;

            if ($request->hasFile('foto1')) {
                if($aset->foto1 != '') {
                    try {
                        Storage::delete($aset->foto1);
                    } catch (\Throwable $th) {
                    }
                }
                $filename = Str::random(32) . '.' . $request->file('foto1')->getClientOriginalExtension();
                $foto1_path = $request->file('foto1')->storeAs('public/foto1', $filename);
                $aset->foto1 = $request->file('foto1')->getClientOriginalName();
            }
            $aset->foto1 = isset($foto1_path) ? $foto1_path : $aset->foto1;

            if ($request->hasFile('foto2')) {
                if($aset->foto2 != '') {
                    try {
                        Storage::delete($aset->foto2);
                    } catch (\Throwable $th) {
                    }
                }
                $filename = Str::random(32) . '.' . $request->file('foto2')->getClientOriginalExtension();
                $foto2_path = $request->file('foto2')->storeAs('public/foto2', $filename);
                $aset->foto2 = $request->file('foto2')->getClientOriginalName();
            }
            $aset->foto2 = isset($foto2_path) ? $foto2_path : $aset->foto2;

            $aset->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->route('dashboard.aset.index')->with('success', 'Berhasil mengubah data aset.');
    }

    public function destroy($id)
    {
        $aset = Aset::findOrFail($id);
        try {
            $aset->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus aset.');
    }
}
