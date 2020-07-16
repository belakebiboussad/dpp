<div class="page-header" style="margin-top:5px;">
  <h4>Détails de la Consulation :</h4>
</div>
<div class="row">
	<div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right">
				<strong><span style="font-size:18px;">Interogatoire</span></strong>
	</div>
</div>
<div class="row">
	<ul class="list-unstyled spaced">
		<li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Date de la Consultation : <span class="badge badge-pill badge-success">{{ $consultation->Date_Consultation }}</span></span></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:16px;">Motif de la Consultation : <blockquote>{{ $consultation->Motif_Consultation }}</blockquote></span></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Histoire de la maladie : <blockquote>{{ $consultation->histoire_maladie }} </blockquote></span></li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Diagnostic : {{ $consultation->Diagnostic }}</li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Résumé :  <blockquote>{{ $consultation->Resume_OBS }} </blockquote></span> </li>
	</ul>
</div>
@if(isset($consultation->examensCliniques) )
<div class="row">
		<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
			<strong><span style="font-size:18px;">Examens Clinique</span></strong>
		</div>
</div>
<div class="row">
	<ul class="list-unstyled spaced">
		<li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Taille : <span class="badge badge-pill badge-primary"> {{ $consultation->examensCliniques->taille  }}</span></span>&nbsp;(m)</li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Poids : <span class="badge badge-pill badge-danger"> {{ $consultation->examensCliniques->poids  }}</span></span>&nbsp;(kg)</li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">IMC : <span class="badge badge-pill badge-danger"> {{ $consultation->examensCliniques->IMC  }}</span></span>&nbsp;</li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Températeur : {{ $consultation->examensCliniques->temp  }}</span>&nbsp;&deg;C</li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Autre : {{ $consultation->examensCliniques->autre  }}</span>&nbsp;</li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Etat Géneral du patient  :  <blockquote>{{ $consultation->examensCliniques->Etat  }}</blockquote></span>&nbsp;</li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Peau et phanéres  : {{ $consultation->examensCliniques->peaupha  }}</span>&nbsp;</li>
	</ul>
</div>
@endif
@if(isset($consultation->demandeexmbio))
<div class="row">
		<div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right">
			<strong><span style="font-size:18px;">Demande Examens Biologique</span></strong>
		</div>
</div>
<div class="row">
	<div class="col-xs-11 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demande Examens Biologique</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
									<th class="center"><strong>#</strong></th>
									<th class="center"><strong>Date</strong></th>
									<th class="center"><strong>Etat</strong></th>
									<th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="center"></td>
								<td>{{ $consultation->Date_Consultation }}</td>
								<td>
								@if($consultation->demandeexmbio->etat == "E")
								  <span class="badge badge-danger"> En Attente</span>
								@elseif($consultation->demandeexmbio->etat == "V")
								 	<span class="badge badge-success">Validé</span>       
								@else
								  <span class="badge badge-success">Rejeté</span>   
								@endif
								</td>
								<td class="center">
								  <a href="{{ route('demandeexb.show', $consultation->demandeexmbio->id_demandeexb) }}">
									    <i class="fa fa-eye"></i>
									</a>
									<a href="/showdemandeexb/{{ $consultation->demandeexmbio->id }}" target="_blank" class="btn btn-xs">
					       			 <i class="ace-icon fa fa-print"></i>&nbsp;
     							 	</a>
								</td>
						</tbody>
				  </table>
				</div>	
			</div>
		</div>
	</div>
</div>
@endif
@if(isset($consultation->demandeExamImagegerie))
<div class="space-12"></div>	
<div class="row">
	<div class="col-xs-11 label label-lg label-danger arrowed-in arrowed-right">
			<strong><span style="font-size:18px;">Demande Examens Imagerie</span></strong>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-11 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-pink" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demande Examens Imagerie</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
									<th class="center"><strong>#</strong></th>
									<th class="center"><strong>Date</strong></th>
									<th class="center"><strong>Etat</strong></th>
									<th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
						<tr>
		            <td class="center"></td>
		            <td>{{ $consultation->Date_Consultation }}</td>
		            <td>
		              @if($consultation->demandeExamImagegerie->etat == "E")
		                  <span class="badge badge-warning"> En Attente</span>
		              @elseif($consultation->demandeExamImagegerie->etat == "V")
		                Validé
		              @else
		               <span class="badge badge-danger">Rejeté</span>
		                
		              @endif
		            </td>
		            <td class="center">
			            <a href="{{ route('demandeexr.show', $consultation->demandeExamImagegerie->id) }}">
			              <i class="fa fa-eye"></i>
			            </a>
			          	<a href="#" target="_blank" class="btn btn-xs">
					       			 <i class="ace-icon fa fa-print"></i>&nbsp;
     							 	</a>
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

