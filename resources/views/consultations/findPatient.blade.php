<div class="col-sm-6">
	<div class="panel panel-default">
			<div class="panel-heading left" style="height: 40px;">
				<strong>Rechercher un Patient</strong>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">	
					<div class="col-sm-4 col-xs-4">
			    			  <div class="form-group">
			      				<label class="control-label" for="patientName" ><strong>Nom:</strong></label>
							<div class="input-group">
								<input type="text" class="form-control input-sx" id="patientName" name="patientName" placeholder="nom du patient..." autofocus/>
								<span class="glyphicon glyphicon-search form-control-feedback"></span>
					    </div>
						</div>
					</div>
					<div class="col-sm-4 col-xs-4">
						<div class="form-group">
							<label class="control-label" for="patientFirstName" ><strong>Prenom:</strong></label> 
							<div class="input-group">
						  	<input type="text" class="form-control input-sx" id="patientFirstName" name="patientFirstName"  placeholder="prenom du patient..."> 
						  	<span class="glyphicon glyphicon-search form-control-feedback"></span>
			   			</div>		
						</div>
					</div>
					<div class="col-sm-4 col-xs-4">
						<div class="form-group">
							<label class="control-label" for="IPP" ><strong>IPP:</strong></label>
							<div class="input-group">
								<input type="text" class="form-control input-sx tt-input" id="IPP" name="IPP"  placeholder="IPP du patient..." data-toggle="tooltip" data-placement="left" title="Code IPP du patient">
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
</div>
<div class="col-sm-6 col-xs-6">
	<table id="liste_patients" class="display table-responsive" width="100%"></table>
</div>
