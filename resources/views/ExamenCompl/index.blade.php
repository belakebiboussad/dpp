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
   			<span class="medical medical-icon-pathology" aria-hidden="true"></span><span class="bigger-130"> Examen anapath</span>
    			</a>
   		</li>
	</ul>
</div>
<div class="row">
	<div class= "col-md-9 col-sm-9">
		<div class="tab-content" style = "border-style: none;">
	 		<div class="tab-pane active" id="biologique">	@include('ExamenCompl.ExamenBio')</div>
	 		<div class="tab-pane" id="radiologique"> @include('ExamenCompl.ExamenRadio')</div>
	 		<div class="tab-pane" id="anapath">@include('ExamenCompl.examAnapath')</div>
	 	</div>
	</div><!-- col-md-9 col-xs-9 -->
	<div class= "col-md-3 col-sm-3">
			<div class="row">
			  <button type="button" class="btn btn-primary btn-lg col-sm-12 col-xs-12" onclick="printExamCom('{{$patient->Nom}}','{{$patient->Prenom}}','{{ $patient->getAge() }}','{{$patient->IPP}}')">
				<div class="fa fa-print bigger-120"></div><span class="bigger-110"> &nbsp;&nbsp;&nbsp;Imprimer</span>
			</button>
		</div><div class="space-12"></div>
		@if(! isset( $hosp))
			@include('consultations.actions')	
		@endif
	</div>
</div><!-- row -->
</div><!-- ExamCompl -->
<div class="row"><canvas id="dos" height="1%"><img id='itf' class="hidden-xs" /></canvas></div>