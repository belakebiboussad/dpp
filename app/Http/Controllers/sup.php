  public function store(Request $request)
  {
      static $assurObj;
      $date = Date::Now();
      if( isset($request->assure_id) )
       {
                $rule = array(
                        "nom" => 'required',
                        "prenom" => 'required',
                        "datenaissance" => 'required|date|date_format:Y-m-d',
                        "idlieunaissance" => 'required',
                        "mobile1"=> ['required', 'regex:/[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}/'],
                        "Type_p" =>'required_if:type,Ayant_droit', //"nss" => 'required_if:type,Assure|required_if:type,Ayant_droit|NSSValide',
                        "prenom_homme_c"=>'required_with:nom_homme_c', 
                        "type_piece_id"=>'required_with:nom_homme_c', 
                        "npiece_id"=>'required_with:nom_homme_c', //"lien"=>'required_with:nom_homme_c', //"date_piece_id"=>'required_with:nom_homme_c',    
                        "mobile_homme_c"=>['required_with:nom_homme_c'],
                        "operateur_h"=>'required_with:mobileA',
               ); 
       }else
       {
                $rule = array(
                        "nom" => 'required',
                        "prenom" => 'required',
                        "datenaissance" => 'required|date|date_format:Y-m-d',
                        "idlieunaissance" => 'required',
                        "mobile1"=> ['required', 'regex:/[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}/'],
                        "Type_p" =>'required_if:type,Ayant_droit', //"nss" => 'required_if:type,Assure|required_if:type,Ayant_droit|NSSValide',
                        "nomf" => 'required_if:type,Ayant_droit',
                        "prenomf"=> 'required_if:type,Ayant_droit',  // "datenaissancef"=> 'required_if:type,Ayant_droit|date|date_format:Y-m-d',
                        "lieunaissancef"=> 'required_if:type,Ayant_droit',
                        "NMGSN"=> 'required_if:type,Ayant_droit',
                        "prenom_homme_c"=>'required_with:nom_homme_c',    //"datenaissance_h_c"=>'required_with:nom_homme_c',  // "adresseA"=>'required_with:nom_homme_c',
                        "type_piece_id"=>'required_with:nom_homme_c', 
                        "npiece_id"=>'required_with:nom_homme_c', //"lien"=>'required_with:nom_homme_c', //"date_piece_id"=>'required_with:nom_homme_c',    
                        "mobile_homme_c"=>['required_with:nom_homme_c'],
                        "operateur_h"=>'required_with:mobileA',
               );  // , 'regex:/[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}/' 
       }
        $messages = [
                "required"     => "Le champ :attribute est obligatoire.", // "NSSValide"    => 'le numéro du securite sociale est invalide ',
              "date"         => "Le champ :attribute n'est pas une date valide.",
        ];
        $validator = Validator::make($request->all(),$rule,$messages);   
        if ($validator->fails()) {
            $errors=$validator->errors(); 
            return view('patient.add')->withErrors($errors);
        }  // if(patient::all()->isNotEmpty()){ $nomb = patient::all()->last()->id;}else{$nomb = 0;}
        if( !(isset($request->assure_id)) && ($request->type !="Autre")  )
        {    
               $assurObj = assur::firstOrCreate([
                           "Nom"=>$request->nomf,
                            "Prenom"=>$request->prenomf,
                            "Date_Naissance"=>$request->datenaissancef,
                            "lieunaissance"=>$request->idlieunaissancef,
                            "Sexe"=>$request->sexef,
                            "adresse"=>$request->adressef,
                            "grp_sang"=>$request->gsf.$request->rhf,
                            "Matricule"=>$request->mat,
                            "Service"=>$request->service,
                            "Grade"=>$request->grade,
                            "Etat"=>$request->etatf,
                            "NSS"=>$request->nss,
                            "NMGSN"=>$request->NMGSN, 
               ]);            
       }  //  $assurID= $assurObj !=null ? $assurObj->id : null;//$codebarre =$request->sexe.$date->year."/".($nomb+1);
       $assurID =  isset($request->assure_id) ? $request->assure_id :( $assurObj !=null ? $assurObj->id : null );
       $patient = patient::firstOrCreate([
              "Nom"=>$request->nom,// "code_barre"=>$codebarre,
              "Prenom"=>$request->prenom,
              "Dat_Naissance"=>$request->datenaissance,
              "Lieu_Naissance"=>$request->idlieunaissance,
              "Sexe"=>$request->sexe,
              "situation_familiale"=>$request->sf,
              "nom_jeune_fille"=>$request->nom_jeune_fille, 
              "Adresse"=>$request->adresse,
              'commune_res'=>isset($request->idcommune) ?$request->idcommune:'1556',
              'wilaya_res'=>isset($request->idwilaya) ?$$request->idwilaya:'49',
              "tele_mobile1"=>$request->operateur1 . $request->mobile1,
              "tele_mobile2"=>$request->operateur2 . $request->mobile2,
              "group_sang"=>$request->gs,
              "rhesus"=>$request->rh,
              "Assurs_ID_Assure"=>$assurID,
              "Type"=>$request->type,
              "Type_p"=> $request->Type_p,
              "description"=> $request->description,
              "NSS"=>$request->nsspatient,
              "Date_creation"=>$date,
              "updated_at"=>$date,
         ]);
        $sexe = ($request->sexe == "H") ? 1:0;
        $ipp =$sexe.$date->year.$patient->id;
        $patient->update([
               "IPP" => $ipp,
        ]);
          /*insert homme_c*/
          if(isset($request->nom_homme_c) &&($request->nom_homme_c!="")) 
          {  
              $homme = homme_conf::firstOrCreate([
                        "id_patient"=>$patient->id,
                        "nom"=>$request->nom_homme_c,
                         "prenom"=>$request->prenom_homme_c, 
                         "date_naiss"=>$request->datenaissance_h_c,
                         "lien_par"=>$request->lien,
                         "type_piece"=>$request->type_piece_id,
                         "num_piece"=>$request->npiece_id,
                         "date_deliv"=>$request->date_piece_id,
                         "adresse"=>$request->adresseA,
                         "mob"=>$request->operateur_h.$request->mobile_homme_c,
                        "created_by"=>Auth::user()->employee_id,
              ]);
       }
         return redirect(Route('patient.show',$patient->id)); //return redirect(Route('patient.show',$patient->id,true));
  }