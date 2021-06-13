@extends('app')
@section('main-content')
<?php 	$patient = $visite->hospitalisation->patient; 	$demande = $visite->examensradiologiques;  ?> 
<div class="page-header" width="100%">
	<div class="row"><div class="col-sm-12" style="margin-top: -2%;">@include('patient._patientInfo')</div></div>
</div>
<div class="row">
	<h4>Détails de la visite :</h4>
	<a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
	</div>
	<div class="row">
  	<div class="col-sm-6">
  		<label for="" class="control-label no-padding-right"><b>Medecin :</b></label><span>{{ $visite->medecin->nom }} {{ $visite->medecin->prenom }}</span>
  	</div>
  	<div class="col-sm-6">
  			<label for="" class="control-label no-padding-right"><b>Date :</b></label><span>{{ $visite->date }}</span>
  	</div>	
  </div>
  <div class="space-12"></div>
  <div class="row">
	<div class="tabbable"  class="user-profile">
    <ul class="nav nav-tabs padding-18">
      @if($visite->actes->count() > 0)
      <li class="in active"><a data-toggle="tab" href="#actes">Actes</a> </li>
      @endif
      @if($visite->traitements->count() > 0)
      <li><a data-toggle="tab" href="#traitement">Traitement</a> </li>
      @endif
      @if(isset($visite->demandeexmbio))
      <li><a data-toggle="tab" href="#examsBio">Examens Biologique</a> </li>
      @endif
      @if(isset($visite->examensradiologiques))
        <li ><a data-toggle="tab" href="#examImg">Examens Imagerie</a></li>
      @endif
    </ul>
    <div class="tab-content no-border padding-24">
      @if($visite->actes->count() > 0)
      <div id="actes" class="tab-pane  active">
      	<div class="col-xs-11 widget-container-col">
			<div class="widget-box widget-color-green">
				<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Actes</h5></div>
				<div class="widget-body">
					<div class="widget-main no-padding">
						<table class="table table-striped table-bordered table-hover">
							<thead class="thin-border-bottom">
								<tr>
									<th class="center"><strong>Nom</strong></th>
									<th class="center"><strong>Type</strong></th>
									<th class="center"><strong>Description</strong></th>
									<th class="center"><strong>Periodes</strong></th>
									<th class="center"><strong>Durée</strong></th>
									<th class="center"><em class="fa fa-cog"></em></th>
								</tr>
							</thead>
							<tbody>
							@foreach($visite->actes as $acte)
								<tr>
									<td>{{ $acte->nom }}</td>
									<td>{{ $acte->type }}</td>
									<td>{{ $acte->description }}</td>
									<td>
									@foreach ($acte->periodes as $periode)
									     {{ $periode }}
									     @if (!($loop->last))  ,  @endif
									@endforeach		
									</td>
									<td>{{ $acte->duree }}</td>
									<td></td>
								</tr>
							@endforeach
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>		
      </div>
      @endif
      <div id="traitement" class="tab-pane">
       <div class="col-xs-11 widget-container-col">
		<div class="widget-box widget-color-info">
			<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Traitements</h5></div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th class="center"><strong>Nom</strong></th>
								<th class="center"><strong>Posologie</strong></th>
								<th class="center"><strong>Periodes</strong></th>
								<th class="center"><strong>Duree</strong></th>
								<th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
							@foreach($visite->traitements as $trait)
							<tr>
								<td>{{ $trait->medicament->nom }}</td>
								<td>
									{{ $trait->posologie }}</td>
								<td>
									@foreach ($trait->periodes as $periode)
								     		{{ $periode }}
								     		@if (!($loop->last))  ,  @endif
									@endforeach
								</td>
								<td>{{ $trait->duree }}</td>
								<td></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>	{{-- widget-box --}}
	</div>
      </div> {{-- trait --}}
      @if(isset($visite->demandeexmbio))
      <div id="examsBio" class="tab-pane">
       <div class="col-xs-11 widget-container-col">
		<div class="widget-box widget-color-info">
			<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Examens Biologiques</h5></div>
			<div class="widget-body">
				<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th class="center">#</th>
							<th class="center"><strong>Date</strong></th>
							<th class="center"><strong>Nom</strong></th>
							<th><strong>Etat</strong></th>
							<th class="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					@foreach($visite->demandeexmbio->examensbios as $index => $exm)
					<tr>
					<td class="center">{{ $index + 1 }}</td>
					@if($loop->first)
						<td  rowspan ="{{ $visite->demandeexmbio->examensbios->count()}}" class="center align-middle">
						{{ $visite->date }}
						</td>
					@endif	
					 <td>{{ $exm->nom_examen }}</td>
					@if($loop->first)
		            	<td rowspan ="{{ $visite->demandeexmbio->examensbios->count()}}" class="center align-middle">
			            	@if($visite->demandeexmbio->etat == "E")
			                    <span class="badge badge-danger"> En Attente</span>
			                  @elseif($visite->demandeexmbio->etat == "V")
			                    <span class="badge badge-success">Validé</span>       
			                  @else
			                    <span class="badge badge-success">Rejeté</span>   
			                  @endif
		            		</td>
		            	@endif 
				@if($loop->first)
		            	<td rowspan ="{{ $visite->demandeexmbio->examensbios->count()}}" class="center align-middle">
		            	<a href="/dbToPDF/{{ $visite->demandeexmbio->id }}" target="_blank" class="btn btn-xs"><i class="ace-icon fa fa-print"></i></a>
		            	</td>
			          @endif   	
		                </tr>
		                @endforeach   
					</tbody>
				</table> 
				</div>
			</div>
		</div>
	</div>
	</div>	{{-- examsBio	 --}} 
	@endif
	@if(isset($demande))
	<div id="examImg" class="tab-pane row">
	  <div class="col-lg-6 col-xs-11 widget-container-col">
			<div class="widget-box widget-color-info">
				<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Examens Imageries</h5></div>
				<div class="widget-body">
					<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th class="center">#</th>
								<th class="center"><strong>Date</strong></th>
								<th class="center"><strong>Nom</strong></th>
								<th class="center"><strong>Type</strong></th>
								<th><strong>Etat</strong></th>
								<th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
						@foreach($demande->examensradios as $index => $examen)
						<tr>
							<td class="center">{{ $index + 1 }}</td>
							@if($loop->first)
							<td  rowspan ="{{ $demande->examensradios->count()}}" class="center align-middle">
							{{ $visite->date }}
							</td>
					  	@endif	
					 		<td>{{ $examen->nom}}</td>
					 		<td>
					 			<?php $exams = explode (',',$examen->pivot->examsRelatif) ?>
	              @foreach($exams as $id)
	                <span class="badge badge-success">{{ App\modeles\TypeExam::FindOrFail($id)->nom}}</span>
	              @endforeach
					 		</td>
							<td>
								@if(!(isset($examen->pivot->etat)))
									<span class="text-warning">En Cours</span>
								@else
								 <span class="text-primary">Fait</span>  
								@endif
							</td>
							<td class="center">
								<table width="100%" height="100%" class="table table-striped table-bordered">
	                @if($examen->pivot->etat == "1")
		                @foreach (json_decode($examen->pivot->resultat) as $k=>$f)
		                <tr>
		                	<td width="60%">{{ $f}}</td>
		                	<td width="40%">
	                      <button type="submit" class="btn btn-info btn-xs open-modal" value="{{ $examen->pivot->id_examenradio."/".$f }}"><i class="ace-icon fa fa-eye-slash"></i></button>
	                      <a href='/Patients/{{$patient->id}}/examsRadio/{{$demande->id}}/{{$examen->pivot->id_examenradio}}/{{ $f }}' class="btn btn-success btn-xs" target="_blank"> <i class="fa fa-download"></i></a>
	                    </td>
		                </tr>
		                @endforeach
	                @endif
	              </table>
							</td>
					  </tr>
			       @endforeach   
						</tbody>
					</table> 
					</div>
				</div>
			</div>
		</div>
		<div class="container col-lg-6" id="dicom"  hidden="true">@include('DICOM.show')</div>
	</div>	{{-- examImg	 --}}
	@endif
    </div>{{-- tab-content --}}
  </div>  {{-- tabbable --}}
</div>
@endsection