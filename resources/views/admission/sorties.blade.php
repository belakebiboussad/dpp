@extends('app') 
@section('page-script')
<script type="text/javascript">
	function effectuerSortieAdm(adm_id){
		Swal.fire({
              title: 'Sortie du Patient ?',
              html: '<br/><h4>Confimer vous  la Sortie du Patient ?</h4>',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Oui',
              cancelButtonText: "Non",
              showCloseButton: true
           	}).then((result) => {
            	if(!isEmpty(result.value))
              {
                $.get('/sortiePatient/'+adm_id, function (data, status, xhr) {
			      			$("#adm" + adm_id).remove();
								});
              }
            })
	}
	function getAction(data, type, dataToSet) {
		var actions='';
		if(data.etat != 1) {
			var dateSortie = new Date(data.hospitalisation.Date_Sortie);
		  var dt = new Date();
			actions +='	<button type="button" class="btn btn-info btn-xs '+(areSameDate(dt, dateSortie) ? '' : 'disabled') +'" onclick ="effectuerSortieAdm('+data.id+')" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Efffectuer la Sortie"><i class="fa fa-sign-out" aria-hidden="false"></i></button>';
		}else
			actions +='<a data-toggle="modal" href="#" class ="btn btn-info btn-xs" onclick ="ImprimerEtat(2,\'admission\','+data.id+')" data-toggle="tooltip" title="Imprimer un Etat de Sortie" data-placement="bottom"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';   
		return actions;
	}
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
			          "fnCreatedRow": function( nRow, aData, iDataIndex ) {
			                 $(nRow).attr('id',"adm"+aData.id);
			          	},
			          	"columns": [
			          	    {  data: "hospitalisation.patient.Nom",
	                        		render: function ( data, type, row ) {
	                               		  return row.demande_hospitalisation.consultation.patient.Nom + ' ' + row.demande_hospitalisation.consultation.patient.Prenom;
	                            	},
	                  		      title:'Patient',"orderable": true
	                    		},
		                     { data : "demande_hospitalisation.service.nom" ,title:'Service',"orderable": true},
		                     { data : "hospitalisation.Date_entree" ,title:'Date Entrée',"orderable": true},
		                      { data: "admission.demande_hospitalisation.modeAdmission", 
                                              render: function ( data, type, row ) {    // var mode;
                                                switch(row.demande_hospitalisation.modeAdmission)
                                                {
                                                  case 0: 
                                                    mode ="Programme";
                                                    break;
                                                  case 1: 
                                                   mode ="Ambulatoire";
                                                    break;
                                                  case 2:
                                                   mode ="Urgence";
                                                    break; 
                                                }
                                                var color = (row.demande_hospitalisation.modeAdmission ===  2)  ? 'warning':'primary';
                                                return '<span class="badge badge-pill badge-'+color+'">' + mode +'</span>';
                                            },  title:"Mode Admission","orderable": false 
                                    },
		                      { data : "hospitalisation.Date_Sortie" ,title:'Date Sortie',"orderable": true},
		                      { data : "hospitalisation.modeSortie" ,
		                    		render: function ( data, type, row ) {  //var mode;
                                                   switch(row.hospitalisation.modeSortie)
                                                    {
                                                           case 0: 
                                                                  mode ="Transfert";
                                                                  break;
                                                          case 1: 
                                                                 mode ="Contre avis médical";
                                                                 break;
                                                          case 2:
                                                                 mode ="Décès";
                                                                  break;
                                                           case 2:
                                                                   mode ="Reporter";
                                                                    break;
                                                           default :
                                                                   mode ="Domicile";
                                                                  break;
                                                    }
                                		         return '<span class="badge badge-info">' + mode  +'</span>';
                              		 },
		                    		title:'Mode Sortie',"orderable": false
		                    	},
      		                     { data : "demande_hospitalisation.bed_affectation.lit.salle.service.nom" ,title:'Service',"orderable": false},
      		                     { data : "demande_hospitalisation.bed_affectation.lit.salle.nom" ,title:'Salle',"orderable": false},
      		                     { data : "demande_hospitalisation.bed_affectation.lit.nom" ,title:'Lit',"orderable": false}, 
      		                      { data : getAction ,title:'<em class="fa fa-cog"></em>',"orderable": false,searchable: false},                      
			         	],
			         	"columnDefs": [
			   						{"targets": 9 ,  className: "dt-head-center dt-body-center" },
			   				],
        	});
        }
    });
	}	
  	var field ="etat";  
       $(function(){
             $(document).on('click','.outAdmsFind',function(event){
                    getSorties(field,$('#'+field).val().trim());
            });
       })
</script>
@endsection
@section('main-content')
<div class="page-content">
	<div class="row panel panel-default">
		<div class="panel-heading left">Rechercher une sortie</div>
		
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-4">
     			<div class="form-group"><label><strong>Etat :</strong></label>
         	  <select id='etat' class="form-control filter">
      				<option value="0">En cours</option>
		          <option value="1">Validée</option>
		        </select>
     			</div>		
    		</div>
        <div class="col-sm-4">
        	<div class="form-group">
         		<label class="control-label" for="Date_Sortie">Date sortie:</label>
         		<div class="input-group">
  			      <input type="text" id ="Date_Sortie" class="date-picker form-control filter"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd" autocomplete="off">
  					  <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
    			</div>
		    </div>
        </div>	
  		</div>
		</div>
     <div class="panel-footer">
        <button type="submit" class="btn btn-sm btn-primary outAdmsFind"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
      </div>
	</div><!-- panel -->
	<div class="row">
		<div class="widget-box widget-color-blue">
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
					          <th rowspan="2" class="center">Patient</th> 
					          <th rowspan="2" class="center">Service</th>
					          <th rowspan="2" class="center">Date Entrée</th>
					          <th rowspan="2" class="center">Mode Entrée</th>
					          <th rowspan="2" class="center">Date Sortie</th>
					          <th rowspan="2" class="center"><h5>Mode Sortie</h5></th>
					          <th colspan="3" scope="colgroup" class="center"><h5>Hébergement</h5></th> <!-- merge four columns -->
					          <th rowspan="2" class="center"><em class="fa fa-cog"></em></th>	
				      	</tr>
				      	<tr>
				          <th scope="col" class="center">Service</th>
									<th scope="col" class="center">Salle</th>
									<th scope="col" class="center">Lit</th>							
				      		</tr>
	  				</thead>
	  				<tbody>
	  				@foreach($hospitalistions as $hosp)
	  				<tr id="{{ 'adm'.$hosp->admission->id }}">
							<td>{{ $hosp->patient->full_name }}</td>
							<td>{{ $hosp->admission->demandeHospitalisation->Service->nom }}</td>
							<td><span class ="text-danger"><strong>{{ $hosp->admission->date }}</strong></span></td>
							<td>{{ $hosp->admission->demandeHospitalisation->modeAdmission }}</td>
							<td><span class ="text-danger"><strong>{{ $hosp->Date_Sortie }}</strong></span></td>
							<td><span class="badge badge-info">
                @if(isset($hosp->modeSortie))
                  {{ $hosp->modeSortie }}
                @else
                  Domicile
                @endif
                </span>
              </td>
						 	@if($hosp->admission->demandeHospitalisation->bedAffectation)
						 	<td>{{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->service->nom}}</td>
						 	<td>{{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->nom }}</td>
						 	<td>{{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->nom }}</td>
						 	@else
							<td></td><td></td><td></td>
							@endif
							<td class="center">
								<button type="button" class="btn btn-info btn-xs" onclick ="effectuerSortieAdm({{ $hosp->admission->id }})" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Efffectuer la Sortie">
								<i class="fa fa-sign-out" aria-hidden="false"></i></button>
							</td>
						</tr>
	  				@endforeach
	  				</tbody>
	  			</table>
	  		</div>
	  		</div>{{-- widget-body --}}
	  	</div> 	{{-- widget-box --}}
	 </div>	 {{-- row --}}
	 <div class="row">@include('hospitalisations.ModalFoms.EtatSortie')</div>
</div>
@endsection