@extends('app_sur')
@section('page-script')
<script type="text/javascript">
	function annulerRDV(elm,line,id)
	{
		 row = $(".bodyClass").find('tr').eq(line);
		$.ajax({
			url: '/annullerRDV/'+id,
                    		type: 'GET',
                    		//dataType: 'JSON',
		           success: function (data) { 
		                    	 //$(".writeinfo").append(data.msg); 
		                     	
		               }	
		});
		
	}
</script>
@endsection
@section('main-content')
<form id="form-rdvsHosp" class="form-horizontal" role="form" method="POST" action="#">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	{{-- route('HospitalisationController.update') --}}
	<div class="row">
		<div class="col-xs-12 page-header">
			<div class="col-xs-12">
				<h1>Liste des Rendez-Vous d'Hospitalisation </h1>
			</div>
		</div><!-- /.page-header -->
	</div>
	<div class="row">
	{{-- <div class="col-xs-12 widget-container-col" id="widget-container-col-1"><br/> --}}
     	<div class="col-xs-12 widget-container-col" id="widget-container-col-12">
     		<div class="widget-box widget-color-blue" id="widget-box-12">
		<div class="widget-header">
		    <h3 class="widget-title bigger lighter">
		      <i class="ace-icon fa fa-table"></i>
			Liste des Rendez-Vous d'Hospitalisation :
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
				<th  class="center" width="3%" ></th>
				<th class="text-center" width="11%"><h5><strong>Patient</strong></h5></th>
				<th class="text-center"  width="10%"><h5><strong>Date Demande</strong></h5></th>
				<th class="text-center" width="10%"><h5><strong>Medcin traitant</strong></h5></th>
			            	<th width="12%" class="text-center"><h5><strong>Priorité</strong></h5></th>
				<th class="font-weight-bold text-center"><h5><strong>Observation</strong></h5></th>
				<th>Date Rendez-Vous</th>
				<th>Lit</th>
				<th>Salle</th>
				<th class="detail-col  text-center"><h5> <strong>Actions</strong></h5></th>
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
					<td >{{ $rdv->Nom}} {{$rdv->Prenom }}</td>
					<td>{{ $rdv->Date_Consultation }}</td>
					<td>{{ $rdv->Nom_Employe}} {{$rdv->Prenom_Employe }}</td>
					<td  class="center">{{ $rdv->ordre_priorite }}</td>
					<td> {{  $rdv->observation }}</td>
					<td><strong>{{ $rdv->date_RDVh }} {{ $rdv->heure_RDVh }}</strong></td>
					<td class="center"><strong>{{ $rdv->id_lit }}</strong></td>
					<td><strong>{{ $rdv->nomsalle }}</strong></td>
					<td>
						 <a href="/admission/reporter/{{$rdv->idRDV}}" class="btn btn-success btn-xs aaaa"  title= "Reporer RDV" >
							 <i class="menu-icon fa fa-clock-o fa-lg"></i>&nbsp;Reporter
                              				</a>
                              				 <a href="#" class="btn btn-danger btn-xs aaaa"  title= "Reporer RDV"  onclick= "annulerRDV(this,{{ $j }},{{$rdv->idRDV}});">
							 <i class="ace-icon fa fa-close" ></i>Annuler RDV
                              				</a>
                              			</td>
                              		</tr>			
				@endforeach
		             <tr>
		            </table>

		</div>	{{-- widget-body --}}
     	{{-- </div> --}}  	{{-- widget-container-col-1 --}}
	</div>	{{-- row --}}
</form>
@endsection