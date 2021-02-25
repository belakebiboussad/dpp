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
			<!-- <div class="form-group">	<div class="range-slider col-xs-9">	<div class="col-xs-4"><label class="control-label no-padding-right" for="motif"><strong>Taille (H) : </strong></label>
  					</div><div class="col-xs-6"><input type="range" name="rangeInput" min="0" max="100" onchange="updateTextInput(this.value);">		
  					</div>	</div>	<div class="col-xs-3"><input type="text" id="textInput" value="">	</div>	</div> -->
			<br><br><br><br>
      <div class="form-group irs-demo m-b-30"> <b>Taille :</b>
   		  <input type="text" id="taille" name="taille" class="irs-hidden-input" tabindex="-1" value="" readonly="">
			</div>
			<br>
      <div class="form-group irs-demo m-b-30"> <b>Poids :</b>
   		  <input type="text" id="weidth_range" name="poids" class="irs-hidden-input" tabindex="-1" value="" readonly="">
			</div>
			<br>
 			<div class="row">
 				<div class="col-xs-2"><button id ="btnCalc" class="btn btn-info form-control" onclick="IMC1();">Calculer IMC</button></div>
				<div class="col-xs-4">
					<label class= "col-xs-2" for="IMC"></label>
					<input type="text" id="imc" name="imc" class="col-xs-10" placeholder="IMC du Patient..."><!-- <span class="input-group-addon"><small>Kg/m2</small></span>-->
				</div>
				<div class="col-xs-6">
					<label for="IMC" class= "col-xs-5">Interpretation :</label>
					<input type="text" id="imc" name="imc" class="col-xs-7" placeholder="IMC du Patient..."><!-- <span class="input-group-addon"><small>Kg/m2</small></span>-->
				</div> 
		  </div>
	<br><br>
			<br>
		 <!--  <div class="irs-demo m-b-30"> <b>Poids</b>
        <span class="irs js-irs-0"><span class="irs">	<span class="irs-line" tabindex="-1">	<span class="irs-line-left"></span><span class="irs-line-mid"></span>
        	       			<span class="irs-line-right"></span></span>
         			<span class="irs-min" style="visibility: visible;">0</span>
         			<span class="irs-max" style="visibility: visible;">200</span>
         			<span class="irs-from" style="visibility: hidden;">0</span>
         			<span class="irs-to" style="visibility: hidden;">0</span>
         			<span class="irs-single" style="left: 22.9252%;">31</span>
         	</span>
         	<span class="irs-grid"></span>
         	<span class="irs-bar" style="left: 0.609292%; width: 23.049%;"></span><span class="irs-bar-edge"></span><span class="irs-shadow shadow-single" style="display: none;"></span><span class="irs-slider single" style="left: 23.049%;"></span></span><input type="text" id="range_01" value="" class="irs-hidden-input" readonly="">
      </div> -->
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