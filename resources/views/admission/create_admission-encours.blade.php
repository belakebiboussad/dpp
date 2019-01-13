@extends('app_sur')
@section('page-script')
<script type="text/javascript">
	$('document').ready(function(){
		$('.timepicker').timepicker();	
	})
	
</script>
@endsection
@section('main-content')
	<?php $services= array();
	$services=array_values($services);	
	$salles= array();
	$salles=array_values($salles);								
	foreach ($lits as $lit) {
		    if (!array_key_exists($lit->id_salle, $salles)) 
				{
					$salles[$lit->id_salle]=$lit->nom_salle;
					}
			if (!array_key_exists($lit->id_service, $services)) 
				{
					$services[$lit->id_service]=$lit->nom_service;
					}

			}?>
	@foreach($demande as $demandes)
		<div class="page-header">
			<h1>
				Ajouter Un RDV Hospitalisation pour   <strong>&laquo;{{$demandes->Nom}} {{$demandes->Prenom}}&raquo;</strong>
			</h1>
		</div><!-- /.page-header -->
		<div class="row">
			<div class="col-xs-12">
				<form class="form-horizontal" role="form" method="POST" action="{{ route('admission.store') }}">
					{{ csrf_field() }}
					<input type="text" name="id_demande" value="{{$demandes->id_demande}}" hidden>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="service">
							<strong> 
								Service :
							</strong>
						</label>
						<div class="col-sm-9">
							<input type="text" id="service" name="service" placeholder="Motif De L'hospitalisation" value="{{ $demandes->nomService }}" class="col-xs-10 col-sm-5" disabled/>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="motif">
							<strong> 
								Motif De L'hospitalisation :
							</strong>
						</label>
						<div class="col-sm-9">
							<input type="text" id="motif" name="motifhos" placeholder="Motif De L'hospitalisation" value="{{ $demandes->motif }}" class="col-xs-10 col-sm-5" disabled/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="priorite">
							<strong> Priorité :</strong>
						</label>
						<div class="control-group">
							&nbsp; &nbsp;
							<label>
								<input name="priorite" class="ace" type="radio" value="1" disabled @if($demandes->ordre_priorite==1)checked="checked"@endif >
								<span class="lbl"> 1 </span>
							</label>&nbsp; &nbsp;
							<label>
								<input name="priorite" class="ace" type="radio" value="2" disabled @if($demandes->ordre_priorite==2)checked="checked"@endif>
								<span class="lbl"> 2 </span>
							</label>&nbsp; &nbsp;
							<label>
								<input name="priorite" class="ace" type="radio" value="3" disabled @if($demandes->ordre_priorite==3)checked="checked"@endif>
								<span class="lbl"> 3 </span>
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="motif">
							<strong>observation :</strong>
						</label>
						<div class="col-sm-9">
							<input type="text" id="motif" name="motifhos" placeholder="Motif De L'hospitalisation" value="{{$demandes->observation}}" class="col-xs-10 col-sm-5" disabled/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="date">
						 	<strong> Date prévue d'hospitalisation : 
							</strong>
						</label>
						<div class="col-sm-9">
							<input class="col-xs-5 col-sm-5 date-picker" id="date" name="date" type="text" placeholder="Date prévue d'hospitalisation" data-date-format="yyyy-mm-dd" required />
							<button class="btn btn-sm" onclick="$('#date').focus()">
								<i class="fa fa-calendar"></i>
							 </button>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="heure_rdvh">
						 	<strong> Heure Prévue d'hospitalisation :</strong>
						</label>
						{{-- style="width: 350px" --}}
						<div class="input-group col-sm-8  timepicker" style ="width:32%">	
							<input id="heure_rdvh" name="heure_rdvh" class="form-control" type="text"  required>
							<span class="input-group-addon">
								<i class="fa fa-clock-o bigger-110"></i>
							</span>						
						</div>
					</div>
					<div class="form-group">
						<input id="basicExample" type="text" class="time ui-timepicker-input" autocomplete="off">
					</div>
				
                                	
			</form>
			</div>{{-- col-xs-12 --}}
		</div>	{{-- row --}}
	@endforeach
@endsection
