@extends('app_dele')
@section('title','Colloque')
@section('page-script')
<script type="text/javascript">
var selectDemande =function(elm,line,id){
	row = $(".bodyClass").find('tr').eq(line); 
	var  select =  row.find("select");
	if (select.val() == null) {
	  //select.attr('required', true);
	  if ($(".red")[0]){
    		// Do something if class exists
		} else {
    		select.after('<div class="red">Sélectionner un Medecin</div>'); 
		}  
  }else{
    checkbox = row.find("input[type=checkbox]");
		row.find('select,textarea,input[type="radio"]:not(:checked)').each(function(){
			$(this).attr('disabled', true);	//$(this).attr('disabled', !(checkbox.is(':checked')));
		});
		select.next().remove();	
		if(!(checkbox.is(':checked')))
		{
		  $(elm).html('<i class="fa fa-close" style="font-size:14px"></i> Annuler');
	 	  $(elm).removeClass("btn-success").addClass("btn-danger");
		} 
		else
		{
		  $(elm).html('<i class="ace-icon fa fa-check"></i>Valider');
		  $(elm).removeClass("btn-danger").addClass("btn-success"); 
		  row.find('select,textarea,input[type="radio"]:not(:checked)').each(function(){
				$(this).attr('disabled', false);
		  });
	    row.find('textarea').val("");
	    select.prop('selectedIndex',0).change();
		}
		checkbox.prop('checked', !(checkbox.is(':checked')));	
  }
}//endFunction
$('document').ready(function(){
 	$( "#detail_coll" ).submit(function( event ) {
 		jQuery(this).find(':disabled').removeAttr('disabled'); 
 	});
});
//jQuery(function() { //  $('#detail_coll').bind('submit', function() { //    jQuery(this).find(':disabled').removeAttr('disabled');	// });   
</script>
@endsection
@section('main-content')
<!-- {{route('colloque.update',$colloque->id)}} -->
<!-- role="form" -->
<form id="detail_coll" class="form-horizontal" method="POST" action="/savecolloque/{{ $colloque->id }}">
	{{ csrf_field() }}
	<!-- {{ method_field('PUT') }} -->
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
		</div>
		<div class="widget-body">
		             <div class="widget-main no-padding">
			<div class='table_borderWrap'>
			<table class="table table-striped table-bordered table-hover" id="table1" aria-describedby="table1_info" role="grid">
			             <thead class="thin-border-bottom">
		          		<tr>
		             		<th hidden></th>
					<th  class="center" width="3%"></th>
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
		    <tr>
			  		<td hidden>{{$j}}</td>	
			  		<td class="center">
					  		<label class="pos-rel">{{-- 1 --}}
								<input type="checkbox" class="ace" name ="valider[]" value ="{{$demande->id}}"/>
								<span class="lbl"></span>   
				  		  </label>
						</td>
						<td>{{ $demande->consultation->patient->Nom }} 
						        {{ $demande->consultation->patient->Prenom }}
						 </td>	
						<td>{{ $demande->Specialite->nom }}</td>
						 <td>{{$demande->consultation->Date_Consultation }}</td>
						<td>
							<select id="MedT" name = "MedT{{$demande->id}}" data-placeholder = "selectionnez le medecin traitant..." class ="selectpicker show-menu-arrow place_holder col-sm-12">
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
			      <!-- class="radioM" -->
			        <div class="funkyradio btn-group col-sm-12" data-toggle="radio">
						 		<label for="{{$i}}p1"><input type="radio"  class="radioM" name="prop{{$demande->id}}" id="{{$i}}p1"  value="1"/>1</label>&nbsp;&nbsp;
								<label for="{{$i}}p2"><input type="radio"  class="radioM" name="prop{{$demande->id}}" id="{{$i}}p2" value="2" checked/>2</label>&nbsp;&nbsp;
	              <label for="{{$i}}p3"><input type="radio"  class="radioM" name="prop{{$demande->id}}" id="{{$i}}3" value="3" />3</label>
					  	</div>
				    </td>
				    <td>
				    	<textarea class="width-100" resize="none" name="observation{{$demande->id}}"></textarea>
				    </td>
				    <td>
					        		<a href="#" class="green btn-lg show-details-btn" title="Show Details" data-toggle="collapse"  id="{{$i}}" data-target=".{{$i}}collapsed" >
					          			<i class="fa fa-eye-slash" aria-hidden="true"></i>
					          			<span class="sr-only">Details</span>
					        		</a>
					        		<a href="#" class="btn btn-success btn-xs aaaa" title= "Valider demande"	onclick= "selectDemande(this,{{ $j }},{{$demande->id}});"><i class="ace-icon fa fa-check" ></i> Valider</a>     
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
<div class="space-12"></div>
<div class="space-12"></div>
<div class="row">
	<div class="col-xs-12">
		<!-- <div class="col-md-offset-9 col-md-9"> -->	
		<div class="col-md-12">
	<!-- 		<div calss ="btn-toolbar">
					<button class="btn btn-info btn-sm pull-right" type="submit"  id="validButton">
							<i class="ace-icon fa fa-save bigger-110"></i>
					    Enregistrer
					</button>;
					<button class="btn btn-danger btn-sm pull-right" type="reset">
							<i class="ace-icon fa fa-undo bigger-110"></i>
							Annuler
					</button>
			</div> -->
			<div class="col-md-8"> </div>
			<div class="col-md-4">
				<div class="form-group row pull-right">
					    <button type="submit" class="btn btn-primary btn-space" type="submit"id="validButton">
				       		<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
				  		</button>
				  		<button type="reset" class="btn btn-danger btn-space"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler
				 			</button>
				   
				</div>
			</div>
		</div>
	</div>	
</div>
{{-- row --}} 
</form>	
@endsection
