<div id="ExamGeneral" class="tabpanel">
	<div class="row">
		<ul class = "nav nav-pills nav-justified navbar-custom1 list-group" role="tablist" id ="cliniq">
			<li role= "presentation" class="active">
	    	<a href="#ExamGen"  name="ExamGen" aria-controls="ExamGen" role="tab" data-toggle="tab" class="jumbotron">
	 	 			<i class="fa fa-stethoscope fa-2x"></i><span class="bigger-130">  Exemen Génerale</span>
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
		<div  class="tab-content" style ="border-style: none;">
			<div  role="tabpanel" class ="tab-pane active" id="ExamGen">
				<div class="space-12"></div><div class="space-12"></div> <div class="space-12"></div>
       	<div class= "col-md-8 col-xs-8"> 
        	<div class="row">
        		<div class="form-group">
	        		<div class="col-xs-2">
								<label class="col-xs-12 control-label no-padding-right right" for="taille"><strong>Taille :</strong>
								</label>
							</div>
							<div class="col-xs-2">
								<div class="input-group">
 									<input type="text" id="taille" name="taille" class="form-control bg"/><span class="input-group-addon"><small>m</small></span>
					 			</div>
							</div>
							<div class="col-xs-2">
								<label class="col-xs-12 control-label no-padding-right right" for="poids"><strong>Poids :</strong></label>
							</div>
							<div class="col-xs-2">
								<div class="input-group">
									<input type=" text" name="poids" id="poids" class="form-control"><span class="input-group-addon"><small>Kg</small></span>
								</div>
							</div>
							<div class="col-xs-3">
								<button id ="btnCalc" class="btn btn-info form-control" onclick="IMC1();">Calculer IMC</button>
							</div>
						</div> 
        	</div>{{-- end row --}}
        	<div class="space-12"></div>	<div class="space-12"></div><div class="space-12"></div>
          <div class="row">
        		<div class="col-xs-2">
        			<label class="col-sm-12 control-label no-padding-right right" for="IMC"><strong>IMC :</strong></label>
        	  </div>
        		<div class="col-xs-3">
        		 	<div class="input-group">
	         			<input type="number" id="imc"  name="imc" placeholder="IMC du Patient..." class="form-control col-sm-4" value ="" readonly  />
	           	  <span class="input-group-addon"><small>Kg/m2</small> </span>    				
	           	</div>
        		</div>
        		<div class="col-xs-2">
        			<label class="col-xs-12 control-label no-padding-right right" for="interpretation"><strong class="text-nowrap">Interpretation :</strong></label>
        		</div>	
        		<div class="col-xs-5">
        			<div class="input-group">
        		  	<input type="text" id="interpretation" name="interpretation" placeholder="interprettion..." class="form-control" disabled/>
        			</div>
						</div>
        	</div>{{-- end row --}}
     			<div class="space-12"></div><div class="space-12"></div><div class="space-12"></div>
        	<div class="row">
						<div class="col-xs-2">
	        		<label class="col-sm-12 control-label no-padding-right right" for="IMC"><strong class="text-nowrap" >Températeur :</strong></label>
	       		</div>
        		<div class="col-xs-3">
							<div class="input-group">
							  <input type="number" id="temp" name="temp" placeholder="Temperateur du Patient..." class="form-control"  min ="30" step="any"/>
							    <span class="input-group-addon"> <small>°C</small> </span>
								</div>
						</div>
						<div class="col-xs-2">
        			<label class="col-sm-12 control-label no-padding-right right" for="autre"><strong>Autre :</strong></label>
        		</div>
        		<div class="col-xs-5">
							<div class="input-group">
						    <textarea id="autre" name="autre" placeholder="..." class="form-control" min ="30" step="any"></textarea>
							</div>
						</div>
					</div>	
        	<div class="space-12"></div><div class="space-12"></div><div class="space-12"></div>
        	<div class="row">
        		<div class="col-sm-3"> 		
        			<div class="form-group">
	           		<label class="control-label no-padding-right right" for="etatgen"><strong>Etat Géneral du patient :</strong></label>
	            </div>
	       		</div>	
	          <div class="col-sm-8">
				      <textarea type="text" id="etatgen" name="etatgen" placeholder= "Etat Géneral du patient..." class="form-control"></textarea>
					  </div>	
        	</div>{{-- end row --}}
        	<div class="space-12"></div>	<div class="space-12"></div>	<div class="space-12"></div>
        	<div class="row">
        		<div class="col-sm-3"> 
        			<div class="form-group">
				        <label class="control-label no-padding-right right" for="etatgen"><strong>Peau et phanéres :</strong></label>
				      </div>
				    </div>
				    <div class="col-sm-8">
				      <textarea type="text" id="peaupha" name="peaupha" placeholder= "Peau et phanéres ..."   class="form-control"></textarea>
				    </div>
					</div>{{-- end row --}}
				</div>{{-- md-8 --}}
			 	<div class= "col-md-4 col-xs-4 col-offset-md-1">
					<br/><br/><br/>
          <div class="right">
         	  <div class="profile-contact-links align-right">
         	 		<a  href="#" data-target="#Ordonnance" class="btn btn-primary btn-lg" style="width:100%;" data-toggle="modal" data-toggle="tooltip" data-original-title="">
              	<div class="fa fa-plus-circle"></div><span class="bigger-110" > Ordonnance</span>
              </a>
            	<div class="space-12"></div>
	        			<a href="#" data-target="#RDV" class="btn btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal" data-toggle="tooltip" data-original-title="">
	         				<div class="fa fa-plus-circle"></div><span class="bigger-110">Rendez-vous</span>
	          		</a>
            </div> {{-- profile-contact-links --}}
            <div class="space-12"></div>
            <div class="profile-contact-info">
              <div class="profile-contact-links align-right">
              	<a  href="#" data-target="#demandehosp" class="btn  btn-primary btn-lg" style="width:250px;" data-toggle="modal"   data-toggle="tooltip" data-original-title="" >
                  <div class="fa fa-plus-circle"></div><span class="bigger-110"> Hospitalisation</span>
                </a>
                <div class="space-12"></div>
								<a class="btn btn-primary btn-lg" data-toggle="modal"  data-toggle="tooltip" data-original-title="lettre d'orientation" data-target="#lettreorient" style="width:250px;" onclick="lettreoriet('{{ $employe->nom }}','{{ $employe->prenom }}','{{ $employe->specialite }}','{{ $employe->tele_mobile }}')">
                	<div class="fa fa-plus-circle"></div><span class="bigger-110" style ="text-align: right !important;">Orientation</span> 
                </a>
              </div>
              <div class="space-6"></div> 
            </div>  
          </div>
				</div>{{-- fin col-md-3 --}}
			</div>{{-- ExamGen --}}
			<div role="tabpanel" class = "tab-pane" id="Appareils"> 
				<div class="space-12"></div><div class="space-12"></div><div class="space-12"></div>
        <div class= "col-md-8 col-xs-8">@include("consultations.ExamenAppareils")</div>	{{-- col-md-8 col-xs-9 --}} 
			 	<div class= "col-md-4 col-xs-4">
					<br/><br/><br/>
          <div class="right">
            <div class="profile-contact-links align-right">
              <a  href="#" data-target="#Ordonnance" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal"   data-toggle="tooltip" data-original-title="" >
               	<div class="fa fa-plus-circle"></div><span class="bigger-110"> Ordonnance</span>
              </a>
              <div class="space-12"></div>
	        		<a href="#" data-target="#RDV" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal"   data-toggle="tooltip" data-original-title="" >
	         			<div class="fa fa-plus-circle"></div><span class="bigger-110">Rendez-vous</span>
	          	</a>
            </div> {{-- profile-contact-links --}}
            <div class="space-12"></div>
            <div class="profile-contact-info">
              <div class="profile-contact-links center">
                <a href="#" data-target="#demandehosp" class="btn  btn-primary btn-lg tooltip-link" style="width:250px;" data-toggle="modal"   data-toggle="tooltip" data-original-title="" >
                 	<div class="fa fa-plus-circle"></div><span class="bigger-110"> Hospitalisation</span>
                </a>
                <div class="space-12"></div>
       					<a class="btn btn-primary btn-lg tooltip-link" data-toggle="modal"  data-toggle="tooltip" data-original-title="lettre d'orientation" data-target="#lettreorient" style="width:250px;" onclick="lettreoriet('{{ $employe->nom }}','{{ $employe->prenom }}','{{ $employe->specialite }}','{{ $employe->tele_mobile }}')">
                  <div class="fa fa-plus-circle"></div><span class="bigger-110">Orientation</span> 
                </a>
              </div>
              <div class="space-6"></div> 
            </div>  
          </div>
				</div>{{-- end col-md-3 --}}
			</div>		
		</div>{{-- tab-content --}}
	</div>
</div>
<br><br>