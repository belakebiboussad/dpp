
	<div class="panel panel-default">
			<div class="panel-heading left" style="height: 40px;">
				<strong>Rechercher un Patient</strong>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">	
					<div class="col-sm-3 col-xs-3">
			    			  <div class="form-group">
			      				<label class="control-label" for="Nom" ><strong>Nom:</strong></label>
							<div class="input-group">
								<input type="text" class="autofield form-control input-sx" id="Nom" name="Nom" placeholder="nom du patient..." autofocus/>
								<span class="glyphicon glyphicon-search form-control-feedback"></span>
					    </div>
						</div>
					</div>
					<div class="col-sm-3 col-xs-3">
						<div class="form-group">
							<label class="control-label" for="Prenom" ><strong>Prenom:</strong></label> 
							<div class="input-group">
						  	<input type="text" class="form-control input-sx autofield" id="Prenom" name="Prenom"  placeholder="prenom du patient..."> 
						  	<span class="glyphicon glyphicon-search form-control-feedback"></span>
			   			</div>		
						</div>
					</div>
					<div class="col-sm-3 col-xs-3">
						<div class="form-group">
							<label class="control-label" for="Prenom" ><strong>Né(e):</strong></label> 
							<div class="input-group">
						  	<input type="text" class="form-control input-sx date-picker" id="Dat_Naissance" name="Dat_Naissance" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" data-toggle="tooltip" data-placement="left" title="Date Naissance"> 
						  	<span class="glyphicon glyphicon-search form-control-feedback"></span>
			   			</div>		
						</div>
					</div>
					<div class="col-sm-3 col-xs-3">
						<div class="form-group">
							<label class="control-label" for="IPP" ><strong>IPP:</strong></label>
							<div class="input-group">
								<input type="text" class="form-control input-sx autofield" id="IPP" name="IPP"  placeholder="IPP du patient..." data-toggle="tooltip" data-placement="left">
					   	  <span class="glyphicon glyphicon-search form-control-feedback"></span>
							</div>		
						</div>		
					</div>
				</div>
				</div>
			</div>
			<div class="panel-footer" style="height: 50px;">
		   	<button type="submit" class="btn btn-xs btn-primary findptient " style="vertical-align: middle"><i class="fa fa-search"></i>&nbsp;Rechercher</button>		
			</div>
	</div>