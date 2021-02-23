@extends('app')
@section('title',"Modifier Demande d'hospitalisation")
@section('main-content')
<div >
	<?php $patient = $demande->consultation->patient; ?>
	@include('patient._patientInfo',$patient)
</div>
<div class="page-header">
	<h1 style="display: inline;">modification la demande d'hospitalisation</h1>
	<div class="pull-right">
    <a href="{{route('demandehosp.index')}}" class="btn btn-white btn-info btn-bold">
      <i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>liste des Demandes 'hospitalisation'
    </a>
  </div>
</div>
<div class="row">
	<div class="col-sm-12">
		<h3 class="header smaller lighter blue">informations concernant Consultation</h3>
	</div>	
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box">
		  <div class="widget-header"><h4 class="widget-title">Consultation :</h4></div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-sm-6 col-xs-6 float-right ">
					    <label class="col-sm-4 col-xs-4 control-label no-padding-right text-right" for="lieu"><strong>Lieu:</strong></label>
					    <div class="col-sm-8 col-xs-8">
	            	<input type="text" id="lieu" name="lieu" value= "{{ $demande->consultation->lieu->nom }}" class="col-xs-12 col-sm-12" disabled/>
	           	</div>
	         	</div>
					  <div class="col-sm-6 col-xs-6">
					    <label class="col-sm-4 col-xs-4 control-label no-padding-right text-right" for="date"><strong>Date:</strong></label>
			        <div class="col-sm-8 col-xs-8">
				        <input type="text" id="date" name="date" value="{{ $demande->consultation->Date_Consultation }}" class="col-xs-12 col-sm-12" disabled/>
				     	</div>
				    </div>
					</div>
					<div class="space-12"></div>
					<div class="row">
						<div class="col-sm-6 col-xs-6">
					    <label class="col-sm-4 col-xs-4 control-label no-padding-right text-right" for="medein"><strong>Medecin:</strong></label>
					    <div class="col-sm-8 col-xs-8">
					   	  <input type="text" id="medein" name="medein" value="{{ $demande->consultation->docteur->nom }}&nbsp; {{ $demande->consultation->docteur->prenom }}" class="col-xs-12 col-sm-12" disabled/>
					    </div>
	          </div>
				    <div class="col-sm-6 col-xs-6">
					    <label class="col-sm-4 col-xs-4 control-label no-padding-right text-right" for="motif"><strong>Motif:</strong></label>
					    <div class="col-sm-8 col-xs-8">
					    	 <input type="text" id="motif" name="motif" value="{{ $demande->consultation->motif }}" class="col-xs-12 col-sm-12" disabled/>
					    </div>
				    </div>
					</div>
					<div class="space-12"></div>
					<div class="row">
						<div class="col-sm-12 col-xs-12">
							<label class = "col-sm-2 col-xs-2 control-label no-padding-right text-right" for="resume"><strong>reumé:</strong></label>
           	  <div class="col-sm-10 col-xs-10">
					     <input type="text" id="resume" name="resume" value="{{ $demande->consultation->Resume_OBS }}" class="col-xs-12 col-sm-12" disabled/>
					    </div>
						</div>
	      	</div>
	     		<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">informations concernant la Demade</h3></div></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="widget-box">
							  <div class="widget-header"><h4 class="widget-title">Demande d'hospitalisation :</h4></div>
								<div class="widget-body">
									<div class="widget-main">
										<form method="POST" action="{{ route('demandehosp.update',$demande->id) }}">
										{{ csrf_field() }}
										{{ method_field('PUT') }}
										<div class="row">
											<div class="col-sm-6 col-xs-6">
										    <label class="col-sm-4 col-xs-4 control-label no-padding-right text-right" for="mode">
										      <strong>Mode Admission :</strong>
										    </label>
										    <div class="col-sm-8 col-xs-8">
						             	<select class="form-control" id="mode" name="mode" class="col-xs-12 col-sm-12">
						              	<option value="0">Sélectionner le mode d'admission...</option>
											    	@foreach($modesAdmission as $mode)
													 	<option value="{{ $mode}}" @if($demande->modeAdmission == $mode ) selected @endif>{{ $mode }}</option>
														@endforeach    
						              </select> 
						            </div>
		         			   	</div>
							        <div class="col-sm-6 col-xs-6">
											  <label class="col-sm-4 col-xs-4 control-label no-padding-right text-right" for="specialiteDemande"><strong>Specialite :</strong></label>
											  <div class="col-sm-8 col-xs-8"> 	 
						   						<select class="form-control" id="specialite" name="specialite" class="col-xs-12 col-sm-12">
												    <option value="0">Sélectionner la spécialité...</option>
												    @foreach($specialites as $specialite)
												   	<option value="{{ $specialite->id}}" @if($demande->specialite == $specialite->id ) selected @endif>{{ $specialite->nom }}</option>
												    @endforeach 
												  </select>
								  			</div>
							        </div>
										</div>
										<div class="space-12"></div>
										<div class="row">
											<div class="col-sm-6 col-xs-6">
										    <label class="col-sm-4 col-xs-4 control-label no-padding-right text-right" for="service">
										      <strong>Service :</strong>
										    </label>
										    <div class="col-sm-8 col-xs-8">
										    	<select class="form-control" id="service" name="service" class="col-xs-12 col-sm-12">
												    <option value="">Sélectionner le service...</option>
												    @foreach($services as $service)
												    <option value="{{ $service->id }}" @if($demande->service == $service->id) selected @endif >{{ $service->nom }}</option>
												    @endforeach     
													</select>
										    </div>
							      	</div>
						          <div class="col-sm-6 col-xs-6">
										    <label class="col-sm-4 col-xs-4 control-label no-padding-right text-right" for="etat"><strong>Etat :</strong></label>
										    <div class="col-sm-8 col-xs-8">
									        <input type="text" id="etat" name="etat" value="{{ $demande->etat }}" class="col-xs-12 col-sm-12" />
									      </div>
						         	</div>
										</div>
									</div>
								</div><!-- widget-body -->
							</div>
						</div>
					</div><!-- row -->
					<div class="space-12"></div>
					<div class="row center">
						<button class="btn btn-info" type="submit">	<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
						<button class="btn" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
					</div>
					</form>
				</div>
			</div><!-- widget-body -->
		</div><!-- widget-box -->
	</div>
</div>
@endsection