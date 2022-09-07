<div class="row">
	 <div class="col-md-4"></div>
	 <div class="col-md-8"><input  type="checkbox" id="isOriented" name="isOriented" class="ace input-lg"/><span class="lbl lighter red"> <strong>Patient orienté</strong></span></div>
</div><br>
<div class="row">	
	<div class="form-group" id="hidden_fields" hidden>	
		<label class="col-sm-4 control-label" for="lettreorientaion">Orienté pour :</label>	  
		<div class="col-sm-8"><textarea type="text" id="lettreorientaioncontent" name="lettreorientaioncontent" placeholder="Resumé" class="form-control"></textarea></div>
	</div>	
</div>
<div class="row">	
	<div class="form-group {{ $errors->has('motif') ? 'has-error' : '' }}">
		<label class="col-sm-4 control-label no-padding-right" for="motif">Motif de consultation : <span class="text-danger">*</span></label> 
		<div class="col-sm-8"><input type="text" id="motif" name="motif" placeholder="Motif de Consultation..." class="form-control" required/></div>
	</div>
</div>
<div class="row">	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="histoirem">Histoire de la maladie :</label>
		<div class="col-sm-8">
			<textarea class="form-control" id="histoirem" name="histoirem" placeholder="Histoire de la maladie..."></textarea>
		</div>		
	</div>
</div>
<div class="row">	
<div class="form-group">
	<label class="col-sm-4 control-label" for="diagnostic">Diagnostic :</label> 
	<div class="col-sm-8"><textarea class="form-control" id="diagnostic" name="diagnostic" placeholder="Diagnostic..." ></textarea></div>
</div>
</div>
 <div class="form-group row">
    <label for="codesim" class="col-sm-4 control-label">Code CIM-10  :</label>
    <div class="input-group">
      <input type="text" class="form-control col-sm-4" placeholder="Rechercher code cim10 for..." id="codesim" name="codesim">
      <span class="input-group-btn">
        <button class="btn btn-secondary btn-xs CimCode" type="button"  value="codesim"><i class="fa fa-search"></i></button>
      </span>
    </div>
</div>
                  {{-- end added --}}
<div class="row">	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="resume">Résumé :<span class="text-danger">*</span></label>  
		<div class="col-sm-8"><textarea class="form-control" id="resume" name="resume" placeholder="Résumé..." required></textarea></div>
	</div>
</div>