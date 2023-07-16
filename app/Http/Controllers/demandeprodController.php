<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\modeles\service;
use App\modeles\gamme;
use App\modeles\specialite_produit;
use App\modeles\demand_produits;
use App\modeles\demande_dispositif;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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
    public function index(Request $request)
    {
      if($request->ajax())  
      {
        $q = $request->value;  $field= $request->field;
        if(!Auth::user()->is(10)) 
        {
          $ServiceId = Auth()->user()->employ->service_id;    
          if(isset($q))
            return $demandes = demand_produits::with('demandeur.Service')->whereHas('demandeur.Service', function($query) use( $ServiceId){
                                       $query->where('id', $ServiceId);
                         })->where($field,'LIKE', "$q%")->get();
          else
            return $demandes = demand_produits::with('demandeur.Service')->whereHas('demandeur.Service', function($query) use( $ServiceId) {
                              $query->where('id', $ServiceId);
                         })->whereNull($field)->get();
        }else
        {
          if($field != "service")  
          {
            if(isset($request->value))
              return $demandes = demand_produits::with('demandeur.Service')->where($field,'LIKE', "$q%")->get();
            else
              return $demandes = demand_produits::with('demandeur.Service')->whereNull($field)->get();
          }else
          {
            $serviceID = $request->value;
            return $demandes = demand_produits::with('demandeur.Service')->whereHas('demandeur.Service', function($query) use ($serviceID) {
                              $query->where('id', $serviceID);
                                        })->get();
          }
        }
      } else
      {
        if(Auth::user()->is(10))//pharm
        {
          $services =service::where('id','!=',14)->get();
          $demandes = demand_produits::whereNull('Etat')->orderBy('Date', 'desc')->get();
          return view('demandeproduits.index', compact('demandes','services'));
        }
        else
        {
          $serviceID =Auth::user()->employ->service_id;
          $demandes = demand_produits::with('demandeur.Service')->whereHas('demandeur.Service', function($query) use ($serviceID) {
             $query->where('id',$serviceID);  
          })->orderBy('Date', 'desc')->get();
         return view('demandeproduits.index', compact('demandes'));     
        }
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
          $date = Carbon::today();
          $demande = demand_produits::Create([
            "date" => $date,
            "id_employe" => Auth::user()->employe_id,
          ]);
          $listes = json_decode($request->liste);
          for ($i=1; $i < count($listes); $i++) { 
            $gamme = gamme::where('nom',$listes[$i]->gamme)->get()->first();
            if($gamme->id == "1")
                 $demande->medicaments()->attach($listes[$i]->produit, ['qte' => $listes[$i]->qte , 'unite' => $listes[$i]->unite]);
            elseif($gamme->id == "2") 
              $demande->dispositifs()->attach($listes[$i]->produit, ['qte' => $listes[$i]->qte , 'unite' => $listes[$i]->unite]);
            elseif($gamme->id == "3") 
              $demande->reactifs()->attach($listes[$i]->produit, ['qte' => $listes[$i]->qte , 'unite' => $listes[$i]->unite]);
            elseif($gamme->id == "4")
              $demande->consomables()->attach($listes[$i]->produit, ['qte' => $listes[$i]->qte , 'unite' => $listes[$i]->unite]);
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
    $lists = json_decode($request->liste);
    for ($i=0; $i < count($lists); $i++) { 
      $gamme = gamme::where('nom',trim($lists[$i]->gamme))->get()->first();
      if($gamme->id == "1")
        $demande->medicaments()->attach($lists[$i]->produit, ['qte' => $lists[$i]->qte,'unite' => $lists[$i]->unite]);
      elseif($gamme->id == "2")
        $demande->dispositifs()->attach($lists[$i]->produit, ['qte' => $lists[$i]->qte,'unite' => $lists[$i]->unite]);
      elseif($gamme->id == "3")
        $demande->reactifs()->attach($lists[$i]->produit, ['qte' => $lists[$i]->qte,'unite' => $lists[$i]->unite]);
      elseif($gamme->id == "4")
        $demande->consomables()->attach($lists[$i]->produit, ['qte' => $lists[$i]->qte,'unite' => $lists[$i]->unite]);
      }
     return redirect()->action('demandeprodController@show', [ 'id' => $demande->id ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
          demand_produits::destroy($id);
          return $id; 
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
}