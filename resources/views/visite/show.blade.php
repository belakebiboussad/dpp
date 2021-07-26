@extends('app')
@section('main-content')
<?php 	$patient = $visite->hospitalisation->patient; $demande = $visite->demandExmImg;  ?> 
<div class="container-fluid">
	<div class="row"><div class="col-sm-12  mt-2p">@include('patient._patientInfo')</div></div>
	<div class="panel-heading left">
	  	<h4><strong>Détails de la visite :</strong></h4>
	  	<div class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
	  	 </div>
	</div>	
	<div class="row">
		<div class="form-group">		
			<label class="col-sm-1 control-label no-padding-right" for="service"><strong>Date :</strong></label>
			<div class="col-sm-8 col-xs-8">
				 <label class="blue">{{  (\Carbon\Carbon::parse($visite->date))->format('d/m/Y') }}</label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-1 no-padding-right"><label>Médecin :</label></div>
		<div class="form-group col-sm-6">
	    <label class="blue">{{ $visite->medecin->nom }}&nbsp; {{ $visite->medecin->prenom }}</label>
		</div>
	</div>
	<div class="tabpanel">
		<ul class = "nav nav-pills nav-justified list-group" role="tablist">
	        @if($visite->actes->count() > 0)
		 	 <li role= "presentation"><a href="#actes" role="tab" data-toggle="tab" class="btn-succes">Actes</a></li>
		@endif
		@if($visite->traitements->count() > 0)
		  	<li role= "presentation"><a href="#traitement" role="tab" data-toggle="tab" class="btn-success">Traitements</a></li>
		 @endif
		@if(isset($visite->demandeexmbio))
			  <li role= "presentation"><a href="#examsBio" role="tab" data-toggle="tab" class="btn-pink">Demande examens biologiques</a></li>
		@endif
		@if(isset($visite->demandExmImg))
    			<li role= "presentation"><a href="#examImg" role="tab" data-toggle="tab" class="btn-purple">Demande examens d'imagerie</a></li>
     		 @endif
		</ul>
		<div class ="tab-content no-border">
			@if($visite->actes->count() > 0)
			<div id="actes" class="tab-pane row">
      				<div class="col-xs-12 widget-container-col row">
				<div class="widget-box widget-color-blue">
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
			@if($visite->traitements->count() > 0)
    			  <div id="traitement" class="tab-pane row">
       				<div class="col-xs-12 widget-container-col row">
				<div class="widget-box widget-color-green">
				<div class="widget-header"><h5 class="widget-title bigger"><i class="ace-icon fa fa-table"></i>Traitements</h5></div>
				<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th class="center"><strong>Nom</strong></th>
								<th class="center"><strong>Type</strong></th>
								<th class="center"><strong>Posologie</strong></th>
								<th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
							@foreach($visite->traitements as $trait)
							<tr>
								<td>{{ $trait->medicament->nom }}</td>
								<td>{{ $trait->medicament->specialite->nom }}</td>

								specialite
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
    @endif
     @if(isset($visite->demandeexmbio))
      <div id="examsBio" class="tab-pane row">
      <div class="col-xs-12 widget-container-col row">
			<div class="widget-box widget-color-pink">
				<div class="widget-header"><h5 class="widget-title bigger"><i class="ace-icon fa fa-table"></i>Demande examens biologiques</h5></div>
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
						 <td>{{ $exm->nom }}</td>
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
		<div class="col-xs-12 widget-container-col row">
			<div class="widget-box widget-color-purple">
			<div class="widget-header"><h5 class="widget-title bigger"><i class="ace-icon fa fa-table"></i>Demande d'examen d'imagerie</h5></div>
			<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th class="center"><strong>Date</strong></th><th class="center"><strong>Etat</strong></th>
							<th class="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{  (\Carbon\Carbon::parse($visite->date))->format('d/m/Y') }}</td>
							<td>
								 @if($demande->etat == null)
											<span class="badge badge-warning"> En Attente</span>
								 @elseif($demande->etat == "1")
											Validé
								@else
										 <span class="badge badge-danger">Rejeté</span>
								 @endif
							</td>
							<td class="center">
								<a href="{{ route('demandeexr.show', $demande->id) }}"><i class="fa fa-eye"></i></a>
								<a href="/drToPDF/{{ $demande->id }}" target="_blank" class="btn btn-xs"><i class="ace-icon fa fa-print"></i></a>
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
		</div><!-- tab-content -->
	</div>
</div>
@endsection