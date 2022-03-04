<div id="ExamCompl" class="tabpanel">
<div class="row">
	<ul  class="nav nav-pills nav-justified navbar-custom2 list-group" id ="compl">
		<li role= "presentation" class="active" data-interest = "0">
	    		<a href="#biologique" aria-controls="biologique" role="tab" data-toggle="tab" class="jumbotron">
	     			<i class="fa fa-2x fa-flask deep-purple-text"></i><span class="bigger-130">Examen Biologique</span>	
	   		 </a>
	 	 </li>
		<li role= "presentation" data-interest = "1">
  			<a href="#radiologique" aria-controls="radiologique" role="tab" data-toggle="tab" class="jumbotron">
  			<span class="medical medical-icon-mri-pet" aria-hidden="true"></span><span class="bigger-130">Examen Radiologique</span>
    	 		</a>
   		</li>
   		<li role= "presentation" data-interest = "2">
     			<a href="#anapath" aria-controls="anapath" role="tab" data-toggle="tab" class="jumbotron">
   			<span class="medical medical-icon-pathology" aria-hidden="true"></span><span class="bigger-130"> Examen Anapath</span>
    			</a>
   		</li>
	</ul>
</div>
<div class="row">
	<div class= "col-md-9 col-sm-9">
		<div class="tab-content" style = "border-style: none;">
	 		<div class="tab-pane active" id="biologique">
	 			@isset($specialite->exmsbio)
	 				@foreach ( json_decode($specialite->exmsbio, true) as $exbio)
	 	  	  			<div class="checkbox col-xs-4">
	 	   			 	<label>
							<input name="exmsbio[]" type="checkbox" class="ace" value="{{ $exbio }}"  />
					 		<span class="lbl">{{ App\modeles\examenbiologique::FindOrFail($exbio)->nom }}</span> 
				 		 </label>
	 		  			</div>
	 				@endforeach
	 			@endisset
	 		</div>
	 		<div class="tab-pane" id="radiologique"> @include('ExamenCompl.ExamenRadio')</div>
	 		<div class="tab-pane" id="anapath">@include('ExamenCompl.examAnapath')</div>
	 		</div>
	 </div>
	 <div class= "col-md-3 col-sm-3">
			<div class="row">
			  <button type="button" class="btn btn-primary btn-lg col-sm-12 col-xs-12" onclick="printExamCom('{{$patient->Nom}}','{{$patient->Prenom}}','{{ $patient->age }}','{{$patient->IPP}}','{{ $employe->nom }}','{{ $employe->prenom }}')">
					<div class="fa fa-print bigger-120"></div><span class="bigger-110"> &nbsp;&nbsp;&nbsp;Imprimer</span>
				</button>
			</div>
			<div class="space-12"></div>
			<div>
				@if(! isset( $hosp))
					@include('consultations.actions')	
				@endif
			</div>
	</div>
</div>
</div>
<div class="row"><canvas id="dos" height="1%"><img id='itf'/></canvas></div>