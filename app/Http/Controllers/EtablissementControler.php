<?php

namespace App\Http\Controllers;
use App\modeles\Etablissement;
use Illuminate\Http\Request;
use ToUtf;
use Storage;
class EtablissementControler extends Controller
{
	 public function index() 
	 {
	 	$etablissement = Etablissement::first();
	 	if(isset($etablissement))
	 	{
	 		//dd(Storage::get($etablissement->logo));
	 		//dd(Storage::url($etablissement->logo));
	 		return view('etablissement.edit',compact('etablissement'));
	 	}else
	 		return view('etablissement.add');
	 }
	public function store(Request $request) 
	{
		$this->validate($request, [
   			'nom'=> 'required|string|max:225',
    		]);
  		if($request->ajax())  
  		{
	  	  	$filename = ToUtf::cleanString($request->file('logo')->getClientOriginalName());
	    		$file = file_get_contents($request->file('logo')->getRealPath());
	     		 Storage::disk('local')->put($filename, $file);
	     		 $etablissement =Etablissement::create([
		      		"nom"=>$request->nom,
		     	 	"adresse"=>$request->adresse,
		      		"tel"=>$request->tel,
		      		"logo"=>$filename,
	     		 ]);
	    		return response()->json(['status' => true]); 
     		} 

	}
	public function update(Request $request,$id)
	{
	 	if($request->ajax())  
  		{
  			$etablissement = Etablissement::FindOrFail($id);
  			$filename="";
  			if($request->hasfile('logo')){
  				$filename = ToUtf::cleanString($request->file('logo')->getClientOriginalName());
	    			$file = file_get_contents($request->file('logo')->getRealPath());
	     			Storage::disk('local')->put($filename, $file);//$file->move('uploads/Etablissement/',$filename);
	     			//$file = $request->file('logo');$file->move(public_path('files'), $file->getClientOriginalName());
	     		}
	     		 $etablissement ->update([
		      		"nom"=>$request->nom,
		     	 	"adresse"=>$request->adresse,
		      		"tel"=>$request->tel,
		      		"logo"=>$filename,
	     		 ]);
  			return response()->json(['status' =>true]); 
  		}
  	}
}
