@extends('app_laboanalyses') 
@section('title','Demandes examens biologique ')
@section('page-script')
 <script>
 	field ="etat";
 	var url = '{{ URL::to('searchBioRequests') }}';
 	function getAction(data, type, dataToSet) {
            var actions = '<a href = "/demandeexb/'+data.id+'" style="cursor:pointer" class="btn btn-secondary btn-xs" data-toggle="tooltip" title=""><i class="fa fa-hand-o-up fa-xs"></i></a>';
            if(data.etat == null)
              actions +='&nbsp;<a href="/detailsdemandeexb/'+data.id+'" class="btn btn-info btn-xs" title="attacher résultat"><i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i></a>';                
             return actions;
    }
 	$(function(){
 		$(".demandeBioSearch").click(function(e){
	  		getRequests(url,field,$('#'+field).val().trim());
	  	})
  	})
</script>
@endsection 	
@section('main-content')
<div class="row"><div class="col-sm-12 col-md-12"><h4><strong>Rechercher une demande d'examen biologique</strong></h4></div></div>
<div class="row">
  	<div class="panel panel-default">
    		<div class="panel-heading"><strong>Rechercher</strong></div>
    		<div class="panel-body">
	  	 <div class="row">
	      		<div class="col-sm-4">
	      			<div class="form-group">
	      				<label><strong>Etat :</strong></label>
	         			<select  id="etat" class="selectpicker show-menu-arrow  col-xs-12 col-sm-12 filter">
		         			<option selected disabled>Selectionner...</option>
		         			<option value="">En Cours</option>
		         			<option value="1">Validé</option>
	         	    </select>
	         		</div>
	         	</div>
	         	<div class="col-sm-4">
	      			<div class="form-group"><label><strong>Service :</strong></label>
		      			<select  id="service" class="selectpicker show-menu-arrow col-xs-11 col-sm-11 filter">
		      				<option value="">Selectionner...</option>	
		      				@foreach ($services as $service)
		      					<option value="{{ $service->id }}">{{ $service->nom}}</option>
		      				@endforeach
		      			</select>
	      			</div>
	         	</div>
         	</div>
         	</div>
         	<div class="panel-footer">
    			<button type="submit" class="btn btn-sm btn-primary demandeBioSearch"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
    		</div>
       </div>
 </div>
 <div class="row">
	<div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demandes d'examen biologique</h5>&nbsp;<label><span class="badge badge-info numberResult"></span></label>
				</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
					<div class="col-xs-12">
					<table id="demandes_table" class="table table-striped table-bordered" width="100%">
						<thead>
							<tr>
								<th class="center">#</th>
								<th class="hidden-480"><strong>Date</strong></th>
								<th class="center"><strong>Service</strong></th>
								<th class="center"><strong>Médecin demandeur</strong></th>
								<th class="center"><strong>Patient</strong></th>
								<th class="center"><strong>Etat</strong></th>
								<th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
						@foreach($demandesexb as $index => $demande)
							<tr>
								<td class="center">{{ $index + 1 }}</td>
								<td>
								@if(isset($demande->id_consultation))
									{{ $demande->consultation->Date_Consultation }}
								@else		
									{{ $demande->visite->date }}
								@endif
								</td>
								<td>
								@if(isset($demande->id_consultation))
									{{ $demande->consultation->patient->Nom }} {{ $demande->consultation->patient->Prenom }} <small class="text-primary">(Consultation)</small>
								@else
									{{ $demande->visite->hospitalisation->patient->Nom }} {{ $demande->visite->hospitalisation->patient->Prenom }} <small class="text-warning">(Hospitalisation)</small>
								@endif
								</td>
								<td>
								@if(isset($demande->id_consultation))
									{{ $demande->consultation->docteur->nom }} {{ $demande->consultation->docteur->prenom }}
								@else
									{{ $demande->visite->hospitalisation->medecin->nom }} {{ $demande->visite->hospitalisation->medecin->prenom }}
								@endif	
								</td>
								<td>
								@if(isset($demande->id_consultation))
									{{ $demande->consultation->docteur->Service->nom }} 
								@else
									{{ $demande->visite->hospitalisation->medecin->Service->nom }}
								@endif	
								</td>
								
								<td>
									@if($demande->etat == null)
										 <span class="badge badge-success">En Cours</span>
									@elseif($demande->etat == "1")
										 <span class="badge badge-info">Validée</span>
									@else
										 <span class="badge badge-warning">Rejetée</span>
									@endif
								</td>
								<td class="center">
									 <a href="{{ route('demandeexb.show', $demande->id) }}" class="btn btn-xs btn-secondary"><i class="fa fa-eye"></i></a>
			    					@if($demande->etat == null)
			    					<a href="/detailsdemandeexb/{{ $demande->id }}" title="attacher résultat" class="btn btn-xs btn-info">
										<i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i>
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
@endsection