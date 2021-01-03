<?php
namespace App\Http\Controllers;
use App\modeles\assur;
use Illuminate\Http\Request;
use App\modeles\grade;
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
      switch (utf8_encode($obj->Service)) {
        case 'Sécurité publique':
          $assure->Service = 0;
          break;
        case 'Police judiciaire (PJ)':
          $assure->Service = 1;
          break;
        case 'Brigade mobile de la police judiciaire (BMPJ)':
          $assure->Service = 2;
          break;
        case 'Service protection et sécurité des personnalités':
          $assure->Service = 3;
          break;
        case 'Unité aérienne de la sûreté nationale':
          $assure->Service = 4;
          break;
        case 'Unités républicaines de sécurité (URS)':
          $assure->Service = 5;
          break;
        case 'Police scientifique et technique':
          $assure->Service = 6;
          break;
        case 'Police aux frontières et de l\'immigration (PAF)':
          $assure->Service = 7;
          break;  
        case 'Brigade de recherche et d\'intervention (BRI)':
          $assure->Service = 8;
          break;    
        case 'Groupe des opérations spéciales de la police (GOSP)':
          $assure->Service = 9;
          break;    
        default:
          break;
      } 
      $assure->Nom = $obj->Nom; $assure->Prenom = $obj->Prenom;
      //$date=date_create($obj->Date_Naissance);
      //$assure->Date_Naissance = Carbon\Carbon::create($obj->Date_Naissance)->format("Y-m-d");//$date; 
      $assure->lieunaissance ='1556';
      $assure->Sexe = $obj->Genre;$assure->SituationFamille = utf8_encode($obj->SituationFamille);
      $assure->Matricule = $obj->Matricule;$assure->adresse = utf8_encode($obj->Adresse);
      $assure->commune_res ='1556'; $assure->wilaya_res =$obj->WilayaResidence;
      $assure->grp_sang = $obj->GroupeSanguin;$assure->NSS = $obj->NSS;
      $assure->Position = utf8_encode($obj->Position);//$assure->Service = $obj->Service;
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
        {
          //$handle = new COM("GRH2.Personnel") or die("Unable to instanciate Word"); 
          $handle = new COM("GRH_DLL.Personnel") or die("Unable to instanciate Word"); 
          if($handle != null)
            {
              $ass = $handle->SelectPersonnel(trim('12122'),trim(''));
              dd($ass->Date_Naissance);
              //$date = new Carbon(27,01,1991);
              // $d =  Carbon::parse($ass->Date_Naissance);//->format('Y-m-d')
              // dd($d);
              //$grade = grade::where('nom',$ass->Grade)->select('id')->get()->first();
             
            }else{
              dd("error");
              
              return("Non");
            }
        }
        public function search(Request $request)
        {
          try {
            $handle = new COM("GRH2.Personnel") or die("Unable to instanciate Word");
            //$handle = new COM("GRH_DLL.Personnel") or die("Unable to instanciate Word"); 
            $output=""; $ayants="";
            $assure = $handle->SelectPersonnel(trim($request->matricule),trim($request->nss));   
            if($assure->Nom != null)
            {
              $action = ""; $service ="";
              $sexe =  ($assure->Genre =="M") ? "Masculin":"Féminin";
              $service = utf8_encode($assure->Service);
              if(trim(utf8_encode($assure->Position)) != "Revoqué")//existe maisrevoque
              {
                $patientId = $this->patientSearch($assure->Prenom,$assure->NSS);
                if(isset($patientId))
                  $action = '<a href="/patient/'.$patientId.'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'; 
                else
                  $action = '<a href="assur/patientAssuree/'.$assure->NSS.'/0/'.$assure->Prenom.'" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter patient" data-placement="bottom"><i class="fa fa-plus-circle fa-xs"></i></a>';  
              }  
              else
                $action = '<b><span class="badge badge-danger">Révoqué</span></b>';
              if(utf8_encode($assure->Position) != "Revoqué")
                if($this->assureSearch($assure->NSS) == null)
                  $this->save($assure);
              $output.='<tr><td>'.$assure->Nom.'</td>'.'<td>'.$assure->Prenom.'</td>'.'<td>'.utf8_encode($assure->SituationFamille).'</td>'.
                '<td><span class="badge">'.$assure->Matricule.'</span></td>'. '<td>'.$assure->NSS.'</td>'. 
                '<td>'. $assure->Date_Naissance.'</td>'. '<td>'.$sexe.'</td>'.
                '<td><span class="badge badge-success">'.utf8_encode($assure->Position).'</span></td>'.'<td>'.$service.'</td>'. '<td>'.$assure->Grade.'</td>'.
                '<td class="center">'.$action.'</td></tr>';
              if(trim(utf8_encode($assure->Position)) != "Revoqué")
              {
                $patientId = $this->patientSearch($assure->Conjoint,$assure->NSS);//Ayants  //conjoint
                if(isset($patientId))
                  $action = '<a href="/patient/'.$patientId.'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'; 
                else
                  $action = '<a href="assur/patientAssuree/'.$assure->NSS.'/1/'.$assure->Conjoint.'" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter Patient" data-placement="bottom"><i class="fa fa-plus-circle fa-xs"></i></a>';  
                $ayants .='<tr><td>'.$assure->Conjoint.'</td><td><span clas="badge">Conjoint(e)</span></td>'.'<td class="center">'.$action.'</td></tr>';
                //pere
                $patientId = $this->patientSearch($assure->Pere,$assure->NSS);
                if(isset($patientId))
                  $action = '<a href="/patient/'.$patientId.'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'; 
                else
                  $action = '<a href="assur/patientAssuree/'.$assure->NSS.'/2/'.$assure->Pere.'" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter Patient" data-placement="bottom"><i class="ace-icon  fa fa-plus-circle"></i></a>';  
                $ayants .='<tr><td>'.$assure->Pere.'</td><td><span clas="badge">Pere</span></td>'.'<td class="center">'.$action.'</td></tr>';
                //Mere
                $patientId = $this->patientSearch($assure->Mere,$assure->NSS);
                if(isset($patientId))
                  $action = '<a href="/patient/'.$patientId.'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'; 
                else
                  $action = '<a href="assur/patientAssuree/'.$assure->NSS.'/3/'.$assure->Mere.'" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter Patient" data-placement="bottom"><i class="ace-icon  fa fa-plus-circle"></i></a>';  
                $ayants .='<tr><td>'.$assure->Mere.'</td><td><span clas="badge">Mere</span></td>'.'<td class="center">'.$action.'</td></tr>';
                
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
              return Response([$output,$ayants])->withHeaders(['count' =>1]);
            }else{//pas de donctionnaire
              return Response(null)->withHeaders(['count' =>0]);
            }                 
          }catch (Exception $e) {//errer com
             echo 'Exception reçue Com Object : ',  $e->getMessage(), "\n";
          }
        }
    }