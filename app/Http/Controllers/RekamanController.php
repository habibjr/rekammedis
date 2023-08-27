<?php

namespace App\Http\Controllers;

use App\Http\Resources\RekamanResource;
use App\Models\Rekaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekamanController extends Controller
{
    function buatrekaman(Request $request) {

        $validate = $request->validate([
            'pasien_id'=> 'required|exists:pasiens,id',
            'nomor' => 'required',
            'jenis_pelayanan' => 'required',
            'poli' => 'required',
        ]);

        //$rekaman = Rekaman::create($request->all());

        $buat = Rekaman::create($request->all());

        //return response()->json($buat->loadMissing(['dataPasien']));
        return new RekamanResource($buat->loadMissing(['dataPasien:id,name,jenis_kelamin']));

        
    }


    function updaterekaman(Request $request, $id) {
        $validate = $request->validate([
            'diagnosa'=> 'required',
            'terapi' => 'required',
            'keterangan' => 'required',
        ]);


        $rekaman = Rekaman::findOrFail($id);
        $rekaman->update($request->all());

        return new RekamanResource($rekaman->loadMissing(['dataPasien:id,name,jenis_kelamin']));


    }

    function hapusrekaman($id) {
        $rekaman = Rekaman::findOrFail($id);
        $rekaman->delete();
        
    }


    public function getdaftarepasien2()
    {
  

        $poli = Auth::user()->poli;
        $data3 = Rekaman::whereDate("created_at",'=',Carbon::today())
        ->where("diagnosa","=",null)
        ->where("poli","=",$poli)
        ->get();

        //return response()->json(['data' => $data3]);
        return RekamanResource::collection($data3->loadMissing(['dataPasien']));
    }

    public function getallpasien2()
    {
        $poli = Auth::user()->poli;
        $data3 = Rekaman::whereDate("created_at",'=',Carbon::today())
        ->where("diagnosa","=",null)
        ->where("poli","=",$poli)
        ->get();
        $data3 = count($data3);

        return response()->json(['data' => $data3]);
        //return response()->json(['data' => $poli]);
    }
}
