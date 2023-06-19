<?php

namespace App\Http\Controllers\Api;

use App\Models\Catalog;
use App\Models\ContactModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\NewsModel;
use App\Http\Resources\PostResource;
use App\Models\PengunjungModel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PostController extends Controller
{
    //api news
    public function getNews()
    {
        $news = NewsModel::select('*')->orderBy('id', 'desc')->get();

        // Modifikasi URL gambar
        foreach ($news as $newsItem) {
            $newsItem->foto_url = url('image/upload/' . $newsItem->foto_url);
        }

        return new PostResource(true, 'List Data News', $news);
    }

    public function getImage($filename)
    {
        $filePath = 'public/image/upload/' . $filename;

        if (Storage::exists($filePath)) {
            $fileContents = Storage::get($filePath);
            $response = new Response($fileContents, 200);
            $response->header('Content-Type', 'image');

            return $response;
        } else {
            abort(404, 'File not found');
        }
    }

    public function getImageList()
    {
        $directory = 'public/image/upload';
        $files = Storage::files($directory);

        return response()->json($files);
    }

    public function getNewsDetail($id)
    {
        $news = NewsModel::find($id);

        if ($news) {
            // Modifikasi URL gambar
            $news->foto_url = url('image/upload/' . $news->foto_url);

            return new PostResource(true, 'Detail News', $news);
        } else {
            return new PostResource(false, 'News not found', null);
        }
    }


    //api contact
    public function getContact()
    {
        $contact = ContactModel::select('*')->orderBy('id', 'desc')->get();
        return new PostResource(true, 'List Data Contact', $contact);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function postContact(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            "nama" => "required|min:3",
            "email" => "required|min:5|email",
            "pesan" => "required",
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf pesan tidak dapat kami terima coba lagi',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create post
        $post = ContactModel::create([
            "nama" => $request->input('nama'),
            "email" => $request->input('email'),
            "pesan" => $request->input('pesan'),
            "status" => 0,
        ]);

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Terima kasih telah mengirimkan pesan. Kami akan segera merespon permintaan Anda.',
            'data' => $post
        ], 200);
    }



    public function getpengunjung(Request $request)
    {
        $currentTime = Carbon::now()->setTimezone('Asia/Jakarta');

        PengunjungModel::create([
            'page' => $request->pageURL,
            'ip' => $request->ipAddress,
            'created_at' => $currentTime,
            'updated_at' => $currentTime
        ]);

        return response()->json(['success' => true]);
    }
}