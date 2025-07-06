<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $data = ['nama' => "aca", 'foto' => 'avatar3.png'];
        $prodi = Prodi::all();
        return view('prodi.index', compact('data', 'prodi'));
    }

    public function create()
    {
        $data = ['nama' => "aca", 'foto' => 'avatar3.png'];
        return view('prodi.create', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kaprodi' => 'required|string|max:255',
            'Jurusan' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama Prodi wajib diisi!',
            'nama.string' => 'Nama Prodi harus berupa teks!',
            'nama.max' => 'Nama Prodi maksimal 255 karakter!',
            'kaprodi.required' => 'Kaprodi wajib diisi!',
            'kaprodi.string' => 'Kaprodi harus berupa teks!',
            'kaprodi.max' => 'Kaprodi maksimal 255 karakter!',
            'Jurusan.required' => 'Jurusan wajib diisi!',
            'Jurusan.string' => 'Jurusan harus berupa teks!',
            'Jurusan.max' => 'Jurusan maksimal 255 karakter!',
        ]);

        Prodi::create([
            'nama' => $request->nama,
            'kaprodi' => $request->kaprodi,
            'Jurusan' => $request->Jurusan,
        ]);

        return redirect()->route('prodi.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $data = ['nama' => "aca", 'foto' => 'avatar3.png'];
        $prodi = Prodi::findOrFail($id);
        return view('prodi.edit', compact('data', 'prodi'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kaprodi' => 'required|string|max:255',
            'Jurusan' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama Prodi wajib diisi!',
            'nama.string' => 'Nama Prodi harus berupa teks!',
            'nama.max' => 'Nama Prodi maksimal 255 karakter!',
            'kaprodi.required' => 'Kaprodi wajib diisi!',
            'kaprodi.string' => 'Kaprodi harus berupa teks!',
            'kaprodi.max' => 'Kaprodi maksimal 255 karakter!',
            'Jurusan.required' => 'Jurusan wajib diisi!',
            'Jurusan.string' => 'Jurusan harus berupa teks!',
            'Jurusan.max' => 'Jurusan maksimal 255 karakter!',
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update([
            'nama' => $request->nama,
            'kaprodi' => $request->kaprodi,
            'Jurusan' => $request->Jurusan,
        ]);
        return redirect()->route('prodi.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();
        return redirect()->route('prodi.index')->with('success', 'Data berhasil dihapus');
    }
}
