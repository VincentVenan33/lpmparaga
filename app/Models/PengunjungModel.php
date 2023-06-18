<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengunjungModel extends Model
{
    use HasFactory;
    protected $table = 'statistik_pengunjung';
    protected $primaryKey = 'id';
    protected $fillable = ['page', 'ip', 'created_at', 'updated_at'];
}