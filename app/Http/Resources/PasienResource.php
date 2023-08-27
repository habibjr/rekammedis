<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PasienResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'nik' => $this->nik,
            'name' => $this->name,
            'tgl_lahir' => $this->tgl_lahir,
            'alamat' => $this->alamat,
            'agama' => $this->agama,
            'pekerjaan' => $this->pekerjaan,
            'jenis_kelamin' => $this->jenis_kelamin,
            'created_at' => date_format($this->created_at,"Y-m-d H:i:s"),
            
        ];


    }
}
