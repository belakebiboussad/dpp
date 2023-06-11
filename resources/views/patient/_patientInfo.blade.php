<div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title"><i class="fa fa-user" aria-hidden="true"></i>Patient </h4>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<label class="inline">
				<span class="lbl" id="nom">Nom :</span><span class="blue"> {{ $patient->Nom }}</span>
			</label>&nbsp;&nbsp;&nbsp;
			<label class="inline">
				<span class="lbl"  id="prenom">Prénom : </span><span class="blue">{{ $patient->Prenom }}</span>
			</label>&nbsp;&nbsp;&nbsp;
			<label class="inline">
				<span class="lbl">&nbsp;Sexe: </span>
				<span class="blue"><i class="fa fa-{{($patient->Sexe == 'M' ) ? 'mars':'venus'}}" aria-hidden="true"></i></span>
			</label>&nbsp;&nbsp;&nbsp;
			<label class="inline"><span class="lbl">Âge:</span>
				<span class="badge badge-{{ $patient->age < 18 ? 'danger':'success' }} blue">{{ $patient->age }}</span> (Ans)
			</label>&nbsp;&nbsp;&nbsp;
			@isset( $patient->mob)
      <label class="inline"> 	
				<span class="lbl"><i class="fa fa-phone"></i> Mobile :</span>
				<span class="blue">{{ $patient->mob }}</span></label>&nbsp;&nbsp;&nbsp;
		  @endisset
      @isset( $patient->commune_res)
			<label class="inline hidden-xs"> 	
			<span class="lbl"><span class="glyphicon glyphicon-home"></span>&nbsp;Adresse :</span>
			<span class="blue">{{ $patient->commune->name }},{{ $patient->wilaya->nom }}</span>
			</label>&nbsp;&nbsp;&nbsp;
			@endisset
			@isset( $patient->NSS)
      <label class="inline hidden-xs"> <span class="lbl">Numéro SS :</span>
			<span class="blue"> {{ $patient->NSS }}</span></label>&nbsp;&nbsp;&nbsp;
			@endisset
      <label class="inline hidden-xs"> 	
			<span class="lbl">Type :</span>
				<span class="badge badge-info"> {{ $patient->Type->nom }}</span>		
					</label>
				</div>
			</div>
		</div>