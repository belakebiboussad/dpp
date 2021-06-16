@extends('app_sur')
@section('page-script')
<script type="text/javascript">
	function annulerRDV(elm,line,id)
	{
		row = $(".bodyClass").find('tr').eq(line);
		$.ajax({
			url: '/annullerRDV/'+id,
      type: 'GET', //dataType: 'JSON',
		  success: function (data) { 
		    row.remove();
		  }	
		});
		
	}
</script>
@endsection
@section('main-content')
<form id="form-rdvsHosp" class="form-horizontal" role="form" method="POST" action="#">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="row">
		<div class="col-xs-12 page-header">
			<div class="col-xs-12">
				<h1>Affectation des Lits </h1>
			</div>
		</div><!-- /.page-header -->
	</div>
	<div class="row">
	{{-- <div class="col-xs-12 widget-container-col" id="widget-container-col-1"><br/> --}}
     	<div class="col-xs-12 widget-container-col" id="widget-container-col-12">
     		<div class="widget-box widget-color-blue" id="widget-box-12">
					<div class="widget-header">
					    <h3 class="widget-title bigger lighter">
					      <i class="ace-icon fa fa-table"></i>Liste des admissions :
				      </h3>
					</div>
    		</div>
     	  <div class="widget-body">
				<div class="widget-main no-padding">
				<div class='table_borderWrap'>
				</div>{{-- table_borderWrap --}}
				</div>	{{-- widget-main no-padding --}}
				<table class="table table-striped table-bordered table-hover" id="table1" aria-describedby="table1_info" role="grid">
					<thead class="thin-border-bottom">
				    <tr>
				     	<th hidden></th>
							<th class="center" width="3%" ></th>
							<th class="text-center" width="11%"><h5><strong>Patient</strong></h5></th>
							<th class="text-center" width="15%"><h5><strong>Date RDV</strong></h5></th>
							<th class="text-center" width="10%">Heure RDV</th>
							<th width="12%" class="text-center"><h5><strong>Date Sortie Prévue</strong></h5></th>
							<th class="detail-col text-center"><h5><strong>Heure Sortie Prévue</strong></h5></th>
							<th class="detail-col text-center"><h5><strong>Service</strong></h5></th>
							<th class="detail-col text-center"><h5><strong>Salle</strong></h5></th>
							<th class="detail-col text-center"><h5><strong>Lit</strong></h5></th>
							<th class="detail-col text-center"></th>
		       	</tr>
		      </thead>
        <tbody id ="rendez-VousBody" class="bodyClass">
					<?php $j = 0; ?>
					@foreach( $rdvHospitalisation as $i=>$rdv)
				  <tr>
						<td hidden>{{$j}}</td>	
				           	<td class="center">
					  		<label class="pos-rel">{{-- 1 --}}
								<input type="checkbox" class="ace" name ="valider[]" value ="{{$rdv->id}}" />
								<span class="lbl"></span>   
					   		</label>
						</td>
					
						<td>
					   	  {{$rdv->demandeHospitalisation->consultation->patient->Nom }}
								{{$rdv->demandeHospitalisation->consultation->patient->Prenom }}	
						</td>
						<td>
							<strong>{{ $rdv->date_RDVh }}</strong>
				    </td>
						<td><strong>  {{ $rdv->heure_RDVh }}</strong></td>
					  <td class="center">
							<strong>{{ $rdv->date_Prevu_Sortie }}</strong>
					  </td>
					  <td class="center">
					  	<strong>{{ $rdv->heure_Prevu_Sortie }}</strong>
					  </td>
					  <td><strong>{{ $rdv->bedReservation->lit->salle->service->nom }}</strong></td>
					  <td><strong>{{ $rdv->bedReservation->lit->salle->nom }}</strong></td>
					  <td><strong>{{ $rdv->bedReservation->lit->nom }}</strong></td>
						<td class="center">
							  <a href="{{ route('hospitalisation.edit',$rdv->id) }}" class="btn btn-success btn-xs aaaa"  title= "Affecter un Lit" >
								  		<i class="ace-icon fa fa-bed bigger-120"></i>affecter
	              </a>
	             
	          </td>
	        </tr>			
					@endforeach
		    </tbody>
		  </table>
		</div>	{{-- widget-body --}}
     	{{-- </div> --}}  	{{-- widget-container-col-1 --}}
	</div>	{{-- row --}}
</form>
@endsection