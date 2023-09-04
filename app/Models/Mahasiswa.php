<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    public $table = "mahasiswa";

    protected $fillable = [
        'id', 'nama', 'alamat', 'created_at', 'updated_at'
    ];
}