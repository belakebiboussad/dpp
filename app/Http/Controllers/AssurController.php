<?php
namespace App\Http\Controllers;
use App\modeles\assur;
use Illuminate\Http\Request;
use App\modeles\grade;
use Carbon;
use \COM;
class AssurController extends Controller
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
     * Display the specified resource.
     *
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $assure = assur::FindOrFail($id);
       return view('assurs.show',compact('assure'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
      public function edit($id)
      {
            $assure = assur::FindOrFail($id);
            $grades = grade::all(); 
             return view('assurs.edit',compact('assure','grades'));
      }

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
      ] );//$assure->save(); 
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
                   $handle = new COM("GRH2.Personnel") or die("Unable to instanciate Word"); 
                      if($handle != null)
                      {
                            $p1 = $handle->SelectPersonnel(trim('fdff'),trim("13562487569568"));   
                            return( $p1->Nom );
                      return request('matricule') ;
                      }else{
                              return("Non");
                      }
        }
        public function search(Request $request)
        {
               if($request->ajax())  
              {
                      $handle = new COM("GRH2.Personnel") or die("Unable to instanciate Word"); 
                       $output=""; $ayants="";  
                      if($handle != null)
                      {                              
                            $assure = $handle->SelectPersonnel(trim($request->matricule),trim($request->nss));   
                             if($assure->Nom != null)
                            {   
                                    if(trim($assure->Position) != "Revoque")
                                     {
                                           $ayants .='<tr><td>'.$assure->Conjoint.'</td><td><span clas="badge">Conjoint(e)</span></td>'.
                                                    '<td class="center">'.'<a href="" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Selectionner" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'.'</td></tr>'. '<tr>'.'<td>'. $assure->Pere.'</td>'. '<td>'.'Pere'.'</td>'.'<td class="center">'.'<a href="" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Selectionner" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'.'</td></tr>'. '<tr>'.'<td>'. $assure->Mere.'</td>'. '<td>'.'Mere'.'</td>'.'<td class="center">'.'<a href="" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Selectionner" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>'.'</td></tr>' ;
                                 
                                            $enfants = explode ( '|' , $assure->Enfants);
                                            foreach ($enfants as $key => $enfant) {
                                                    $ayants .='<tr><td>'.$enfant.'</td><td>Ascendant'.'</td>'.'<td class="center">'.
                                                           '<button onclick= "selectPatient(\''.trim($assure->Nom).'\',\''.trim($enfant).'\');" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Selectionner" ><i class="fa fa-hand-o-up fa-xs"></i></button>'.
                                                           '</td></tr>';
                                           } 
                                     }               
                                     $sexe =  ($assure->Genre =="M") ? "Masculin":"Féminin"; 
                                     $action ="";
                                     if(trim($assure->Position) != "Revoque")
                                           $action = '<a href="" class="'.'btn btn-primary btn-xs" data-toggle="tooltip" title="Selectionner" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i></a>';     
                                    else
                                            $action = '<b><span class="badge badge-danger">Révoqué</span></b>';
                                     $output.='<tr><td>'.$assure->Nom.'</td>'.'<td>'.$assure->Prenom.'</td>'.'<td>'.$assure->SituationFamille.'</td>'.
                                     '<td><span class="badge">'.$assure->Matricule.'</span></td>'. '<td>'.$assure->NSS.'</td>'. 
                                      '<td>'. Carbon\Carbon::parse($assure->Date_Naissance)->format('Y-m-d') .'</td>'. '<td>'.$sexe.'</td>'.
                                     '<td><span class="badge badge-success">'.$assure->Position.'</span></td>'.
                                     '<td>'.$assure->service.'</td>'. '<td>'.$assure->Grade.'</td>'.
                                     '<td class="center">'.$action.'</td></tr>';                                      
                                     return Response([$output,$ayants])->withHeaders(['count' =>1]);
                              }else
                              {
                                     return Response(null)->withHeaders(['count' =>0]);
                              }
                         
                      }else
                              return("Non");
              }
        }
        /*
        public function searchold(Request $request)
       {  if($request->ajax())  {   $output="";     $assures =   assur::where('Matricule', 'like', '%' . request('matricule') . '%')->where('NSS', 'LIKE', '%' . request('nss') . "%")->get(); 
  if($assures)   { $i=0; foreach ($assures as $key => $assure)
                              { $i++;     $sexe =  ($assure->Sexe =="M") ? "Homme":"Femme";   $grade = (isset($assure->grade) )? $assure->grade->nom :"";  
                                     $service= "";
                                     switch($assure->Service) 
                                    {  case "1":$service="Sécurité publique"; break; case "2": $service="Police judiciaire (PJ)"; break;  case "3":  $service="Brigade mobile de la police judiciaire (BMPJ)";  break;  case "4":  $service="Service protection et sécurité des personnalités (SPS)";break; case "5":    $service="Unité aérienne de la sûreté nationale"; break;case "6": $service="Unités républicaines de sécurité (URS)";break; case "7":$service="Police scientifique et technique";break;  case "8":$service="Police aux frontières et de l'immigration (PAF)"; break;case "9": $service="Brigade de recherche et d'intervention (BRI)"; break; case "10":  $service="Groupe des opérations spéciales de la police (GOSP)";  break;
                                   }
                                  $output.='<tr>'.
                                      '<td>'.$i.'</td>'.
                                      '<td hidden>'.$assure->id.'</td>'. 
                                      '<td><span class="badge">'.$assure->matricule.'</span></td>'.
                                       '<td>'.$assure->NSS.'</td>'.                          
                                      '<td>'.$assure->Nom.'</td>'.
                                      '<td>'.$assure->Prenom.'</td>'.
                                      '<td>'.$assure->Date_Naissance.'</td>'.
                                      '<td>'.$sexe.'</td>'.// ["nom"]
                                     '<td><span class="badge badge-success">'.$assure->Etat.'</span></td>'.
                                     '<td>'.$service.'</td>'.
                                      '<td class="center">'.'<a href="/assur/'.$assure->id.'" class="'.'btn btn-warning btn-xs" data-toggle="tooltip" title="Consulter" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i>&nbsp;</a>'."&nbsp;&nbsp;".'<a href="/assur/'.$assure->id.'/edit" class="'.'btn btn-info btn-xs" data-toggle="tooltip" title="modifier"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></a>'.'</td></tr>';  
                              }
                               return Response($output)->withHeaders(['count' => $i]);
                      }else
                              return"no";      
              }
        }
        */
}