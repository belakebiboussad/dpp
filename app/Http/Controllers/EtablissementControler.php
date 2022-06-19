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
	 	$etab = Etablissement::first();
	 	if(isset($etab))
	 	{//dd(Storage::get($etab->logo));//dd(Storage::url($etab->logo));
	 		return view('etablissement.show',compact('etabl'));
	 	}else
	 		return view('etablissement.add');
	 }
	public function store(Request $request) 
	{
		$filename="";
		$this->validate($request, [
   			'nom'=> 'required|string|max:225',
   			'logo' => 'file|image|mimes:jpeg,png,gif,webp|max:4096'
   		]);
  		if($request->hasfile('logo'))
    		{
	   		$filename = ToUtf::cleanString($request->file('logo')->getClientOriginalName());
	 	  	$request->logo->move(public_path('img/'), $filename);//Storage::putFileAs('public', $request->file('logo'),$filename);
	 	}
	 	$etab =Etablissement::create([
	    	"nom"=>$request->nom,
	   	 	"adresse"=>$request->adresse,
	    	"tel"=>$request->tel,
	    	"tel2"=>$request->tel2,
	    	"tutelle"=>$request->tutelle,
	    	"logo"=>$filename,
	 	]);
		return redirect()->action('EtablissementControler@show',$etab->id);
	}
	public function edit(Etablissement $etab)
	 {
	   	return view('etablissement.edit',compact('etab'));
	 }
	 public function show(Etablissement $etab)
	 {
		return view('etablissement.show',compact('etab'));
	 }
	public function update(Request $request,$id)
	{	
  		$etab = Etablissement::FindOrFail($id);
		$filename="";
		if($request->hasfile('logo')){
			$filename = ToUtf::cleanString($request->file('logo')->getClientOriginalName());
			if(isset($etab->logo) && ($etab->logo != $filename))
			{	
	  			$request->logo->move(public_path('img/'), $filename);//Storage::putFileAs('public', $request->file('logo'),$filename);
	  			File::delete('img/'.$etab->logo);//Storage::disk('public')->delete($etab->logo);
			}	  	
   		}	
		$etab ->update([
  		"nom"=>$request->nom,
 	 		"adresse"=>$request->adresse,
  		"tel"=>$request->tel,
  		"tel2"=>$request->tel2,
  		"tutelle"=>$request->tutelle,
  		"logo"=>$filename,
		]);
		return redirect()->action('EtablissementControler@index');
  }
  public  function destroy(Etablissement $etab)
  {
		if ($etab->logo != "") { 	//Storage::delete($etab->logo);	
   			Storage::disk('public')->delete($etab->logo);
  		}
  		$etab->delete();//$etab = Etablissement::destroy($etab->id);
		return view('etablissement.add');
	}
  	
}
