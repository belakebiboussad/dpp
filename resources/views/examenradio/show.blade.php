@extends('app')
@section('main-content')
<div class="row" width="100%">@include('patient._patientInfo')</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-5"><h3> Détails de la demande radiologique</h3></div>
    <div class="col-sm-7 pull-right">
      <a href="/drToPDF/{{ $demande->consultation->examensradiologiques->id }}" target="_blank" class="btn btn-sm btn-primary pull-right"> <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer
      </a>&nbsp;&nbsp;
      <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
    </div>
  </div><hr>
  <div class="space-12 hidden-xs"></div><div class="space-12 hidden-xs"></div>
	<div class="row no-gutters">
	  <div class="col-lg-6">
			<div class="row">
			  <div class="col-xs-12 col-sm-12">
			    <div class="col-sm-6"><label class="control-label pull-right"><b>Date :</b></label></div>
			    <div class="form-group col-sm-6">
			    	<label class="blue">
			      @if(isset($demande->consultation))
			        {{  (\Carbon\Carbon::parse($demande->consultation->Date_Consultation))->format('d/m/Y') }}
			        @else
			         {{  (\Carbon\Carbon::parse($demande->visite->date))->format('d/m/Y') }}
			        @endif 
			      </label>
			    </div>
			  </div>
		  </div>
			<div class="row">
			  <div class="col-xs-12 col-sm-12">
			    <div class="col-sm-6"> <label class="control-label pull-right"><b>Médecin demandeur :</b></label></div>
			    <div class="form-group col-sm-6">
			    	<label class="blue">
			      @if(isset($demande->consultation))
			      {{ $demande->consultation->docteur->nom }} &nbsp;{{ $demande->consultation->docteur->prenom }}
			      @else
			       {{ $demande->visite->medecin->nom }} &nbsp;{{ $demande->visite->medecin->prenom }}
			      @endif
			      </label>
			    </div>
			  </div>
		  </div>
			<div class="row">
			  <div class="col-xs-12 col-sm-12">
			    <div class="col-sm-6"><label class="control-label pull-right"><b>Informations cliniques pertinentes :</b></label></div>
			      <div class="form-group col-sm-6"><label class="blue">{{ $demande->InfosCliniques }}</label> </div>
			  </div>
			</div>
			<div class="row">
			  <div class="col-xs-12 col-sm-12">
			    <div class="col-sm-6"> <label class="control-label pull-right"><b>Explication de la demande de diagnostic :</b></label></div>
			    <div class="form-group col-sm-6"><label class="blue">{{ $demande->Explecations }}</label> </div>
			  </div>
			</div>
			<div class="row">
			  <div class="col-xs-12 col-sm-12">
			    <div class="col-sm-6">
			      <label class="control-label pull-right"><b>Informations supplémentaires pertinentes :</b></label>
			    </div>
			    <div class="form-group col-sm-6">
			     	<label class="blue">
			     	 <ul class="list-inline"> 
			        @foreach($demande->infossuppdemande as $index => $info)
			            <li class="active"><span class="badge badge-warning">{{ $info->nom }}</span></li>
			         @endforeach
			        </ul>    
			     	</label>
			    </div>
			  </div>
			</div>
			<div class="row">
			  <div class="col-sm-12 col-xs-12 widget-container-col">
			    <div class="widget-box">
			      <div class="widget-header"><h5 class="widget-title"><b>Examens radiologique demandés</b></h5></div>
			      <div class="widget-body">
			        <div class="widget-main">
			         <table class="table table-striped table-bordered">
			             <thead>
			              <tr>
			                	<th class="center" width="5%">#</th>
			               	 <th class="center" width="40%">Nom</th>
			               	 <th class="center" width="5%"><strong>Type</strong></th>
			                	<th class="center" width="20%"><strong>Résultat</strong></th>
			                	<th class="center" width="20%"><strong><em class="fa fa-cog"></em></strong></th>
			              </tr>
			            </thead>
			            <tbody>
			               	@foreach ($demande->examensradios as $index => $examen)
			                 <tr id = "{{ $examen->id }}">
			                  <td class="center" width="5%">{{ $index }}</td>
			                  <td>{{ $examen->nom }}</td>
			                  <td>
			                    <?php $exams = explode (',',$examen->pivot->examsRelatif) ?>
			                    @foreach($exams as $id)
			                    <span class="badge badge-success">{{ App\modeles\TypeExam::FindOrFail($id)->nom}}</span>
			                    @endforeach
			                  </td>
			                  <td >
			                  <table width="100%" height="100%" class="table">
			                  	@if($examen->pivot->etat == "1")
			                      @foreach (json_decode($examen->pivot->resultat) as $k=>$f)
			                      <tr>
			                        <td><i class="fa fa-file" aria-hidden="true"></i>&nbsp;{{ $f }}</td>
			                      </tr>
			                      @endforeach
			                    @endif
			                    </table>
			                  </td>
			                  <td class="center" width="20%">
			                    <table width="100%" height="100%" class="table">
			                 	@if($examen->pivot->etat == "1")
			                   		 @foreach (json_decode($examen->pivot->resultat) as $k=>$f)
			                      	<tr><!-- <td width="70%">{{-- $f --}}</td> -->
			                        		<td width="100%">
			                       		 <button type="submit" class="btn btn-info btn-xs open-modal" value="{{ $examen->pivot->id_examenradio."/".$f }}"><i class="ace-icon fa fa-eye-slash"></i></button>
			                        		<a href='/Patients/{{$patient->id}}/examsRadio/{{$demande->id}}/{{$examen->pivot->id_examenradio}}/{{ $f }}' class="btn btn-success btn-xs" target="_blank"><i class="fa fa-download"></i></a>
			                        		@isset($examen->pivot->crr_id)
						  			<a href="{{ route('crrs.download',$examen->pivot->crr_id )}}" title="télecharger le compte rendu" class="btn btn-default btn-xs" target="_blank"><i class="fa fa-download"></i>CRR</a>
						  		@endisset 
			                         		</td>
			                      	</tr>
			                      @endforeach
				                  @elseif($examen->pivot->etat == "0")
			                      <span class="badge badge-danger">Annuler</span>
			                      <a href="#" class="green btn-lg show-details-btn" title="Afficher Details" data-toggle="collapse"  id="{{$index}}" data-target=".{{$index}}collapsed" >
				    									<i class="fa fa-eye-slash" aria-hidden="true"></i><span class="sr-only">Details</span>
				   									</a>
				   								@else  
			                      <span class="badge badge-warning">En Cours</span>
				                  @endif
			                    </table>
			                  </td>
			                </tr>
			                @if($examen->pivot->etat == "0")
			                <tr class="collapse out budgets {{$index}}collapsed">
			                	<td colspan="12">
				   		<div class="table-detail">
				   			<div class="row">
				     			<div class="col-xs-6 col-sm-6">
										<div class="space visible-xs"></div>
										<div class="profile-user-info profile-user-info-striped">
											<div class="profile-info-row">
												<div class="profile-info-name text-center"><strong>Observation:</strong></div>
												<div class="profile-info-value"> <span>{{ $examen->pivot->observation }} </span></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</td>
								      </tr>
			                @endif
			                @endforeach
			            </tbody>
			          </table>
			        </div>  
			      </div>
			    </div>
			  </div> 
			</div>
		</div>
		<div class="col-lg-6 container"  id="dicom"  hidden="true">@include('DICOM.show')</div>
	</div>    
</div>
@endsection