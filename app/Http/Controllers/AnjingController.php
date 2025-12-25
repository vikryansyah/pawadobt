<?php

namespace App\Http\Controllers;

use App\Models\Anjing;
use Illuminate\Http\Request;

class AnjingController extends Controller
{
    // ambil semua data (buat tabel)
    public function index()
    {
        $anjings = Anjing::latest()->get();
        return view('anjing.index', compact('anjings'));
    }

    // simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'ras' => 'required',
            'umur' => 'required|numeric',
            'gender' => 'required',
            'status' => 'required'
        ]);

        Anjing::create($request->all());

        return redirect()->back()->with('success', 'Anjing berhasil ditambahkan');
    }
}
