<?php

namespace App\Http\Controllers;

use App\Models\NewsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use illuminate\validation;
use Illuminate\Http\UploadedFile;

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

        $filenames = [];
        if ($request->hasFile('foto_url')) {
            foreach ($request->file('foto_url') as $image) {
                $filenames[] = $image->getClientOriginalName();
                $image->storeAs('image/upload', $image->getClientOriginalName(), 'public');
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

        // Menghapus gambar yang dipilih dari sistem file server
        if ($request->has('deleted_images')) {
            foreach ($request->deleted_images as $deletedImage) {
                // Mendapatkan path lengkap gambar
                $imagePath = public_path('path/to/image/') . $deletedImage;

                // Memeriksa apakah file gambar ada
                if (file_exists($imagePath)) {
                    // Menghapus file gambar dari sistem file server
                    unlink($imagePath);
                }

                // Hapus juga dari database berdasarkan logika aplikasi Anda
                $news->images()->where('filename', $deletedImage)->delete();
            }
        }

        $filenames = [];

        if ($request->hasFile('foto_url')) {
            foreach ($request->file('foto_url') as $image) {
                // Memeriksa apakah file tersebut valid dan merupakan file gambar
                if ($image->isValid() && $image->getMimeType() && str_starts_with($image->getMimeType(), 'image/')) {
                    $filenames[] = $image->getClientOriginalName();
                    $image->storeAs('image/upload', $image->getClientOriginalName(), 'public');
                }
            }
        }

        // Menggabungkan file yang diunggah dengan file yang sudah ada
        if (!empty($request->foto_url)) {
            $existingFilenames = explode(',', $request->foto_url);
            $filenames = array_merge($filenames, $existingFilenames);
        }

        // Menghapus duplikat dan menghapus elemen kosong dari array
        $filenames = array_filter(array_unique($filenames));

        // Menggabungkan kembali array menjadi string
        $mergedFilenames = implode(',', $filenames);

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

        return view('news.detailnews', $data);
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
