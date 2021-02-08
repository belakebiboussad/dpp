@extends('app_agent_admis')
@section('page-script')
<script type="text/javascript">
	function getSorties(field,value)
	{
		$("#liste_sorties").dataTable().fnDestroy();
	  $.ajax({
          url : '{{URL::to('getSortiesAdmissions')}}',
          data: {    
                 "field":field,
                 "value":value,
        	},
       		dataType: "json",
       		success: function(data) {
       				// $.each(data,function(key,data1){
	        		// 	$.each(data1['demande_hospitalisation'],function(key1,value1){
	        		//  		alert(key1 + ":" + value1);	
	        		// 	})
        			// });

					 	$(".numberResult").html(data.length);
         		var oTable =$("#liste_sorties").DataTable ({
	        		"processing": true,
		          "paging":   true,
		          "destroy": true,
		          "ordering": true,
		          "searching":false,
		          "info" : false,
		          "language":{"url": '/localisation/fr_FR.json'},
		          "data" : data,
		          "columns": [
		          	    { data: "hospitalisation.patient.Nom",
                            render: function ( data, type, row ) {
                                 return row.demande_hospitalisation.consultation.patient.Nom + ' ' + row.demande_hospitalisation.consultation.patient.Prenom;
                            },
                        title:'Patient',"orderable": true
                    },
                    { data : "demande_hospitalisation.service.nom" ,title:'Service',"orderable": true},
                    { data : "hospitalisation.Date_entree" ,title:'Date Entrée',"orderable": true},
                    { data : "demande_hospitalisation.modeAdmission" ,title:'Mode Entrée',"orderable": false},
                    { data : "hospitalisation.Date_Sortie" ,title:'Date Sortie',"orderable": true},
                    { data : "hospitalisation.modeSortie" ,title:'Mode Sortie',"orderable": false},
                    { data : "demande_hospitalisation.bed_affectation.lit.salle.service.nom" ,title:'Service',"orderable": false},                   
		         	],
        	});
        }
    });
	}	
	$("document").ready(function(){
		$(".Exitadd").click(function(e){//cobfirmer sortie patient
			Swal.fire({
                  title: 'Confimer vous  la Sortie du Patient ?',
                  html: '',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Oui',
                  cancelButtonText: "Non",
                }).then((result) => {
                	if(!isEmpty(result.value))
                     {
                     	var adm_id = $(this).val();
                     	$.get('/sortiePatient/'+adm_id, function (data, status, xhr) {
					      $("#adm" + adm_id).remove();
					});
                     }
                })
		});
		$('.filter').change(function(){//rechercher une sortie
			getSorties($(this).attr('id'),$(this).val());
		})
	});
</script>
@endsection
@section('main-content')
<div class="page-content">
	<div class="row panel panel-default">
		<div class="panel-heading left" style="height: 40px; font-size: 2.3vh;">
			<strong>Rechercher les Sorties</strong><div class="pull-right" style ="margin-top: -0.5%;"></div>
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
         		<label class="control-label" for="" ><strong>Date Sortie:</strong></label>
         		<div class="input-group">
  			      <input type="text" id ="Date_Sortie" class="date-picker form-control filter"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd">
  					  <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
    				</div>
		</div>
        </div>	
  		</div>
		</div><!-- onclick = "getAdmissions();" -->
	{{-- 	 <div class="panel-footer" style="height: 50px;">
	   		<button type="submit"name="filter" id="sortiesbtn" class="btn btn-xs btn-primary finoutPatient" style="vertical-align: middle"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
		</div> --}}
	</div><!-- panel -->
	<div class="row"><!-- <div class="col-sm-12"> --><!-- 	</div> -->
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>
					Liste des sorties <b><span id="total_records" class = "badge badge-info numberResult" >{{ count($hospitalistions) }}</span></b>
				</h5>
			</div>
			<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table-bordered table-hover irregular-header table-responsive dataTable" id="liste_sorties" style="width:100%">
	  				<thead class="thin-border-bottom thead-light">
				      	<tr>
					          <th rowspan="2" class="text-center"><h5><strong>Patient</strong></h5></th> 
					          <th rowspan="2" class="text-center"><h5><strong>Service</strong></h5></th>
					          <th rowspan="2" class="text-center"><h5><strong>Date Entrée</strong></h5></th>
					          <th rowspan="2" class="text-center"><h5><strong>Mode Entrée</strong></h5></th>
					          <th rowspan="2" class="text-center"><h5><strong>Date Sortie</strong></h5></th>
					          <th rowspan="2" class="text-center"><h5><strong>Mode Sortie</strong></h5></th>
					          <th colspan="3" scope="colgroup" class="text-center"><h5><strong>Hébergement</strong></h5></th> <!-- merge four columns -->
					          <th rowspan="2" class="text-center"><em class="fa fa-cog"></em></th>	
				      	</tr>
				      	<tr>
				          <th scope="col" class="text-center"><h6><strong>Service</strong></h6></th>
									<th scope="col" class="text-center"><h6><strong>Salle</strong></h6></th>
									<th scope="col" class="text-center"><h6><strong>Lit</strong></h6></th>							
				      		</tr>
	  				</thead>
	  				<tbody>
	  				{{--
	  				@foreach($hospitalistions as $hosp)
	  				<tr id="{{ 'adm'.$hosp->admission->id }}">
							<td>{{ $hosp->patient->Nom }}&nbsp;{{ $hosp->patient->Prenom }}</td>
							<td>{{ $hosp->admission->rdvHosp->demandeHospitalisation->Service->nom }}</td>
							<td><span class ="text-danger"><strong>{{ $hosp->admission->rdvHosp->date_RDVh }}</strong></span></td>
							<td>{{ $hosp->admission->rdvHosp->demandeHospitalisation->modeAdmission }}</td>
							<td><span class ="text-danger"><strong>{{ $hosp->Date_Sortie }}</strong></span></td>
							<td><span class="badge badge-info">{{ $hosp->modeSortie }}</span></td>
						 	@if($hosp->admission->rdvHosp->demandeHospitalisation->bedAffectation)
						 	<td>{{ $hosp->admission->rdvHosp->demandeHospitalisation->bedAffectation->lit->salle->service->nom}}</td>
						 	<td>{{ $hosp->admission->rdvHosp->demandeHospitalisation->bedAffectation->lit->salle->nom }}</td>
						 	<td>{{ $hosp->admission->rdvHosp->demandeHospitalisation->bedAffectation->lit->nom }}</td>
						 	@else
							<td><strong>/</strong></td>
							<td><strong>/</strong></td>
							<td><strong>/</strong></td>
							@endif
							<td class="text-center">
								<button type="button" class="btn btn-info btn-sm Exitadd" value="{{ $hosp->admission->id}}" ><i class="fa fa-check"></i> &nbsp;Efffectuer la Sortie</button>
							</td>
						</tr>
	  				@endforeach
	  				--}}
	  				</tbody>
	  			</table>
	  		</div>
	  		</div>{{-- widget-body --}}
	  	</div> 	{{-- widget-box --}}
	 </div>	 {{-- row --}}
</div>
@endsection