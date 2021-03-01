<div class="tabpanel">
  <div class="row">
		<ul class = "nav nav-pills nav-justified navbar-custom list-group" role="tablist" id ="intero">
			 <li role= "presentation" name="motif" class="active">
			    <a href="#Motif" aria-controls="Motif" role="tab" data-toggle="tab" class="jumbotron">
			      <i class="fa fa-comment fa-2x pull-left"></i> <span class="bigger-130"> Motif</span>
				  </a>
			</li>
			<li role= "presentation">
				<a href="#ATCD" aria-controls="ATCD"  data-toggle="tab" class="jumbotron">
					<i class="fa fa-history fa-2x pull-left"></i><span class="bigger-130">Antecedants</span>
				</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class= "col-md-9 col-xs-9">
			<div class ="tab-content"  style = "border-style: none;" >
				<div role="tabpanel" class = "tab-pane active" id="Motif">
					<div class="row">		
						<div class="form-group padding-left">
							<input  type="checkbox" id="isOriented" name="isOriented" class="ace input-lg"/><span class="lbl lighter red"> <strong>Patient Orienté</strong></span>
						</div>		
					</div>
					<div class="row">	
						<div class="form-group" id="hidden_fields" hidden>	
							<label class="col-sm-3 control-label no-padding-right" for="lettreorientaion"><strong>Lettre d'orientation :</strong></label>	  
							<div class="col-sm-8"><textarea type="text" id="lettreorientaioncontent" name="lettreorientaioncontent" placeholder="Resumé" class="form-control"></textarea></div>
						</div>	
					</div><div class="space-12"></div>
					<div class="row">	
						<div class="form-group {{ $errors->has('motif') ? 'has-error' : '' }}">
							<label class="col-sm-4 control-label no-padding-right" for="motif"><strong>Motif de Consultation : <span style="color: red">*</span></strong></label> 
							<div class="col-sm-8"><input type="text" id="motif" name="motif" placeholder="Motif de Consultation..." class="form-control"/></div>
						</div>
					</div><div class="space-12"></div>
		      <div class="row">	
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-right" for="histoirem"><strong>Histoire de la maladie :</strong> </label>
							<div class="col-sm-8">
								<textarea class="form-control" id="histoirem" name="histoirem" placeholder="Histoire de la maladie..."></textarea>
							</div>		
						</div>
					</div><div class="space-12"></div>
					<div class="row">	
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="diagnostic"><strong>Diagnostic :</strong> </label> 
						<div class="col-sm-8"><textarea class="form-control" id="diagnostic" name="diagnostic" placeholder="Diagnostic..." ></textarea></div>
					</div>
					</div><div class="space-12"></div>
					<div class="row">
		    	 	<div class="form-group">
		    			<label class="col-sm-4 control-label no-padding-right" for="codecim"><strong>Code Cim10 :</strong></label>
							<div class="col-sm-8 input-group" style="padding-left:15px;">
							  <input type="text" class="form-control" id="codesim" name="codesim"/>
							  <span class="input-group-addon" style=" padding: 0px 6px;"> 
							    <button class="btn btn-xs CimCode" type="button" value="codesim"><i class="fa fa-search"></i></button>
							  </span>
					    </div>
				    </div>
					</div><div class="space-12"></div>
					<div class="row">	
						<div class="form-group">
							<label class="col-sm-4 control-label no-padding-right" for="resume"><strong>Résumé :<span style="color: red">*</span></strong></label>  
							<div class="col-sm-8"><textarea class="form-control" id="resume" name="resume" placeholder="Résumé..."></textarea></div>
						</div>
					</div><div class="space-12"></div><div class="space-12"></div>
				</div><!-- Motif -->
				<div role="tabpanel" class = "tab-pane " id="ATCD">@include('consultations.Antecedant')</div>
			</div>
		</div>
		<div class= "col-md-3 col-xs-3">@include('consultations.actions')</div>
	</div>
</div>