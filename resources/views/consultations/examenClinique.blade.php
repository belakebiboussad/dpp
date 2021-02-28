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
		<div class= "col-md-9 col-xs-9"> 
		  <div  class="tab-content" style ="border-style: none;">
				<div  role="tabpanel" class ="tab-pane active" id="ExamGen">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group irs-demo m-b-30"> <b>Taille :</b>
	   		  			<input type="text" id="taille" name="taille" class="irs-hidden-input col-sm-12" tabindex="-1" value="" readonly="">
							</div>
						</div>
					</div>
					<div class="form-group irs-demo m-b-30"> <b>Poids :</b>
	   		  	<input type="text" id="poids" name="poids" class="irs-hidden-input col-sm-12" tabindex="-1" value="" readonly="">
					</div><!-- <br> -->
	 				<div class="row">
	 					<div class="col-xs-2"><button id ="btnCalc" class="btn btn-info form-control" onclick="IMC1();">Calculer IMC</button></div>
						<div class="col-xs-4">
							<label class= "col-xs-2" for="IMC"></label>
							<input type="text" id="imc" name="imc" class="col-xs-10" placeholder="IMC du Patient..."><!-- <span class="input-group-addon"><small>Kg/m2</small></span>-->
						</div>
						<div class="col-xs-6">
							<label for="interpretation" class= "col-xs-5">Interpretation :</label>
							<input type="text" id="interpretation" name="interpretation" class="col-xs-7" placeholder="IMC du Patient..."><!-- <span class="input-group-addon"><small>Kg/m2</small></span>-->
						</div> 
			  	</div>
			  	<div class="form-group irs-demo m-b-30"> <b>Températeur :</b>
	   		  	<input type="text" id="temp" name="temp" class="irs-hidden-input col-sm-12" tabindex="-1" value="" readonly="">
					</div>
					<div class="row">
						<div class="col-sm-12">
							<label class="control-label" for="etatgen"><strong>Etat Géneral du patient :</strong></label>
				  	 	<textarea type="text" id="etatgen" name="etatgen" placeholder= "Etat Géneral du patient..." class="form-control"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<label class="control-label" for="peaupha"><strong>Peau et phanéres :</strong></label>
							<textarea type="text" id="peaupha" name="peaupha" placeholder= "Peau et phanéres ..."   class="form-control"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<label class="control-label" for="autre"><strong>Autre :</strong></label>
							<textarea id="autre" name="autre" placeholder="..." class="form-control" min ="30" step="any"></textarea>
						</div>			
					</div>
				</div><!-- ExamGen -->
				<div role="tabpanel" class = "tab-pane" id="Appareils">	@include("consultations.ExamenAppareils")	</div>
			</div>
 		</div>
		<div class= "col-md-3 col-xs-3 pull-right"> 
			<a data-target="#Ordonnance" class="btn btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
      	<div class="fa fa-plus-circle"></div><span class="bigger-110"> Ordonnance</span>
     	</a><div class="space-12"></div>
     	<a data-target="#RDV" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
   			<div class="fa fa-plus-circle"></div><span class="bigger-110">Rendez-vous</span>
    	</a><div class="space-12"></div>
    	<a data-target="#demandehosp" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal">
        <div class="fa fa-plus-circle"></div><span class="bigger-110"> Hospitalisation</span>
      </a> <div class="space-12"></div>
      <a class="btn btn-primary btn-lg tooltip-link" data-toggle="modal" data-target="#lettreorient" style="width:100%;" onclick="lettreoriet('{{ $employe->nom }}','{{ $employe->prenom }}','{{ $employe->specialite }}','{{ $employe->tele_mobile }}')">
        <div class="fa fa-plus-circle"></div><span class="bigger-110">Orientation</span> 
      </a>
		</div>
	</div>
</div>