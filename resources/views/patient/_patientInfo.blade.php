<div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title"><i class="fa fa-user" aria-hidden="true"></i><strong>  Patient :</strong></h4>
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
				<span class="lbl">&nbsp;Sexe: </span>
				<span class="blue"><strong>
          @if($patient->Sexe == "M")
          <i class="fa fa-mars" aria-hidden="true"></i>
          @else
          <i class="fa fa-venus" aria-hidden="true"></i>
          @endif
        </strong></span>
			</label>&nbsp;&nbsp;&nbsp;
			<label class="inline">
				<span class="lbl">Âge:</span>
				<span>
				<span class="badge badge-{{ $patient->age < 18 ? 'danger':'success' }} blue">{{ $patient->age }}</span>(Ans)
			</label>&nbsp;&nbsp;&nbsp;
			@isset( $patient->tele_mobile1)
      <label class="inline"> 	
				<span class="lbl"><i class="fa fa-phone"></i>&nbsp;Mobile :</span>
				<span class="blue">{{ $patient->tele_mobile1 }}</span>
		  </label>&nbsp;&nbsp;&nbsp;
			@endisset
      @isset( $patient->commune_res)
			<label class="inline hidden-xs"> 	
			<span class="lbl"><span class="glyphicon glyphicon-home"></span>&nbsp;Adresse :</span>
			<span class="blue">{{ $patient->commune->nom_commune }},{{ $patient->wilaya->nom }}</span>
			</label>&nbsp;&nbsp;&nbsp;
			@endisset
			@isset( $patient->NSS)
      <label class="inline hidden-xs"> <span class="lbl">&nbsp;Numéro SS :</span>
			<span class="blue">{{ $patient->NSS }}</span></label>	&nbsp;&nbsp;&nbsp;
			@endisset
      <label class="inline hidden-xs"> 	
			<span class="lbl">&nbsp;<strong>Type :</strong></span>
				<span class="badge badge-info">
					@switch($patient->Type)
	             @case(0)
	                Assuré
	                @break
              @case(1)
	             	  Conjoint(e)
	                @break
              @case(2)
	             	   Père
	                @break
              @case(3)
	             	  Mère
	                @break
	            @case(4)
	             	  Enfant
	                @break 
               @case(5)
                 Dérogation 
                 @break      
              @case(6)
	                Autre 
	                @break       
            @endswitch 
           	</span>		
					</label>
				</div>
			</div>
		</div>