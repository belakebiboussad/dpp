@extends('app')
@section('title','Liste des demandes')
@section('page.script')
<script type="text/javascript">
	$('#demandes_liste').dataTable({
		/*processing: true,
		serverSide: true,
		ordering: true,
		bInfo : false,
               pageLength: 5,
               destroy: true,*/
		 "language": 
		 {
		       "url": '/localisation/fr_FR.json'
		 },
		 columns: [
		      {  data: 'Date',orderable: true },
		 ],
		 columnDefs: [
			{ "targets": 1 ,  className: "dt-head-center dt-body-center" }
		], 
 	 });
</script>
@endsection
@section('main-content')
<div class="row">{{-- <h1 style="display: inline;"><strong>Liste des demandes </strong></h1> --}}
	<div class="col-sm-12 col-md-12"><h3><strong>Rechercher une demande</strong></h3>
	<div class="pull-right">
		@if(Auth::user()->is(14))
		<a href="{{route('demandeproduit.create')}}" class="btn btn-white btn-info btn-bold">
			<i class="ace-icon fa fa-plus-circle fa-lg bigger-120"></i> Demande
		</a>
		@endif
	</div>
	</div>
</div>	
<div class="row">
  	<div class="panel panel-default">
    		<div class="panel-heading">Recherche</div>
    		<div class="panel-body">
	  	 <div class="row">
      		<div class="col-sm-4">
      			<div class="form-group">
      				<label><strong>Etat :</strong></label>
         			<select  id="etat" class="selectpicker show-menu-arrow   col-xs-12 col-sm-12 filter">
	         			<option value="" selected>En Cours</option>
	         			<option value="1">Validé</option>
	         			<option value="0">Rejeté</option>
         	     		</select>
         		</div>
         	</div>
         	@if(Auth::user()->is(10))
         	<div class="col-sm-4">
      			<div class="form-group"><label><strong>Service :</strong></label>
      			<select  id="service" class="selectpicker show-menu-arrow col-xs-11 col-sm-11">
      				<option value="">Selectionner...</option>	
      				@foreach ($services as $service)
      					<option value="{{ $service->id }}">{{ $service->nom}}</option>
      				@endforeach
      			</select>
      			</div>
         	</div>
         	@endif
         	</div>
         	</div>
         	<div class="panel-footer">
    			<button type="submit" class="btn btn-sm btn-primary findemande"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
    		</div>
       </div>
 </div>
<div class="row">
	<div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header"><h4 class="widget-title">Demandes :</h4>	</div>
			<div class="widget-body">
					<div class="widget-main">
						<div class="row">
							<div class="col-xs-12">
								<div>
									<table id="demandes_liste" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th class="center"><strong>Date</strong></th>
												<th class="center"><strong>Etat</strong></th>
												<th class="center"><strong>Demandeur</strong></th>
												<th class="center"><strong><em class="fa fa-cog"></em></strong></th>
											</tr>
										</thead>
										<tbody>	
											@foreach($demandes as $demande)
												<tr>
													<td>{{ $demande->Date }}</td>
													<td>
														@switch($demande->etat)
															 @case(null)
														  		 <span class="badge badge-success">En Cours</span>
														       	 @break
														       @case("1")
														  		 <span class="badge badge-info">Validé</span>
														       	 @break
														       @case("0")
														  		 <span class="badge badge-warning">Rejeté</span>
														       	 @break	 
														    @default
														            Default case...
														@endswitch
														
													</td>
													<td>{{ $demande->demandeur->nom }} {{ $demande->demandeur->prenom }}</td>
													<td class="center">
														<a href="{{ route('demandeproduit.show', $demande->id) }}" class="btn btn-xs btn-success" title="voir détails">
															<i class="ace-icon fa fa-hand-o-up bigger-120"></i>
														</a>
														@if((Auth::user()->role_id == 14) && ($demande->etat == null))
														<a href="{{ route('demandeproduit.edit',$demande->id) }}" class="btn btn-white btn-xs" title="editer Demande">
															<i class="fa fa-edit fa-xs"></i>
														</a>
														<a href="{{ route('demandeproduit.destroy',$demande->id) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger">
															<i class="fa fa-trash-o"></i>
														</a>
														@endif
														@if(Auth::user()->role_id == 10)
														<a href="{{ route ("runDemande",$demande->id) }}" class="btn btn-xs btn-info" title="Traiter Demande" >	{{-- --}}
															<i class="ace-icon fa fa-cog  bigger-110"></i>
														</a>
														@endif
													</td>
												</tr>
											@endforeach	
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
	</div>
</div>
@endsection