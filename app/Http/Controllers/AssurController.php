<?php
namespace App\Http\Controllers;
use App\modeles\assur;
use Illuminate\Http\Request;
use App\modeles\grade;
use App\modeles\Wilaya;
use App\Traits\PatientSearch;
use App\Traits\AssureSearch;
use Carbon\Carbon;
use DateTime;
use Auth;
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
    public function save($obj, $date,$sf, $grade)
    {
        $assure = new assur;
        $assure->Nom = $obj->Nom; $assure->Prenom = $obj->Prenom;
        $assure->Date_Naissance = $date;//$assure->lieunaissance =  1556;
        $assure->Sexe = $obj->Genre;// $assure->SituationFamille = utf8_encode($obj->SituationFamille);
        $assure->SituationFamille =$sf;
        $assure->Matricule = $obj->Matricule;$assure->adresse = utf8_encode($obj->Adresse);//$assure->commune_res = 1556;
        $assure->wilaya_res =  $obj->WilayaResidence;
        $assure->grp_sang = $obj->GroupeSanguin;$assure->NSS = $obj->NSS;
        $assure->Position = utf8_encode($obj->Position);
        $assure->Service =utf8_encode($obj->Service);
        $assure->Grade = $grade;
        $assure->save();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
    /*
    public function show($id) { $assure = assur::FindOrFail($id);   return view('assurs.show',compact('assure'));   }
    */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
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
    public function  updateAssure($situationFamille, $matricule, $adresse,$wilayaResid, $grade, $service ,$position, $NSS)
    {
      $assure = assur::find($NSS);
      $assure->update([
                  "SituationFamille"=>$situationFamille,
                  "adresse"=>$adresse,
                   "wilaya_res"=>$wilayaResid,
                  "Matricule"=>$matricule, 
                  "Service"=>$service,
                  "Position"=>$position,
                  "Grade"=>$grade,
      ] );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $id) 
    { 
      //chemin de registre=I:/MessPrograms/program.net/com/GRH2/GRH2/bin/Debug/GRH2.DLL
      //$handle = new COM("GRH2.Personnel") or die("Unable to instanciate Word"); //dll local//D:/Mes-programmes/DotNET/Dll/GRH2/GRH2
      //J:\TRAVAIL_CDTA\DossierPatient_Projet_Actuel\DGSN-Dossier PAtient\DLL\!DLL_CDTA_My//I:/MessPrograms/program.net/com/GRH/GRH/bin/Debug/GRH.DLL 
      //vrai derniere dll local//D:\cdta-work\Dossier Patient\DGSN-Glysines\DLL\Mien\Debug
      $handle = new COM("GRH.Personnel") or die("Unable to instanciate Word"); 
      //dgsn network dll,path=J:\TRAVAIL_CDTA\DossierPatient_Projet_Actuel\DGSN-Dossier PAtient\DLL\!Last_DGSN_DLL//I:/MessPrograms/program.net/Pgm-Laptop/GRH_DLL/GRH_DLLL/bin/x64/Debug
      //$handle = new COM("GRH_DLL.Personnel") or die("Unable to instanciate Word");
      //teste network dll
      //$handle = new COM("GRH.Personnel") or die("Unable to instanciate Word"); 
      if($handle != null)
      {
        $assure = $handle->SelectPersonnel(trim('12122'),trim(''));//10246 3M534
        $enfants = explode ( '|' , $assure->Enfants);
        // foreach ($enfants as $key => $enfant)
        // {
        //   dd(str_replace($assure->Nom, "",$enfant));    
        // }
        // begin
        $patientId = $this->patientSearchByfirstName($assure->Prenom,$assure->NSS);
        $patientId = $this->patientSearch($assure->Pere,$assure->NSS);
        $date = Carbon::CreateFromFormat('d/m/Y',$assure->Date_Naissance)->format('Y-m-d'); 
        $grade = grade::where('nom',$assure->Grade)->select('id')->get()->first();
        try {
            switch(($assure->SituationFamille{0})){
                  case "M"  :
                        $sf = "M";
                         break; /*case  "Marié(e)" :  $sf = "M"; break; case  "Marié" : $sf = "M";break;*/  
                   case  "C":
                        $sf = "C";
                         break; /* case  "Célibataire(e)"  : $sf = "C"; break; case "Célibataire"  :$sf = "C";break;case "b(Célibataire(e))" :
                        $sf = "C";*/
                         break;
                  case "D"  :
                        $sf = "D";
                         break;/* case "Divorcé(e)" : $sf = "D"; break; case "Divorcé"  :  $sf = "D"; break; */
                  case "V" :
                        $sf = "V";
                         break; /*case "Veuf(Veuve) ":  $sf = "V";   break; case  "b(Veuf(Veuve) )":  $sf = "V"; break;*/
                   default:
                        $sf = "M";
                         break;
           }
                   
        } catch (Throwable $e) {
          dd("Non");
        }
        $grade = grade::where('nom',$assure->Grade)->select('id')->get()->first();
      }else{
        dd("error");
        return("Non");
     }
    }
    public function search(Request $request)
    {
      try {
          //$handle = new COM("GRH2.Personnel") or die("Unable to instanciate Word");   //dll local// D:/Mes-programmes/DotNET/Dll/GRH2/GRH2
          //$handle = new COM("GRH.Personnel") or die("Unable to instanciate Word"); //vrai derniere dll local //D:\cdta-work\Dossier Patient\DGSN-Glysines\DLL\Mien\Debug
          $handle = new COM("GRH_DLL.Personnel") or die("Unable to instanciate Word");//dgsn network sll
          $output=""; $ayants="";
          $assure = $handle->SelectPersonnel(trim($request->matricule),trim($request->nss));
          if($assure->Nom != null)
          {
            $action = ""; 
            $positions = array("Révoqué", "Licencié", "Démission", "Contrat résilié");
            $sexe =  ($assure->Genre =="M") ? "Masculin":"Féminin";
            $service = utf8_encode($assure->Service);
            $date =  \Carbon\Carbon::parse(trim($assure->Date_Naissance))->format('Y-m-d');
            $grade = grade::where('nom',$assure->Grade)->select('id')->get()->first();
            switch(($assure->SituationFamille{0})){
              case "M"  :
                    $sf = "M";
                    $civ ="Marié(e)";
                    break; 
               case  "C":
                    $sf = "C";
                    $civ ="Célibataire(e)";
                    break; 
                     
              case "D"  :
                    $sf = "D";
                    $civ ="Divorcé(e)";
                    break;
              case "V" :
                    $sf = "V";
                    $civ ="Veuf(veuve)";
                    break; 
               default:
                    $sf = "M";
                    $civ ="Marié(e)";
                    break;
            }
            if($this->assureSearch($assure->NSS) == null)//tester si l'assure existe
              $this->save($assure,$date,$sf,$grade->id);//inserer l'assure
            else
              $this->updateAssure($sf, $assure->Matricule, utf8_encode($assure->Adresse) , $assure->WilayaResidence, $grade->id, utf8_encode($assure->Service),utf8_encode($assure->Position), $assure->NSS);
            if(!(in_array(Auth::user()->role->id,[4,8])))//admin & directeur
            {
              if(!in_array(utf8_encode($assure->Position), $positions))
              { 
                $patientId = $this->patientSearchByfirstName($assure->Prenom,$assure->NSS);
                if(isset($patientId))
                  $action = '<a href="/patient/'.$patientId.'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'; 
                else
                  $action = '<a href="assur/patientAssuree/'.$assure->NSS.'/0/'.$assure->Prenom.'" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter patient" data-placement="bottom"><i class="fa fa-plus-circle fa-xs"></i></a>';  
              }else
                $action = '<b><span class="badge badge-danger">'.utf8_encode($assure->Position).'</span></b>';
            }
            $wilaya = (Wilaya::findOrFail($assure->WilayaResidence))->nom;
            $output.='<tr><td>'.$assure->Nom.'</td><td>'.$assure->Prenom.'</td><td>'.$date.'</td><td>'.$sexe.'</td><td>'.$civ.'</td><td>'
                    .$wilaya.'</td><td>'.$assure->NSS.'</td><td>'.utf8_encode($assure->Position).'</td><td>'
                    .$assure->Matricule.'</td><td>'.utf8_encode($assure->Service).'</td><td>'.$assure->Grade.'</td><td class="center">'.$action.'</td></tr>';

            if(!in_array(utf8_encode($assure->Position), $positions))//1
            {    
              if($assure->Conjoint != ''){
                $patientId = $this->patientSearchByType($assure->Conjoint,$assure->NSS);//Ayants  //recherche conjoint
                if(!(in_array(Auth::user()->role->id,[4,8])))
                {
                  if(isset($patientId))
                    $action = '<a href="/patient/'.$patientId.'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'; 
                  else
                  $action = '<a href="assur/patientAssuree/'.$assure->NSS.'/1/'.$assure->Conjoint.'" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter Patient" data-placement="bottom"><i class="fa fa-plus-circle fa-xs"></i></a>';  
                }
                $ayants .='<tr><td>'.$assure->Conjoint.'</td><td><span clas="badge">Conjoint(e)</span></td>'.'<td class="center">'.$action.'</td></tr>';
              }    
              if($assure->Pere != '') {
                $patientId = $this->patientSearchByfirstName($assure->Pere,$assure->NSS);  //recerche pere
                if(!(in_array(Auth::user()->role->id,[4,8])))//admin & directeur
                {
                  if(isset($patientId))
                    $action = '<a href="/patient/'.$patientId.'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'; 
                  else
                    $action = '<a href="assur/patientAssuree/'.$assure->NSS.'/2/'.$assure->Pere.'" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter Patient" data-placement="bottom"><i class="ace-icon  fa fa-plus-circle"></i></a>';  
                }
                $ayants .='<tr><td>'.$assure->Pere.'</td><td><span clas="badge">Pere</span></td>'.'<td class="center">'.$action.'</td></tr>';
              }
              if($assure->Mere != '') {
                $patientId = $this->patientSearchByType(3,$assure->NSS); //Recherce Mere
                if(!(in_array(Auth::user()->role->id,[4,8])))
                {
                  if(isset($patientId))
                    $action = '<a href="/patient/'.$patientId.'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'; 
                  else
                    $action = '<a href="assur/patientAssuree/'.$assure->NSS.'/3/'.$assure->Mere.'" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter Patient" data-placement="bottom"><i class="ace-icon  fa fa-plus-circle"></i></a>';  
                }
                $ayants .='<tr><td>'.$assure->Mere.'</td><td><span clas="badge">Mere</span></td>'.'<td class="center">'.$action.'</td></tr>';
              }
              if($assure->Enfants != '')
              {
                $enfants = explode ( '|' , $assure->Enfants);
                foreach ($enfants as $key => $enfant)
                {
                  $patientId = $this->patientSearchByfirstName(str_replace($assure->Nom, "",$enfant),$assure->NSS);
                  if(!(in_array(Auth::user()->role->id,[4,8])))
                  {
                    if(isset($patientId))
                      $action = '<a href="/patient/'.$patientId.'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'; 
                    else
                      $action = '<a href="assur/patientAssuree/'.$assure->NSS.'/4/'.$enfant.'" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter Patient" data-placement="bottom"><i class="fa fa-plus-circle fa-xs"></i></a>';
                  }
                  $ayants .='<tr><td>'.$enfant.'</td><td><span clas="badge">Enfant</span></td>'.'<td class="center">'.$action.'</td></tr>';    
                }
              }
            }//1
              return Response([$output,$ayants])->withHeaders(['count' =>1]);  
            }else//Nom == ""
            return Response(null)->withHeaders(['count' =>0]);//pas de Fonctionnaire
          
       } catch (Exception $e) {
          echo 'Exception reçue Com Object : ',  $e->getMessage(), "\n";
       }
    }
}