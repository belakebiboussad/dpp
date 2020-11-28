<div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title"><i class="fa fa-user" aria-hidden="true"></i><strong>Patient :</strong></h4>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<label class="inline">
					<span class="blue"><strong>Nom :</strong></span>
					<span class="lbl" id="nom"> {{ $patient->Nom }}</span>
			</label>&nbsp;&nbsp;&nbsp;
			<label class="inline">
				<span class="blue"><strong>Prénom :</strong></span><span class="lbl"  id="prenom"> {{ $patient->Prenom }}</span>
			</label>&nbsp;&nbsp;&nbsp;
			<label class="inline">
				<span class="blue"><i class = "fa fa-transgender" aria-hidden="true"></i><strong>&nbsp;Sexe:</strong></span>
				<span class="lbl"> {{ $patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
			</label>&nbsp;&nbsp;&nbsp;
			<label class="inline">
				<span class="blue"><strong>Âge:</strong></span>
				<span class="badge badge-{{ $patient->getAge() < 18 ? 'danger':'success' }}">{{ $patient->getAge() }}</span>
			</label>&nbsp;&nbsp;&nbsp;
			<label class="inline">
						<span class="blue"><span class="glyphicon glyphicon-map-marker"></span><strong> Né(e) à :</strong></span>
						<span class="lbl">{{ $patient->lieuNaissance->nom_commune }}</span>
					</label>&nbsp;&nbsp;&nbsp;
					<label class="inline"> 	
						<span class="blue"><i class="fa fa-phone"></i>&nbsp;<strong>Mobile :</strong></span><span class="lbl">{{ $patient->tele_mobile1 }}
						</span>
					</label>&nbsp;&nbsp;&nbsp;
					<label class="inline"> 	
						<span class="blue"><span class="glyphicon glyphicon-home"></span>&nbsp;<strong>Adresse :</strong></span>
						<span class="lbl">{{ $patient->commune->nom_commune }},{{ $patient->wilaya->nom_wilaya }}</span>
					</label>&nbsp;&nbsp;&nbsp;
					<label class="inline"> <span class="blue">&nbsp;<strong>NSS :</strong></span><span class="lbl">{{ $patient->NSS }}</span></label>	
						&nbsp;&nbsp;&nbsp;
					<label class="inline"> 	
						<span class="blue">&nbsp;<strong>Type :</strong></span>
						<span class="lbl badge badge-info">
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