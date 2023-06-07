<h4 class="header lighter block blue">Informations administratives</h4>
<div class="row">
	<div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label required" for="nom">Nom</label>
		<div class="col-sm-9">
			<input type="text" id="nom" name="nom" value="{{ $patient->Nom }}" class="form-control" required  />
			{!! $errors->first('datenaissance', '<small class="alert-danger">:message</small>') !!}
		</div>
  </div>
	<div class="form-group {{ $errors->has('prenom') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label required" for="prenom">Prénom</label>
		<div class="col-sm-9">
			<input type="text" id="prenom" name="prenom" value="{{ $patient->Prenom }}" class="form-control" required/>
				{!! $errors->first('prenom', '<p class="alert-danger">:message</p>') !!}
		</div>
	</div>
</div>
  <div class="row">
	 <div class="form-group {{ $errors->has('datenaissance') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label required" for="datenaissance">Né(e) le</label>
		<div class="col-sm-9">
			@if(isset($patient->Dat_Naissance)) 
				<input class="form-control date-picker ltnow" id="datenaissance" name="datenaissance" type="text" data-date-format="yyyy-mm-dd" value="{{ $patient->Dat_Naissance->format('Y-m-d')}}" required/>
				{!! $errors->first('datenaissance', '<p class="alert-danger">:message</p>') !!}
			@else
			<input class="form-control date-picker ltnow" id="datenaissance" name="datenaissance" type="text" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd"/>
			@endif
		</div>
	</div>
	<div class="form-group {{ $errors->has('lieunaissance') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label" for="lieunaissance">Né(e) à</label>
	  <div class="col-sm-9">
			@if(isset($patient->Lieu_Naissance)) 
				<input type="hidden" name="idlieunaissance" id="idlieunaissance" value={{ $patient->Lieu_Naissance }}>
				<input type="text" id="lieunaissance" class="form-control autoCommune" value="{{ $patient->lieuNaissance->nom_commune }}"/>
		 	  {!! $errors->first('lieunaissance', '<small class="alert-danger">:message</small>') !!}
		  @else
		  	<input type="hidden" name="idlieunaissance" id="idlieunaissance">
				<input type="text" id="lieunaissance" class="form-control autoCommune "/>
		  @endif
	  </div>
	</div>
</div>
<div class="row">
  <div class="form-group {{ $errors->has('sexe') ? 'has-error' : '' }} col-sm-4">
	  	<label class="col-sm-3 control-label" for="sexe">Genre</label>
		  <div class="col-sm-9">
			  <div class="radio">
				<label>
				<input name="sexe" value="M" type="radio" class="ace" {{ $patient->Sexe == "M" ? "checked" : ""}}/><span class="lbl">Masculin</span>
					
				</label>
				<label>
				<input name="sexe" value="F" type="radio" class="ace" {{ $patient->Sexe == "F" ? "checked" : ""}}/><span class="lbl">Féminin</span>
				</label>
		  	</div>
	  	</div>
  </div>
	<div class="form-group col-sm-4">
    <label class="col-sm-3 control-label" for="sf">Civilité</label>
      <div class="col-sm-9">
        <select class="form-control civilite" id="sf" name="sf">
          <option value="C" @if( $patient->sf =='C') selected @endif >Célibataire(e)</option>
          <option value="M" @if( $patient->sf =='M') selected @endif>Marié(e)</option>
          <option value="D" @if( $patient->sf =="D") selected @endif >Divorcé(e)</option>
          <option value="V" @if( $patient->sf =="V") selected @endif  >Veuf(ve)</option>
        </select>
      </div>
  </div>
  <div class="form-group col-sm-4 " id="Div-nomjeuneFille"  @if(($patient->Sexe == "M") || (in_array($patient->sf, ["C","D"]))) hidden @endif > 
    <label class="col-sm-3 control-label text-nowrap" for="nom_jeune_fille">Nom J fille</label>
    <div class="col-sm-9">
      <input type="text" id="nom_jeune_fille" name="nom_jeune_fille" placeholder="Nom jeune fille..." value="{{ $patient->nom_jeune_fille }}" class="form-control"/>
       {!! $errors->first('nom_jeune_fille', '<small class="alert-danger">:message</small>') !!}</div>  
  </div>
</div>
<div class="row">	
	<div class="form-group col-sm-4">
    <label class="col-sm-3 control-label" for="gs">Groupe S</label>
    <div class="col-sm-3">
      <select class="form-control groupeSanguin" id="gs" name="gs">
      @if(!isset($patient->group_sang)  && empty($patient->group_sang)) 
        <option value="" selected >------</option>
        <option value="A" >A</option>
        <option value="B">B</option>
        <option value="AB" >AB</option>
        <option value="O" >O</option>
      @else     
        <option value="" selected>------</option>
        <option value="A" @if( $patient->group_sang =="A") selected @endif>A</option>
        <option value="B" @if( $patient->group_sang =="B") selected @endif>B</option>
        <option value="AB" @if( $patient->group_sang =="AB") selected @endif>AB</option>
        <option value="O" @if( $patient->group_sang =="O") selected @endif>O</option>
      @endif
      </select>
    </div>
    <label class="col-sm-3 control-label" for="rh">Rhésus</label>
    <div class="col-sm-3">
        <select id="rh" name="rh" class="form-control">
        @if(!isset($patient->rhesus)  && empty($patient->rhesus)) 
          <option value="" selected>------</option>
          <option value="+">+</option>
          <option value="-">-</option>
        @else
          <option value="" >------</option>
          <option value="+" @if( $patient->rhesus =="+") selected @endif>+</option>
          <option value="-" @if( $patient->rhesus =="-") selected @endif>-</option>
        @endif
        </select>
    </div>
  </div>
    <div class="form-group col-sm-4">
    <label class="col-sm-3 control-label text-nowrap" for="nationalite">Nationnalité</label>
    <div class="col-sm-9">
     <select class="form-control" name="nationalite">
      <option value="" {{ is_null($patient->nationalite)? 'selected':''}}>Algérienne</option>
      <option value="1" {{ ($patient->nationalite ===1)? 'selected':''}}>Autre</option>
     </select>
    </div>
  </div>
</div>
<h4 class="header lighter block blue">Contact</h4>
<div class="row">
	<div class="form-group  col-sm-6">
		<label class="control-label col-sm-2 col-md-2" for="adresse">Adresse</label>
		<div class="col-sm-10 col-md-10">
      <input type="text" value="{{ $patient->Adresse }}" id="adresse" name="adresse" placeholder="Adresse..." class="form-control"/>
    </div>
	</div>
	<div class="form-group  col-sm-3 col-md-3">
		<label class="control-label col-sm-4 col-md-4" for="commune">Commune</label>
		<div class="col-sm-8 col-md-8">
    @if(isset($patient->commune_res))
		<input type="hidden" name="idcommune" id="idcommune" value="{{ $patient->commune_res }}"/>
    <input type="text" id="commune"  value="{{ $patient->commune->nom_commune}}" class="autoCommune form-control"/>					
		@else
		<input type="hidden" name="idcommune" id="idcommune" value=""/>
		<input type="text" id="commune"  value="" class="autoCommune "/>					
		@endif
	  </div>
  </div>
	<div class="form-group col-sm-3 col-md-3">
		<label class="control-label col-sm-4 col-md-4">Wilaya</label>
		<div class="col-sm-8 col-md-8">
    @if(isset($patient->wilaya_res))
		<input type="hidden" name="idwilaya" id="idwilaya" value="{{ $patient->wilaya->id }}"/>
		<input type="text" id="wilaya" value="{{ $patient->wilaya->nom }}" class="form-control" readonly/>	
		@else
		<input type="hidden" name="idwilaya" id="idwilaya" value=""/>
		<input type="text" id="wilaya" value="" class="form-control" readonly/>	
		@endif
  </div>
	</div>
</div>
<div class="row">
  <div class="form-group col-sm-3">
  	<label class="control-label col-sm-4 col-md-4" for="mobile1">Mob1</label>
    <div class="input-group col-sm-8">
      <span class="input-group-addon fa fa-phone"></span> 
      <input type="tel" name="mobile1" class="form-control mobile" value= "{{ $patient->tele_mobile1 }}">
    </div>
  </div>
  <div class="form-group col-sm-3">
  	<label class="control-label col-sm-4 col-md-4" for="mobile2">Mob2</label>
    <div class="input-group col-sm-8 col-md-8">
      <span class="input-group-addon fa fa-phone"></span> 	 	
        <input type="tel" name="mobile2" class="form-control mobile" value= "{{ $patient->tele_mobile2 }}">
    </div>
  </div>
  <div class="form-group col-sm-3">
	<label class="control-label col-sm-5 col-md-5 required" for="type">Type</label>
	<div class="col-sm-7 col-md-7">
  <select class="form-control" id="type" name="type" onchange="patTypeChange($(this).val());">
  		@foreach($types as $type)
        <option value="{{ $type->id }}" {{ ($patient->type_id == $type->id) ? 'selected': ''}}> {{ $type->nom }}</option>
      @endforeach
  		</select>
  	</div>
  </div>
	<div class="form-group col-sm-3" id="foncform">
		<label class="control-label col-sm-4 col-md-4" for="nsspatient">NSS</label>
		<div class="col-sm-8 col-md-8">
      <input type="text" value="{{ $patient->NSS }}" id="nsspatient" name="nsspatient" placeholder="Numéro sécurité sociale" class="nssform form-control" maxlength =12 minlength =12/>
    </div>
	</div>
</div>
 <div class="row">
	<div class="form-group col-sm-6" id="otherPat">
		<label class="control-label col-sm-3 col-md-3" for="description">Information</label>
  	<div class="col-sm-9">
  		<textarea class="form-control" id="description" rows="1" name="description" placeholder="Description" >{{ $patient->description }}</textarea>
  	</div>
	</div>
</div>