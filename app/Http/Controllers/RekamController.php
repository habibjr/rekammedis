<?php

namespace App\Http\Controllers;

use App\Http\Resources\RekamDetailResource;
use App\Http\Resources\RekamResource;
use App\Models\Rekam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RekamController extends Controller
{
    public function index()
    {
        $rekam = Rekam::all();
        //return response()->json(['data' => $rekam]);
        return RekamResource::collection($rekam);
    }

    public function show($id)
    {
        //$post = Rekam::with('writer:id,username')->findOrFail($id);
        $post = Rekam::findOrFail($id);
        
        return new RekamDetailResource($post);
    }

    public function store(Request $request)
    {
        //return $request->document;
        //dd(Auth::user());
        $validated = $request->validate([
            'nomor' => 'required',
            'nik' => 'required',
            'name' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'jenis_pelayanan' => 'required',
            'poli' => 'required',
            
        ]);

        //$document = null;
        //if ($request->file) {
        //    $filename = $this->generateRandomString();
        //    $extension = $request->file->extension();
        //    $document = $filename.'.'.$extension;

        //    Storage::putFileAs('document', $request->file, $document);
        //}


        //$request['document'] = $document;
        //$request['user_id'] = Auth::user()->id;
        $post = Rekam::create($request->all());
        return new RekamDetailResource($post);


    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'diagnosa' => 'required',
            'terapi' => 'required'
            //'keterangan' => 'required'
        ]);

        $post = Rekam::findOrFail($id);
        $post->update($request->all());

        return new RekamDetailResource($post);
    }

    public function destroy($id)
    {
        $post = Rekam::findOrFail($id);
        $post->delete();

        return new RekamDetailResource($post);
    }

    public function getdatarekammedis()
    {
        $rekam = Rekam::where('terapi','!=',null)->get();
        //return response()->json(['data' => $rekam]);
        return RekamResource::collection($rekam);
    }

    public function getdaftarepasien()
    {
  

        $poli = Auth::user()->poli;
        $data3 = Rekam::whereDate("created_at",'=',Carbon::today())
        ->where("diagnosa","=",null)
        ->where("poli","=",$poli)
        ->get();

        return response()->json(['data' => $data3]);
        //return response()->json(['data' => $poli]);
    }
    

    public function getallpasien()
    {
        $poli = Auth::user()->poli;
        $data3 = Rekam::whereDate("created_at",'=',Carbon::today())
        ->where("diagnosa","=",null)
        ->where("poli","=",$poli)
        ->get();
        $data3 = count($data3);

        return response()->json(['data' => $data3]);
        //return response()->json(['data' => $poli]);
    }

    

}
