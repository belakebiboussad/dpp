<?php

namespace App\Http\Controllers;

use App\modeles\rdv;
use App\modeles\patient;
use App\modeles\employ;
use App\modeles\rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use Flashy;
use Calendar;
use Carbon\Carbon;
use DateTime;
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
    public function indexfut()
    {

           $rdvs = rdv::join('patients','rdvs.Patient_ID_Patient','=', 'patients.id')->select('rdvs.*','patients.Nom','patients.Prenom','patients.id as idPatient','patients.tele_mobile1','patients.Dat_Naissance')->get();
         
           

    }
    public function index()
    {
          $employe = employ::where("id",Auth::user()->employee_id)->get()->first();
          $rendezvous = [];
           if(rol::where("id",Auth::User()->role_id)->get()->first()->role =="Receptioniste")
                $data = rdv::join('patients','rdvs.Patient_ID_Patient','=', 'patients.id')->select('rdvs.*','patients.Nom','patients.Prenom','patients.id as idPatient','patients.tele_mobile1','patients.Dat_Naissance')->get();
           else
                $data = rdv::join('patients','rdvs.Patient_ID_Patient','=', 'patients.id')->select('rdvs.*','patients.Nom','patients.Prenom','patients.id as idPatient','patients.tele_mobile1','patients.Dat_Naissance')->where("specialite", $employe->Specialite_Emploiye)->get();
           if($data->count())
           {
                      $color=0;  
                     foreach ($data as $key => $value) {  
                               $Age=  Carbon::parse($value->Dat_Naissance)->age;
                                if (Carbon::today()->gt(Carbon::parse($value->Date_RDV->format('Y-m-d H:i:s')))) {
                                           $color = '#D3D3D3';
                                           $rendezvous[] = Calendar::event(
                                                   $value->Nom." ".$value->Prenom,
                                                   true,
                                                   new \DateTime($value->Date_RDV),
                                                   new \DateTime($value->Date_RDV.' +1 day'),
                                                   $value->id,
                                                   // Add color and link on event
                                                   [
                                                                'color' =>$color,
                                                                'url' => '/rdv/'.$value->id,
                                                   ]
                                          );
                                } else {
                                                 $color = '#00c0ef';
                                                 $rendezvous[] = Calendar::event(
                                                   $value->Nom." ".$value->Prenom,
                                                   true,
                                                   new \DateTime($value->Date_RDV),
                                                   new \DateTime($value->Date_RDV.' +1 day'),
                                                   $value->id,
                                                   // Add color and link on event
                                                   [
                                                             'color' =>$color,
                                                             'idPatient' =>$value->idPatient,
                                                              'age'=> $Age,
                                                             'tel'=>$value->tele_mobile1,                             
                                                   ]
                                          );
                                }                                            
                     }
           }
           $events = array();      //  $planning = Calendar::addEvents($rendezvous);   
           $eloquentRDV= rdv::first(); //EventModel implements MaddHatter\LaravelFullcalendar\Event
           $planning = \Calendar::addEvents($rendezvous) //add an array with addEvents
             ->addEvent($eloquentRDV, [ //set custom color fo this event
                     'color' => '#800',
                 ])->setOptions([ //set fullcalendar options
                'firstDay' => 7,
                'timeZone'=> 'CET',
                'themeSystem' => 'bootstrap4',
                'timeFormat'        => 'H:mm',
                 'axisFormat'        => 'H:mm',
                 'selectable' => true,
                 'minTime' => '08:00:00',
                 'maxTime' => '20:00:00',
                'slotDuration' => '00:30:01',
                 'defaultView'=> 'agendaWeek',
             //   'eventLimit'     => 4,
           ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
                 'viewRender' => 'function() {}',
                 'eventClick' => 'function(event) {
                           showModal1(event.id,event.title,event.start,event.idPatient,event.tel,event.age);
                 }',
                 'dayClick'=>'function(calEvent, jsEvent, view){
                          showModal(calEvent);
                 }',
                'select'=>'function(startDate, endDate, jsEvent, view, resource) {
                     go(startDate, endDate, jsEvent, view, resource);
                }',
         ]);
        // dd($planning);
        return view('rdv.index_rdv', compact('planning'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$id_patient)
    {
           $employe = employ::where("id",Auth::user()->employee_id)->get()->first(); 
           $patient = patient::FindOrFail($id_patient);
           // $data = rdv::join('patients','rdvs.Patient_ID_Patient','=', 'patients.id')->select('rdvs.*','patients.Nom','patients.Prenom','patients.id as idPatient','patients.tele_mobile1','patients.Dat_Naissance')->where("specialite", $employe->Specialite_Emploiye)->get();
           $data = rdv::all();
      
           return view('rdv.create_rdv',compact('patient','data'));
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
           $specialite = $employe->Specialite_Emploiye; 
           // $rdv = rdv::create($request->all());
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
        $rdv = rdv::FindOrFail($id);
        // dd($rdv);
        return view('rdv.show_rdv',compact('rdv'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\rdv  $rdv
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $rdv = rdv::FindOrFail($id);
       $patient = patient::FindOrFail($rdv->Patient_ID_Patient);
       return view('rdv.edit_rdv',compact('rdv','patient'));
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
           $rdv = rdv::FindOrFail($id);
           $rdv->update([
                "Date_RDV"=>$request->daterdv,
                "Temp_rdv"=>$request->heurrdv
       ]);
       return redirect()->route("rdv.show",$rdv->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\modeles\rdv  $rdv
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        rdv::destroy($id);    //return redirect()->route('rdv.index');
        return redirect()->action('RDVController@index');
    }
    public function orderPdf($id)
     {
        $order = rdv::findOrFail($id);
        $pdf = PDF::loadView('ordre_pdf', compact('order'))->setPaper('a5', 'landscape');;
        $name = "RDV-pour:".patient::where("id",$order->Patient_ID_Patient)->get()->first()->Nom."".patient::where("id",$order->Patient_ID_Patient)->get()->first()->Prenom.".pdf";
        return $pdf->download($name);
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
           $arr = explode(" ", $request->listePatient);
           $patient=patient::where('code_barre',$arr[0])->first();
           $request->validate([
                     "date_RDV"=> 'required',
           ]);
           $x = preg_replace('/\s*:\s*/', ':', $request->Temp_rdv);


            $date = new DateTime($request->date_RDV);
           $time = new DateTime($request->Temp_rdv);
           $dateTime = new DateTime($date->format('Y-m-d') .' ' .$time->format('H:i:s'));  
           $employe = employ::where("id",Auth::user()->employee_id)->get()->first();
           $specialite = $employe->Specialite_Emploiye; 
           $rdv = rdv::firstOrCreate([
                 "Date_RDV"=>$dateTime,
                 "Temp_rdv"=>$time,
                 "specialite"=>$specialite,
                 "Employe_ID_Employe"=>Auth::user()->employee_id,
                 "Patient_ID_Patient"=>$patient->id,
                 "Etat_RDV"=> "en attente",
              ]);
             Flashy::success('RDV ajouter avec succès');
              return redirect()->route("rdv.index");
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
           // return response()->json(['events' , $events]);
           return response()->json($events);
     }

}
