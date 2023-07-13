<?php

namespace App\Http\Controllers;

use App\Models\AnggotaModel;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function viewanggota()
    {
        $data = array();
        $anggota = AnggotaModel::select('*')->orderBy('id', 'asc')->paginate(10);
        $data['title'] = "List Anggota Paraga";
        $data['anggota'] = $anggota;
        return view('anggota/viewanggota', $data);
    }

    public function addanggota()
    {
        $data = array();
        $data['title'] = "Add Anggota";
        return view('anggota/addanggota', $data);
    }

    public function saveanggota(Request $request)
    {
        $request->validate([
            "nama" => "required|min:3",
            "jabatan" => "required|min:3",
        ]);

        $anggota = AnggotaModel::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
        ]);

        if ($anggota->save()) {
            return redirect()->route('viewanggota')->with('message', 'Anggota added successfully');
        } else {
            return redirect()->route('viewanggota')->with('error', 'Anggota error to add');
        }

        return redirect()->route('viewanggota');
    }


    public function changeanggota($id)
    {
        $data = array();
        $anggota = AnggotaModel::select('*')
            ->where('id', $id)
            ->first();
        $data['title'] = "Edit Anggota";
        $data['anggota'] = $anggota;
        return view('anggota/changeanggota', $data);
    }

    public function updateanggota(Request $request)
    {
        $request->validate([
            "nama" => "required|min:3",
            "jabatan" => "required|min:3",
        ]);

        $anggota = AnggotaModel::find($request->id);

        if (!$anggota) {
            return redirect()->route('viewanggota')->with('error', 'Anggota not found');
        }

        // Update anggota
        $anggota->nama = $request->nama;
        $anggota->jabatan = $request->jabatan;

        if ($anggota->save()) {
            return redirect()->route('viewanggota')->with('message', 'Anggota updated successfully');
        } else {
            return redirect()->route('viewanggota')->with('error', 'Anggota error to update');
        }
    }

    public function detailanggota($id)
    {
        $anggota = AnggotaModel::find($id);

        if (!$anggota) {
            return redirect()->route('viewanggota')->with('error', 'Anggota not found');
        }

        $data = array();
        $data['title'] = "Detail Anggota";
        $data['anggota'] = $anggota;

        return view('anggota/detailanggota', $data);
    }

    public function deleteanggota($id)
    {
        $anggota = AnggotaModel::find($id);

        if (!$anggota) {
            return redirect()->route('viewanggota')->with('error', 'Anggota not found');
        }

        $anggota->delete();

        return redirect()->route('viewanggota')->with('message', 'Anggota deleted successfully');
    }
}