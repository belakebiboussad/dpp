<div id="ExamCompl" class="tabpanel">
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
	<div class="tab-content" style = "border-style: none;">
	 	 <div class="tab-pane active" id="biologique">
	 	 	<div class= "col-md-9 col-xs-9">@include('consultations.ExamenCompl.ExamenBio')</div>
          		<div class= "col-md-3 col-xs-3"><br/><br/><br/><br/><br/><br/>
		  	<div class="right">
		  	<div class="profile-contact-links center">
			 	<a  href="#" data-target="#Ordonnance" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
          				<div class="fa fa-plus-circle"></div><span class="bigger-110"> Ordonnance</span>
        			</a><div class="space-12"></div> <!-- data-toggle="modal" data-target="#dexbio"  -->
				<button type="button" class="btn btn-primary btn-lg"  style="width:100%;" onclick="createexbio('{{$patient->Nom}}','{{$patient->Prenom}}', {{ $patient->getAge() }},'{{$patient->IPP}}')">
					<div class="fa fa-print bigger-120"></div><span class="bigger-110"> &nbsp;&nbsp;&nbsp;Imprimer</span>
				</button>	<div class="space-12"></div>
				<a  href="#" data-target="#RDV" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
	         			<div class="fa fa-plus-circle"></div>   <span class="bigger-110">&nbsp;Rendez-vous</span>
	       		</a>
			</div><div class="space-12"></div>
			<div class="profile-contact-info">
			<div class="profile-contact-links center">
				<a href="#" data-target="#demandehosp" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
	          			<div class="fa fa-plus-circle"></div>  <span class="bigger-110"> Hospitalisation</span>
	        		</a><div class="space-12"></div>
				<a class="btn btn-primary btn-lg tooltip-link" data-toggle="modal"  data-target="#lettreorient" style="width:100%;" onclick="lettreoriet('{{ $employe->nom}}','{{ $employe->prenom }}','{{ $employe->specialite }}','{{ $employe->tele_mobile }}')">
	          			<div class="fa fa-plus-circle"></div><span class="bigger-110">Orientation</span> 
	        		</a>
			</div><div class="space-12"></div>
			</div>		
			</div>	
			</div>
		</div>
		<div class="tab-pane" id="radiologique">
			<div class= "col-md-9 col-xs-9"> @include('consultations.ExamenCompl.ExamenRadio') </div>
        		<div class= "col-md-3 col-xs-3">	<br/><br/><br/><br/><br/><br/>
	    		<div class="right">
		      	<div class="profile-contact-links center">
			     	<a  href="#" data-target="#Ordonnance" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
			     		<div class="fa fa-plus-circle"></div><span class="bigger-110"> Ordonnance</span>
				</a><div class="space-12"></div>{{-- data-toggle="modal" data-target="#dexRadio"  --}}
				<button type="button" class="btn btn-primary btn-lg"  style="width:100%;" onclick="createeximg('{{$patient->Nom}}','{{$patient->Prenom}}','{{ $patient->getAge() }}','{{ $patient->IPP }}')"><div class="fa fa-print bigger-120"></div><span class="bigger-110"> &nbsp;&nbsp;Imprimer</span>
				</button><div class="space-12"></div>
				<a  href="#" data-target="#RDV" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
					<div class="fa fa-plus-circle"></div><span class="bigger-110">&nbsp;Rendez-vous</span>
	         		</a>
				</div><div class="space-12"></div>
				<div class="profile-contact-info">
				<div class="profile-contact-links center">
					<a href="#" data-target="#demandehosp" class="btn btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
			          		 <div class="fa fa-plus-circle"></div>  <span class="bigger-110"> Hospitalisation</span>
			          </a><div class="space-12"></div>
					<a class="btn btn-primary btn-lg tooltip-link" data-toggle="modal" data-target="#lettreorient" style="width:100%;" onclick="lettreoriet('{{ $employe->nom}}','{{ $employe->prenom }}','{{ $employe->specialite }}','{{ $employe->tele_mobile }}')">
            				<div class="fa fa-plus-circle"></div><span class="bigger-110">Orientation</span> 
          				</a>
				</div><div class="space-12"></div>	
			</div>		
		 </div>		
		</div>{{-- col-md-3 col-xs-3 --}}
		</div>	
		<div class="tab-pane" id="anapath">
  			<div class= "col-md-9 col-xs-9">@include('consultations.ExamenCompl.examAnapath')<br></div>
			<div class= "col-md-3 col-xs-3"><br/><br/><br/><br/><br/><br/>
			 <div class="right">
        		<div class="profile-contact-links center">
			    <a href="#" data-target="#Ordonnance" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
          				<div class="fa fa-plus-circle"></div><span class="bigger-110"> Ordonnance</span>
          			</a><div class="space-12"></div>
				<a  href="#" data-target="#RDV" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
					<div class="fa fa-plus-circle"></div><span class="bigger-110">&nbsp;Rendez-vous</span>
				</a>
			</div> <div class="space-12"></div>
			<div class="profile-contact-info">
			<div class="profile-contact-links center">
				<a href="#" data-target="#demandehosp" class="btn btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
             			 <div class="fa fa-plus-circle"></div><span class="bigger-110"> Hospitalisation</span>
            		</a><div class="space-12"></div>
				<a class="btn btn-primary btn-lg tooltip-link" data-toggle="modal" data-target="#lettreorient" style="width:100%;" onclick="lettreoriet('{{ $employe->nom }}','{{ $employe->prenom }}','{{ $employe->specialite }}','{{ $employe->tele_mobile }}')">
       		     		<div class="fa fa-plus-circle"></div> <span class="bigger-110">Orientation</span> 
       		 	</a>
			</div><div class="space-12"></div>	
			</div>		
	 		</div>		
     			</div> {{-- col-md-3 col-xs-3 --}}
		</div><br><br>
	</div>
</div>
<div class="row"><canvas id="dos" style ="width:20px;height:20px"><img id='itf' /></canvas></div>