<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\lit;
use App\modeles\salle;
use App\modeles\service;
use App\modeles\bedReservation;
use App\modeles\DemandeHospitalisation;
use App\modeles\bedAffectation;
use App\modeles\employ;
use Auth; 
use Response;
class LitsController extends Controller
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
        $lits = lit::where('salle_id',$request->id)->get();
        $view = view("Salles.ajax_sallerooms",compact('lits'))->render();
        return ['html'=>$view];
      }else
      {
        $lits=lit::with('salle','salle.service')->get();
        return view('lits.index', compact('lits'));
      }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function createlit()  $services = service::all();{ return view('lits.create_lit_2', compact('services'));}
      public function create(Request $request)
      {
        $services = service::where('hebergement',1)->get();
        if(isset($request->id))
        {
          $salle = salle::FindOrFail($request->id);
          return view('lits.create', compact('services','salle'));
        }else
          return view('lits.create', compact('services'));
        }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request)
     {
       $lit =lit::create($request->all());
       return redirect()->action('LitsController@index');
      }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,lit $lit)
    {
      if($request->ajax())  
      {
        $view = view("lits.show",compact('lit'))->render();
        return Response::json(['html'=>$view]);
      }else
        return view('lits.show', compact('lit'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(lit $lit)
    { $salles = salle::all();
      return view('lits.edit', compact('lit','salles'));
    }
    public function destroy(lit $lit)
    {
      $lit->delete();
      return redirect()->route('lit.index');    
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function update(Request $request, lit $lit)
      { //$lit = lit::FindOrFail($id);
        $input = $request->all();
        $input['bloq'] = isset($_POST['bloq'])  ?  $request->bloq : null ;
        $lit->update($input);   
        return redirect()->route('lit.index');
      }
}