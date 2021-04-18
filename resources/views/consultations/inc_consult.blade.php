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
@if(isset($consultation->examensCliniques) )
<div class="row">
	<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
		<span style="font-size:16px;"><strong>Examens Clinique</strong></span>
	</div>
</div>
<div class="row">
	<ul class="list-unstyled spaced">
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Taille :</strong><span class="badge badge-pill badge-primary"> {{ $consultation->examensCliniques->taille  }}</span>(m)</li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Poids :</strong><span class="badge badge-pill badge-danger"> {{ $consultation->examensCliniques->poids  }}</span>(kg)</li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>IMC :</strong><span class="badge badge-pill badge-danger"> {{ $consultation->examensCliniques->IMC  }}</span></li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Températeur :</strong>{{ $consultation->examensCliniques->temp  }}&nbsp;&deg;C</li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Autre :</strong>{{ $consultation->examensCliniques->autre  }}&nbsp;</li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Etat Géneral du patient :</strong><span>{{ $consultation->examensCliniques->Etat  }}</span></li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Peau et phanéres  :</strong><span>{{ $consultation->examensCliniques->peaupha  }}</span></li>
		{{-- 	@foreach($consultation->examensCliniques->examsAppareil as $examAppareil)
			@if(null !== $examAppareil )
			{{ $examAppareil}}
			@endif
		@endforeach --}}
	</ul>
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