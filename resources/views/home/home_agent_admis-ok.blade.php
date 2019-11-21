@extends('app_agent_admis')
@section('main-content')
<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
  <div class="panel-heading">
     <div class="row">
      <div class="col-md-5"></div>
      <div class="col-md-5">
  			<div class="input-group" data-provide="">
   					 <input type="text" id ="currentday"class=" col-xs-12 col-sm-6 date-picker form-control" value="<?= date("Y-m-j") ?>">
   						 <div class="input-group-addon">
        						<span class="glyphicon glyphicon-th"></span>
   						 </div>
</div>
  		</div>
      <div class="col-md-2">
          <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Rechercher</button>
          <!--  <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button> -->
      </div>
     </div>
    </div>
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">
				<i class="ace-icon fa fa-table"></i>
				Liste des admissions <b><span id="total_records"></span></b><!-- du jour  <strong>&quot;{{ Date('Y-m-d') }}&quot;	</strong> -->
			</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
			<table class="table table-striped table-bordered table-hover" id="liste_admissions">
				<thead class="thin-border-bottom">
					<tr>
						<th style="display: none;"></th>
						<th>Patient</th>
						<th>Service</th>
						<th>Salle</th>
						<th>Lit</th>
						<th>Date prévue d'entrée</th>
						<th>Heure prévue d'entrée</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				
						@foreach($rdvs as $rdv)
						<tr>
								<td style="display: none;">{{$admission->id_admission}}</td>
								<td>
										{{ $rdv->admission->demandeHospitalisation->consultation->patient->Nom }}
								    {{ $$rdv->admission->demandeHospitalisation->consultation->patient->Prenom }}
								</td>
								<td>
								  @if(isset($rdv->admission->lit_id))
											{{ $rdv->admission->lit->salle->service->nom }}
								  @else
									  	<strong>/</strong>
								  @endif
								</td>
								<td>
									@if(isset($rdv->admission->lit_id))
										 {{ $rdv->admission->lit->salle->nom }}
									@else
									 		<strong>/</strong>
									@endif
								</td>
								<td>
									@if(isset($rdv->admission->lit_id))
								 			{{ $rdv->admission->lit->num }}  
									@else
											<strong>/</strong>
								 	@endif
								</td>
								<td>
									<span  style="color: red;">
									<strong>{{ $rdv->admission->date_RDVh }}</strong>
									</span>
								</td>
								<td>
										<span  style="color: red;">
											<strong>{{ $rdv->admission->heure_RDVh }}</strong>
										</span>
								</td>
								<td>								<!-- Trigger the modal with a button -->
										<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{$admission->id_admission}}" data-backdrop="false">confirmer l'entrée</button>
										<!--model pop-up -->
										<div id="{{$admission->id_admission}}" class="modal fade" role="dialog" aria-hidden="true">
			 							<div class="modal-dialog">
										<div class="modal-content">
			      							<div class="modal-header">
			        								<button type="button" class="close" data-dismiss="modal">&times;</button>
			        									<h4 class="modal-title">confirmer l'entrée du patient:</h4>
			      							</div>
			      							<div class="modal-body">
			        							<p><span  style="color: blue;"><strong >
			        								{{ $rdv->admission->Nom }}
			        								{{$rdv->admission->Prenom }}</strong></span></p>
			        								<p>le  &quot;<span  style="color: orange;"><strong>
			        								{{ $admission->date_RDVh }}</strong></span>&quot; à <span  style="color: red;">
			        								<strong>{{Date("H:i:s")}}</strong></span></p>			
			        						</div>
			      							<form id="hospitalisation" class="form-horizontal" role="form" method="POST" action="{{route('hospitalisation.store')}}">{{ csrf_field() }}
			      							<input id="id_ad" type="text" name="id_ad" value="{{$admission->id_admission}}" hidden>
			      							<input id="id_RDV" type="text" name="id_RDV" value="{{$admission->idRDV}}" hidden>
			      							<div class="modal-footer">
			        							<button type="button" class="btn btn-default" data-dismiss="modal">
			        								 <i class="ace-icon fa fa-undo bigger-120"></i>
			        								Fermer
			        							</button>
			        							<button  type="submit" class="btn btn-success" >
			        								  <i class="ace-icon fa fa-check bigger-120"></i>
			        								Valider
			        							</button>
			      							</div> 
			      							</form>
			   							 </div>
			  							</div>
										</div>
								</td>	
						</tr>
						@endforeach
				</tbody>	
			</table>	
		</div>
	 	</div>
	</div>
</div>
@endsection
@section('page-script')
	<script type="text/javascript">
	  function fetch_data(date)
	  {
	  	  var today = new Date();
	  	  var currentday = today.getFullYear()+'-'+(today.getMonth() + 1).toString().padStart(2, "0")+'-'+today.getDate().toString().padStart(2, "0");
	  		var heure = today.getHours() + ':' + today.getMinutes();
	  		$.ajax({
                  type :'get',
                  url : '{{URL::to('getAdmissions')}}',
                  data:{'date':date},
                  success:function(result,status, xhr)
                  {
                  	var admissions = result['data']; 
                  	if( admissions != null)
                    {                    	
	                    var output = '';
	                    $('#total_records').text(result['data'].length);
	                    for(var count = 0; count < result['data'].length; count++)
	    								{
	    									  output += '<tr>';
											    output += '<td>' + admissions[count].Nom + result['data'][count].Prenom + '</td>';
											    output += '<td>' + admissions[count].nom_service + '</td>';
											    output += '<td>' + admissions[count].nom_salle + '</td>';
											    output += '<td>' + admissions[count].num_lit + '</td>';
											    output += '<td><span  style="color: red;">' + admissions[count].date_RDVh + '</span></td>';
											    output += '<td><span  style="color: red;">' + admissions[count].heure_RDVh + '</span></td>';
											    if(date != currentday)
											    		output += '<td><span  style="color: red;">' + "1" + '</span></td></tr>';
											    else
											    	{
											    		output += '<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal"'+
											    		 					'data-backdrop="false" data-target="#'+admissions[count].id_admission+'">Confirmer</button>'+
												    		 				'<div id="'+ admissions[count].id_admission +'" class="modal fade" role="dialog" aria-hidden="true">'+
													    		 				'<div class="modal-dialog">'+
													    		 					'<div class="modal-content">'+
													    		 						'<div class="modal-header">'+
													    		 							'<button type="button" class="close" data-dismiss="modal">&times;</button>'+
													    		 							'<h4 class="modal-title"><strong>confirmer l\'entrée du patient:</strong></h4>'+
													    		 						'</div>'+
													    		 						'<div class="modal-body">'+
													    		 						  '<p><span  style="color: blue;"><strong >'+ admissions[count].Nom +' '+ admissions[count].Prenom +'</strong></span></p>'+
													    		 						  '<p>le  &quot;<span  style="color: orange;"><strong>'+ admissions[count].date_RDVh +'</strong></span>&quot; à'+' ' +' <span  style="color: red;"><strong>'+ heure +'</strong></span></p>'+
													    		 						'</div>'+
													    		 						'<form id="hospitalisation" class="form-horizontal" role="form" method="POST" action="{{route("hospitalisation.store")}}">{{ csrf_field() }}'+
													    		 							'	<input id="id_ad" type="text" name="id_ad" value="'+ admissions[count].id_admission+'" hidden>'+
													    		 							'<input id="id_RDV" type="text" name="id_RDV" value="'+admissions[count].id+'" hidden>'+
													    		 							'<div class="modal-footer">'+
													    		 							  '<button type="button" class="btn btn-default" data-dismiss="modal">'+
													    		 							  	'<i class="ace-icon fa fa-undo bigger-120"></i>'+
													    		 							  	'Fermer'+
													    		 							  '</button>'+
													    		 							  '<button  type="submit" class="btn btn-success">'+
													    		 							     'Valider'+
													    		 							  '</button>'+
													    		 							'</div>'+
													    		 						'</form>'+
													    		 					'</div>'+
													    		 				'</div>'+
												    		 				'</div>'+
												    		 				'</td></tr>';
																				
											    	}

	    								}
	    							  //console.log(output);
    								  $('tbody').html(output);
                    }
                  },
                  error: function(data){
                  	console.log("dfs");
                	}
        });
	  }
	  
	  $('#filter').click(function(){
      var date = $('#currentday').val();
      if(date != '')
      {
      	fetch_data(date);
      }else
      {
      	console.log("date required");
      }
    });
     
  </script>
@endsection	