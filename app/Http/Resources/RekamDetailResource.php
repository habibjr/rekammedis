<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RekamDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'nomor' => $this->nomor,
            'nik' => $this->nik,
            'name' => $this->name,
            'tgl_lahir' => $this->tgl_lahir,
            'alamat' => $this->alamat,
            'jenis_kelamin' => $this->jenis_kelamin,
            'agama' => $this->agama,
            'pekerjaan' => $this->pekerjaan,
            'jenis_pelayanan' => $this->jenis_pelayanan,
            'poli' => $this->poli,
            'diagnosa' => $this->diagnosa,
            'terapi' => $this->terapi,
            'keterangan' => $this->keterangan,
            'created_at' => date_format($this->created_at,"Y/m/d H:i:s")
        ];
    }
}
