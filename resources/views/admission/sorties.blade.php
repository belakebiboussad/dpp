@extends('app_agent_admis')
@section('page-script')
<script type="text/javascript">
	$("document").ready(function(){
		$("#Exitadd").click(function(e){
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
				<div class="col-md-8 col-sm-8 col-xs-8">
  			  	<div class="col-sm-3 col-xs-3 "><label class="control-label center" for="" ><strong>Date :</strong></label></div>
	        		<div class="input-group col-sm-5 col-xs-5">
					<input type="text" id ="currentday" class="col-xs-12 col-sm-12 date-picker form-control"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd">
					<div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
    				</div>
  				</div><div class="col-md-2 col-sm-2 col-xs-2"></div>
  			</div>
		</div><!-- onclick = "getAdmissions();" -->
		 <div class="panel-footer" style="height: 50px;">
	   		<button type="submit"name="filter" id="sortiesbtn" class="btn btn-xs btn-primary finoutPatient" style="vertical-align: middle" disabled><i class="fa fa-search"></i>&nbsp;Rechercher</button>
		</div>
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
				<table class="table table-striped table-bordered table-hover irregular-header" id="liste_admissions">
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
	  				<tbody id="sorties">
	  				@foreach($hospitalistions as $hosp)
	  				<tr id="{{ 'adm'.$hosp->admission->id }}">
						<td>{{ $hosp->patient->Nom }}&nbsp;{{ $hosp->patient->Prenom }}</td>
						<td>{{ $hosp->admission->rdvHosp->demandeHospitalisation->Service->nom }}</td>
						<td><span class ="text-danger"><strong>{{ $hosp->admission->rdvHosp->date_RDVh }}</strong></span></td>
						<td>{{ $hosp->admission->rdvHosp->demandeHospitalisation->modeAdmission }}</td>
						<td><span class ="text-danger"><strong>{{ $hosp->Date_Sortie }}</strong></span></td>
						<td><span class="badge badge-info numberResult">{{ $hosp->modeSortie }}</span></td>
						<td>
						@if($hosp->admission->rdvHosp->bedReservation)
							{{ $hosp->admission->rdvHosp->bedReservation->lit->salle->service->nom}}
						@else
							<strong>/</strong>
						@endif
						</td>
						<td>
						@if($hosp->admission->rdvHosp->bedReservation) 
							{{ $hosp->admission->rdvHosp->bedReservation->lit->salle->nom}} @else <strong>/</strong>
						@endif
						</td>
						<td>
						@if($hosp->admission->rdvHosp->bedReservation) 
							{{ $hosp->admission->rdvHosp->bedReservation->lit->nom}} 
						@else
							<strong>/</strong>
						@endif
						</td>
						<td class="text-center">
							<button type="button" class="btn btn-info btn-sm" id="Exitadd" value="{{ $hosp->admission->id}}" ><i class="fa fa-check"></i> &nbsp;Efffectuer la Sortie</button>
						</td>
					</tr>
	  				@endforeach
	  				</tbody>
	  			</table>
	  		</div>
	  		</div>{{-- widget-body --}}
	  	</div> 	{{-- widget-box --}}
	 </div>	 {{-- row --}}
</div>
@endsection