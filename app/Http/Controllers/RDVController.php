<?php
namespace App\Http\Controllers;
use App\modeles\rdv;
use App\modeles\patient;
use App\modeles\employ;
use App\modeles\rol;
use App\modeles\Specialite;
use App\modeles\Etablissement;
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
        $rdv ->update([
            "etat"=>"Valider"
        ]);
        return redirect()->route("rdv.show",$rdv->id);
      }
      public function reporter($id)
      {
        $rdv = rdv::FindOrFail($id);
        $patient = patient::FindOrFail($rdv->patient_id);
        return view('rdv.reporter_rdv',compact('rdv','patient'));
      }
      public function storereporte(Request $request,$id)
      {
        $rdv = rdv::FindOrFail($id);
        $rdv->update([
            "date"=>$request->daterdv,
        ]);
        return redirect()->route("rdv.show",$rdv->id);
      }
      public function choixpatient()
      {
           return view('patient.index');
      }
      public function index($patientID = null)
      { 
        if(in_array(Auth::user()->role_id,[1,13,14])) 
        {
          $specialite = Auth::user()->employ->specialite;
          $rdvs = rdv::with('patient','specialite')->where("specialite_id", $specialite)
                ->where('etat',null)->orwhere('etat',1)->get();  
        }else
          $rdvs = rdv::with('patient','specialite')->where("specialite_id",'!=',null)->where('etat',null)->orwhere('etat',1)->get();
        return view('rdv.index', compact('rdvs')); 
      }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Request $request
    public function create(Request $request)//,$patient_id = null
    {
       if((in_array(Auth::user()->role->id,[1,13,14]))) 
        {  
          $specialite = Auth::user()->employ->specialite;
          $specialites = specialite::all();
          $rdvs =  rdv::with('patient','employe','specialite')->where('specialite_id',$specialite)
                      ->where('etat',null)->orwhere('etat',1)->get();
          if(isset($request->patient_id))//(isset($patient_id) && !empty($patient_id)) ||(
                $patient = patient::FindOrFail( $request->patient_id);//$pid = (isset($patient_id))? $patient_id : $request->patient_id;
          else
                 $patient = new patient;
          return view('rdv.create',compact('patient','rdvs','specialites'));  // }else //   return view('rdv.create', compact('rdvs'));  
      }else{ 
              $rdvs = rdv::with(['patient','specialite'])->where('etat',null)->orwhere('etat',1)->get();
               $specialites = specialite::all();
                if(isset($request->patient_id))//isset($patient_id) && !empty($patient_id)) ||( //$pid = (isset($patient_id))? $patient_id : $request->patient_id;
                       $patient = patient::FindOrFail($request->patient_id);
             else
                      $patient = new patient;
                return view('rdv.create', compact('rdvs','specialites','patient'));  // }elsereturn view('rdv.create', compact('rdvs','specialites'));   
      }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request)
      {
        /*  $request->validate([   "daterdv"=> 'required', ]);  $employe = employ::where("id",Auth::user()->employee_id)->get()->first();
       $rdv = rdv::firstOrCreate([ "date"=>$request->daterdv,    "employ_id"=>Auth::user()->employee_id,"patient_id"=>$request->id_patient//"etat"=> "en attente", 
        ]); return redirect()->route("rdv.show",$rdv->id); */
        if($request->ajax())
        {
                $specialite ="";
                if(Auth::user()->role_id ==2)
                  $specialite = $request->specialite ;
                else
                  $specialite = Auth::user()->employ->specialite;
                $patient = patient::find($request->id_patient);
                $rdv = rdv::firstOrCreate([
                  "date"=>new DateTime($request->date),
                  "fin" =>new DateTime($request->fin),
                  "fixe"    => $request->fixe,
                  "patient_id"=> $patient->id,
                  "employ_id"=>Auth::user()->employee_id,
                  "specialite_id"=> $specialite
                ]);   
                return Response::json(array('patient'=>$patient, 'age'=>$patient->getAge(),'rdv'=>$rdv));
        }else
        {

        }

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\modeles\rdv  $rdv
     * @return \Illuminate\Http\Response
     */
      public function show($id)
      {
        $rdv = rdv::FindOrFail($id); // dd($rdv);
        return view('rdv.show',compact('rdv'));
      }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\rdv  $rdv
     * @return \Illuminate\Http\Response
     */
      public function edit(Request $request,$id)
      {       
        $Rdv = rdv::with('patient','employe')->FindOrFail($id);
        if($request->ajax())
        { //$medecins = ($Rdv->specialite)->employes;// $medecins = ($Rdv->employe->Specialite)->employes;
          $specialites =Specialite::where('type','<>',null)->get();//if(isset($Rdv->employ_id)) // return Response::json(['rdv'=>$Rdv,'medecins'=>$medecins]);
          if(isset($Rdv->specialite_id))
                  return Response::json(['rdv'=>$Rdv,'specialites'=>$specialites]);
          else //return Response::json(['rdv'=>$Rdv,'patient'=>$Rdv->patient]);  
                  return Response::json(['rdv'=>$Rdv,'patient'=>$Rdv->patient]);  
        }else{
          $specialite = Auth::user()->employ->specialite;
          $rdvs = rdv::with('patient','employe')->whereHas('specialite',function($q) use ($specialite){//employe.Specialite
                                                                $q->where('id',$specialite);
                                  })->where('etat',null)->orwhere('etat',1)->get(); 
          return view('rdv.edit',compact('Rdv','rdvs'));
        } 
      }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modeles\rdv  $rdv
     * @return \Illuminate\Http\Response
     */
      public function update(Request $request, $id)
      { 
        $rdv = rdv::FindOrFail($id);//$medecinId = (Auth::user()->role_id == 1 )? $rdv->employ_id: $request->medecin;
        $specId = (Auth::user()->role_id == 1 )? Auth::user()->employ->specialite : $request->specialite;
        // if(in_array(Auth::user()->role_id,[1,13,14])) //   $fixe =  (isset($request->fixe)) ? 1: 0;
        $date = new DateTime($request->date);
        $fin = new DateTime($request->fin);
        $rdv->update([
          "date"=>$date,
          "fin"=>$fin,//"employ_id"=>(Auth::user()->role_id == 1)?$rdv->employ_id:$request->medecin,
          "specialite_id" => $specId,
          "fixe"=>$request->fixe,
        ]);
        return Response::json($rdv); 
        if($request->ajax())
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
      public function destroy(Request $request, $id)
      {
        $rdv = rdv::findOrFail($id); 
        $rdv->update(['etat'=>0]); //rdv::destroy($id);
        if($request->ajax())
          return Response::json($rdv);//return ($rdv);
        else
          return redirect()->route('rdv.index');  
      }
      public function print(Request $request,$id)
      { 
        $rdv = rdv::findOrFail($id);
        $etablissement = Etablissement::first();
        $civilite = $rdv->patient->getCiviliteCode() ;
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
        $viewhtml = View::make('rdv.rdvTicketPDF-bigFish', array('rdv' =>$rdv,'img'=>$img,'etablissement'=>$etablissement))->render();// $viewhtml = View::make('rdv.rdvTicketPDF-DNS2D', array('rdv' =>$rdv,'img'=>$img,'etablissement'=>$etablissement))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($viewhtml);
        $dompdf->setPaper('a6', 'landscape');
        $dompdf->render();
        $name = "RDV-".$rdv->patient->Nom."-".$rdv->patient->Prenom.".pdf";//"-".microtime(TRUE).
        return $dompdf->stream($name); 
      }
      function AddRDV(Request $request)
      {
        $specialite ="";
        if(Auth::user()->role_id ==2)
          $specialite = $request->specialite ;
        else
          $specialite = Auth::user()->employ->specialite;
        if($request->ajax())
          $patient = patient::find($request->id_patient);
        else
          $patient=patient::where('IPP', explode("-", $request->patient)[0])->first();
        $rdv = rdv::firstOrCreate([
          "date"=>new DateTime($request->date),
          "fin" =>new DateTime($request->fin),
          "fixe"    => $request->fixe,
          "patient_id"=> $patient->id,
          "specialite_id"=> $specialite
        ]);       
        if($request->ajax())
          return Response::json(array('patient'=>$patient, 'age'=>$patient->getAge(),'rdv'=>$rdv));
        else     
          return redirect()->route("rdv.create");     
      }     
      public function checkFullCalendar(Request $request)
      {
              $events = array(); 
              $today = Carbon::now()->format('Y-m-d');
              $rendezVous = rdv::all();
              foreach ($rendezVous as $rdv) {
                $patient = patient::FindOrFail($rdv->patient_id);
                $rdv = array();
                $e['id'] = $patient->id;
                $e['title'] =$patient->Nom + $patient->Prenom  ;
                $e['start'] = new DateTime($rdv->date);
                $e['end'] = new DateTime($$rdv->date.' +1 day');
                array_push($events, $e);
        }
        return response()->json($events); // return response()->json(['events' , $events]);
      } // public function orderPdf($id){ $rdv = rdv::findOrFail($id);$pdf = PDF::loadView('rdv.rdv_pdf', compact('rdv'))->setPaper('a5', 'landscape');$name = "RDV-pour:".patient::where("id",$rdv->patient_id)->get()->first()->Nom."".patient::where("id",$rdv->patient_id)->get()->first()->Prenom.".pdf";return $pdf->download($name); }
      public function listeRdvs(Request $request)
      {
        $rdvs = rdv::with('patient')->get();
        return Response($rdvs);
      }
}
