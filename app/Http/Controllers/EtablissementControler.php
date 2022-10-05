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
	      return view('etablissement.show',compact('etab'));
	 	else
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
    $input = $request->all();
    $input['logo'] = $filename;
    $etab = Etablissement::create($input); 
    return redirect()->action('EtablissementControler@show',$etab->id);
	}
	public function edit(Etablissement $etab)
	{
    $etab = Etablissement::first();
	  return view('etablissement.edit',compact('etab'));
	}
	public function show($id)
	{
    $etab = Etablissement::FindOrFail($id);
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
    $input = $request->all();
    $input['logo'] = $filename;
    $etab->update($input); 
		return redirect()->action('EtablissementControler@index');
  }
  public  function destroy($id)
  {
	  $etab = Etablissement::FindOrFail($id);
    if ($etab->logo != "") { 	//Storage::delete($etab->logo);	
   		Storage::disk('public')->delete($etab->logo);
    };
    $etab->delete();//$etab = Etablissement::destroy($etab->id);
		return view('etablissement.add');
	}
  public function exportCsv(Request $request)
  {
    $fileName = 'etablissement.csv';
    $etab = Etablissement::first();
    $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
    );
    $columns = array('nom', 'acronyme', 'adresse', 'tel','tel2', 'tutelle', 'logo');
    $callback = function() use($etab, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);
        $row['nom']           = $etab->nom;
        $row['acronyme']      = $etab->acronyme;
        $row['adresse']       = $etab->adresse;
        $row['tel']           = $etab->tel;
        $row['tel2']          = $etab->tel2;
        $row['tutelle']       = $etab->tutelle;
        $row['logo']          = $etab->logo;
        fputcsv($file, array($row['nom'], $row['acronyme'], $row['adresse'], $row['tel'], $row['tel2'], $row['tutelle'], $etab->logo));
        fclose($file);
    };
    return response()->stream($callback, 200, $headers);
  }
  	
}
