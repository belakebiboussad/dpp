@extends('app_dele')
@section('title','Colloque')
@section('page-script')
<script>
  $(document).ready(function(){
	  $(".med").change(function(){
	    $(this).next().remove();
	  });
  });
	var selectDemande =function(elm,line,id){
		var  select = $("#" + line).find("select");//row = $(".bodyClass").find('tr').eq(line);
		if (select.val() == null) {
		  if (!$(".red")[0]){// Do something if class exists
	    	select.after('<div class="red">Sélectionner un Medecin</div>'); 
			}  
	  }else {
	  	  var medecin = $("#" + line).find('[name=medecin]').val();
			  var observation = $("#" + line).find('[name=observation]').val();
			  var prop =  $("#" + line).find('[name=prop]:checked').val();
			  var demandeId = $("#" + line).find('[name=demandeId]').val();
				var id = $("#" + line).find('[name=demandeId]').val();
			  var colloqueId =$("#colloqueId").val();
			 
	  }

	}
</script>
@endsection
@section('main-content')
<div class="row">
	<div class="col-xs-12 page-header">
		<div class="col-xs-12">
			<h1>			
					Déroulement du Colloque <strong> {{ $colloque->type->type }} </strong> de la semaine du  &quot;<?php 
					$d=$colloque->date_colloque.' monday next week';
					echo(date('d M Y',strtotime($d)-1));
					?>&quot;
				</h1>
			</div>
		</div><!-- /.page-header -->
</div>
<div class="row">
<div class="col-xs-12 widget-container-col" id="widget-container-col-1"><br/>
     <div class="col-xs-12 widget-container-col" id="widget-container-col-12">
	<div class="widget-box widget-color-blue" id="widget-box-12">
		<div class="widget-header">
		  <h3 class="widget-title bigger lighter">
		    <i class="ace-icon fa fa-table"></i>Liste des Demandes d'Hospitalisation :
	    </h3>
	    <input type="hidden" id ="colloqueId" value ="{{ $colloque->id}}">
		</div>
		<div class="widget-body">
		  <div class="widget-main no-padding">
			  <div class='table_borderWrap'>
			    <table class="table table-striped table-bordered table-hover" id="table1" aria-describedby="table1_info" role="grid">
			      <thead class="thin-border-bottom">
		       		<tr>
							<!-- 	<th  class="center" width="3%"></th> -->
		      			<th class="text-center" width="11%"><h5><strong>Patient</strong></h5></th>
								<th class="text-center" width="10%"><h5><strong class="text-center">Spécialité</strong></h5></th>
								<th class="text-center"  width="10%"><h5><strong>Date Demande</strong></h5></th>
								<th class="text-center" width="12%"><h5><strong>Medcin traitant</strong></h5></th>
			    			<th width="10%" class="text-center"><h5><strong>Priorité</strong></h5></th>
								<th class="font-weight-bold text-center"><h5><strong>Observation</strong></h5></th>
								<th class="detail-col  text-center"></th>
							</tr>
						</thead>
				 		<tbody id ="demandesBody" class="bodyClass">
				 		<?php $j = 0; ?>
						@foreach( $demandes as $i=>$demande)
		    		<tr id= "{{$j}}">
			  			<td hidden> <input type="hidden" name="demandeId" value="{{ $demande->id}}"/></td>	
			  			<td>{{ $demande->consultation->patient->Nom }} {{ $demande->consultation->patient->Prenom }}</td>	
							<td>{{ $demande->Specialite->nom }}</td>
						 	<td>{{$demande->consultation->Date_Consultation }}</td>
							<td>
								<select id="medecin" name = "medecin" class ="med" data-placeholder = "selectionnez le medecin traitant..." class ="selectpicker show-menu-arrow place_holder col-sm-12">
									<option value="0" selected disabled>selectionnez... </option>
									@foreach ($medecins as $medecin)
									<option value="{{ $medecin->employ->id }}">
											{{ $medecin->employ->Nom_Employe }} 
						          {{ $medecin->employ->Prenom_Employe }}
									</option>
									@endforeach
							</select>
						</td>
			      <td>
			        <div class="funkyradio btn-group col-sm-12" data-toggle="radio">
						 		<label for="prop"><input type="radio"  class="radioM" name="prop" id="prop1" value="1"/>1</label>&nbsp;&nbsp;
								<label for="prop"><input type="radio"  class="radioM" name="prop" id="prop2" value="2" checked/>2</label>&nbsp;&nbsp;
	              <label for="prop"><input type="radio"  class="radioM" name="prop" id="prop3" value="3" />3</label>
					  	</div>
				    </td>
				    <td>
				    	<textarea class="width-100" resize="none" name="observation"></textarea>
				    </td>
				    <td>
					    <a href="#" class="green btn-lg show-details-btn" title="Show Details" data-toggle="collapse"  id="{{$i}}" data-target=".{{$i}}collapsed" >
					    	<i class="fa fa-eye-slash" aria-hidden="true"></i><span class="sr-only">Details</span>
					    </a>
					    <a href="#" class="btn btn-success btn-xs aaaa"  title= "Valider demande"	onclick= "selectDemande(this,{{ $j }},{{$demande->id}});"><i class="ace-icon fa fa-check" ></i> Valider</a>     
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
										<div class="profile-info-value">
											  <span>{{Jenssegers\Date\Date::parse($demande->consultation->patient->Dat_Naissance)->age }} ans</span>
										</div>
									</div>
									<div class="profile-info-row">
								<div class="profile-info-name text-center"><strong>Groupe Sanguin:</strong></div>
								<div class="profile-info-value">
         	 							<h4>
         	 								<span class="label label-lg label-inverse arrowed-in">
         	 								{{ $demande->consultation->patient->group_sang }}
         	 								{{ $demande->consultation->patient->rhesus }}</span>
         	 							</h4>
						 		</div>
								</div>
								<div class="profile-info-row">
								<div class="profile-info-name text-center"><strong>Etablie par Dr:</strong></div>
								<div class="profile-info-value">
									<span>{{ $demande->consultation->docteur->Nom_Employe }}
								 	{{ $demande->consultation->docteur->Prenom_Employe }}
					  				</span>
								</div>
								</div>
								<div class="profile-info-row">
								<div class="profile-info-name text-center"> <strong>Service:</strong></div>
								<div class="profile-info-value">
									<span>{{$demande->Service->nom }}</span>
								</div>
								</div>
							</div>	{{-- profile-user-info-striped --}}
				        		</div>{{-- col-xs-6 col-sm-6 --}}
					<div class="col-xs-6 col-sm-6">
					<div class="space visible-xs"></div>
					<div class="profile-user-info profile-user-info-striped">
						<div class="profile-info-row">
							<div class="profile-info-name text-center"><strong>Mode Admission:</strong></div>
							<div class="profile-info-value"><h4><span class = "label label-lg label-success">{{$demande->modeAdmission }}</span></h4>
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
							<div class="profile-info-value"><h4><span class = "label label-lg label-warning">{{ $demande->etat }}</span></h4>
							</div>
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
	      </div>
	</div>
	 </div>
	</div>	{{-- widget-color-blue --}}
    </div>{{-- widget-container-col-2 --}}
</div>{{-- widget-container-col-1 --}}
</div>{{-- row --}}

@endsection
