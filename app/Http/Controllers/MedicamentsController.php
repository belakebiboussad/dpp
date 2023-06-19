<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\modeles\medicament;
use App\modeles\medcamte;
use App\modeles\dispositif;
use App\modeles\reactif;
class MedicamentsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index(Request $request)
  {
    $output="";
    $drugs = medicament::orderby('Nom_com','asc')->where('Nom_com', 'like',$request->search.'%')->limit(15)->get();
    foreach ($drugs as $key => $drug) {         
      $medfrmdsg = $drug->Nom_com.' | '.$drug->Forme.' | '.$drug->Dosage;
      $output.='<li onclick="Fill('.$drug->id.',\''.$drug->Nom_com.'\',\''.$drug->Forme.'\',\''.$drug->Dosage.'\')">'.$medfrmdsg.'</li>';      
    }
    return $output;
  }
  public function edit($id)
  {
    $med = medicament::FindOrFail($id);
    return $med;
  }
  public function getmedicamentsPCH()
  {
    $medicaments = medcamte::with('specialite')->select(['nom','Code_produit','code_produit','id_specialite']); // 
    return DataTables::of($medicaments)
                                    ->addColumn('specialite', function ($medicaments) {
                                                return $medicaments->specialite->nom;
                                      })->make(true);
  }
  public function getdispositifsPCH()
  {
    $dispositifs = dispositif::select(['nom','code']); // 
    return DataTables::of($dispositifs)->make(true);
  }
  public function getreactifsPCH()
  {
    $reactifs = reactif::select(['nom','code']); // 
    return DataTables::of($reactifs)->make(true);
  }
       
}
