@extends('app')
@section('main-content')
<div class="row"><h4> <strong>Détails : {{ $user->name }}</strong></h4>
<div class="pull-right">
	<a href="{{ route('users.edit',$user->id )}}" class="btn btn-info btn-sm" data-toggle="tooltip" title="modifier">
		<i class="fa fa-edit fa-xs" aria-hidden="true" ></i>
	</a>
	<a href="{{ route('users.destroy',$user->id )}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-sm btn-danger">
		<i class="fa fa-trash-o fa-xs"></i>
	</a>
</div>
</div>
<div class="tabbable"><!-- <ul class="nav nav-tabs> -->
	<ul class = "nav nav-pills nav-justified list-group" role="tablist">
		<li class="active col-md-6" role= "presentation"><a data-toggle="tab" href="#info-general"><i class="green ace-icon fa fa-book bigger-125"></i>&nbsp;Informations Géneral</a></li>
		<li class="col-md-6" role= "presentation"><a data-toggle="tab" href="#info-compte"><i class="red ace-icon fa fa-users bigger-125"></i>&nbsp;Informations du compte</a></li>
	</ul>
	<div class="tab-content profile-edit-tab-content jumbotron">
		<div id="info-general" class="tab-pane in active">
							<h5 class="header blue bolder smaller">Informations administratives</h5>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right"><b>Nom :</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->nom }}</label></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right"><b>Prénom :</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->prenom }}</label></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right"><b>Date Naissance :</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->Date_Naiss }}</label> </div>
					</div>
				</div>
				<div class="vspace-12-sm"></div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right"><b>Lieu Naissance :</b></label>
						<div class="col-sm-8">	<label class="blue">{{ $user->employ->Lieu_Naissance }}</label>	</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right"><b>Genre :</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->sexe == "M" ? "Masculin" : "Féminin" }}</label></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right"><b>Adresse :</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->Adresse }}</label></div>
					</div>
				</div>
			</div>
			<h5 class="header blue bolder smaller">Contacts</h5>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right"><b>Tél mobile :</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->tele_mobile }}</label></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right"><b>Tél Fixe :</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->Tele_fixe }}</label>	</div>
				  </div>
				</div>
			</div>
			<h5 class="header blue bolder smaller">Informations du poste</h5>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right"><b>Matricule :</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->Matricule_dgsn }}</label></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					@isset($user->employ->service)
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right"><b>Service :</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->Service->nom }}</label></div>
					</div>
					@endisset
				</div>
				<div class="col-xs-12 col-sm-4">
				@isset($user->employ->Specialite)
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right"><strong>Spécialité :</strong></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->Specialite->nom }}</label></div>
					</div>
				@endisset	
				</div>
			</div>
			<h5 class="header blue bolder smaller">Informations d'assurance</h5>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right"><b>N° Sécurité Sociale :</b></label>
						<div class="col-sm-8">	<label class="blue">{{$user->employ->NSS }}</label>	</div>
					</div>
				</div>
			</div>	
		</div>
		<div id="info-compte" class="tab-pane">
					<div class="space-12"></div>	
			<h4 class="header blue bolder smaller">Informations du compte</h4>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right"><b>Nom d'utilisateur :</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->name }}</label></div>
					</div>
				</div>
{{-- <div class="col-xs-12 col-sm-4">		<div class="form-group"><label class="col-sm-4 control-label no-padding-right"><b>Password :</b></label>
<div class="col-sm-8"><label class="blue">{{ decrypt($user->password) }}</label></div></div></div> --}}
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right"><b>Rôle :</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->role->role }}</label>	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
	