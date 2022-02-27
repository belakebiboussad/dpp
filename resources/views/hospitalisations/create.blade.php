@extends('app')
@section('page-script')
<script>
	function formFill(id)
	{
		$.ajax({
			url : '/admdetail/'+id,
		  type : 'GET',
		  success:function(data,status, xhr){
			  $('#admisDetails').html(data.html);
      },
      error:function(data){
	    	 console.log("error admission details")
	    }	
		});
	}
</script>
@endsection
@section('title') Nouvelle Hospitalisation
@endsection
@section('main-content')
	<div class="row"><h4><strong>Ajouter une hospitalisation</strong></h4>
		<div class="pull-right">
		<a href="{{route('hospitalisation.index')}}" class="btn btn-white btn-info btn-bold">
			<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>Liste des hospitalisations
		</a>
	</div>
	</div>
<div class="row">
	<div class="col-sm-8 col-xs-8">
		<div class="widget-box widget-color-blue">
			<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des admissions du jour</h5></div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
				  	<thead>
							<th class ="center" width="15%"><strong>Patient</strong></th>
							<th class ="center"><strong>Mode d'admission</strong></th>
							<th class ="center"><strong>Service</strong></th>
							<th class ="center"><strong>Médecin traitant</strong></th>
							<th class ="center" width="1%"><strong>Priorité</strong></th>
							<th class ="center"><strong>Observation</strong></th>
							<th class ="center"><strong>Date d'entrée</strong></th>
							<th class ="center"><strong>Date de sortie prévue</strong></th>
							<th class ="center"  width="10%"><em class="fa fa-cog"></em></th>
						</thead>
							<tbody>
							@foreach($adms as $key=>$adm)
							<tr>
								<td>{{ $adm->rdvHosp->demandeHospitalisation->consultation->patient->full_name }}</td>
								<td>
									@switch(  $adm->rdvHosp->demandeHospitalisation->modeAdmission )
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
								<td>{{ $adm->rdvHosp->demandeHospitalisation->Service->nom }}</td>
								<td>{{ $adm->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->full_name }}</td>
								<td>{{ $adm->rdvHosp->demandeHospitalisation->DemeandeColloque->ordre_priorite }}</td>
								<td>{{ $adm->rdvHosp->demandeHospitalisation->DemeandeColloque->observation }}	</td>
								<td>{{ $adm->rdvHosp->date	}}</td>
								<td>{{ $adm->rdvHosp->date_Prevu_Sortie}}	</td>
								<td class ="center">
									<a href="javascript:formFill({{ $adm->id }} );" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter une Hospitalisation"> 
										<i class="menu-icon fa fa-plus"></i>
									</a>
									<a href="{{ route('admission.destroy',$adm->id) }}" class="btn btn-danger btn-xs" data-toggle="tooltip" title="supprimer l'admission" data-method="DELETE" data-confirm="Etes Vous Sur de supprimer l'admission?"><i class="ace-icon fa fa-trash-o"></i>		
									</a>
								</td>		
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>	
			</div>
		</div><!-- widget-box -->
		<br>
		<div class="widget-box widget-color-red">
			<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des admissions d'urgence  du jour</h5></div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
				  	<thead>
							<th class ="center" width="15%"><strong>Patient</strong></th>
							<th class ="center"><strong>Mode d'admission</strong></th>
							<th class ="center"><strong>Service</strong></th>
							<th class ="center"><strong>Date d'entrée</strong></th>
							<th class ="center"><strong>Date de sortie prévue</strong></th>
							<th class ="center" width="10%"><em class="fa fa-cog"></em></th>
						</thead>
						<tbody>
						@foreach($admsUrg as $key=>$adm)
							<tr>
								<td>{{ $adm->demandeHospitalisation->consultation->patient->full_name }}</td>
								<td>
									@switch( $adm->demandeHospitalisation->modeAdmission )
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
								<td>{{ $adm->demandeHospitalisation->Service->nom }}</td>
								<td>{{ date("Y-m-d")	}}</td>
								<td>{{ date("Y-m-d")	}}</td>
								<td class ="center">
									<a href="javascript:formFill({{ $adm->id }} );" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter une Hospitalisation"> 
										<i class="menu-icon fa fa-plus"></i>
									</a>
									<a href="{{ route('admission.destroy',$adm->id) }}" class="btn btn-danger btn-xs" data-toggle="tooltip" title="supprimer l'admission" data-method="DELETE" data-confirm="Etes Vous Sur de supprimer l'admission?"><i class="ace-icon fa fa-trash-o"></i>
								</td>		
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div><!-- widget-box -->
	</div>
	<div class="col-sm-4 col-xs-4" id="admisDetails">
	</div>
</div>	
@endsection