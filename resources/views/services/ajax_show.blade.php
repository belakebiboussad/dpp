<div class="page-header"><h1>Détails du service &quot;{{ $service->nom }} &quot;</h1></div>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box" id="widget-box-1">
			  <div class="widget-header"><h5 class="widget-title">Service &quot;{{ $service->nom }} &quot;</h5>
			  </div>
				<div class="widget-body">
				<div class="widget-main">
          <div class="form-group row">
            <label for="nom" class="col-sm-4 col-form-label">Nom</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" value="{{ $service->nom }}">
            </div>
          </div>
  				<div class="form-group row">
						<label class="col-sm-4 col-control-label">Type</label>
						<div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" value="{{ $service->type }}">
            </div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-control-label">Chef de Service</label>
						<div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" value="{{ ($service->responsable_id) ? $service->responsable->full_name :'' }}">
            </div>
					</div>
					<div class="form-group @if($service->type == 2) hidden @endif row">
							<label class="col-sm-4 col-control-label" for="hebergement">Hébergement</label>
							<div class="col-sm-8">
							<label>
								<input name="hebergement" value="0" type="radio" class="ace" @if(!($service->hebergement)) checked @endif disabled/>
									<span class="lbl">Non</span></label>&nbsp;&nbsp;
								<label>
									<input name="hebergement" value="1" type="radio" class="ace" @if($service->hebergement) checked @endif disabled/>
									<span class="lbl">Oui</span></label>
								</div>
						</div>
						<div class="form-group @if($service->type == 2) hidden @endif row">
							<label class="col-sm-4 col-control-label" for="urgence">Urgence</label>
							<div class="col-sm-8">
							<label>
								<input name="urgence" value="0" type="radio" class="ace" @if(!($service->urgence)) checked @endif disabled/>
									<span class="lbl">Non</span></label>&nbsp;&nbsp;
								<label>
									<input name="urgence" value="1" type="radio" class="ace" @if($service->urgence) checked @endif disabled/>
									<span class="lbl">Oui</span></label>
								</div>
						</div><br>	
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>