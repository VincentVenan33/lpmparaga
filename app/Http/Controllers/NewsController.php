<?php

namespace App\Http\Controllers;

use App\Models\GambarModel;
use App\Models\NewsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;


class NewsController extends Controller
{
    public function viewnews()
    {
        $data = array();
        $news = NewsModel::select('*')->orderBy('id', 'desc')->paginate(10);
        $data['title'] = "List News";
        $data['news'] = $news;
        return view('news/viewnews', $data);
    }

    public function addnews()
    {
        $data = array();
        $data['title'] = "Add News";
        return view('news/addnews', $data);
    }

    public function savenews(Request $request)
    {
        $request->validate([
            "kat_berita" => "required",
            "judul" => [
                "required",
                "min:5",
                Rule::unique('news', 'judul'),
            ],
            "isi" => "required",
            "excerpt" => "nullable",
            'foto.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            "id_admin" => "required",
        ], [
            'judul.unique' => 'Judul sudah ada di database, coba masukkan judul lain.',
        ]);
        $filenames = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $image) {
                $filenames[] = $image->getClientOriginalName();
                $image->storeAs('image/upload', $image->getClientOriginalName(), 'public');
            }
        }

        $news = NewsModel::create([
            'kat_berita' => $request->kat_berita,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'excerpt' => $request->excerpt,
            'id_admin' => $request->id_admin,
        ]);

        if ($news) {
            foreach ($filenames as $filename) {
                GambarModel::create([
                    'judul_foto' => $request->judul,
                    'foto' => $filename,
                    'id_admin' => $request->id_admin,
                    'id_news' => $news->id,
                ]);
            }
            return redirect()->route('viewnews')->with('message', 'News added successfully');
        } else {
            return redirect()->route('viewnews')->with('error', 'News error to add');
        }

        return redirect()->route('viewnews');
    }


    public function changenews($id)
    {
        $data = array();
        $news = NewsModel::select('*')
            ->where('id', $id)
            ->first();
        $data['title'] = "Edit News";
        $data['news'] = $news;
        return view('news/changenews', $data);
    }

    public function updatenews(Request $request)
    {
        $request->validate([
            "kat_berita" => "required",
            "judul" => "required|min:5",
            "isi" => "required",
            "excerpt" => "nullable",
            "id_admin" => "required",
        ]);

        $news = NewsModel::find($request->id);

        if (!$news) {
            return redirect()->route('viewnews')->with('error', 'News not found');
        }

        // Update news
        $news->kat_berita = $request->kat_berita;
        $news->judul = $request->judul;
        $news->isi = $request->isi;
        $news->excerpt = $request->excerpt;
        $news->id_admin = $request->id_admin;

        if ($news->save()) {
            return redirect()->route('viewnews')->with('message', 'News updated successfully');
        } else {
            return redirect()->route('viewnews')->with('error', 'News error to update');
        }
    }

    public function detailnews($id)
    {
        $news = NewsModel::find($id);

        if (!$news) {
            return redirect()->route('viewnews')->with('error', 'News not found');
        }

        $data = array();
        $data['title'] = "Detail News";
        $data['news'] = $news;

        return view('news/detailnews', $data);
    }

    public function deletenews($id)
    {
        $news = NewsModel::find($id);

        if (!$news) {
            return redirect()->route('viewnews')->with('error', 'News not found');
        }

        $news->delete();

        return redirect()->route('viewnews')->with('message', 'News deleted successfully');
    }

    public function getFile($filename)
    {
        $filePath = 'public/image/upload/' . $filename;
        if (Storage::exists($filePath)) {
            $fileContents = Storage::get($filePath);
            return response($fileContents, 200)->header('Content-Type', 'image');
        } else {
            return response()->json(['message' => 'File not found.'], 404);
        }
    }

    public function getListFiles()
    {
        $directory = 'public/image/upload';
        $files = Storage::files($directory);

        return response()->json($files);
    }
}