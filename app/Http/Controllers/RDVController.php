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
      }/*public function reporter($id){$rdv = rdv::FindOrFail($id); $patient = patient::FindOrFail($rdv->patient_id);
return view('rdv.reporter_rdv',compact('rdv','patient'));}  public function storereporte(Request $request,$id)
{$rdv = rdv::FindOrFail($id);$rdv->update(["date"=>$request->daterdv,]);return redirect()->route("rdv.show",$rdv->id);}*/
      public function index(Request $request,$patientID = null)
      {/*if ($request->ajax()){$rdvs =  rdv::with('patient')->where("employ_id", "=", Auth::user()->employ->id)->get(); return response()->json($rdvs);}else{}*/        
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
      if((in_array(Auth::user()->role->id,[1,13,14]))) 
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
      { //$rdv = rdv::with('patient','employe')->FindOrFail($id);
        if($request->ajax())
        { 
          $medecins = ($rdv->specialite)->employes;
          //$medecins = ($rdv->employe->Specialite)->employes;//$specialites =Specialite::where('type','<>',null)->get();
          if(isset($rdv->specialite_id))
             return Response::json(['rdv'=>$rdv,'medecins'=>$medecins]);//,'specialites'=>$specialites
          else 
            return Response::json(['rdv'=>$rdv,'patient'=>$rdv->patient]);  
        }else{
              $specialite =$rdv->specialite_id;
              if(in_array(Auth::user()->role_id,[1,13,14])) 
                  $rdvs = rdv::with('patient','employe')
                              ->whereHas('specialite',function($q) use ($specialite){
                                $q->where('id',$specialite);
                              })->where('etat',null)->orwhere('etat',1)->get(); 
              else
                      $rdvs = rdv::with('patient','specialite')->where("specialite_id",'!=',null)->where('etat',null)->orwhere('etat',1)->get(); 
              return view('rdv.edit',compact('rdv','rdvs'));
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
      { //$rdv = rdv::FindOrFail($id);//$medecinId = (Auth::user()->role_id == 1 )? $rdv->employ_id: $request->medecin;
        $specId = (in_array(Auth::user()->role_id,[1,13,14]) )? Auth::user()->employ->specialite : $request->specialite;
        // if(in_array(Auth::user()->role_id,[1,13,14]))// $fixe =  (isset($request->fixe)) ? 1: 0;
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
        if($request->ajax())// return $rdv;
          return $rdv;
        else
          return redirect()->route("rdv.index");//return redirect()->route("rdv.show",$rdv->id);
      }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\modeles\rdv  $rdv
     * @return \Illuminate\Http\Response
     */
      public function destroy(Request $request, rdv $rdv)
      { //$rdv = rdv::findOrFail($id); 
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
                'format' => 'png', //'color' => '#FF0000',
                'scale' => 1,//1
                'ratio'=>3,//hauteur,largeur
                'padding'=>0,//espace par rapport left
                'format' =>'data-url'
            ]);
            $img = $renderer->render($data);
            $viewhtml = View::make('rdv.rdvTicketPDF-bigFish', array('rdv' =>$rdv,'img'=>$img,'etab'=>$etab))->render();// $viewhtml = View::make('rdv.rdvTicketPDF-DNS2D', array('rdv' =>$rdv,'img'=>$img,'etablissement'=>$etab))->render();
            $dompdf = new Dompdf();
            $dompdf->loadHtml($viewhtml);
            $dompdf->setPaper('a6', 'landscape');
            $dompdf->render();
        
            return $dompdf->stream($filename); 
      }
/* public function checkFullCalendar(Request $request){$events = array(); $today = Carbon::now()->format('Y-m-d');$rendezVous = rdv::all();
foreach ($rendezVous as $rdv) {$patient = patient::FindOrFail($rdv->patient_id);$rdv = array();$e['id'] = $patient->id;
$e['title'] =$patient->full_name;$e['start'] = new DateTime($rdv->date);$e['end'] = new DateTime($$rdv->date.' +1 day');array_push($events, $e);}return $events ;} */
// public function orderPdf($id){ $rdv = rdv::findOrFail($id);$pdf = PDF::loadView('rdv.rdv_pdf', compact('rdv'))->setPaper('a5', 'landscape');$name = "RDV-pour:".patient::where("id",$rdv->patient_id)->get()->first()->Nom."".patient::where("id",$rdv->patient_id)->get()->first()->Prenom.".pdf";return $pdf->download($name); }
      public function listeRdvs(Request $request)
      {
        $rdvs = rdv::with('patient')->get();
        return Response($rdvs);
      }
}
