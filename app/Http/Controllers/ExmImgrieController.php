<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\modeles\examenimagrie;
use App\modeles\demandeExamImag;
class ExmImgrieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request,$consultID)
      {
             $examsImagerie = json_encode($request->examRad);
            $a =   demandeExamImag::create([
                     "infclinpert"=>$request->infclinpert,
                     "expdemdiag"=>$request->expdemdiag,
                     "allergie"=> (isset($request->Allergie)) ? true : false,
                     "diabete"=>(isset($request->Diabete)) ? true : false,
                     "insufRenale"=>(isset($request->insufRenale)) ? true : false,
                     "grossesse"=>(isset($request->grossesse)) ? true : false,
                     "implant"=>(isset($request->implant)) ? true : false,
                     "autrepatho" => (isset($request->autrepatho)) ? $request->autrepatho : "",
                     "examsImagerie"=>$examsImagerie,
                     "id_consultation"=>$consultID,
            ]);
        }
    public function storeOld(Request $request)
    {
        $date = Date::Now();
        $fileName = $request->file('examan')->getClientOriginalName();
        Storage::disk('local')->put($fileName,file_get_contents($request->file('examan')->getRealPath()));
        examenimagrie::create([
            "type"=>$request->type,
            "nom"=>$request->nom,
            "description"=>$request->description,
            "lien"=>$fileName,
            "date"=>$date,
            "id_consultation"=>$request->cons_id,
        ]);
        return redirect()->action('ConsultationsController@show',['id'=>$request->cons_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
