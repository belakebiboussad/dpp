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
						<input type="text" id="nomf" name="nomf"  value="{{ $assure->Nom }}" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
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
						<input type="text" id="prenomf" name="prenomf"  value="{{ $assure->Prenom }}" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
					</div>
					<br>
				</div>
				<br>
			</div>
		</div>{{-- row --}}
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-3 control-label" for="datenaissancef">
						<strong class="text-nowrap">Né(e) le :</strong>
					</label>
					<div class="col-sm-9">
						<input class="col-xs-12 col-sm-12 date-picker" id="datenaissancef" name="datenaissancef" type="text" placeholder="Date de naissance..." data-date-format="yyyy-mm-dd" value="{{ $assure->Date_Naissance }}" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
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
						<input type="text" id="lieunaissancef" name=""class="col-xs-12 col-sm-12" value="{{ ($patient->Type !="Autre") ? $assure->lieuNaissance->nom_commune : '' }}" autocomplete= "off" />
					</div>
					<br>
				</div>
				<br>
			</div>
		</div>	{{-- row --}}
		<div class="row">
			<div class="col-sm-6">
        <div class="form-group">
			  	<label class="col-sm-3 control-label no-padding-right" for="sexe">
			    	<Strong>Sexe:</Strong>
			    </label>
          <div class="col-sm-9">
			                         <div class="radio">
			                         <label>
			                          <input name="sexef" value="M" type="radio" class="ace" {{ $assure->Sexe === "M" ? "Checked" : "" }}/>
			                    		<span class="lbl"> Masculin</span>
			                          </label>
			                         <label>
			                         <input name="sexef" value="F" type="radio" class="ace" {{  $assure->Sexe=== "F" ? "checked" : "" }} />
			                         <span class="lbl"> Féminin</span>
			                         </label>
			                         </div>
                    				</div>
             			</div>
         				</div>
         				<div class="col-sm-6" id="statut">
				<div class="form-group">
					<label class="col-sm-3 control-label" for="etatf">
					<strong>Etat :</strong>
					</label>
					<div class="col-sm-9">
					<div class="radio">
					<label hidden>
					<input name="etat" value="" type="radio" class="ace" @if(!isset($assure->Etat)  && empty($assure->Etat)) Checked @endif />
						<span class="lbl"> Autre</span>
					</label>
					<label>
						<input name="etat" value="En exercice" type="radio" class="ace" {{ $assure->Etat ==="En exercice" ? "Checked":"" }} />
						<span class="lbl"> En exercice</span>
					</label>
					<label>
						<input name="etat" value="Retraite" type="radio" class="ace" {{ $assure->Etat ==="Retraite" ? "Checked":"" }} />
						<span class="lbl"> Retraité</span>
					</label>
					<label>
						<input name="etat" value="Invalide" type="radio" class="ace" {{ $assure->Etat ==="Invalide" ? "Checked":"" }} />
							<span class="lbl"> Invalide</span>
					</label>
					<label>
						<input name="etat" value="Mise en disponibilite" type="radio" class="ace"  {{ $assure->Etat ==="Mise en disponibilite" ? "Checked":"" }} />
							<span class="lbl"> Mise en disponibilité</span>
					</label>
					</div>
					</div>
				</div>
			</div>	
		</div>{{-- row --}}
		<div class="space-12"></div>		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-3 control-label " for="grade">
						<strong>Grade :</strong>
					</label>
					<div class="col-sm-9">
					<select id="grade" name="grade" class="col-xs-12 col-sm-6"/>
					@if ((isset($assure))&& isset($assure->Grade))
						@foreach ($grades as $key=>$grade)
						<option value="{{ $grade->id }}" {{ $assure->Grade === $grade->id   ? "selected":"" }} >{{ $grade->nom }}</option>
						@endforeach
					@endif
					</select>
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
						<input type="text" id="matf" name="matf" class="col-xs-12 col-sm-6" value="{{ $assure->Matricule }}"  placeholder="saisir le matricule..." maxlength="5" />
					</div>
					</div>
				</div>
			</div>
		</div>	{{-- row --}}
		<div class="space-12"></div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3" for="NMGSN">
						<strong>NMGSN :</strong>
					</label>
					<div class="col-sm-9">
						<div class="clearfix">
							<input type="text" id="NMGSN" name="NMGSN" class="col-xs-12 col-sm-12" value="{{ $assure->NMGSN }}" />
						</div>
					</div>
				</div>
				<br>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3" for="nss2">
						<strong>NSS :</strong>
					</label>
					<div class="col-sm-9">
					<div class="clearfix">
					<input type="text" id="nss" name="nss" class="col-xs-12 col-sm-12" placeholder="XXXXXXXXXXXX" 
					value="{{ $assure->NSS }}" maxlength =12 minlength =12/>{{-- pattern="^\[0-9]{2}+' '+\[0-9]{4}+' '+\[0-9]{4}+' '+\[0-9]{2}$" --}}
					</div>
					</div>
				</div>
				<br><br>
			</div>	
		</div>{{-- row --}}	
	</div>{{-- assurePart --}}
