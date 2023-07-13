<?php

namespace App\Http\Controllers;

use App\Models\GambarModel;
use App\Models\NewsModel;
use App\Models\PengunjungModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function home()
    {
        $pengunjung_data =  PengunjungModel::select(DB::raw('count(*) as count'), DB::raw('date(created_at)as date'))
            ->groupby('date')
            ->get();
        $cdate = [];
        $ccount = [];
        foreach ($pengunjung_data as $visitor) {
            $cdate[] = $visitor->date;
            $ccount[] = $visitor->count;
        }
        $result = PengunjungModel::select('t.day', DB::raw('COUNT(s.id) as total_users'))
            ->from(DB::raw('(
            SELECT CURDATE() - INTERVAL 6 DAY AS day UNION ALL
            SELECT CURDATE() - INTERVAL 5 DAY AS day UNION ALL
            SELECT CURDATE() - INTERVAL 4 DAY AS day UNION ALL
            SELECT CURDATE() - INTERVAL 3 DAY AS day UNION ALL
            SELECT CURDATE() - INTERVAL 2 DAY AS day UNION ALL
            SELECT CURDATE() - INTERVAL 1 DAY AS day UNION ALL
            SELECT CURDATE() AS day
                ) AS t'))
            ->leftJoin('statistik_pengunjung AS s', DB::raw('t.day'), '=', DB::raw('DATE(s.created_at)'))
            ->groupBy('t.day')
            ->get();
        $totalMonthlyVisitors = PengunjungModel::select(DB::raw('COUNT(*) as totalMonthlyVisitors, YEAR(created_at) as year, MONTH(created_at) as month'))
            ->whereYear('created_at', '=', date('Y'))
            ->whereMonth('created_at', '=', date('m'))
            ->groupBy('year', 'month')
            ->get();
        $totalOnline = PengunjungModel::whereDate('created_at', '=', date('Y-m-d'))->count();
        $title = "Dashboard";
        $news = array();
        $news = NewsModel::select('*')->orderBy('id', 'desc')->paginate(10);
        foreach ($news as $nws) {
            $beritaId = $nws->id;

            // Menghitung jumlah pengunjung yang melihat berita berdasarkan ID
            $jumlahDilihat = PengunjungModel::where('page', 'LIKE', '%readers/detail/'.$beritaId)->count();

            // Menambahkan data jumlah dilihat ke dalam objek berita
            $nws->dilihat = $jumlahDilihat;
        }
        return view('index', [
            'index' => $result,
            'chartcount' => $ccount,
            'chartdate' => $cdate,
            'totalMonthlyVisitors' => $totalMonthlyVisitors,
            'totalOnline' => $totalOnline,
            'title' => $title,
            'news' => $news,
        ]);
    }
    public function readers()
    {
        $data = array();
        $news = NewsModel::with('gambar')->orderBy('id', 'desc')->paginate(10);
        $data['title'] = "Home";
        $data['news'] = $news;

        return view('readers/readers', $data);
    }
}