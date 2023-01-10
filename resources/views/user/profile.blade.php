@extends('app')
@section('main-content')
 	<div class="page-header" @if($user->profile_banner_url != '') style="background-image: url('{{ route('profile/banner', ['profile_banner_url' => $user->profile_banner_url]) }}');" @endif>
    <h3>Mon Profil</h3>
	</div>
<div class="row">
@if($user->profile_image_url != '')
	<img class="img-thumbnail img-responsive center-block" width="180" src="{{ route('profile/image', ['profile_image_url' => $user->profile_image_url]) }}">
@endif
</div>
<div class="row tabs">
  <ul class="nav nav-pills nav-justified" id="tabMenu">
	  <li  role= "presentation" class="col-md-4 active">
	  	<a data-toggle="tab" href="#edit-basic" aria-controls="edit-basic" data-toggle="tab" class="btn btn-info" >
	   		<i class="ace-icon fa fa-pencil-square-o bigger-160 red" ></i>&nbsp;<span class="bigger-160">Informations Géneral</span>
			</a>
		</li>
		<li role= "presentation" class="col-md-4">
			<a role= "presentation" data-toggle="tab" href="#edit-password"  aria-controls="edit-password" data-toggle="tab" class="btn btn-danger" >
			  <i class="blue ace-icon fa fa-key bigger-160"></i>&nbsp;<span class="bigger-160">Information d'Authentification</span>
	    </a>
		</li>
	</ul>
  <div class="tab tab-content no-border">
		<div role="tabpanel" class = "tab-pane active" id="edit-basic">
		 	<div class="w3-teal"><h4 class="header blue smaller">Géneral</h4></div>
     	<div class="row">
      	<div class="col-md-6 col-sm-6">
      		<ul class="list-unstyled spaced">
      			<li>
			     		<i class="ace-icon fa fa-caret-right blue"></i><b>Nom :</b>  <label class="blue">{{ $employe->nom }}</label>
				    </li>
						<li>
				    	<i class="ace-icon fa fa-caret-right blue"></i><b>Prénom :</b><label class="blue">{{ $employe->prenom }}</label>
				    </li>
						<li>
				      <i class="ace-icon fa fa-caret-right blue"></i><b>Date de Naissance  :</b>  <label class="blue">{{ $employe->Date_Naiss }}</label>
				    </li>
						<li>
				     	<i class="ace-icon fa fa-caret-right blue"></i><b>Genre :</b>
				       	<label class="blue">{{ $employe->sexe == "M" ? 'Masculin' : 'Féminin' }} <i class="fas fa-address-book"></i></label>
				    </li>
						@if( $employe->service  != null)
						<li>
				      <i class="ace-icon fa fa-caret-right blue"></i><b>Service :</b><label class="blue">{{Auth::User()->employ->Service->nom }}</label>
				    </li>
						@endif
         	</ul>
        </div>
        <div class="col-md-6 col-sm-6">
       		<ul class="list-unstyled spaced">
       			<li>
			    		<i class="ace-icon fa fa-caret-right blue"></i><b>Spécialité :</b>
                <label class="blue">{{ isset(Auth::User()->employ->specialite) ? Auth::User()->employ->Specialite->nom : '' }}</label>
			      </li>
						<li>
			       <i class="ace-icon fa fa-caret-right blue"></i><b>Matricule :</b><label class="blue">{{ $employe->matricule }}</label>
			      </li>
						<li>
			       	<i class="ace-icon fa fa-caret-right blue"></i><b>Username :</b><label class="blue">{{ $user->name }}</label>
			      </li>
						<li>
			       	<i class="ace-icon fa fa-caret-right blue"></i><b>Rôle :</b><label class="blue">{{ Auth::user()->role->role }}</label>
			      </li>
			  </ul>
       	</div>
      </div>
      <div class="w3-teal"><h4 class="header blue smaller">Contact</h4></div>
      <div class="row">
      		<div class="col-md-6 col-sm-6">
      			<ul class="list-unstyled spaced">
      				<li>
			    			<i class="ace-icon fa fa-caret-right blue"></i><i class="ace-icon fa fa-mobile bigger-110"></i>
			    			<b>Tél mobile :</b>  <label class="blue">{{ $employe->tele_mobile  }}</label>
							</li>
			  			<li>
				        <i class="ace-icon fa fa-caret-right blue"></i><i class="ace-icon fa fa-mobile bigger-110"></i>
				      	<b>Tél fixe :</b>  <label class="blue">{{ $employe->Tele_fixe  }}</label>
						  </li>

         		</ul>
         	</div>
         	<div class="col-md-6 col-sm-6">
	         	<ul class="list-unstyled spaced">
		        	<li>
						    <i class="ace-icon fa fa-caret-right blue"></i><i class="ace-icon fa fa-home bigger-110"></i>
						    <b>Adresse :</b> <adress class="blue">{{ $employe->Adresse }}</adress>
							</li>
							<li>
						    <i class="ace-icon fa fa-caret-right blue"></i><i class="ace-icon fa fa-envelope bigger-90"></i>
						    <b>E-mail :</b> <adress class="blue">{{ $user->email  }}</adress>
							</li>
	         	</ul>
         </div>
      </div>
    </div>  {{-- edit-basic --}}
    <div id ="edit-password" role="tabpanel" class = "tab-pane">
    @if (session('error'))
		  <div class="alert alert-danger">{{ session('error') }}</div>
		@endif
		@if (session('success'))
		  <div class="alert alert-success"> {{ session('success') }} </div>
		@endif
    <form id="form-change-password" role="form" method="POST" action="{{ url('/users/changePassword') }}"onsubmit = "return checkForm(this);">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}"> </div>
        <div class="form-group">
          <label class="col-md-4 control-label" align="right"><b>Mot de passe Actuel:<span class="text-danger">*</span></b></label>
          <div class="col-md-6">
            <input type="password" class="form-control" id="curPassword" name="curPassword" placeholder="taper le mot de passe actuel" required/>
            <small class="help-block"></small>
          </div>
        </div>
        <div class="space-12"></div>
        <div class="form-group">
          <label class="col-md-4 control-label" align="right"><b>Nouveau mot de passe:<span class="text-danger">*</span></b></label>
          <div class="col-md-6">
            <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="taper un nouveau mot de passe" required />
            <small class="help-block"></small>
          </div>
        </div><div class="space-12"></div>
        <div class="form-group">
          <label class="col-md-4 control-label" align="right"><b>Confirmer nouveau mot de passe:<span class="text-danger">*</span></b></label>
          <div class="col-md-6">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmer mot de passe" required />
            </div>
        </div><div class="space-12"></div> 
        <div class="form-group"><br>
          <div class="col-md-6 col-md-offset-4"> <br>
            <div class="center">
              <button type="submit" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
              <a href="route('HomeController.index')" class="btn btn-xs btn-info"><i class="ce-icon c fa fa-times-circle  bigger-110"></i>&nbsp;Annuler</a>
            </div>
          </div>
        </div>
    </form>
    </div>	
  </div>
</div> 
@endsection
