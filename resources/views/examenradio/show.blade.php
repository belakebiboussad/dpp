@extends('app')
@section('main-content')
<div class="container-fluid">
	<div class="row"><div class="col-sm-12  mt-2p">@include('patient._patientInfo')</div></div>
	<div class="row">
	 	<div class="col-sm-5"><h4> <strong>Détails de la demande radiologique</strong></h4></div>
  		<div class="col-sm-7 pull-right"> 
   		<a href="/drToPDF/{{ $demande->id }}" target="_blank" class="btn btn-sm btn-primary pull-right"> <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer
    		</a>&nbsp;&nbsp;
		<a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
  		</div>
 	</div><hr>
  	<div class="row ">
 		<div class="col-sm-6">
	  		<div class="row">
				<div class="form-group">		
					<label class="col-sm-6 control-label no-padding-right" for=""><strong>Date :</strong></label>
					<div class="col-sm6 col-xs-6">
						 <label class="blue">{{  (\Carbon\Carbon::parse($date))->format('d/m/Y') }}</label>
					</div>
				</div>
			</div>
	  		<div class="row">
				<div class="form-group">		
					<label class="col-sm-6 control-label no-padding-right" for=><strong>Médecin demandeur :</strong></label>
					<div class="col-sm6 col-xs-6">
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
				<div class="form-group">		
					<label class="col-sm-6 control-label no-padding-right" for=""><strong>Informations cliniques pertinentes :</strong></label>
					<div class="col-sm6 col-xs-6"><label class="blue">{{ $demande->InfosCliniques }}</label></div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">		
					<label class="col-sm-6 control-label no-padding-right" for=""><strong>Explication de la demande de diagnostic  :</strong></label>
					<div class="col-sm6 col-xs-6"><label class="blue">{{ $demande->Explecations }}</label></div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">		
					<label class="col-sm-6 control-label no-padding-right" for=""><strong>Informations supplémentaires pertinentes :</strong></label>
					<div class="col-sm6 col-xs-6"><label class="blue">
						<ul class="list-inline spaced"> 
					        @foreach($demande->infossuppdemande as $index => $info)
					            <li class="active"><span class="badge badge-warning">{{ $info->nom }}</span></li>&nbsp;
					         @endforeach
					        </ul></label>
					</div>
				</div>
			</div>
		 	 <div class="row">	
		    	<div class="col-sm-12">
		    		<div class="tabpanel">	
		     		<ul class = "nav nav-pills nav-justified list-group" role="tablist">
			  		<li class="active" role= "presentation">
			  			<a href="#exams" role="tab" data-toggle="tab">
						<i class="fa fa-image  fa-1x"></i>&nbsp;<strong>Examens Radilogique</strong>
						</a></li>
				 		@if($demande->hasCCR())
			 			<li  role="presentation">
			 				<a href="#crr" role="tab" data-toggle="tab"><i class="fa fa-file fa-1x" aria-hidden="true"></i>&nbsp;
			  				<strong>Compte rendu radiologique </strong>
			  			</a>
			  		</li>
			  		@endif
			 		</ul>
			 		<div class="tab-content  no-border">
		  			<div class="tab-pane noborders in active" id="exams">
			  			<div class="col-xs-12 widget-container-col">
							<div class="widget-box widget-color-blue" id="widget-box-2">
								<div class="widget-header" style="text-align: left;">
    				     			             <h5 class="widget-title lighter">
    				     			              	<i class="ace-icon fa fa-table"></i>Examens radiologique demandés
    				     			             </h5>
				     		             </div>
			                               	<div class="widget-body">
				       		<div class="widget-main">
				       			<table class="table table-striped table-bordered">
				             	<thead>
				              	<tr>
				                	<th class="center" width="5%">N°</th>
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
				                  <td  class="align-left">{{ $examen->nom }}</td>
				                  <td>
				                    <?php $exams = explode (',',$examen->pivot->examsRelatif) ?>
				                    @foreach($exams as $id)
				                    <span class="badge badge-success">{{ App\modeles\TypeExam::FindOrFail($id)->nom}}</span>
				                    @endforeach
				                  </td>
				                  <td >
				                  <table width="100%" height="100%">
				                  	@if($examen->pivot->etat == "1")
				                      @foreach (json_decode($examen->pivot->resultat) as $k=>$f)
				                      <tr>
				                        <td class="align-left"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;{{ $f }}</td>
				                      </tr>
				                      @endforeach
				                    @endif
				                    </table>
				                  </td>
				                  <td class="center" width="20%">
				                    <table width="100%" height="100%" class="table">
				                 		@if($examen->pivot->etat == "1")
				                   	 	@foreach (json_decode($examen->pivot->resultat) as $k=>$f)
				                     	<tr>
		                        		<td width="100%">
																	@if((pathinfo($f, PATHINFO_EXTENSION) == 'dcm')||(pathinfo($f, PATHINFO_EXTENSION) == ""))
		                       				<button type="submit" class="btn btn-info btn-xs open-modal" value="{{ $examen->pivot->id_examenradio."/".$f }}">
		                       					<i class="ace-icon fa fa-eye-slash"></i></button>
		                        			@endif
		                        			<a href='/Patients/{{$patient->id}}/examsRadio/{{$demande->id}}/{{$examen->pivot->id_examenradio}}/{{ $f }}' class="btn btn-success btn-xs" target="_blank"><i class="fa fa-download"></i></a>
		                       			@isset($examen->pivot->crr_id)
					  											<a href="{{ route('crrs.download',$examen->pivot->crr_id )}}" title="télecharger le compte rendu" class="btn btn-default btn-xs" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
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
						</div><!-- tab-pane -->
					@if($demande->hasCCR())
						<div class="tab-pane" id="crr">
							<div class="row"><div class="col-sm-6"> <label class="">Compte rendu radiologique :</label></div></div>
							<div class="row">
								<div class="form-group col-sm-6">
									<textarea  disabled cols="95" rows ="12" style="resize:none">
										@foreach($demande->examensradios as $index => $examen)
											@isset($examen->pivot->crr_id)
												{{ App\modeles\CRR::FindOrFail($examen->pivot->crr_id)->conclusion  }}
											 @endisset
										@endforeach
									</textarea>
								</div>
						</div>
					</div><!-- tab-pane -->
					@endif
					</div><!-- tab-content -->
					</div>{{-- tabpanel --}}

		 		 </div>
			</div><!-- row -->
		</div><!-- col-lg-6 -->
		<div class="col-sm-6 container" id="dicom"  hidden="true">@include('DICOM.show')</div>
	</div><!-- row no-gutters -->
</div><!-- container-fluid -->
@endsection