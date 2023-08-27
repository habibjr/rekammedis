<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PasienDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nik' => $this->nik,
            'name' => $this->name,
            'tgl_lahir' => $this->tgl_lahir,
            'alamat' => $this->alamat,
            'jenis_kelamin' => $this->jenis_kelamin,
            'agama' => $this->agama,
            'pekerjaan' => $this->pekerjaan,
            'created_at' => date_format($this->created_at,"Y-m-d H:i:s"),
            'pasienrekam' => $this->whenLoaded('pasienrekam', function () {
                return collect($this->pasienrekam)->each(function ($pasienrekam) {
                //return collect($this->pasienrekam)->where("diagnosa",'!=',null)->each(function ($pasienrekam) {
                return $pasienrekam;

                 });

            })
        ];
    }
}
