<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\modeles\medicament;

class MedicamentsController extends Controller
{
    public function getmed($id)
    {
        $med = medicament::FindOrFail($id);
        return json_encode($med);
    }
    public function getmedicaments()
    {
        $medicaments = medicament::select(['id','Nom_com','Code_DCI','Forme','Dosage','Conditionnement']);
        // $x = Datatables::of($medicaments);  // dd($x);
           return Datatables::of($medicaments)
                     ->addColumn('action', function ($medicament) {
                                return '<div class="hidden-sm hidden-xs btn-group">
                                         <button class="btn btn-xs btn-primary"  
                                            onclick="medicmV1('.$medicament->id.')">
                                             <i class="ace-icon  fa fa-plus-circle"></i>
                                           </button>';
                              //</div><div class="hidden-sm hidden-xs btn-group">//<a href="#" class="btn btn-xs btn-success"> //<i class="ace-icon fa fa-hand-o-up bigger-120"></i>
                        //     </a>
                        // </div>
            })
            ->make(true);
    }
}
