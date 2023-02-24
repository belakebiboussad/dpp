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
	   		<i class="ace-icon fa fa-pencil-square-o bigger-160 red" ></i> <span class="bigger-160">Informations Géneral</span>
			</a>
		</li>
		<li role= "presentation" class="col-md-4">
			<a role= "presentation" data-toggle="tab" href="#edit-password"  aria-controls="edit-password" data-toggle="tab" class="btn btn-danger" >
			  <i class="blue ace-icon fa fa-key bigger-160"></i> <span class="bigger-160">Information d'Authentification</span>
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
			     		<i class="ace-icon fa fa-caret-right blue"></i>Nom : <label class="blue">{{ $employe->nom }}</label>
				    </li>
						<li>
				    	<i class="ace-icon fa fa-caret-right blue"></i>Prénom :<label class="blue">{{ $employe->prenom }}</label>
				    </li>
						<li>
				      <i class="ace-icon fa fa-caret-right blue"></i>Date de Naissance  :  <label class="blue">{{ $employe->Date_Naiss }}</label>
				    </li>
						<li>
				     	<i class="ace-icon fa fa-caret-right blue"></i>Genre :
				       	<label class="blue">{{ $employe->sexe == "M" ? 'Masculin' : 'Féminin' }} <i class="fas fa-address-book"></i></label>
				    </li>
						@if( $employe->service  != null)
						<li>
				      <i class="ace-icon fa fa-caret-right blue"></i>Service :<label class="blue">{{Auth::User()->employ->Service->nom }}</label>
				    </li>
						@endif
         	</ul>
        </div>
        <div class="col-md-6 col-sm-6">
       		<ul class="list-unstyled spaced">
       			<li>
			    		<i class="ace-icon fa fa-caret-right blue"></i>Spécialité :
                <label class="blue">{{ isset(Auth::User()->employ->specialite) ? Auth::User()->employ->Specialite->nom : '' }}</label>
			      </li>
						<li>
			       <i class="ace-icon fa fa-caret-right blue"></i>Matricule :<label class="blue">{{ $employe->matricule }}</label>
			      </li>
						<li>
			       	<i class="ace-icon fa fa-caret-right blue"></i>Username :<label class="blue">{{ $user->name }}</label>
			      </li>
						<li>
			       	<i class="ace-icon fa fa-caret-right blue"></i>Rôle :<label class="blue">{{ Auth::user()->role->role }}</label>
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
				      	Tél fixe :  <label class="blue">{{ $employe->Tele_fixe  }}</label>
						  </li>

         		</ul>
         	</div>
         	<div class="col-md-6 col-sm-6">
	         	<ul class="list-unstyled spaced">
		        	<li>
						    <i class="ace-icon fa fa-caret-right blue"></i><i class="ace-icon fa fa-home bigger-110"></i>Adresse : <adress class="blue">{{ $employe->Adresse }}</adress>
						  </li>
							<li>
						    <i class="ace-icon fa fa-caret-right blue"></i><i class="ace-icon fa fa-envelope bigger-90"></i> E-mail : <adress class="blue">{{ $user->email  }}</adress>
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
          <label class="col-md-4 control-label" align="right">Mot de passe Actuel:<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <input type="password" class="form-control" id="curPassword" name="curPassword" placeholder="taper le mot de passe actuel" required/>
            <small class="help-block"></small>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label" align="right">Nouveau mot de passe:<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="taper un nouveau mot de passe" required />
            <small class="help-block"></small>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label" align="right">Confirmer nouveau mot de passe:<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmer mot de passe" required />
            </div>
        </div>
        <div>
          <div class="col-md-6 col-md-offset-4">
          <br>
            <button type="submit" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-save bigger-110"></i> Enregistrer</button> 
            <a href="route('HomeController.index')" class="btn btn-xs btn-warning">
              <i class="ce-icon c fa fa-undo bigger-110"></i> Annuler</a>
          
          </div>
        </div>
    </form>
    </div>	
  </div>
</div> 
@endsection
