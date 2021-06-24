@extends('app')
@section('title','Demandes examens biologique ')
@section('page-script')
 <script>
 	$field ="etat";
 	function getAction(data, type, dataToSet) {
 		var actions = '<a href = "/demandeexb/'+data.id+'" style="cursor:pointer" class="btn btn-secondary btn-xs" data-toggle="tooltip" title=""><i class="fa fa-hand-o-up fa-xs"></i></a>';
 		if(data.etat == null)
 			actions +='&nbsp;<a href="/detailsdemandeexb/'+data.id+'" class="btn btn-info btn-xs" title="attacher résultat"><i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i></a>';								
 		 return actions;
 	}
 	function getBioRequests(field,value)
	{
		$.ajax({
			url : '{{ URL::to('searchBioRequests') }}',
			 data: {    
			      	"field":field,
			      	"value":value,
			 },
		    	dataType: "json",// recommended response type
		    	success: function(data) {
		       		$(".numberResult").html(data.length);
		       		$("#demandes_table").DataTable ({ 
		       			 		"processing": true,
			            	"paging":   true,
			            	"destroy": true,
			            	"ordering": true,
			            	"searching":false,
			            	"info" : false,
			            	"responsive": true,
			            	"language":{"url": '/localisation/fr_FR.json'},
			            	"data" : data,
			            	"columns": [
			            		{ data:null,title:'#', searchable: false,
													render: function ( data, type, row ) {
			                   			if ( type === 'display' ) {
			                        			return '<input type="checkbox" class="editor-active check" name="" value="'+data.id+'" /><span class="lbl"></span>';
			                  			}
			                  			 return data;
							      	 		}, className: "dt-body-center","orderable":false, 
											},
											{	data: null,
                          	render: function ( data, type, row ) {
                            	if(data.id_consultation != null)
                            		return  row.consultation.Date_Consultation;
                            	else
                            		return row.visite.date;
                            	return data;	
                          	},title:'Date',"orderable": true,
											},
											{	data: null,
                          	render: function ( data, type, row ) {
                            	if(data.id_consultation != null)
                            		return  row.consultation.patient.Nom + ' ' + row.consultation.patient.Prenom;
                            	else
                            		return row.visite.hospitalisation.patient.Nom + ' ' + row.visite.hospitalisation.patient.Prenom;
                            	return data;	
                          	},title:'Patient',"orderable": true,
											},
											{	data: null,
                      	render: function ( data, type, row ) {
                        	if(data.id_consultation != null)
                        		 return row.consultation.docteur.nom + ' ' + row.consultation.docteur.prenom ;
                        	else
                        		return row.visite.hospitalisation.medecin.nom + ' ' + row.visite.hospitalisation.medecin.prenom;
                        	return data;	
                      	},title:'Médecin traitant',"orderable": false,
											},
											{	data: null,
                      	render: function ( data, type, row ) {
                        	if(data.id_consultation != null)
                        		 return row.consultation.docteur.service.nom ;
                        	else
                        		return  row.visite.hospitalisation.medecin.service.nom;
                        	return data;	
                      	},title:'Service',"orderable": true,
											},
											{ data: 'etat', title:'Etat',"orderable":true,
			           				render: function ( data, type, row ) {
			              			switch(row.etat)
				 									{
										 				case null:
										 					return '<span class="badge badge-success">En Cours</span>';
										 					break;
										 				case "1":
										 					return '<span class="badge badge-info">Validée</span>';
										 					break;
										 				case "0":
										 					return '<span class="badge badge-warning">Rejetée</span>';
										 					break;
										 				default:
										 					return "UNKNOWN";
										 					break;			
								 					}        
			       			      }
	              			},
	              			{ data:getAction , title:'<em class="fa fa-cog"></em>', "orderable":false,searchable: false}
										],
										"columnDefs": [
	              				{"targets": 6 ,  className: "dt-head-center dt-body-center" },
	              			]
									});	      		
		      }
		 })
	}
 	$(function(){
  		$(".demandeBioSearch").click(function(e){
  	  		getBioRequests(field,$('#'+field).val().trim());
  		})
  })
</script>
@endsection 	
@section('main-content')
<div class="row"><div class="col-sm-12 col-md-12"><h3><strong>Rechercher une demande d'examen biologique</strong></h3></div></div>
<div class="row">
  	<div class="panel panel-default">
    		<div class="panel-heading">Rechercher</div>
    		<div class="panel-body">
	  	 <div class="row">
	      		<div class="col-sm-4">
	      			<div class="form-group">
	      				<label><strong>Etat :</strong></label>
	         			<select  id="etat" class="selectpicker show-menu-arrow   col-xs-12 col-sm-12 filter">
		         			<option selected disabled>Selectionner...</option>
		         			<option value="">En Cours</option>
		         			<option value="1">Validé</option>{{-- <option value="0">Rejeté</option> --}}
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
								<th class="center"><strong>Patient</strong></th>
								<th class="center"><strong>Médecin traitant</strong></th>
								<th class="center"><strong>Service</strong></th>
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
									 <a href="{{ route('demandeexb.show', $demande->id) }}"><i class="fa fa-eye"  class="btn btn-xs btn-secondary"></i></a>
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
{{--<div class="row">
	<div class="col-xs-12">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="widget-box transparent">
					<div class="widget-header widget-header-large">
						<h3 class="widget-title grey lighter"><i class="ace-icon fa fa-leaf green"></i>Liste des demandes</h3>
					</div>
					<div class="widget-body">
						<div class="widget-main padding-24">
							<div class="col-sm-12 widget-container-col">
								<div>
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th class="center">#</th>
												<th class="hidden-480"><strong>Date</strong></th>
												<th class="center"><strong>Médecin traitant</strong></th>
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
														{{ $demande->consultation->docteur->nom }} {{ $demande->consultation->docteur->prenom }}
													@else
														{{ $demande->visite->hospitalisation->medecin->nom }} {{ $demande->visite->hospitalisation->medecin->prenom }}
													@endif	
													</td>
													<td>
													@if(isset($demande->id_consultation))
														{{ $demande->consultation->patient->Nom }} {{ $demande->consultation->patient->Prenom }} <small class="text-primary">(Consultation)</small>
													@else
														{{ $demande->visite->hospitalisation->patient->Nom }} {{ $demande->visite->hospitalisation->patient->Prenom }} <small class="text-primary">(Hospitalisation)</small>
													@endif
													</td>
													<td>
														@if($demande->etat == null)
															En Attente
														@elseif($demande->etat == "1")
															Validé
														@else
															Rejeté
														@endif
													</td>
													<td class="center">
													  <a href="{{ route('demandeexb.show', $demande->id) }}"><i class="fa fa-eye"></i></a>
									    			<a href="/detailsdemandeexb/{{ $demande->id }}" title="attacher résultat">
															<i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i>
														</a>
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
	</div><!-- /.col -->
</div><!-- /.row -->
--}}
@endsection