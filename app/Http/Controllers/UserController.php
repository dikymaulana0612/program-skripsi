<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('master.user.index', [
            'title' => 'List User',
            'datatable' => true
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User'
        ];
        return view('master.user.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'alamat' => ['nullable'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required'],
            'role' => ['required'],
            'dokumen' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,webp,pdf,doc,docx,xls,xlsx,ppt', 'between:0,10048'],
        ]);

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->alamat = $request->alamat;
            $user->password = Hash::make($request->password);
            $user->status_pengunjung = $request->status_pengunjung;
            $user->role = $request->role;
            $user->is_aktif = $request->is_aktif;

            if ($user->role == 'pengelola') {
                $user->is_aktif = 0;
                $user->penanggung_jawab = $request->penanggung_jawab;
            } else if ($user->role == 'pengunjung') {
                $user->is_aktif = 1;
                $user->instansi = $request->instansi;
                $user->asal = $request->asal;
                $user->status_pengunjung = $request->status_pengunjung;
            }

            if ($request->hasFile('dokumen')) {
                $filename = Str::random(32) . '.' . $request->file('dokumen')->getClientOriginalExtension();
                $dokumen_path = $request->file('dokumen')->storeAs('public/dokumen', $filename);
            }

            $user->dokumen = isset($dokumen_path) ? $dokumen_path : '';

            $user->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat user: ' . $e->getMessage());
        }

        return redirect()->route('dashboard.user.index')->with('success', 'Berhasil membuat user.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $data = [
            'data' => $user,
            'title' => 'Edit User'
        ];

        return view('master.user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => ['required'],
            'alamat' => ['nullable'],
            'email' => ['required', 'unique:users,email,' . $id],
            'password' => ['nullable'],
            'role' => ['required'],
            'dokumen' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,webp,pdf,doc,docx,xls,xlsx,ppt', 'between:0,10048'],
        ]);

        try {
            $user->name = $request->name;
            $user->alamat = $request->alamat;
            $user->email = $request->email;
            $user->status_pengunjung = $request->status_pengunjung;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            $user->role = $request->role;
            $user->is_aktif = $request->is_aktif;

            if ($user->role == 'pengelola') {
                $user->penanggung_jawab = $request->penanggung_jawab;
            } else if ($user->role == 'pengunjung') {
                $user->instansi = $request->instansi;
                $user->asal = $request->asal;
                $user->status_pengunjung = $request->status_pengunjung;
            }

            if ($request->hasFile('dokumen')) {
                if($user->dokumen != '') {
                    try {
                        Storage::delete($user->dokumen);
                    } catch (\Throwable $th) {
                    }
                }
                $filename = Str::random(32) . '.' . $request->file('dokumen')->getClientOriginalExtension();
                $dokumen_path = $request->file('dokumen')->storeAs('public/dokumen', $filename);
                $user->dokumen = $request->file('dokumen')->getClientOriginalName();
            }
            $user->dokumen = isset($dokumen_path) ? $dokumen_path : $user->dokumen;

            $user->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupdate user: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate user.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try {
            if($user->foto != '') {
                try {
                    Storage::delete($user->foto);
                } catch (\Throwable $th) {
                }
            }
            $user->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus data user.');
    }

    public function profile()
    {
        $user = Auth::user();
        $data = [
            'title' => 'Profile Anda',
            'data' => $user
        ];

        return view('master.user.profile', $data);
    }

    public function profile_update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $request->validate([
            'name' => ['required'],
            'alamat' => ['nullable'],
            'email' => ['nullable', 'unique:users,email,' . $user->id],
            'password' => ['nullable'],
            'dokumen' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,pdf,doc,docx,webp,ppt,pptx,xls,xlsx', 'between:0,1048'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->status_pengunjung = $request->status_pengunjung;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->penanggung_jawab = $request->penanggung_jawab;
        $user->instansi = $request->instansi;
        $user->asal = $request->asal;
        $user->status_pengunjung = $request->status_pengunjung;

        if ($request->hasFile('dokumen')) {
            if($user->dokumen != '') {
                try {
                    Storage::delete($user->dokumen);
                } catch (\Throwable $th) {
                }
            }
            $filename = Str::random(32) . '.' . $request->file('dokumen')->getClientOriginalExtension();
            $dokumen_path = $request->file('dokumen')->storeAs('public/dokumen', $filename);
            $user->dokumen = $request->file('dokumen')->getClientOriginalName();
        }
        $user->dokumen = isset($dokumen_path) ? $dokumen_path : $user->dokumen;

        $user->save();

        return redirect()->back()->with('success', 'Berhasil mengupdate profile');
    }
}
