@extends('app_dele')
@section('title','Colloque')
@section('page-script')
<script>
	$(document).ready(function(){
		  $(".med").change(function(){
		    $(this).next().remove();
		  });
	});
	function valideDemande(elm,line,id){
		var  select = $("#" + line).find("select");//row = $(".bodyClass").find('tr').eq(line);
		if (select.val() == null) {
			if (!$(".red")[0]){
	    			select.after('<div class="red">Sélectionner un Medecin</div>'); 
			}  
	  	}else {
	  		var formData = {
  	   			 id_medecin : $("#" + line).find('[name=medecin]').val(),
  	   			 observation : $("#" + line).find('[name=observation]').val(),
	     		     ordre_priorite : $("#" + line).find("input[type='radio']:checked").val(), //$("#" + line).find('[name=prop]:checked').val(),
		           id_demande : $("#" + line).find('[name=demandeId]').val(),
		           id_colloque :$("#colloqueId").val(),
		     };
	    		var ajaxurl = '/demandehosp/valider';
	    		if(!($(elm).hasClass("btn-success")))
		      {	
		       	ajaxurl = '/demandehosp/invalider';
		      }
    		 	$.ajax({
			 	headers: {
			              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			     },
	        		url : ajaxurl,
		        	type:'POST',
			     data:formData,
			     dataType: 'json',
		        	success: function (data) {
			         	if(data.etat == 'valide')
			          {
			     			$(elm).html('<i class="fa fa-close" style="font-size:14px"></i> Annuler');
			       		$(elm).attr('title', 'Annuler');$(elm).removeClass("btn-success").addClass("btn-danger");	
			 		}else{
				     	      $(elm).removeClass("btn-danger").addClass("btn-success");
					      $(elm).attr('title', 'Valider demande');$(elm).html('<i class="ace-icon fa fa-check"></i>Valider');
					}
			      },
			      error:function(data){
			          console.log('Error:', data);
			      }
			}); 
		}
	}

</script>
@endsection
@section('main-content')
<div  class="row"><h4><strong>Déroulement du colloque  {{( $colloque->type == "0" ) ? 'Médical' :'Chérurgical'}}  de la semaine du </strong> <strong>&quot;<?php $d=$colloque->date.' monday next week'; echo(date('d M Y',strtotime($d)-1));?>&quot;</strong></h4>
</div>
<form id="detail_coll" class="form-horizontal" method="GET" action="/endcolloque/{{ $colloque->id }}"> {{--return redirect()->action('ColloqueController@index');--}}
	{{ csrf_field() }}
	<div class="row">
		<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-2">
			<div class="widget-box widget-color-blue" id="widget-box-2">
				<div class="widget-header">
					<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des demandes d'hospitalisation :</h5>
					<input type="hidden" id ="colloqueId" value ="{{ $colloque->id}}">
				</div>
				<div class="widget-body">
					<div class="widget-main no-padding">
						<table class="table table-striped table-bordered table-hover" id="table1" aria-describedby="table1_info" role="grid">
			      	<thead class="thin-border-bottom">
		       		<tr>
							<th class ="center" width="11%"><h5><strong>Patient</strong></h5></th>
							<th class ="center" width="10%"><h5><strong class="text-center">Spécialité</strong></h5></th>
							<th class ="center" width="10%"><h5><strong>Date demande</strong></h5></th>
							<th class ="center" width="10%"><h5><strong>Mode admission</strong></h5></th>
							<th class ="center" width="12%"><h5><strong>Médecin traitant</strong></h5></th>
						  <th width="10%" class ="center"><h5><strong>Priorité</strong></h5></th>
							<th class="font-weight-bold center"><h5><strong>Observation</strong></h5></th>
							<th class="detail-col center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>	
					<tbody id ="demandesBody" class="bodyClass">
		 			<?php $j = 0; ?>
		 			@foreach( $demandes as $i=>$demande)
		    		<tr id= "{{ $j }}">
		  				<td hidden> <input type="hidden" name="demandeId" value="{{ $demande->id}}"/></td>	
		  				<td>{{ $demande->consultation->patient->Nom }} {{ $demande->consultation->patient->Prenom }}</td>	
		  				<td>{{ $demande->Specialite->nom }}</td>
		  				<td>{{$demande->consultation->Date_Consultation }}</td>
						  <td>
						  	@switch( $demande->modeAdmission )
   							  @case(0)
     								<span class="label label-sm label-primary">Programme</span>
        						@break
        					@case(1)
     								<span class="label label-sm label-success">Ambulatoire</span>
        						@break
        					@case(2)
     								<span class="label label-sm label-warning">Urgence</span>
        						@break		
						  	@endswitch
						  </td>
							<td>
								<select id="medecin" name = "medecin" class ="med" class ="selectpicker show-menu-arrow place_holder col-sm-12">
									<option value="0" selected disabled>Selectionnez... </option>
									@foreach ($medecins as $medecin)
									<option value="{{ $medecin->id }}">{{ $medecin->nom }} {{ $medecin->prenom }}</option>
									@endforeach
								</select>
							</td>
					    <td>
					    	<div class=" btn-group btn-group-vertical col-sm-12 btn-group-lg" data-toggle="radio" role="group"> 
							 	 		<label for="prop"><input type="radio"  class="radioM" name="prop{{$j}}" value="1" checked/>1</label>&nbsp;&nbsp;
										<label for="prop"><input type="radio"  class="radioM" name="prop{{$j}}" value="2"/>2</label>&nbsp;&nbsp;
			         		  <label for="prop"><input type="radio"  class="radioM" name="prop{{$j}}" value="3" />3</label>
							 	</div>
						  </td>
				    	<td>
				    		<textarea class="width-100" resize="none" name="observation"></textarea>
				    	</td>
				    	<td>
				   			<a href="#" class="green btn-lg show-details-btn" title="Afficher Details" data-toggle="collapse"  id="{{$i}}" data-target=".{{$i}}collapsed" >
				    			<i class="fa fa-eye-slash" aria-hidden="true"></i><span class="sr-only">Details</span>
				   			</a>
				   	 		<a href="#" class="btn btn-success btn-xs aaaa" value ="valider" title= "Valider demande"	onclick= "valideDemande(this,{{ $j }},{{$demande->id}});"><i class="ace-icon fa fa-check" ></i> Valider</a>     
				    	</td>   			
			    	</tr> 
			    	<?php $j++ ?>
			    	<tr class="collapse out budgets {{$i}}collapsed">
				     	<td colspan="12">
					   		<div class="table-detail">
					   			<div class="row">
					     			<div class="col-xs-6 col-sm-6">
											<div class="space visible-xs"></div>
											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name text-center"><strong>Age:</strong></div>
													<div class="profile-info-value"> <span>{{ $demande->consultation->patient->getAge( )}} ans</span></div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name text-center"><strong>Groupe sanguin:</strong></div>
													<div class="profile-info-value">
			         	 					<h4>
			         	 						<span class="label label-lg label-inverse arrowed-in">{{ $demande->consultation->patient->group_sang }}{{ $demande->consultation->patient->rhesus }}</span>
			         	 					</h4>
										 		</div>
											</div>
											<div class="profile-info-row">
												<div class="profile-info-name text-center"><strong>Établi par Dr:</strong></div>
												<div class="profile-info-value">
													<span>{{ $demande->consultation->docteur->nom }} {{ $demande->consultation->docteur->prenom }}</span>
												</div>
											</div>
									  </div>	{{-- profile-user-info-striped --}}
				        	</div>{{-- col-xs-6 col-sm-6 --}}
									<div class="col-xs-6 col-sm-6">
										<div class="space visible-xs"></div>
										<div class="profile-user-info profile-user-info-striped">
											<div class="profile-info-row">
												<div class="profile-info-name text-center"><strong>Mode d'admission:</strong></div>
												<div class="profile-info-value"><h4>
													<span class = "label label-lg label-success">
														@switch( $demande->modeAdmission )
								   							 @case(0)
								     								<span class="label label-sm label-primary">Programme</span>
								        							@break
								        						@case(1)
								     								<span class="label label-sm label-success">Ambulatoire</span>
								        							@break
								        						@case(2)
								     								<span class="label label-sm label-warning">Urgence</span>
								        							@break		
														  	@endswitch
													</span></h4>
												</div>
											</div>
											<div class="profile-info-row">
												<div class="profile-info-name text-center"><strong>Service:</strong></div>
												<div class="profile-info-value">
													<span class="label label-sm" resize="none" readonly>{{$demande->Service->nom}}</span>
												</div>
											</div>
											<div class="profile-info-row">
												<div class="profile-info-name text-center"><strong>Etat:</strong></div>
												<div class="profile-info-value"><h4><span class = "label label-lg label-warning">{{ $demande->etat }}</span></h4></div>
											</div>
										</div>	
								</div>						
								</div>{{-- row --}}
							</div>
					  	</td>
			      </tr>
			      <?php $j++ ?>
			      @endforeach
				 		</tbody>
					</table>
					</div><!-- widget-main -->
				</div><!-- widget-body -->
			</div><!-- widget-box	 -->
		</div><!-- widget-container -->
	</div><!-- row -->
	<div class="space-12"></div><div class="hr hr-dotted"></div>
	<div class="row">
		<div class="center col-xs-12">
					<div class="center bottom" style="bottom:0px;">
						<button type="submit" class="btn btn-xs btn-primary btn-space" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
					  <a type="reset" href="/home_dele" class="btn btn-xs btn-danger btn-space" onclick="javascript:document.getElementById('detail_coll').reset();"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</a>
					</div>
				<!-- </div> -->
		</div>
	</div>
</form>	
@endsection