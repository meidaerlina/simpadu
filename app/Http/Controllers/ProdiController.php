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
