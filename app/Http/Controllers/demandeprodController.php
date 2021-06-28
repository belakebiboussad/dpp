<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\service;
use App\modeles\medcamte;
use App\modeles\dispositif;
use App\modeles\reactif;
use App\modeles\gamme;
use App\modeles\specialite_produit;
use App\modeles\demand_produits;
use App\modeles\demande_dispositif;
use App\modeles\demande_medicaments;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use Response;
class demandeprodController extends Controller
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
    public function get_produit($id_gamme, $id_spes)
    {
      if($id_gamme == 1)
      {
          $produits = medcamte::where("id_specialite",$id_spes)->get();
          return $produits;
      }
      elseif ($id_gamme == 2) {
          $produits = dispositif::all();
          return $produits;
      }
      elseif($id_gamme == 3)
      {
          $produits = reactif::all();
          return $produits;
      }
    }
    public function index()
    {
      if(Auth::user()->role_id == 10)
      {
               $services =service::where('id','!=',14)->get();
               $demandes = demand_produits::where('Etat',null)->orderBy('Date', 'desc')->get();
                return view('demandeproduits.index', compact('demandes','services'));
      }
      else
      {
              $demandes = demand_produits::orderBy('Date', 'desc')->get();
              return view('demandeproduits.index', compact('demandes'));
           
      }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function create()
      {
            $gammes = gamme::all();
            $specialites = specialite_produit::all();
            return view('demandeproduits.add', compact('gammes','specialites'));
      }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
       public function store(Request $request)
      {
              $date = date('Y-m-d');
              $demande = demand_produits::Create([
                     "Date" => $date, // "Etat" => "E",
                    "id_employe" => Auth::user()->employee_id,
             ]);
             $listes = json_decode($request->liste);
            for ($i=1; $i < count($listes); $i++) { 
                    $gamme = gamme::where('nom',$listes[$i]->gamme)->get()->first();
                    if($gamme->id == "1")
                    {
                          $demande->medicaments()->attach($listes[$i]->produit, ['qte' => $listes[$i]->qte]);
                   }
                    elseif($gamme->id == "2") {
                           $demande->dispositifs()->attach($listes[$i]->produit, ['qte' => $listes[$i]->qte]);
                    }
                    elseif($gamme->id == "3") {
                            $demande->reactifs()->attach($listes[$i]->produit, ['qte' => $listes[$i]->qte]);
                    }
             }
            return redirect()->route('demandeproduit.show',$demande->id); 
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function show($id)
      {
             $demande = demand_produits::FindOrFail($id);
             return view('demandeproduits.show', compact('demande'));
      }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
       public function edit($id)
       {
              $gammes = gamme::all();
             $specialites = specialite_produit::all();
             $demande = demand_produits::FindOrFail($id);
              return view('demandeproduits.edit', compact('gammes','specialites','demande'));
      }
       public function run($id)
      {
             $demande = demand_produits::FindOrFail($id);
            return view('demandeproduits.run', compact('demande'));
       }
      public function valider(Request $request,$id)
       {
               $demande = demand_produits::FindOrFail($id);
               $listes = json_decode($request->liste);
               for ($i=0; $i < count($listes); $i++) { 
                    $gamme = gamme::where('nom',trim($listes[$i]->gamme))->get()->first();
                    $attributes = ['qteDonne' => $listes[$i]->qteDem];
                      if($gamme->id == "1")
                      {
                              $demande->medicaments()->updateExistingPivot($listes[$i]->produit, $attributes);
                        }elseif($gamme->id == "2") {
                              $demande->dispositifs()->updateExistingPivot($listes[$i]->produit, $attributes);
                       }elseif($gamme->id == "3") {
                              $demande->reactifs()->updateExistingPivot($listes[$i]->produit, $attributes);
                      }
               }   
              $demande->update([  "etat" => "1" ]);
               return redirect()->action('demandeprodController@index');
    }  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $demande = demand_produits::FindOrFail($id);
          $demande->medicaments()->detach();
          $demande->dispositifs()->detach();
          $demande->reactifs()->detach();
          $listes = json_decode($request->liste);
          for ($i=0; $i < count($listes); $i++) { 
                  $gamme = gamme::where('nom',trim($listes[$i]->gamme))->get()->first();
                  if($gamme->id == "1")
                  {   
                      $demande->medicaments()->attach($listes[$i]->produit, ['qte' => $listes[$i]->qte]);
                  }elseif($gamme->id == "2") {
                       $demande->dispositifs()->attach($listes[$i]->produit, ['qte' => $listes[$i]->qte]);
                    }elseif($gamme->id == "3") {
                      $demande->reactifs()->attach($listes[$i]->produit, ['qte' => $listes[$i]->qte]);
                    }
            }
           return redirect()->action('demandeprodController@show', [ 'id' => $demande->id ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function getProducts()
      {
            $meds = medcamte::paginate(50);
             $dispositifs = dispositif::paginate(50);
             $reactifs = reactif::paginate(50);
             return view('demandeproduits.products', compact('meds','dispositifs','reactifs'));
      }
      public function rejeter($id,$motif)
      {
             $demande = demand_produits::FindOrFail($id);
               $demande->update([
                      "etat" => '0',
                      "motif" => $motif
               ]);
               return redirect()->action('demandeprodController@index');
      }
      public function destroy(Request $request ,$id)
      {
        if($request->ajax())  
        {
          $demande = demand_produits::destroy($id);
          return Response::json($demande); 
        }
        else
        {
          $demande = demand_produits::FindOrFail($id);
          $demande->medicaments()->detach();
          $demande->dispositifs()->detach();
          $demande->reactifs()->detach();
          $demande = demand_produits::destroy($id);
          return redirect()->action('demandeprodController@index');
        } 
      }
      public function search(Request $request)
      {
        if(Auth::user()->is(14)) 
        {
          $ServiceId = Auth()->user()->employ->service;    
          if(isset($request->value))
              $demandes = demand_produits::with('demandeur.Service')->whereHas('demandeur.Service', function($q) use( $ServiceId){
                                       $q->where('id', $ServiceId);
                         })->where($request->field,'LIKE', trim($request->value)."%")->get();
          else
              $demandes = demand_produits::with('demandeur.Service')->whereHas('demandeur.Service', function($q) use( $ServiceId) {
                              $q->where('id', $ServiceId);
                         })->where($request->field, null)->get();
        }else
        {
          if($request->field != "service")  
          {
              if(isset($request->value))
                $demandes = demand_produits::with('demandeur.Service')->where($request->field,'LIKE', trim($request->value)."%")->get();
              else
                $demandes = demand_produits::with('demandeur.Service')->where($request->field, null)->get();
          }else
          {
            $serviceID = $request->value;
            $demandes = demand_produits::with('demandeur.Service')->whereHas('demandeur.Service', function($q) use ($serviceID) {
                                          $q->where('id', $serviceID);
                                        })->get();
          }
        }
        return Response::json($demandes);
      }
}
