<div id="ExamCompl" class="tabpanel">
<div class="row">
	<ul  class="nav nav-pills nav-justified navbar-custom2 list-group" id ="compl">
		<li role= "presentation" class="active">
	    		<a href="#biologique" aria-controls="biologique" role="tab" data-toggle="tab" class="jumbotron">
	     			<i class="fa fa-2x fa-flask deep-purple-text"></i><span class="bigger-130">Examen Biologique</span>	
	   		 </a>
	 	 </li>
		<li role= "presentation">
  			<a href="#radiologique" aria-controls="radiologique" role="tab" data-toggle="tab" class="jumbotron">
  			<span class="medical medical-icon-mri-pet" aria-hidden="true"></span><span class="bigger-130">Examen Radiologique</span>
    	 		</a>
   		</li>
   		<li role= "presentation">
     			<a href="#anapath" aria-controls="anapath" role="tab" data-toggle="tab" class="jumbotron">
   			<span class="medical medical-icon-pathology" aria-hidden="true"></span><span class="bigger-130">  Examen anapath</span>
    			</a>
   		</li>
	</ul>
</div>
<div class="row">
	<div class= "col-md-9 col-xs-9">
		<div class="tab-content" style = "border-style: none;">
	 		<div class="tab-pane active" id="biologique">	@include('consultations.ExamenCompl.ExamenBio')</div>
	 		<div class="tab-pane" id="radiologique"> @include('consultations.ExamenCompl.ExamenRadio')</div>
	 		<div class="tab-pane" id="anapath">@include('consultations.ExamenCompl.examAnapath')</div>
	 	</div>
	</div><!-- col-md-9 col-xs-9 -->
	<div class= "col-md-3 col-xs-3">
		<button type="button" class="btn btn-primary btn-lg"  style="width:100%;" onclick="createexbio('{{$patient->Nom}}','{{$patient->Prenom}}', {{ $patient->getAge() }},'{{$patient->IPP}}')">
			<div class="fa fa-print bigger-120"></div><span class="bigger-110"> &nbsp;&nbsp;&nbsp;Imprimer</span>
		</button><div class="space-12"></div>
		<button type="button" class="btn btn-primary btn-lg"  style="width:100%;" onclick="createeximg('{{$patient->Nom}}','{{$patient->Prenom}}','{{ $patient->getAge() }}','{{ $patient->IPP }}')"><div class="fa fa-print bigger-120"></div><span class="bigger-110"> &nbsp;&nbsp;Imprimer</span>
		</button><div class="space-12"></div>
		<a data-target="#Ordonnance" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
     	<div class="fa fa-plus-circle"></div><span class="bigger-110"> Ordonnance</span>
    </a><div class="space-12"></div>
		<a data-target="#RDV" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
		  <div class="fa fa-plus-circle"></div><span class="bigger-110">&nbsp;Rendez-vous</span>
		</a><div class="space-12"></div>
		<a data-target="#demandehosp" class="btn btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
      <div class="fa fa-plus-circle"></div><span class="bigger-110"> Hospitalisation</span>
    </a><div class="space-12"></div>
		<a class="btn btn-primary btn-lg tooltip-link" data-toggle="modal" data-target="#lettreorient" style="width:100%;" onclick="lettreoriet('{{ $employe->nom }}','{{ $employe->prenom }}','{{ $employe->specialite }}','{{ $employe->tele_mobile }}')">
    	<div class="fa fa-plus-circle"></div> <span class="bigger-110">Orientation</span> 
    </a>
  </div>	
</div><!-- row -->
</div><!-- ExamCompl -->