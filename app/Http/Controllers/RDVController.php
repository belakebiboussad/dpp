<?php
namespace App\Http\Controllers;
use App\modeles\rdv;
use App\modeles\patient;
use App\modeles\employ;
use App\modeles\rol;
use App\modeles\Specialite;
use App\modeles\Etablissement;
use App\modeles\Parametre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use Calendar;
use Carbon\Carbon;
use DateTime;
use Response;
use View;
use Dompdf\Dompdf;
use Storage;//use DNS2D;
use BigFish\PDF417\PDF417;
use BigFish\PDF417\Renderers\ImageRenderer;
use BigFish\PDF417\Renderers\SvgRenderer;
use File;
class RDVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
      {
          $this->middleware('auth');
      }
      public function valider($id)
      {
        $rdv = rdv::FindOrFail($id);
        $rdv ->update([  "etat"=>"Valider" ]);
          return redirect()->route("rdv.show",$rdv->id);
      }
      public function index(Request $request,$patientID = null)
      {
        $appointDoc =  (Parametre::select()->where('nom','docinAppoint')->get('value')->first())->value;
        $specialites = Specialite::where('type','!=',null)->get();
        if(in_array(Auth::user()->role_id,[1,13,14])) 
        {
          $specialite_id = (isset(Auth::user()->employ->specialite)) ? Auth::user()->employ->specialite : Auth::user()->employ->Service->specialite_id;
          $rdvs = rdv::with('patient','specialite')->where("specialite_id", $specialite_id)
                                   ->where('etat',null)->orwhere('etat',1)->get(); 
        }else
          $rdvs = rdv::with('patient','specialite')->where("specialite_id",'!=',null)->where('etat',null)->orwhere('etat',1)->get();
        return view('rdv.index', compact('rdvs','specialites','appointDoc'));   
      }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Request $request
    public function create(Request $request)//,$patient_id = null
    {
      $borneIp =  (Parametre::select()->where('nom','Borne_Adrr')->get('value')->first())->value;
      $appointDoc =  (Parametre::select()->where('nom','docinAppoint')->get('value')->first())->value;
      $specialites = Specialite::where('type','!=',null)->get();
      if(isset($request->patient_id))
        $patient = patient::FindOrFail( $request->patient_id);
      else
        $patient = new patient;
      if((in_array(Auth::user()->role_id,[1,13,14]))) 
      {  
        $specialite_id = (isset(Auth::user()->employ->specialite)) ? Auth::user()->employ->specialite : Auth::user()->employ->Service->specialite_id;
        $rdvs =  rdv::with('patient','employe','specialite')->where('specialite_id',$specialite_id)
                    ->where('etat',null)->orwhere('etat',1)->get();
      }else
        $rdvs = rdv::with(['patient','specialite'])->where('etat',null)->orwhere('etat',1)->get();
      return view('rdv.create', compact('rdvs','patient','specialites','borneIp','appointDoc'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request)
      {/* $request->validate(["daterdv"=> 'required',]);$employe = employ::where("id",Auth::user()->employee_id)->get()->first(); */
        if($request->ajax())
        { 
          $patient = patient::find($request->pid);
          if(isset($request->specialite))
            $specialite_id = $request->specialite;
          else
          {
            if(isset(Auth::user()->employ->specialite))
              $specialite_id = Auth::user()->employ->specialite;
            else
              $specialite_id = Auth::user()->employ->Service->specialite_id; 
          }
          if(Auth::user()->role_id ==15)
            $employ_id = (isset($request->employ_id)) ? $request->employ_id : null ;
          else
            $employ_id = Auth::user()->employee_id;
          $rdv = rdv::firstOrCreate([
            "date"=>new DateTime($request->date),
            "fin" =>new DateTime($request->fin),
            "fixe"    => $request->fixe,
            "patient_id"=> $patient->id,
            "employ_id"=> $employ_id,
            "specialite_id"=> $specialite_id
          ]);
          return array('patient'=>$patient,'rdv'=>$rdv);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\modeles\rdv  $rdv
     * @return \Illuminate\Http\Response
     */
      public function show(Request $request, rdv $rdv)
      {
        if($request->ajax())
          return $rdv->load('specialite','patient','employe');
        else
          return view('rdv.show',compact('rdv'));
      }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\rdv  $rdv
     * @return \Illuminate\Http\Response
     */
      public function edit(Request $request, rdv $rdv)
      { 
        if($request->ajax())
        { 
          $medecins = ($rdv->specialite)->employes;
          if(isset($rdv->specialite_id))
             return Response::json(['rdv'=>$rdv,'medecins'=>$medecins]);
          else 
            return Response::json(['rdv'=>$rdv,'patient'=>$rdv->patient]);  
        }else{
          $appointDoc =  (Parametre::select()->where('nom','docinAppoint')->get('value')->first())->value;
          $specialite =$rdv->specialite_id;
          if(in_array(Auth::user()->role_id,[1,13,14])) 
            $rdvs = rdv::with('patient','employe')
                        ->whereHas('specialite',function($q) use ($specialite){
                          $q->where('id',$specialite);
                        })->whereNull('etat')->orwhere('etat',1)->get(); 
          else
            $rdvs = rdv::with('patient','specialite')->where("specialite_id",'!=',null)->whereNull('etat')->orwhere('etat',1)->get(); 
          return view('rdv.edit',compact('rdv','rdvs','appointDoc'));
        } 
      }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modeles\rdv  $rdv
     * @return \Illuminate\Http\Response
     */
      public function update(Request $request, rdv $rdv)
      { 
        $specId = (in_array(Auth::user()->role_id,[1,13,14]) )? Auth::user()->employ->specialite : $request->specialite;
        $date = new DateTime($request->date);
        $fin = new DateTime($request->fin);
        if(Auth::user()->role_id ==2)
          $employ_id = (isset($request->employ_id)) ? $request->employ_id : null ;
        else
            $employ_id = Auth::user()->employee_id;
        $rdv->update([
          "date"=>$date,
          "fin"=>$fin,
          "specialite_id" => $specId,
          "employ_id"=>$employ_id,
          "fixe"=>$request->fixe,
        ]); 
        if($request->ajax())
          return $rdv;
        else
          return redirect()->route("rdv.index");
      }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\modeles\rdv  $rdv
     * @return \Illuminate\Http\Response
     */
      public function destroy(Request $request, rdv $rdv)
      {  
        $rdv->update(['etat'=>0]);
        if($request->ajax())
          return Response::json($rdv);//return ($rdv);
        else
          return redirect()->route('rdv.index');  
      }
      public function print(Request $request,$id)
      { 
        $rdv = rdv::findOrFail($id);
        $etab = Etablissement::first();
        $civilite = $civilite = $rdv->patient->civ;
        $filename = "RDV-".$rdv->patient->Nom."-".$rdv->patient->Prenom.".pdf";//"-".microtime(TRUE).
        $pdf417 = new PDF417();
        $data = $pdf417->encode($civilite.$rdv->id.'|'.$rdv->specialite_id.'|'.Carbon::parse($rdv->date)->format('dmy'));
        $renderer = new ImageRenderer([
            'format' => 'png',
            'scale' => 1,//1
            'ratio'=>3,//hauteur,largeur
            'padding'=>0,//espace par rapport left
            'format' =>'data-url'
        ]);
        $img = $renderer->render($data);
        $viewhtml = View('rdv.rdvTicketPDF-bigFish', array('rdv' =>$rdv,'img'=>$img,'etab'=>$etab))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($viewhtml);
        $dompdf->setPaper('a6', 'landscape');
        $dompdf->render();
        return $dompdf->stream($filename); 
      }
      public function listeRdvs(Request $request)
      {
        $rdvs = rdv::with('patient')->get();
        return Response($rdvs);
      }
}
