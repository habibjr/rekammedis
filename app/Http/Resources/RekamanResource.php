<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RekamanResource extends JsonResource
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
            'pasien_id' => $this->pasien_id,
            'nomor' => $this->nomor,
            'poli' => $this->poli,
            'jenis_pelayanan' => $this->jenis_pelayanan,
            'created_at' => date_format($this->created_at,"Y-m-d H:i:s"),
            'pasien' => $this->whenLoaded('dataPasien', function (){
                return collect($this->dataPasien)->each(function ($dataPasien) {
                    //return collect($this->pasienrekam)->where("diagnosa",'!=',null)->each(function ($pasienrekam) {
                    return $dataPasien;
    
                     });
            }),


    

        
        ];
    }
}
