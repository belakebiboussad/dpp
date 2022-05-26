	<div class="row">
    <div class="col-sm-12"><h5 class="header smaller lighter blue"><strong>Informations administratives</strong></h5></div>
	</div>
  <div class="row">
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('nom') ? "has-error" : "" }}">
				<label class="col-sm-3 control-label" for="nom">Nom :<span style="color: red">*</span></label>
				<div class="col-sm-9">
					<input type="text" id="nom" name="nom" value="{{ $patient->Nom }}" class="form-control col-xs-12 col-sm-12" autocomplete= "off" alpha />
					{!! $errors->first('datenaissance', '<small class="alert-danger">:message</small>') !!}
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('prenom') ? "has-error" : "" }}">
				<label class="col-sm-3 control-label" for="prenom">Prénom :<span style="color: red">*</span></label>
				<div class="col-sm-9">
					<input type="text" id="prenom" name="prenom" value="{{ $patient->Prenom }}" class="form-control col-xs-12 col-sm-12" autocomplete="off"/>
						{!! $errors->first('prenom', '<p class="alert-danger">:message</p>') !!}
				</div>
			</div>
		</div>
  </div>
  <div class="row">
    <div class="col-sm-6">
	  	<div class="form-group {{ $errors->has('datenaissance') ? "has-error" : "" }}">
				<label class="col-sm-3 control-label" for="datenaissance">Né(e) le :<span style="color: red">*</span></label>
				<div class="col-sm-9">
					@if(isset($patient->Dat_Naissance)) 
						<input class="col-xs-12 col-sm-12 date-picker ltnow" id="datenaissance" name="datenaissance" type="text" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="{{ $patient->Dat_Naissance }}" autocomplete="off"/>
						{!! $errors->first('datenaissance', '<p class="alert-danger">:message</p>') !!}
					@else
					<input class="col-xs-12 col-sm-12 date-picker ltnow" id="datenaissance" name="datenaissance" type="text" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd"/>
					@endif
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group {{ $errors->has('lieunaissance') ? "has-error" : "" }}">
					<label class="col-sm-3 control-label text-nowrap" for="lieunaissance">Né(e) à :</label>
				  <div class="col-sm-9">
						@if(isset($patient->Lieu_Naissance)) 
							<input type="hidden" name="idlieunaissance" id="idlieunaissance" value={{ $patient->Lieu_Naissance }}>
							<input type="text" id="lieunaissance" class="autoCommune col-xs-12 col-sm-12" value="{{ $patient->lieuNaissance->nom_commune }}"/>
					 	  {!! $errors->first('lieunaissance', '<small class="alert-danger">:message</small>') !!}
					  @else
					  	<input type="hidden" name="idlieunaissance" id="idlieunaissance">
							<input type="text" id="lieunaissance" class="autoCommune col-xs-12 col-sm-12"/>
					  @endif
				  </div>
				</div>
   		</div>
      </div>
      <div class="row">
	    	<div class="col-sm-6">
			  	<div class="form-group {{ $errors->has('sexe') ? "has-error" : "" }}">
				  	<label class="col-sm-3 control-label" for="sexe">Genre :</label>
					  <div class="col-sm-9">
						  <div class="radio">
							<label>
							<input name="sexe" value="M" type="radio" class="ace" {{ $patient->Sexe == "M" ? "checked" : ""}}/>
								<span class="lbl">Masculin</span>
							</label>
							<label>
							<input name="sexe" value="F" type="radio" class="ace" {{ $patient->Sexe == "F" ? "checked" : ""}}/>
								<span class="lbl">Féminin</span>
							</label>
					  	</div>
				  	</div>
			  	</div>
			  </div>
		  	<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-3 control-label text-nowrap" for="gs">Groupe sanguin :</label>
					<div class="col-sm-2">
					<select class="form-control groupeSanguin" id="gs" name="gs">
					@if(!isset($patient->group_sang)  && empty($patient->group_sang)) 
						<option value="" selected >------</option>
						<option value="A" >A</option>
						<option value="B">B</option>
						<option value="AB" >AB</option>
						<option value="O" >O</option>
					@else 		
						<option value="" selected >------</option>
						<option value="A" @if( $patient->group_sang =="A") selected @endif>A</option>
						<option value="B" @if( $patient->group_sang =="B") selected @endif>B</option>
						<option value="AB" @if( $patient->group_sang =="AB") selected @endif>AB</option>
						<option value="O" @if( $patient->group_sang =="O") selected @endif>O</option>
					@endif
					</select>
				</div>
				<label class="col-sm-3 control-label no-padding-right" for="rh">Rhésus :</label>
				<div class="col-sm-2">
				<select id="rh" name="rh">
				@if(!isset($patient->rhesus)  && empty($patient->rhesus)) 
					<option value="" selected >------</option>
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
			</div>
	  </div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-3 control-label text-nowrap" for="sf">Civilité :</label>
					<div class="col-sm-9">
						<select class="form-control civilite" id="sf" name="sf">
							<option value="C" @if( $patient->situation_familiale =='C') selected @endif >Célibataire(e)</option>
							<option value="M" @if( $patient->situation_familiale =='M') selected @endif>Marié(e)</option>
							<option value="D" @if( $patient->situation_familiale =="D") selected @endif >Divorcé(e)</option>
							<option value="V" @if( $patient->situation_familiale =="V") selected @endif  >Veuf(ve)</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-sm-6 " id="Div-nomjeuneFille"  @if(($patient->Sexe != "M") || (in_array($patient->situation_familiale, ["C","D"])) ) hidden @endif>	
				<label class="col-sm-3 control-label text-nowrap" for="nom_jeune_fille">Nom jeune fille:</label>
				<div class="col-sm-9">
					<input type="text" id="nom_jeune_fille" name="nom_jeune_fille" placeholder="Nom jeune fille..." value="{{ $patient->nom_jeune_fille }}" class="col-xs-12 col-sm-12"/>
						 {!! $errors->first('nom_jeune_fille', '<small class="alert-danger">:message</small>') !!}
				</div>		
			</div>
		</div>
		<div class="row"><div class="col-sm-12"><h5 class="header smaller lighter blue"><strong>Contact</strong></h5></div></div>
		<div class="space-12"></div>	
		<div class="row">
			<div class="col-sm-4">
				<label class="control-label col-sm-4 col-xs-4" for="adresse">Adresse:></label>
				<input type="text" value="{{ $patient->Adresse }}" id="adresse" name="adresse" placeholder="Adresse..." class="col-sm-8 col-xs-8"/>
			</div>
			<div class="col-sm-4">
				<label class="control-label col-sm-4 col-xs-4" for="commune">Commune:</label>
				@if(isset($patient->commune_res))
				<input type="hidden" name="idcommune" id="idcommune" value="{{ $patient->commune_res }}"/>
				<input type="text" id="commune"  value="{{ $patient->commune->nom_commune}}" class="autoCommune col-sm-8 col-xs-8"/>					
				@else
				<input type="hidden" name="idcommune" id="idcommune" value=""/>
				<input type="text" id="commune"  value="" class="autoCommune col-sm-8 col-xs-8"/>					
				@endif
			</div>
			<div class="col-sm-4">
				<label class="control-label col-sm-4 col-xs-4">Wilaya :</label>
				@if(isset($patient->wilaya_res))
				<input type="hidden" name="idwilaya" id="idwilaya" value="{{ $patient->wilaya->id }}"/>
				<input type="text" id="wilaya" value="{{ $patient->wilaya->nom }}" class="col-sm-8 col-xs-8"readonly/>	
				@else
				<input type="hidden" name="idwilaya" id="idwilaya" value=""/>
				<input type="text" id="wilaya" value="" class="col-sm-8 col-xs-8"readonly/>	
				@endif
			</div>
		</div><div class="space-12"></div>
		<div class="row">
			<div class="col-sm-3 col-xs-3">
				<div class="form-group">
					<label class="control-label col-sm-4 col-xs-4" for="operateur1">Mob1:</label>
				  <input type="tel" name="mobile1" class="mobile col-sm-8" pattern="0[0-9][0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" value= "{{ $patient->tele_mobile1 }}">
				</div>
				</div>
				<div class="col-sm-3  col-xs-3">
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-4" for="mobile2">Mob2:</label>
					 	<input type="tel" name="mobile2" class="mobile col-sm-8" pattern="0[0-9][0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" value= "{{ $patient->tele_mobile2 }}">
					</div>
				</div>
				<div class="col-sm-3 col-xs-3">
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-4" for="type">Type :<span style="color: red">*</span></label>
						<div class="col-sm-8 col-xs-8">
						<select class="form-control" id="type" name="type" onchange="showTypeEdit(1);"><!-- ,1 -->
							<option value="0" @if($patient->Type =='0') selected @endif>Assure</option>
							<option value="1" @if($patient->Type =='1') selected @endif>Conjoint(e)</option>
							<option value="2" @if($patient->Type =='2') selected @endif>Pere</option>
							<option value="3" @if($patient->Type =='3') selected @endif>Mere</option>
							<option value="4" @if($patient->Type =='4') selected @endif>Enfant</option>
							<option value="5" @if($patient->Type =='5') selected @endif>Dérogation</option>
							<option value="6" @if($patient->Type =='6') selected @endif>Autre</option>
						</select>
					</div>
					</div>
				</div>
				<div class="col-sm-3 col-xs-3">
					<div class="form-group" id="foncform">
						<label class="control-label col-sm-4 col-xs-4" for="nsspatient">NSS:</label>
						<input type="text" value="{{ $patient->NSS }}" id="nsspatient" name="nsspatient" placeholder="XXXXXXXXXXXX" class="col-xs-12 col-sm-6 nssform" maxlength =12 minlength =12/>
					</div>
				</div>
			</div>
 			<div class="row">
				<div class="col-sm-6 starthidden">
					<div class="form-group">
						<label class="control-label col-sm-3 col-xs-3" for="description">Autre information :</label>
						<div class="col-sm-8 col-xs-8">
							<textarea class="form-control" id="description" rows="1" name="description" placeholder="Description" >{{ $patient->description }}</textarea>
						</div>
					</div>			
				</div>
			</div>