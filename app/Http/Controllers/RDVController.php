<?php
namespace App\Http\Controllers;
use App\modeles\rdv;
use App\modeles\patient;
use App\modeles\employ;
use App\modeles\rol;
use App\modeles\specialite;
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
use Storage;
use DNS2D;
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
            "Etat_RDV"=>"Valider"
        ]);
        return redirect()->route("rdv.show",$rdv->id);
      }
      public function reporter($id)
      {
        $rdv = rdv::FindOrFail($id);
        $patient = patient::FindOrFail($rdv->Patient_ID_Patient);
        return view('rdv.reporter_rdv',compact('rdv','patient'));
       }
      public function storereporte(Request $request,$id)
      {
        $rdv = rdv::FindOrFail($id);
        $rdv->update([
            "Date_RDV"=>$request->daterdv,
        ]);
        return redirect()->route("rdv.show",$rdv->id);
      }
     public function choixpatient()
     {
           return view('patient.index');
     }
     public function index($patientID = null)
     {  
           if(Auth::user()->role_id == 1)
           {
               $specialite = Auth::user()->employ->specialite;
                $rdvs = rdv::with('patient','employe')
                    ->whereHas('employe.Specialite',function($q) use ($specialite){
                                  $q->where('id',$specialite);
                })->where('Etat_RDV',null)->orwhere('Etat_RDV',1)->get();
                return view('rdv.index', compact('rdvs')); 
          } else{
                $rdvs = rdv::where('Etat_RDV',null)->orwhere('Etat_RDV',1)->get();
                return view('rdv.index', compact('rdvs')); 
          }     
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Request $request
    public function create($patient_id = null)
    {
      if(Auth::user()->role_id == 1)   
      {   
        $specialite = Auth::user()->employ->specialite;
        $rdvs = rdv::with('patient','employe')
                          ->whereHas('employe.Specialite',function($q) use ($specialite){
                                    $q->where('id',$specialite);
                          })->where('Etat_RDV',null)->orwhere('Etat_RDV',1)->get();                                          
              if(isset($patient_id) && !empty($patient_id))
                  $patient = patient::FindOrFail($patient_id);
              else
                 $patient = new patient;
             return view('rdv.create',compact('patient','rdvs'));  // }else //   return view('rdv.create', compact('rdvs'));  
      }else{ 
          $rdvs = rdv::with(['patient','employe'])->where('Etat_RDV',null)->orwhere('Etat_RDV',1)->get();
          $specialites = specialite::all();
          if(isset($patient_id) && !empty($patient_id))
            $patient = patient::FindOrFail($patient_id);
          else
            $patient = new patient;  // dd($patient->id); 
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
        $request->validate([
            "daterdv"=> 'required',
        ]);
        $employe = employ::where("id",Auth::user()->employee_id)->get()->first();
        $rdv = rdv::firstOrCreate([
          "Date_RDV"=>$request->daterdv,
          "Employe_ID_Employe"=>Auth::user()->employee_id,
          "Patient_ID_Patient"=>$request->id_patient//"Etat_RDV"=> "en attente", 
        ]);
        return redirect()->route("rdv.show",$rdv->id);
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
          {
               $medecins = ($Rdv->employe->Specialite)->employes;
                if(isset($Rdv->Employe_ID_Employe))
                    return(Response::json(['rdv'=>$Rdv,'medecins'=>$medecins]));
                else
                      return Response::json(['rdv'=>$Rdv,'patient'=>$Rdv->patient]);  
          }else{
                $specialite = Auth::user()->employ->specialite;
                $rdvs = rdv::with('patient','employe')->whereHas('employe.Specialite',function($q) use ($specialite){
                                                                         $q->where('id',$specialite);
                                                                    })->where('Etat_RDV',null)->orwhere('Etat_RDV',1)->get(); 
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
        $fixe=1;
        $rdv = rdv::FindOrFail($id);
        $medecinId = (Auth::user()->role_id == 1)?$rdv->Employe_ID_Employe:$request->medecin; //if(Auth::user()->role_id == 1)
        $fixe =  (isset($request->fixe)) ?1:0;
        $dateRdv = new DateTime($request->daterdv);
        $dateFinRdv = new DateTime($request->datefinrdv);
        $rdv->update([
            "Date_RDV"=>$dateRdv,
            "Fin_RDV"=>$dateFinRdv,
            "Employe_ID_Employe"=>(Auth::user()->role_id == 1)?$rdv->Employe_ID_Employe:$request->medecin,
            "fixe"=>$fixe,
        ]);
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
        if($request->ajax())
        {
          $rdv->update(['Etat_RDV'=>0]); //rdv::destroy($id);
          return ($rdv);
        }
        else
        {
          $rdv->update(['Etat_RDV'=>0]);//rdv::destroy($id);
          return redirect()->route('rdv.index'); 
        } 
      }
      public function print(Request $request,$id)
      { 
        $rdv = rdv::findOrFail($id);
        $etablissement = Etablissement::first();
        $civilite;
        switch ($rdv->patient->getCivilite()) {
          case 'M.':
            $civilite = 1; 
            break;
          case 'Mlle.':
            $civilite =2; 
            break; 
          case 'Mme.':
            $civilite =2;
            break; 
          case 'Enf.':
            $civilite =3; 
            break;   
        }//return($rdv->patient->getCivilite()); 
        $pdf417 = new PDF417();
        $data = $pdf417->encode($civilite.$rdv->id.'|'.$rdv->employe->specialite.'|'.Carbon::parse($rdv->Date_RDV)->format('dmy'));
        $renderer = new ImageRenderer([
                'format' => 'png', //'color' => '#FF0000', //'bgColor' => '#00FF00',
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
        $employeId  ="";
        if(Auth::user()->role_id ==2)
          $employeId = (isset($request->medecin)?$request->medecin: null);
        else
          $employeId = Auth::user()->employ->id;
        if($request->ajax())
          $patient = patient::find($request->id_patient);
        else
          $patient=patient::where('IPP', explode("-", $request->patient)[0])->first();
        $rdv = rdv::firstOrCreate([
          "Date_RDV"=>new DateTime($request->Debut_RDV),
          "Fin_RDV" =>new DateTime($request->Fin_RDV),
          "fixe"    => $request->fixe,
          "Employe_ID_Employe"=>$employeId,//$employe->id,
          "Patient_ID_Patient"=> $patient->id
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
          $patient = patient::FindOrFail($rdv->Patient_ID_Patient);
          $rdv = array();
          $e['id'] = $patient->id;
          $e['title'] =$patient->Nom + $patient->Prenom  ;
          $e['start'] = new DateTime($patient->Date_RDV);
          $e['end'] = new DateTime($patient->Date_RDV.' +1 day');
          array_push($events, $e);
        }
        return response()->json($events); // return response()->json(['events' , $events]);
      }
      // public function orderPdf($id)// { //   $rdv = rdv::findOrFail($id);   //   $pdf = PDF::loadView('rdv.rdv_pdf', compact('rdv'))->setPaper('a5', 'landscape');
      //   $name = "RDV-pour:".patient::where("id",$rdv->Patient_ID_Patient)->get()->first()->Nom."".patient::where("id",$rdv->Patient_ID_Patient)->get()->first()->Prenom.".pdf";
      //   return $pdf->download($name); // }
}
