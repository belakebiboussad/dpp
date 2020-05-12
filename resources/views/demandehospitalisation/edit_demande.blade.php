@extends('app')
@section('title',"Modifier Demande d'hospitalisation")
@section('main-content')
<div >
	@include('patient._patientInfo')
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
		  	<div class="widget-header">
				<h4 class="widget-title">Consultation :</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-sm-6 col-xs-6 float-right ">
					            <label class="col-sm-4 col-xs-4 control-label no-padding-right text-right" for="lieu">
					              <strong>Lieu:</strong>
					            </label>
					            <div class="col-sm-8 col-xs-8">
					               <input type="text" id="lieu" name="lieu" value= "{{ $demande->consultation->lieu->nom }}" class="col-xs-12 col-sm-12" disabled/>
					           </div>
	          				</div>
					       <div class="col-sm-6 col-xs-6">
					            <label class="col-sm-4 col-xs-4 control-label no-padding-right text-right" for="date">
					              <strong>Date:</strong>
					            </label>
					            <div class="col-sm-8 col-xs-8">
					       	        <input type="text" id="date" name="date" value="{{ $demande->consultation->Date_Consultation }}" class="col-xs-12 col-sm-12" disabled/>
					           </div>
					       </div>
					</div>
					<div class="space-12"></div>
					<div class="row">
						<div class="col-sm-6 col-xs-6">
					            <label class="col-sm-4 col-xs-4 control-label no-padding-right text-right" for="medein">
					              	<strong>Medecin:</strong>
					            </label>
					             <div class="col-sm-8 col-xs-8">
					             	  <input type="text" id="medein" name="medein" value="{{ $demande->consultation->docteur->Nom_Employe }}&nbsp; {{ $demande->consultation->docteur->Prenom_Employe }}" class="col-xs-12 col-sm-12" disabled/>
					             </div>
	         			      </div>
				            <div class="col-sm-6 col-xs-6">
					             <label class="col-sm-4 col-xs-4 control-label no-padding-right text-right" for="motif">
					              	<strong>Motif:</strong>
					             </label>
					             <div class="col-sm-8 col-xs-8">
					            		 <input type="text" id="motif" name="motif" value="{{ $demande->consultation->Motif_Consultation }}" class="col-xs-12 col-sm-12" disabled/>
					             </div>
				          </div>
					</div>
					<div class="space-12"></div>
					<div class="row">
						<div class="col-sm-12 col-xs-12">
							<label class = "col-sm-2 col-xs-2 control-label no-padding-right text-right" for="resume">
					           	   	<strong>reumé:</strong>
					            	</label>			           
					            <div class="col-sm-10 col-xs-10">
					               <input type="text" id="resume" name="resume" value="{{ $demande->consultation->Resume_OBS }}" class="col-xs-12 col-sm-12" disabled/>
					           </div>
				          </div>
	      				</div>
	      				<div class="row">
						<div class="col-sm-12">
							<h3 class="header smaller lighter blue">informations concernant la Demade</h3>
						</div>	
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="widget-box">
							  	<div class="widget-header">
									<h4 class="widget-title">Demande d'hospitalisation :</h4>
								</div>
								<div class="widget-body">
									<div class="widget-main">
										<div class="row">
											<div class="col-sm-6 col-xs-6">
										            <label class="col-sm-4 col-xs-4 control-label no-padding-right text-right" for="mode">
										              	<strong>Mode Admission :</strong>
										            </label>
										             <div class="col-sm-8 col-xs-8">
										             	  <input type="text" id="mode" name="mode" value="{{ $demande->modeAdmission }}" class="col-xs-12 col-sm-12" />
										             </div>
						         			      </div>
						         			      	<div class="col-sm-6 col-xs-6">
										            <label class="col-sm-4 col-xs-4 control-label no-padding-right text-right" for="specialite">
										              	<strong>Specialite :</strong>
										            </label>
										             <div class="col-sm-8 col-xs-8">
										             	  <input type="text" id="specialite" name="specialite" value="{{ $demande->Specialite->nom }}" class="col-xs-12 col-sm-12" />
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
										             	  <input type="text" id="service" name="service" value="{{ $demande->Service->nom }}" class="col-xs-12 col-sm-12" />
										             </div>
						         			      </div>
						         			      <div class="col-sm-6 col-xs-6">
										            <label class="col-sm-4 col-xs-4 control-label no-padding-right text-right" for="etat">
										              	<strong>Etat :</strong>
										            </label>
										             <div class="col-sm-8 col-xs-8">
										             	  <input type="text" id="etat" name="etat" value="{{ $demande->etat }}" class="col-xs-12 col-sm-12" />
										             </div>
						         			      </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box">
		  <div class="widget-header">
				<h4 class="widget-title">Demande Hospitalisation :</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<form method="POST" action="{{ route('demandehosp.update',$demande->id) }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<div class="control-group">
							<label for="motif">
								<strong> Motif Hospitalisation : </strong>
							</label>
							<br/>
							<input type="text" id="motif" name="motif" placeholder="Motif Hospitalisation" value="{{ $demande->motif }}" class="form-control" disabled/>
						</div>
						<br/>
						<div class="control-group">
							<label>
								<strong> Description : </strong>
							</label>
							<br/>
							<textarea id="description" name="description" placeholder="Description" class="form-control" disabled>{{ $demande->description }}</textarea>
						</div>
						<br/>
						
						<div class="control-group">
							<label class="control-label bolder">Degrée D'urgence :</label>
							<div class="radio">
								<label>
									<input name="degreeurg" value="Haut" type="radio" class="ace" {{$demande->degree_urgence =="Haut" ? "checked" : ""}}/>
									<span class="lbl"> Haut</span>
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="degreeurg" value="Moyen" type="radio" class="ace" {{$demande->degree_urgence =="Moyen" ? "checked" : ""}}/>
									<span class="lbl"> Moyen</span>
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="degreeurg" value="Faible" type="radio" class="ace" {{$demande->degree_urgence =="Faible" ? "checked" : ""}}/>
									<span class="lbl"> Faible</span>
								</label>
							</div>
						</div>
						<br/>
						<div>
							<label for="form-field-select-3">
								<strong>Service :</strong>
							</label>
							<br />
							<select class="chosen-select form-control" id="service" name="service" data-placeholder="Choisir Un Service...">
								<option value="{{ $demande->service }}">{{ $demande->service }}</option>
								<option value="Service 1">Service 1</option>
								<option value="Service 2">Service 2</option>
							</select>
						</div>
					</div>	
				</div>
			</div>
			<br/>
			<div class="center">
				<button class="btn btn-info" type="submit">
					<i class="ace-icon fa fa-check bigger-110"></i>
					Submit
				</button>
				&nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="ace-icon fa fa-undo bigger-110"></i>
					Reset
				</button>
			</div>
		</form>
		</div>
	</div>
</div>
@endsection