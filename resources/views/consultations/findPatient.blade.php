
	<div class="panel panel-default">
			<div class="panel-heading left" style="height: 50px;background-color: #F6E3CE;">
				<h5><strong>Rechercher un patient</strong></h5>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">	
					<div class="col-sm-3 col-xs-3">
			    			  <div class="form-group">
			      				<label class="control-label" for="Nom">Nom:</label>
							<div class="input-group">
								<input type="text" class="autofield form-control input-sx" id="Nom" name="Nom" placeholder="Nom" autofocus/>
								<span class="glyphicon glyphicon-search form-control-feedback"></span>
					    </div>
						</div>
					</div>
					<div class="col-sm-3 col-xs-3">
						<div class="form-group">
							<label class="control-label" for="Prenom">Prénom:</label> 
							<div class="input-group">
						  	<input type="text" class="form-control input-sx autofield" id="Prenom" name="Prenom"  placeholder="Prénom"> 
						  	<span class="glyphicon glyphicon-search form-control-feedback"></span>
			   			</div>		
						</div>
					</div>
					<div class="col-sm-3 col-xs-3">
						<div class="form-group">
							<label class="control-label" for="Prenom">Né(e):</label> 
							<div class="input-group" >
							<input type="text" class="form-control input-sx date-picker" id="Dat_Naissance" name="Dat_Naissance" data-date-format="yyyy-mm-dd" ; placeholder="yyyy-mm-dd" data-toggle="tooltip" data-placement="left" title="Date Naissance"> 
						  	<span class="glyphicon glyphicon-search form-control-feedback"></span>
			   			</div>		
						</div>
					</div>
					<div class="col-sm-3 col-xs-3">
						<div class="form-group">
							<label class="control-label" for="IPP">IPP:</label>
							<div class="input-group">
								<input type="text" class="form-control input-sx autofield" id="IPP" name="IPP"  placeholder="Identifiant" data-toggle="tooltip" data-placement="left">
					   	  <span class="glyphicon glyphicon-search form-control-feedback"></span>
							</div>		
						</div>		
					</div>
				</div>
				</div>
			</div>
			<div class="panel-footer">
		   	<button type="submit" class="btn btn-xs btn-primary findptient "><i class="fa fa-search"></i>&nbsp;Rechercher</button>		
			</div>
	</div>