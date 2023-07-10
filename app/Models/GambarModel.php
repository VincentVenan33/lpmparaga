<?php

namespace App\Models;

use App\Models\NewsModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GambarModel extends Model
{
    use HasFactory;
    protected $table = 'gambar';
    protected $primaryKey = 'id';
    protected $fillable = ['judul_foto', 'id_news', 'foto', 'id_admin'];

    public function news()
    {
        return $this->belongsTo(NewsModel::class, 'id', 'id_news');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function getFotoUrlAttribute()
    {
        return url('') . Storage::url($this->attributes['foto']);
    }
}