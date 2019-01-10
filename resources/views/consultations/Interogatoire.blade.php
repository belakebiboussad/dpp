<div class="tabpanel">
<ul class = "nav nav-pills nav-justified navbar-custom list-group" role="tablist" id ="intero">
      <li role= "presentation" name="motif" class="active">
        <a href="#Motif" aria-controls="Motif" role="tab" data-toggle="tab" class="jumbotron">
          <i class="fa fa-comment fa-2x"></i>
         <span class="bigger-130"> Motif</span>
     </a>
      </li>
      <li role= "presentation">
        <a href="#ATCD" aria-controls="ATCD"  data-toggle="tab" class="jumbotron">
     	  	<i class="fa fa-history fa-2x"></i>
        		<span class="bigger-130">Antecedants</span>
        </a>
      </li>
</ul>

<div class ="tab-content "  style = "border-style: none;" >
        <div role="tabpanel" class = "tab-pane active" id="Motif">
          <div class= "col-md-9 col-xs-12">	
		<br><br><br>
	<!-- Material input -->
		<div class="row">		
			<div class="form-group padding-left">
				<input  type="checkbox" id="isOriented" name="isOriented"   value="1"  class="ace input-lg"/>
				<span class="lbl lighter red"> <strong>Patient Orienté</strong></span>
			</div>		
		</div>
		<div class="space-12"></div>
		<div class="space-12"></div>
		<div class="row">	
			<div class="form-group" id="hidden_fields" hidden>	
			           <label class="col-sm-3 control-label no-padding-right" for="lettreorientaion">
					<strong>Lettre d'orientation :</strong>  
				</label>	
				<div class="col-sm-8">	
					<textarea type="text" id="lettreorientaioncontent" name="lettreorientaioncontent" placeholder="..." class="form-control" required  ></textarea>
				</div>
				<div class="space-12"></div>
				<div class="space-12"></div>
				<br><br>	
			</div>	
		</div>
		
		<div class="row">	
			<div class="form-group">
				<div class="form-group {{ $errors->has('motif') ? 'has-error' : '' }}">
					<label class="col-sm-3 control-label no-padding-right" for="motif">
						<strong>Motif de Consultation :</strong>  
					</label>
					<div class="col-sm-8">
						<input type="text" id="motif" name="motif" placeholder="Motif de Consultation..." class="form-control" required/>
					</div>
				</div>
			</div>
		</div>
		<div class="space-12"></div>
		<div class="space-12"></div>
		<div class="row">	
			 <div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="histoirem">
					<strong>Histoire de la maladie :</strong>  
				</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="histoirem" name="histoirem" placeholder="Histoire de la maladie..."  value="" required></textarea>
				</div>		
			</div>
		</div>
		<div class="space-12"></div>
		<div class="space-12"></div>
		<div class="row">	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="diagnostic">
					<strong>Diagnostic :</strong>  
				</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="diagnostic" name="diagnostic" placeholder="Diagnostic..." ></textarea>
				</div>
			</div>
		</div>
		<div class="space-12"></div>
		<div class="space-12"></div>
		<div class="row">	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="codecim"><strong>Code Cim10 :</strong></label>
				<div class="col-sm-8">
				<select class="form-control" id="codesim" name="codesim">
					<option value="">Choisir...</option>
					@foreach($codesim as $code)
					<option value="{{$code->id}}">{{ $code->code }} : {{ $code->description }} ></option>
					@endforeach
				</select>	
				</div>
			</div>
		</div>
		<div class="space-12"></div>
		<div class="space-12"></div>
		<div class="row">	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="resume">
					<strong>Résumé :</strong>  
				</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="resume" name="resume" placeholder="Résumé..." value="a" required></textarea>
				</div>
			</div>
		</div>
		<div class="space-12"></div>
		<div class="space-12"></div>
	 </div>  {{-- fin col-md-8 col-xs-12 --}}
	<div class= "col-md-3 col-xs-8 right">
	   	<br/><br/><br/>
	   	<div class="space-4"></div>  
                     <div class="space-4"></div>  
	  	<div class="left">
                           	 <div class="space-12"></div><div class="space-12"></div><div class="space-12"></div><br><br>
			{{-- <div class="profile-contact-info menu"> --}}
			<div class="profile-contact-links align-center">
				<a  href="#" data-target="#Ordonnance" class="text btn  btn-primary btn-lg tooltip-link" 
			      	 style= " width:100%;" data-toggle="modal" data-toggle="tooltip" data-original-title="prescrire des medicaaments" >        
					<div class="fa fa-plus-circle"></div>
                                                    <span class="bigger-140"> Ordonnance</span>
                                          </a>  
                                          <div class="space-12"></div>
				<a  href="#" data-target="#demandehosp" class="text btn  btn-primary btn-lg tooltip-link" style= " width:100%;" data-toggle="modal"   data-toggle="tooltip" data-original-title="création d'une demande d'hospitalisation" > 
					           <div class="fa fa-plus-circle"></div>
                                                     <span class="bigger-140"> Hospitalisation</span>
                                           </a>
				<div class="space-12"></div>
				<a class="text btn btn-primary btn-lg" data-toggle="modal" data-target="#lettreorient" style= " width:100%;overflow-wrap: break-word;" onclick="lettreoriet('{{ $employe->Nom_Employe }}',
						'{{ $employe->Prenom_Employe }}',
						'{{ $employe->Specialite_Emploiye }}',
						'{{ $employe->tele_mobile }}')">
						{{--  <i class="ace-icon fa fa-plus-circle bigger-120 black fa-vc"></i> --}}
						<div class="fa fa-plus-circle"></div>
						 <span class="bigger-140" style="overflow-wrap: break-word;" >Orientation</span>
 				</a>
			</div>
			<div class="space-6"></div>	
			{{-- </div> --}}       
                                </div>
                      </div>

        </div>  {{-- fin tabepane: --}}
        <br><br>
        <div role="tabpanel" class = "tab-pane " id="ATCD"> 
        	<div class= "col-md-6 col-xs-6">
        		 @include('consultations.Antecedant')
        	</div>
        	<div class= "col-md-6 col-xs-6">
        		<div class="widget-box widget-color-GhostWhite  ui-sortable-handle" id="widget-box-11" >
        		     <div class="widget-header" >
                        <h6 class="widget-title">
                        	<font color="black">
                        		<b>Antecedants</b>
                        	</font>
                        </h6>
                        <div class="widget-toolbar">
                            <a href="#">
                               <i class="ace-icon fa fa-check"></i>
                               Valider
                            </a>
                   	</div>
                    </div>
		<div class="widget-body" id ="ATCDWidget">
                        <div class="widget-main no-padding">
                            <table class="table table-striped table-bordered table-hover" id="ants-tab">
                              	<thead class="thin-border-bottom">
                                	<tr>
	                                 	<th>Type</th>
	                                  	<th><i class="fa fa-clock-o" aria-hidden="true"></i>Date</th>
	                                  	<th class="hidden-480">Description</th>
	                                  	<th class="hidden-480"></th>
                                	</tr>
                       			</thead>
		                        <tbody>
		                        </tbody>
                            </table>
                     	</div>
                    </div>
        		</div>
			</div>	 {{-- <div class= "col-md-3 col-xs-3"> --}}
        </div>
</div>
</div>