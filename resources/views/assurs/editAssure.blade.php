<div id ="assurePart">
	<div class="row  Asdemograph">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 col-xs-3 control-label" for="nomf">	<strong>Nom :</strong></label>
				<div class="col-sm-9">
					@if(isset($assure) && !empty($assure))
						<input type="text" id="nomf" name="nomf"  value="{{ $assure->Nom }}" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
					@else
						<input type="text" id="nomf" name="nomf"  value="" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
					@endif	
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="prenomf"><strong>Prénom :</strong></label>
				<div class="col-sm-9">
					@if(isset($assure) && !empty($assure))
						<input type="text" id="prenomf" name="prenomf"  value="{{ $assure->Prenom }}" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
					@else
							<input type="text" id="prenomf" name="prenomf"  value="" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
					@endif
				</div>
			</div>
		</div>
  </div>
  <div class="row Asdemograph">
		<div class="col-sm-6 " >
			<div class="form-group">
				<label class="col-sm-3 col-xs-3 control-label" for="datenaissancef"><strong class="text-nowrap">Né(e) le :</strong></label>
				<div class="col-sm-9">
					@if(isset($assure) && !empty($assure))
						<input class="com_typeahead col-xs-12 col-sm-12 date-picker" id="datenaissancef" name="datenaissancef" type="text" placeholder="Date de naissance..." data-date-format="yyyy-mm-dd" value="{{ $assure->Date_Naissance }}" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
					@else	
						<input class="com_typeahead col-xs-12 col-sm-12 date-picker" id="datenaissancef" name="datenaissancef" type="text" placeholder="Date de naissance..." data-date-format="yyyy-mm-dd" value="" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
					@endif
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 col-xs-3 control-label" for="lieunaissancef"><span class="text-nowrap"><strong>Né(e) à:</strong></span></label>
				<div class="col-sm-9">
					<div class="col-sm-9">
					@if(isset($assure) && !empty($assure))
						<input type="hidden" name="idlieunaissancef" id="idlieunaissancef" value="{{  $assure->lieunaissance  }} ">
						<input type="text" id="lieunaissancef" name="" class="com_typeahead col-xs-12 col-sm-12" value="{{ $assure->lieuNaissance->nom_commune }}" autocomplete= "off" />
					@else	
						<input type="hidden" name="idlieunaissancef" id="idlieunaissancef" value="">
						<input type="text" id="lieunaissancef" name="" class="com_typeahead col-xs-12 col-sm-12" value="" autocomplete= "off" />
					@endif
				</div>
					</div>
				</div>
		</div>
	</div>
	<div class="row Asdemograph">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 col-xs-3 control-label no-padding-right" for="sexe"><Strong>Genre: </Strong></label>
  			<div class="col-sm-9">
          <div class="radio">
             @if(isset($assure) && !empty($assure))
            	  @if($assure->Sexe == "M")
              	<label><input name="sexef" value="M" type="radio" class="ace" checked/><span class="lbl"> Masculin</span> </label>
								<label><input name="sexef" value="F" type="radio" class="ace"/><span class="lbl"> Féminin</span></label>	
								@else
								<label><input name="sexef" value="M" type="radio" class="ace" checked ='' /><span class="lbl"> Masculin</span> </label>
	               	<label><input name="sexef" value="F" type="radio" class="ace" checked  = 'checked'/><span class="lbl"> Féminin</span></label>
	               	@endif
             @else   
              <label><input name="sexef" value="M" type="radio" class="ace" /><span class="lbl" > Masculin</span></label>
              <label><input name="sexef" value="F" type="radio" class="ace" /> <span class="lbl" > Féminin</span></label>      
             @endif
            </div>
        </div>
     	</div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
	   		<label class="col-sm-3 col-xs-3 control-label text-nowrap" for="gsf"><strong>Groupe sanguin :</strong></label>
			<div class="col-sm-2">
				@if(isset($assure) && !empty($assure))
					<select class="form-control" id="gsf" name="gsf">
						<option value=""  {{ ($assure->grp_sang=="")? "selected" : "" }} >------</option>
						<option value="A"  {{  (substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "A" )? "selected" : ""  }}>A</option>
						<option value="B"  {{  (substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "B" )? "selected" : ""  }}>B</option>
						<option value="O"  {{  (substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "O" )? "selected" : ""  }}>O</option>
						<option value="AB"  {{  (substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "AB" )? "selected" : ""  }}>AB</option>	
					</select>
				@else 
					<select class="form-control" id="gsf" name="gsf">
						<option value="">------</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="O">O</option>
						<option value="AB">AB</option>
					</select>
				@endif
			</div>
			<label class="col-sm-3 control-label no-padding-right" for="rhf"><strong>Rhésus:</strong></label>
			<div class="col-sm-2">
			@if(isset($assure) && !empty($assure))
				<select id="rhf" name="rhf">
					<option value=""  {{ ($assure->grp_sang=="")? "selected" : "" }} >------</option>
					<option value="+" {{  (substr($assure->grp_sang,strlen($assure->grp_sang)-1,strlen($assure->grp_sang)) == "+" )? "selected" : ""  }}>+</option>
					<option value="-" {{  (substr($assure->grp_sang,strlen($assure->grp_sang)-1,strlen($assure->grp_sang)) == "-" )? "selected" : ""  }}>-</option>
				</select>
			@else
				<select id="rhf" name="rhf">
					<option value="">------</option>
					<option value="+"  >+</option>
					<option value="-">-</option>
				</select> 
			@endif
			</div>
	   	</div>
    </div>
  </div>
  <div class="row">
		<div class="col-sm-12"><h3 class="header smaller lighter blue">Contact</h3>	</div>
	</div>
	<div class="row Asdemograph">
		<div class="col-sm-4">
			<div class="form-group">
			 	<label class="col-sm-4 col-xs-4 control-label no-padding-right" for="adressef"><Strong>Adresse: </Strong></label>
	  			<div class="col-sm-8">
	  			@if(isset($assure) && !empty($assure))
	  				<input type="text" id="adressef" name="adressef"  class="col-xs-12 col-sm-12" value= "{{ $assure->adresse }}" />
	  			  @else 
	  			  <input type="text" id="adressef" name="adressef"  placeholder="Adresse..."  class="col-xs-12 col-sm-12" />  
	  			  @endif
	  			</div>
	  	</div>
	  </div>
	  <div class="col-sm-4">
	  	<label class="col-sm-4 col-xs-4 control-label text-nowrap" for="communef"><strong>Commune:</strong></label>
	  	@if(isset($assure->commune) && !empty($assure->commune))
	  	<input type="hidden" name="idcommunef" id="idcommunef" value="{{  $assure->commune_res  }}">
			<input type="text" id="communef" name="" class="com_typeahead col-xs-9 col-sm-9" value="{{ $assure->commune->nom_commune }}"/>
	  	@else	
			<input type="hidden" name="idcommunef" id="idcommunef">
	 		<input type="text" value="" id="communef" placeholder="commune résidance" class="com_typeahead col-xs-8 col-sm-8"/>
	 		@endif
	  </div>
	  <div class="col-sm-4">
	  	<label class="col-sm-4 col-xs-4" for="wilayaf"><strong>Wilaya:</strong></label>
	  	@if(isset($assure->wilaya) && !empty($assure->wilaya))
	  	<input type="hidden" name="idwilayaf" id="idwilayaf" value="{{  $assure->wilaya_res  }}">
		  <input type="text" value="{{ $assure->wilaya->nom_wilaya }}" id="wilayaf" class="col-sm-8 col-xs-8" readonly />	
	  	@else	
	  	<input type="hidden" name="idwilayaf" id="idwilayaf">
		  <input type="text" value="" id="wilayaf" placeholder="wilaya résidance" class="col-sm-8 col-xs-8" readonly />
		  @endif
	  </div>
  </div>
	<div class="row">
		<div class="col-sm-12"><h3 class="header smaller lighter blue">Fonction</h3>	</div>
	</div>	
  <div class="row">
    <div class="col-sm-6" id="statut">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="etatf"><strong>Etat :</strong></label>
				<div class="col-sm-9">
				<div class="radio">
				 @if(isset($assure) && !empty($assure))
					<label><input name ="etatf" value="Activite"  type="radio"  class="ace" @if($assure->Etat =='Activite') Checked @endif />
						<span class="lbl">Activité</span>
					</label>
					<label><input name ="etatf" value="Retraite"  type="radio"  class="ace" @if($assure->Etat =='Retraite') Checked @endif />
						<span class="lbl"> Retraite</span>
					</label>
					<label><input name="etatf" value="conge_maladie"  type="radio" class="ace" @if($assure->Etat =='conge_maladie') Checked @endif />
							<span class="lbl"> Congé Maladie</span>
					</label>
				@else
				<!-- <label hidden><input name="etatf" value="" type="radio" class="ace"/><span class="lbl"> Autre</span></label> -->
				<label><input name="etatf" value="Activite" type="radio" class="ace" /><span class="lbl" Checked> Activité</span></label>
				<label><input name="etatf" value="Retraite" type="radio" class="ace" Checked /><span class="lbl"> Retraite</span></label>
				<label><input name="etatf" value="Mise en disponibilite" type="radio" class="ace" /><span class="lbl"> Congé Maladie</span>
				</label>
				 @endif
				</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6" id = "serviceFonc">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="service"><strong>Service :</strong></label>
				<div class="col-sm-9">
					@if(isset($assure) && !empty($assure))
					<select name="service" id="service" class="col-xs-12 col-sm-12">
						<option value="">Sélectionner...</option>
						<option value="Agent civile" {{ ($assure->Service=="Agent civile") ? "selected" : "" }} >Agent civile</option>
						<option value="Sécurité publique" selected = {{ ($assure->Service=="Sécurité publique") ? "selected" : "" }}>Sécurité publique</option>
						<option value="Police judiciaire (PJ)" selected = {{ ($assure->Service=="Police judiciaire (PJ)") ? "selected" : "" }}>Police judiciaire (PJ)</option>
						<option value="Brigade mobile de la police judiciaire (BMPJ)"  selected = {{ ($assure->Service=="Brigade mobile de la police judiciaire (BMPJ)") ? "selected" : "" }}>Brigade mobile de la police judiciaire (BMPJ)</option>
						<option value="Service protection et sécurité des personnalités (SPS)" selected =  {{ ($assure->Service=="Service protection et sécurité des personnalités (SPS)")? "selected" : "" }}>Service protection et sécurité des personnalités (SPS)</option>
						<option value="Unité aérienne de la sûreté nationale"  {{ ($assure->Service=="Unité aérienne de la sûreté nationale") ? "selected" : "" }}>Unité aérienne de la sûreté nationale</option>
						<option value="Unités républicaines de sécurité (URS)"  {{ ($assure->Service=="Unités républicaines de sécurité (URS)") ? "selected" : "" }}>Unités républicaines de sécurité (URS)</option>
						<option value="Police scientifique et technique"  {{ ($assure->Service=="Police scientifique et technique") ? "selected" : "" }}>Police scientifique et technique</option>
						<option value="Police aux frontières et de l'immigration (PAF)"  {{ ($assure->Service=="Police aux frontières et de l'immigration (PAF)")? "selected" : "" }}>	Police aux frontières et de l'immigration (PAF)</option>
						<option value="Brigade de recherche et d'intervention (BRI)"  {{ ($assure->Service=="Brigade de recherche et d'intervention (BRI)")? "selected" : "" }}>Brigade de recherche et d'intervention (BRI)	</option>
						<option value="Groupe des opérations spéciales de la police (GOSP)"  {{ ($assure->Service=="Groupe des opérations spéciales de la police (GOSP)")? "selected" : "" }}>Groupe des opérations spéciales de la police (GOSP)</option>
					</select>
					@else
					<select name="service" id="service" class="col-xs-12 col-sm-12">
						<option value="0">Sélectionner...</option>
						<option value="Agent civile">Agent civile</option>
						<option value="Sécurité publique">Sécurité publique</option>
						<option value="Police judiciaire (PJ)">Police judiciaire (PJ)</option>
						<option value=" Brigade mobile de la police judiciaire (BMPJ)">Brigade mobile de la police judiciaire (BMPJ)</option>
						<option value="Service protection et sécurité des personnalités (SPS)">Service protection et sécurité des personnalités (SPS)</option>
						<option value="L'Unité aérienne de la sûreté nationale">L'Unité aérienne de la sûreté nationale</option>
						<option value="Unités républicaines de sécurité (URS)">Unités républicaines de sécurité (URS)</option>
						<option value="Police scientifique et technique">Police scientifique et technique</option>
						<option value="Police aux frontières et de l'immigration (PAF)">	Police aux frontières et de l'immigration (PAF)</option>
						<option value="La Brigade de recherche et d'intervention (BRI)">La Brigade de recherche et d'intervention (BRI)	</option>
						<option value="Le Groupe des opérations spéciales de la police (GOSP)">Le Groupe des opérations spéciales de la police (GOSP)</option>
					</select>
					@endif 
				</div>
			</div>
		</div>
	</div>
	<div class="space-12"></div>	
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label " for="grade"><strong>Grade :</strong></label>
				<div class="col-sm-9">
				@if(isset($assure) && !empty($assure))
					<select id="grade" name="grade" class=" col-xs-12 col-sm-6"/>
					<option value="">Sélectionner...</option>
					{{-- @if ( isset($assure->Grade)) --}}
						@foreach ($grades as $key=>$grade)
						<option value="{{ $grade->id }}" {{ $assure->Grade === $grade->id   ? "selected":"" }} >{{ $grade->nom }}</option>
						@endforeach
					{{-- @endif --}}
					</select>
				@else
					<select id="grade" name="grade" class="col-xs-12 col-sm-6"/>
					@foreach ($grades as $key=>$grade)
						<option value="{{ $grade->id }}" >{{ $grade->nom }}</option>
					@endforeach
					</select>
				@endif	
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-3" for="matf">
					<strong>Matricule :</strong>
				</label>
				<div class="col-sm-9">
				<div class="clearfix">
				@if(isset($assure) && !empty($assure))
					<input type="text" id="matf" name="matf" class="col-xs-12 col-sm-6" value="{{ $assure->matricule }}" maxlength="5" />
				@else
					<input type="text" id="matf" name="matf" class="col-xs-12 col-sm-6"  placeholder="saisir le matricule..." maxlength="5" />
				@endif	
				</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-3" for="NMGSN"><strong>NMGSN :</strong>	</label>
				<div class="col-sm-9">
					<div class="clearfix">
					@if(isset($assure) && !empty($assure))
						<input type="text" id="NMGSN" name="NMGSN" class="col-xs-12 col-sm-12" value="{{ $assure->NMGSN }}" maxlength =12 minlength =12/>
					@else
						<input type="text" id="NMGSN" name="NMGSN" class="col-xs-12 col-sm-12"  placeholder="saisir le numéro mutuelle..." maxlength =12 minlength =12/>
					@endif	
					</div>
				</div>
			</div>
			<br>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-3" for="nss2"><strong>NSS :</strong>	</label>
				<div class="col-sm-9">
				<div class="clearfix">
				@if(isset($assure) && !empty($assure))
				<input type="text" id="nss" name="nss" class="col-xs-12 col-sm-12"  value="{{ $assure->NSS }}" maxlength =12 minlength =12/>{{-- pattern="^\[0-9]{2}+' '+\[0-9]{4}+' '+\[0-9]{4}+' '+\[0-9]{2}$" --}}
				@else
				<input type="text" id="nss" name="nss" class="col-xs-12 col-sm-12" placeholder="XXXXXXXXXXXX"  maxlength =12 minlength =12/>
				@endif	
				</div>
				</div>
			</div>
			<br><br>
		</div>	
	</div>
</div>

