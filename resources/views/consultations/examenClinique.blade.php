<div id="ExamGeneral" class="tabpanel">
	<div class="row">
		<ul class = "nav nav-pills nav-justified navbar-custom1 list-group" role="tablist" id ="cliniq">
			<li role= "presentation" class="active">
	    			<a href="#ExamGen"  name="ExamGen" aria-controls="ExamGen" role="tab" data-toggle="tab" class="jumbotron">
	 	 			<i class="fa fa-stethoscope fa-2x pull-left"></i><span class="bigger-130">  Exemen Génerale</span>
	    			 </a>
	   		 </li>
			<li role= "presentation" name="appareils">
			  <a href="#Appareils" aria-controls="Appareils" role="tab" data-toggle="tab" class="jumbotron">
			  	<span class="medical medical-icon-i-internal-medicine" aria-hidden="true"></span><span class="bigger-130">Exemen Appareils</span>
			   </a>
			</li>
		</ul>
	</div> {{-- row ul --}}
	<div class="row">
		<div class= "col-md-8 col-xs-8"> 
			
				<div class="form-group">
				<input type="text" name="chance" id="chance" class="text" value="50">
				<input type="range" id="chanceSlider" class="vHorizon" min="0.01" max="98" step="0.01" style="background-color: #00aec8; width: 50%;">
				</div>
		
			<div class="form-group">
				 <div class="range-slider col-xs-9">
					 <div class="col-xs-4">
				 		<label class="control-label no-padding-right" for="motif"><strong>Taille (H) : </strong>
  						</label>
  					</div>
  					<div class="col-xs-6">
  						<input type="range" name="rangeInput" min="0" max="100" onchange="updateTextInput(this.value);">		
  					</div>
				</div>
				<div class="col-xs-3">
					<input type="text" id="textInput" value="">

				</div>
				  
			</div>
			<div class="form-group">
				<label class="col-xs-2 control-label no-padding-right right" for="poids"><strong>Poids :</strong></label>
				 <div class="range-slider">
					<input class="input-range" type="range" value="0" min="0" max="200">
					 <span class="range-value">1</span>
				</div>
			</div>
			<div class="form-group">

			</div>
			
		</div>
		<div class= "col-md-4 col-xs-4"> 
			<div class="right">
           			 <div class="profile-contact-links align-right">
             			 	<a  href="#" data-target="#Ordonnance" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
              				 	<div class="fa fa-plus-circle"></div><span class="bigger-110"> Ordonnance</span>
             				 </a>  <div class="space-12"></div>
            	        		<a href="#" data-target="#RDV" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
	         					<div class="fa fa-plus-circle"></div><span class="bigger-110">Rendez-vous</span>
	          				</a>
           			</div><div class="space-12"></div>
                       	<div class="profile-contact-info">
              			<div class="profile-contact-links center">
			                <a href="#" data-target="#demandehosp" class="btn  btn-primary btn-lg tooltip-link" style="width:250px;" data-toggle="modal">
			                 	<div class="fa fa-plus-circle"></div><span class="bigger-110"> Hospitalisation</span>
			                </a> <div class="space-12"></div>
       					<a class="btn btn-primary btn-lg tooltip-link" data-toggle="modal" data-target="#lettreorient" style="width:250px;" onclick="lettreoriet('{{ $employe->nom }}','{{ $employe->prenom }}','{{ $employe->specialite }}','{{ $employe->tele_mobile }}')">
                  				<div class="fa fa-plus-circle"></div><span class="bigger-110">Orientation</span> 
                			</a>
              			</div><div class="space-12"></div> 
            			</div>  
        				</div>
		</div>
	</div>
	{{-- <div class="row">
		<div class="col-sm-6">
			<div id="taille"></div>
		</div>
		<div class="col-sm-6">
			
		</div>	
	</div> --}}
</div>