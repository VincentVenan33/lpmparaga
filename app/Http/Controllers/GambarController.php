<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\FotoRequest;
use App\Http\Requests\GambarRequest;
use App\Models\GambarModel;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

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
    public function store(GambarRequest $request)
    {
        $data = $request->all();

        if($request->file('foto')){
            $data['foto'] = $request->file('foto')->store('assets/foto', 'public');
        }

        GambarModel::create($data);

        return redirect()->route('gambar/viewgambar');
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
    public function update(Request $request, GambarModel $gambar)
    {
        $data = $request->all();

        Validator([
            'id_admin' => [
                'required',
            ],
            'id_berita' => [
                'required',
            ],
        ]);


        if($request->file('foto')){
            $data['foto'] = $request->file('foto')->store('assets/foto', 'public');

            //remove URL/storage from getAttribute model foto
            $temp = URL::to('/')."/storage/";
            $temp1 = Str::remove($temp, $gambar['foto_url']);
            //delete photo
            Storage::disk('public')->delete($temp1);
        }

        $gambar->update($data);

        return redirect()->route('gambar/viewgambar');
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
    public function destroy(GambarModel $gambar)
    {
        $gambar->delete();

        return redirect()->route('gambar/viewgambar');
    }
}