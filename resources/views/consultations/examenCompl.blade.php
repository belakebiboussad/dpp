<div id="ExamCompl" class="tabpanel">
	<ul  class="nav nav-pills nav-justified navbar-custom2 list-group" id ="compl">
		<li role= "presentation" class="active">
	        	<a href="#biologique" aria-controls="biologique" role="tab" data-toggle="tab" class="jumbotron">
	               	<i class="fa fa-2x fa-flask deep-purple-text"></i>
	               	  <span class="bigger-130">Examen Biologique</span>	
	             </a>
	      	</li>
		<li role= "presentation">
	      	<a href="#radiologique" aria-controls="radiologique" role="tab" data-toggle="tab" class="jumbotron">
	      		<span class="medical medical-icon-mri-pet" aria-hidden="true"></span>
			<span class="bigger-130">Examen Radiologique</span>
	        	</a>
	   	</li>
	   	<li role= "presentation">
	        		<a href="#anapath" aria-controls="anapath" role="tab" data-toggle="tab" class="jumbotron">
	        			<span class="medical medical-icon-pathology" aria-hidden="true"></span>
	        			<span class="bigger-130">  Examen anapath</span>
	       		           
	       		</a>
	      	</li>
	</ul>
	<div class="tab-content" style = "border-style: none;">
	 	 <div class="tab-pane active" id="biologique">
	 	 	<div class= "col-md-9 col-xs-9">
          				@include('consultations.ExamenCompl.ExamenBio')
			</div>
			<div class= "col-md-3 col-xs-3">
			<br/><br/><br/><br/><br/><br/>
		          		<div class="right">
		          			<div class="profile-contact-links align-center">
			      		<a  href="#" data-target="#Ordonnance" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal"   data-toggle="tooltip" data-original-title="" >
                                                    	<div class="fa fa-plus-circle"></div>
                                                    	<span class="bigger-110"> Ordonnance</span>
                                                    </a>
					<div class="space-6"></div>
					<button type="button" class="btn btn-primary btn-lg"  style="width:100%;" data-toggle="modal" data-target="#dexbio" onclick="createexbio('{{$patient->Nom}}','{{$patient->Prenom}}', {{ $patient->getAge() }})">
					<div class="fa fa-print bigger-120"></div>
					 <span class="bigger-110"> &nbsp;&nbsp;&nbsp;Imprimer</span>
					 </button>
					</div>
					<div class="space-12"></div>
					<div class="profile-contact-info">
					<div class="profile-contact-links align-center">
					<a  href="#" data-target="#demandehosp" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal"   data-toggle="tooltip" data-original-title="" >
                                                      <div class="fa fa-plus-circle"></div>

                                                     <span class="bigger-110"> Hospitalisation</span>
                                                      </a>
					<div class="space-6"></div>
					<a class="btn btn-primary btn-lg tooltip-link" data-toggle="modal"  data-toggle="tooltip" data-original-title="lettre d'orientation" data-target="#lettreorient" style="width:100%;" onclick="lettreoriet('{{ $employe->Nom_Employe }}','{{ $employe->Prenom_Employe }}',
                                                          '{{ $employe->Specialite_Emploiye }}','{{ $employe->tele_mobile }}')">
                                                           <div class="fa fa-plus-circle"></div>
                                                         <span class="bigger-110">Orientation</span> 
                                                           </a>
					</div>
					<div class="space-6"></div>	
					</div>		
		          		</div>	
			      	
			</div>{{-- col-md-3 col-xs-3 --}}
			
		</div>

		<div class="tab-pane" id="radiologique">
		  	<div class= "col-md-9 col-xs-9">
       			@include('consultations.ExamenCompl.ExamenRadio')
       			</div>
       			<div class= "col-md-3 col-xs-3">
				<br/><br/><br/><br/><br/><br/>
		          		<div class="right">
		          			<div class="profile-contact-links align-center">
			      		<a  href="#" data-target="#Ordonnance" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal"   data-toggle="tooltip" data-original-title="" >
			      			<div class="fa fa-plus-circle"></div>
                                                    	<span class="bigger-110"> Ordonnance</span>
                                                     </a>
					<div class="space-6"></div>
					<button type="button" class="btn btn-primary btn-lg"  style="width:100%;"  data-toggle="modal" data-target="#dexbio" onclick="createeximg('{{$patient->Nom}}','{{$patient->Prenom}}')">
					<div class="fa fa-print bigger-120"></div>
					<span class="bigger-110"> &nbsp;&nbsp;&nbsp;Imprimer</span></button>
					</div>
					<div class="space-12"></div>
					<div class="profile-contact-info">
					<div class="profile-contact-links align-center">
					<a  href="#" data-target="#demandehosp" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal"   data-toggle="tooltip" data-original-title="s" >
                                                     <div class="fa fa-plus-circle"></div>
                                                     <span class="bigger-110"> Hospitalisation</span>
                                                      </a>
					<div class="space-6"></div>
					<a class="btn btn-primary btn-lg tooltip-link" data-toggle="modal"  data-toggle="tooltip" data-original-title="lettre d'orientation" data-target="#lettreorient" style="width:100%;" onclick="lettreoriet('{{ $employe->Nom_Employe }}','{{ $employe->Prenom_Employe }}',
                                                          '{{ $employe->Specialite_Emploiye }}','{{ $employe->tele_mobile }}')">
                                                          <div class="fa fa-plus-circle"></div>
                                                         <span class="bigger-110">Orientation</span> 
                                                           </a>
					</div>
					<div class="space-6"></div>	
					</div>		
		          		</div>		
			</div>{{-- col-md-3 col-xs-3 --}}
		</div>	
        		<div class="tab-pane" id="anapath">
          			<div class= "col-md-9 col-xs-9">
          				@include('consultations.ExamenCompl.examAnapath')
				<br>
          			</div>
          			<div class= "col-md-3 col-xs-3">
          				<br/><br/><br/><br/><br/><br/>
		          		<div class="right">
		          			<div class="profile-contact-links align-center">
			      		<a  href="#" data-target="#Ordonnance" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal"   data-toggle="tooltip" data-original-title="" >
                                                    	<div class="fa fa-plus-circle"></div>
                                                    	<span class="bigger-110"> Ordonnance</span>
                                                     </a>
					</div>
					<div class="space-12"></div>
					<div class="profile-contact-info">
					<div class="profile-contact-links align-center">
					<a  href="#" data-target="#demandehosp" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal"   data-toggle="tooltip" data-original-title="" >
                                                     	 <div class="fa fa-plus-circle"></div>
                                                     	<span class="bigger-110"> Hospitalisation</span>
                                                    </a>
					<div class="space-6"></div>
					<a class="btn btn-primary btn-lg tooltip-link" data-toggle="modal"  data-toggle="tooltip" data-original-title="lettre d'orientation" data-target="#lettreorient" style="width:100%;" onclick="lettreoriet('{{ $employe->Nom_Employe }}','{{ $employe->Prenom_Employe }}',
                                                          '{{ $employe->Specialite_Emploiye }}','{{ $employe->tele_mobile }}')">
                                                           	<div class="fa fa-plus-circle"></div>
                                                        	 <span class="bigger-110">Orientation</span> 
                                                           </a>
					</div>
					<div class="space-6"></div>	
					</div>		
		          		</div>		
          			</div> {{-- col-md-3 col-xs-3 --}}
		</div>
		<br><br>
          	</div>
  </div>	
{{-- <div id="dexbio" class="modal fade" role="dialog">
	<div class="modal-dialog modal-xl">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Demande Examens Biologique :</h4>
			</div>
			<div class="modal-body">
				<iframe id="exbiopdf" class="preview-pane" type="application/pdf" frameborder="0" style="position:relative;z-index:999"></iframe>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default close_link" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div> --}}
{{-- deb --}}
<div id="dexbio" class="modal modal-wide fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       		<h4 class="modal-title">Demande Examens Biologique :</h4>
      </div>
      <div class="modal-body">
        <iframe id="exbiopdf" src="" frameborder="0" class="preview-pane" type="application/pdf" width="800" height="465">
          	  	
          	  </iframe>
      </div>
      <div class="modal-footer">
       </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 {{-- fin --}}
  <div id="dexRadio" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Demande Examens d'Imagerie :</h4>
			</div>
			<div class="modal-body">
				<iframe id="exradiopdf" class="preview-pane" type="application/pdf" width="100%" height="500" frameborder="0" style="position:relative;z-index:999"></iframe>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>