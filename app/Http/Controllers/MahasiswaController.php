<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = ['nama'=> "aca", 'foto'=> 'avatar3.png'];
        $mahasiswa = Mahasiswa::with('prodi')->get();
        return view('mahasiswa.index', compact('data', 'mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          $data = ['nama'=> "aca", 'foto'=> 'avatar3.png'];
          $prodi = Prodi::All();
            return view('mahasiswa.create', compact('data','prodi'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'Nim' => 'required|string|unique:mahasiswa,Nim',
            'Nama' => 'required|string|max:255',
            'Tanggallahir' => 'required|date',
            'Telp' => 'required|string|max:20',
            'Email' => 'required|email|unique:mahasiswa,Email',
            'password' => 'required|string|min:8',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'id' => 'required|exists:prodi,id'
        ]);

        $data = $request->except(['_token']);
        
        // Hash password
        $data['password'] = bcrypt($request->password);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('mahasiswa', 'public');
        }

        Mahasiswa::create($data);
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = ['nama'=> "aca", 'foto'=> 'avatar3.png'];
        $mahasiswa = Mahasiswa::findOrFail($id);
        $prodi = Prodi::All();
        return view('mahasiswa.edit', compact('data', 'mahasiswa', 'prodi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $Nim)
    {
        $request->validate([
            'Nama' => 'required|string|max:255',
            'Tanggallahir' => 'required|date',
            'Telp' => 'required|string|max:20',
            'Email' => 'required|email|unique:mahasiswa,Email,' . $Nim . ',Nim',
            'password' => 'nullable|string|min:8',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'id' => 'required|exists:prodi,id'
        ]);

        $mahasiswa = Mahasiswa::findOrFail($Nim);

        $data = $request->only(['Nama', 'Tanggallahir', 'Telp', 'Email', 'id']);

        // Handle password update
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
                Storage::disk('public')->delete($mahasiswa->foto);
            }

            $data['foto'] = $request->file('foto')->store('mahasiswa', 'public');
        }

        $mahasiswa->update($data);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        
        // Delete photo if exists
        if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
            Storage::disk('public')->delete($mahasiswa->foto);
        }
        
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa Berhasil Dihapus');
    }
}
