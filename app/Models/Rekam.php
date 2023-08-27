<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rekam extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'nomor', 'nik', 'name', 'tgl_lahir', 'alamat', 'jenis_kelamin', 'agama', 'pekerjaan', 'jenis_pelayanan', 'poli', 'diagnosa', 'terapi', 'keterangan'
    ];
}
