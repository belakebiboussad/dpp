@extends('app')
@section('main-content')
<div class="container-fluid">
	<div class="page-header"> @include('patient._patientInfo',['patient'=>$visite->hospitalisation->patient])</div>
<div class="row">
  <div class="col-sm-12"><h4>Détails de la visite</h4>
    <div class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-sm btn-warning"><i class="ace-icon fa fa-backward"></i> precedant</a></div>
	</div>
	</div>
   <div class="row">
    <div class="col-xs-12">@include('visite.partials._show')</div>  
  </div>	

	<div class="tabpanel">
		<ul class = "nav nav-pills nav-justified list-group" role="tablist">
	        @if($visite->actes->count() > 0)
		 	 <li role= "presentation"><a href="#actes" role="tab" data-toggle="tab" class="btn-succes">Actes</a></li>
		@endif
		@if($visite->traitements->count() > 0)
		  	<li role= "presentation"><a href="#traitement" role="tab" data-toggle="tab" class="btn-primary">Traitements</a></li>
		 @endif
		@if(isset($visite->demandeexmbio))
      <li role= "presentation"><a href="#examsBio" role="tab" data-toggle="tab" class="btn-danger">Demande examens biologiques</a></li>
		@endif
		@if(isset($visite->demandExmImg))
    <li role= "presentation"><a href="#examImg" role="tab" data-toggle="tab" class="btn-danger">Demande examens d'imagerie</a></li>
		@endif
		</ul>
		<div class ="tab-content no-border">
			@if($visite->actes->count() > 0)
			<div id="actes" class="tab-pane row">
      				<div class="col-xs-12 widget-container-col row">
				<div class="widget-box widget-color-green">
				<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Actes</h5></div>
				<div class="widget-body">
					<div class="widget-main no-padding">
						<table class="table table-striped table-bordered table-hover">
							<thead class="thin-border-bottom">
								<tr>
									<th class="center">Nom</th>  <th class="center">Type</th>
								  <th class="center">Description</th>
									<th class="center"><em class="fa fa-cog"></em></th>
								</tr>
							</thead>
							<tbody>
							@foreach($visite->actes as $acte)
								<tr>
									<td>{{ $acte->nom }}</td><td>{{ $acte->type }}</td>
									<td>{{ $acte->description }}</td><td></td>
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
				<div class="widget-box widget-color-blue">
				<div class="widget-header"><h5 class="widget-title bigger"><i class="ace-icon fa fa-table"></i>Traitements</h5></div>
				<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th class="center">Nom</th><th class="center">Type</th>
								<th class="center">Posologie</th>
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
			<div class="widget-box widget-color-red">
				<div class="widget-header"><h5 class="widget-title bigger"><i class="ace-icon fa fa-table"></i>Demande examens biologiques</h5></div>
				<div class="widget-body">
				<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th class="center">#</th><th class="center">Date</th><th class="center">Nom</th>
							<th>Etat</th><th class="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					@foreach($visite->demandeexmbio->examensbios as $index => $exm)
					<tr>
						<td class="center">{{ $index + 1 }}</td>
						@if($loop->first)
							<td  rowspan ="{{ $visite->demandeexmbio->examensbios->count()}}" class="center align-middle">{{ $visite->date_formated }}
							</td>
						@endif	
						 <td>{{ $exm->nom }}</td>
						@if($loop->first)
            	<td rowspan ="{{ $visite->demandeexmbio->examensbios->count()}}" class="center align-middle">{!! $formatStat
($visite->demandeexmbio->etat) !!}</td>
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
			<div class="widget-box widget-color-red">
			<div class="widget-header"><h5 class="widget-title"><i class="ace-icon fa fa-table"></i>Demande d'examen d'imagerie</h5></div>
			<div class="widget-body">
				<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th class="center">Date</th><th class="center">Etat</th>
							<th class="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $visite->date_formated }}</td>
							<td class="center">{!! $formatStat
($visite->demandExmImg->etat) !!}</td>
							<td class="center">
								<a href="{{ route('demandeexr.show', $visite->demandExmImg->id) }}"><i class="ace-icon fa fa-eye-slash"></i></a>
								<a href="/drToPDF/{{ $visite->demandExmImg->id }}" target="_blank" class="btn btn-xs"><i class="ace-icon fa fa-print"></i></a>
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
@stop