@extends('app')
@section('page-script')
<script>	
function formFill()
{

}
</script>
@endsection
@section('main-content')
<div class="page-header">
	<h1> Ajouter une Hospitalisation </h1>
</div><!-- /.page-header -->
<div class="space-12"></div>
<div class="row">
	<div class="col-sm-8 col-xs-8">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des Admissions du Jour :</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
				  	<thead>
							<th class ="center" width="15%"><strong>Patient</strong></th>
							<th class ="center"><strong>Mode Admission</strong></th>
							<th class ="center"><strong>Medecin Traitant</strong></th>
							<th class ="center" width="1%"><strong>Priorite</strong></th>
							<th class ="center"><strong>Observation</strong></th>
							<th class ="center"><strong>Date Entrée</strong></th>
							<th class ="center"><strong>date Sortie prévue</strong></th>
							<th class ="center"><em class="fa fa-cog"></em></th>
						</thead>
						<tbody>
							@foreach($adms as $adm)
							<tr>
								<td>{{ $adm->rdvHosp->demandeHospitalisation->consultation->patient->Nom }} {{$adm->rdvHosp->demandeHospitalisation->consultation->patient->Prenom }}</td>
								<td>{{ $adm->rdvHosp->demandeHospitalisation->modeAdmission }}</td>
								<td>{{ $adm->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->Nom_Employe }} {{ $adm->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->Prenom_Employe }}</td>
								<td>{{ $adm->rdvHosp->demandeHospitalisation->DemeandeColloque->ordre_priorite }}</td>
								<td>{{ $adm->rdvHosp->demandeHospitalisation->DemeandeColloque->observation }}	</td>
								<td>{{ $adm->rdvHosp->date_RDVh	}}</td>
								<td>{{ $adm->rdvHosp->date_Prevu_Sortie}}	</td>
								<td>
									<a href="javascript:formFill();" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter une Hospitalisation"> 
											<i class="menu-icon fa fa-plus"></i>
									</a>
									<a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" title="supprimer l'admission" data-method="DELETE" data-confirm="Etes Vous Sur de supprimer l'admission?"> 
											<i class="ace-icon fa fa-trash-o"></i>
									</a>
								</td>		
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!-- col-sm-8  -->
	<div class="col-sm-4 col-xs-4">
		<form class="form-horizontal" role="form" method="POST" action="{{ route('hospitalisation.store') }}">
			{{ csrf_field() }}
			<input type="text" name="id_demande" value="" hidden>
			<div class="row">		
				<div class="form-group">		
						<label class="col-sm-4 control-label no-padding-right" for="motif">
							<strong>Motif d'hospitalisation :</strong>
						</label>
						<div class="col-sm-8 col-xs-8">
							<input type="text" id="motif" name="motifhos" placeholder="Motif De L'hospitalisation" value="" class="col-xs-12 col-sm-12" disabled/>
						</div>
				</div>
			</div>
			<div class="row">	
				<div class="form-group">
					<label class="col-sm-4 col-xs-4 control-label no-padding-right" for="date">
				 		<strong> Date Hospitalisation :</strong>
					</label>
					<div class="col-sm-8 col-xs-8">
						<input class="col-xs-12 col-sm-12 date-picker" id="date" name="date" type="text" placeholder="Date Hospitalisation" data-date-format="yyyy-mm-dd" readonly/>
					</div>				
				</div>
			</div>
			<div class="row">
				<div class="form-group">
				<label class="col-sm-4 col-xs-4 control-label no-padding-right" for="date">
				 	<strong>Date Sortie Prévue :</strong>
			  </label>
				<div class="col-sm-8 col-xs-8">
					<input class="col-xs-12 col-sm-12 date-picker" id="dateprevu" name="dateprevu" type="text" placeholder="Date Prévue Pour Sortir" data-date-format="yyyy-mm-dd" />
				</div>
			</div>
			</div>			
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-right" for="motif">
					<strong>Motif d'hospitalisation :</strong>
				</label>
				<div class="col-sm-8 col-xs-8">
					<input type="text" id="motif" name="motifhos" placeholder="Motif De L'hospitalisation" value="" class="col-xs-12 col-sm-12" disabled/>
				</div>
			</div>
			<div class="col-md-offset-3 col-md-9">
				<button class="btn btn-info" type="submit">
					<i class="ace-icon fa fa-check bigger-110"></i>Enregistrer
				</button>&nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="ace-icon fa fa-undo bigger-110"></i>Annuler
				</button>
			</div>
		</form>
	</div><!-- col-sm-4 -->
</div>
@endsection