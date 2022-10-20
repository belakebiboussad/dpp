@extends('app')
@section('main-content')
	<div class="row"><h4><b>Consultations des détails du service :</b></h4></div>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box">
				<div class="widget-header"><h5 class="widget-title"><b>Détails du service :</b></h5>
					<div class="pull-right">
						<a href="{{ route('service.index') }}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-search bigger-120 blue"></i>Liste des services</a>
						<a href="{{route('service.destroy',$service->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-white btn-danger btn-bold"><i class="ace-icon fa fa-trash-o bigger-120 orange"> Supprimer</i></a>
					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue"><b> Nom : </b></label>
							<div class="col-sm-9"><b>{{ $service->nom }}</b></div>
						</div>
						<div class="space-12 hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue"><b>Type:</b></label>
							<div class="col-sm-9">
								@switch($service->type)
									@case(0)
       									<span class="label label-sm label-danger"><b>Médical</b></span>
        								 	@break
        								@case(1)
        									<span class="label label-sm label-success"><b>Chirurgical</b></span>
        									@break
        								@default
        									<span class="label label-sm label-success"><b>Fonctionnel</b></span>
        									@break
									@endswitch
							</div>
						</div>
						<div class="space-12 hidden-xs"></div><div class="space-12 hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue"><b>Chef de Service:</b></label>
							<div class="col-sm-9"><b>{{ ($service->responsable_id) ? $service->responsable->full_name :'' }}</b></div>
						</div>
						<div class="space-12 hidden-xs"></div><div class="space-12 hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="hebergement"><b>Hébergement:</b></label>
							<div class="col-sm-9">
							<label>
								<input name="hebergement" value="0" type="radio" class="ace" @if(!($service->hebergement)) checked @endif disabled/>
									<span class="lbl">Non</span></label>&nbsp;&nbsp;
								<label>
									<input name="hebergement" value="1" type="radio" class="ace" @if($service->hebergement) checked @endif disabled/>
									<span class="lbl">Oui</span></label>&nbsp;&nbsp;&nbsp;
								</div>
						</div>	
						<div class="space-12 hidden-xs"></div><div class="space-12 hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="urgence"><b>Urgence:</b></label>
							<div class="col-sm-9">
							<label>
								<input name="urgence" value="0" type="radio" class="ace" @if(!($service->urgence)) checked @endif disabled/>
									<span class="lbl">Non</span></label>&nbsp;&nbsp;
								<label>
									<input name="urgence" value="1" type="radio" class="ace" @if($service->urgence) checked @endif disabled/>
									<span class="lbl">Oui</span></label>&nbsp;&nbsp;&nbsp;
								</div>
						</div><br>	
					</div>
				</div>
				</div>
					
			</div>
		</div>
	</div>
@endsection