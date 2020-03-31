<?php
namespace App\Http\Controllers;
use App\modeles\rdv;
use App\modeles\patient;
use App\modeles\employ;
use App\modeles\rol;
use App\modeles\specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use Flashy;
use Calendar;
use Carbon\Carbon;
use DateTime;
use Response;
use View;
use Dompdf\Dompdf;
// use Illuminate\Support\Facades\Gate;
class RDVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
           return view('patient.index_patient');
      }
      public function index($patientID = null)
      {      
            if(Auth::user()->role_id == 1)
            {
                    $rdvs = rdv::where('Employe_ID_Employe', Auth::user()->employee_id)->get(); //$rdvs = rdv::all();
                    return view('rdv.index', compact('rdvs')); 
            } else
            {
                    $rdvs = rdv::all();
                    return view('rdv.index', compact('rdvs')); 
            }     
        // $rdvs = rdv::join('patients','rdvs.Patient_ID_Patient','=', 'patients.id')
        //            ->select('rdvs.*','patients.Nom','patients.Prenom','patients.id as idPatient','patients.tele_mobile1','patients.Dat_Naissance')->get();
        // if(isset($patientID)) 
        // {
        //   $patient = patient::FindOrFail($patientID);   
        //   return view('rdv.index', compact('rdvs','patient'));                  
        // }
        // else
        // {
        //   return view('rdv.index', compact('rdvs')); 
        // }
      }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Request $request
      public function create($id_patient =null)
      {
            //$employe = employ::where("id",Auth::user()->employee_id)->get()->first(); 
             if(Auth::user()->role->id == 1)
            {
                   $rdvs = rdv::where('Employe_ID_Employe', Auth::user()->employee_id)->get(); //$rdvs = rdv::all();
                    if(isset($id_patient) && !empty($id_patient))
                    {
                            $patient = patient::FindOrFail($id_patient);
                            return view('rdv.create',compact('patient','rdvs'));
                    }else
                   {
                        return view('rdv.create', compact('rdvs')); 
                   }
             }else
             {
                    $rdvs = rdv::all();
                    $specialites = specialite::all();
                    return view('rdv.create', compact('rdvs','specialites')); 
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
           $specialite = $employe->Specialite_Emploiye;       // $rdv = rdv::create($request->all());
                $rdv = rdv::firstOrCreate([
               "Date_RDV"=>$request->daterdv,
               "specialite"=>$specialite,
               "Employe_ID_Employe"=>Auth::user()->employee_id,
               "Patient_ID_Patient"=>$request->id_patient,
               "Etat_RDV"=> "en attente",
           ]);
           Flashy::success('RDV ajouter avec succès');
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
            return view('rdv.show_rdv',compact('rdv'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\rdv  $rdv
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {       
             $rdv = rdv::FindOrFail($id);
             if($request->ajax())
                   return Response::json(['rdv'=>$rdv,'medecin'=>$rdv->employe,'patient'=>$rdv->patient]);  
             else
              {
                    $patient = patient::FindOrFail($rdv->Patient_ID_Patient)->patient;
                    return view('rdv.edit_rdv',compact('rdv','patient'));
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
             $rdv = rdv::FindOrFail($id); //$rdv = rdv::FindOrFail($request->id_rdv); 
             $medecinId = (Auth::user()->role_id == 1)?$rdv->Employe_ID_Employe:$request->medecin;
              $dateRdv = new DateTime($request->daterdv);
             $dateFinRdv = new DateTime($request->datefinrdv);
             $rdv->update([
                        "Date_RDV"=>$dateRdv,
                        "Fin_RDV"=>$dateFinRdv,
                        "Employe_ID_Employe"=>$medecinId,
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
             if($request->ajax())
             {
                   $rdv = rdv::findOrFail($id); // return Auth::user()->employ->rdvs; // return Response::json($rdvs);
                    rdv::destroy($id); // $rdvs = $rdv->employe->rdvs;//return Response::json($rdvs);
                    return ($rdv);
            }
            else
            {
                    rdv::destroy($id);
                    return redirect()->route('rdv.index');
                    //return redirect()->action('RDVController@index');
            } 
      }
    public function orderPdf($id)
    {
        $order = rdv::findOrFail($id);
        $pdf = PDF::loadView('ordre_pdf', compact('order'))->setPaper('a5', 'landscape');
        $name = "RDV-pour:".patient::where("id",$order->Patient_ID_Patient)->get()->first()->Nom."".patient::where("id",$order->Patient_ID_Patient)->get()->first()->Prenom.".pdf";
        return $pdf->download($name);
    }
      public function print(Request $request,$id)
      {
            $rdv = rdv::findOrFail($id);
            // $filename = 'logo-40_x_40.png'; $path =  public_path(); $path = $path.'\\img\\' . $filename;  $type = pathinfo($path, PATHINFO_EXTENSION);
            // $data = file_get_contents($path);    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            /* $view = view("consultations.rdv_pdf",compact('rdv'))->render();    return response()->json(['html'=>$view]);*/
            /* $pdf = PDF::loadView('consultations.rdv-pdf', compact('rdv'))->setPaper('a5', 'landscape');$name = "RDV-".$rdv->patient->Nom."-".$rdv->patient->Prenom.".pdf";
            return $pdf->download($name);*/
            /*PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);$pdf = PDF::loadView('consultations.rdv-pdf', compact('rdv','base64'))->setPaper('a5', 'landscape');            
            $name = "RDV-".$rdv->patient->Nom."-".$rdv->patient->Prenom.".pdf";return $pdf->stream('pdfview.pdf');*/
            $viewhtml = View::make('consultations.rdvPDF', array('rdv' =>$rdv))->render();
            $dompdf = new Dompdf();
            $dompdf->loadHtml($viewhtml);
            $dompdf->setPaper('a5', 'landscape');
            $dompdf->render();
            $name = "RDV-".$rdv->patient->Nom."-".$rdv->patient->Prenom.".pdf";
            return $dompdf->stream($name);

      }
    public function getRDV()
    {
        $rdvs = rdv::select(['id','Date_RDV','Temp_rdv','Patient_ID_Patient','Employe_ID_Employe','Etat_RDV']);
        return Datatables::of($rdvs)
            ->addColumn('action5',function($rdv){
                return'<span class="label label-xlg label-purple arrowed"><strong>'.$rdv->Date_RDV.'</strong></span>';
            })
            ->addColumn('action4',function($rdv){
                return'<span class="label label-xlg label-purple arrowed"><strong>'.$rdv->Temp_rdv.'</strong></span>';
            })
            ->addColumn('action3',function($rdv){
                if($rdv->Etat_RDV == "en attente")
                    {
                        return'<span class="label label-xlg label-yellow arrowed-in arrowed-in-right"><strong>'.$rdv->Etat_RDV.'</strong></span>';
                    }
                elseif($rdv->Etat_RDV == "Valider")
                    {
                        return'<span class="label label-xlg label-purple arrowed"><strong>'.$rdv->Etat_RDV.'</strong></span>';
                    }
            })
            ->addColumn('action1',function($rdv){
                $patient = patient::where("id",$rdv->Patient_ID_Patient)->get()->first();
                return'<a href="/patient/'.$patient->id.'" class="label label-xlg label-primary arrowed arrowed-right">'.$patient->Nom.' '.$patient->Prenom.'</a>';
            })
            ->addColumn('action2',function($rdv){
                 $medcine = employ::where("id",$rdv->Employe_ID_Employe)->get()->first();
                 return'<a href="/employe/'.$medcine->id.'" class="label label-xlg label-pink arrowed-right">'.$medcine->Nom_Employe .' '.$medcine->Prenom_Employe .'</a>';
            })
            ->addColumn('action', function ($rdv) {
                return '<div class="hidden-sm hidden-xs btn-group">
                            <a href="/rdv/'.$rdv->id.'" class="btn btn-xs btn-warning">
                                <i class="ace-icon fa fa-hand-o-up bigger-120"></i>
                                Affiché
                            </a>
                            <a href="/rdv/valider/'.$rdv->id.'" class="btn btn-xs btn-success">
                                <i class="ace-icon fa fa-check bigger-120"></i>
                                Valider
                            </a>
                            <a href="/rdv/reporter/'.$rdv->id.'" class="btn btn-xs btn-info">
                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                                Reporter
                            </a>
                        </div>';
                    })
            ->rawColumns(['action5','action4','action3','action1','action2','action'])
            ->make(true);
      }
       function AddRDV(Request $request)
      { 
             if(Auth::user()->role_id ==2)
                    $employe = employ::findOrFail($request->medecin);
              else
                    $employe = Auth::user()->employ;
             if($request->ajax())
                   $patient = patient::find($request->id_patient);
             else
                    $patient=patient::where('code_barre', explode("-", $request->patient)[0])->first();
             $rdv = rdv::firstOrCreate([
                    "Date_RDV"=>new DateTime($request->Debut_RDV),//"Temp_rdv"=>$time,
                    "Fin_RDV" =>new DateTime($request->Fin_RDV),
                    "fixe"    => $request->fixe,
                    "specialite"=>$employe->Specialite_Emploiye,
                    "Employe_ID_Employe"=>$employe->id,
                    "Patient_ID_Patient"=> $patient->id,
                    "Etat_RDV"=> "en attente",
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
}
