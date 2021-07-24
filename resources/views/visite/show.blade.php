@extends('app')
@section('style')
<style>
</style>
@endsection
@section('main-content')
<?php 	$patient = $visite->hospitalisation->patient; $demande = $visite->demandExmImg;  ?> 
<div class="page-header" width="100%">
	<div class="row"><div class="col-sm-12" style="margin-top: -2%;">@include('patient._patientInfo')</div></div>
</div>
<div class="row">
	<h4><strong>Détails de la visite :</strong></h4>
	<a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
	</div>
	<div class="row no-gutters">
	  	<div class="col-lg-6">
			<div class="row"><div class="col-sm-6"><label class="">Date :</label></div>
				<div class="form-group col-sm-6">
					 <label class="blue">{{  (\Carbon\Carbon::parse($visite->date))->format('d/m/Y') }}</label>
				</div>
		  	</div>
		  	<div class="row">
				<div class="col-sm-6"> <label>Médecin :</label></div>
			    	<div class="form-group col-sm-6">
		    			<label class="blue">
		     				{{ $visite->medecin->nom }}&nbsp; {{ $visite->medecin->prenom }}
		      			</label>
			    	</div>
		  	</div>
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
      <li><a data-toggle="tab" href="#traitement">Traitements</a> </li>
      @endif
      @if(isset($visite->demandeexmbio))
      <li><a data-toggle="tab" href="#examsBio">Examens biologiques</a> </li>
      @endif
      @if(isset($visite->demandExmImg))
        <li ><a data-toggle="tab" href="#examImg">Examens d'imagerie</a></li>
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
									<th class="center"><em class="fa fa-cog"></em></th>
								</tr>
							</thead>
							<tbody>
							@foreach($visite->actes as $acte)
								<tr>
									<td>{{ $acte->nom }}</td>
									<td>{{ $acte->type }}</td>
									<td>{{ $acte->description }}</td>
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
		<div class="widget-box widget-color-blue">
			<div class="widget-header"><h5 class="widget-title bigger"><i class="ace-icon fa fa-table"></i>Traitements</h5></div>
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
								<td>{{ $trait->posologie }}</td>
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
		<div class="widget-box widget-color-pink">
			<div class="widget-header"><h5 class="widget-title bigger"><i class="ace-icon fa fa-table"></i>Examens biologiques</h5></div>
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
			            	@if($visite->demandeexmbio->etat == null)
			                    <span class="badge badge-success"> En Cours</span>
			                  @elseif($visite->demandeexmbio->etat == 1)
			                    <span class="badge badge-primary">Validée</span>       
			                  @else
			                    <span class="badge badge-warning">Rejetée</span>   
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
	@if(isset($visite->demandExmImg))
	<div id="examImg" class="tab-pane row">
	  	<div class="row no-gutters">
	  		<div class="col-lg-6">
		  		<div class="row"><div class="col-sm-6"><label class="">Informations cliniques pertinentes :</label></div>
				      <div class="form-group col-sm-6"><label class="blue">{{ $demande->InfosCliniques }}</label> </div>
				</div>
				<div class="row"><div class="col-sm-6"> <label class="">Explication de la demande de diagnostic :</label></div>
			      <div class="form-group col-sm-6"><label class="blue">{{ $demande->Explecations }}</label> </div>
				</div>
				<div class="row"><div class="col-sm-6"><label class="">Informations supplémentaires pertinentes :</label> </div>
				    <div class="form-group col-sm-6">
				     	<label class="blue">
				     	 <ul class="list-inline"> 
				        @foreach($demande->infossuppdemande as $index => $info)
				            <li class="active"><span class="badge badge-warning">{{ $info->nom }}</span></li>
				         @endforeach
				        </ul>    
				     	</label>
				    </div>
				</div>
	  		</div>
	  	</div>
	  	<div class="row">		
	  		<div class="col-lg-6 col-xs-11 widget-container-col">
				<div class="widget-box widget-color-blue">
				<div class="widget-header"><h5 class="widget-title bigger"><i class="ace-icon fa fa-table"></i>Examens d'imageries</h5></div>
				<div class="widget-body">
					<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th class="center" width="2%">#</th>
								<th class="center" width="13%"><strong>Date</strong></th>
								<th class="center" width="28%"><strong>Nom</strong></th>
								<th class="center" width="5%"><strong>Type</strong></th>
								<th><strong width="14%">Etat</strong></th>
								<th class="center" width="38%"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
						@foreach($visite->demandExmImg->examensradios as $index => $examen)
						<tr>
							<td class="center">{{ $index + 1 }}</td>
							@if($loop->first)
							<td  rowspan ="{{ $visite->demandExmImg->examensradios->count()}}" class="center align-middle">{{ $visite->date }}</td>
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
							<td>
								<table width="100%" height="100%" class="table table-striped table-bordered">
	               					 @if($examen->pivot->etat == "1")
		                				@foreach (json_decode($examen->pivot->resultat) as $k=>$f)
		               				 <tr>
		                					<td width="50%"><small>{{ $f}}</small></td>
		                					<td width="50%" class="center">
		                					@if((pathinfo($f, PATHINFO_EXTENSION) == 'dcm') || (pathinfo($f, PATHINFO_EXTENSION) == ""))
	                      						<button type="submit" class="btn btn-info btn-xs open-modal" value="{{ $examen->pivot->id_examenradio."/".$f }}"><i class="ace-icon fa fa-eye-slash"></i></button>
	                     						@endif
	                     							 <a href='/Patients/{{$patient->id}}/examsRadio/{{ $visite->demandExmImg->id}}/{{$examen->pivot->id_examenradio}}/{{ $f }}' class="btn btn-success btn-xs" target="_blank"> <i class="fa fa-download"></i></a>
	                     							 @isset($examen->pivot->crr_id)
								  		<a href="{{ route('crrs.download',$examen->pivot->crr_id )}}" title="télecharger le compte rendu" class="btn btn-default btn-xs" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
										  @endisset
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
				</div><div class="space-12"></div>
				<div class="row"><div class="col-sm-6"> <label class="">Compte rendu radiologique :</label></div></div>
				<div class="row">
					<div class="form-group col-sm-6">
					<textarea  disabled  cols="91" rows = "17" style="resize:none">
						@foreach($visite->demandExmImg->examensradios as $index => $examen)
								@isset($examen->pivot->crr_id)
									{{ App\modeles\CRR::FindOrFail($examen->pivot->crr_id)->conclusion  }}
								 @endisset
								@endforeach
						</textarea>
					</div>
				</div>
			</div>
			<div class="container col-lg-6" id="dicom"  hidden="true">@include('DICOM.show')</div>
	  	</div>		
	</div>	{{-- examImg	 --}}
	@endif
    </div>{{-- tab-content --}}
  </div>  {{-- tabbable --}}
</div>
@endsection