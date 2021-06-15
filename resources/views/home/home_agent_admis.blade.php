@extends('app') {{-- @extends('app_agent_admis') --}}
@section('page-script')
<script type="text/javascript">
  	$("document").ready(function(){
  		$("#getadmsbtn").click(function(e){
		      var op ="";
		      var frag = "<td><strong>/</strong></td><td><strong>/</strong></td><td><strong>/</strong></td>";
		      var dt = new Date();
		      var time = dt.getHours() + ":" + dt.getMinutes();       
		      var filter= new Date($("#currentday").val());
		      url= '{{ route ("rdvHospi.dayRdvsHosp", ":slug") }}';
		      url = url.replace(':slug',$("#currentday").val());
		      $.ajax({
			      url:url,//url: '/getRdvs/'+ $("#currentday").val(),
			      type :'GET',
			      dataType: 'JSON',
			      success:function(result,status, xhr)
			      {
	       	     		var admissions = $('#rdvs').empty();
      	     	          $('#total_records').text(result.length);
			          if(result.length != 0){
			         	     var disabled =(areSameDate(dt, filter))?'':'disabled';
				          for(var i=0; i<result.length; i++){
				        		var forms ="";
				        		if(!isEmpty(result[i]['bed_reservation']))
				    				frag ='<td>'+result[i]['bed_reservation']['lit']['salle']['service'].nom+'</td><td>'+result[i]['bed_reservation']['lit']['salle'].nom+'</td><td>'+result[i]['bed_reservation']['lit'].nom+'</td>'; 
            						forms ='<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-backdrop="false"data-target="#'
		       						+result[i].id+'"'+disabled+'>&nbsp;Confirmer</button>'
		       						+'<div class="modal fade" role="dialog" aria-hidden="true" id="'+result[i].id+'">'
					                    	+'<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'
					                    	+'<button type="button" class="close" data-dismiss="modal">&times;</button>'
					                    	+'<h4 class="modal-title">confirmer l\'entrée du patient:</h4></div>'
					                    	+'<div class="modal-body"><p><span style="color: blue;"><h3><strong>'
					                    	+result[i]['demande_hospitalisation']['consultation']['patient'].Nom +'&nbsp;'
					                    	+ result[i]['demande_hospitalisation']['consultation']['patient'].Prenom
					                    	+'</strong></h3></span></p><br><p><h3>le &quot;<span  style="color: orange;"><strong>'+result[i].date_RDVh
					                    	+'</strong></span>&quot; &nbsp;à &nbsp;<span style="color: red;"><strong>'+time+'</strong></span></h3></p></div>'
					                    	+'<form id="hospitalisation" class="form-horizontal" role="form" method="POST" action="/admission">'
					                    	+'{{ csrf_field() }} <input id="id_RDV" type="text" name="id_RDV" value="'+result[i].id+'" hidden>'
					                    	+'<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">'
					                    	+'<i class="ace-icon fa fa-undo bigger-120"></i>  Annuler</button><button  type="submit" class="btn btn-success">'
					                    	+'<i class="ace-icon fa fa-check bigger-120"></i>Valider</button></div></form></div></div></div>';
		       				op  +='<tr><td style="display: none;">'+result[i].id 
				       		    +'</td><td>'+result[i]['demande_hospitalisation']['consultation']['patient'].Nom
				          		    + ' ' + result[i]['demande_hospitalisation']['consultation']['patient'].Prenom+'</td><td>'
				          		  	+ result[i]['demande_hospitalisation']['service'].nom +'</td><td><span class ="text-danger"><strong>'
				          		  	+ result[i].date_RDVh +'</strong></span></td><td>'
				          		  	+ result[i]['demande_hospitalisation'].modeAdmission +'</td>'+frag
				                  +'<td class="text-center">'+ forms +'</td></tr>';
        				  	}
          				}
          				$('#rdvs').html(op);
       			}
    			});
			if(areSameDate(dt, filter))	//Rechercher les demandes D'urgences
			{
				url= '{{ route ("demandehosp.urg", ":slug") }}';
     				url = url.replace(':slug',$("#currentday").val());
						$.ajax({
	      		 	url: url,
				     type :'GET',
				     dataType: 'JSON',
				     success:function(result,status, xhr)
			       	{
			        		if(result.length != 0){
			        			for(var i=0; i<result.length; i++){
			        				forms ='<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-backdrop="false"data-target="#'
			       						+result[i].id+'">&nbsp;Confirmer</button>'
			       						+'<div class="modal fade" role="dialog" aria-hidden="true" id="'+result[i].id+'">'
						                    	+'<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'
						                    	+'<button type="button" class="close" data-dismiss="modal">&times;</button>'
						                    	+'<h4 class="modal-title">confirmer l\'entrée du patient:</h4></div>'
						                    	+'<div class="modal-body"><p><h3><span style="color: blue;"><strong>'
						                    	+result[i]['consultation']['patient'].Nom +'&nbsp;'
						                    	+ result[i]['consultation']['patient'].Prenom +'</strong></span></h3></p><br><p><h3>le &quot;<span  style="color: orange;"><strong>'
						                    	+result[i]['consultation'].Date_Consultation+'</strong></span>&quot; &nbsp;à &nbsp;<span style="color: red;"><strong>'
						                    	+time+'</strong></span></h3></p></div>'
						                    	+'<form id="hospitalisation" class="form-horizontal" role="form" method="POST" action="/admission">'
						                    	+'{{ csrf_field() }} <input id="id_RDV" type="text" name="id_RDV" value="'+result[i].id+'" hidden>'
						                    	+'<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">'
						                    	+'<i class="ace-icon fa fa-undo bigger-120"></i>  Annuler</button><button  type="submit" class="btn btn-success">'
						                    	+'<i class="ace-icon fa fa-check bigger-120"></i>Valider</button></div></form></div></div></div>';
						                    	+'</div></div></div>';
						   		op  +='<tr><td style="display: none;">'+ result[i].id +'</td><td>'+result[i]['consultation']['patient'].Nom
		       		  				+ ' ' + result[i]['consultation']['patient'].Prenom+'</td><td>'
				          		  		+ result[i]['service'].nom +'</td><td><span class ="text-danger"><strong>'
				          		  		+ result[i]['consultation'].Date_Consultation +'</strong></span></td><td><span class="badge badge-danger">'
				          		  		+ result[i].modeAdmission +'</span></td>'+frag
				                  		+'<td class="text-center">'+ forms +'</td></tr>';
          						}
          						$('#rdvs').html(op);
	        				}
	       			 }
      			});
			}
		});
  });
</script>
@endsection
@section('main-content')
<div class="page-content">
	<div class="row panel panel-default">
		<div class="panel-heading left" style="height: 40px; font-size: 2.3vh;">
			<strong>Rechercher une admission</strong><div class="pull-right" style ="margin-top: -0.5%;"></div>
		</div>
		<div class="panel-body">
			<div class="row">
  			<div class="col-sm-4">
   				<div class="form-group"><label><strong>Etat :</strong></label>
     			 <select id='etat' class="form-control filter" style="width: 200px">
         			<option value="0">En Cours</option>
              <option value="1">Validée</option>
            </select>
   				 </div>		
    		</div>
    		<div class="col-sm-4">
        	<div class="form-group">
         		<label class="control-label" for="currentday" ><strong>Date:</strong></label>
         		<div class="input-group">
  			      <input type="text" id ="currentday" class="date-picker form-control filter"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd">
  					  <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
    				</div>
					</div>
        </div>
		  </div><!-- onclick = "getAdmissions();" -->
		</div>
		<div class="panel-footer" style="height: 50px;">
	   		<button type="submit"name="filter" id="getadmsbtn" class="btn btn-xs btn-primary" style="vertical-align: middle"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
		</div>
	</div><!-- panel -->
	<div class="row"><!-- <div class="col-sm-12"> --><!-- 	</div> -->
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>
					Liste des admissions <b><span id="total_records" class = "badge badge-info numberResult" >{{ count($rdvs) }}</span></b>
				</h5>
			</div>
			<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover irregular-header" id="liste_admissions">
	  				<thead class="thin-border-bottom thead-light">
				      	<tr>
				          <th rowspan="2" class="text-center"><h5><strong>Patient</strong></h5></th> 
				          <th rowspan="2" class="text-center"><h5><strong>Service</strong></h5></th>
				          <th rowspan="2" class="text-center"><h5><strong>Date Entrée</strong></h5></th>
				          <th rowspan="2" class="text-center"><h5><strong>Mode Entrée</strong></h5></th>
				          <th colspan="3" scope="colgroup" class="text-center"><h5><strong>Hébergement</strong></h5></th> <!-- merge four columns -->
				          <th rowspan="2" class="text-center"><em class="fa fa-cog"></em></th>	
				      	</tr>
				      	<tr>
				          <th scope="col" class="text-center"><h6><strong>Service</strong></h6></th>
									<th scope="col" class="text-center"><h6><strong>Salle</strong></h6></th>
									<th scope="col" class="text-center"><h6><strong>Lit</strong></h6></th>							
				      	</tr>
	  				</thead>
	  				<tbody id="rdvs">
	    	  			@foreach($rdvs as $rdv)
					<tr>
						<td>{{ $rdv->demandeHospitalisation->consultation->patient->Nom }}&nbsp;{{ $rdv->demandeHospitalisation->consultation->patient->Prenom }}
						</td>
						<td>{{ $rdv->demandeHospitalisation->Service->nom }}</td>
						<td><span class ="text-danger"><strong>{{ $rdv->date_RDVh }}</strong></span></td>
						<td>{{ $rdv->demandeHospitalisation->modeAdmission }}</td>
						
						@if($rdv->demandeHospitalisation->bedAffectation)
							<td>{{ $rdv->demandeHospitalisation->bedAffectation->lit->salle->service->nom}}</td>
							<td>{{ $rdv->demandeHospitalisation->bedAffectation->lit->salle->nom}}</td>
							<td>{{ $rdv->demandeHospitalisation->bedAffectation->lit->nom}}</td>
						@else
							<td><strong>/</strong></td>
							<td><strong>/</strong></td>
							<td><strong>/</strong></td>
						@endif
						<td class="text-center">
							<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{ $rdv->id }}" @if(!(isset($rdv->demandeHospitalisation->bedAffectation))) disabled @endif><i class="fa fa-check"></i></button>
							@include('admission.modalForm.confirmEntreeProg')
							<a data-toggle="modal" href="#" class ="btn btn-info btn-sm" onclick ="ImprimerEtat('rdv_hospitalisation',{{ $rdv->id }});" data-toggle="tooltip" title="Imprimer un Etat de Sortie" data-placement="bottom"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
						</td>
						</tr>
						@endforeach
						@foreach($demandesUrg as $demande)
						<tr>
							<td>{{ $demande->consultation->patient->Nom }}&nbsp;{{ $demande->consultation->patient->Prenom }}</td>
							<td>{{ $demande->Service->nom }}</td>
							<td><span class ="text-danger"><strong>{{ $demande->consultation->Date_Consultation }}</strong></span></td>
							<td><b><span class="badge badge-danger">{{ $demande->modeAdmission }}</span></td>
							<td>@if(isset($demande->bedAffectation)) {{ $demande->bedAffectation->lit->salle->service->nom}} @else <strong>/</strong> @endif </td>
							<td>@if(isset($demande->bedAffectation)) {{ $demande->bedAffectation->lit->salle->nom}} @else <strong>/</strong> @endif </td>
							<td>@if(isset($demande->bedAffectation)) {{ $demande->bedAffectation->lit->nom}} @else <strong>/</strong> @endif </td>
							<td class="text-center">
								<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{ $demande->id }}" @if(!(isset($demande->bedAffectation))) disabled @endif data-toggle="tooltip" title="valider l'admission" data-placement="bottom">	<i class="fa fa-check"></i></button>	
								@include('admission.modalForm.confirmEntreeUrg')
								<a data-toggle="modal" href="#" class ="btn btn-info btn-sm" onclick ="ImprimerEtat('DemandeHospitalisation',{{ $demande->id }});" data-toggle="tooltip" title="Imprimer un Etat de Sortie" data-placement="bottom"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
							</td>
						</tr>
						@endforeach
	      </tbody>
	      </table>	
				</div>
			</div>
		</div>
  </div>{{-- row --}}
  <div class="row">@include('hospitalisations.ModalFoms.EtatSortie')</div>
</div><!-- page-content -->
@endsection