<?php

namespace App\Http\Controllers;

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
        $data['title'] = "List news";
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
            "kat_berita" => "required|min:3",
            "judul" => [
                "required",
                "min:5",
                Rule::unique('news', 'judul'),
            ],
            "isi" => "required",
            "excerpt" => "nullable",
            'foto_url.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            "id_admin" => "required",
        ], [
            'judul.unique' => 'Judul sudah ada di database, coba masukkan judul lain.',
        ]);

        $uploadedImages = $request->file('foto_url');
        $filenames = [];

        if ($uploadedImages) {
            foreach ($uploadedImages as $uploadedImage) {
                $destinationPath = public_path('responsive_filemanager/filemanager');
                $filename = $uploadedImage->getClientOriginalName();
                $uploadedImage->move($destinationPath, $filename);
                $filenames[] = $filename;
            }
        }


        $news = NewsModel::create([
            'kat_berita' => $request->kat_berita,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'excerpt' => $request->excerpt,
            'foto_url' => implode(',', $filenames),
            'id_admin' => $request->id_admin,
        ]);

        if ($news) {
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
            "kat_berita" => "required|min:3",
            "judul" => "required|min:5",
            "isi" => "required",
            "excerpt" => "nullable",
            'foto_url.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            "id_admin" => "required",
        ]);

        $news = NewsModel::find($request->id);

        if (!$news) {
            return redirect()->route('viewnews')->with('error', 'News not found');
        }

        $uploadedImages = $request->file('foto_url');
        $filenames = [];

        if ($uploadedImages) {
            foreach ($uploadedImages as $uploadedImage) {
                $destinationPath = public_path('responsive_filemanager/filemanager');
                $filename = $uploadedImage->getClientOriginalName();
                $uploadedImage->move($destinationPath, $filename);
                $filenames[] = $filename;
            }
        }

        $existingFilenames = explode(',', $news->foto_url);
        $mergedFilenames = array_merge($existingFilenames, $filenames);
        $mergedFilenames = array_filter(array_unique($mergedFilenames));
        $mergedFilenames = implode(',', $mergedFilenames);

        $news->foto_url = $mergedFilenames;


        $news->kat_berita = $request->kat_berita;
        $news->judul = $request->judul;
        $news->isi = $request->isi;
        $news->excerpt = $request->excerpt;
        $news->foto_url = implode(',', $filenames);
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

        $imagePaths = explode(',', $news->foto_url);
        foreach ($imagePaths as $imagePath) {
            $imageFullPath = public_path('image/upload/' . $imagePath);
            if (file_exists($imageFullPath)) {
                unlink($imageFullPath);
            }
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