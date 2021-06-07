<script type="text/javascript">
$('document').ready(function(){
	$("#accordion" ).accordion({
				collapsible: true ,
				heightStyle: "content",
				animate: 250,
				header: ".accordion-header"
	 }).sortable({
				axis: "y",
				handle: ".accordion-header",
				stop: function( event, ui ) {
					ui.item.children( ".accordion-header" ).triggerHandler( "focusout" );
				}
		});
});
</script>
<div class="page-header" style="margin-top:-5px;"> <h5><strong>Détails de la Consulation :</strong></h5></div>
<div class="row">
	<div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right"><strong><span style="font-size:16px;">Interogatoire</span></strong></div>
</div>
<div class="row">
	<ul class="list-unstyled spaced">
		<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Date de la Consultation :</strong><span class="badge badge-pill badge-success">{{ $consultation->Date_Consultation }}</span></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Motif de la Consultation :</strong><span>{{ $consultation->motif }}</span></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Histoire de la maladie :</strong><span>{{ $consultation->histoire_maladie }}
		</span></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Diagnostic :</strong><span>{{ $consultation->Diagnostic }}</span></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Résumé :</strong> </span>{{ $consultation->Resume_OBS }}</li>
	</ul>
</div>
@isset($consultation->demandeHospitalisation)
<div class="row dh">
	<div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right"><strong><span style="font-size:16px;">Demande d'Hospitalisation</span></strong>
	</div>
</div>
<div class="row dh">
	<div class="col-xs-11 widget-container-col">
		<div class="widget-box widget-color-blue">
			<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demande d'Hospitalisation</h5></div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<td>{{$consultation->demandeHospitalisation->modeAdmission}}</td>
							<td>{{$consultation->demandeHospitalisation->Specialite->nom}}</td>
							<td>{{$consultation->demandeHospitalisation->Service->nom}}</td>
							<td>{{ $consultation->demandeHospitalisation->etat }}</td>
							<td class="center">
								@if($consultation->demandeHospitalisation->etat =="en attente")
								<button type="button" class="btn btn-xs btn-danger" data-method="DELETE" data-confirm="Etes Vous Sur ?" onclick ="deleteDemandeHospi({{ $consultation->demandeHospitalisation->id }})"><i class="fa fa-trash-o fa-xs"></i></button>
								@endif
								</td>
					</table>
				</div>	
			</div>
		</div>
	</div>
</div>
@endisset
@if(isset($consultation->examensCliniques)  &&($consultation->examensCliniques->poids != 0))
<div class="row">
	<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
		<span style="font-size:16px;"><strong>Examens Clinique</strong></span>
	</div>
</div>
<div class="row">
	<ul class="list-unstyled spaced">
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Taille :</strong><span class="badge badge-pill badge-primary"> {{  $consultation->examensCliniques->taille  }}</span>(m)</li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Poids :</strong><span class="badge badge-pill badge-danger"> {{ $consultation->examensCliniques->poids  }}</span>(kg)</li>
		@if(isset($consultation->examensCliniques->IMC) )
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>IMC :</strong><span class="badge badge-pill badge-danger"> {{ $consultation->examensCliniques->IMC  }}</span></li>
		@endif
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Températeur :</strong>{{ $consultation->examensCliniques->temp  }}&nbsp;&deg;C</li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Autre :</strong>{{ $consultation->examensCliniques->autre  }}&nbsp;</li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Etat Géneral du patient :</strong><span>{{ $consultation->examensCliniques->Etat  }}</span></li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Peau et phanéres  :</strong><span>{{ $consultation->examensCliniques->peaupha  }}</span></li>
	</ul>
</div>
<div class="row">
		<div id="accordion" class="accordion-style2 ui-accordion ui-widget ui-helper-reset ui-sortable" role="tablist">
		<div class="group">
		@foreach($consultation->examensCliniques->examsAppareil as $examAppareil)
				@if(null !== $examAppareil )
				<h3 class="accordion-header ui-accordion-header ui-state-default ui-accordion-icons ui-sortable-handle ui-corner-all ui-state-hover" role="tab"  aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>{{ $examAppareil->Appareil->nom }}</h3>
				<div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom"  role="tabpanel" style="display: none;" aria-hidden="true">
				<p>{{ $examAppareil->description}}</p>
		</div>	
		@endif
	@endforeach
</div>
	</div>
 <!-- fin -->
</div>
@endif
@if(isset($consultation->demandeexmbio))
<div class="row">
	<div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right"><strong><span style="font-size:16px;">Demande Examens Biologique</span></strong>
	</div>
</div>
<div class="row">
	<div class="col-xs-11 widget-container-col">
		<div class="widget-box widget-color-blue">
			<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demande Examens Biologique</h5></div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th class="center"><strong>Date</strong></th><th class="center"><strong>Etat</strong></th><th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $consultation->Date_Consultation }}</td>
								<td>
								@if($consultation->demandeexmbio->etat == "E")
									<span class="badge badge-warning"> En Attente</span>
								@elseif($consultation->demandeexmbio->etat == "V")
									<span class="badge badge-success">Validé</span>       
								@else
									<span class="badge badge-danger">Rejeté</span>   
								@endif
								</td>
								<td class="center">
									<a href="{{ route('demandeexb.show', $consultation->demandeexmbio->id) }}"><i class="fa fa-eye"></i></a>
									<a href="/showdemandeexb/{{ $consultation->demandeexmbio->id }}" target="_blank" class="btn btn-xs"> <i class="ace-icon fa fa-print"></i></a>
								</td>
						</tbody>
					</table>
				</div>	
			</div>
		</div>
	</div>
</div>
@endif
@if(isset($consultation->examensradiologiques))	
<div class="row">
	<div class="col-xs-11 label label-lg label-danger arrowed-in arrowed-right"><strong><span style="font-size:16px;">Demande Examens Imagerie</span></strong>
	</div>
</div>
<div class="row">
	<div class="col-xs-11 widget-container-col">
	<div class="widget-box widget-color-pink">
		<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demande Examens Imagerie</h5></div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th class="center"><strong>Date</strong></th><th class="center"><strong>Etat</strong></th><th class="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $consultation->Date_Consultation }}</td>
							<td>
								 @if($consultation->examensradiologiques->etat == "E")
											<span class="badge badge-warning"> En Attente</span>
								 @elseif($consultation->examensradiologiques->etat == "V")
											Validé
								@else
										 <span class="badge badge-danger">Rejeté</span>
								 @endif
							</td>
							<td class="center">
								<a href="{{ route('demandeexr.show', $consultation->examensradiologiques->id) }}"><i class="fa fa-eye"></i></a>
								<a href="/showdemandeexr/{{ $consultation->examensradiologiques->id }}" target="_blank" class="btn btn-xs"><i class="ace-icon fa fa-print"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>	
		</div>
		</div>
	</div>
</div>
@endif
@if(isset($consultation->ordonnances))
<div class="row">
	<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><strong><span style="font-size:16px;">Ordonnance</span></strong></div>
</div>
<div class="row">
	<div class="col-xs-11 widget-container-col">
		<div class="widget-box widget-color-blue">
			<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Ordonnance</h5></div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th class="center"><strong>Date</strong></th><th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $consultation->ordonnances->date }}</td>
								<td class="center">
									<a href="{{ route('ordonnace.show',$consultation->ordonnances->id) }}"><i class="fa fa-eye"></i></a>
									<a href="{{route("ordonnancePdf",$consultation->ordonnances->id)}}" target="_blank" class="btn btn-xs"><i class="fa fa-print"></i></a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>	
@endif
@if(isset($consultation->lettreOrintation))
<div class="row">
	<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><strong><span style="font-size:16px;">Lettre d'Orientation</span></strong></div>
</div>
<div class="row">
	<div class="col-xs-11 widget-container-col">
		<div class="widget-box widget-color-blue">
			<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Lettre</h5></div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th class="center"><strong>Date</strong></th>
								<th class="center"><strong>Spécilalité</strong></th>
								<th class="center"><strong>Médecin</strong></th>		
								<th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $consultation->Date_Consultation }}</td>
								<td>{{ $consultation->lettreOrintation->Specialite->nom }}</td>
								<td>{{ $consultation->lettreOrintation->Medecin->nom }} {{ $consultation->lettreOrintation->Medecin->prenom }}</td>
								<td class="center">
									<a href="#" class="green bigger-140 show-details-btn" title="Afficher Details" data-toggle="collapse"  data-target=".collapsed">
										<i class="ace-icon fa fa-eye-slash"></i><span class="sr-only">Details</span>&nbsp;
									</a><!-- <a href="" target="_blank" class="btn btn-xs"><i class="fa fa-print"></i></a> -->
				  				<button type="button" class="btn btn-xs btn-success" onclick="orLetterPrint('{{$consultation->patient->Nom}}','{{ $consultation->patient->Prenom}}','{{$consultation->patient->getAge() }}',		'{{$consultation->patient->IPP }}','{{$etablissement->tutelle }}','{{$etablissement->nom }}','{{$etablissement->adresse }}','{{$etablissement->tel }}','{{$etablissement->logo }}')"><i class="ace-icon fa fa-print"></i></button>
								</td>
							</tr>
							<tr class="collapse out budgets collapsed">
			      	  <td colspan="12">
				    			<div class="table-detail">
				     				<div class="row">
				     					<div class="col-xs-12 col-sm-12"><div class="space visible-xs"></div>
												<div class="profile-user-info profile-user-info-striped">
													<div class="profile-info-row">
														<div class="profile-info-name text-center"><strong>Motif:</strong></div>
														<div class="profile-info-value">{{ $consultation->lettreOrintation->motif }}</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
<div class="row"><canvas id="lettreorientation" height="1%"><img id='itfL'/></canvas></div>