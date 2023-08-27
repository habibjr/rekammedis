<?php

namespace App\Http\Controllers;

use App\Http\Resources\PasienDetailResource;
use App\Http\Resources\PasienResource;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    function index() {
        $pasien = Pasien::all();

        //return response()->json(['data' => $pasien]);
        return PasienResource::collection($pasien); 

        
    }

    function show($id){
        $pasien = Pasien::findOrFail($id);
        //return response()->json(['data' => $pasien]);
        return new PasienDetailResource($pasien);
    }

    function tambah_pasien(Request $request){
        
        $validate = $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
        ]);

        $pasien = Pasien::create($request->all());
        return new PasienDetailResource($pasien);
    }

    function delete_pasien($id) {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();
        return new PasienDetailResource($pasien);
    }


    function indexall() {
        $pasien = Pasien::all();
        return PasienDetailResource::collection($pasien->loadMissing(['pasienrekam'])); 
        
    }


    function lihatdatarekampasien($id) {
        $pasien = Pasien::findOrFail($id);
        //return PasienDetailResource::collection($pasien->loadMissing(['pasienrekam'])); 
        // $data3 = Rekam::whereDate("created_at",'=',Carbon::today())
        // ->where("diagnosa","=",null)
        return new PasienDetailResource($pasien->loadMissing(['pasienrekam'])); 
        
    }


    








}
