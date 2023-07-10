<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\FotoRequest;
use App\Http\Requests\GambarRequest;
use App\Models\GambarModel;
use App\Models\NewsModel;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class GambarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewgambar()
    {
        $data = array();
        $gambar = GambarModel::select('*')->orderBy('id', 'desc')->paginate(10);
        $data['title'] = "List Gambar";
        $data['gambar'] = $gambar;
        return view('gambar/viewgambar', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addgambar()
    {
        $data = array();
        $data['title'] = "Add Gambar";
        return view('gambar/addgambar', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savegambar(Request $request)
    {
        $request->validate([
            "judul_foto" => [
                "required",
                "min:5",
                Rule::unique('news', 'judul'),
            ],
            'id_news' => [
                'required',
                function ($attribute, $value, $fail) {
                    $news = NewsModel::find($value);
                    if (!$news) {
                        $fail('ID News tidak valid.');
                    }
                },
            ],
            'foto.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            "id_admin" => "required",
        ], [
            'judul_foto.unique' => 'Judul sudah ada di database, coba masukkan judul lain.',
        ]);

        $news = NewsModel::find($request->id_news);

        if ($request->hasFile('foto')) {
            $filenames = [];
            foreach ($request->file('foto') as $image) {
                $filename = $image->getClientOriginalName();
                $image->storeAs('image/upload', $filename, 'public');
                $filenames[] = $filename;
            }

            foreach ($filenames as $filename) {
                GambarModel::create([
                    'judul_foto' => $request->judul_foto,
                    'foto' => $filename,
                    'id_admin' => $request->id_admin,
                    'id_news' => $news->id,
                ]);
            }

            return redirect()->route('viewgambar')->with('message', 'Gambar added successfully');
        }

        return redirect()->route('viewgambar')->with('error', 'Gambar error to add')->withErrors(['foto' => 'Gagal menambahkan gambar. Silakan coba lagi.']);
    }

    public function changegambar($id)
    {
        $data = array();
        $gambar = GambarModel::select('*')
            ->where('id', $id)
            ->first();
        $data['title'] = "Edit Gambar";
        $data['gambar'] = $gambar;
        return view('gambar/changegambar', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updategambar(Request $request)
    {
        $request->validate([
            "judul_foto" => [
                "required",
                "min:5",
                Rule::unique('news', 'judul')->ignore($request->id_news),
            ],
            'id_news' => [
                'required',
                function ($attribute, $value, $fail) {
                    $news = NewsModel::find($value);
                    if (!$news) {
                        $fail('ID News tidak valid.');
                    }
                },
            ],
            'newfoto' => 'image|mimes:jpeg,png,jpg,gif,svg',
            "id_admin" => "required",
        ], [
            'judul_foto.unique' => 'Judul sudah ada di database, coba masukkan judul lain.',
        ]);

        $gambar = GambarModel::find($request->id);

        if (!$gambar) {
            return redirect()->route('viewgambar')->with('error', 'Gambar tidak ditemukan');
        }

        $gambar->judul_foto = $request->judul_foto;
        $gambar->id_news = $request->id_news;
        $gambar->id_admin = $request->id_admin;

        if ($request->hasFile('newfoto')) {
            $fotoLama = $gambar->foto;

            // Hapus foto lama dari penyimpanan
            Storage::disk('public')->delete('image/upload/' . $fotoLama);

            // Upload foto baru
            $fotoBaru = $request->file('newfoto');
            $namaFotoBaru = $fotoBaru->getClientOriginalName();
            $fotoBaru->storeAs('image/upload', $namaFotoBaru, 'public');

            // Simpan nama foto baru
            $gambar->foto = $namaFotoBaru;
        }

        $gambar->save();

        return redirect()->route('viewgambar')->with('message', 'Gambar updated successfully');
    }


    public function detailgambar($id)
    {
        $gambar = GambarModel::find($id);

        if (!$gambar) {
            return redirect()->route('viewgambar')->with('error', 'Gambar not found');
        }

        $data = array();
        $data['title'] = "Detail Gambar";
        $data['gambar'] = $gambar;

        return view('gambar/detailgambar', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletegambar($id)
    {
        $gambar = GambarModel::find($id);

        // Menghapus file foto dari penyimpanan
        Storage::disk('public')->delete('image/upload/' . $gambar->foto);

        // Menghapus data gambar dari database
        $gambar->delete();

        return redirect()->route('viewgambar')->with('message', 'Gambar deleted successfully');
    }
}