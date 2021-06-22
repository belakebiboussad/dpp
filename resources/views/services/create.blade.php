@extends('app')
@section('main-content')
	<div class="row"><h3><strong>Ajouter un service :</strong></h3></div><div class="space-12 hidden-xs"></div>
	<div class="row">
		<div class="col-sm-6 col-xs-12">
			<div class="widget-box widget-primary" id="widget-box-1">
				<div class="widget-header" bg="blue"><h5 class="widget-title"><strong>Ajouter un service </strong></h5></div>
				<div class="widget-body">
				<div class="widget-main">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('service.store') }}">
						{{ csrf_field() }}
						<div class="space-12 hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Nom: </strong></label>
							<div class="col-sm-9">
								<input type="text" id="nom" name="nom" placeholder="Nom du Service" class="col-xs-12 col-sm-12" required/>
							</div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="type"><strong>Type:</strong></label>
							<div class="col-sm-9">
								<select  name="type"  class="selectpicker show-menu-arrow place_holde col-xs-12 col-sm-12" required >
									<option value="0">Médical</option>
									<option value="1">Chirurgical</option>
									<option value="2" >Fonctionnel</option>
								</select>		
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="responsable_id"><strong>Chef de Service:</strong></label>
							<div class="col-sm-9">
						       	<select id="responsable_id" name="responsable_id" class="selectpicker show-menu-arrow place_holde col-xs-12 col-sm-12" required >
									<option value="" selected disabled>Selectionner le chef de service</option>
									@foreach ($users as $user)
									<option value="{{ $user->employ->id}}"> {{ $user->employ->nom }} {{ $user->employ->prenom }}</option>
									@endforeach
								</select>	
							</div>
						</div>
						<div class="space-12 hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="hebergement"><strong> Hébergement: </strong></label>
							<div class="col-sm-9">
								<label><input name="hebergement" value="0" type="radio" class="ace" checked/><span class="lbl">Non</span></label>&nbsp;&nbsp;
								<label><input name="hebergement" value="1" type="radio" class="ace"/><span class="lbl">Oui</span></label>&nbsp;&nbsp;&nbsp;
							  </div>
						</div><div class="space-12 hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="urgence"><strong> Urgence: </strong></label>
							<div class="col-sm-9">
								<label><input name="urgence" value="0" type="radio" class="ace" checked/><span class="lbl">Non</span></label>&nbsp;&nbsp;
								<label><input name="urgence" value="1" type="radio" class="ace"/><span class="lbl">Oui</span></label>&nbsp;&nbsp;&nbsp;
							  </div>
						</div><div class="space-12 hidden-xs"></div>	
						<div class="center">
							<button class="btn btn-xs btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
							<button class="btn btn-xs" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
						</div>
					</form>
				</div>
			    </div>
		      </div>
		</div>{{-- col-xs-6 --}}
		<div class="col-sm-6 hidden-xs">
			<div class="widget-box" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i><span><b>Liste des services</b></span></h5>
			</div>
			<div class="widget-body">
			<ol>
				@foreach ($services as $service)	
				<li><a href="/service/{{$service->id}}/edit" title="detail du service">{{ $service->nom }}</a></li>
				@endforeach
			</ol><!-- / -->
			</div>{{-- widget-body --}}
			</div>	
		</div>{{-- col-xs-6 --}}
	</div>
@endsection