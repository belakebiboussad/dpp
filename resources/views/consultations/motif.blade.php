<div class="row">
	 <div class="col-md-4"></div>
	 <div class="col-md-8"><input  type="checkbox" id="isOriented" name="isOriented" class="ace input-lg"/><span class="lbl lighter red"> <strong>Patient orienté</strong></span></div>
</div><br>
<div class="row">	
	<div class="form-group" id="hidden_fields" hidden>	
		<label class="col-sm-4 control-label no-padding-right" for="lettreorientaion">Orienté pour :</label>	  
		<div class="col-sm-8"><textarea type="text" id="lettreorientaioncontent" name="lettreorientaioncontent" placeholder="Resumé" class="form-control"></textarea></div>
	</div>	
</div>
<div class="row">	
	<div class="form-group {{ $errors->has('motif') ? 'has-error' : '' }}">
		<label class="col-sm-4 control-label no-padding-right" for="motif">Motif de consultation : <span style="color: red">*</span></label> 
		<div class="col-sm-8"><input type="text" id="motif" name="motif" placeholder="Motif de Consultation..." class="form-control"/></div>
	</div>
</div>
<div class="row">	
	<div class="form-group">
		<label class="col-sm-4 control-label no-padding-right" for="histoirem">Histoire de la maladie :</label>
		<div class="col-sm-8">
			<textarea class="form-control" id="histoirem" name="histoirem" placeholder="Histoire de la maladie..."></textarea>
		</div>		
	</div>
</div>
<div class="row">	
<div class="form-group">
	<label class="col-sm-4 control-label no-padding-right" for="diagnostic">Diagnostic :</label> 
	<div class="col-sm-8"><textarea class="form-control" id="diagnostic" name="diagnostic" placeholder="Diagnostic..." ></textarea></div>
</div>
</div>
<div class="row">
 	<div class="form-group">
		<label class="col-sm-4 control-label no-padding-right" for="codecim">Code CIM-10 :</label>
		<div class="col-sm-8 input-group" style="padding-left:15px;">
		  <input type="text" class="form-control" id="codesim" name="codesim" disabled/>
		  <span class="input-group-addon" style=" padding: 0px 6px;"> 
		    <button class="btn btn-xs CimCode" type="button" value="codesim" data-toggle="modal" data-target="#cim10Modal"><i class="fa fa-search"></i></button>
		  </span>
    </div>
  </div>
</div>
<div class="row">	
	<div class="form-group">
		<label class="col-sm-4 control-label no-padding-right" for="resume">Résumé :<span style="color: red">*</span></label>  
		<div class="col-sm-8"><textarea class="form-control" id="resume" name="resume" placeholder="Résumé..."></textarea></div>
	</div>
</div>