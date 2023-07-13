<?php

namespace App\Http\Controllers;

use App\Models\AnggotaModel;
use App\Models\ContactModel;
use App\Models\GambarModel;
use App\Models\NewsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReaderController extends Controller
{
    public function detailreader($id)
    {
        $news = NewsModel::find($id);
        if (!$news) {
            return redirect()->route('viewnews')->with('error', 'News not found');
        }

        $previousPost = NewsModel::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $nextPost = NewsModel::where('id', '>', $id)->orderBy('id', 'asc')->first();
        $recentPosts = NewsModel::orderBy('id', 'desc')->take(5)->get();

        $gambar = GambarModel::where('id_news', $id)->get();

        $data = [
            'title' => $news->judul,
            'news' => $news,
            'gambar' => $gambar,
            'previousPost' => $previousPost,
            'nextPost' => $nextPost,
            'recentPosts' => $recentPosts,
        ];

        return view('readers/detailreader', $data);
    }

    public function category($kat_berita)
    {
        $title = "Category - $kat_berita";
        $perPage = 10; // Jumlah berita per halaman (sesuaikan dengan kebutuhan Anda)

        $newsQuery = NewsModel::orderBy('created_at', 'desc');

        if ($kat_berita !== 'Lastest News') {
            $newsQuery->where('kat_berita', $kat_berita);
        }

        $news = $newsQuery->paginate($perPage);

        return view('readers/category', [
            'title' => $title,
            'news' => $news,
            'kat_berita' => $kat_berita,
        ]);
    }

    public function aboutus()
    {   $data = array();
        $anggota = AnggotaModel::select('*')->orderBy('id', 'asc')->paginate(10);
        $data['title'] = "About LPM Paraga";
        $data['anggota'] = $anggota;
        return view('readers/aboutus', $data);
    }

    public function contactus()
    {
        $title = "Contact LPM Paraga";
        return view('readers/contactus', [
            'title' => $title,
        ]);
    }

    public function sendmessage(Request $request)
    {
        $request->validate([
            "nama" => "required|min:3",
            "email" => "required|min:5|email",
            "pesan" => "required",
        ]);

        $contact = ContactModel::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan,
            "status" => 0,
        ]);

        if ($contact) {
            return redirect()->route('contactus')->with('message', 'Message has been sent');
        } else {
            return redirect()->route('contactus')->with('error', 'Failed to send message');
        }
    }
}