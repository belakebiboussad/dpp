<div class="page-header"><h1>Détails du service &quot;{{ $service->nom }} &quot;</h1></div>
<div class="row">
	<div class="col-xs-12">
		<div class="widget-box">
		  <div class="widget-header"><h5 class="widget-title">Service &quot;{{ $service->nom }} &quot;</h5>
		  </div>
			<div class="widget-body">
			<div class="widget-main">
        <div class="form-group row">
          <label for="nom" class="col-sm-4 col-form-label">Nom</label>
          <div class="col-sm-8"><p class = "form-control-static">{{ $service->nom }}</p></div>
        </div>
				<div class="form-group row">
					<label class="col-sm-4 col-control-label">Type</label>
					<div class="col-sm-8"><p class = "form-control-static">{{ $service->type }}</p></div>
        </div>
				<div class="form-group row">
					<label class="col-sm-4 col-control-label">Chef de Service</label>
					<div class="col-sm-8">
            <p class = "form-control-static">{{ ($service->responsable_id) ? $service->responsable->full_name :'' }}</p>
          </div>
				</div>
        <div class="form-group  @if($service->type == 'Paramédical') hidden @endif row"  >
					<div class="col-sm-8">
            <div class="checkbox col-sm-offset-6">
				      <label><input type="checkbox" class="ace" name="hebergement" value ="1" {{(isset($service->hebergement))? 'checked':''}} 
              disabled/><span class="lbl">Hébergement</span></label>
            </div>
          </div>
				</div>
				<div class="form-group @if($service->type == 'Paramédical') hidden @endif row">
					<div class="col-sm-8">
            <div class="checkbox col-sm-offset-6">
					  <label><input type="checkbox" class="ace" name="urgence" value ="1" {{(isset($service->urgence))? 'checked':''}} disabled/><span class="lbl">Urgence</span></label>
            </div>
          </div>
				</div><br>	
			</div>
		  </div>
		</div>
	</div>
</div>