<?php

namespace App\Http\Controllers;

use App\modeles\rdv;
use App\modeles\patient;
use App\modeles\employ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use PDF;
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
        $patients = patient::all();
        return view('rdv.choix_patient_rdv', compact('patients'));
    }

    public function index()
    {
        $employe = employ::where("id",Auth::user()->employee_id)->get()->first();
        $rdvs = rdv::where("specialite", $employe->Specialite_Emploiye)->get();
        return view('rdv.index_rdv', compact('rdvs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_patient)
    {
        $patient = patient::FindOrFail($id_patient);
        return view('rdv.create_rdv',compact('patient'));
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
        $rdv = rdv::firstOrCreate([
           "Date_RDV"=>$request->daterdv,
           "specialite"=>$specialite,
           "Employe_ID_Employe"=>Auth::user()->employee_id,
           "Patient_ID_Patient"=>$request->id_patient,
           "Etat_RDV"=> "en attente",
        ]);
         flash('RDV ajouter avec succès')->success();
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
        rdv::destroy($id);
        return redirect()->route('rdv.index');
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
}
