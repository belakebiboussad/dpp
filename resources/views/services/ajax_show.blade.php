<div class="page-header"><h1>Détails du service :</h1></div>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box" id="widget-box-1">
				<div class="widget-header"><h5 class="widget-title">Service <b>&nbsp; &quot; {{ $service->nom }} &quot; :</b></h5>
					<div class="pull-right">
{{-- 	<a href="{{ route('service.index') }}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-search bigger-120 blue"></i>Liste des services</a>
<a href="{{route('service.destroy',$service->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-white btn-warning btn-bold"><i class="ace-icon fa fa-trash-o bigger-120 orange">Supprimer</i></a> --}}
					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right">Nom : </label>
							<div class="col-sm-9">{{ $service->nom }}</div>
						</div>
						<div class="space-12 hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right">Type :</label>
							<div class="col-sm-9">{{ $service->type }}</div>
						</div>
						<div class="space-12 hidden-xs"></div><div class="space-12 hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right">Chef de Service :</label>
							<div class="col-sm-9"><b>{{ ($service->responsable_id) ? $service->responsable->full_name :'' }}</b></div>
						</div><div class="space-12 hidden-xs"></div><div class="space-12 hidden-xs"></div>
						<div class="form-group @if($service->type == 2) hidden @endif">
							<label class="col-sm-3 control-label" for="hebergement">Hébergement :</label>
							<div class="col-sm-9">
							<label>
								<input name="hebergement" value="0" type="radio" class="ace" @if(!($service->hebergement)) checked @endif disabled/>
									<span class="lbl">Non</span></label>&nbsp;&nbsp;
								<label>
									<input name="hebergement" value="1" type="radio" class="ace" @if($service->hebergement) checked @endif disabled/>
									<span class="lbl">Oui</span></label>
								</div>
						</div><div class="space-12 hidden-xs"></div><div class="space-12 hidden-xs"></div>
						<div class="form-group @if($service->type == 2) hidden @endif">
							<label class="col-sm-3 control-label" for="urgence">Urgence :</label>
							<div class="col-sm-9">
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