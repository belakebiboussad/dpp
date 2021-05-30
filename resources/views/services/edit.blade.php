@extends('app')
@section('main-content')
	<div class="page-header"><h1>Modifier le service "{{ $service->nom }}"</h1></div>
	<div class="row">
		<div class="col-xs-7">
			<div class="widget-box" id="widget-box-1">
				<div class="widget-header"><h5 class="widget-title">Information du Service</h5></div>
				<div class="widget-body">
					<div class="widget-main">
						<form class="form-horizontal" role="form" method="POST" action="{{ route('service.update', $service->id) }}">
							{{ csrf_field() }}
							{{ method_field('PUT') }}
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Nom : </strong></label>
								<div class="col-sm-9">
									<input type="text" id="nom" name="nom" value="{{ $service->nom }}" placeholder="Nom Du Service" class="col-xs-10 col-sm-5" />
								</div>
							</div>	<div class="space-12 hidden-xs"></div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="type"><strong>Type:</strong></label>
								<div class="col-sm-9">
									<select id="type" name="type"  class="selectpicker show-menu-arrow place_holde col-xs-10 col-sm-5" required >
										<option value="0" @if($service->type == 0) selected @endif>Médicale</option>
										<option value="1" @if($service->type == 1) selected @endif>Chirurgical</option>
										<option value="2" @if($service->type == 2) selected @endif>Fonctionnel</option>
									</select>	
								</div>
							</div><div class="space-12 hidden-xs"></div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="type"><strong>Chef:</strong></label>
								<div class="col-sm-9">
									<select id="responsable_id" name="responsable_id"  class="selectpicker show-menu-arrow place_holde col-xs-10 col-sm-5" required >
										<option value="" selected disabled>Selectionner le chef</option>
										@foreach ($users as $user)
											<option value="{{ $user->employ->id}}" @if($service->responsable_id == $user->employ->id) selected @endif> {{ $user->employ->nom }} {{ $user->employ->prenom }}</option>
										@endforeach
									</select>	
								</div>
							</div><div class="space-12 hidden-xs"></div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="hebergement"><strong> Hébergement: </strong></label>
								<div class="col-sm-9">
									<label>
										<input name="hebergement" value="0" type="radio" class="ace" @if(!($service->hebergement)) checked @endif/><span class="lbl">Non</span></label>&nbsp;&nbsp;
									<label>
										<input name="hebergement" value="1" type="radio" class="ace" @if($service->hebergement) checked @endif/><span class="lbl">Oui</span></label>&nbsp;&nbsp;&nbsp;								
								</div>
							</div>
							<div class="space-12 hidden-xs"></div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="urgence"><strong> Urgence: </strong></label>
								<div class="col-sm-9">
									<label>
										<input name="urgence" value="0" type="radio" class="ace" @if(!($service->urgence)) checked @endif/><span class="lbl">Non</span></label>&nbsp;&nbsp;
									<label>
										<input name="urgence" value="1" type="radio" class="ace" @if($service->urgence) checked @endif/><span class="lbl">Oui</span></label>&nbsp;&nbsp;&nbsp;								
								</div>
							</div>
							<div class="row center">
								<button class="btn btn-xs btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
								<button class="btn btn-xs" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-5">
			<div class="widget-box" id="widget-box-2">
				<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i><span><b>Chambres</b></span></h5>
				</div>
			<div class="widget-body">
			<ol id="" class="">
				@foreach ($service->salles as $salle)	
				<tr>
					<td><li><a href="/salle/{{$salle->id}}" title="detail de la salle">{{ $salle->nom }}</a>	</td>
					<td class="pull-right">-<span class="badge badge-info">{{ count($salle->lits) }}</span> &nbsp;Lits </li></td>
				</tr>
				@endforeach
			</ol><!-- / -->
			</div>{{-- widget-body --}}
			</div>
		</div>
	</div>
@endsection