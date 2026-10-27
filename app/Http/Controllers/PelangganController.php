<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $cari   = $request->input('cari', '');
        $level  = $request->input('level', '');
        $status = $request->input('status', '');

        $pelanggan = Pelanggan::query()
            ->when($cari, function ($q) use ($cari) {
                $q->where(function ($q) use ($cari) {
                    $q->where('nama', 'like', "%$cari%")
                      ->orWhere('email', 'like', "%$cari%")
                      ->orWhere('no_hp', 'like', "%$cari%");
                });
            })
            ->when($level, fn ($q) => $q->where('level_member', $level))
            ->when($status, fn ($q) => $q->where('status', $status))
            ->orderByDesc('id')
            ->get();

        return view('pelanggan.index', compact('pelanggan', 'cari', 'level', 'status'));
    }

    public function create()
    {
        return view('pelanggan.form');
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);
        $data['tanggal_bergabung'] = now()->toDateString();
        Pelanggan::create($data);

        return redirect()->route('pelanggan.index');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.form', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $pelanggan->update($this->validasi($request));

        return redirect()->route('pelanggan.index');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect()->route('pelanggan.index');
    }

    private function validasi(Request $request)
    {
        return $request->validate([
            'nama'          => 'required|string|max:100',
            'email'         => 'nullable|email|max:100',
            'no_hp'         => 'nullable|string|max:20',
            'alamat'        => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'level_member'  => 'required|in:basic,gold,vip',
            'status'        => 'required|in:aktif,nonaktif',
        ]);
    }
}