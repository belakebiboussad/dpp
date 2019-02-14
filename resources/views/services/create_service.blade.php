@extends('app')
@section('main-content')
	<div class="page-header">
		<h1>Ajouter un service :</h1>
	</div>
	<div class="space-12"></div>
	<div class="row">
		<div class="col-xs-6">
			<div class="widget-box widget-primary" id="widget-box-1">
				<div class="widget-header" bg="blue">
					<h5 class="widget-title"><strong>Ajouter Un Service :</strong></h5>
				</div>
				<div class="widget-body">
				<div class="widget-main">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('service.store') }}">
						{{ csrf_field() }}
						<div class="space-12"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Nom: </strong></label>
							<div class="col-sm-9">
								<input type="text" id="nom" name="nom" placeholder="Nom Du Service" class="col-xs-10 col-sm-5" required/>
							</div>
							</div>
							<div class="space-12"></div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="type"><strong>Type:</strong></label>
								<div class="col-sm-9">
									<select id="type" name="type" placeholder="Type du Service" class="selectpicker show-menu-arrow place_holde col-xs-10 col-sm-5" required >
										<option value="" selected disabled>Selectionnez type du service</option>
										<option value="hosp" >Médicale</option>
										<option value="fonct">Téchnique</option>
									</select>	
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="type"><strong>Chef de Service:</strong></label>
								<div class="col-sm-9">
									{{-- <input type="text" id="responsable_id" name="responsable_id" placeholder="Selectionner le chef de service" class="col-xs-10 col-sm-5" required/>&nbsp;&nbsp;
									<button type="button" class="btn btn-info btn-sm">
										    <span class="glyphicon glyphicon-search"></span> Search
									</button> --}}	
									<select id="responsable" name="responsable" placeholder="Chef de service" class="selectpicker show-menu-arrow place_holde col-xs-10 col-sm-5" required >
										<option value="" selected disabled>Selectionner le chef de service</option>
										@foreach ($membres as $membre)
											{{-- expr --}}
											<option value="{{ $membre->id}}"> {{ $membre->Nom_Employe }}{{ $membre->Prenom_Employe }}</option>
										@endforeach
									</select>	
								</div>
							</div>
							<div class="space-12"></div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="etatlit"><strong> Urgence: </strong></label>
								<div class="col-sm-9">
									<label>
										<input name="urgence" value="0" type="radio" class="ace" checked/>
										<span class="lbl">Non</span>
									</label>&nbsp;&nbsp;
									<label>
										<input name="urgence" value="1" type="radio" class="ace"/>
										<span class="lbl">Oui</span>
									</label>&nbsp;&nbsp;&nbsp;
								</div>
							</div>
							<div class="space-12"></div>	
							<div>
								<div class="center">
									<button class="btn btn-info" type="submit">
										<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
									</button>
									&nbsp; &nbsp; &nbsp;
									<button class="btn" type="reset">
										<i class="ace-icon fa fa-undo bigger-110"></i>Annuler
									</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
		</div>{{-- col-xs-6 --}}
		<div class="col-xs-6">
			<div class="widget-box" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">
					<i class="ace-icon fa fa-table"></i>
					<span><b>Liste Des Services</b></span>
				</h5>
			</div>
			<div class="widget-body">

			</div>{{-- widget-body --}}
			</div>	
		</div>{{-- col-xs-6 --}}

	</div>
@endsection