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
    public function getmed($id)
    {
         $med = medicament::FindOrFail($id);
        return json_encode($med);
    }
    public function getmedicaments()
    {
       $medicaments = medicament::select(['id','Nom_com','Code_DCI','Forme','Dosage','Conditionnement']); // $x = Datatables::of($medicaments);  // dd($x);
       return Datatables::of($medicaments)
              ->addColumn('action', function ($medicament) {
                     return '<div class="hidden-sm hidden-xs btn-group">
                                 <button class="btn btn-xs btn-primary"  
                                    onclick="medicmV1('.$medicament->id.')">
                                     <i class="ace-icon  fa fa-plus-circle"></i>
                                   </button>';
      })   ->make(true);
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
