<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasien extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nik','name','tgl_lahir','alamat','jenis_kelamin','agama','pekerjaan',
    ];

    // /**
    //  * The roles that belong to the Pasien
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    //  */
    // public function rekammedis(): BelongsToMany
    // {
    //     return $this->belongsToMany(Rekaman::class, 'rekamans', 'user_id', 'pasien_id');
    // }

    /**
     * Get all of the comments for the Pasien
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pasienrekam(): HasMany
    {
        return $this->hasMany(Rekaman::class, 'pasien_id', 'id');
    }
}
