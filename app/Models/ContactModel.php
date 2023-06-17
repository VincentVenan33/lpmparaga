<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    use HasFactory;
    protected $table = 'contact';
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'email', 'pesan'];
}