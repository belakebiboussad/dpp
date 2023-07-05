<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\modeles\medicament;
use App\modeles\Drug;
use App\modeles\Dispositif;
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
      }
}