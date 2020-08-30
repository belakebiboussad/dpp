@extends('app')
@section('page-script')
	<script type="text/javascript" src="{{asset('/js/jquery-2.1.4.min.js')}}"></script>
	<script type="text/javascript">
	    $('#user-profile-3').ready(function(){      
	    });
	</script>
@endsection
@section('main-content')
     <div class="row">
	     	<div class="page-header" @if($user->profile_banner_url != '') style="background-image: url('{{ route('profile/banner', ['profile_banner_url' => $user->profile_banner_url]) }}');" @endif>
			<h1><strong>Mon Profil</strong></h1>
		</div>
     </div>
     <div class="row">
     		@if($user->profile_image_url != '')
  		<img class="img-thumbnail img-responsive center-block" width="180" src="{{ route('profile/image', ['profile_image_url' => $user->profile_image_url]) }}">
		@endif
     </div>
  	<div class="tabbable borderless" style ="border-style:none;">
			<ul class="nav nav-pills nav-justified" id="tabMenu">
			  <li  role= "presentation" class="col-md-4 active">
			  	<a data-toggle="tab" href="#edit-basic" aria-controls="edit-basic" data-toggle="tab" class="btn btn-info" >
			   		<i class="ace-icon fa fa-pencil-square-o bigger-160 red" ></i>
			   		&nbsp;<span class="bigger-160">Informations Géneral</span>
			   	</a>
			  </li>
			  <li  role= "presentation" class="col-md-4">
			   	<a  role= "presentation" data-toggle="tab" href="#edit-password"  aria-controls="edit-password" data-toggle="tab" class="btn btn-danger" >
			    	<i class="blue ace-icon fa fa-key bigger-160"></i>
			     		&nbsp;<span class="bigger-160">Information d'Authentification</span>
			    </a>
			  </li>
			</ul>
                   	<div class="tab-content" style ="border-style:none;">
				<div role="tabpanel" class = "tab-pane active" id="edit-basic">
		  			<div class="w3-teal">
         					<h4 class="header blue bolder smaller">Géneral</h4>
         				</div>
         				<div class="row">
         					<div class="col-md-6 col-sm-6">
         					<ul class="list-unstyled spaced">
         						<li>
				       		<i class="ace-icon fa fa-caret-right blue"></i>
				       		<strong>Nom :</strong>  <label class="blue">{{ $employe->Nom_Employe }}</label>
							</li>
							<li>
				       		<i class="ace-icon fa fa-caret-right blue"></i>
				       		<strong>Prénom :</strong>  <label class="blue">{{ $employe->Prenom_Employe }}</label>
							</li>
							<li>
				       			<i class="ace-icon fa fa-caret-right blue"></i>
				       			<strong>Date de Naissance  :</strong>  <label class="blue">{{ $employe->Date_Naiss_Employe }}</label>
							</li>
							<li>
				       			<i class="ace-icon fa fa-caret-right blue"></i>
				       			<strong>Genre  :</strong> 
				       			<label class="blue">
				       			{{ $employe->Sexe_Employe == "M" ? 'Masculin' : 'Féminin' }} <i class="fas fa-address-book"></i>
								</label>
							</li>
							@if( $employe->Service_Employe  != null)
								<li>
				       			<i class="ace-icon fa fa-caret-right blue"></i>
				       			<strong>Service  :</strong> 
				       			<label class="blue">
				       				{{ Auth::User()->employ->service->nom }}
				       			</label>
							</li>
							@endif
         					</ul>
         					</div>
         					<div class="col-md-6 col-sm-6">
         					<ul class="list-unstyled spaced">
         						<li>
				       			<i class="ace-icon fa fa-caret-right blue"></i>
				       			<strong>Spécialité :</strong>  <label class="blue">{{ Auth::User()->employ->specialite->nom }}</label>
							</li>
							<li>
				       			<i class="ace-icon fa fa-caret-right blue"></i>
				       			<strong>Matricule :</strong>  <label class="blue">{{ $employe->Matricule_dgsn }}</label>
							</li>
							<li>
				       			<i class="ace-icon fa fa-caret-right blue"></i>
				       			<strong>Username :</strong>  <label class="blue">{{ $user->name }}</label>
							</li>
							<li>
				       			<i class="ace-icon fa fa-caret-right blue"></i>
				       			<strong>Rôle :</strong>  <label class="blue">{{ Auth::user()->role->role  }}</label>
							</li>
							<li>
				       			<i class="ace-icon fa fa-caret-right blue"></i>
				       			<strong>Rôle :</strong>  <label class="blue">{{ Auth::user()->role->role  }}</label>
							</li>
						</ul>
         					</div>
         				</div>
         				<div class="w3-teal">
         					<h4 class="header blue bolder smaller">Contact</h4>
         				</div>
         				<div class="row">
         				<div class="col-md-6 col-sm-6">
         				<ul class="list-unstyled spaced">
         					<li>
				      			<i class="ace-icon fa fa-caret-right blue"></i>
				      			<i class="ace-icon fa fa-mobile bigger-110"></i>
				       		<strong>Télé mobile :</strong>  <label class="blue">{{ $employe->tele_mobile  }}</label>
						</li>
						<li>
				      			<i class="ace-icon fa fa-caret-right blue"></i>
				      			<i class="ace-icon fa fa-mobile bigger-110"></i>
				       		<strong>Télé fixe :</strong>  <label class="blue">{{ $employe->Tele_fixe  }}</label>
						</li>

         				</ul>
         					</div>
         					<div class="col-md-6 col-sm-6">
         					<ul class="list-unstyled spaced">
	         					<li>
					      			<i class="ace-icon fa fa-caret-right blue"></i>
					      			<i class="ace-icon fa fa-home bigger-110"></i>
					       		<strong>Adresse :</strong> <adress class="blue">{{ $employe->Adresse_Employe  }}</adress>
							</li>
							<li>
					      			<i class="ace-icon fa fa-caret-right blue"></i>
					      			<i class="ace-icon fa fa-envelope bigger-90"></i>
					       		<strong>E-mail :</strong> <adress class="blue">{{ $user->email  }}</adress>
							</li>
         					</ul>
         					</div>
         				</div>
         			</div>  {{-- edit-basic --}}
         			<div id ="edit-password" role="tabpanel" class = "tab-pane">
         			@if (session('error'))
			              <div class="alert alert-danger">
			      		       {{ session('error') }}
			               </div>
			       @endif
			       @if (session('success'))
		                 	<div class="alert alert-success">
		                           {{ session('success') }}
		                     </div>
                       	@endif
             		<form id="form-change-password" role="form" method="POST" action="{{  url('/users/changePassword')  }}"
                  onsubmit = "return checkForm(this);">
            
              {{ csrf_field() }}
              <input type="hidden" name="user_id" value="{{ $user->id }}">
              <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}"> </div>
                     <div class="form-group">
                           <label class="col-md-4 control-label" align="right"><strong>Mot de passe Actuel:<span style="color: red">*</span></dtrong></label>
                           <div class="col-md-6">
                                <input type="password"  class="form-control" id="curPassword" name="curPassword" placeholder="taper le mot de passe actuel" required/>
                                <small class="help-block"></small>
                          </div>
                     </div>
                      <div class="space-4"></div>
           
                   
                      <div class="form-group">
                           <label class="col-md-4 control-label" align="right"><strong>Nouveau mot de passe:<span style="color: red">*</span></strong></label>
                           <div class="col-md-6">
                                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="taper un nouveau mot de passe" required />
                                <small class="help-block"></small>
                        </div>
                     </div>
                     <div class="space-12"></div>
           
      
               <div class="form-group">
                        <label class="col-md-4 control-label" align="right"><strong>Confirmer nouveau mot de passe:<span style="color: red">*</span></strong></label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmer mot de passe" required />
                        </div>
                </div>
                <div class="space-12"></div> 
                <div class="form-group">
                <br>
                     <div class="col-md-6 col-md-offset-4">
                           <br>
                           <div class="center">
                                <button type="submit" class="btn btn-xs btn-primary">
                                      <i class="ace-icon fa fa-save bigger-110"></i>
                                      Enregistrer
                                 </button>&nbsp; &nbsp; &nbsp;
                                  {{-- <button type="reset" class="btn btn-primary">
                                     <i class="ce-icon c fa fa-times-circle  bigger-110"></i>
                                      &nbsp;Annuler
                                  </button> --}}
                                  <a href="route('HomeController.index')" class="btn btn-xs btn-info">
                                  	<i class="ce-icon c fa fa-times-circle  bigger-110"></i>
                                      &nbsp;Annuler
                                  </a>
                                </div>
                     </div>
                </div>
            </form>
         			</div>	
         		</div>
      	</div> 
		</div>
    
@endsection
