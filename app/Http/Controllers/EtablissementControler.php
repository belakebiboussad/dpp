<?php

namespace App\Http\Controllers;
use App\modeles\Etablissement;
use Illuminate\Http\Request;
use ToUtf;
use Storage;
use File;
class EtablissementControler extends Controller
{
	 public function index() 
	 {
	 	$etablissement = Etablissement::first();
	 	if(isset($etablissement))
	 	{//dd(Storage::get($etablissement->logo));//dd(Storage::url($etablissement->logo));
	 		return view('etablissement.show',compact('etablissement'));
	 	}else
	 		return view('etablissement.add');
	 }
	public function store(Request $request) 
	{
		$filename="";
		$this->validate($request, [
   			'nom'=> 'required|string|max:225',
   			'logo' => 'file|image|mimes:jpeg,png,gif,webp|max:4096'
   		 ]);	// if($request->ajax()){} return response()->json(['status' => true]); 
  	if($request->hasfile('logo'))
    {
	   	$filename = ToUtf::cleanString($request->file('logo')->getClientOriginalName());
			$file = file_get_contents($request->file('logo')->getRealPath());//Storage::disk('local')->put($filename, $file); 	
	 	  Storage::putFileAs('public', $request->file('logo'),$filename);
	 	}
	 	$etablissement =Etablissement::create([
	    		"nom"=>$request->nom,
	   	 	"adresse"=>$request->adresse,
	    		"tel"=>$request->tel,
	    		"tutelle"=>$request->tutelle,
	    		"logo"=>$filename,
	 	]);
		return redirect()->action('EtablissementControler@show',$etablissement->id);//return redirect()->action('EtablissementControler@index');
	}
	public function edit(Etablissement $etablissement)
	 {
	   	return view('etablissement.edit',compact('etablissement'));
	 }
	 public function show(Etablissement $etablissement)
	 {
		return view('etablissement.show',compact('etablissement'));
	 }
	public function update(Request $request,$id)
	{	
  		$etablissement = Etablissement::FindOrFail($id);
		$filename="";/*if ($etablissement->logo != "") { Storage::disk('public')->delete($etablissement->logo);//Storage::delete($etablissement->logo); }*/
		if($request->hasfile('logo')){
			$filename = ToUtf::cleanString($request->file('logo')->getClientOriginalName());
			if(isset($etablissement->logo) && ($etablissement->logo != $filename))
			{	//$file = file_get_contents($request->file('logo')->getRealPath());
	  			$path  =  Storage::putFileAs('public', $request->file('logo'),$filename);
	  			Storage::disk('public')->delete($etablissement->logo);
			}	  	
   		}	
		$etablissement ->update([
  			"nom"=>$request->nom,
 	 		"adresse"=>$request->adresse,
  			"tel"=>$request->tel,
  			"tutelle"=>$request->tutelle,
  			"logo"=>$filename,
		]);
		return redirect()->action('EtablissementControler@index');
  }
  public  function destroy(Etablissement $etablissement)
  {
		if ($etablissement->logo != "") { 	//Storage::delete($etablissement->logo);	
   			Storage::disk('public')->delete($etablissement->logo);
  		}
  		$etablissement->delete();//$etab = Etablissement::destroy($etablissement->id);
		return view('etablissement.add');
	}
  	
}
