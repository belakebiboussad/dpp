<div id="accordion" class="accordion-style1 panel-group " style="margin-right: -1%;">
 	<div class="row">
		<div class="col-sm-12 widget-container-col ui-sortable" id ="widget-container-col-11">
		<div class="widget-box transparent ui-sortable-handle" id="widget-box-11">
		<div class="widget-header widget-header-small">
		<h4 class="widget-title smaller"></h4>
		<div class="widget-toolbar no-border">
		<ul class="nav nav-tabs" id="myTab2">
			<li class="active">
				<a data-toggle="tab" href="#Intero" aria-expanded="false">Interogatoire</a>
			</li>
			@if(isset($exmclin) )
			<li class="">
				<a data-toggle="tab" href="#Exam" aria-expanded="false">Examen Clinique</a>
			</li>
			@endif
			@if(isset($consultation->demandeexmbio) && $consultation->demandeexmbio->count() !=0)
			<li class="">
				<a data-toggle="tab" href="#eXamBio" aria-expanded="true">
					   <i class="blue ace-icon fa fa-file-pdf-o bigger-100"></i>Examen Biologique
			           </a>
			</li>
			@endif
			@if(isset($examsRadio)  && count($examsRadio) !=0)	
			<li class="">
				<a data-toggle="tab" href="#examImagerie" aria-expanded="false">
				  <i class="pink ace-icon fa fa-picture-o bigger-100"></i>Examens Radiologique
				</a>
			</li>
			@endif
			@if(isset($ordonnance))
			<li class="">
			<a data-toggle="tab" href="#ordonnance" aria-expanded="false">	
				<i class="orange ace-icon fa fa-medkit bigger-120"></i>
				Ordonnance
			</a>
			</li>
			@endif
		</ul>
		</div>
		</div>{{-- header --}}
		<div class="widget-body">
		<div class="widget-main padding-6">
			<div class="tab-content">
			<div id="Intero" class="tab-pane in active">
				<div class="row">
				<div class="col-xs-12">
					<label for="Date_Consultation"><strong>Date de la Consultation :</strong></label>
					<input type="date" id="Motif_Consultation" style="width:100%; height: 50px;" value="{{ $consultation->Date_Consultation }}" data-date-format="yyyy-mm-dd" readonly />
				</div>
				</div>
				<div class="row">
				<div class="col-xs-12">
				<label for="Motif_Consultation"><strong>Motif de la Consultation :</strong></label>
				<textarea type="text" id="Motif_Consultation" style="width:100%; height: 50px;" readonly >{{ $consultation->Motif_Consultation }}</textarea>
				</div>
				</div>{{-- row	 --}}
				@if(isset($consultation->histoire_maladie))
				<div class="row">
				<div class="col-xs-12">
				<label for="histoire_maladie"><strong>Histoire de la maladie :</strong></label>
				<textarea type="text" id="histoire_maladie" style="width:100%; height:50px;" readonly >{{ $consultation->histoire_maladie }}</textarea>
				</div>
				</div>
				@endif
				@if(isset($consultation->Diagnostic))
				<div class="row">
				<div class="col-xs-12">
				<label for="Diagnostic"><strong>Diagnostic:</strong></label>
				<input type="text" id="Diagnostic" style="width:100%; height:30px;" value="{{ $consultation->Diagnostic }}" readonly >
				</div>
				</div>
				@endif
				@if(isset($consultation->Resume_OBS))
				<div class="row">
				<div class="col-xs-12">
				<label for="Resume_OBS"><span class="bigger-120"><b>Résumé:</b></span></label><textarea type="text" id="Resume_OBS" style="width: 100%; height: 50px;" readonly >{{ $consultation->Resume_OBS }}</textarea>
				</div>
				</div>
				@endif
				</div>{{-- Intero --}}
				@if(isset($exmclin) )
				<div id="Exam" class="tab-pane in">
				<div class="row">
				<div class="col-md-3">
				<label for="taille"><span class="bigger-100"><strong>Taille:</strong></span></label>
				<input type="text" id="taille" class =""  style="width:30%;height:10%;border: 0;" readonly value="{{$exmclin->taille}}"/>
					<span><small>m</small></span>
				</div>
				<div class="col-md-3">
				<label for="poids"><span class="bigger-100"><strong>Poids:</strong></span></label>
				<input type="text" id="poids"  class ="form-control-plaintext" style="border: 0;background-color:transparent;width: 25%; height: 10%;" readonly value="{{$exmclin->poids}}"/>
					<span><small>Kg</small></span>
				</div>
				<div class="col-md-3">
				<label for="imc"><span class="bigger-100"><b>IMC:</b></span></label>
				<input type="text" id="imc" style="border: 0;width: 20%; height: 10%;" readonly value="{{$exmclin->IMC}}"/>
				</div>
				<div class="col-md-3">
				<label for="temp"><span class="bigger-100"><b>Temp:</b></span></label>
				<input type="text" id="temp" style="border: 0;width: 25%; height: 10%;" readonly value="{{$exmclin->temp}}"/>
					<span><small>°C</small></span>
				</div>
				</div>	 {{-- row --}}
				<div class="space-6"></div>
				@if(isset($exmclin->autre))
				<div class="row">
				<div class="col-md-12">
				<label for="autre"><span class="bigger-120"><b>Autre:</b></span></label>
				<textarea type="text" id="autre" style="width: 100%; height:30px;" readonly>{{$exmclin->autre}}</textarea>
				</div>
				</div> {{-- row --}}
				@endif
				@if(isset($exmclin->peaupha))
				<div class="row">
				<div class="col-md-12">
				<label for="peaupha"><span class="bigger-120"><b>Peau et phanéres:</b></span></label>
				<textarea type="text" id="peaupha" style="width: 100%; height:50px;" readonly > {{ $exmclin->peaupha }}</textarea>
				</div>
				</div>
				@endif
				@if(isset($exmclin->Etat))
				<div class="row">
				<div class="col-md-12">	
				<label for="Etat"><span class="bigger-120"><b>Etat Générale:</b></span></label>
				<textarea type="text" id="Etat" style="width:100%; height:50px;" readonly >{{ $exmclin->Etat }}</textarea>
				</div>
				</div>
				@endif
				</div>{{-- ExamClinique --}}
				@endif
				@if(isset($consultation->demandeexmbio) && $consultation->demandeexmbio->count() !=0)
				<div id="eXamBio" class="tab-pane">
						<div class="row">
							<div class="col-xs-12">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th class="center">#</th>
										  <th class="center">Date</th>
											<th class="center">Etat</th>
											<th class="center"></th>
									  </tr>
								  </thead>
					        <tbody>
									@foreach($consultation->demandeexmbio as $index => $demande)
									<tr>
										<td class="center">{{ $index +1 }}</td>
										<td>{{ $demande->DateDemande }}</td>
										<td>
										@if($demande->etat == "E")
										         <span class="badge badge-danger"> En Attente</span>
										@elseif($demande->etat == "V")
										 	<span class="badge badge-success">Validé</span>       
										@else
										  <span class="badge badge-success">Rejeté</span>   
										@endif
										</td>
										<td class="center">
										    <a href="{{ route('demandeexb.show', $demande->id_demandeexb) }}">
											    <i class="fa fa-eye"></i>
											</a>
										</td>
									</tr>
								@endforeach               
								</tbody>
								</table>
					    </div>
		        </div><!-- row -->
				</div> <!-- eXamBio -->
				@endif
				@if(isset($examsRadio)  && count($examsRadio) !=0)	
				<div id="examImagerie" class="tab-pane">
				<div class ="row">
				  <div class="col-xs-12">
		      <table class="table table-striped table-bordered">
		        <thead>
		          <tr>
		            <th class="center">#</th>
		            <th>Date</th>
		            <th>Etat</th>
		            <th class="center"><em class="fa fa-cog"></em></th>
		          </tr>
            </thead>
		        <tbody>
		        @foreach($consultation->examensradiologiques as $index => $exr)
		        <tr>
		            <td class="center">{{ $index + 1 }}</td>
		            <td>{{ $exr->Date }}</td>
		            <td>
		              @if($exr->etat == "E")
		                  <span class="badge badge-warning"> En Attente</span>
		              @elseif($exr->etat == "V")
		                Validé
		              @else
		               <span class="badge badge-danger">Rejeté</span>
		                
		              @endif
		            </td>
		            <td class="center">
			            <a href="{{ route('demandeexr.show', $exr->id) }}">
			              <i class="fa fa-eye"></i>
			            </a>
		            </td>
		        </tr>
		        @endforeach               
		        </tbody>
		      </table>
		      </div>{{-- col-sm-12 --}}
          </div>{{-- row --}}
				</div>	{{-- examImagerie --}}
				@endif
			{{-- 	@if(isset($ordonnance)) --}}
				<div id="ordonnance" class="tab-pane">
				<div class="row">
				<div class="col-sm-12">
				<table class="table table-striped table-bordered">
                       	          <thead>
                          		<tr>
	                            		<th class="center">#</th>
	                            		<th>Date</th>
	                            		<th class="center"><em class="fa fa-cog"></em></th>
	                          	</tr>
                        		</thead>
                       		<tbody>
		                     @foreach($consultation->ordonnaces as $index => $ordonnace)
		                     <tr>
		                            	<td class="center">{{ $index + 1 }}</td>
		                            	<td>{{ $ordonnace->date }}</td>
		                            	<td class="center">
		                     		     	<a href="{{ route('ordonnace.show', $ordonnace->id) }}">
		                               		<i class="fa fa-eye"></i>
		                              		</a>
		                           	</td>
		                      </tr>
		                      @endforeach
		                      </tbody>
		                      </table>	
				</div>
				</div>
				</div>{{-- ordonnance --}}
				{{-- @endif --}}

			</div>	{{-- TAB6CONTENT --}}
			</div>
		</div>	{{-- widget-body --}}

		</div>{{-- widget-box transparent ui-sortable-handle --}}
		</div>{{-- col-sm-6 widget-container-col ui-sortable --}}
	</div>
	</div>
	