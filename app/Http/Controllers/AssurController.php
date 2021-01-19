<?php
namespace App\Http\Controllers;
use App\modeles\assur;
use Illuminate\Http\Request;
use App\modeles\grade;
use App\modeles\Wilaya;
use App\Traits\PatientSearch;
use App\Traits\AssureSearch;
use Carbon\Carbon;
use \COM;
class AssurController extends Controller
{
    use PatientSearch,AssureSearch;    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('assurs.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function create()
      {
          $grades = grade::all();
          return view('assurs.add',compact('grades')); 
      }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $assure = assur::create([
        "Nom"=>$request->nomf,
        "Prenom"=>$request->prenomf,
        "Date_Naissance"=>$request->datenaissancef,
        "lieunaissance"=>$request->idlieunaissancef,
        "Sexe"=>$request->sexef,
        "adresse"=>$request->adressef,
        "commune_res"=>$request->idcommunef,
        "wilaya_res"=>$request->idwilayaf,
        "grp_sang"=>$request->gsf.$request->rhf,
        "Matricule"=>$request->mat,
        "Service"=>$request->service,
        "Grade"=>$request->grade,
        "Etat"=>$request->etatf,
        "NSS"=>$request->nss,
        "NMGSN"=>$request->NMGSN, 
      ]);
       return view('assurs.show',compact('assure'));
    }
    /**
     * //je stock l'assure obtenue de GRH  
     */
    public function save($obj)
    {
            $assure = new assur;
            $grade = grade::where('nom',$obj->Grade)->select('id')->get()->first();
            $assure->Nom = $obj->Nom; $assure->Prenom = $obj->Prenom;
            //$assure->Date_Naissance = Carbon::CreateFromFormat('d/m/Y',$obj->Date_Naissance)->format('Y-m-d');
            $date = Carbon::CreateFromFormat('d/m/Y',$obj->Date_Naissance)->format('Y-m-d');
            $assure->Date_Naissance = $date;
            $assure->lieunaissance =  1556;
            $assure->Sexe = $obj->Genre;$assure->SituationFamille = utf8_encode($obj->SituationFamille);
            $assure->Matricule = $obj->Matricule;$assure->adresse = utf8_encode($obj->Adresse);
            $assure->commune_res = 1556;
            $assure->wilaya_res =  $obj->WilayaResidence;
            $assure->grp_sang = $obj->GroupeSanguin;$assure->NSS = $obj->NSS;
            $assure->Position = utf8_encode($obj->Position);
            $assure->Service =utf8_encode($obj->Service);
            $assure->Grade = $grade->id;
            $assure->save();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
    /*
    public function show($id)
    {
      $assure = assur::FindOrFail($id);
      return view('assurs.show',compact('assure'));
    }
    */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
    /*
      public function edit($id)
      {
        $assure = assur::FindOrFail($id);
         $grades = grade::all(); 
        return view('assurs.edit',compact('assure','grades'));
      }
      */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $assure = assur::find($id);
        $assure -> update([
                "Nom"=>$request->nomf,
                "Prenom"=>$request->prenomf,
                "Date_Naissance"=>$request->datenaissancef,
                "lieunaissance"=>$request->idlieunaissancef,
                "Sexe"=>$request->sexef,
                "adresse"=>$request->adressef,
                "commune_res"=>$request->idcommunef,
                "wilaya_res"=>$request->idwilayaf,
                "grp_sang"=>$request->gsf.$request->rhf,
                "Matricule"=>$request->matf, 
                "Service"=>$request->service,
                "Etat"=>$request->etatf,
                "Grade"=>$request->grade,
                "NMGSN"=>$request->NMGSN,
                "NSS"=>$request->nss,
        ] );
        return redirect(Route('assur.show',$assure->id));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request , $id) 
     { // $handle = new COM("GRH2.Personnel") or die("Unable to instanciate Word"); //dll local//D:/Mes-programmes/DotNET/Dll/GRH2/GRH2
          $handle = new COM("GRH.Personnel") or die("Unable to instanciate Word"); //dll local//D:\cdta-work\Dossier Patient\DGSN-Glysines\DLL\Mien\Debugs
          //$handle = new COM("GRH_DLL.Personnel") or die("Unable to instanciate Word");//network dll
          if($handle != null)
           {
                $ass = $handle->SelectPersonnel(trim('10246'),trim(''));
               
            }else{
                dd("error");
                return("Non");
            }
     }
     public function search(Request $request)
     {
          try {
                //$handle = new COM("GRH2.Personnel") or die("Unable to instanciate Word");   //dll local// D:/Mes-programmes/DotNET/Dll/GRH2/GRH2
                $handle = new COM("GRH.Personnel") or die("Unable to instanciate Word"); //dll local //D:\cdta-work\Dossier Patient\DGSN-Glysines\DLL\Mien\Debugvl
                //$handle = new COM("GRH_DLL.Personnel") or die("Unable to instanciate Word");//network sll
                $output=""; $ayants="";
                $assure = $handle->SelectPersonnel(trim($request->matricule),trim($request->nss));   
                if($assure->Nom != null)
                {
                     $action = ""; 
                     $positions = array("Révoqué", "Licencié", "Démission", "Contrat résilié");
                     $sexe =  ($assure->Genre =="M") ? "Masculin":"Féminin";
                     $service = utf8_encode($assure->Service);
                     if(!in_array(utf8_encode($assure->Position), $positions))
                     { //tester si le patient existe
                          $patientId = $this->patientSearch($assure->Prenom,$assure->NSS);
                          if(isset($patientId))
                               $action = '<a href="/patient/'.$patientId.'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'; 
                          else
                               $action = '<a href="assur/patientAssuree/'.$assure->NSS.'/0/'.$assure->Prenom.'" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter patient" data-placement="bottom"><i class="fa fa-plus-circle fa-xs"></i></a>';  
                     }else
                             $action = '<b><span class="badge badge-danger">'.utf8_encode($assure->Position).'</span></b>';
                     if(!in_array(utf8_encode($assure->Position), $positions))
                          if($this->assureSearch($assure->NSS) == null) //inserer l'assure s'il n'existe pas
                               $this->save($assure);
                    $dateN = Carbon::CreateFromFormat('d/m/Y',$assure->Date_Naissance)->format('Y-m-d');
                    $wilaya = (Wilaya::findOrFail($assure->WilayaResidence))->nom;
                    $output.='<tr><td>'.$assure->Nom.'</td><td>'.$assure->Prenom.'</td><td>'. $dateN.'</td><td>'.utf8_encode($assure->SituationFamille).'</td><td>'
                                .$wilaya.'</td><td>'.$assure->NSS.'</td><td>'.$sexe.'</td><td><span class="badge badge-success">'
                                .utf8_encode($assure->Position).'</span></td><td><span class="badge">'.$assure->Matricule.'</span></td><td>'
                                .utf8_encode($assure->Service).'</td><td>'.$assure->Grade.'</td><td class="center">'.$action.'</td></tr>';
                    if(!in_array(utf8_encode($assure->Position), $positions))
                     {    
                          if($assure->Conjoint != ''){
                                $patientId = $this->patientSearch($assure->Conjoint,$assure->NSS);//Ayants  //recherche conjoint
                                if(isset($patientId))
                                     $action = '<a href="/patient/'.$patientId.'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'; 
                                else
                                     $action = '<a href="assur/patientAssuree/'.$assure->NSS.'/1/'.$assure->Conjoint.'" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter Patient" data-placement="bottom"><i class="fa fa-plus-circle fa-xs"></i></a>';  
                        
                                $ayants .='<tr><td>'.$assure->Conjoint.'</td><td><span clas="badge">Conjoint(e)</span></td>'.'<td class="center">'.$action.'</td></tr>';
                          }    
                         if($assure->Pere != '') {
                                $patientId = $this->patientSearch($assure->Pere,$assure->NSS);  //recerche pere
                                if(isset($patientId))
                                     $action = '<a href="/patient/'.$patientId.'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'; 
                                else
                                     $action = '<a href="assur/patientAssuree/'.$assure->NSS.'/2/'.$assure->Pere.'" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter Patient" data-placement="bottom"><i class="ace-icon  fa fa-plus-circle"></i></a>';  
                                $ayants .='<tr><td>'.$assure->Pere.'</td><td><span clas="badge">Pere</span></td>'.'<td class="center">'.$action.'</td></tr>';
                          }
                          if($assure->Mere != '') {
                               $patientId = $this->patientSearch($assure->Mere,$assure->NSS); //Recherce Mere
                               if(isset($patientId))
                                    $action = '<a href="/patient/'.$patientId.'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'; 
                                else
                                    $action = '<a href="assur/patientAssuree/'.$assure->NSS.'/3/'.$assure->Mere.'" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter Patient" data-placement="bottom"><i class="ace-icon  fa fa-plus-circle"></i></a>';  
                               $ayants .='<tr><td>'.$assure->Mere.'</td><td><span clas="badge">Mere</span></td>'.'<td class="center">'.$action.'</td></tr>';
                          }
                          if($assure->Enfants != '')
                          {
                              $enfants = explode ( '|' , $assure->Enfants);
                               foreach ($enfants as $key => $enfant)
                               {
                                     $patientId = $this->patientSearch($enfant,$assure->NSS);
                                     if(isset($patientId))
                                          $action = '<a href="/patient/'.$patientId.'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'; 
                                     else
                                           $action = '<a href="assur/patientAssuree/'.$assure->NSS.'/4/'.$enfant.'" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter Patient" data-placement="bottom"><i class="fa fa-plus-circle fa-xs"></i></a>';
                                     $ayants .='<tr><td>'.$enfant.'</td><td><span clas="badge">Enfant</span></td>'.'<td class="center">'.$action.'</td></tr>';    
                               }
                          }
                     }
                     return Response([$output,$ayants])->withHeaders(['count' =>1]);
                }else{//pas de Fonctionnaire
                     return Response(null)->withHeaders(['count' =>0]);
                }                 
          }catch (Exception $e) {//errer com
               echo 'Exception reçue Com Object : ',  $e->getMessage(), "\n";
          }
      }
    }