<?php

namespace App\Http\Controllers;
use App\modeles\Etablissement;
use Illuminate\Http\Request;
use ToUtf;
class EtablissementControler extends Controller
{
	 public function index() 
	 {
	 	$etablissement = Etablissement::first();
	  	if(isset($etablissement))
	 		return view('etablissement.edit',compact('etablissement'));
	 	else
	 		return view('etablissement.add');
	 }
	public function store(Request $request) 
	{
		$this->validate($request, [
   		'nom'=> 'required|string|max:225',
    ]);
    
    if ($request->hasFile('logo')) {
			  $filename = $request->file('logo')->getClientOriginalName();
			  $filename =  ToUtf::cleanString($filename);
			  dd($filename);
		}
		$etablissement =Etablissement::create($request->all());    
   		return view('etablissement.edit',compact('etablissement'));
	}
	public function update(Request $request,$id)
  {

  	if($request->hasFile('logo')){
  		dd("fsdf");
  	}
  	else
  	{
  		dd($request->all());
  	}
  	$etablissement = Etablissement::FindOrFail($id);
  	$etablissement->update($request->all());
    	return view('etablissement.edit',compact('etablissement')); 
  }
}
