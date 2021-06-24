<div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title"><i class="fa fa-user" aria-hidden="true"></i><strong>Patient :</strong></h4>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<label class="inline">
				<span class="lbl" id="nom"> Nom :</span><span class="blue">{{ $patient->Nom }}</span>
			</label>&nbsp;&nbsp;&nbsp;
			<label class="inline">
				<span class="lbl"  id="prenom">Prénom : </span>
				<span class="blue">{{ $patient->Prenom }}</span>
			</label>&nbsp;&nbsp;&nbsp;
			<label class="inline">
				<span class="lbl"><i class = "fa fa-transgender" aria-hidden="true"></i>&nbsp;Sexe: </span>
				<span class="blue"><strong>{{ $patient->Sexe == "M" ? "Masculin" : "Féminin" }}</strong></span>
			</label>&nbsp;&nbsp;&nbsp;
			<label class="inline">
				<span class="lbl">Âge:</span>
				<span>
				<span class="badge badge-{{ $patient->getAge() < 18 ? 'danger':'success' }} blue">
						{{ $patient->getAge() }}
				</span>
			</label>&nbsp;&nbsp;&nbsp;
			@if(isset( $patient->Lieu_Naissance))
			<label class="inline">
				<span class="lbl"><span class="glyphicon glyphicon-map-marker"></span>Né(e) à :</span>
				<span class="blue">{{ $patient->lieuNaissance->nom_commune }}</span>
			</label>&nbsp;&nbsp;&nbsp;
			@endif
			<label class="inline"> 	
				<span class="lbl"><i class="fa fa-phone"></i>&nbsp;Mobile :</span>
				<span class="blue">{{ $patient->tele_mobile1 }}</span>
		  </label>&nbsp;&nbsp;&nbsp;
			@if(isset( $patient->commune_res))
			<label class="inline hidden-xs"> 	
			<span class="lbl"><span class="glyphicon glyphicon-home"></span>&nbsp;Adresse :</span>
			<span class="blue">{{ $patient->commune->nom_commune }},{{ $patient->wilaya->nom }}</span>
			</label>&nbsp;&nbsp;&nbsp;
			@endif
			<label class="inline hidden-xs"> <span class="lbl">&nbsp;NSS :</span>
			<span class="blue">{{ $patient->NSS }}</span></label>	&nbsp;&nbsp;&nbsp;
			<label class="inline hidden-xs"> 	
			<span class="lbl">&nbsp;<strong>Type :</strong></span>
				<span class="bbadge badge-info">
					@switch($patient->Type)
	             @case(0)
	                Assuré
	                @break
              @case(1)
	             	  Conjoint(e)
	                @break
              @case(2)
	             	  Ascendant
	                @break
              @case(3)
	             	  Descendant
	                @break  
              @case(4)
	                Autre 
	                @break       
            @endswitch  
						</span>		
					</label>
				</div>
			</div>
		</div>