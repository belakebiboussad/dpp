<?php
namespace App\Http\Controllers;

use App\modeles\patient;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\modeles\assur;
use App\modeles\rdv;
use Yajra\DataTables\Facades\DataTables;
use App\modeles\consultation;
use App\modeles\examenbiologique;
use App\modeles\DemandeHospitalisation;
use App\modeles\hospitalisation;
use Validator;
use Redirect;
use MessageBag;
use DB;
class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listerdv($id_patient)
    {
       $patient = patient::FindOrFail($id_patient);
       $rdvs = rdv::where("Patient_ID_Patient",$id_patient)->get()->all(); 
       return view('patient.liste_rdv_pat',compact('patient','rdvs'));
    }
    public function index()
    {
        $patients = patient::all();
        return view('patient.index_patient', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient.addPatient');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           //dd($request->etatf); 
          static $assurObj;
          $date = Date::Now();
          //dd($request->all());
          $rule = array(
                  "nom" => 'required',
                  "prenom" => 'required',
                  "datenaissance" => 'required|date|date_format:Y-m-d',
                  "lieunaissance" => 'required',
                  "mobile1"=> ['required', 'regex:/[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}/'],
                  "Type_p" =>'required_if:type,Ayant_droit',
                  "nss" => 'required_if:type,Assure|required_if:type,Ayant_droit|NSSValide',
                  "nomf" => 'required_if:type,Ayant_droit',
                  "prenomf"=> 'required_if:type,Ayant_droit',
                  "datenaissancef"=> 'required_if:type,Ayant_droit|date|date_format:Y-m-d',
                  "lieunaissancef"=> 'required_if:type,Ayant_droit',
                  "NMGSN"=> 'required_if:type,Ayant_droit',
                   
                  
                //  
           );
           $messages = [
                     "required"         => "Le champ :attribute est obligatoire.",
                      "NSSValide"    => 'le numéro du securite sociale est invalide ',
                      "date"             => "Le champ :attribute n'est pas une date valide.",
            ];
           $validator = Validator::make($request->all(),$rule,$messages);         
           if ($validator->fails()) {
                    $errors=$validator->errors(); 
                     return view('patient.addPatient')->withErrors($errors);
           } 
           if(patient::all()->isNotEmpty())
            {
                $nomb = patient::all()->last()->id;
            }
        else
            {
                $nomb = 0;
            }
        $codebarre =$request->sexe.$date->year."/".($nomb+1);
           if($request->type =="Ayant droit")
          {
              $assurObj = assur::firstOrCreate([
                "Nom"=>$request->nomf,
                "Prenom"=>$request->prenomf,
                "Date_Naissance"=>$request->datenaissancef,
                "lieunaissance"=>$request->lieunaissancef,
                "Sexe"=>$request->sexef,
                "Matricule"=>$request->matf,
                "service"=>$request->servicef,
                "Grade"=>$request->gradef,
                "Etat"=>$request->etatf,
                "NSS"=>$request->nss2,
                "NMGSN"=>$request->NMGSN, 
            ]);   
        }
        else
        {
            if( $request->type=="Assure")
                {
                    $assurObj = assur::firstOrCreate([
                        "Nom"=>$request->nom,
                        "Prenom"=>$request->prenom,
                        "Date_Naissance"=>$request->datenaissance,
                        "lieunaissance"=>$request->lieunaissance,
                        "Sexe"=>$request->sexe,
                        "Matricule"=>$request->mat,
                        "Service"=>$request->service,
                        "Grade"=>$request->grade,
                        "Etat"=>$request->etatf,
                        "NSS"=>$request->nss,
                        "NMGSN"=>$request->nmgsnAss, 
                    ]);  
                }
           }
           $assurID= $assurObj !=null ? $assurObj->id : null;
           $patient = patient::firstOrCreate([
                "code_barre"=>$codebarre,
                "Nom"=>$request->nom,
                "Prenom"=>$request->prenom,
                "Dat_Naissance"=>$request->datenaissance,
                "Lieu_Naissance"=>$request->lieunaissance,
                "Sexe"=>$request->sexe,
                "situation_familiale"=>$request->sf, 
                "Adresse"=>$request->adresse,
                "tele_mobile1"=>$request->operateur1 . $request->mobile1,
                "tele_mobile2"=>$request->operateur2 . $request->mobile2,
                "group_sang"=>$request->gs,
                "Rihesus"=>$request->rh,
                "Assurs_ID_Assure"=>$assurID,
                "Type"=>$request->type,
                "Type_p"=> $request->Type_p,
                "description"=> $request->description,
                "NSS"=>$request->nsspatient,
                "Date_creation"=>$date,
            ]);
        return redirect(Route('patient.show',$patient->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $patient = patient::FindOrFail($id);
        $consultations = consultation::where('Patient_ID_Patient',$patient->id)->get();
        $hospitalisations = consultation::join('patients','consultations.Patient_ID_Patient','=','patients.id')
                                        ->where('patients.id','=',$patient->id)
                                        ->join('demandehospitalisations','consultations.id','=','demandehospitalisations.id_consultation')
                                        ->join('hospitalisations','demandehospitalisations.id','=','hospitalisations.id_demande')
                                        ->select('hospitalisations.id','hospitalisations.Date_entree','hospitalisations.Date_entree','hospitalisations.Date_Prevu_Sortie','hospitalisations.Date_Sortie','hospitalisations.id_demande')
                                        ->get();
        //dd($hospitalisations);
        $rdvs = rdv::all();
        return view('patient.show_patient',compact('patient','consultations','rdvs','hospitalisations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

          $patient = patient::FindOrFail($id);
          if($patient->Type != "Autre")
                 //chercher l'assurée
                  $assure =  assur::FindOrFail($patient->Assurs_ID_Assure); 
           else
                  $assure = new assur;
           return view('patient.edit_patient',compact('patient','assure'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

           $date = Date::Now();
           static $assurObj;
           $patient = patient::FindOrFail($id);
           if($patient->Type != "Autre")
           {

                    $assure = assur::FindOrFail($patient->Assurs_ID_Assure);
                     if($request->type == "Assure")
                     {     
                                 dd($request->type ." Assure ");    
                                $assure->update([
                                        "Nom"=>$request->nom,
                                        "Prenom"=>$request->prenom,
                                        "Date_Naissance"=>$request->datenaissance,
                                        "lieunaissance"=>$request->lieunaissance,
                                        "Sexe"=>$request->sexe,
                                        "Matricule"=>$request->mat, 
                                        "Etat"=>$request->etatass,
                                        "Service"=>$request->service,
                                        "Grade"=>$request->grade,
                                        "NMGSN"=>$request->nmgsnAss,
                                        "NSS"=>$request->nss1,
                                 ]);
                                $patient -> update([
                                    "Nom"=>$request->nom,
                                    "Prenom"=>$request->prenom,
                                    "Dat_Naissance"=>$request->datenaissance,
                                    "Lieu_Naissance"=>$request->lieunaissance,
                                    "Sexe"=>$request->sexe,
                                    "Adresse"=>$request->adresse,
                                    "situation_familiale"=>$request->sf,
                                    "tele_mobile1"=>$request->mobile1,
                                    "tele_mobile2"=>$request->mobile2,
                                    "group_sang"=>$request->gs,
                                    "Rihesus"=>$request->rh, 
                                     "Type"=>$request->type,
                                    "Date_creation"=>$date,
                                     "NSS"=> $request->NSS,    
                                ]);
                     }
                     else
                     {         
                                 if($request->type == "Ayant ")
                                {
                                            dd($request->type ." Ayant ");    
                                              $assure->update([
                                            "Nom"=>$request->nomf,
                                            "Prenom"=>$request->prenomf,
                                            "Date_Naissance"=>$request->datenaissancef,
                                            "lieunaissance"=>$request->lieunaissancef,
                                            "Sexe"=>$request->sexef,
                                            "Matricule"=>$request->matf,
                                            "Fonction"=>$request->fonctionf,
                                            "NMGSN"=>$request->NMGSN,
                                            "NSS"=>$request->nss2,
                                            "Etat"=>$request->etat,
                                            "Service"=>$request->servicef,
                                            "Grade"=>$request->gradef,
                                            ]);
                                            $patient -> update([
                                                    "Nom"=>$request->nom,
                                                    "Prenom"=>$request->prenom,
                                                    "Dat_Naissance"=>$request->datenaissance,
                                                    "Lieu_Naissance"=>$request->lieunaissance,
                                                    "Sexe"=>$request->sexe,
                                                    "Adresse"=>$request->adresse,
                                                    "situation_familiale"=>$request->sf,
                                                    "tele_mobile1"=>$request->mobile1,
                                                    "tele_mobile2"=>$request->mobile2,
                                                    "group_sang"=>$request->gs,
                                                    "Rihesus"=>$request->rh, 
                                                     "Type"=>$request->type,
                                                    "Date_creation"=>$date,
                                                     "NSS"=> $request->NSS,    
                                           ]);
                                }
                                else
                                {

                                          if($request->type == "Autre")
                                           { 
                                                     $patient -> update([
                                                            "Nom"=>$request->nom,
                                                            "Prenom"=>$request->prenom,
                                                            "Dat_Naissance"=>$request->datenaissance,
                                                            "Lieu_Naissance"=>$request->lieunaissance,
                                                            "Sexe"=>$request->sexe,
                                                            "Adresse"=>$request->adresse,
                                                            "situation_familiale"=>$request->sf,
                                                            "tele_mobile1"=>$request->mobile1,
                                                            "tele_mobile2"=>$request->mobile2,
                                                            "group_sang"=>$request->gs,
                                                            "Rihesus"=>$request->rh, 
                                                             "Type"=>$request->type,
                                                            "Date_creation"=>$date,
                                                             "NSS"=> $request->NSS,
                                                             "description"=> $request->description, 
                                                   ]);
                                           }
                                           else
                                           {
                                            dd("sdf");
                                           }
                                }
                              
                     }
                      
           }
           else
           { 
                     if($patient->Type == "Autre")  
                     {
                             $patient -> update([
                                "Nom"=>$request->nom,
                                "Prenom"=>$request->prenom,
                                "Dat_Naissance"=>$request->datenaissance,
                                "Lieu_Naissance"=>$request->lieunaissance,
                                "Sexe"=>$request->sexe,
                                "Adresse"=>$request->adresse,
                                "situation_familiale"=>$request->sf,
                                "tele_mobile1"=>$request->mobile1,
                                "tele_mobile2"=>$request->mobile2,
                                "group_sang"=>$request->gs,
                                "Rihesus"=>$request->rh, 
                                 "Type"=>$request->type,
                                "Date_creation"=>$date,
                                "NSS"=> $request->NSS, 
                                "description"=> $request->description,
                     ]);
                     }
                     else
                     {
                         $assure = new assur;
                          if($request->type == "Assure"){     
                            
                                    $assurObj =  $assure->firstOrCreate([
                                            "Nom"=>$request->nom,
                                            "Prenom"=>$request->prenom,
                                            "Date_Naissance"=>$request->datenaissance,
                                            "lieunaissance"=>$request->lieunaissance,
                                            "Sexe"=>$request->sexe,
                                            "Matricule"=>$request->mat, 
                                            "Etat"=>$request->etatass,
                                            "Service"=>$request->service,
                                            "Grade"=>$request->grade,
                                            "NMGSN"=>$request->nmgsnAss,
                                            "NSS"=>$request->nss1,
                                     ]);
                                      
                                 }
                                 else
                                 {         
                                    if($request->type == "Ayant ")
                                    $assurObj =  $assure->firstOrCreate([
                                            "Nom"=>$request->nomf,
                                            "Prenom"=>$request->prenomf,
                                            "Date_Naissance"=>$request->datenaissancef,
                                            "lieunaissance"=>$request->lieunaissancef,
                                            "Sexe"=>$request->sexef,
                                            "Matricule"=>$request->matf,
                                            "Fonction"=>$request->fonctionf,
                                            "NMGSN"=>$request->NMGSN,
                                            "NSS"=>$request->nss2,
                                            "Etat"=>$request->etat,
                                            "Service"=>$request->servicef,
                                            "Grade"=>$request->gradef,
                                     ]);
                                 }
                                    $patient -> update([
                                "Nom"=>$request->nom,
                                "Prenom"=>$request->prenom,
                                "Dat_Naissance"=>$request->datenaissance,
                                "Lieu_Naissance"=>$request->lieunaissance,
                                "Sexe"=>$request->sexe,
                                "Adresse"=>$request->adresse,
                                "situation_familiale"=>$request->sf,
                                "tele_mobile1"=>$request->mobile1,
                                "tele_mobile2"=>$request->mobile2,
                                "group_sang"=>$request->gs,
                                "Rihesus"=>$request->rh, 
                                 "Type"=>$request->type,
                                "Date_creation"=>$date,
                                "NSS"=> $request->NSS,//hfg
                                "Assurs_ID_Assure"=>$assurObj->id,         
                     ]);
                   
                     }
          }
         
           // dd( $patient);
           return redirect(Route('patient.show',$patient->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        patient::destroy($id);
        return redirect() -> route('patient.index');
    }
    public function getpatient()
    {
        $patients = patient::select(['id','code_barre','Nom', 'Prenom', 'Dat_Naissance','Sexe','Date_creation']);
        return Datatables::of($patients)
            ->addColumn('action', function ($patient) {
                return '<div class="hidden-sm hidden-xs btn-group">
                            <a class="btn btn-xs btn-success" href="/patient/'.$patient->id.'">
                                <i class="ace-icon fa fa-hand-o-up bigger-120"></i>
                            </a>
                            <a class="btn btn-xs btn-info" href="'.route('patient.edit',$patient->id).'">
                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                            </a>
                        </div>';
            })
            ->make(true);
    }
    public function getpatientconsult()
    {
        $patientes = patient::select(['id','code_barre','Nom', 'Prenom', 'Dat_Naissance','Sexe','Adresse','Type','Date_creation']);
        return Datatables::of($patientes)
            ->addColumn('action', function ($patient) {
                return '<div class="hidden-sm hidden-xs btn-group">
                            <a class="btn btn-xs btn-success" href="/consultations/create/'.$patient->id.'">
                                <i class="ace-icon fa fa-hand-o-up bigger-120"> Ajouter Consultation</i>
                            </a>
                        </div>';})
            ->addColumn('action2', function ($patient) {
                return '<label>'.Date::parse($patient->Dat_Naissance)->age.'</label>';
            })
            ->rawColumns(['action2','action'])
            ->make(true);
    }
    public function getpatientrdv()
    {
        
        $patientes = patient::select(['id','code_barre','Nom','Prenom', 'Dat_Naissance','Sexe','Adresse','Type','Date_creation']);
        return Datatables::of($patientes)
            ->addColumn('action', function ($patient) {
                return '<div class="hidden-sm hidden-xs btn-group">
                            <a class="btn btn-xs btn-success" href="/rdv/create/'.$patient->id.'">
                                <i class="ace-icon fa fa-hand-o-up bigger-120"> Ajouter RDV</i>
                            </a>
                        </div>';})
            ->addColumn('action2', function ($patient) {
                return '<label>'.Date::parse($patient->Dat_Naissance)->age.'</label>';
            })
            ->rawColumns(['action2','action'])
            ->make(true);
    }
    public function getpatientatcd()
    {
        $patientes = patient::select(['id','code_barre','Nom','Prenom', 'Dat_Naissance','Sexe','Adresse','Type','Date_creation']);
        return Datatables::of($patientes)
            ->addColumn('action', function ($patient) {
                return '<div class="hidden-sm hidden-xs btn-group">
                            <a class="btn btn-lg btn-primary" href="/atcd/create/'.$patient->id.'">
                                <div class="fa fa-plus-circle"></div>&nbsp;
                                 Ajouter Antécédant</i>
                            </a>
                        </div>';})
            ->addColumn('action2', function ($patient) {
                return '<label>'.Date::parse($patient->Dat_Naissance)->age.'</label>';
            })
            ->rawColumns(['action2','action'])
            ->make(true);
            // <i class="ace-icon fa fa-hand-o-up bigger-120">
    }
    public function search(Request $request)
{
         if($request->ajax())  
         {
                $output="";
                $patients=DB::table('patients')->where('Nom','LIKE','%'.$request->search."%")->get();
                if($patients)
                {
                          $i=0;
                          foreach ($patients as $key => $patient) {
                               $i++;
                               $output.='<tr>'.
                               '<td hidden>'.$patient->id.'</td>'.
                                '<td hidden>'.$patient->code_barre.'</td>'.
                                '<td>'.$patient->Nom.'</td>'.
                               '<td>'.$patient->Prenom.'</td>'.
                               '<td>'.$patient->Dat_Naissance.'</td>'.
                               '<td>'.$patient->Sexe.'</td>'.
                               '<td>'."unknown".'</td>'.
                               '<td>'.$patient->situation_familiale.'</td>'.
                               '<td>'.$patient->Type.'</td>'.
                               '<td>'.'<a href="/patient/'.$patient->id.'" class="'.'btn btn-white btn-pink btn-sm"><i class="ace-icon fa fa-hand-o-up bigger-120"></i>&nbsp;Détails</a>'."&nbsp;&nbsp;".'<a href="/patient/'.$patient->id.'/edit" class="'.'btn btn-white btn-success"><i class="ce-icon fa fa-pencil-square-o bigger-120"></i>&nbsp;Modifier</a>'.'</td>'.
                               '</tr>';
                          }
                        return Response($output)->withHeaders(['count' => $i]);
                
               }     
        } 
}
}
