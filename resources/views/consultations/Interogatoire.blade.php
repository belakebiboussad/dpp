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
				<i class="fa fa-history fa-2x"></i><span class="bigger-130">Antecedants</span>
			</a>
		</li>
	</ul>
	<div class ="tab-content"  style = "border-style: none;" >
		<div role="tabpanel" class = "tab-pane active" id="Motif">
		<div class= "col-md-8 col-xs-9"> 
			<div class="row">		
			<div class="form-group padding-left">
				<input  type="checkbox" id="isOriented" name="isOriented"   value="1"  class="ace input-lg"/>
					<span class="lbl lighter red"> <strong>Patient Orienté</strong></span>
			</div>		
			</div>
			<div class="row">	
				<div class="form-group" id="hidden_fields" hidden>	
				<label class="col-sm-3 control-label no-padding-right" for="lettreorientaion">
					<strong>Lettre d'orientation :</strong>  
				</label>	
				<div class="col-sm-8">	
					<textarea type="text" id="lettreorientaioncontent" name="lettreorientaioncontent" placeholder="Resumé" class="form-control" required  ></textarea>
				</div>
				</div>	
			</div>	
			<div class="space-12"></div>
			<div class="row">	
				<div class="form-group {{ $errors->has('motif') ? 'has-error' : '' }}">
				<label class="col-sm-4 control-label no-padding-right" for="motif">
					<strong>Motif de Consultation :</strong>  
				</label>
				<div class="col-sm-8">
				<input type="text" id="motif" name="motif" placeholder="Motif de Consultation..." class="form-control" required/>
				</div>
				</div>
			</div>
			<div class="space-12"></div>
        			<div class="row">	
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-right" for="histoirem">
					<strong>Histoire de la maladie :</strong>  
				</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="histoirem" name="histoirem" placeholder="Histoire de la maladie..."  value="" required></textarea>
				</div>		
			</div>
			</div>
			<div class="space-12"></div>
			<div class="row">	
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-right" for="diagnostic">
					<strong>Diagnostic :</strong>  
				</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="diagnostic" name="diagnostic" placeholder="Diagnostic..." ></textarea>
				</div>
			</div>
			</div>
			<div class="space-12"></div>
			<div class="row">	
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-right" for="codecim"><strong>Code Cim10 :</strong></label>
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
			<div class="row">	
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-right" for="resume">
				<strong>Résumé :</strong>  
				</label>
				<div class="col-sm-8">
				<textarea class="form-control" id="resume" name="resume" placeholder="Résumé..." value="a" required></textarea>
				</div>
			</div>
			</div>
			<div class="space-12"></div>
			<div class="space-12"></div>
		</div><!-- col-md-8 col-xs-9 -->
		<div class= "col-md-4 col-xs-4">
			<br/><br/>
		  <div class="right">
		   	<div class="space-12"></div>
		   	<div class="space-12"></div>
		   	<div class="space-12"></div>
		    <div class="profile-contact-links align-right">
	        <a  href="#" data-target="#Ordonnance" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal"   data-toggle="tooltip" data-original-title="" >
	         	<div class="fa fa-plus-circle"></div>
	          <span class="bigger-110" > Ordonnance</span>
	        </a>
	       	<div class="space-12"></div>
	        <a  href="#" data-target="#demandehosp" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal"   data-toggle="tooltip" data-original-title=""><div class="fa fa-plus-circle"></div>
          	<span class="bigger-110"> Hospitalisation</span>
         	</a>
         	<div class="space-12"></div>
         	<a class="btn btn-primary btn-lg tooltip-link" data-toggle="modal"  data-toggle="tooltip" data-original-title="lettre d'orientation" data-target="#lettreorient" style="width:100%;" onclick="lettreoriet('{{ $employe->Nom_Employe }}','{{ $employe->Prenom_Employe }}',
            '{{ $employe->Specialite_Emploiye }}','{{ $employe->tele_mobile }}')">
           	<div class="fa fa-plus-circle"></div>
           	<span class="bigger-110" style ="text-align: right !important;">Orientation</span> 
         	</a>
	      </div> {{-- profile-contact-links --}}         
	                     	</div>
	           </div>{{-- col-md-4 col-xs-4 --}}
		</div><!-- MOTIF -->
		<div role="tabpanel" class = "tab-pane " id="ATCD"> 
			<div class= "col-md-8 col-xs-8">
			        	 @include('consultations.Antecedant')
			</div>
			<div class= "col-md-4 col-xs-4">
				<br/><br/>
		   	<div class="right">
		      <div class="space-12"></div>
		     	<div class="space-12"></div>
		     	<div class="space-12"></div>
		      <div class="profile-contact-links align-right">
	          <a  href="#" data-target="#Ordonnance" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal"   data-toggle="tooltip" data-original-title="" >
	           	<div class="fa fa-plus-circle"></div>
	            <span class="bigger-110" > Ordonnance</span>
	          </a>
	         	<div class="space-12"></div>
	          <a  href="#" data-target="#demandehosp" class="btn  btn-primary btn-lg tooltip-link" style="width:100%;" data-toggle="modal"   data-toggle="tooltip" data-original-title=""><div class="fa fa-plus-circle"></div>
             	<span class="bigger-110"> Hospitalisation</span>
           	</a>
            <div class="space-12"></div>
             	<a class="btn btn-primary btn-lg tooltip-link" data-toggle="modal"  data-toggle="tooltip" data-original-title="lettre d'orientation" data-target="#lettreorient" style="width:100%;" onclick="lettreoriet('{{ $employe->Nom_Employe }}','{{ $employe->Prenom_Employe }}',
                '{{ $employe->Specialite_Emploiye }}','{{ $employe->tele_mobile }}')">
              	<div class="fa fa-plus-circle"></div>
               	<span class="bigger-110" style ="text-align: right !important;">Orientation</span> 
             	</a>
	          </div> {{-- profile-contact-links --}}         
	      </div>
	    </div>{{-- col-md-4 col-xs-4 --}}
		</div>
	</div>
</div>{{-- tabpanel --}}
<br><br>
