<div id ="assurePart">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="header smaller lighter blue">
				<strong>Information L'Assuré(e)</strong>
			</h3>
		</div>	
	</div>{{-- row --}}
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="nomf">
				<strong>Nom :</strong> 
				</label>
			<div class="col-sm-9">
				@if(isset($assure) && !empty($assure))
					<input type="text" id="nomf" name="nomf"  value="{{ $assure->Nom }}" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
				@else
					<input type="text" id="nomf" name="nomf"  value="" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
				@endif	
			</div>
			<br>
			</div>
			<br>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="prenomf">
					<strong>Prénom :</strong>
				</label>
				<div class="col-sm-9">
					@if(isset($assure) && !empty($assure))
						<input type="text" id="prenomf" name="prenomf"  value="{{ $assure->Prenom }}" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
					@else
						<input type="text" id="prenomf" name="prenomf"  value="" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
					@endif
				</div>
				<br>
			</div>
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="datenaissancef">
					<strong class="text-nowrap">Né(e) le :</strong>
				</label>
				<div class="col-sm-9">
					@if(isset($assure) && !empty($assure))
						<input class="col-xs-12 col-sm-12 date-picker" id="datenaissancef" name="datenaissancef" type="text" placeholder="Date de naissance..." data-date-format="yyyy-mm-dd" value="{{ $assure->Date_Naissance }}" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
					@else	
						<input class="col-xs-12 col-sm-12 date-picker" id="datenaissancef" name="datenaissancef" type="text" placeholder="Date de naissance..." data-date-format="yyyy-mm-dd" value="" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />

					@endif
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="lieunaissancef">
					<span class="text-nowrap"><strong>Lieu de naiss :</strong></span>
				</label>
				<div class="col-sm-9">
				 	<input type="hidden" name="idlieunaissancef" id="idlieunaissancef" value="{{ ($patient->Type !="Autre") ? $assure->lieunaissance : '' }}  ">
					@if(isset($assure) && !empty($assure))
					<input type="text" id="lieunaissancef" name=""class="col-xs-12 col-sm-12" value="{{ ($patient->Type !="Autre") ? $assure->lieuNaissance->nom_commune : '' }}" autocomplete= "off" />
					@else	
					<input type="text" id="lieunaissancef" name=""class="col-xs-12 col-sm-12" value="" autocomplete= "off" />
					@endif
				</div>
				<br>
			</div>
			<br>
		</div>
	</div>	{{-- row --}}
	<div class="row">
		<div class="col-sm-6">
       			 <div class="form-group">
			  	<label class="col-sm-3 control-label no-padding-right" for="sexe"><Strong>Sexe: </Strong></label>
          			<div class="col-sm-9">
			               <div class="radio">
			               @if(isset($assure) && !empty($assure))
			                <label><input name="sexef" value="M" type="radio" class="ace" checked=  {{ $assure->Sexe == "M" ? "Checked" : ""}}/>
			                    	<span class="lbl"> Masculin</span>
			                </label>
			               <label><input name="sexef" value="F" type="radio" class="ace" checked= {{  $assure->Sexe == "F" ? "checked" : "" }} />
			                      <span class="lbl"> Féminin</span>
			              </label>
			               @else   
			                <label><input name="sexef" value="M" type="radio" class="ace" /><span class="lbl" Checked> Masculin</span></label>
			                <label><input name="sexef" value="F" type="radio" class="ace" /> <span class="lbl"> Féminin</span></label>      
			               @endif
			                </div>
                    		</div>
             		</div>
         	</div>
         	<div class="col-sm-6">
       			 <div class="form-group">
			  	<label class="col-sm-3 control-label no-padding-right" for="adressef"><Strong>Adresse: </Strong></label>
          			<div class="col-sm-9">
          			@if(isset($assure) && !empty($assure))
          				<input type="text" id="adressef" name="adressef"  class="col-xs-12 col-sm-12" value= "{{ $assure->adresse }}" />
          			  @else 
          			  <input type="text" id="adressef" name="adressef"  placeholder="Adresse..."  class="col-xs-12 col-sm-12" />  
          			  @endif
          			</div>
          		</div>
          	</div>
         </div>
         <div class="row">
		<div class="col-sm-6">
	       		<div class="form-group">
	   			<label class="col-sm-3 control-label text-nowrap" for="gsf"><strong>Groupe sanguin :</strong></label>
				<div class="col-sm-2">
				@if(isset($assure) && !empty($assure))
					<select class="form-control" id="grp_sang" name="gsf">
						<option value="" {{ ($assure->grp_sang=="")? "selected" : "" }} >------</option>
						<option value="A-"  {{ ($assure->grp_sang=="A-")? "selected" : "" }} >A-</option>
						<option value="A+"  {{ ($assure->grp_sang=="A+")? "selected" : "" }} >A+</option>
						<option value="B-" {{ ($assure->grp_sang=="B-")? "selected" : "" }} >B-</option>
						<option value="B+" {{ ($assure->grp_sang=="B+")? "selected" : "" }} >B+</option>
						<option value="O-" {{ ($assure->grp_sang=="O-")? "selected" : "" }} >O-</option>
						<option value="O+" {{ ($assure->grp_sang=="O+")? "selected" : "" }} >O+</option>
						<option value="AB-" {{ ($assure->grp_sang=="AB-")? "selected" : "" }} >AB-</option>
						<option value="AB+" {{ ($assure->grp_sang=="AB+")? "selected" : "" }} >AB+</option>
					</select>
				@else 
					<select class="form-control" id="gsf" name="gsf">
						<option value="" >------</option>
						<option value="A-" >A-</option>
						<option value="A+">A+</option>
						<option value="B-" >B-</option>
						<option value="B+" >B+</option>
						<option value="O-">O-</option>
						<option value="O+">O+</option>
						<option value="AB-">AB-</option>
						<option value="AB+"  >AB+</option>
					</select>
				@endif
				</div>
	   	 	 </div>
		</div>
	</div>
         <div class="row">
       		<div class="col-sm-6" id="statut">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="etatf"><strong>Etat :</strong></label>
				<div class="col-sm-9">
				<div class="radio">
				 @if(isset($assure) && !empty($assure))
				<label><input name ="etat" value="En_exercice"  type="radio"  class="ace"  {{ $assure->Etat  === 'En_exercice'  ?  'Checked' : ''  }}  />
					<span class="lbl"> En exercice</span>
				</label>
				<label><input name ="etat" value="Retraite"  type="radio"  class="ace"  {{ $assure->Etat  === 'Retraite'  ?  'Checked'  :  ''  }}  />
					<span class="lbl"> Retraité</span>
				</label>
				<label><input  name="etat"  value="Invalide"  type="radio"  class="ace"  {{ $assure->Etat  ===  'Invalide' ? 'Checked' : ''  }} />
						<span class="lbl"> Invalide</span>
				</label>
				<label><input name="etat" value="Mise_en_disponibilite"  type="radio" class="ace"  {{ $assure->Etat  === 'Mise_en_disponibilite' ? 'Checked' : '' }} />
						<span class="lbl"> Mise en disponibilité</span>
				</label>
				@else
				<label hidden><input name="etat" value="" type="radio" class="ace"/><span class="lbl"> Autre</span></label>
				<label><input name="etat" value="En exercice" type="radio" class="ace" /><span class="lbl" Checked> En exercice</span></label>
				<label><input name="etat" value="Retraite" type="radio" class="ace" /><span class="lbl"> Retraité</span></label>
				<label><input name="etat" value="Invalide" type="radio" class="ace" /><span class="lbl"> Invalide</span></label>
				<label><input name="etat" value="Mise en disponibilite" type="radio" class="ace" /><span class="lbl"> Mise en disponibilité</span>
				</label>
				 @endif
				</div>
				</div>
			</div>
		</div>
	</div>
	<div class="space-12"></div>		
	<div class="space-12"></div>	
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label " for="grade"><strong>Grade :</strong></label>
				<div class="col-sm-9">
				@if(isset($assure) && !empty($assure))
					<select id="grade" name="grade" class="col-xs-12 col-sm-6"/>
					@if ( isset($assure->Grade))
						@foreach ($grades as $key=>$grade)
						<option value="{{ $grade->id }}" {{ $assure->Grade === $grade->id   ? "selected":"" }} >{{ $grade->nom }}</option>
						@endforeach
					@endif
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
	<div class="space-12"></div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-3" for="NMGSN"><strong>NMGSN :</strong>	</label>
				<div class="col-sm-9">
					<div class="clearfix">
					@if(isset($assure) && !empty($assure))
						<input type="text" id="NMGSN" name="NMGSN" class="col-xs-12 col-sm-12" value="{{ $assure->NMGSN }}" />
					@else
						<input type="text" id="NMGSN" name="NMGSN" class="col-xs-12 col-sm-12"  placeholder="saisir le numéro mutuelle..." />
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
</div><!-- assurePart -->