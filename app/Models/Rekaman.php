<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rekaman extends Model
{
    use HasFactory, SoftDeletes;
    
    public $table = "rekamans";

    protected $fillable = [
        'pasien_id','nomor','jenis_pelayanan','poli','diagnosa','terapi','keterangan'
    ];

    /**
     * Get the user that owns the Rekaman
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dataPasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'id');
    }
}
